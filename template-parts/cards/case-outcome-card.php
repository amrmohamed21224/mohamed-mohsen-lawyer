<?php
$post = $args['post'] ?? null;
if ( ! $post instanceof WP_Post ) {
	return;
}
$title    = mml_get_post_title_lang( $post );
$summary  = mml_get_post_summary_lang( $post );
$category = mml_get_field_lang( $post->ID, 'case_category' );
$year     = get_field( 'case_year', $post->ID );
?>
<article class="card card--case">
	<div class="card--case__header">
		<?php if ( $category ) : ?>
			<span class="card__badge"><?php echo esc_html( $category ); ?></span>
		<?php endif; ?>
		<?php if ( $year ) : ?>
			<span class="card--case__year"><?php echo esc_html( (string) $year ); ?> م</span>
		<?php endif; ?>
	</div>

	<h3 class="card__title">
		<a href="<?php echo esc_url( mml_case_permalink( $post ) ); ?>">
			<?php echo esc_html( $title ); ?>
		</a>
	</h3>

	<p class="card__summary"><?php echo esc_html( $summary ); ?></p>

	<div class="card--case__footer">
		<a href="<?php echo esc_url( mml_case_permalink( $post ) ); ?>" class="card__link">
			<?php echo esc_html( st_l( 'عرض تفاصيل القضية', 'View Case Details' ) ); ?> ←
		</a>
	</div>
</article>
