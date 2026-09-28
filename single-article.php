<?php
get_header();
if ( have_posts() ) :
	while ( have_posts() ) : the_post();
		$title    = mml_get_post_title_lang( get_post() );
		$subtitle = mml_get_field_lang( get_the_ID(), 'article_subtitle' );
		?>
		<section class="st-page-hero">
			<div class="container">
				<?php get_template_part( 'template-parts/shared/breadcrumbs', null, [
					'items' => [
						[ 'label_ar' => 'المقالات', 'label_en' => 'Articles', 'url' => mml_lang_url( 'articles' ) ],
						[ 'label_ar' => $title, 'label_en' => $title, 'url' => null ],
					],
				] ); ?>
				<h1 class="st-page-hero__title"><?php echo esc_html( $title ); ?></h1>
				<?php if ( $subtitle ) : ?>
					<p class="st-page-hero__desc"><?php echo esc_html( $subtitle ); ?></p>
				<?php endif; ?>
				<p class="st-page-hero__desc" style="font-size:0.875rem"><?php echo esc_html( get_the_date() ); ?></p>
			</div>
		</section>
		<section class="st-page-content">
			<div class="container entry-content st-prose" style="max-width:48rem">
				<?php the_content(); ?>
			</div>
		</section>
		<?php
	endwhile;
endif;
get_footer();
