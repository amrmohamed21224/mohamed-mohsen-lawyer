<?php
$items = [
	[
		'icon_svg' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/><circle cx="6" cy="12" r="3"/><path d="m3 12 3-7 3 7M15 19l3-7 3 7"/><path d="M15 19a3 3 0 1 0 6 0"/></svg>',
		'label_ar' => 'القضايا الجنائية',
		'label_en' => 'Criminal Defense',
		'sub_ar'   => 'التخصص الأساسي المعتمد',
		'sub_en'   => 'Core legal specialization',
	],
	[
		'icon_svg' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>',
		'label_ar' => 'سرية تامة ومطلقة',
		'label_en' => 'Strict Confidentiality',
		'sub_ar'   => 'حماية كاملة لبيانات الموكلين',
		'sub_en'   => 'Complete client privacy protection',
	],
	[
		'icon_svg' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>',
		'label_ar' => 'المنصورة — الدقهلية',
		'label_en' => 'Mansoura — Dakahlia',
		'sub_ar'   => 'ومحاكم الاستئناف والجنايات',
		'sub_en'   => 'Criminal & Appeal Courts',
	],
	[
		'icon_svg' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>',
		'label_ar' => 'التواصل المباشر',
		'label_en' => 'Direct Contact',
		'sub_ar'   => 'استجابة سريعة عبر الواتساب',
		'sub_en'   => 'Fast WhatsApp response',
	],
];
?>
<section class="trust-strip" aria-label="<?php echo esc_attr( st_l( 'مؤشرات الثقة', 'Trust indicators' ) ); ?>">
	<div class="container">
		<div class="trust-strip__grid">
			<?php foreach ( $items as $item ) : ?>
				<div class="trust-strip__item">
					<div class="trust-strip__icon-wrap" aria-hidden="true">
						<?php echo $item['icon_svg']; ?>
					</div>
					<div class="trust-strip__text">
						<span class="trust-strip__label"><?php echo esc_html( st_l( $item['label_ar'], $item['label_en'] ) ); ?></span>
						<span class="trust-strip__sub"><?php echo esc_html( st_l( $item['sub_ar'], $item['sub_en'] ) ); ?></span>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
