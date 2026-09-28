<?php
/**
 * ACF Options Page — إعدادات الموقع
 *
 * يُنشئ صفحة خيارات عامة (Options Page) في ACF Pro تحتوي على
 * إعدادات الموقع المشتركة بين كل الصفحات.
 *
 * يتطلب: ACF Pro
 *
 * @package MohamedMohsenLawyer
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'acf/init', 'mml_register_acf_options_page' );

function mml_register_acf_options_page(): void {

    if ( ! function_exists( 'acf_add_options_page' ) ) {
        return;
    }

    acf_add_options_page( [
        'page_title'  => 'إعدادات الموقع',
        'menu_title'  => 'إعدادات الموقع',
        'menu_slug'   => 'mml-site-settings',
        'capability'  => 'manage_options',
        'icon_url'    => 'dashicons-admin-site-alt3',
        'position'    => 2,
        'redirect'    => false,
    ] );

    // ── حقول صفحة الخيارات ──────────────────────────────────────
    acf_add_local_field_group( [
        'key'    => 'group_site_options',
        'title'  => 'إعدادات الموقع العامة',
        'fields' => [

            // ─ معلومات التواصل ─
            [
                'key'   => 'field_opt_tab_contact',
                'label' => 'معلومات التواصل',
                'name'  => '',
                'type'  => 'tab',
            ],
            [
                'key'          => 'field_opt_primary_phone',
                'label'        => 'رقم الهاتف الرئيسي',
                'name'         => 'primary_phone',
                'type'         => 'text',
                'instructions' => 'يُستخدم في زر الاتصال (tel:). مثال: 01012345678',
                'required'     => 1,
            ],
            [
                'key'          => 'field_opt_lawyer_photo',
                'label'        => 'صورة المحامي (الهيرو والصفحة الرئيسية)',
                'name'         => 'lawyer_photo',
                'type'         => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'instructions' => 'صورة شخصية رسمية للأستاذ محمد محسن لتظهر داخل دائرة الهيرو.',
            ],
            [
                'key'          => 'field_opt_lawyer_about_photo',
                'label'        => 'صورة المحامي (صفحة عن المستشار)',
                'name'         => 'lawyer_about_photo',
                'type'         => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'instructions' => 'الصورة الشخصية لبطاقة التعريف في صفحة عن المستشار.',
            ],
            [
                'key'          => 'field_opt_whatsapp_number',
                'label'        => 'رقم واتساب',
                'name'         => 'whatsapp_number',
                'type'         => 'text',
                'instructions' => 'بصيغة دولية بدون + . مثال: 201012345678',
                'required'     => 1,
            ],
            [
                'key'      => 'field_opt_public_email',
                'label'    => 'البريد الإلكتروني العام',
                'name'     => 'public_email',
                'type'     => 'email',
                'required' => 0,
            ],
            [
                'key'   => 'field_opt_office_address_ar',
                'label' => 'عنوان المكتب (عربي)',
                'name'  => 'office_address_ar',
                'type'  => 'textarea',
                'rows'  => 3,
            ],
            [
                'key'   => 'field_opt_office_address_en',
                'label' => 'عنوان المكتب (إنجليزي)',
                'name'  => 'office_address_en',
                'type'  => 'textarea',
                'rows'  => 3,
            ],
            [
                'key'          => 'field_opt_google_maps_url',
                'label'        => 'رابط Google Maps',
                'name'         => 'google_maps_url',
                'type'         => 'url',
                'instructions' => 'رابط الموقع على خرائط Google لزر "الاتجاهات".',
            ],

            // ─ ساعات العمل ─
            [
                'key'   => 'field_opt_tab_hours',
                'label' => 'ساعات العمل',
                'name'  => '',
                'type'  => 'tab',
            ],
            [
                'key'          => 'field_opt_working_hours',
                'label'        => 'ساعات العمل',
                'name'         => 'working_hours',
                'type'         => 'repeater',
                'layout'       => 'table',
                'button_label' => 'إضافة يوم',
                'sub_fields'   => [
                    [
                        'key'   => 'field_opt_wh_day_ar',
                        'label' => 'اليوم (عربي)',
                        'name'  => 'day_ar',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_opt_wh_day_en',
                        'label' => 'اليوم (إنجليزي)',
                        'name'  => 'day_en',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_opt_wh_hours_ar',
                        'label' => 'الوقت (عربي)',
                        'name'  => 'hours_ar',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_opt_wh_hours_en',
                        'label' => 'الوقت (إنجليزي)',
                        'name'  => 'hours_en',
                        'type'  => 'text',
                    ],
                ],
            ],

            // ─ التواصل الاجتماعي ─
            [
                'key'   => 'field_opt_tab_social',
                'label' => 'التواصل الاجتماعي',
                'name'  => '',
                'type'  => 'tab',
            ],
            [
                'key'          => 'field_opt_social_links',
                'label'        => 'روابط التواصل الاجتماعي',
                'name'         => 'social_links',
                'type'         => 'repeater',
                'layout'       => 'table',
                'button_label' => 'إضافة منصة',
                'sub_fields'   => [
                    [
                        'key'     => 'field_opt_sl_platform',
                        'label'   => 'المنصة',
                        'name'    => 'platform',
                        'type'    => 'select',
                        'choices' => [
                            'facebook'  => 'Facebook',
                            'twitter'   => 'Twitter / X',
                            'linkedin'  => 'LinkedIn',
                            'youtube'   => 'YouTube',
                            'instagram' => 'Instagram',
                            'tiktok'    => 'TikTok',
                            'snapchat'  => 'Snapchat',
                            'other'     => 'أخرى',
                        ],
                    ],
                    [
                        'key'   => 'field_opt_sl_url',
                        'label' => 'الرابط',
                        'name'  => 'url',
                        'type'  => 'url',
                    ],
                ],
            ],

            // ─ إعدادات الفوتر والفورم ─
            [
                'key'   => 'field_opt_tab_misc',
                'label' => 'متفرقات',
                'name'  => '',
                'type'  => 'tab',
            ],
            [
                'key'   => 'field_opt_footer_disclaimer_ar',
                'label' => 'نص إخلاء مسؤولية الفوتر (عربي)',
                'name'  => 'footer_disclaimer_ar',
                'type'  => 'textarea',
                'rows'  => 4,
            ],
            [
                'key'   => 'field_opt_footer_disclaimer_en',
                'label' => 'نص إخلاء مسؤولية الفوتر (إنجليزي)',
                'name'  => 'footer_disclaimer_en',
                'type'  => 'textarea',
                'rows'  => 4,
            ],
            [
                'key'          => 'field_opt_contact_form_recipient',
                'label'        => 'بريد استلام رسائل فورم التواصل',
                'name'         => 'contact_form_recipient',
                'type'         => 'email',
                'instructions' => 'البريد الإلكتروني الذي تُرسَل إليه رسائل فورم التواصل.',
                'required'     => 1,
            ],
        ],
        'location' => [
            [
                [ 'param' => 'options_page', 'operator' => '==', 'value' => 'mml-site-settings' ],
            ],
        ],
        'menu_order' => 0,
        'position'   => 'normal',
    ] );
}
