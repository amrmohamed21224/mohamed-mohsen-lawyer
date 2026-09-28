<?php
/**
 * Map Consent Placeholder — عنصر خريطة جوجل مابس قبل الموافقة على تحميلها
 *
 * ⚠️ مكون نظام (System Component): لم يظهر أي عنصر خاص بخريطة جوجل مابس
 * داخل Contact.tsx المرفق (لا يوجد iframe أو map component في الملف).
 * بُني هنا بأسلوب محايد ومتسق مع هوية الموقع، بانتظار مراجعة بصرية لاحقًا
 * عند توفر تصميم مخصص له.
 *
 * الفكرة: لا يتم تحميل iframe جوجل مابس (وملفات تعقب الطرف الثالث المرتبطة
 * به) إلا بعد ضغط المستخدم على زرار "عرض الخريطة" — حماية للخصوصية.
 *
 * الاستخدام:
 * get_template_part('template-parts/shared/map-consent-placeholder');
 * // الرابط بيتقرأ تلقائيًا من ACF Option Field: google_maps_url
 *
 * @var array $args {
 *     @type string $maps_url رابط مخصص (اختياري — افتراضي: get_field('google_maps_url','option'))
 * }
 */

$maps_url = $args['maps_url'] ?? get_field( 'google_maps_url', 'option' );

if ( empty( $maps_url ) ) {
	return;
}
?>
<div class="st-map-consent" data-maps-url="<?php echo esc_url( $maps_url ); ?>">
	<div class="st-map-consent__placeholder js-map-consent-placeholder">
		<span class="st-map-consent__icon" aria-hidden="true">📍</span>
		<p class="st-map-consent__text">
			<?php
			echo esc_html(
				st_l(
					'لعرض موقع المكتب على خريطة جوجل، يلزم موافقتك على تحميل محتوى من طرف خارجي.',
					'To display the office location on Google Maps, your consent to load third-party content is required.'
				)
			);
			?>
		</p>
		<button type="button" class="st-map-consent__btn js-map-consent-load">
			<?php echo esc_html( st_l( 'عرض الخريطة', 'Show map' ) ); ?>
		</button>
	</div>
	<div class="st-map-consent__frame js-map-consent-frame" hidden></div>
</div>