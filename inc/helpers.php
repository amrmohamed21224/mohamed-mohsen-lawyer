<?php
/**
 * Helpers — دوال مساعدة عامة
 *
 * @package MohamedMohsenLawyer
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @return string 'ar' | 'en'
 */
function st_current_lang(): string {
	$lang = get_query_var( 'site_lang', 'ar' );
	return in_array( $lang, [ 'ar', 'en' ], true ) ? $lang : 'ar';
}

function st_is_rtl(): bool {
	return st_current_lang() === 'ar';
}

function st_l( string $ar, string $en ): string {
	return st_current_lang() === 'ar' ? $ar : $en;
}

/**
 * URL مع بادئة اللغة (العربية افتراضية بدون بادئة، الإنجليزية ببادئة /en/).
 */
function mml_lang_url( string $path = '' ): string {
	$lang = st_current_lang();
	$path = trim( $path, '/' );

	if ( $lang === 'en' ) {
		return home_url( '/en/' . ( $path ? $path . '/' : '' ) );
	}

	return home_url( '/' . ( $path ? $path . '/' : '' ) );
}

/**
 * ACF option helper.
 */
function mml_get_option( string $field, mixed $default = '' ): mixed {
	$fallback_defaults = [
		'primary_phone'     => '01064397662',
		'whatsapp_number'   => '201064397662',
		'public_email'      => 'info@mohamed-mohsen-lawyer.com',
		'office_address_ar' => 'المنصورة، محافظة الدقهلية، مصر',
		'office_address_en' => 'Mansoura, Dakahlia Governorate, Egypt',
	];

	if ( ! function_exists( 'get_field' ) ) {
		return $fallback_defaults[ $field ] ?? $default;
	}
	$value = get_field( $field, 'option' );

	// إذا كانت القيمة فارغة أو تطابق الأرقام الوهمية القديمة نعيد الرقم الحقيقي المعتمد
	if ( $value === null || $value === false || $value === '' || $value === '01000000000' || $value === '201000000000' ) {
		return $fallback_defaults[ $field ] ?? $default;
	}
	return $value;
}

/**
 * ACF post field بلغة حالية.
 */
function mml_get_field_lang( int $post_id, string $base_name ): string {
	if ( ! function_exists( 'get_field' ) ) {
		return '';
	}
	$lang  = st_current_lang();
	$value = get_field( $base_name . '_' . $lang, $post_id );
	if ( $value ) {
		return (string) $value;
	}
	return (string) get_field( $base_name . '_ar', $post_id );
}

/**
 * تحويل صف FAQ من ACF إلى صيغة faq-accordion.
 */
function mml_map_faq_row( int $post_id ): array {
	return [
		'id'          => $post_id,
		'question_ar' => (string) get_field( 'faq_question_ar', $post_id ),
		'question_en' => (string) get_field( 'faq_question_en', $post_id ),
		'answer_ar'   => (string) get_field( 'faq_answer_ar', $post_id ),
		'answer_en'   => (string) get_field( 'faq_answer_en', $post_id ),
	];
}

/**
 * @return WP_Post[]
 */
function mml_get_faqs( int $limit = -1 ): array {
	$q = new WP_Query( [
		'post_type'      => 'faq_item',
		'posts_per_page' => $limit,
		'post_status'    => 'publish',
		'meta_key'       => 'faq_order',
		'orderby'        => 'meta_value_num',
		'order'          => 'ASC',
	] );
	return $q->posts;
}

/**
 * @return WP_Post[]
 */
function mml_get_services( int $limit = -1 ): array {
	$q = new WP_Query( [
		'post_type'      => 'service',
		'posts_per_page' => $limit,
		'post_status'    => 'publish',
		'meta_key'       => 'service_order',
		'orderby'        => 'meta_value_num',
		'order'          => 'ASC',
	] );
	return $q->posts;
}

/**
 * @return WP_Post[]
 */
function mml_get_case_outcomes( int $limit = -1 ): array {
	$q = new WP_Query( [
		'post_type'      => 'case_outcome',
		'posts_per_page' => $limit,
		'post_status'    => 'publish',
		'orderby'        => 'date',
		'order'          => 'DESC',
	] );
	return $q->posts;
}

/**
 * @return WP_Post[]
 */
function mml_get_media_items( int $limit = -1 ): array {
	$q = new WP_Query( [
		'post_type'      => 'media_item',
		'posts_per_page' => $limit,
		'post_status'    => 'publish',
		'orderby'        => 'date',
		'order'          => 'DESC',
	] );
	return $q->posts;
}

/**
 * @return WP_Post[]
 */
function mml_get_articles( int $limit = -1 ): array {
	$q = new WP_Query( [
		'post_type'      => 'post',
		'posts_per_page' => $limit,
		'post_status'    => 'publish',
		'orderby'        => 'date',
		'order'          => 'DESC',
	] );
	return $q->posts;
}

/**
 * @return WP_Post[]
 */
function mml_get_testimonials( int $limit = -1 ): array {
	$q = new WP_Query( [
		'post_type'      => 'testimonial',
		'posts_per_page' => $limit,
		'post_status'    => 'publish',
		'orderby'        => 'date',
		'order'          => 'DESC',
	] );
	return $q->posts;
}

function mml_count_published( string $post_type ): int {
	$counts = wp_count_posts( $post_type );
	return ( $counts && isset( $counts->publish ) ) ? (int) $counts->publish : 0;
}

function mml_has_experience_section(): bool {
	return mml_count_published( 'case_outcome' ) >= 2;
}

function mml_has_articles_section(): bool {
	return mml_count_published( 'post' ) >= 1;
}

function mml_has_media_section(): bool {
	return mml_count_published( 'media_item' ) >= 1;
}

function mml_service_permalink( WP_Post $post ): string {
	return mml_lang_url( 'services/' . $post->post_name );
}

function mml_case_permalink( WP_Post $post ): string {
	return mml_lang_url( 'experience/' . $post->post_name );
}

function mml_article_permalink( WP_Post $post ): string {
	return mml_lang_url( 'articles/' . $post->post_name );
}

function mml_media_permalink( WP_Post $post ): string {
	return mml_lang_url( 'media/' . $post->post_name );
}

/**
 * عنوان مقال/خدمة بلغة حالية.
 */
function mml_get_post_title_lang( WP_Post $post ): string {
	$map = [
		'service'      => 'service_title',
		'case_outcome' => 'case_title',
		'media_item'   => 'media_title',
		'post'         => 'article_title',
	];
	if ( isset( $map[ $post->post_type ] ) ) {
		$t = mml_get_field_lang( $post->ID, $map[ $post->post_type ] );
		if ( $t ) {
			return $t;
		}
	}
	return get_the_title( $post );
}

function mml_get_post_summary_lang( WP_Post $post ): string {
	$map = [
		'service'      => 'service_summary',
		'case_outcome' => 'case_summary',
		'media_item'   => 'media_source',
		'post'         => 'article_subtitle',
	];
	if ( isset( $map[ $post->post_type ] ) ) {
		$s = mml_get_field_lang( $post->ID, $map[ $post->post_type ] );
		if ( $s ) {
			return $s;
		}
	}
	return has_excerpt( $post ) ? get_the_excerpt( $post ) : wp_trim_words( wp_strip_all_tags( $post->post_content ), 30 );
}

function mml_is_service_placeholder( int $post_id ): bool {
	$title = mml_get_field_lang( $post_id, 'service_title' );
	return str_contains( $title, 'قيد الاعتماد' ) || str_contains( $title, '[خدمة' );
}

function mml_youtube_embed_url( string $url ): string {
	if ( preg_match( '/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $url, $m ) ) {
		return 'https://www.youtube-nocookie.com/embed/' . $m[1];
	}
	return $url;
}

function mml_format_phone_display( string $phone ): string {
	return $phone;
}

function mml_whatsapp_link( string $number, string $text = '' ): string {
	$clean = preg_replace( '/\D+/', '', $number );
	return 'https://wa.me/' . $clean . ( $text ? '?text=' . rawurlencode( $text ) : '' );
}

function mml_contact_action_url( string $custom_message = '' ): string {
	$whatsapp = (string) mml_get_option( 'whatsapp_number', '201064397662' );
	if ( ! $whatsapp || $whatsapp === '201000000000' ) {
		$whatsapp = '201064397662';
	}
	$default_msg = st_l( 'السلام عليكم، أود الاستفسار عن استشارة قانونية من مكتب المستشار محمد محسن.', 'Hello, I would like to inquire about a legal consultation.' );
	$msg = $custom_message ?: $default_msg;
	return mml_whatsapp_link( $whatsapp, $msg );
}

function mml_tel_link( string $phone ): string {
	return 'tel:' . preg_replace( '/\s+/', '', $phone );
}
