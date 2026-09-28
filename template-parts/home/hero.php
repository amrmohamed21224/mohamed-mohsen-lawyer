<?php
/**
 * Hero section
 */
$lang = st_current_lang();
$hero_photo = function_exists( 'get_field' ) ? ( get_field( 'lawyer_photo', 'option' ) ?: get_field( 'lawyer_about_photo', 'option' ) ) : null;
$photo_url  = '';

if ( is_array( $hero_photo ) && ! empty( $hero_photo['url'] ) ) {
	$photo_url = $hero_photo['url'];
} elseif ( is_string( $hero_photo ) && ! empty( $hero_photo ) ) {
	$photo_url = $hero_photo;
}
?>
<section class="home-hero" aria-labelledby="hero-heading">
	<svg class="home-hero__geo" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
		<line x1="0" y1="100%" x2="40%" y2="0" stroke="#B2874B" stroke-width="0.5"/>
		<line x1="100%" y1="0" x2="60%" y2="100%" stroke="#B2874B" stroke-width="0.5"/>
		<circle cx="72%" cy="20%" r="80" fill="none" stroke="#B2874B" stroke-width="0.5"/>
	</svg>
	<div class="home-hero__overlay" aria-hidden="true"></div>
	<div class="container home-hero__inner">
		<div>
			<p class="section-label"><?php echo esc_html( st_l( 'مكتب محمد محسن للمحاماة', 'Mohamed Mohsen Law Office' ) ); ?></p>
			<h1 id="hero-heading" class="home-hero__title">
				<?php echo esc_html( st_l( 'محمد محسن', 'Mohamed Mohsen' ) ); ?><br>
				<span><?php echo esc_html( st_l( 'المحامي الجنائي', 'Criminal Defense Lawyer' ) ); ?></span>
			</h1>
			<p class="home-hero__desc">
				<?php echo esc_html( st_l(
					'مساندة قانونية قائمة على دراسة دقيقة للوقائع، ووضوح في التواصل، والتزام كامل بسرية الموكل.',
					'Legal support based on careful case review, clear communication, and full client confidentiality.'
				) ); ?>
			</p>
			<div class="home-hero__actions">
				<a href="<?php echo esc_url( mml_contact_action_url() ); ?>" target="_blank" rel="noopener noreferrer" class="btn btn--gold js-analytics-cta">
					<?php echo esc_html( st_l( 'تواصل عبر واتساب', 'Contact on WhatsApp' ) ); ?>
				</a>
				<a href="<?php echo esc_url( mml_lang_url( 'services' ) ); ?>" class="btn btn--outline-light">
					<?php echo esc_html( st_l( 'تعرف على الخدمات', 'Our Services' ) ); ?>
				</a>
			</div>
		</div>
		<div class="home-hero__visual <?php echo $photo_url ? 'home-hero__visual--has-photo' : ''; ?>" aria-hidden="true">
			<div class="home-hero__ring"></div>
			<div class="home-hero__ring home-hero__ring--inner"></div>
			<?php if ( $photo_url ) : ?>
				<div class="home-hero__photo-wrap">
					<img src="<?php echo esc_url( $photo_url ); ?>" alt="<?php echo esc_attr( st_l( 'محمد محسن المحامي الجنائي', 'Mohamed Mohsen Lawyer' ) ); ?>" class="home-hero__photo">
				</div>
			<?php else : ?>
				<div class="home-hero__diamond"></div>
				<span class="home-hero__mono">م</span>
			<?php endif; ?>
		</div>
	</div>
</section>
