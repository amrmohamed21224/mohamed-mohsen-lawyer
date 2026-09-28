<?php
/**
 * Analytics Events — تتبع الأحداث
 *
 * هذا الملف يُعرِّف أسماء الأحداث القياسية للموقع.
 * الأحداث تُضاف كـ data-analytics-event على العناصر في HTML،
 * ويقرأها ملف assets/js/analytics-events.js لإرسالها لـ Google Analytics
 * أو أي أداة تتبع أخرى عند تفعيلها.
 *
 * لا تُسجَّل أي بيانات شخصية — فقط أسماء الأحداث.
 *
 * @package MohamedMohsenLawyer
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * قائمة أسماء الأحداث القياسية المستخدمة في الموقع.
 *
 * استخدم هذه الثوابت في template-parts عند إضافة data-analytics-event
 * لضمان توحيد أسماء الأحداث وتسهيل الصيانة.
 *
 * مثال الاستخدام في HTML:
 *   <a href="tel:..." data-analytics-event="<?php echo esc_attr( MML_EVENT_PHONE_CLICK ); ?>">
 *       اتصل بنا
 *   </a>
 */

// أحداث التواصل
define( 'MML_EVENT_PHONE_CLICK',        'contact_phone_click' );
define( 'MML_EVENT_WHATSAPP_CLICK',     'contact_whatsapp_click' );
define( 'MML_EVENT_EMAIL_CLICK',        'contact_email_click' );
define( 'MML_EVENT_MAPS_CLICK',         'contact_maps_click' );

// أحداث الفورم
define( 'MML_EVENT_FORM_START',         'contact_form_start' );
define( 'MML_EVENT_FORM_SUCCESS',       'contact_form_submit_success' );
define( 'MML_EVENT_FORM_ERROR',         'contact_form_submit_error' );

// أحداث المحتوى
define( 'MML_EVENT_SERVICE_VIEW',       'service_view' );
define( 'MML_EVENT_ARTICLE_VIEW',       'article_view' );
define( 'MML_EVENT_CASE_OUTCOME_VIEW',  'case_outcome_view' );
define( 'MML_EVENT_MEDIA_VIEW',         'media_item_view' );
define( 'MML_EVENT_VIDEO_PLAY',         'video_play' );
define( 'MML_EVENT_FAQ_EXPAND',         'faq_expand' );

// أحداث التنقل
define( 'MML_EVENT_CTA_CLICK',          'cta_click' );
define( 'MML_EVENT_NAV_CLICK',          'nav_click' );
define( 'MML_EVENT_SEARCH_SUBMIT',      'search_submit' );

// Cookie Consent
define( 'MML_EVENT_COOKIE_ACCEPT',      'cookie_consent_accept' );
define( 'MML_EVENT_COOKIE_REJECT',      'cookie_consent_reject' );

/**
 * يُضيف قائمة الأحداث إلى window.mmlAnalyticsEvents لـ JS.
 * يُمكِّن analytics-events.js من التحقق من صحة اسم الحدث قبل إرساله.
 */
add_action( 'wp_footer', 'mml_print_analytics_event_names', 1 );

function mml_print_analytics_event_names(): void {

    $events = [
        MML_EVENT_PHONE_CLICK,
        MML_EVENT_WHATSAPP_CLICK,
        MML_EVENT_EMAIL_CLICK,
        MML_EVENT_MAPS_CLICK,
        MML_EVENT_FORM_START,
        MML_EVENT_FORM_SUCCESS,
        MML_EVENT_FORM_ERROR,
        MML_EVENT_SERVICE_VIEW,
        MML_EVENT_ARTICLE_VIEW,
        MML_EVENT_CASE_OUTCOME_VIEW,
        MML_EVENT_MEDIA_VIEW,
        MML_EVENT_VIDEO_PLAY,
        MML_EVENT_FAQ_EXPAND,
        MML_EVENT_CTA_CLICK,
        MML_EVENT_NAV_CLICK,
        MML_EVENT_SEARCH_SUBMIT,
        MML_EVENT_COOKIE_ACCEPT,
        MML_EVENT_COOKIE_REJECT,
    ];

    echo '<script>window.mmlAnalyticsEvents = ' . wp_json_encode( $events ) . ';</script>' . "\n";
}
