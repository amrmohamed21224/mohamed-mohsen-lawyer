<?php
get_header();
if ( have_posts() ) :
	while ( have_posts() ) : the_post();
		if ( mml_is_service_placeholder( get_the_ID() ) ) {
			wp_safe_redirect( mml_lang_url( 'services' ) );
			exit;
		}
		$title       = mml_get_post_title_lang( get_post() );
		$summary     = mml_get_post_summary_lang( get_post() );
		$description = mml_get_field_lang( get_the_ID(), 'service_description' );
		$approach    = mml_get_field_lang( get_the_ID(), 'service_approach' );
		$required    = mml_get_field_lang( get_the_ID(), 'service_required_info' );
		$cases       = get_field( 'service_common_cases', get_the_ID() ) ?: [];
		$faq_rows    = get_field( 'service_faq', get_the_ID() ) ?: [];
		$icon_emoji  = get_field( 'service_icon_emoji', get_the_ID() ) ?: '⚖';
		$faqs        = [];
		foreach ( $faq_rows as $i => $row ) {
			$faqs[] = [
				'id'          => $i,
				'question_ar' => $row['question_ar'] ?? '',
				'question_en' => $row['question_en'] ?? '',
				'answer_ar'   => $row['answer_ar'] ?? '',
				'answer_en'   => $row['answer_en'] ?? '',
			];
		}
		?>
		<section class="st-page-hero">
			<div class="container">
				<?php get_template_part( 'template-parts/shared/breadcrumbs', null, [
					'items' => [
						[ 'label_ar' => 'الخدمات القانونية', 'label_en' => 'Services', 'url' => mml_lang_url( 'services' ) ],
						[ 'label_ar' => $title, 'label_en' => $title, 'url' => null ],
					],
				] ); ?>
				<span style="font-size:2rem;display:block;margin-bottom:1rem" aria-hidden="true"><?php echo esc_html( $icon_emoji ); ?></span>
				<h1 class="st-page-hero__title"><?php echo esc_html( $title ); ?></h1>
				<p class="st-page-hero__desc"><?php echo esc_html( $summary ); ?></p>
			</div>
		</section>
		<section class="st-page-content">
			<div class="container st-prose" style="max-width:48rem">
				<?php if ( $description ) : ?>
					<h2><?php echo esc_html( st_l( 'نبذة عن الخدمة', 'About this service' ) ); ?></h2>
					<?php echo wp_kses_post( $description ); ?>
				<?php endif; ?>
				<?php if ( ! empty( $cases ) ) : ?>
					<h2><?php echo esc_html( st_l( 'حالات شائعة', 'Common cases' ) ); ?></h2>
					<ul>
						<?php foreach ( $cases as $case ) :
							$label = st_l( $case['case_ar'] ?? '', $case['case_en'] ?? '' );
							if ( ! $label ) continue;
							?>
							<li><?php echo esc_html( $label ); ?></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
				<?php if ( $approach ) : ?>
					<div class="st-disclaimer-box">
						<h2 style="margin-top:0"><?php echo esc_html( st_l( 'منهج المكتب', 'Our approach' ) ); ?></h2>
						<p><?php echo esc_html( $approach ); ?></p>
					</div>
				<?php endif; ?>
				<?php if ( $required ) : ?>
					<h2><?php echo esc_html( st_l( 'المعلومات الأولية المطلوبة', 'Required initial information' ) ); ?></h2>
					<p><?php echo esc_html( $required ); ?></p>
				<?php endif; ?>
				<div class="st-disclaimer-box">
					<p><strong><?php echo esc_html( st_l( 'تنبيه:', 'Notice:' ) ); ?></strong>
					<?php echo esc_html( st_l(
						'لا ترسل مستندات أو بيانات حساسة عبر الموقع. يُرجى تسليم المستندات شخصيًا للمكتب.',
						'Do not send documents or sensitive data via the website. Deliver documents in person.'
					) ); ?></p>
				</div>
				<?php if ( ! empty( $faqs ) ) :
					get_template_part( 'template-parts/shared/faq-accordion', null, [
						'faqs'            => $faqs,
						'instance_prefix' => 'service-faq',
					] );
				endif; ?>
				<p style="margin-top:2rem">
					<a href="<?php echo esc_url( mml_contact_action_url() ); ?>" target="_blank" rel="noopener noreferrer" class="btn btn--gold js-analytics-cta">
						<?php echo esc_html( st_l( 'تواصل عبر واتساب', 'Contact on WhatsApp' ) ); ?>
					</a>
				</p>
			</div>
		</section>
		<?php
	endwhile;
endif;
get_footer();
