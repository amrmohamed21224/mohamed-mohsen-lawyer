/**
 * main.js
 */
'use strict';

function initFaqAccordion() {
	document.querySelectorAll( '.js-faq-toggle' ).forEach( function ( btn ) {
		btn.addEventListener( 'click', function () {
			const expanded = btn.getAttribute( 'aria-expanded' ) === 'true';
			const panel = document.getElementById( btn.getAttribute( 'aria-controls' ) );
			if ( ! panel ) return;
			btn.setAttribute( 'aria-expanded', String( ! expanded ) );
			if ( expanded ) {
				panel.setAttribute( 'hidden', '' );
			} else {
				panel.removeAttribute( 'hidden' );
			}
		} );
	} );
}

function initMapConsent() {
	document.querySelectorAll( '.st-map-consent' ).forEach( function ( wrapper ) {
		const loadBtn = wrapper.querySelector( '.js-map-consent-load' );
		const placeholder = wrapper.querySelector( '.js-map-consent-placeholder' );
		const frame = wrapper.querySelector( '.js-map-consent-frame' );
		const mapsUrl = wrapper.getAttribute( 'data-maps-url' );
		if ( ! loadBtn || ! frame || ! mapsUrl ) return;

		loadBtn.addEventListener( 'click', function () {
			const iframe = document.createElement( 'iframe' );
			iframe.src = mapsUrl;
			iframe.loading = 'lazy';
			iframe.referrerPolicy = 'no-referrer-when-downgrade';
			iframe.title = document.documentElement.lang === 'ar' ? 'خريطة موقع المكتب' : 'Office map';
			iframe.width = '100%';
			iframe.height = '100%';
			frame.appendChild( iframe );
			frame.removeAttribute( 'hidden' );
			placeholder.setAttribute( 'hidden', '' );
		} );
	} );
}

function initMediaEmbed() {
	document.querySelectorAll( '.st-media-embed' ).forEach( function ( wrapper ) {
		const loadBtn = wrapper.querySelector( '.js-media-consent-load' );
		const placeholder = wrapper.querySelector( '.js-media-consent-placeholder' );
		const frame = wrapper.querySelector( '.js-media-consent-frame' );
		const videoUrl = wrapper.getAttribute( 'data-video-url' );
		if ( ! loadBtn || ! frame || ! videoUrl ) return;

		loadBtn.addEventListener( 'click', function () {
			const iframe = document.createElement( 'iframe' );
			iframe.src = videoUrl;
			iframe.loading = 'lazy';
			iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';
			iframe.allowFullscreen = true;
			iframe.title = document.documentElement.lang === 'ar' ? 'فيديو' : 'Video';
			iframe.width = '100%';
			iframe.height = '100%';
			frame.appendChild( iframe );
			frame.removeAttribute( 'hidden' );
			placeholder.setAttribute( 'hidden', '' );
		} );
	} );
}

document.addEventListener( 'DOMContentLoaded', function () {
	initFaqAccordion();
	initMapConsent();
	initMediaEmbed();
} );
