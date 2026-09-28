<?php
/**
 * Custom Post Type: Testimonial (آراء العملاء)
 *
 * Slug: testimonial | بدون أرشيف عام
 *
 * @package MohamedMohsenLawyer
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'init', 'mml_register_cpt_testimonial' );

function mml_register_cpt_testimonial(): void {

    $labels = [
        'name'               => 'آراء العملاء',
        'singular_name'      => 'رأي عميل',
        'add_new'            => 'إضافة رأي',
        'add_new_item'       => 'إضافة رأي جديد',
        'edit_item'          => 'تعديل الرأي',
        'new_item'           => 'رأي جديد',
        'view_item'          => 'عرض الرأي',
        'search_items'       => 'البحث في الآراء',
        'not_found'          => 'لا توجد آراء',
        'not_found_in_trash' => 'لا توجد آراء في المحذوفات',
        'menu_name'          => 'آراء العملاء',
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
        'menu_position'       => 9,
        'menu_icon'           => 'dashicons-format-quote',
        'supports'            => [ 'title', 'editor', 'thumbnail', 'revisions' ],
    ];

    register_post_type( 'testimonial', $args );
}
