<?php
/**
 * Template Name: Contact Page
 */
get_header();
$phone   = mml_get_option( 'primary_phone', '01064397662' );
$email   = mml_get_option( 'public_email', 'info@mohamed-mohsen-lawyer.com' );
$address = st_l(
	(string) mml_get_option( 'office_address_ar', 'المنصورة، محافظة الدقهلية، مصر' ),
	(string) mml_get_option( 'office_address_en', 'Mansoura, Dakahlia Governorate, Egypt' )
);
$maps    = mml_get_option( 'google_maps_url' );
?>
<section class="st-page-hero">
	<div class="container">
		<?php get_template_part( 'template-parts/shared/breadcrumbs', null, [
			'items' => [ [ 'label_ar' => 'تواصل معنا', 'label_en' => 'Contact', 'url' => null ] ],
		] ); ?>
		<h1 class="st-page-hero__title"><?php echo esc_html( st_l( 'تواصل معنا', 'Contact us' ) ); ?></h1>
		<p class="st-page-hero__desc"><?php echo esc_html( st_l(
			'أرسل طلب تواصل وسيتواصل المكتب معك بعد مراجعة البيانات.',
			'Send a contact request and the firm will reach out after review.'
		) ); ?></p>
	</div>
</section>

<section class="st-page-content">
	<div class="container contact-grid">
		<div class="contact-info">
			<h2 class="section__title" style="font-size:1.5rem;margin-bottom:1.5rem"><?php echo esc_html( st_l( 'بيانات التواصل', 'Contact details' ) ); ?></h2>
			<?php if ( $address ) : ?>
				<div class="contact-info__item">
					<p class="contact-info__label"><?php echo esc_html( st_l( 'العنوان', 'Address' ) ); ?></p>
					<p class="contact-info__value"><?php echo esc_html( $address ); ?></p>
				</div>
			<?php endif; ?>
			<?php if ( $phone ) : ?>
				<div class="contact-info__item">
					<p class="contact-info__label"><?php echo esc_html( st_l( 'الهاتف', 'Phone' ) ); ?></p>
					<p class="contact-info__value"><a href="<?php echo esc_url( mml_tel_link( $phone ) ); ?>" class="js-analytics-phone"><?php echo esc_html( $phone ); ?></a></p>
				</div>
			<?php endif; ?>
			<?php if ( $email ) : ?>
				<div class="contact-info__item">
					<p class="contact-info__label"><?php echo esc_html( st_l( 'البريد', 'Email' ) ); ?></p>
					<p class="contact-info__value"><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></p>
				</div>
			<?php endif; ?>
			<?php if ( $maps ) : ?>
				<div style="margin-top:2rem">
					<?php get_template_part( 'template-parts/shared/map-consent-placeholder', null, [ 'maps_url' => $maps ] ); ?>
				</div>
			<?php endif; ?>
			<?php get_template_part( 'template-parts/shared/confidentiality-note' ); ?>
		</div>
		<div>
			<h2 class="section__title" style="font-size:1.5rem;margin-bottom:1.5rem"><?php echo esc_html( st_l( 'نموذج التواصل', 'Contact form' ) ); ?></h2>
			<?php get_template_part( 'template-parts/forms/contact-form' ); ?>
		</div>
	</div>
</section>
<?php get_footer(); ?>
