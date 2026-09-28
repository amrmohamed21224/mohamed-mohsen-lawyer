<?php
/**
 * SEO Meta Tags — title, description, Open Graph
 *
 * يطبع meta tags لكل صفحة بناءً على حقول ACF مع fallback
 * لعنوان الصفحة الافتراضي.
 *
 * حقول ACF المستخدمة (تُسجَّل في acf-fields.php):
 *   seo_title_ar, seo_title_en
 *   seo_description_ar, seo_description_en
 *   seo_og_image (image field)
 *
 * @package MohamedMohsenLawyer
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'wp_head', 'mml_print_seo_meta', 2 );

function mml_print_seo_meta(): void {

    $lang = st_current_lang();

    // ── Title ──────────────────────────────────
    $acf_title = '';
    if ( function_exists( 'get_field' ) ) {
        $acf_title = trim( (string) get_field( 'seo_title_' . $lang ) );
    }

    if ( $acf_title === '' ) {
        // Fallback: عنوان WordPress الافتراضي
        $queried = get_queried_object();
        if ( $queried instanceof WP_Post ) {
            $acf_title = get_the_title( $queried );
        } elseif ( is_home() || is_front_page() ) {
            $acf_title = get_bloginfo( 'name' );
        } else {
            $acf_title = get_bloginfo( 'name' );
        }
    }

    $site_name = get_bloginfo( 'name' );
    $full_title = $acf_title . ' | ' . $site_name;

    // ── Description ────────────────────────────
    $description = '';
    if ( function_exists( 'get_field' ) ) {
        $description = trim( (string) get_field( 'seo_description_' . $lang ) );
    }

    if ( $description === '' ) {
        $description = get_bloginfo( 'description' );
    }

    // ── OG Image ───────────────────────────────
    $og_image = '';
    if ( function_exists( 'get_field' ) ) {
        $og_img_field = get_field( 'seo_og_image' );
        if ( is_array( $og_img_field ) && isset( $og_img_field['url'] ) ) {
            $og_image = $og_img_field['url'];
        } elseif ( is_string( $og_img_field ) ) {
            $og_image = $og_img_field;
        }
    }

    // Fallback: صورة مميزة للمنشور إن وجدت
    if ( $og_image === '' && is_singular() ) {
        $queried = get_queried_object();
        if ( $queried instanceof WP_Post && has_post_thumbnail( $queried ) ) {
            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $queried ), 'large' );
            $og_image = $thumb ? $thumb[0] : '';
        }
    }

    // ── طباعة الـ Tags ─────────────────────────
    echo "\n<!-- SEO Meta -->\n";

    // Title tag (يُطبع هنا فقط إذا لم يتولَّ title-tag من WordPress)
    // في الغالب WordPress يدير <title> بنفسه عبر add_theme_support('title-tag')
    // لكن نضع og:title و og:description بشكل مستقل

    if ( $description !== '' ) {
        printf(
            '<meta name="description" content="%s">' . "\n",
            esc_attr( wp_strip_all_tags( $description ) )
        );
    }

    // Open Graph
    $current_url = is_singular() ? get_permalink() : home_url( add_query_arg( [], $GLOBALS['wp']->request ?? '' ) );
    printf( '<meta property="og:type" content="website">' . "\n" );
    printf( '<meta property="og:site_name" content="%s">' . "\n", esc_attr( $site_name ) );
    printf( '<meta property="og:title" content="%s">' . "\n", esc_attr( $full_title ) );
    printf( '<meta property="og:url" content="%s">' . "\n", esc_url( $current_url ) );

    if ( $description !== '' ) {
        printf(
            '<meta property="og:description" content="%s">' . "\n",
            esc_attr( wp_strip_all_tags( $description ) )
        );
    }

    if ( $og_image !== '' ) {
        printf( '<meta property="og:image" content="%s">' . "\n", esc_url( $og_image ) );
    }

    // Twitter Card
    printf( '<meta name="twitter:card" content="summary_large_image">' . "\n" );
    printf( '<meta name="twitter:title" content="%s">' . "\n", esc_attr( $full_title ) );

    if ( $description !== '' ) {
        printf(
            '<meta name="twitter:description" content="%s">' . "\n",
            esc_attr( wp_strip_all_tags( $description ) )
        );
    }

    if ( $og_image !== '' ) {
        printf( '<meta name="twitter:image" content="%s">' . "\n", esc_url( $og_image ) );
    }
}
