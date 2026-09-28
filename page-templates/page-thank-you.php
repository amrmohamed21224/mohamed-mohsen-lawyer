<?php
/**
 * Template Name: Thank You Page
 */
get_header();
?>
<section class="st-page-content">
	<div class="container thank-you">
		<div class="thank-you__icon" aria-hidden="true">✓</div>
		<h1 class="thank-you__title"><?php echo esc_html( st_l( 'شكرًا لتواصلك', 'Thank you' ) ); ?></h1>
		<p class="st-prose"><?php echo esc_html( st_l(
			'تم استلام طلبك بنجاح. سيتواصل المكتب معك بعد مراجعة البيانات خلال ساعات العمل الرسمية.',
			'Your request was received. The firm will contact you during official working hours.'
		) ); ?></p>
		<p class="st-disclaimer-box"><?php echo esc_html( st_l(
			'إرسال طلب التواصل لا يُنشئ علاقة محامٍ وموكل ولا يُعد قبولًا للقضية.',
			'Contact requests do not create an attorney-client relationship or case acceptance.'
		) ); ?></p>
		<a href="<?php echo esc_url( mml_lang_url( '' ) ); ?>" class="btn btn--outline-dark" style="margin-top:2rem">
			<?php echo esc_html( st_l( 'العودة للرئيسية', 'Back to home' ) ); ?>
		</a>
	</div>
</section>
<?php get_footer(); ?>
