<?php
$articles = mml_get_articles( 3 );

$default_articles = [
	[
		'category_ar' => 'توعية قانونية',
		'category_en' => 'Legal Awareness',
		'title_ar'    => 'حقوق المتهم في مرحلة التحقيق — ما يجب أن تعرفه',
		'title_en'    => 'Defendant rights during investigation',
		'summary_ar'  => 'نبذة عامة عن الحقوق القانونية للمتهم خلال مراحل التحقيق، بما يشمل حق الاستعانة بمحامٍ وحق الصمت.',
		'summary_en'  => 'An overview of legal rights during investigation stages.',
		'date'        => '[تاريخ النشر — قيد الاعتماد]',
		'reading'     => '5 دقائق',
	],
	[
		'category_ar' => 'توعية قانونية',
		'category_en' => 'Legal Awareness',
		'title_ar'    => 'الحبس الاحتياطي — متى يكون مشروعًا وكيف يمكن الطعن فيه؟',
		'title_en'    => 'Pre-trial detention rules and appeals',
		'summary_ar'  => 'مقال توعوي عام حول شروط الحبس الاحتياطي في القانون المصري وإجراءات طلب الإفراج.',
		'summary_en'  => 'An awareness article on pre-trial detention conditions.',
		'date'        => '[تاريخ النشر — قيد الاعتماد]',
		'reading'     => '7 دقائق',
	],
	[
		'category_ar' => 'توعية قانونية',
		'category_en' => 'Legal Awareness',
		'title_ar'    => 'الفرق بين الجناية والجنحة في القانون المصري',
		'title_en'    => 'Difference between felonies and misdemeanors',
		'summary_ar'  => 'شرح مبسط للفوارق بين الجناية والجنحة وأثر ذلك على الإجراءات القضائية والمحاكم المختصة.',
		'summary_en'  => 'A simplified explanation of felonies vs misdemeanors.',
		'date'        => '[تاريخ النشر — قيد الاعتماد]',
		'reading'     => '4 دقائق',
	],
];
?>
<section class="section section--ivory" aria-labelledby="articles-heading">
	<div class="container">
		<div class="section__header">
			<span class="gold-rule" aria-hidden="true"></span>
			<p class="section-label"><?php echo esc_html( st_l( 'توعية قانونية', 'Legal awareness' ) ); ?></p>
			<h2 id="articles-heading" class="section__title"><?php echo esc_html( st_l( 'أحدث المقالات', 'Latest articles' ) ); ?></h2>
		</div>

		<div class="grid grid--3">
			<?php if ( ! empty( $articles ) && count( $articles ) >= 3 ) : ?>
				<?php foreach ( $articles as $post ) :
					setup_postdata( $post );
					get_template_part( 'template-parts/cards/article-card', null, [ 'post' => $post ] );
				endforeach;
				wp_reset_postdata();
				?>
			<?php else : ?>
				<?php foreach ( $default_articles as $art ) : ?>
					<article class="card card--article">
						<div class="card__media">
							<span aria-hidden="true" style="font-size:2.5rem;opacity:0.35">📝</span>
						</div>
						<div class="card__body">
							<span class="section-label" style="font-size:0.75rem"><?php echo esc_html( st_l( $art['category_ar'], $art['category_en'] ) ); ?></span>
							<h3 class="card__title" style="margin-top:0.5rem;margin-bottom:0.5rem"><?php echo esc_html( st_l( $art['title_ar'], $art['title_en'] ) ); ?></h3>
							<p class="card__summary" style="margin-bottom:1rem"><?php echo esc_html( st_l( $art['summary_ar'], $art['summary_en'] ) ); ?></p>
							<div class="card__meta" style="font-size:0.75rem;color:var(--color-navy-800);opacity:0.6;display:flex;justify-content:space-between">
								<span><?php echo esc_html( $art['date'] ); ?></span>
								<span><?php echo esc_html( $art['reading'] ); ?></span>
							</div>
						</div>
					</article>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>

		<div class="text-center" style="margin-top:2.5rem">
			<a href="<?php echo esc_url( mml_lang_url( 'articles' ) ); ?>" class="btn btn--outline-dark">
				<?php echo esc_html( st_l( 'قراءة جميع المقالات', 'Read all articles' ) ); ?>
			</a>
		</div>
	</div>
</section>
