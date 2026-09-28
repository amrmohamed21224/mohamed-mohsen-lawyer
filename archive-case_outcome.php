<?php
/**
 * Archive Template: Case Outcomes (الخبرات والنتائج القضائية)
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

// Default Fallback items from Figma when no CPT entries exist yet
$default_experience = [
	[
		'category_ar' => 'جنايات',
		'category_en' => 'Felonies',
		'year'        => '[السنة — قيد الاعتماد]',
		'title_ar'    => 'قضية جناية — [تفاصيل مخفية]',
		'title_en'    => 'Felony Case — [Confidential]',
		'summary_ar'  => 'تمثيل قانوني في قضية جنائية، تم فيها مراجعة الأدلة وتقديم المستندات الدفاعية اللازمة. تم إخفاء كافة البيانات الشخصية وتفاصيل القضية حفاظًا على خصوصية الموكل.',
		'summary_en'  => 'Legal representation in a criminal case with comprehensive evidence review and defensive filings. All personal data anonymized for privacy.',
		'disclaimer_ar' => 'النتائج السابقة لا تضمن تحقيق النتيجة نفسها في أي قضية أخرى، لأن كل حالة تخضع لوقائعها ومستنداتها والإجراءات القانونية الخاصة بها.',
		'disclaimer_en' => 'Past results do not guarantee the same outcome in any other case.',
		'note_ar'       => 'تم إخفاء بيانات القضية حفاظًا على الخصوصية',
		'note_en'       => 'Case details anonymized to protect privacy',
	],
	[
		'category_ar' => 'جنح',
		'category_en' => 'Misdemeanors',
		'year'        => '[السنة — قيد الاعتماد]',
		'title_ar'    => 'قضية جنحة — [تفاصيل مخفية]',
		'title_en'    => 'Misdemeanor Case — [Confidential]',
		'summary_ar'  => 'متابعة قضية جنحة عبر مراحل التحقيق والمحاكمة، مع التواصل المستمر مع الموكل. تم إخفاء كافة البيانات الشخصية وتفاصيل القضية.',
		'summary_en'  => 'Following up a misdemeanor case through investigation and trial stages with continuous client communication. All personal data anonymized.',
		'disclaimer_ar' => 'النتائج السابقة لا تضمن تحقيق النتيجة نفسها في أي قضية أخرى، لأن كل حالة تخضع لوقائعها ومستنداتها والإجراءات القانونية الخاصة بها.',
		'disclaimer_en' => 'Past results do not guarantee the same outcome in any other case.',
		'note_ar'       => 'تم إخفاء بيانات القضية حفاظًا على الخصوصية',
		'note_en'       => 'Case details anonymized to protect privacy',
	],
];
?>
<!-- Page Hero -->
<section class="st-page-hero" aria-labelledby="exp-page-heading">
	<div class="container">
		<?php get_template_part( 'template-parts/shared/breadcrumbs', null, [
			'items' => [ [ 'label_ar' => 'الخبرات والنتائج', 'label_en' => 'Experience', 'url' => null ] ],
		] ); ?>
		<p class="section-label" style="margin-bottom:0.75rem"><?php echo esc_html( st_l( 'نماذج من الأعمال', 'Selected work' ) ); ?></p>
		<h1 id="exp-page-heading" class="st-page-hero__title"><?php echo esc_html( st_l( 'خبرات ونتائج قانونية', 'Legal experience & outcomes' ) ); ?></h1>
		<p class="st-page-hero__desc"><?php echo esc_html( st_l(
			'جميع البيانات الواردة هنا مجهّلة بالكامل حفاظًا على سرية الموكلين وبموافقتهم الكتابية المسبقة.',
			'All data here is fully anonymized to protect client confidentiality with prior written consent.'
		) ); ?></p>
	</div>
</section>

<!-- Main Content Grid -->
<section class="st-page-content" style="padding:5rem 0">
	<div class="container">

		<!-- Important Disclaimer -->
		<div class="st-disclaimer-box" style="margin-bottom:3rem;background:var(--color-ivory-100);border:1px solid rgba(178,135,75,0.3);border-inline-start:4px solid var(--color-gold-600);border-radius:var(--radius-sm);padding:1.5rem">
			<p style="margin:0;font-size:0.9375rem;color:var(--color-gray-600);line-height:1.75">
				<strong style="color:var(--color-navy-950);font-weight:700"><?php echo esc_html( st_l( 'تنبيه مهم:', 'Important notice:' ) ); ?></strong>
				<?php echo esc_html( st_l(
					'النتائج السابقة لا تضمن تحقيق النتيجة نفسها في أي قضية أخرى، لأن كل حالة تخضع لوقائعها ومستنداتها والإجراءات القانونية الخاصة بها. جميع البيانات المُدرَجة تم إخفاؤها بالكامل بموافقة كتابية مسبقة من أصحابها.',
					'Past results do not guarantee the same outcome in any other case. All published data is anonymized with prior written consent.'
				) ); ?>
			</p>
		</div>

		<!-- Experience Cards Grid (2 Columns) -->
		<div class="grid grid--2" style="gap:2rem">
			<?php if ( ! empty( $posts_list ) ) : ?>
				<?php foreach ( $posts_list as $post ) : ?>
					<?php get_template_part( 'template-parts/cards/case-outcome-card', null, [ 'post' => $post ] ); ?>
				<?php endforeach; ?>
			<?php else : ?>
				<?php foreach ( $default_experience as $item ) : ?>
					<article class="card" style="padding:2rem;background:#fff;border:1px solid var(--color-ivory-100);border-radius:var(--radius-sm)">
						<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem">
							<span class="card__badge" style="margin-bottom:0;background:rgba(11,19,43,0.05);color:var(--color-navy-950);font-size:0.75rem;padding:0.25rem 0.75rem;border-radius:999px">
								<?php echo esc_html( st_l( $item['category_ar'], $item['category_en'] ) ); ?>
							</span>
							<span style="font-size:0.75rem;color:rgba(102,112,133,0.6)"><?php echo esc_html( $item['year'] ); ?></span>
						</div>

						<h2 class="card__title" style="font-size:1.15rem;margin-bottom:1rem;color:var(--color-navy-950);font-weight:700">
							<?php echo esc_html( st_l( $item['title_ar'], $item['title_en'] ) ); ?>
						</h2>

						<p class="card__summary" style="color:var(--color-gray-600);font-size:0.875rem;line-height:1.75;margin-bottom:1.5rem">
							<?php echo esc_html( st_l( $item['summary_ar'], $item['summary_en'] ) ); ?>
						</p>

						<div style="border-top:1px solid rgba(208,213,221,0.3);padding-top:1rem;display:flex;flex-direction:column;gap:0.5rem">
							<p style="font-size:0.75rem;color:rgba(102,112,133,0.7);font-style:italic;margin:0">
								<?php echo esc_html( st_l( $item['note_ar'], $item['note_en'] ) ); ?>
							</p>
							<p style="font-size:0.75rem;color:rgba(102,112,133,0.5);margin:0">
								<?php echo esc_html( st_l( $item['disclaimer_ar'], $item['disclaimer_en'] ) ); ?>
							</p>
						</div>
					</article>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>

		<?php if ( ! empty( $posts_list ) ) : ?>
			<?php get_template_part( 'template-parts/shared/pagination' ); ?>
		<?php endif; ?>

	</div>
</section>

<?php get_footer(); ?>
