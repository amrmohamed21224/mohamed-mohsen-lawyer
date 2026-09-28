<?php
get_header();

$posts_list = [];
$featured   = null;

if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		$posts_list[] = get_post();
	}
	if ( ! empty( $posts_list ) ) {
		$featured = array_shift( $posts_list );
	}
}
?>
<section class="st-page-hero">
	<div class="container">
		<?php get_template_part( 'template-parts/shared/breadcrumbs', null, [
			'items' => [ [ 'label_ar' => 'المقالات', 'label_en' => 'Articles', 'url' => null ] ],
		] ); ?>
		<p class="section-label" style="margin-bottom:0.75rem"><?php echo esc_html( st_l( 'توعية قانونية', 'Legal awareness' ) ); ?></p>
		<h1 class="st-page-hero__title"><?php echo esc_html( st_l( 'المقالات القانونية', 'Legal articles' ) ); ?></h1>
	</div>
</section>

<section class="st-page-content">
	<div class="container">

		<div class="st-disclaimer-box" style="margin-bottom:2.5rem">
			<p><?php echo esc_html( st_l(
				'المحتوى الوارد في هذه المقالات للتوعية العامة ولا يُعد استشارة قانونية لحالة محددة. تختلف الآثار والإجراءات بحسب وقائع كل حالة والمستندات والقوانين والقرارات السارية وقت التعامل معها. كل مقال يخضع لمراجعة المحامي قبل النشر.',
				'Articles are for general awareness and not legal advice. Each case depends on its facts, laws, and regulations.'
			) ); ?></p>
		</div>

		<?php if ( $featured ) : ?>
			<div style="margin-bottom:3rem">
				<a href="<?php echo esc_url( mml_article_permalink( $featured ) ); ?>" style="display:block" class="group">
					<article class="card card--article" style="background:var(--color-navy-950);color:#fff">
						<div class="grid" style="grid-template-columns:1fr;gap:0">
							<style>@media(min-width:1024px){.article-featured-grid{display:grid!important;grid-template-columns:1.2fr 1fr;gap:0}}</style>
							<div class="article-featured-grid" style="display:contents">
								<div class="card__media" style="min-height:260px;background:var(--color-navy-800)">
									<?php if ( has_post_thumbnail( $featured ) ) : ?>
										<?php echo get_the_post_thumbnail( $featured, 'large', [ 'style' => 'width:100%;height:100%;object-fit:cover' ] ); ?>
									<?php else : ?>
										<span aria-hidden="true" style="font-size:3.5rem;opacity:0.3">📝</span>
									<?php endif; ?>
								</div>
								<div style="padding:2.5rem;display:flex;flex-direction:column;justify-content:center">
									<span class="section-label" style="margin-bottom:0.5rem"><?php echo esc_html( st_l( 'مقال مميز', 'Featured article' ) ); ?></span>
									<h2 class="card__title" style="color:#fff;font-size:1.5rem;margin-bottom:0.75rem"><?php echo esc_html( mml_get_post_title_lang( $featured ) ); ?></h2>
									<p class="card__summary" style="color:rgba(255,255,255,0.7);margin-bottom:1.5rem"><?php echo esc_html( mml_get_post_summary_lang( $featured ) ); ?></p>
									<div class="card__meta" style="color:rgba(255,255,255,0.4)">
										<span><?php echo esc_html( get_the_date( '', $featured ) ); ?></span>
										<span class="card__link" style="margin-top:0"><?php echo esc_html( st_l( 'اقرأ المقال', 'Read article' ) ); ?></span>
									</div>
								</div>
							</div>
						</div>
					</article>
				</a>
			</div>
		<?php endif; ?>

		<?php if ( ! empty( $posts_list ) ) : ?>
			<div class="grid grid--3">
				<?php foreach ( $posts_list as $post ) : ?>
					<?php get_template_part( 'template-parts/cards/article-card', null, [ 'post' => $post ] ); ?>
				<?php endforeach; ?>
			</div>
			<?php get_template_part( 'template-parts/shared/pagination' ); ?>
		<?php elseif ( ! $featured ) : ?>
			<?php get_template_part( 'template-parts/shared/empty-state', null, [
				'message_ar' => 'لا توجد مقالات منشورة حاليًا.',
				'message_en' => 'No published articles yet.',
			] ); ?>
		<?php endif; ?>

	</div>
</section>

<?php get_footer(); ?>
