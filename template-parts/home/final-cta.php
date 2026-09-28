<section class="section section--navy final-cta" aria-labelledby="cta-heading">
	<div class="final-cta__deco" aria-hidden="true"></div>
	<div class="container final-cta__inner">
		<span class="gold-rule gold-rule--center" aria-hidden="true"></span>
		<h2 id="cta-heading" class="section__title"><?php echo esc_html( st_l( 'هل تحتاج إلى مساعدة قانونية؟', 'Need legal assistance?' ) ); ?></h2>
		<p class="final-cta__desc"><?php echo esc_html( st_l(
			'تواصل مع المكتب عبر نموذج التواصل أو الوسائل المعتمدة. إرسال طلب التواصل لا يُنشئ علاقة محامٍ وموكل ولا يُعد قبولًا للقضية.',
			'Contact the firm via the form or approved channels. This does not create an attorney-client relationship.'
		) ); ?></p>
		<a href="<?php echo esc_url( mml_contact_action_url() ); ?>" target="_blank" rel="noopener noreferrer" class="btn btn--gold js-analytics-cta">
			<?php echo esc_html( st_l( 'تواصل عبر واتساب الآن', 'Contact on WhatsApp Now' ) ); ?>
		</a>
	</div>
</section>
