<?php
/**
 * Floating Contact Buttons — أزرار التواصل العائمة مع أيقونات SVG رسمية
 */
$phone    = mml_get_option( 'primary_phone', '01064397662' );
$whatsapp = mml_get_option( 'whatsapp_number', '201064397662' );

if ( ! $phone && ! $whatsapp ) {
	return;
}
?>
<div class="floating-contact" aria-label="<?php echo esc_attr( st_l( 'تواصل سريع', 'Quick contact' ) ); ?>">
	<?php if ( $phone ) : ?>
		<a
			href="<?php echo esc_url( mml_tel_link( $phone ) ); ?>"
			class="floating-contact__btn floating-contact__btn--phone js-analytics-phone"
			aria-label="<?php echo esc_attr( st_l( 'اتصال هاتفي', 'Phone Call' ) ); ?>"
		>
			<svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
				<path d="M6.62 10.79a15.053 15.053 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1.01-.24c1.12.37 2.33.57 3.58.57.55 0 1 .45 1 1V20a1 1 0 0 1-1 1A17 17 0 0 1 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.25.2 2.46.57 3.58.11.34.03.73-.25 1.01l-2.2 2.2z"/>
			</svg>
		</a>
	<?php endif; ?>

	<?php if ( $whatsapp ) : ?>
		<a
			href="<?php echo esc_url( mml_whatsapp_link( $whatsapp ) ); ?>"
			class="floating-contact__btn floating-contact__btn--whatsapp js-analytics-whatsapp"
			target="_blank"
			rel="noopener noreferrer"
			aria-label="<?php echo esc_attr( st_l( 'محادثة واتساب', 'WhatsApp Chat' ) ); ?>"
		>
			<svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
				<path d="M12.031 0C5.397 0 .012 5.385.012 12.019c0 2.119.553 4.185 1.605 6.008L0 24l6.167-1.618a11.97 11.97 0 0 0 5.864 1.528h.005c6.633 0 12.018-5.385 12.018-12.019A12.03 12.03 0 0 0 12.031 0zm0 21.996h-.004a9.98 9.98 0 0 1-5.093-1.393l-.365-.216-3.784.992 1.01-3.689-.237-.377A9.97 9.97 0 0 1 2.03 12.02c0-5.514 4.488-10.001 10.005-10.001a9.96 9.96 0 0 1 7.073 2.932 9.96 9.96 0 0 1 2.933 7.071c0 5.515-4.488 10.002-10.01 10.002zm5.485-7.487c-.301-.15-1.78-.878-2.056-.978-.276-.101-.477-.15-.678.15-.201.301-.778.978-.954 1.179-.176.201-.352.226-.653.075-.301-.15-1.272-.469-2.423-1.496-.895-.798-1.5-1.784-1.676-2.085-.176-.301-.019-.464.132-.614.136-.135.301-.351.452-.527.15-.175.201-.301.301-.502.101-.201.05-.376-.025-.527-.075-.15-.678-1.632-.929-2.235-.245-.587-.494-.507-.678-.517-.176-.008-.376-.01-.577-.01-.201 0-.527.075-.803.376-.276.301-1.054 1.029-1.054 2.51 0 1.481 1.079 2.91 1.23 3.111.15.201 2.124 3.243 5.145 4.549.719.311 1.28.497 1.718.636.722.23 1.378.198 1.9-.04.577-.266 1.78-.728 2.031-1.431.251-.703.251-1.305.176-1.431-.075-.126-.276-.201-.577-.352z"/>
			</svg>
		</a>
	<?php endif; ?>
</div>
