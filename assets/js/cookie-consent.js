/**
 * cookie-consent.js — Mohamed Mohsen Lawyer Theme
 *
 * إدارة بانر الكوكيز وحفظ موافقة المستخدم في localStorage.
 */

'use strict';

(function () {
	const STORAGE_KEY = 'mml_cookie_consent';
	const ACCEPTED_VAL = 'accepted';
	const REJECTED_VAL = 'rejected';
	const CUSTOM_PREFIX = 'custom:';

	function initCookieConsent() {
		const banner = document.getElementById('st-cookie-consent') || document.getElementById('mml-cookie-banner');
		if (!banner) return;

		const consent = localStorage.getItem(STORAGE_KEY);

		if (consent) {
			banner.hidden = true;
			return;
		}

		banner.hidden = false;

		const acceptBtn   = banner.querySelector('.js-cookie-accept') || document.getElementById('mml-cookie-accept');
		const rejectBtn   = banner.querySelector('.js-cookie-reject') || document.getElementById('mml-cookie-reject');
		const settingsBtn = banner.querySelector('.js-cookie-settings');
		const saveBtn     = banner.querySelector('.js-cookie-save');
		const settingsBox = document.getElementById('st-cookie-settings-panel');
		const analyticsCh = banner.querySelector('.js-cookie-analytics-toggle');

		if (acceptBtn) {
			acceptBtn.addEventListener('click', function () {
				localStorage.setItem(STORAGE_KEY, ACCEPTED_VAL);
				banner.hidden = true;
				window.dispatchEvent(new CustomEvent('mmlCookieAccepted', { detail: { analytics: true } }));
			});
		}

		if (rejectBtn) {
			rejectBtn.addEventListener('click', function () {
				localStorage.setItem(STORAGE_KEY, REJECTED_VAL);
				banner.hidden = true;
				window.dispatchEvent(new CustomEvent('mmlCookieRejected', { detail: { analytics: false } }));
			});
		}

		if (settingsBtn && settingsBox) {
			settingsBtn.addEventListener('click', function () {
				settingsBox.hidden = !settingsBox.hidden;
			});
		}

		if (saveBtn) {
			saveBtn.addEventListener('click', function () {
				const analyticsAllowed = analyticsCh ? analyticsCh.checked : false;
				localStorage.setItem(STORAGE_KEY, CUSTOM_PREFIX + (analyticsAllowed ? 'analytics' : 'none'));
				banner.hidden = true;
				if (analyticsAllowed) {
					window.dispatchEvent(new CustomEvent('mmlCookieAccepted', { detail: { analytics: true } }));
				} else {
					window.dispatchEvent(new CustomEvent('mmlCookieRejected', { detail: { analytics: false } }));
				}
			});
		}
	}

	document.addEventListener('DOMContentLoaded', initCookieConsent);
})();
