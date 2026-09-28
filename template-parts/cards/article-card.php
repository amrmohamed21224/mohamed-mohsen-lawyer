<?php
$post = $args['post'] ?? null;
if ( ! $post instanceof WP_Post ) {
	return;
}
$title   = mml_get_post_title_lang( $post );
$summary = mml_get_post_summary_lang( $post );
$date    = get_the_date( '', $post );
?>
<article class="card card--article">
	<a href="<?php echo esc_url( mml_article_permalink( $post ) ); ?>">
		<div class="card__media">
			<?php if ( has_post_thumbnail( $post ) ) : ?>
				<?php echo get_the_post_thumbnail( $post, 'medium_large', [ 'style' => 'width:100%;height:100%;object-fit:cover' ] ); ?>
			<?php else : ?>
				<span aria-hidden="true">📝</span>
			<?php endif; ?>
		</div>
		<div class="card__body">
			<h3 class="card__title"><?php echo esc_html( $title ); ?></h3>
			<p class="card__summary"><?php echo esc_html( wp_trim_words( $summary, 20 ) ); ?></p>
			<div class="card__meta">
				<span><?php echo esc_html( $date ); ?></span>
			</div>
		</div>
	</a>
</article>
