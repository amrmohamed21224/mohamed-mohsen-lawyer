<?php
/**
 * Archive Template: Media Items (الفيديوهات)
 *
 * @package MohamedMohsenLawyer
 */
get_header();

$posts_list = [];
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		$posts_list[] = get_post();
	}
}
?>
<!-- Page Hero -->
<section class="st-page-hero" aria-labelledby="media-page-heading">
	<div class="container">
		<?php get_template_part( 'template-parts/shared/breadcrumbs', null, [
			'items' => [ [ 'label_ar' => 'الفيديوهات', 'label_en' => 'Media', 'url' => null ] ],
		] ); ?>
		<p class="section-label" style="margin-bottom:0.75rem"><?php echo esc_html( st_l( 'المحتوى المرئي', 'Visual Content' ) ); ?></p>
		<h1 id="media-page-heading" class="st-page-hero__title"><?php echo esc_html( st_l( 'فيديوهات قانونية', 'Legal Videos' ) ); ?></h1>
		<p class="st-page-hero__desc"><?php echo esc_html( st_l(
			'محتوى توعوي قانوني معتمد. لا يتم تضمين أي فيديو يحتوي على بيانات أو وجوه موكلين.',
			'Approved legal awareness content. No client data or faces are published.'
		) ); ?></p>
	</div>
</section>

<!-- Main Media Content -->
<section class="st-page-content" style="padding:5rem 0">
	<div class="container">
		<?php if ( ! empty( $posts_list ) ) : ?>
			<div class="grid grid--2" style="gap:2rem">
				<?php foreach ( $posts_list as $post ) : ?>
					<?php get_template_part( 'template-parts/cards/media-card', null, [ 'post' => $post ] ); ?>
				<?php endforeach; ?>
			</div>
			<?php get_template_part( 'template-parts/shared/pagination' ); ?>
		<?php else : ?>
			<!-- Fallback Video Card from Figma -->
			<div class="max-w-3xl" style="max-width:48rem;margin-inline:auto">
				<article class="card card--media" style="background:#fff;border:1px solid var(--color-ivory-100);border-radius:var(--radius-sm);overflow:hidden">
					<div class="relative aspect-video" style="aspect-ratio:16/9;background:var(--color-navy-800);position:relative;display:flex;align-items:center;justify-content:center;text-align:center">
						<div style="padding:2rem;color:rgba(255,255,255,0.7)">
							<div style="width:4rem;height:4rem;border:2px solid var(--color-gold-600);border-radius:50%;margin:0 auto 1rem;display:flex;align-items:center;justify-content:center">
								<span style="color:#fff;font-size:1.25rem;margin-inline-start:3px" aria-hidden="true">▶</span>
							</div>
							<p style="font-family:var(--font-heading);font-weight:700;font-size:1.15rem;color:#fff;margin-bottom:0.35rem">
								<?php echo esc_html( st_l( '[عنوان الفيديو — قيد الاعتماد]', '[Video Title — Pending Approval]' ) ); ?>
							</p>
							<p style="font-size:0.875rem;color:rgba(255,255,255,0.6);margin:0">
								<?php echo esc_html( st_l( 'سيتم إضافة الفيديو بعد الاعتماد الرسمي', 'Video will be added upon official review' ) ); ?>
							</p>
						</div>
					</div>
					<div style="padding:1.5rem">
						<span class="section-label" style="font-size:0.75rem;margin-bottom:0.5rem;display:block">
							<?php echo esc_html( st_l( 'توعية قانونية', 'Legal Awareness' ) ); ?>
						</span>
						<h2 class="card__title" style="font-size:1.15rem;margin-bottom:0.5rem;color:var(--color-navy-950)">
							<?php echo esc_html( st_l( '[فيديو توعوي قانوني]', '[Legal Awareness Video]' ) ); ?>
						</h2>
						<p class="card__summary" style="font-size:0.875rem;color:var(--color-gray-600);margin:0">
							<?php echo esc_html( st_l(
								'محتوى توعوي قانوني — [الوصف وتفاصيل الفيديو قيد الاعتماد الكتابي من المحامي].',
								'Legal awareness content — [Description pending written approval].'
							) ); ?>
						</p>
					</div>
				</article>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php get_footer(); ?>
