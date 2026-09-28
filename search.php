<?php
get_header();
$query = get_search_query();
?>
<section class="st-page-hero">
	<div class="container">
		<h1 class="st-page-hero__title"><?php echo esc_html( st_l( 'نتائج البحث', 'Search results' ) ); ?></h1>
		<?php if ( $query ) : ?>
			<p class="st-page-hero__desc"><?php echo esc_html( st_l( 'نتائج البحث عن:', 'Results for:' ) . ' ' . $query ); ?></p>
		<?php endif; ?>
	</div>
</section>
<section class="st-page-content">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<div class="grid grid--2">
				<?php while ( have_posts() ) : the_post();
					$pt = get_post_type();
					if ( $pt === 'post' ) {
						get_template_part( 'template-parts/cards/article-card', null, [ 'post' => get_post() ] );
					} elseif ( $pt === 'service' ) {
						get_template_part( 'template-parts/cards/service-card', null, [ 'post' => get_post() ] );
					} else {
						?>
						<article class="card">
							<h3 class="card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<p class="card__summary"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 25 ) ); ?></p>
						</article>
						<?php
					}
				endwhile; ?>
			</div>
			<?php get_template_part( 'template-parts/shared/pagination' ); ?>
		<?php else : ?>
			<?php get_template_part( 'template-parts/shared/empty-state', null, [
				'message_ar' => 'لم يتم العثور على نتائج.',
				'message_en' => 'No results found.',
			] ); ?>
		<?php endif; ?>
	</div>
</section>
<?php get_footer(); ?>
