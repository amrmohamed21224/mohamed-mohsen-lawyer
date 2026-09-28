<?php
/**
 * ACF Local Field Groups
 *
 * يُسجَّل كل حقل نصي قابل للترجمة بنسختين: {field}_ar و {field}_en.
 * يتطلب: ACF Pro
 *
 * @package MohamedMohsenLawyer
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'acf/init', 'mml_register_acf_field_groups' );

function mml_register_acf_field_groups(): void {

    if ( ! function_exists( 'acf_add_local_field_group' ) ) { return; }

    // ── 1. SEO Fields (all post types + pages) ──────────────────
    acf_add_local_field_group( [
        'key'    => 'group_seo_fields',
        'title'  => 'SEO — تهيئة محركات البحث',
        'fields' => [
            [ 'key' => 'field_seo_title_ar',       'label' => 'عنوان الصفحة (عربي)',       'name' => 'seo_title_ar',       'type' => 'text',     'maxlength' => 70 ],
            [ 'key' => 'field_seo_title_en',       'label' => 'عنوان الصفحة (إنجليزي)',     'name' => 'seo_title_en',       'type' => 'text',     'maxlength' => 70 ],
            [ 'key' => 'field_seo_description_ar', 'label' => 'وصف الصفحة (عربي)',         'name' => 'seo_description_ar', 'type' => 'textarea', 'rows' => 3, 'maxlength' => 160 ],
            [ 'key' => 'field_seo_description_en', 'label' => 'وصف الصفحة (إنجليزي)',      'name' => 'seo_description_en', 'type' => 'textarea', 'rows' => 3, 'maxlength' => 160 ],
            [ 'key' => 'field_seo_og_image',       'label' => 'صورة Open Graph (1200×630)', 'name' => 'seo_og_image',       'type' => 'image',    'return_format' => 'array', 'preview_size' => 'medium' ],
        ],
        'location' => [
            [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'page' ] ],
            [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'post' ] ],
            [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'service' ] ],
            [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'case_outcome' ] ],
            [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'media_item' ] ],
        ],
        'menu_order' => 100, 'position' => 'normal',
    ] );

    // ── 2. Service Fields ────────────────────────────────────────
    acf_add_local_field_group( [
        'key'    => 'group_service_fields',
        'title'  => 'تفاصيل الخدمة',
        'fields' => [
            [ 'key' => 'field_service_title_ar',   'label' => 'عنوان الخدمة (عربي)',   'name' => 'service_title_ar',   'type' => 'text',     'required' => 1 ],
            [ 'key' => 'field_service_title_en',   'label' => 'عنوان الخدمة (إنجليزي)', 'name' => 'service_title_en',   'type' => 'text' ],
            [ 'key' => 'field_service_summary_ar', 'label' => 'ملخص الخدمة (عربي)',    'name' => 'service_summary_ar', 'type' => 'textarea', 'rows' => 4, 'required' => 1 ],
            [ 'key' => 'field_service_summary_en', 'label' => 'ملخص الخدمة (إنجليزي)', 'name' => 'service_summary_en', 'type' => 'textarea', 'rows' => 4 ],
            [ 'key' => 'field_service_icon',       'label' => 'أيقونة الخدمة',         'name' => 'service_icon',       'type' => 'image',    'return_format' => 'array' ],
            [ 'key' => 'field_service_icon_emoji', 'label' => 'أيقونة (emoji)',        'name' => 'service_icon_emoji', 'type' => 'text',     'instructions' => 'بديل للصورة — مثل ⚖' ],
            [ 'key' => 'field_service_description_ar', 'label' => 'الوصف الكامل (عربي)', 'name' => 'service_description_ar', 'type' => 'wysiwyg', 'toolbar' => 'basic' ],
            [ 'key' => 'field_service_description_en', 'label' => 'الوصف الكامل (إنجليزي)', 'name' => 'service_description_en', 'type' => 'wysiwyg', 'toolbar' => 'basic' ],
            [ 'key' => 'field_service_approach_ar', 'label' => 'منهج العمل (عربي)', 'name' => 'service_approach_ar', 'type' => 'textarea', 'rows' => 4 ],
            [ 'key' => 'field_service_approach_en', 'label' => 'منهج العمل (إنجليزي)', 'name' => 'service_approach_en', 'type' => 'textarea', 'rows' => 4 ],
            [ 'key' => 'field_service_required_info_ar', 'label' => 'معلومات مطلوبة (عربي)', 'name' => 'service_required_info_ar', 'type' => 'textarea', 'rows' => 3 ],
            [ 'key' => 'field_service_required_info_en', 'label' => 'معلومات مطلوبة (إنجليزي)', 'name' => 'service_required_info_en', 'type' => 'textarea', 'rows' => 3 ],
            [
                'key' => 'field_service_common_cases', 'label' => 'حالات شائعة', 'name' => 'service_common_cases', 'type' => 'repeater',
                'layout' => 'table', 'button_label' => 'إضافة حالة',
                'sub_fields' => [
                    [ 'key' => 'field_scc_ar', 'label' => 'الحالة (عربي)', 'name' => 'case_ar', 'type' => 'text' ],
                    [ 'key' => 'field_scc_en', 'label' => 'الحالة (إنجليزي)', 'name' => 'case_en', 'type' => 'text' ],
                ],
            ],
            [
                'key' => 'field_service_faq', 'label' => 'أسئلة شائعة للخدمة', 'name' => 'service_faq', 'type' => 'repeater',
                'layout' => 'row', 'button_label' => 'إضافة سؤال',
                'sub_fields' => [
                    [ 'key' => 'field_sfq_ar', 'label' => 'السؤال (عربي)', 'name' => 'question_ar', 'type' => 'text' ],
                    [ 'key' => 'field_sfq_en', 'label' => 'السؤال (إنجليزي)', 'name' => 'question_en', 'type' => 'text' ],
                    [ 'key' => 'field_sfa_ar', 'label' => 'الإجابة (عربي)', 'name' => 'answer_ar', 'type' => 'textarea', 'rows' => 3 ],
                    [ 'key' => 'field_sfa_en', 'label' => 'الإجابة (إنجليزي)', 'name' => 'answer_en', 'type' => 'textarea', 'rows' => 3 ],
                ],
            ],
            [ 'key' => 'field_service_order',      'label' => 'ترتيب العرض',            'name' => 'service_order',      'type' => 'number',   'default_value' => 0 ],
        ],
        'location' => [ [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'service' ] ] ],
        'menu_order' => 0, 'position' => 'normal',
    ] );

    // ── 3. Case Outcome Fields ───────────────────────────────────
    acf_add_local_field_group( [
        'key'    => 'group_case_outcome_fields',
        'title'  => 'تفاصيل السابقة القضائية',
        'fields' => [
            [ 'key' => 'field_case_title_ar',       'label' => 'عنوان القضية (عربي)',      'name' => 'case_title_ar',       'type' => 'text', 'required' => 1 ],
            [ 'key' => 'field_case_title_en',       'label' => 'عنوان القضية (إنجليزي)',   'name' => 'case_title_en',       'type' => 'text' ],
            [ 'key' => 'field_case_court_ar',       'label' => 'المحكمة / الدائرة (عربي)',  'name' => 'case_court_ar',       'type' => 'text', 'placeholder' => 'مثال: محكمة جنايات المنصورة' ],
            [ 'key' => 'field_case_court_en',       'label' => 'المحكمة / الدائرة (إنجليزي)','name' => 'case_court_en',     'type' => 'text' ],
            [ 'key' => 'field_case_category_ar',    'label' => 'تصنيف القضية (عربي)',      'name' => 'case_category_ar',    'type' => 'text' ],
            [ 'key' => 'field_case_category_en',    'label' => 'تصنيف القضية (إنجليزي)',   'name' => 'case_category_en',    'type' => 'text' ],
            [ 'key' => 'field_case_result_ar',      'label' => 'النتيجة والحكم (عربي)',    'name' => 'case_result_ar',      'type' => 'text' ],
            [ 'key' => 'field_case_result_en',      'label' => 'النتيجة والحكم (إنجليزي)', 'name' => 'case_result_en',      'type' => 'text' ],
            [ 'key' => 'field_case_year',           'label' => 'سنة القضية',               'name' => 'case_year',           'type' => 'number', 'min' => 1970, 'max' => 2100 ],
            [ 'key' => 'field_case_summary_ar',     'label' => 'ملخص الوقائع والاتهام (عربي)', 'name' => 'case_summary_ar', 'type' => 'textarea', 'rows' => 4, 'required' => 1 ],
            [ 'key' => 'field_case_summary_en',     'label' => 'ملخص الوقائع والاتهام (إنجليزي)', 'name' => 'case_summary_en', 'type' => 'textarea', 'rows' => 4 ],
            [ 'key' => 'field_case_defense_ar',     'label' => 'خطة الدفوع وأسانيد البراءة (عربي)', 'name' => 'case_defense_ar', 'type' => 'textarea', 'rows' => 4 ],
            [ 'key' => 'field_case_defense_en',     'label' => 'خطة الدفوع وأسانيد البراءة (إنجليزي)', 'name' => 'case_defense_en', 'type' => 'textarea', 'rows' => 4 ],
        ],
        'location' => [ [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'case_outcome' ] ] ],
        'menu_order' => 0, 'position' => 'normal',
    ] );

    // ── 4. Internal Data (case_outcome — admin only) ─────────────
    if ( current_user_can( 'administrator' ) ) {
        acf_add_local_field_group( [
            'key'    => 'group_internal_data',
            'title'  => '🔒 بيانات داخلية (للمسؤول فقط)',
            'fields' => [
                [ 'key' => 'field_client_consent_reference',   'label' => 'مرجع موافقة الموكّل',    'name' => 'client_consent_reference',   'type' => 'text', 'instructions' => 'مرجع وثيقة موافقة الموكل. لا يُعرض في الواجهة الأمامية.' ],
                [ 'key' => 'field_internal_approval_reference','label' => 'مرجع الموافقة الداخلية', 'name' => 'internal_approval_reference','type' => 'text', 'instructions' => 'رمز مرجعي للموافقة الداخلية. لا يُعرض في الواجهة الأمامية.' ],
            ],
            'location' => [ [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'case_outcome' ] ] ],
            'menu_order' => 50, 'position' => 'side',
        ] );
    }

    // ── 5. Media Item Fields ─────────────────────────────────────
    acf_add_local_field_group( [
        'key'    => 'group_media_item_fields',
        'title'  => 'تفاصيل الفيديو والمقابلة',
        'fields' => [
            [ 'key' => 'field_media_title_ar',    'label' => 'عنوان الفيديو (عربي)',    'name' => 'media_title_ar',    'type' => 'text', 'required' => 1 ],
            [ 'key' => 'field_media_title_en',    'label' => 'عنوان الفيديو (إنجليزي)', 'name' => 'media_title_en',    'type' => 'text' ],
            [ 'key' => 'field_media_video_url',   'label' => 'رابط الفيديو على فيسبوك أو يوتيوب', 'name' => 'media_video_url',   'type' => 'url', 'instructions' => 'ضع رابط الفيديو المباشر من صفحة الفيسبوك أو يوتيوب (عند الضغط ينتقل الزائر إليه مباشرة).' ],
            [ 'key' => 'field_media_thumbnail',   'label' => 'صورة غلاف الفيديو (Thumbnail)', 'name' => 'media_thumbnail', 'type' => 'image', 'return_format' => 'array', 'instructions' => 'ارفع صورة مأخوذة من الفيديو لتظهر كغلاف جذاب.' ],
            [ 'key' => 'field_media_source_ar',   'label' => 'المصدر / المنصة (عربي)',   'name' => 'media_source_ar',   'type' => 'text', 'default_value' => 'صفحة الفيسبوك الرسمية' ],
            [ 'key' => 'field_media_source_en',   'label' => 'المصدر / المنصة (إنجليزي)', 'name' => 'media_source_en', 'type' => 'text', 'default_value' => 'Official Facebook Page' ],
            [ 'key' => 'field_media_date',        'label' => 'تاريخ النشر',           'name' => 'media_date',        'type' => 'date_picker', 'display_format' => 'd/m/Y', 'return_format' => 'Y-m-d' ],
        ],
        'location' => [ [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'media_item' ] ] ],
        'menu_order' => 0, 'position' => 'normal',
    ] );

    // ── 6. FAQ Fields ────────────────────────────────────────────
    acf_add_local_field_group( [
        'key'    => 'group_faq_fields',
        'title'  => 'تفاصيل السؤال الشائع',
        'fields' => [
            [ 'key' => 'field_faq_question_ar', 'label' => 'السؤال (عربي)',    'name' => 'faq_question_ar', 'type' => 'text',    'required' => 1 ],
            [ 'key' => 'field_faq_question_en', 'label' => 'السؤال (إنجليزي)', 'name' => 'faq_question_en', 'type' => 'text' ],
            [ 'key' => 'field_faq_answer_ar',   'label' => 'الإجابة (عربي)',   'name' => 'faq_answer_ar',   'type' => 'wysiwyg', 'toolbar' => 'basic', 'required' => 1 ],
            [ 'key' => 'field_faq_answer_en',   'label' => 'الإجابة (إنجليزي)','name' => 'faq_answer_en',   'type' => 'wysiwyg', 'toolbar' => 'basic' ],
            [ 'key' => 'field_faq_order',       'label' => 'ترتيب العرض',      'name' => 'faq_order',       'type' => 'number',  'default_value' => 0 ],
        ],
        'location' => [ [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'faq_item' ] ] ],
        'menu_order' => 0, 'position' => 'normal',
    ] );

    // ── 7. Testimonial Fields ────────────────────────────────────
    acf_add_local_field_group( [
        'key'    => 'group_testimonial_fields',
        'title'  => 'تفاصيل رأي العميل',
        'fields' => [
            [ 'key' => 'field_testimonial_name_ar', 'label' => 'اسم العميل (عربي)',    'name' => 'testimonial_name_ar', 'type' => 'text',     'required' => 1 ],
            [ 'key' => 'field_testimonial_name_en', 'label' => 'اسم العميل (إنجليزي)', 'name' => 'testimonial_name_en', 'type' => 'text' ],
            [ 'key' => 'field_testimonial_text_ar', 'label' => 'نص التقييم (عربي)',    'name' => 'testimonial_text_ar', 'type' => 'textarea', 'rows' => 5, 'required' => 1 ],
            [ 'key' => 'field_testimonial_text_en', 'label' => 'نص التقييم (إنجليزي)', 'name' => 'testimonial_text_en', 'type' => 'textarea', 'rows' => 5 ],
            [ 'key' => 'field_testimonial_rating',  'label' => 'التقييم (1–5)',         'name' => 'testimonial_rating',  'type' => 'number',   'min' => 1, 'max' => 5, 'default_value' => 5 ],
            [ 'key' => 'field_testimonial_avatar',  'label' => 'صورة العميل',           'name' => 'testimonial_avatar',  'type' => 'image',    'return_format' => 'array' ],
        ],
        'location' => [ [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'testimonial' ] ] ],
        'menu_order' => 0, 'position' => 'normal',
    ] );

    // ── 8. Article extra fields (post) ───────────────────────────
    acf_add_local_field_group( [
        'key'    => 'group_article_fields',
        'title'  => 'تفاصيل المقال',
        'fields' => [
            [ 'key' => 'field_article_title_ar',    'label' => 'عنوان المقال (عربي)',      'name' => 'article_title_ar',    'type' => 'text' ],
            [ 'key' => 'field_article_title_en',    'label' => 'عنوان المقال (إنجليزي)',   'name' => 'article_title_en',    'type' => 'text' ],
            [ 'key' => 'field_article_subtitle_ar', 'label' => 'عنوان فرعي (عربي)',        'name' => 'article_subtitle_ar', 'type' => 'text' ],
            [ 'key' => 'field_article_subtitle_en', 'label' => 'عنوان فرعي (إنجليزي)',     'name' => 'article_subtitle_en', 'type' => 'text' ],
        ],
        'location' => [ [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'post' ] ] ],
        'menu_order' => 0, 'position' => 'normal',
    ] );

    acf_add_local_field_group( [
        'key'    => 'group_about_page',
        'title'  => 'محتوى صفحة عن المستشار',
        'fields' => [
            [ 'key' => 'field_about_bio_ar', 'label' => 'نبذة (عربي)', 'name' => 'about_bio_ar', 'type' => 'wysiwyg', 'toolbar' => 'basic' ],
            [ 'key' => 'field_about_bio_en', 'label' => 'نبذة (إنجليزي)', 'name' => 'about_bio_en', 'type' => 'wysiwyg', 'toolbar' => 'basic' ],
            [ 'key' => 'field_about_qualifications_ar', 'label' => 'المؤهلات (عربي)', 'name' => 'about_qualifications_ar', 'type' => 'textarea', 'rows' => 4, 'instructions' => 'Placeholder حتى اعتماد العميل' ],
            [ 'key' => 'field_about_qualifications_en', 'label' => 'المؤهلات (إنجليزي)', 'name' => 'about_qualifications_en', 'type' => 'textarea', 'rows' => 4 ],
        ],
        'location' => [ [ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-templates/page-about.php' ] ] ],
        'menu_order' => 0, 'position' => 'normal',
    ] );
}
