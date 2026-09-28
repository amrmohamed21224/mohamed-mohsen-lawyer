<?php
/**
 * Custom Post Type: Case Outcome (سوابق قضائية / الخبرة)
 *
 * Slug: case_outcome | Archive slug: experience
 *
 * @package MohamedMohsenLawyer
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'init', 'mml_register_cpt_case_outcome' );

function mml_register_cpt_case_outcome(): void {

    $labels = [
        'name'               => 'السوابق القضائية',
        'singular_name'      => 'سابقة قضائية',
        'add_new'            => 'إضافة سابقة',
        'add_new_item'       => 'إضافة سابقة قضائية جديدة',
        'edit_item'          => 'تعديل السابقة',
        'new_item'           => 'سابقة جديدة',
        'view_item'          => 'عرض السابقة',
        'search_items'       => 'البحث في السوابق',
        'not_found'          => 'لا توجد سوابق قضائية',
        'not_found_in_trash' => 'لا توجد سوابق في المحذوفات',
        'menu_name'          => 'الخبرة القضائية',
    ];

    $args = [
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_rest'        => true,
        'query_var'           => true,
        'rewrite'             => [ 'slug' => 'experience', 'with_front' => false ],
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => 6,
        'menu_icon'           => 'dashicons-shield',
        'supports'            => [ 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' ],
    ];

    register_post_type( 'case_outcome', $args );
}
