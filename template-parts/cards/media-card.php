<?php
$post     = $args['post'] ?? null;
$featured = ! empty( $args['featured'] );
if ( ! $post instanceof WP_Post ) {
	return;
}
$title     = mml_get_post_title_lang( $post );
$source    = mml_get_field_lang( $post->ID, 'media_source' ) ?: st_l( 'صفحة الفيسبوك الرسمية', 'Official Facebook Page' );
$video_url = (string) get_field( 'media_video_url', $post->ID );
$thumb     = get_field( 'media_thumbnail', $post->ID );
$thumb_url = '';

if ( is_array( $thumb ) && ! empty( $thumb['url'] ) ) {
	$thumb_url = $thumb['url'];
} elseif ( is_string( $thumb ) && ! empty( $thumb ) ) {
	$thumb_url = $thumb;
}

$target_url = $video_url ?: 'https://www.facebook.com/p/%D9%85%D8%AD%D9%85%D8%AF-%D9%85%D8%AD%D8%B3%D9%86-%D8%A7%D9%84%D9%85%D8%AD%D8%A7%D9%85%D9%89-100054629881049/';
?>
<article class="card card--media card--video-link" style="overflow:hidden;padding:0;background:#fff;border:1px solid var(--color-ivory-100);border-radius:var(--radius-sm)">
	<a
		href="<?php echo esc_url( $target_url ); ?>"
		target="_blank"
		rel="noopener noreferrer"
		class="featured-video__wrap"
		style="display:block;text-decoration:none;position:relative"
		aria-label="<?php echo esc_attr( sprintf( st_l( 'مشاهدة فيديو: %s على فيسبوك', 'Watch video: %s on Facebook' ), $title ) ); ?>"
	>
		<?php if ( $thumb_url ) : ?>
			<img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( $title ); ?>" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover">
		<?php endif; ?>
		<div class="featured-video__placeholder" style="background:<?php echo $thumb_url ? 'rgba(11,19,43,0.45)' : 'rgba(11,19,43,0.85)'; ?>;transition:background 0.3s ease">
			<div class="featured-video__play" aria-hidden="true" style="transition:transform 0.3s ease">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="#fff" style="margin-inline-start:3px"><path d="M8 5v14l11-7z"/></svg>
			</div>
			<span style="font-size:0.8125rem;color:var(--color-gold-300);font-weight:600;display:inline-flex;align-items:center;gap:0.35rem;background:rgba(11,19,43,0.7);padding:0.35rem 0.75rem;border-radius:999px;border:1px solid rgba(178,135,75,0.4)">
				<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
				<?php echo esc_html( st_l( 'مشاهدة على فيسبوك', 'Watch on Facebook' ) ); ?> ↗
			</span>
		</div>
	</a>

	<div style="padding:1.5rem">
		<?php if ( $source ) : ?>
			<span style="display:block;font-size:0.75rem;color:var(--color-gold-600);font-weight:600;margin-bottom:0.5rem;text-transform:uppercase">
				<?php echo esc_html( $source ); ?>
			</span>
		<?php endif; ?>
		<h3 class="card__title" style="font-size:1.15rem;margin-bottom:0.75rem;color:var(--color-navy-950);font-weight:700;line-height:1.4">
			<a href="<?php echo esc_url( $target_url ); ?>" target="_blank" rel="noopener noreferrer" style="color:inherit;text-decoration:none">
				<?php echo esc_html( $title ); ?>
			</a>
		</h3>
		<a href="<?php echo esc_url( $target_url ); ?>" target="_blank" rel="noopener noreferrer" class="card__link" style="display:inline-flex;align-items:center;gap:0.35rem;font-weight:600">
			<?php echo esc_html( st_l( 'انتقل لمشاهدة الفيديو بالكامل', 'Watch Full Video' ) ); ?> ↗
		</a>
	</div>
</article>
