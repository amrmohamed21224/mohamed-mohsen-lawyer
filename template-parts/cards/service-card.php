<?php
$post = $args['post'] ?? null;
if ( ! $post instanceof WP_Post ) {
	return;
}
$id          = $post->ID;
$title       = mml_get_post_title_lang( $post );
$summary     = mml_get_post_summary_lang( $post );
$placeholder = mml_is_service_placeholder( $id );
$icon_img    = get_field( 'service_icon', $id );
$icon_emoji  = get_field( 'service_icon_emoji', $id ) ?: '⚖';
$classes     = 'card' . ( $placeholder ? ' card--placeholder' : '' );
?>
<article class="<?php echo esc_attr( $classes ); ?>">
	<?php if ( $icon_img && ! empty( $icon_img['url'] ) ) : ?>
		<img class="card__icon" src="<?php echo esc_url( $icon_img['url'] ); ?>" alt="" width="32" height="32">
	<?php else : ?>
		<span class="card__icon" aria-hidden="true"><?php echo esc_html( $icon_emoji ); ?></span>
	<?php endif; ?>
	<h3 class="card__title"><?php echo esc_html( $title ); ?></h3>
	<p class="card__summary"><?php echo esc_html( $summary ); ?></p>
	<?php if ( ! $placeholder ) : ?>
		<a href="<?php echo esc_url( mml_service_permalink( $post ) ); ?>" class="card__link">
			<?php echo esc_html( st_l( 'اعرف المزيد', 'Learn more' ) ); ?>
		</a>
	<?php else : ?>
		<span class="card__note"><?php echo esc_html( st_l( 'قيد الاعتماد', 'Pending approval' ) ); ?></span>
	<?php endif; ?>
</article>
