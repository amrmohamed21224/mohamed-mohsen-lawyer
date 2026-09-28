<?php
/**
 * Template Name: About Page
 *
 * @package MohamedMohsenLawyer
 */
get_header();

$lawyer_name = 'محمد محسن';
$about_photo = function_exists( 'get_field' ) ? get_field( 'lawyer_about_photo', 'option' ) : null;
$photo_url   = '';

if ( is_array( $about_photo ) && ! empty( $about_photo['url'] ) ) {
	$photo_url = $about_photo['url'];
} elseif ( is_string( $about_photo ) && ! empty( $about_photo ) ) {
	$photo_url = $about_photo;
}
?>
<!-- Page Hero -->
<section class="st-page-hero" aria-labelledby="about-page-heading">
	<div class="container">
		<?php get_template_part( 'template-parts/shared/breadcrumbs', null, [
			'items' => [ [ 'label_ar' => 'عن المستشار', 'label_en' => 'About', 'url' => null ] ],
		] ); ?>
		<p class="section-label" style="margin-bottom:0.75rem"><?php echo esc_html( st_l( 'التعريف بالمحامي', 'About the Lawyer' ) ); ?></p>
		<h1 id="about-page-heading" class="st-page-hero__title">
			<?php echo esc_html( sprintf( st_l( 'عن %s المحامي', 'About %s — Lawyer' ), $lawyer_name ) ); ?>
		</h1>
	</div>
</section>

<!-- Main Page Content -->
<div class="st-page-content" style="padding:5rem 0">
	<div class="container">
		<div class="about-layout-grid">

			<!-- Sidebar: Photo & Quick Facts -->
			<aside class="about-sidebar">
				<div class="about-sidebar__sticky">

					<!-- Photo Card -->
					<div class="about-photo-card" aria-hidden="true">
						<?php if ( $photo_url ) : ?>
							<img src="<?php echo esc_url( $photo_url ); ?>" alt="<?php echo esc_attr( $lawyer_name ); ?>" style="width:100%;height:100%;object-fit:cover;display:block">
						<?php else : ?>
							<div class="about-photo-card__inner">
								<div class="about-photo-card__circle">
									<span>م م</span>
								</div>
								<p class="about-photo-card__label">
									<?php echo esc_html( st_l( 'صورة احترافية', 'Professional Photo' ) ); ?><br>
									<small style="opacity:0.6"><?php echo esc_html( st_l( 'قيد الاعتماد', 'Pending Approval' ) ); ?></small>
								</p>
							</div>
						<?php endif; ?>
					</div>

					<!-- Quick Facts Card -->
					<div class="about-facts-card">
						<?php
						$facts = [
							[ 'label_ar' => 'التخصص', 'label_en' => 'Specialty', 'value_ar' => 'المحاماة الجنائية', 'value_en' => 'Criminal Defense' ],
							[ 'label_ar' => 'درجة القيد النقابي', 'label_en' => 'Bar Registration', 'value_ar' => 'محامٍ بالاستئناف العالي ومحاكم الجنايات', 'value_en' => 'High Appeal & Criminal Courts Lawyer' ],
							[ 'label_ar' => 'الجامعة والتخرج', 'label_en' => 'Education', 'value_ar' => 'كلية الحقوق — جامعة المنصورة', 'value_en' => 'Faculty of Law — Mansoura University' ],
							[ 'label_ar' => 'المحاكم المخدومة', 'label_en' => 'Courts Served', 'value_ar' => 'محاكم الجنايات والجنح بالمنصورة والمحافظات', 'value_en' => 'Mansoura Criminal & Misdemeanor Courts' ],
							[ 'label_ar' => 'المنطقة الجغرافية', 'label_en' => 'Location', 'value_ar' => 'المنصورة — الدقهلية', 'value_en' => 'Mansoura — Dakahlia' ],
						];
						foreach ( $facts as $fact ) :
						?>
							<div class="about-facts-card__row">
								<span class="about-facts-card__label"><?php echo esc_html( st_l( $fact['label_ar'], $fact['label_en'] ) ); ?></span>
								<span class="about-facts-card__value"><?php echo esc_html( st_l( $fact['value_ar'], $fact['value_en'] ) ); ?></span>
							</div>
						<?php endforeach; ?>
					</div>

				</div>
			</aside>

			<!-- Main Content Column -->
			<main class="about-main-content">

				<!-- 1. Bio Section -->
				<section class="about-section">
					<span class="gold-rule" aria-hidden="true"></span>
					<h2 class="about-section__title"><?php echo esc_html( st_l( 'السيرة المهنية', 'Professional Biography' ) ); ?></h2>
					<div class="st-prose">
						<?php
						$bio = mml_get_field_lang( get_the_ID(), 'about_bio' );
						if ( $bio ) {
							echo wp_kses_post( $bio );
						} else {
							?>
							<p>
								<?php echo esc_html( st_l(
									'محمد محسن محامٍ جنائي مُقيَّد بنقابة المحامين المصرية، يمارس مهنة المحاماة في المنصورة، الدقهلية، مصر. يتخصص المكتب في تقديم الدفاع الجنائي والدفوع القانونية الرصينة أمام محاكم الجنايات والجنح والنيابة العامة.',
									'Mohamed Mohsen is a criminal defense lawyer based in Mansoura, Dakahlia, Egypt, specializing in criminal defense before criminal and misdemeanor courts.'
								) ); ?>
							</p>
							<p>
								<?php echo esc_html( st_l(
									'يرتكز عمل المكتب على الفحص الدقيق والتحليل المعمّق لمحاضر التحقيق وأدلة الثبوت، مع صياغة المذكرات القانونية ومتابعة كل مرحلة إجرائية بدقة وشفافية كاملة مع الموكل، حفاظاً على حقوقه وسرية بياناته.',
									'Our practice focuses on thorough analysis of investigation reports and evidence, providing robust legal defense while maintaining strict confidentiality.'
								) ); ?>
							</p>
							<?php
						}
						?>
					</div>
				</section>

				<!-- 2. Qualifications Section -->
				<section class="about-section">
					<h2 class="about-section__title"><?php echo esc_html( st_l( 'المؤهلات الأكاديمية والمهنية', 'Academic & Professional Qualifications' ) ); ?></h2>
					<div class="about-qualifications-list">
						<?php
						$quals = mml_get_field_lang( get_the_ID(), 'about_qualifications' );
						if ( $quals ) {
							echo '<div class="st-prose">' . wp_kses_post( $quals ) . '</div>';
						} else {
							$default_quals = [
								'ليسانس الحقوق — جامعة المنصورة',
								'عضو نقابة المحامين المصرية (قيد الاستئناف والجنايات)',
								'متخصص في قضايا الجنايات والطعون الجنائية ومراحل التحقيق والمحاكمة',
							];
							foreach ( $default_quals as $q_text ) :
								?>
								<div class="about-qualifications-item">
									<span class="about-qualifications-item__dot" aria-hidden="true"></span>
									<span class="about-qualifications-item__text"><?php echo esc_html( $q_text ); ?></span>
								</div>
								<?php
							endforeach;
						}
						?>
					</div>
				</section>

				<!-- 3. Work Approach Section -->
				<section class="about-section">
					<h2 class="about-section__title"><?php echo esc_html( st_l( 'منهج العمل', 'Work Methodology' ) ); ?></h2>
					<div class="about-approach-grid">
						<?php
						$approach_items = [
							[
								'title_ar' => 'دراسة الوقائع والمستندات',
								'title_en' => 'Careful Review of Facts',
								'body_ar'  => 'يبدأ كل ملف بمراجعة شاملة للمستندات والوقائع قبل اتخاذ أي خطوة إجرائية.',
								'body_en'  => 'Every case starts with an in-depth review of facts before any procedural step.',
							],
							[
								'title_ar' => 'توضيح الخيارات القانونية',
								'title_en' => 'Clear Legal Options',
								'body_ar'  => 'يحرص المكتب على شرح الخيارات المتاحة للموكل بوضوح، بدون وعود بنتائج محددة.',
								'body_en'  => 'We explain available options clearly to the client, without making promises on outcomes.',
							],
							[
								'title_ar' => 'الالتزام بالسرية التامة',
								'title_en' => 'Strict Confidentiality',
								'body_ar'  => 'جميع بيانات الموكل وتفاصيل القضية محمية بالسرية الكاملة طوال مراحل القضية.',
								'body_en'  => 'All client data and case details are strictly confidential at all stages.',
							],
							[
								'title_ar' => 'متابعة مستمرة وإبلاغ منتظم',
								'title_en' => 'Continuous Updates',
								'body_ar'  => 'يُبلَّغ الموكل بكل مستجد إجرائي ويتم التواصل بصورة منتظمة طوال فترة التمثيل.',
								'body_en'  => 'Clients receive regular updates on case hearings and legal procedures.',
							],
						];
						foreach ( $approach_items as $item ) :
						?>
							<div class="about-approach-card">
								<h3 class="about-approach-card__title"><?php echo esc_html( st_l( $item['title_ar'], $item['title_en'] ) ); ?></h3>
								<p class="about-approach-card__desc"><?php echo esc_html( st_l( $item['body_ar'], $item['body_en'] ) ); ?></p>
							</div>
						<?php endforeach; ?>
					</div>
				</section>

				<!-- 4. Office Values Section -->
				<section class="about-section">
					<h2 class="about-section__title"><?php echo esc_html( st_l( 'قيم المكتب', 'Firm Values' ) ); ?></h2>
					<ul class="about-values-list" role="list">
						<?php
						$values = [
							[ 'ar' => 'النزاهة المهنية والالتزام بأخلاقيات المحاماة', 'en' => 'Professional integrity and legal ethics' ],
							[ 'ar' => 'سرية المعلومات وحماية بيانات الموكل', 'en' => 'Information confidentiality and client privacy' ],
							[ 'ar' => 'الصراحة والوضوح في تقديم المشورة القانونية', 'en' => 'Transparency and clarity in legal advice' ],
							[ 'ar' => 'الالتزام بالمواعيد ومتابعة إجراءات القضية', 'en' => 'Punctuality and procedural follow-up' ],
						];
						foreach ( $values as $val ) :
						?>
							<li class="about-values-item">
								<span class="about-values-item__icon" aria-hidden="true">
									<span class="about-values-item__dot"></span>
								</span>
								<span class="about-values-item__text"><?php echo esc_html( st_l( $val['ar'], $val['en'] ) ); ?></span>
							</li>
						<?php endforeach; ?>
					</ul>
				</section>

			</main>
		</div>

		<!-- 5. CTA Box Centered Full Width -->
		<div class="about-cta-box" style="max-width:54rem;margin:3.5rem auto 0;text-align:center">
			<h2 class="about-cta-box__title"><?php echo esc_html( st_l( 'هل تحتاج إلى استشارة قانونية؟', 'Need a legal consultation?' ) ); ?></h2>
			<p class="about-cta-box__desc"><?php echo esc_html( st_l( 'تواصل مع المكتب للحصول على المساعدة القانونية المناسبة.', 'Contact the firm to receive the appropriate legal assistance.' ) ); ?></p>
			<a href="<?php echo esc_url( mml_contact_action_url() ); ?>" target="_blank" rel="noopener noreferrer" class="btn btn--gold">
				<?php echo esc_html( st_l( 'تواصل عبر واتساب', 'Contact on WhatsApp' ) ); ?>
			</a>
		</div>

	</div>
</div>

<?php get_footer(); ?>
