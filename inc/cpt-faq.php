<?php
/**
 * Custom Post Type: FAQ Item (الأسئلة الشائعة)
 *
 * Slug: faq_item | بدون أرشيف عام
 *
 * @package MohamedMohsenLawyer
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'init', 'mml_register_cpt_faq_item' );

function mml_register_cpt_faq_item(): void {

    $labels = [
        'name'               => 'الأسئلة الشائعة',
        'singular_name'      => 'سؤال شائع',
        'add_new'            => 'إضافة سؤال',
        'add_new_item'       => 'إضافة سؤال جديد',
        'edit_item'          => 'تعديل السؤال',
        'new_item'           => 'سؤال جديد',
        'view_item'          => 'عرض السؤال',
        'search_items'       => 'البحث في الأسئلة',
        'not_found'          => 'لا توجد أسئلة',
        'not_found_in_trash' => 'لا توجد أسئلة في المحذوفات',
        'menu_name'          => 'الأسئلة الشائعة',
    ];

    $args = [
        'labels'              => $labels,
        'public'              => false,        // لا يظهر في الواجهة الأمامية باستقلالية
        'publicly_queryable'  => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_rest'        => true,
        'query_var'           => true,
        'rewrite'             => false,
        'capability_type'     => 'post',
        'has_archive'         => false,        // لا أرشيف عام
        'hierarchical'        => false,
        'menu_position'       => 8,
        'menu_icon'           => 'dashicons-editor-help',
        'supports'            => [ 'title', 'editor', 'revisions' ],
    ];

    register_post_type( 'faq_item', $args );
}
