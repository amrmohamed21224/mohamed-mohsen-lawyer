<?php
get_header();
?>
<section class="st-page-content">
	<div class="container not-found">
		<p class="not-found__code" aria-hidden="true">404</p>
		<h1 class="not-found__title"><?php echo esc_html( st_l( 'الصفحة غير موجودة', 'Page not found' ) ); ?></h1>
		<p class="st-prose"><?php echo esc_html( st_l(
			'عذرًا، الصفحة التي تبحث عنها غير متاحة أو تم نقلها.',
			'Sorry, the page you are looking for is unavailable or has moved.'
		) ); ?></p>
		<a href="<?php echo esc_url( mml_lang_url( '' ) ); ?>" class="btn btn--gold" style="margin-top:2rem">
			<?php echo esc_html( st_l( 'العودة للرئيسية', 'Back to home' ) ); ?>
		</a>
	</div>
</section>
<?php get_footer(); ?>
