<?php
$about_photo = function_exists( 'get_field' ) ? ( get_field( 'lawyer_about_photo', 'option' ) ?: get_field( 'lawyer_photo', 'option' ) ) : null;
$photo_url   = '';

if ( is_array( $about_photo ) && ! empty( $about_photo['url'] ) ) {
	$photo_url = $about_photo['url'];
} elseif ( is_string( $about_photo ) && ! empty( $about_photo ) ) {
	$photo_url = $about_photo;
}
?>
<section class="section section--ivory" aria-labelledby="about-heading">
	<div class="container">
		<div class="grid" style="grid-template-columns:1fr;gap:3rem;align-items:center">
			<style>@media(min-width:1024px){.about-preview-grid{display:grid!important;grid-template-columns:1fr 1fr;gap:5rem}}</style>
			<div class="about-preview-grid" style="display:contents">
				<div aria-hidden="true" style="position:relative">
					<div style="aspect-ratio:3/4;max-height:480px;background:var(--color-navy-800);border-radius:var(--radius-sm);overflow:hidden;display:flex;align-items:center;justify-content:center;text-align:center;color:rgba(255,255,255,0.3);position:relative;z-index:1">
						<?php if ( $photo_url ) : ?>
							<img src="<?php echo esc_url( $photo_url ); ?>" alt="<?php echo esc_attr( st_l( 'محمد محسن المحامي', 'Mohamed Mohsen Lawyer' ) ); ?>" style="width:100%;height:100%;object-fit:cover;object-position:center top;display:block">
						<?php else : ?>
							<div>
								<div style="width:6rem;height:6rem;border:1px solid rgba(178,135,75,0.4);border-radius:50%;margin:0 auto 1rem;display:flex;align-items:center;justify-content:center">
									<span style="font-family:var(--font-heading);color:var(--color-gold-600);font-size:2.5rem;font-weight:700">م م</span>
								</div>
								<p style="font-size:0.875rem"><?php echo esc_html( st_l( 'صورة المحامي — قيد الاعتماد', 'Lawyer photo — pending approval' ) ); ?></p>
							</div>
						<?php endif; ?>
					</div>
					<div style="position:absolute;bottom:-1rem;inset-inline-start:-1rem;width:4rem;height:4rem;border-bottom:2px solid var(--color-gold-600);border-inline-start:2px solid var(--color-gold-600);pointer-events:none;z-index:0"></div>
				</div>
				<div>
					<span class="gold-rule" aria-hidden="true"></span>
					<p class="section-label"><?php echo esc_html( st_l( 'عن المستشار', 'About the lawyer' ) ); ?></p>
					<h2 id="about-heading" class="section__title"><?php echo esc_html( st_l( 'محمد محسن المحامي', 'Mohamed Mohsen — Lawyer' ) ); ?></h2>
					<div class="st-prose">
						<p><?php echo esc_html( st_l(
							'محامٍ جنائي مُقيَّد بنقابة المحامين، مقره المنصورة، الدقهلية. يُعنى المكتب بتقديم الدفاع القانوني في القضايا الجنائية أمام المحاكم المختصة، مع الحرص الكامل على متابعة الموكل وإبلاغه بكل مستجدات قضيته.',
							'A criminal lawyer based in Mansoura, providing defense before competent courts with ongoing client updates.'
						) ); ?></p>
						<p><?php echo esc_html( st_l(
							'يرتكز عمل المكتب على الفحص الدقيق والتحليل المعمّق لمحاضر التحقيق وأدلة الثبوت، مع صياغة المذكرات القانونية ومتابعة كل مرحلة إجرائية بدقة وشفافية كاملة مع الموكل.',
							'Our practice focuses on thorough analysis of investigation reports and evidence, providing robust legal defense.'
						) ); ?></p>
					</div>
					<a href="<?php echo esc_url( mml_lang_url( 'about' ) ); ?>" class="card__link" style="margin-top:1.5rem;display:inline-block">
						<?php echo esc_html( st_l( 'اقرأ المزيد عن محمد محسن', 'Read more about Mohamed Mohsen' ) ); ?>
					</a>
				</div>
			</div>
		</div>
	</div>
</section>
