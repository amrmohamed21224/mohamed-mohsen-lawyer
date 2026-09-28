<?php
/**
 * Custom Post Type: Service (الخدمات القانونية)
 *
 * Slug: service | Archive slug: services
 *
 * @package MohamedMohsenLawyer
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'init', 'mml_register_cpt_service' );

function mml_register_cpt_service(): void {

    $labels = [
        'name'               => 'الخدمات القانونية',
        'singular_name'      => 'خدمة قانونية',
        'add_new'            => 'إضافة خدمة',
        'add_new_item'       => 'إضافة خدمة جديدة',
        'edit_item'          => 'تعديل الخدمة',
        'new_item'           => 'خدمة جديدة',
        'view_item'          => 'عرض الخدمة',
        'search_items'       => 'البحث في الخدمات',
        'not_found'          => 'لا توجد خدمات',
        'not_found_in_trash' => 'لا توجد خدمات في المحذوفات',
        'menu_name'          => 'الخدمات',
    ];

    $args = [
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_rest'        => true,   // مطلوب لتوافق ACF وأدوات REST
        'query_var'           => true,
        'rewrite'             => [ 'slug' => 'services', 'with_front' => false ],
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-portfolio',
        'supports'            => [ 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' ],
    ];

    register_post_type( 'service', $args );
}
