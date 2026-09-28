<?php
$post = $args['post'] ?? null;
if ( ! $post instanceof WP_Post ) {
	return;
}
$name   = mml_get_field_lang( $post->ID, 'testimonial_name' );
$text   = mml_get_field_lang( $post->ID, 'testimonial_text' );
$rating = (int) get_field( 'testimonial_rating', $post->ID );
$avatar = get_field( 'testimonial_avatar', $post->ID );
?>
<blockquote class="card">
	<?php if ( $rating > 0 ) : ?>
		<p class="card__badge" aria-label="<?php echo esc_attr( st_l( 'التقييم', 'Rating' ) . ' ' . $rating ); ?>">
			<?php echo esc_html( str_repeat( '★', min( 5, $rating ) ) ); ?>
		</p>
	<?php endif; ?>
	<p class="card__summary">"<?php echo esc_html( $text ); ?>"</p>
	<footer style="margin-top:1rem;display:flex;align-items:center;gap:0.75rem">
		<?php if ( $avatar && ! empty( $avatar['url'] ) ) : ?>
			<img src="<?php echo esc_url( $avatar['url'] ); ?>" alt="" width="40" height="40" style="border-radius:50%;object-fit:cover">
		<?php endif; ?>
		<cite class="card__title" style="font-style:normal;font-size:0.9375rem"><?php echo esc_html( $name ); ?></cite>
	</footer>
</blockquote>
