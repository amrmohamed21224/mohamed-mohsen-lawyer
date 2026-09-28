/**
 * analytics-events.js
 */
'use strict';

(function () {
	const EVENT_MAP = {
		'js-analytics-phone': 'contact_phone_click',
		'js-analytics-whatsapp': 'contact_whatsapp_click',
		'js-analytics-cta': 'contact_cta_click',
	};

	function trackEvent(eventName, params) {
		if (!eventName) return;
		const allowed = window.mmlAnalyticsEvents || [];
		if (allowed.length > 0 && !allowed.includes(eventName)) return;
		if (typeof gtag === 'function') {
			gtag('event', eventName, params || {});
		}
	}

	window.mmlTrackEvent = trackEvent;

	function initAnalyticsEvents() {
		document.addEventListener('click', function (e) {
			Object.keys(EVENT_MAP).forEach(function (cls) {
				const el = e.target.closest('.' + cls);
				if (el) trackEvent(EVENT_MAP[cls]);
			});
			const dataEl = e.target.closest('[data-analytics-event]');
			if (dataEl) trackEvent(dataEl.dataset.analyticsEvent);
		});
	}

	document.addEventListener('DOMContentLoaded', initAnalyticsEvents);
})();
