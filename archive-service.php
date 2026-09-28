<?php
/**
 * Archive Template: Services (الخدمات القانونية)
 *
 * @package MohamedMohsenLawyer
 */
get_header();

$active_posts      = [];
$placeholder_posts = [];

if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		$post_obj = get_post();
		if ( mml_is_service_placeholder( $post_obj->ID ) ) {
			$placeholder_posts[] = $post_obj;
		} else {
			$active_posts[] = $post_obj;
		}
	}
}

// Default Fallback Services from Figma when no CPT entries exist yet
$has_db_services = ! empty( $active_posts ) || ! empty( $placeholder_posts );

$default_active = [
	[
		'slug'    => 'criminal-defense',
		'title'   => 'الدفاع الجنائي',
		'title_en'=> 'Criminal Defense',
		'summary' => 'تمثيل قانوني أمام محاكم الجنايات والجنح، ومتابعة الإجراءات في مراحل التحقيق والمحاكمة.',
		'summary_en' => 'Legal representation before criminal and misdemeanor courts, and investigation follow-up.',
		'icon'    => '⚖',
	],
];

$default_placeholders = [
	[
		'title'   => '[خدمة قانونية — قيد الاعتماد]',
		'title_en'=> '[Legal Service — Pending Approval]',
		'summary' => 'سيتم إضافة تفاصيل هذه الخدمة بعد اعتمادها كتابيًا من المحامي.',
		'summary_en' => 'Details for this service will be added upon official written approval.',
		'icon'    => '📋',
	],
	[
		'title'   => '[خدمة قانونية — قيد الاعتماد]',
		'title_en'=> '[Legal Service — Pending Approval]',
		'summary' => 'سيتم إضافة تفاصيل هذه الخدمة بعد اعتمادها كتابيًا من المحامي.',
		'summary_en' => 'Details for this service will be added upon official written approval.',
		'icon'    => '🗂',
	],
];
?>
<!-- Page Hero -->
<section class="st-page-hero" aria-labelledby="services-page-heading">
	<div class="container">
		<?php get_template_part( 'template-parts/shared/breadcrumbs', null, [
			'items' => [ [ 'label_ar' => 'الخدمات القانونية', 'label_en' => 'Services', 'url' => null ] ],
		] ); ?>
		<p class="section-label" style="margin-bottom:0.75rem"><?php echo esc_html( st_l( 'ما نقدمه', 'What we offer' ) ); ?></p>
		<h1 id="services-page-heading" class="st-page-hero__title"><?php echo esc_html( st_l( 'الخدمات القانونية', 'Legal Services' ) ); ?></h1>
		<p class="st-page-hero__desc"><?php echo esc_html( st_l(
			'يتخصص المكتب في القضايا الجنائية. سيتم إضافة خدمات إضافية بعد اعتمادها رسميًا.',
			'The firm focuses on criminal cases. Additional services will be added after official approval.'
		) ); ?></p>
	</div>
</section>

<!-- Services Grid Content -->
<section class="st-page-content" style="padding:5rem 0">
	<div class="container">

		<!-- 1. Available Services Section -->
		<div style="margin-bottom:4rem">
			<h2 class="section__title" style="font-size:1.5rem;margin-bottom:2rem;color:var(--color-navy-950)">
				<?php echo esc_html( st_l( 'الخدمات المتاحة', 'Available Services' ) ); ?>
			</h2>

			<div class="grid grid--3">
				<?php if ( ! empty( $active_posts ) ) : ?>
					<?php foreach ( $active_posts as $post ) : ?>
						<?php get_template_part( 'template-parts/cards/service-card', null, [ 'post' => $post ] ); ?>
					<?php endforeach; ?>
				<?php else : ?>
					<?php foreach ( $default_active as $service ) : ?>
						<article class="card" style="padding:1.75rem">
							<span class="card__icon" aria-hidden="true" style="font-size:2rem;margin-bottom:1.25rem"><?php echo esc_html( $service['icon'] ); ?></span>
							<h3 class="card__title" style="font-size:1.25rem;margin-bottom:0.75rem"><?php echo esc_html( st_l( $service['title'], $service['title_en'] ) ); ?></h3>
							<p class="card__summary" style="margin-bottom:1.5rem;line-height:1.7"><?php echo esc_html( st_l( $service['summary'], $service['summary_en'] ) ); ?></p>
							<a href="<?php echo esc_url( mml_lang_url( 'services/' . $service['slug'] ) ); ?>" class="card__link" style="margin-top:auto">
								<?php echo esc_html( st_l( 'اعرف المزيد', 'Learn more' ) ); ?>
							</a>
						</article>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>

		<!-- 2. Pending Approval Services Section -->
		<div style="margin-bottom:3.5rem">
			<h2 class="section__title" style="font-size:1.125rem;color:rgba(11,19,43,0.45);margin-bottom:1.5rem">
				<?php echo esc_html( st_l( 'خدمات قيد الاعتماد', 'Services Pending Approval' ) ); ?>
			</h2>

			<div class="grid grid--3" style="opacity:0.65">
				<?php if ( ! empty( $placeholder_posts ) ) : ?>
					<?php foreach ( $placeholder_posts as $post ) : ?>
						<div class="card" style="border-style:dashed;background:var(--color-ivory-100);padding:1.75rem">
							<span class="card__icon" aria-hidden="true" style="font-size:2rem;margin-bottom:1rem">📋</span>
							<h3 class="card__title" style="color:rgba(11,19,43,0.7);font-size:1.125rem;margin-bottom:0.5rem"><?php echo esc_html( mml_get_post_title_lang( $post ) ); ?></h3>
							<p class="card__summary" style="color:rgba(102,112,133,0.85);font-size:0.875rem"><?php echo esc_html( mml_get_post_summary_lang( $post ) ); ?></p>
						</div>
					<?php endforeach; ?>
				<?php else : ?>
					<?php foreach ( $default_placeholders as $service ) : ?>
						<div class="card" style="border-style:dashed;background:var(--color-ivory-100);padding:1.75rem">
							<span class="card__icon" aria-hidden="true" style="font-size:2rem;margin-bottom:1rem"><?php echo esc_html( $service['icon'] ); ?></span>
							<h3 class="card__title" style="color:rgba(11,19,43,0.7);font-size:1.125rem;margin-bottom:0.5rem"><?php echo esc_html( st_l( $service['title'], $service['title_en'] ) ); ?></h3>
							<p class="card__summary" style="color:rgba(102,112,133,0.85);font-size:0.875rem"><?php echo esc_html( st_l( $service['summary'], $service['summary_en'] ) ); ?></p>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>

		<!-- Disclaimer Box -->
		<div class="st-disclaimer-box" style="margin-top:2.5rem">
			<p>
				<strong style="color:var(--color-navy-950)"><?php echo esc_html( st_l( 'تنبيه:', 'Notice:' ) ); ?></strong>
				<?php echo esc_html( st_l(
					'المعلومات الواردة في هذا الموقع هي معلومات عامة ولا تمثل استشارة قانونية لحالة محددة. إرسال طلب تواصل أو معلومات من خلال الموقع لا يُنشئ بمفرده علاقة محامٍ وموكل، ولا يُعد قبولًا للقضية.',
					'Content on this site is general information and does not constitute legal advice. Contact requests do not create an attorney-client relationship.'
				) ); ?>
			</p>
		</div>

	</div>
</section>

<!-- Bottom CTA Section -->
<section class="section section--ivory" style="border-top:1px solid rgba(178,135,75,0.2);padding:4.5rem 0">
	<div class="container text-center" style="max-width:36rem">
		<h2 class="section__title" style="font-size:1.65rem;margin-bottom:1rem">
			<?php echo esc_html( st_l( 'هل تحتاج إلى مساعدة قانونية؟', 'Need Legal Assistance?' ) ); ?>
		</h2>
		<p class="section__desc" style="margin:0 auto 2rem;font-size:0.95rem">
			<?php echo esc_html( st_l( 'تواصل مع المكتب لمناقشة وضعك القانوني.', 'Contact the firm to discuss your legal situation.' ) ); ?>
		</p>
		<a href="<?php echo esc_url( mml_contact_action_url() ); ?>" target="_blank" rel="noopener noreferrer" class="btn btn--navy" style="padding:0.875rem 2.25rem">
			<?php echo esc_html( st_l( 'تواصل عبر واتساب', 'Contact on WhatsApp' ) ); ?>
		</a>
	</div>
</section>

<?php get_footer(); ?>
