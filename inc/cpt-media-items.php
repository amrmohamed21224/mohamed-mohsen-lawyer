<?php
/**
 * Custom Post Type: Media Item (مقابلات / إعلام)
 *
 * Slug: media_item | Archive slug: media
 *
 * @package MohamedMohsenLawyer
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'init', 'mml_register_cpt_media_item' );

function mml_register_cpt_media_item(): void {

    $labels = [
        'name'               => 'المقابلات الإعلامية',
        'singular_name'      => 'مقابلة إعلامية',
        'add_new'            => 'إضافة مقابلة',
        'add_new_item'       => 'إضافة مقابلة إعلامية جديدة',
        'edit_item'          => 'تعديل المقابلة',
        'new_item'           => 'مقابلة جديدة',
        'view_item'          => 'عرض المقابلة',
        'search_items'       => 'البحث في المقابلات',
        'not_found'          => 'لا توجد مقابلات',
        'not_found_in_trash' => 'لا توجد مقابلات في المحذوفات',
        'menu_name'          => 'الإعلام',
    ];

    $args = [
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_rest'        => true,
        'query_var'           => true,
        'rewrite'             => [ 'slug' => 'media', 'with_front' => false ],
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => 7,
        'menu_icon'           => 'dashicons-video-alt3',
        'supports'            => [ 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' ],
    ];

    register_post_type( 'media_item', $args );
}
