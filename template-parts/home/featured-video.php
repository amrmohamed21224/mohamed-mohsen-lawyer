<?php
$media_items = mml_get_media_items( 1 );
$featured    = $media_items[0] ?? null;
?>
<section class="section" aria-labelledby="video-heading">
	<div class="container">
		<div class="section__header">
			<span class="gold-rule" aria-hidden="true"></span>
			<p class="section-label"><?php echo esc_html( st_l( 'المحتوى المرئي', 'Visual Content' ) ); ?></p>
			<h2 id="video-heading" class="section__title"><?php echo esc_html( st_l( 'فيديوهات وتوعية قانونية', 'Legal Videos & Awareness' ) ); ?></h2>
		</div>
		<div style="max-width:48rem;margin-inline:auto">
			<?php if ( $featured ) : ?>
				<?php get_template_part( 'template-parts/cards/media-card', null, [ 'post' => $featured, 'featured' => true ] ); ?>
			<?php else : ?>
				<a
					href="https://www.facebook.com/p/%D9%85%D8%AD%D9%85%D8%AF-%D9%85%D8%AD%D8%B3%D9%86-%D8%A7%D9%84%D9%85%D8%AD%D8%A7%D9%85%D9%89-100054629881049/"
					target="_blank"
					rel="noopener noreferrer"
					class="featured-video__wrap"
					style="display:block;text-decoration:none"
				>
					<div class="featured-video__placeholder">
						<div class="featured-video__play" aria-hidden="true">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="#fff" style="margin-inline-start:3px"><path d="M8 5v14l11-7z"/></svg>
						</div>
						<p class="card__title" style="color:#fff;font-size:1.2rem;font-weight:700;margin-bottom:0.5rem">
							<?php echo esc_html( st_l( 'فيديوهات ومرافعات المستشار محمد محسن', 'Mohamed Mohsen Legal Videos' ) ); ?>
						</p>
						<span style="font-size:0.8125rem;color:var(--color-gold-300);background:rgba(11,19,43,0.6);padding:0.35rem 0.75rem;border-radius:999px;border:1px solid rgba(178,135,75,0.4)">
							<?php echo esc_html( st_l( 'مشاهدة على فيسبوك الرسمية', 'Watch on Facebook' ) ); ?> ↗
						</span>
					</div>
				</a>
			<?php endif; ?>

			<div style="margin-top:1.5rem;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:0.75rem">
				<p style="font-size:0.875rem;color:var(--color-gray-600);margin:0">
					<?php echo esc_html( st_l( 'محتوى توعوي واستشارات قانونية مرئية', 'Legal awareness and video consultations' ) ); ?>
				</p>
				<a href="<?php echo esc_url( mml_lang_url( 'media' ) ); ?>" class="card__link" style="margin:0;font-weight:600">
					<?php echo esc_html( st_l( 'جميع الفيديوهات', 'All Videos' ) ); ?> ←
				</a>
			</div>
		</div>
	</div>
</section>
