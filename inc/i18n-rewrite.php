<?php
/**
 * i18n Rewrite Rules — دعم روابط /ar/ و /en/
 *
 * @package MohamedMohsenLawyer
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter( 'query_vars', 'mml_register_lang_query_var' );

function mml_register_lang_query_var( array $vars ): array {
	$vars[] = 'site_lang';
	return $vars;
}

add_action( 'init', 'mml_add_lang_rewrite_rules' );

function mml_add_lang_rewrite_rules(): void {

	// Direct Articles archive & single (Arabic default)
	add_rewrite_rule(
		'^articles/?$',
		'index.php?post_type=post',
		'top'
	);

	add_rewrite_rule(
		'^articles/([^/]+)/?$',
		'index.php?name=$matches[1]&post_type=post',
		'top'
	);

	add_rewrite_rule(
		'^(ar|en)/?$',
		'index.php?site_lang=$matches[1]',
		'top'
	);

	// Articles archive
	add_rewrite_rule(
		'^(ar|en)/articles/?$',
		'index.php?site_lang=$matches[1]&post_type=post',
		'top'
	);

	// Articles single
	add_rewrite_rule(
		'^(ar|en)/articles/([^/]+)/?$',
		'index.php?site_lang=$matches[1]&name=$matches[2]&post_type=post',
		'top'
	);

	// Services archive
	add_rewrite_rule(
		'^(ar|en)/services/?$',
		'index.php?site_lang=$matches[1]&post_type=service',
		'top'
	);

	add_rewrite_rule(
		'^(ar|en)/services/([^/]+)/?$',
		'index.php?site_lang=$matches[1]&service=$matches[2]',
		'top'
	);

	add_rewrite_rule(
		'^(ar|en)/experience/?$',
		'index.php?site_lang=$matches[1]&post_type=case_outcome',
		'top'
	);

	add_rewrite_rule(
		'^(ar|en)/experience/([^/]+)/?$',
		'index.php?site_lang=$matches[1]&case_outcome=$matches[2]',
		'top'
	);

	add_rewrite_rule(
		'^(ar|en)/media/?$',
		'index.php?site_lang=$matches[1]&post_type=media_item',
		'top'
	);

	add_rewrite_rule(
		'^(ar|en)/media/([^/]+)/?$',
		'index.php?site_lang=$matches[1]&media_item=$matches[2]',
		'top'
	);

	add_rewrite_rule(
		'^(ar|en)/([^/]+)/?$',
		'index.php?site_lang=$matches[1]&pagename=$matches[2]',
		'top'
	);

	add_rewrite_rule(
		'^(ar|en)/([^/]+)/([^/]+)/?$',
		'index.php?site_lang=$matches[1]&pagename=$matches[2]/$matches[3]',
		'top'
	);
}

add_action( 'after_switch_theme', 'mml_flush_rewrite_on_activate' );

function mml_flush_rewrite_on_activate(): void {
	mml_add_lang_rewrite_rules();
	flush_rewrite_rules();
}

add_action( 'switch_theme', 'flush_rewrite_rules' );

/**
 * Force archive templates for lang-prefixed CPT archives.
 */
add_filter( 'template_include', 'mml_lang_archive_template', 99 );

function mml_lang_archive_template( string $template ): string {
	if ( is_home() ) {
		$found = locate_template( 'archive-article.php' );
		if ( $found ) {
			return $found;
		}
	}

	if ( ! is_post_type_archive() ) {
		return $template;
	}

	$map = [
		'service'      => 'archive-service.php',
		'case_outcome' => 'archive-case_outcome.php',
		'media_item'   => 'archive-media_item.php',
		'post'         => 'archive-article.php',
	];
	$pt = get_query_var( 'post_type' );
	if ( is_array( $pt ) ) {
		$pt = $pt[0] ?? '';
	}
	if ( isset( $map[ $pt ] ) ) {
		$found = locate_template( $map[ $pt ] );
		if ( $found ) {
			return $found;
		}
	}
	return $template;
}

add_filter( 'single_template', 'mml_lang_single_template' );

function mml_lang_single_template( string $template ): string {
	if ( is_singular( 'post' ) ) {
		$found = locate_template( 'single-article.php' );
		if ( $found ) {
			return $found;
		}
	}
	return $template;
}
