<?php
/**
 * Security Headers
 *
 * @package MohamedMohsenLawyer
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'send_headers', 'mml_send_security_headers' );

function mml_send_security_headers(): void {
	header( 'X-Frame-Options: SAMEORIGIN' );
	header( 'X-Content-Type-Options: nosniff' );
	header( 'Referrer-Policy: strict-origin-when-cross-origin' );

	$csp = implode( '; ', [
		"default-src 'self'",
		"script-src 'self' 'unsafe-inline'",
		"style-src 'self' 'unsafe-inline'",
		"img-src 'self' data: blob: https:",
		"font-src 'self'",
		"connect-src 'self'",
		"media-src 'self' https:",
		"frame-src 'self' https://www.google.com https://maps.google.com https://www.youtube-nocookie.com https://www.youtube.com",
		"object-src 'none'",
		"base-uri 'self'",
		"form-action 'self'",
	] );

	header( 'Content-Security-Policy: ' . $csp );
	header( 'Permissions-Policy: camera=(), microphone=(), geolocation=(), payment=()' );
}
