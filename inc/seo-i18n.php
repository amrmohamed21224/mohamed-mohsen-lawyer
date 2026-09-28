<?php
/**
 * SEO i18n — hreflang, canonical, و lang/dir attributes
 *
 * @package MohamedMohsenLawyer
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// ──────────────────────────────────────────────
// 1. hreflang + canonical في <head>
// ──────────────────────────────────────────────

add_action( 'wp_head', 'mml_print_hreflang_canonical', 1 );

function mml_print_hreflang_canonical(): void {

    $queried = get_queried_object();
    $slug    = '';

    if ( is_page() && $queried instanceof WP_Post ) {
        $slug = $queried->post_name ?: '';
    } elseif ( is_singular() && $queried instanceof WP_Post ) {
        $pt = $queried->post_type;
        $map = [
            'service'      => 'services',
            'case_outcome' => 'experience',
            'media_item'   => 'media',
            'post'         => 'articles',
        ];
        $prefix = $map[ $pt ] ?? '';
        $slug   = $prefix ? $prefix . '/' . $queried->post_name : $queried->post_name;
    } elseif ( is_post_type_archive( 'service' ) ) {
        $slug = 'services';
    } elseif ( is_post_type_archive( 'case_outcome' ) ) {
        $slug = 'experience';
    } elseif ( is_post_type_archive( 'media_item' ) ) {
        $slug = 'media';
    } elseif ( is_home() || is_category() || is_tag() ) {
        $slug = 'articles';
    }

    $canonical = mml_lang_url( $slug );

    echo "\n<!-- SEO Canonical -->\n";
    printf( '<link rel="canonical" href="%s">' . "\n", esc_url( $canonical ) );
}

// ──────────────────────────────────────────────
// 2. ضبط lang و dir في <html> — الواجهة الأمامية فقط
// ──────────────────────────────────────────────
// ⚠️ مهم: is_admin() guard ضروري هنا.
// بدونه، الفلتر بيتطبق على <html> في لوحة الأدمن أيضاً
// مما يتعارض مع آلية RTL الخاصة بـ WordPress ويكسر اتجاه السايدبار.
// WordPress يتولى dir/lang في الأدمن بنفسه بناءً على لغة المستخدم.

add_filter( 'language_attributes', 'mml_set_lang_dir_attributes' );

function mml_set_lang_dir_attributes( string $output ): string {

    // لا تتدخل في لوحة الأدمن — WordPress يديرها بنفسه
    if ( is_admin() ) {
        return $output;
    }

    $lang = st_current_lang();
    $dir  = st_is_rtl() ? 'rtl' : 'ltr';

    // استبدال القيم الموجودة أو إضافتها
    $output = preg_replace( '/lang="[^"]*"/', 'lang="' . esc_attr( $lang ) . '"', $output );
    $output = preg_replace( '/dir="[^"]*"/', 'dir="' . esc_attr( $dir ) . '"', $output );

    // إضافة dir إن لم تكن موجودة
    if ( ! str_contains( $output, 'dir=' ) ) {
        $output .= ' dir="' . esc_attr( $dir ) . '"';
    }

    return $output;
}
