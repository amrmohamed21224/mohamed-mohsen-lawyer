<?php
/**
 * Form Handler — معالج فورم التواصل (AJAX)
 *
 * يستقبل البيانات عبر AJAX ويتحقق منها ثم يرسل البريد.
 *
 * الحقول المتوقعة في $_POST:
 *   nonce         — WordPress nonce
 *   full_name     — الاسم الكامل (2–100 حرف)
 *   phone         — رقم الهاتف (مصري/دولي)
 *   contact_via   — وسيلة التواصل المفضّلة ('phone'|'email'|'whatsapp')
 *   email         — البريد الإلكتروني (إجباري فقط لو contact_via === 'email')
 *   message       — نص الرسالة (20–1000 حرف)
 *   privacy_agree — يجب أن تكون '1'
 *   website_url   — Honeypot: يجب أن يكون فارغًا
 *
 * @package MohamedMohsenLawyer
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'wp_ajax_submit_contact_form',        'mml_handle_contact_form' );
add_action( 'wp_ajax_nopriv_submit_contact_form', 'mml_handle_contact_form' );

function mml_handle_contact_form(): void {

    // ── 1. Nonce ─────────────────────────────────────────────────
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'mml_contact_form_nonce' ) ) {
        wp_send_json_error( [ 'message' => 'طلب غير صالح.' ], 403 );
    }

    // ── 2. Honeypot ──────────────────────────────────────────────
    $honeypot = isset( $_POST['website_url'] ) ? sanitize_text_field( wp_unslash( $_POST['website_url'] ) ) : '';
    if ( $honeypot !== '' ) {
        // Bot detected — نردّ بنجاح زائف لتضليل الـ bot
        wp_send_json_success( [ 'message' => 'تم إرسال طلبك بنجاح. سيتواصل المكتب معك بعد مراجعة البيانات.' ] );
    }

    // ── 3. Rate Limiting (per IP, 60 seconds) ────────────────────
    $ip           = mml_get_client_ip();
    $transient_key = 'mml_form_ratelimit_' . md5( $ip );

    if ( get_transient( $transient_key ) !== false ) {
        wp_send_json_error( [ 'message' => 'تم إرسال عدة طلبات خلال وقت قصير. برجاء المحاولة لاحقًا.' ], 429 );
    }

    // ── 4. Collect & Sanitize Inputs ─────────────────────────────
    $full_name    = isset( $_POST['full_name'] )    ? sanitize_text_field( wp_unslash( $_POST['full_name'] ) )    : '';
    $phone        = isset( $_POST['phone'] )        ? sanitize_text_field( wp_unslash( $_POST['phone'] ) )        : '';
    $contact_via  = isset( $_POST['contact_via'] )  ? sanitize_text_field( wp_unslash( $_POST['contact_via'] ) )  : '';
    $email        = isset( $_POST['email'] )        ? sanitize_email( wp_unslash( $_POST['email'] ) )             : '';
    $message      = isset( $_POST['message'] )      ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) )  : '';
    $privacy      = isset( $_POST['privacy_agree'] ) ? sanitize_text_field( wp_unslash( $_POST['privacy_agree'] ) ) : '';

    // ── 5. Validation ─────────────────────────────────────────────
    $errors = [];

    // الاسم
    if ( $full_name === '' ) {
        $errors['full_name'] = 'برجاء إدخال الاسم.';
    } elseif ( mb_strlen( $full_name ) < 2 ) {
        $errors['full_name'] = 'الاسم المدخل قصير جدًا.';
    } elseif ( mb_strlen( $full_name ) > 100 ) {
        $errors['full_name'] = 'الاسم المدخل طويل جدًا.';
    }

    // الهاتف
    if ( $phone === '' ) {
        $errors['phone'] = 'برجاء إدخال رقم الهاتف.';
    } elseif ( ! mml_validate_phone( $phone ) ) {
        $errors['phone'] = 'برجاء إدخال رقم هاتف صحيح.';
    }

    // البريد الإلكتروني (إجباري فقط لو اختار التواصل عبر البريد)
    if ( $contact_via === 'email' ) {
        if ( $email === '' ) {
            $errors['email'] = 'برجاء إدخال البريد الإلكتروني للتواصل عبره.';
        } elseif ( ! is_email( $email ) ) {
            $errors['email'] = 'برجاء إدخال بريد إلكتروني صحيح.';
        }
    } elseif ( $email !== '' && ! is_email( $email ) ) {
        // إذا أدخل بريدًا اختياريًا لكنه غير صحيح
        $errors['email'] = 'برجاء إدخال بريد إلكتروني صحيح.';
    }

    // الرسالة
    if ( mb_strlen( $message ) < 20 ) {
        $errors['message'] = 'برجاء توضيح الموضوع باختصار.';
    } elseif ( mb_strlen( $message ) > 1000 ) {
        $errors['message'] = 'برجاء اختصار الرسالة إلى 1000 حرف كحد أقصى.';
    }

    // الموافقة على الخصوصية
    if ( $privacy !== '1' ) {
        $errors['privacy_agree'] = 'يلزم الموافقة على إخلاء المسؤولية لإرسال الطلب.';
    }

    if ( ! empty( $errors ) ) {
        wp_send_json_error( [ 'message' => reset( $errors ), 'fields' => $errors ], 422 );
    }

    // ── 6. تسجيل Rate Limit قبل الإرسال ─────────────────────────
    set_transient( $transient_key, 1, 60 ); // 60 ثانية

    // ── 7. إرسال البريد ──────────────────────────────────────────
    $recipient = '';
    if ( function_exists( 'get_field' ) ) {
        $recipient = (string) get_field( 'contact_form_recipient', 'option' );
    }

    // Fallback لبريد أدمن WordPress
    if ( $recipient === '' || ! is_email( $recipient ) ) {
        $recipient = get_option( 'admin_email' );
    }

    $contact_via_label = match ( $contact_via ) {
        'phone'    => 'هاتف',
        'email'    => 'بريد إلكتروني',
        'whatsapp' => 'واتساب',
        default    => $contact_via,
    };

    // ملاحظة أمنية: لا نُدرج نص الرسالة الكامل في أي error log
    $subject = 'طلب تواصل جديد من موقع المكتب';

    // نبني جسم الرسالة يدويًا (لا نستخدم wp_mail_content_type html لتجنب أي خطر XSS في log)
    $body  = "اسم المُرسِل: {$full_name}\n";
    $body .= "رقم الهاتف: {$phone}\n";
    $body .= "وسيلة التواصل المفضّلة: {$contact_via_label}\n";

    if ( $email !== '' ) {
        $body .= "البريد الإلكتروني: {$email}\n";
    }

    $body .= "\nالرسالة:\n{$message}\n";
    $body .= "\n---\nتم الإرسال من: " . home_url() . "\n";
    $body .= "الوقت: " . current_time( 'mysql' ) . "\n";

    $headers = [
        'Content-Type: text/plain; charset=UTF-8',
        'From: موقع المكتب <noreply@' . wp_parse_url( home_url(), PHP_URL_HOST ) . '>',
    ];

    // إضافة Reply-To إذا توفّر البريد
    if ( $email !== '' ) {
        $headers[] = "Reply-To: {$full_name} <{$email}>";
    }

    $sent = wp_mail( $recipient, $subject, $body, $headers );

    if ( ! $sent ) {
        // لا نُعيد محتوى الرسالة في الخطأ
        wp_send_json_error( [ 'message' => 'تعذر إرسال الطلب حاليًا. يمكنك استخدام وسيلة التواصل المباشرة.' ], 500 );
    }

    wp_send_json_success( [ 'message' => 'تم إرسال طلبك بنجاح. سيتواصل المكتب معك بعد مراجعة البيانات.' ] );
}

/**
 * التحقق من صحة رقم الهاتف (مصري أو دولي).
 *
 * يقبل الأنماط:
 *  - مصري: 01x xxxxxxxx (11 رقم)
 *  - دولي:  +2 01x xxxxxxxx أو 002 01x...
 *  - دولي عام: +xxx ... (7–15 رقم)
 */
function mml_validate_phone( string $phone ): bool {
    $cleaned = preg_replace( '/[\s\-\(\)\.]+/', '', $phone );

    if ( $cleaned === null || $cleaned === '' ) {
        return false;
    }

    // مصري محلي: 01[0125]xxxxxxxx
    if ( preg_match( '/^01[0125][0-9]{8}$/', $cleaned ) ) {
        return true;
    }

    // مصري بكود دولي: +2 أو 002
    if ( preg_match( '/^(\+2|002)01[0125][0-9]{8}$/', $cleaned ) ) {
        return true;
    }

    // دولي عام: + ثم 7–15 رقم
    if ( preg_match( '/^\+[0-9]{7,15}$/', $cleaned ) ) {
        return true;
    }

    return false;
}

/**
 * يُرجع IP العميل مع مراعاة proxy شائعة (بدون ثقة عمياء).
 */
function mml_get_client_ip(): string {
    // نستخدم فقط REMOTE_ADDR كمصدر موثوق
    return isset( $_SERVER['REMOTE_ADDR'] )
        ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) )
        : '0.0.0.0';
}
