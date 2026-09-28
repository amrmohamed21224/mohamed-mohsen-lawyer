<?php
/**
 * Functions.php — Mohamed Mohsen Lawyer Theme
 *
 * نقطة الدخول الرئيسية للثيم. يستدعي كل ملفات inc/ ويسجّل
 * دعم الثيم وقوائم التنقل.
 *
 * @package MohamedMohsenLawyer
 * @version 0.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// ──────────────────────────────────────────────
// 1. تحميل ملفات inc/ بالترتيب الصحيح
// ──────────────────────────────────────────────

// الأدوات المساعدة أولاً — بقية الملفات تعتمد عليها
require_once get_template_directory() . '/inc/helpers.php';

// إعادة الكتابة والـ i18n
require_once get_template_directory() . '/inc/i18n-rewrite.php';

// SEO
require_once get_template_directory() . '/inc/seo-i18n.php';
require_once get_template_directory() . '/inc/seo-meta.php';

// Custom Post Types
require_once get_template_directory() . '/inc/cpt-services.php';
require_once get_template_directory() . '/inc/cpt-case-outcomes.php';
require_once get_template_directory() . '/inc/cpt-media-items.php';
require_once get_template_directory() . '/inc/cpt-faq.php';
require_once get_template_directory() . '/inc/cpt-testimonials.php';

// ACF
require_once get_template_directory() . '/inc/acf-fields.php';
require_once get_template_directory() . '/inc/acf-options-page.php';

// Assets / Enqueue
require_once get_template_directory() . '/inc/enqueue-assets.php';

// Security
require_once get_template_directory() . '/inc/security-headers.php';

// Form Handler
require_once get_template_directory() . '/inc/form-handler.php';

// Analytics
require_once get_template_directory() . '/inc/analytics-events.php';

// ──────────────────────────────────────────────
// 2. Theme Support + Textdomain
// ──────────────────────────────────────────────

add_action( 'after_setup_theme', 'mml_theme_setup' );

function mml_theme_setup(): void {

    // تحميل ترجمات الثيم — يجب أن يكون هنا داخل after_setup_theme
    // وليس في مكان مبكر لتجنب Notice: _load_textdomain_just_in_time
    load_theme_textdomain(
        'mohamed-mohsen-lawyer',
        get_template_directory() . '/languages'
    );

    // إدارة <title> عبر WordPress
    add_theme_support( 'title-tag' );

    // صور مميزة
    add_theme_support( 'post-thumbnails' );

    // HTML5 للعناصر الشائعة
    add_theme_support(
        'html5',
        [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        ]
    );

    // دعم عرض الكتل الموسّع (Gutenberg)
    add_theme_support( 'align-wide' );

    // صور الرأس والخلفية — غير مفعّلة حاليًا، تُفعَّل لاحقًا عند الحاجة
    // add_theme_support( 'custom-header' );
    // add_theme_support( 'custom-background' );
}

// ──────────────────────────────────────────────
// 3. قوائم التنقل
// ──────────────────────────────────────────────

add_action( 'after_setup_theme', 'mml_register_menus' );

function mml_register_menus(): void {
    register_nav_menus(
        [
            'primary' => __( 'القائمة الرئيسية', 'mohamed-mohsen-lawyer' ),
            'footer'  => __( 'قائمة الفوتر', 'mohamed-mohsen-lawyer' ),
        ]
    );
}

/**
 * Fallback menu when no primary menu is assigned yet in Appearance -> Menus.
 * يعرض صفحات الموقع الأساسية المعتمدة في شريط التنقل.
 */
function mml_primary_menu_fallback( array $args ): void {
	$links = [
		[ 'title' => st_l( 'الرئيسية', 'Home' ), 'url' => mml_lang_url( '' ) ],
		[ 'title' => st_l( 'عن المستشار', 'About' ), 'url' => mml_lang_url( 'about' ) ],
		[ 'title' => st_l( 'الخدمات القانونية', 'Services' ), 'url' => mml_lang_url( 'services' ) ],
		[ 'title' => st_l( 'الخبرات والنتائج', 'Experience' ), 'url' => mml_lang_url( 'experience' ) ],
		[ 'title' => st_l( 'الفيديوهات', 'Media' ), 'url' => mml_lang_url( 'media' ) ],
	];

	$menu_class = ! empty( $args['menu_class'] ) ? esc_attr( $args['menu_class'] ) : 'site-header__menu';

	echo '<ul class="' . $menu_class . '">';
	foreach ( $links as $link ) {
		echo '<li><a href="' . esc_url( $link['url'] ) . '">' . esc_html( $link['title'] ) . '</a></li>';
	}
	echo '</ul>';
}

/**
 * إخفاء روابط المقالات وتواصل معنا من القائمة الرئيسية في حال كانت مخصصة من مظهر -> قوائم
 */
add_filter( 'wp_nav_menu_objects', 'mml_filter_primary_nav_items', 10, 2 );
function mml_filter_primary_nav_items( $items, $args ) {
	if ( is_array( $items ) && isset( $args->theme_location ) && $args->theme_location === 'primary' ) {
		$hidden_slugs = [ 'articles', 'contact' ];
		foreach ( $items as $key => $item ) {
			$url   = $item->url ?? '';
			$title = mb_strtolower( trim( $item->title ?? '' ) );
			foreach ( $hidden_slugs as $slug ) {
				if ( str_contains( $url, '/' . $slug ) ) {
					unset( $items[ $key ] );
					break;
				}
			}
			if ( in_array( $title, [ 'المقالات', 'تواصل معنا', 'articles', 'contact' ], true ) ) {
				unset( $items[ $key ] );
			}
		}
	}
	return $items;
}

/**
 * توجيه أي محاولة فتح مباشرة لصفحات المقالات أو صفحة التواصل إلى الواتساب والرئيسية
 */
add_action( 'template_redirect', 'mml_redirect_disabled_routes' );
function mml_redirect_disabled_routes(): void {
	if ( is_admin() ) {
		return;
	}

	// توجيه صفحة تواصل معنا مباشرة إلى الواتساب
	if ( is_page( 'contact' ) || ( is_page() && get_post_field( 'post_name', get_queried_object_id() ) === 'contact' ) ) {
		wp_redirect( mml_contact_action_url(), 302 );
		exit;
	}

	// توجيه أي محاولة لدخول صفحة المقالات إلى الرئيسية
	if ( is_home() || is_post_type_archive( 'post' ) || is_singular( 'post' ) || is_category() || is_tag() ) {
		wp_safe_redirect( mml_lang_url( '' ), 301 );
		exit;
	}
}
