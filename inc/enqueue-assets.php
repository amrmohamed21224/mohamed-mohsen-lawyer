<?php
/**
 * Enqueue Assets — تحميل ملفات CSS و JS وتحسين الأداء
 *
 * يُحمِّل كل ملفات assets/css/* و assets/js/* بالترتيب الصحيح
 * مع filemtime() لـ cache-busting تلقائي.
 *
 * يشمل:
 *  - تحميل الخطوط محليًا مع Preload في <head>
 *  - إضافة defer لكافة ملفات JavaScript لإلغاء Render-Blocking Resources
 *  - دمج تنسيقات RTL في main.css لتقليل طلبات الشبكة
 *
 * @package MohamedMohsenLawyer
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'wp_enqueue_scripts', 'mml_enqueue_assets' );

function mml_enqueue_assets(): void {

    $theme_uri = get_template_directory_uri();
    $theme_dir = get_template_directory();

    // ── CSS ──────────────────────────────────────────────────────

    // الملف الرئيسي (يحتوي @font-face وقواعد RTL مدمجة)
    wp_enqueue_style(
        'mml-main',
        $theme_uri . '/assets/css/main.css',
        [],
        mml_asset_version( $theme_dir . '/assets/css/main.css' )
    );

    // طباعة — يُحمَّل للطباعة فقط
    wp_enqueue_style(
        'mml-print',
        $theme_uri . '/assets/css/print.css',
        [ 'mml-main' ],
        mml_asset_version( $theme_dir . '/assets/css/print.css' ),
        'print'
    );

    // ── JS ───────────────────────────────────────────────────────

    // الملف الرئيسي
    wp_enqueue_script(
        'mml-main',
        $theme_uri . '/assets/js/main.js',
        [],
        mml_asset_version( $theme_dir . '/assets/js/main.js' ),
        true
    );

    // شريط التنقل للموبايل
    wp_enqueue_script(
        'mml-mobile-nav',
        $theme_uri . '/assets/js/mobile-nav.js',
        [ 'mml-main' ],
        mml_asset_version( $theme_dir . '/assets/js/mobile-nav.js' ),
        true
    );

    // فورم التواصل
    wp_enqueue_script(
        'mml-contact-form',
        $theme_uri . '/assets/js/contact-form.js',
        [ 'mml-main' ],
        mml_asset_version( $theme_dir . '/assets/js/contact-form.js' ),
        true
    );

    // Cookie Consent
    wp_enqueue_script(
        'mml-cookie-consent',
        $theme_uri . '/assets/js/cookie-consent.js',
        [ 'mml-main' ],
        mml_asset_version( $theme_dir . '/assets/js/cookie-consent.js' ),
        true
    );

    // Analytics Events
    wp_enqueue_script(
        'mml-analytics-events',
        $theme_uri . '/assets/js/analytics-events.js',
        [ 'mml-main' ],
        mml_asset_version( $theme_dir . '/assets/js/analytics-events.js' ),
        true
    );

    // ── تمرير بيانات PHP → JS ────────────────────────────────────
    wp_localize_script(
        'mml-contact-form',
        'mmlContactForm',
        [
            'ajaxUrl'     => admin_url( 'admin-ajax.php' ),
            'nonce'       => wp_create_nonce( 'mml_contact_form_nonce' ),
            'thankYouUrl' => mml_lang_url( 'thank-you' ),
        ]
    );
}

/**
 * إضافة خاصية defer لكافة اسكربتات القالب لمنع حظر عرض الصفحة (Render Blocking).
 */
add_filter( 'script_loader_tag', 'mml_defer_scripts', 10, 3 );
function mml_defer_scripts( string $tag, string $handle, string $src ): string {
    if ( is_admin() ) {
        return $tag;
    }

    if ( str_starts_with( $handle, 'mml-' ) ) {
        if ( ! str_contains( $tag, ' defer' ) ) {
            return str_replace( ' src=', ' defer src=', $tag );
        }
    }

    return $tag;
}

/**
 * تحميل الخطوط الأساسية مسبقًا (Preload Fonts) في <head> لتحسين FCP و LCP.
 */
add_action( 'wp_head', 'mml_preload_fonts', 0 );
function mml_preload_fonts(): void {
    $theme_uri = get_template_directory_uri();
    $theme_dir = get_template_directory();

    $fonts = [
        'IBMPlexSansArabic-Regular.ttf',
        'NotoKufiArabic-Bold.ttf',
        'NotoKufiArabic-Regular.ttf',
    ];

    foreach ( $fonts as $font_file ) {
        if ( file_exists( $theme_dir . '/assets/fonts/' . $font_file ) ) {
            echo '<link rel="preload" href="' . esc_url( $theme_uri . '/assets/fonts/' . $font_file ) . '" as="font" type="font/ttf" crossorigin>' . "\n";
        }
    }
}

/**
 * ترجع version آمنة للـ asset بناءً على تاريخ تعديل الملف.
 */
function mml_asset_version( string $file_path ): string {
    if ( file_exists( $file_path ) ) {
        return (string) filemtime( $file_path );
    }
    return '0.0.0';
}
