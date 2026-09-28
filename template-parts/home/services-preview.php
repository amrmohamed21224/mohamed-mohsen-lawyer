<?php
$services = mml_get_services( 3 );

$default_services = [
	[
		'title_ar'    => 'الدفاع الجنائي',
		'title_en'    => 'Criminal Defense',
		'summary_ar'  => 'تمثيل قانوني أمام محاكم الجنايات والجنح، ومتابعة الإجراءات في مراحل التحقيق والمحاكمة.',
		'summary_en'  => 'Legal representation in criminal and misdemeanor courts, and investigation follow-up.',
		'icon'        => '⚖',
		'placeholder' => false,
		'url'         => mml_lang_url( 'services' ),
	],
	[
		'title_ar'    => '[خدمة قانونية — قيد الاعتماد]',
		'title_en'    => '[Legal Service — Pending Approval]',
		'summary_ar'  => 'سيتم إضافة تفاصيل هذه الخدمة بعد اعتمادها كتابيًا من المحامي.',
		'summary_en'  => 'Details for this service will be added upon official written approval.',
		'icon'        => '📋',
		'placeholder' => true,
		'url'         => null,
	],
	[
		'title_ar'    => '[خدمة قانونية — قيد الاعتماد]',
		'title_en'    => '[Legal Service — Pending Approval]',
		'summary_ar'  => 'سيتم إضافة تفاصيل هذه الخدمة بعد اعتمادها كتابيًا من المحامي.',
		'summary_en'  => 'Details for this service will be added upon official written approval.',
		'icon'        => '🗂',
		'placeholder' => true,
		'url'         => null,
	],
];
?>
<section class="section" aria-labelledby="services-heading">
	<div class="container">
		<div class="section__header">
			<span class="gold-rule" aria-hidden="true"></span>
			<p class="section-label"><?php echo esc_html( st_l( 'ما نقدمه', 'What we offer' ) ); ?></p>
			<h2 id="services-heading" class="section__title"><?php echo esc_html( st_l( 'الخدمات القانونية', 'Legal Services' ) ); ?></h2>
			<p class="section__desc"><?php echo esc_html( st_l(
				'يتخصص المكتب في القضايا الجنائية. سيتم إضافة خدمات إضافية بعد اعتمادها رسميًا.',
				'The firm focuses on criminal cases. Additional services will be added after official approval.'
			) ); ?></p>
		</div>

		<div class="grid grid--3">
			<?php if ( ! empty( $services ) ) : ?>
				<?php foreach ( $services as $post ) :
					setup_postdata( $post );
					get_template_part( 'template-parts/cards/service-card', null, [ 'post' => $post ] );
				endforeach;
				wp_reset_postdata();
				?>
			<?php else : ?>
				<?php foreach ( $default_services as $s ) : ?>
					<article class="card<?php echo $s['placeholder'] ? ' card--placeholder' : ''; ?>">
						<span class="card__icon" aria-hidden="true"><?php echo esc_html( $s['icon'] ); ?></span>
						<h3 class="card__title"><?php echo esc_html( st_l( $s['title_ar'], $s['title_en'] ) ); ?></h3>
						<p class="card__summary"><?php echo esc_html( st_l( $s['summary_ar'], $s['summary_en'] ) ); ?></p>
						<?php if ( ! $s['placeholder'] ) : ?>
							<a href="<?php echo esc_url( $s['url'] ); ?>" class="card__link">
								<?php echo esc_html( st_l( 'اعرف المزيد', 'Learn more' ) ); ?>
							</a>
						<?php else : ?>
							<span class="card__note"><?php echo esc_html( st_l( 'قيد الاعتماد', 'Pending approval' ) ); ?></span>
						<?php endif; ?>
					</article>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>

		<div class="text-center" style="margin-top:2.5rem">
			<a href="<?php echo esc_url( mml_lang_url( 'services' ) ); ?>" class="btn btn--outline-dark">
				<?php echo esc_html( st_l( 'عرض جميع الخدمات', 'View all services' ) ); ?>
			</a>
		</div>
	</div>
</section>
