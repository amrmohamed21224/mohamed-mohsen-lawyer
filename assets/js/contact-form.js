/**
 * contact-form.js
 */
'use strict';

(function () {
	function showFieldErrors(fields) {
		document.querySelectorAll('[data-error-for]').forEach(function (el) {
			el.hidden = true;
			el.textContent = '';
		});
		document.querySelectorAll('.st-form__input, .st-form__select, .st-form__textarea').forEach(function (el) {
			el.classList.remove('st-form__input--error');
		});
		if (!fields) return;
		Object.keys(fields).forEach(function (key) {
			const msg = fields[key];
			const errEl = document.querySelector('[data-error-for="' + key + '"]');
			const input = document.querySelector('[name="' + key + '"]');
			if (errEl) {
				errEl.textContent = msg;
				errEl.hidden = false;
			}
			if (input) input.classList.add('st-form__input--error');
		});
	}

	function initContactForm() {
		const form = document.getElementById('mml-contact-form');
		if (!form) return;

		const contactVia = form.querySelector('#contact_via');
		const emailGroup = form.querySelector('#email-group');
		const submitBtn = form.querySelector('#mml-form-submit');
		const feedback = form.querySelector('#mml-form-feedback');

		if (contactVia && emailGroup) {
			contactVia.addEventListener('change', function () {
				emailGroup.hidden = contactVia.value !== 'email';
			});
		}

		form.addEventListener('submit', async function (e) {
			e.preventDefault();
			showFieldErrors(null);
			if (feedback) feedback.hidden = true;

			const formData = new FormData(form);
			formData.append('action', 'submit_contact_form');
			formData.append('nonce', window.mmlContactForm?.nonce || '');

			if (submitBtn) submitBtn.classList.add('is-loading');

			try {
				const response = await fetch(window.mmlContactForm?.ajaxUrl || '', {
					method: 'POST',
					body: formData,
				});
				const data = await response.json();

				if (data.success) {
					const thankYou = window.mmlContactForm?.thankYouUrl;
					if (thankYou) {
						window.location.href = thankYou;
					} else if (feedback) {
						feedback.innerHTML = '<div class="st-form-success"><p>' + (data.data?.message || '') + '</p></div>';
						feedback.hidden = false;
						form.reset();
					}
				} else {
					if (data.data?.fields) {
						showFieldErrors(data.data.fields);
					}
					if (feedback) {
						feedback.innerHTML = '<div class="st-form-errors"><p>' + (data.data?.message || 'Error') + '</p></div>';
						feedback.hidden = false;
					}
				}
			} catch (err) {
				if (feedback) {
					feedback.innerHTML = '<div class="st-form-errors"><p>' + (document.documentElement.lang === 'ar' ? 'تعذر الاتصال بالخادم، برجاء المحاولة لاحقًا أو التواصل هاتفيًا.' : 'Network error, please try again or call directly.') + '</p></div>';
					feedback.hidden = false;
				}
			}

			if (submitBtn) submitBtn.classList.remove('is-loading');
		});
	}

	document.addEventListener('DOMContentLoaded', initContactForm);
})();
