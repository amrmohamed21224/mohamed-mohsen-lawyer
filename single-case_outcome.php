<?php
/**
 * Single Template: Case Outcome (تفاصيل القضية والسابقة القضائية)
 *
 * @package MohamedMohsenLawyer
 */
get_header();

if ( have_posts() ) :
	while ( have_posts() ) : the_post();
		$title    = mml_get_post_title_lang( get_post() );
		$summary  = mml_get_post_summary_lang( get_post() );
		$category = mml_get_field_lang( get_the_ID(), 'case_category' );
		$court    = mml_get_field_lang( get_the_ID(), 'case_court' );
		$result   = mml_get_field_lang( get_the_ID(), 'case_result' );
		$defense  = mml_get_field_lang( get_the_ID(), 'case_defense' );
		$year     = get_field( 'case_year', get_the_ID() );
		?>
		<!-- Hero Section -->
		<section class="st-page-hero" aria-labelledby="case-heading">
			<div class="container" style="max-width:56rem">
				<?php get_template_part( 'template-parts/shared/breadcrumbs', null, [
					'items' => [
						[ 'label_ar' => 'الخبرات والنتائج', 'label_en' => 'Experience', 'url' => mml_lang_url( 'experience' ) ],
						[ 'label_ar' => $title, 'label_en' => $title, 'url' => null ],
					],
				] ); ?>

				<div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:1rem;flex-wrap:wrap">
					<?php if ( $category ) : ?>
						<span class="card__badge" style="background:rgba(178,135,75,0.2);color:var(--color-gold-300);border:1px solid rgba(178,135,75,0.35);font-size:0.8125rem;padding:0.35rem 0.85rem;border-radius:999px">
							<?php echo esc_html( $category ); ?>
						</span>
					<?php endif; ?>
					<?php if ( $year ) : ?>
						<span style="color:rgba(255,255,255,0.6);font-size:0.875rem">
							<?php echo esc_html( (string) $year ); ?> م
						</span>
					<?php endif; ?>
					<?php if ( $court ) : ?>
						<span style="color:rgba(255,255,255,0.4);font-size:0.875rem">•</span>
						<span style="color:rgba(255,255,255,0.75);font-size:0.875rem">
							🏛️ <?php echo esc_html( $court ); ?>
						</span>
					<?php endif; ?>
				</div>

				<h1 id="case-heading" class="st-page-hero__title" style="font-size:clamp(1.75rem, 3.5vw, 2.5rem);line-height:1.35;margin-bottom:1rem">
					<?php echo esc_html( $title ); ?>
				</h1>
			</div>
		</section>

		<!-- Content Section -->
		<section class="st-page-content" style="padding:4rem 0 6rem;background:var(--color-ivory-100)">
			<div class="container" style="max-width:56rem">

				<!-- 1. Case Result Banner -->
				<?php if ( $result ) : ?>
					<div style="background:#fff;border-radius:var(--radius-sm);border:1px solid rgba(178,135,75,0.3);border-inline-start:5px solid var(--color-gold-600);padding:1.5rem 1.75rem;margin-bottom:2.5rem;box-shadow:0 4px 20px rgba(11,19,43,0.03);display:flex;align-items:flex-start;gap:1rem">
						<span style="font-size:1.75rem;line-height:1" aria-hidden="true">⚖️</span>
						<div>
							<strong style="display:block;font-size:0.8125rem;text-transform:uppercase;color:var(--color-gold-600);margin-bottom:0.25rem;letter-spacing:0.05em">
								<?php echo esc_html( st_l( 'منطوق الحكم / النتيجة القانونية', 'Verdict & Legal Outcome' ) ); ?>
							</strong>
							<span style="font-size:1.15rem;font-weight:700;color:var(--color-navy-950);line-height:1.5">
								<?php echo esc_html( $result ); ?>
							</span>
						</div>
					</div>
				<?php endif; ?>

				<!-- 2. Main Case Details Box -->
				<div style="background:#fff;border-radius:var(--radius-sm);border:1px solid rgba(208,213,221,0.5);padding:2.5rem;margin-bottom:2.5rem;box-shadow:0 2px 12px rgba(11,19,43,0.02)">

					<!-- Facts & Summary -->
					<div style="margin-bottom:2.5rem">
						<h2 style="font-size:1.25rem;color:var(--color-navy-950);font-weight:700;margin-bottom:1rem;display:flex;align-items:center;gap:0.5rem">
							<span style="color:var(--color-gold-600)">▪</span>
							<?php echo esc_html( st_l( 'وقائع الاتهام وموضوع الدعوى', 'Case Facts & Allegations' ) ); ?>
						</h2>
						<p style="color:var(--color-gray-600);line-height:1.85;font-size:1rem;margin:0">
							<?php echo esc_html( $summary ); ?>
						</p>
					</div>

					<!-- Defense Strategy (if provided) -->
					<?php if ( $defense ) : ?>
						<div style="padding-top:2rem;border-top:1px solid rgba(208,213,221,0.4)">
							<h2 style="font-size:1.25rem;color:var(--color-navy-950);font-weight:700;margin-bottom:1rem;display:flex;align-items:center;gap:0.5rem">
								<span style="color:var(--color-gold-600)">▪</span>
								<?php echo esc_html( st_l( 'استراتيجية الدفاع وأسانيد البراءة', 'Defense Strategy & Legal Grounds' ) ); ?>
							</h2>
							<p style="color:var(--color-gray-600);line-height:1.85;font-size:1rem;margin:0">
								<?php echo esc_html( $defense ); ?>
							</p>
						</div>
					<?php endif; ?>

				</div>

				<!-- 3. Legal Disclaimers -->
				<div style="display:flex;flex-direction:column;gap:1rem;margin-bottom:3rem">
					<?php get_template_part( 'template-parts/shared/confidentiality-note' ); ?>
					<div class="st-disclaimer-box" style="margin:0">
						<p style="margin:0;font-size:0.875rem;color:var(--color-gray-600);line-height:1.6">
							<strong><?php echo esc_html( st_l( 'إخلاء مسؤولية:', 'Disclaimer:' ) ); ?></strong>
							<?php echo esc_html( st_l(
								'النتائج السابقة لا تضمن بالضرورة تحقيق النتيجة ذاتها في قضايا أخرى، حيث تخضع كل قضية لظروفها ووقائعها وأدلتها القانونية المستقلة.',
								'Past results do not guarantee the same outcome in future cases. Every legal matter depends on its unique facts and evidence.'
							) ); ?>
						</p>
					</div>
				</div>

				<!-- 4. CTA Action -->
				<div style="text-align:center;padding:2.5rem;background:var(--color-navy-950);border-radius:var(--radius-sm);color:#fff">
					<h3 style="font-size:1.35rem;margin-bottom:0.75rem;color:#fff;font-weight:700">
						<?php echo esc_html( st_l( 'هل تواجه قضية أو استفساراً جنائياً مشابهاً؟', 'Facing a similar criminal case?' ) ); ?>
					</h3>
					<p style="color:rgba(255,255,255,0.7);font-size:0.9375rem;max-width:32rem;margin:0 auto 1.5rem;line-height:1.6">
						<?php echo esc_html( st_l( 'تواصل مع مكتب المستشار محمد محسن لبحث ملف القضية وتقديم المشورة القانونية والدفاع اللازم.', 'Contact lawyer Mohamed Mohsen to review your case files and receive professional defense.' ) ); ?>
					</p>
					<a href="<?php echo esc_url( mml_contact_action_url() ); ?>" target="_blank" rel="noopener noreferrer" class="btn btn--gold js-analytics-cta">
						<?php echo esc_html( st_l( 'طلب استشارة عبر واتساب', 'WhatsApp Legal Consultation' ) ); ?>
					</a>
				</div>

			</div>
		</section>
		<?php
	endwhile;
endif;
get_footer();
