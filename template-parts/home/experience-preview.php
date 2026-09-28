<?php
$items = mml_get_case_outcomes( 3 );

$default_experience = [
	[
		'category_ar' => 'جنايات',
		'category_en' => 'Felonies',
		'title_ar'    => 'قضية جناية — [تفاصيل مخفية]',
		'title_en'    => 'Felony Case — [Confidential]',
		'summary_ar'  => 'تمثيل قانوني في قضية جنائية، تم فيها مراجعة الأدلة وتقديم المستندات الدفاعية اللازمة. تم إخفاء كافة البيانات الشخصية وتفاصيل القضية حفاظًا على خصوصية الموكل.',
		'summary_en'  => 'Legal representation in a criminal case with full case review. Personal data anonymized.',
	],
	[
		'category_ar' => 'جنح',
		'category_en' => 'Misdemeanors',
		'title_ar'    => 'قضية جنحة — [تفاصيل مخفية]',
		'title_en'    => 'Misdemeanor Case — [Confidential]',
		'summary_ar'  => 'متابعة قضية جنحة عبر مراحل التحقيق والمحاكمة، مع التواصل المستمر مع الموكل. تم إخفاء كافة البيانات الشخصية وتفاصيل القضية.',
		'summary_en'  => 'Following up a misdemeanor case through investigation and trial stages. Personal data anonymized.',
	],
];
?>
<section class="section section--ivory" aria-labelledby="exp-heading">
	<div class="container">
		<div class="section__header">
			<span class="gold-rule" aria-hidden="true"></span>
			<p class="section-label"><?php echo esc_html( st_l( 'نماذج من الأعمال', 'Selected work' ) ); ?></p>
			<h2 id="exp-heading" class="section__title"><?php echo esc_html( st_l( 'خبرات ونتائج قانونية', 'Legal experience & outcomes' ) ); ?></h2>
			<p class="section__desc"><?php echo esc_html( st_l(
				'النتائج السابقة لا تضمن تحقيق النتيجة نفسها في أي قضية أخرى، لأن كل حالة تخضع لوقائعها ومستنداتها والإجراءات القانونية الخاصة بها.',
				'Past results do not guarantee the same outcome in any other case.'
			) ); ?></p>
		</div>

		<div class="grid grid--2" style="max-width:56rem;margin-inline:auto">
			<?php if ( ! empty( $items ) ) : ?>
				<?php foreach ( $items as $post ) :
					setup_postdata( $post );
					get_template_part( 'template-parts/cards/case-outcome-card', null, [ 'post' => $post ] );
				endforeach;
				wp_reset_postdata();
				?>
			<?php else : ?>
				<?php foreach ( $default_experience as $exp ) : ?>
					<article class="card">
						<span class="card__badge"><?php echo esc_html( st_l( $exp['category_ar'], $exp['category_en'] ) ); ?></span>
						<h3 class="card__title"><?php echo esc_html( st_l( $exp['title_ar'], $exp['title_en'] ) ); ?></h3>
						<p class="card__summary"><?php echo esc_html( st_l( $exp['summary_ar'], $exp['summary_en'] ) ); ?></p>
						<p class="card__note" style="border-top:1px solid rgba(0,0,0,0.06);padding-top:0.75rem;margin-top:auto">
							<?php echo esc_html( st_l( 'تم إخفاء بيانات القضية حفاظًا على الخصوصية', 'Case details anonymized to protect privacy' ) ); ?>
						</p>
					</article>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>

		<div class="text-center" style="margin-top:2.5rem">
			<a href="<?php echo esc_url( mml_lang_url( 'experience' ) ); ?>" class="btn btn--outline-dark">
				<?php echo esc_html( st_l( 'عرض جميع الخبرات', 'View all experience' ) ); ?>
			</a>
		</div>
	</div>
</section>
