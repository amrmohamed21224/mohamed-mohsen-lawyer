<?php
$items = [
	[ 'num' => '01', 'title_ar' => 'دراسة دقيقة للوقائع', 'title_en' => 'Careful fact review', 'body_ar' => 'يبدأ كل ملف بمراجعة شاملة للمستندات والوقائع قبل اتخاذ أي خطوة إجرائية.', 'body_en' => 'Every file starts with a thorough review of documents and facts.' ],
	[ 'num' => '02', 'title_ar' => 'توضيح الخيارات القانونية', 'title_en' => 'Clear legal options', 'body_ar' => 'يحرص المكتب على شرح الخيارات المتاحة للموكل بوضوح، دون وعود بنتائج محددة.', 'body_en' => 'Options are explained clearly without promises of specific outcomes.' ],
	[ 'num' => '03', 'title_ar' => 'الحفاظ على سرية الموكل', 'title_en' => 'Client confidentiality', 'body_ar' => 'جميع بيانات الموكل وتفاصيل القضية تُعامَل بسرية تامة طوال مراحل القضية.', 'body_en' => 'All client data is handled with full confidentiality.' ],
	[ 'num' => '04', 'title_ar' => 'متابعة مستمرة وإبلاغ', 'title_en' => 'Ongoing updates', 'body_ar' => 'يتابع المكتب جلسات القضية ويُبلَّغ الموكل بكل مستجد إجرائي بصورة منتظمة.', 'body_en' => 'The firm tracks hearings and keeps clients informed.' ],
];
?>
<section class="section" aria-labelledby="why-heading">
	<div class="container">
		<div class="text-center section__header">
			<span class="gold-rule gold-rule--center" aria-hidden="true"></span>
			<p class="section-label"><?php echo esc_html( st_l( 'منهج العمل', 'Our approach' ) ); ?></p>
			<h2 id="why-heading" class="section__title"><?php echo esc_html( st_l( 'كيف يعمل المكتب؟', 'How does the firm work?' ) ); ?></h2>
		</div>
		<div class="grid grid--4 why-us">
			<?php foreach ( $items as $item ) : ?>
				<div class="why-us__item">
					<span aria-hidden="true"><?php echo esc_html( $item['num'] ); ?></span>
					<h3><?php echo esc_html( st_l( $item['title_ar'], $item['title_en'] ) ); ?></h3>
					<p><?php echo esc_html( st_l( $item['body_ar'], $item['body_en'] ) ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
