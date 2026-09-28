<?php
/**
 * Contact form — matches form-handler.php field contract
 */
?>
<form id="mml-contact-form" class="st-form" method="post" novalidate>
	<div id="mml-form-feedback" hidden></div>

	<div class="st-form__group">
		<label class="st-form__label" for="full_name"><?php echo esc_html( st_l( 'الاسم الكامل', 'Full name' ) ); ?> <span class="st-form__required">*</span></label>
		<input type="text" id="full_name" name="full_name" class="st-form__input" autocomplete="name" required>
		<p class="st-form__error" data-error-for="full_name" hidden></p>
	</div>

	<div class="st-form__group">
		<label class="st-form__label" for="phone"><?php echo esc_html( st_l( 'رقم الهاتف', 'Phone' ) ); ?> <span class="st-form__required">*</span></label>
		<input type="tel" id="phone" name="phone" class="st-form__input" autocomplete="tel" required>
		<p class="st-form__error" data-error-for="phone" hidden></p>
	</div>

	<div class="st-form__group">
		<label class="st-form__label" for="contact_via"><?php echo esc_html( st_l( 'وسيلة التواصل المفضّلة', 'Preferred contact method' ) ); ?> <span class="st-form__required">*</span></label>
		<select id="contact_via" name="contact_via" class="st-form__select" required>
			<option value=""><?php echo esc_html( st_l( '— اختر —', '— Select —' ) ); ?></option>
			<option value="phone"><?php echo esc_html( st_l( 'هاتف', 'Phone' ) ); ?></option>
			<option value="whatsapp">WhatsApp</option>
			<option value="email"><?php echo esc_html( st_l( 'بريد إلكتروني', 'Email' ) ); ?></option>
		</select>
		<p class="st-form__error" data-error-for="contact_via" hidden></p>
	</div>

	<div class="st-form__group" id="email-group" hidden>
		<label class="st-form__label" for="email"><?php echo esc_html( st_l( 'البريد الإلكتروني', 'Email' ) ); ?></label>
		<input type="email" id="email" name="email" class="st-form__input" autocomplete="email">
		<p class="st-form__error" data-error-for="email" hidden></p>
	</div>

	<div class="st-form__group">
		<label class="st-form__label" for="message"><?php echo esc_html( st_l( 'موضوع التواصل', 'Message' ) ); ?> <span class="st-form__required">*</span></label>
		<textarea id="message" name="message" class="st-form__textarea" rows="5" minlength="20" maxlength="1000" required></textarea>
		<p class="st-form__error" data-error-for="message" hidden></p>
	</div>

	<div class="st-form__group st-form__checkbox">
		<input type="checkbox" id="privacy_agree" name="privacy_agree" value="1" required>
		<label for="privacy_agree">
			<?php echo esc_html( st_l( 'أوافق على', 'I agree to the' ) ); ?>
			<a href="<?php echo esc_url( mml_lang_url( 'legal-disclaimer' ) ); ?>" target="_blank" rel="noopener">
				<?php echo esc_html( st_l( 'إخلاء المسؤولية', 'legal disclaimer' ) ); ?>
			</a>
			<?php echo esc_html( st_l( ' وأقر بأن إرسال هذا النموذج لا يُنشئ علاقة محامٍ وموكل.', ' and understand this form does not create an attorney-client relationship.' ) ); ?>
		</label>
	</div>
	<p class="st-form__error" data-error-for="privacy_agree" hidden></p>

	<div class="st-form__honeypot" aria-hidden="true">
		<label for="website_url">Website</label>
		<input type="text" id="website_url" name="website_url" tabindex="-1" autocomplete="off">
	</div>

	<input type="hidden" name="nonce" value="<?php echo esc_attr( wp_create_nonce( 'mml_contact_form_nonce' ) ); ?>">

	<div class="st-form__submit">
		<button type="submit" class="btn btn--navy" id="mml-form-submit">
			<?php echo esc_html( st_l( 'إرسال الطلب', 'Submit request' ) ); ?>
		</button>
	</div>

	<p class="st-confidentiality" style="margin-top:1rem">
		<?php echo esc_html( st_l(
			'لا تُرفَع أي مستندات عبر هذا النموذج. يُرجى تسليم المستندات شخصيًا للمكتب.',
			'No documents can be uploaded via this form. Please deliver documents in person.'
		) ); ?>
	</p>
</form>
