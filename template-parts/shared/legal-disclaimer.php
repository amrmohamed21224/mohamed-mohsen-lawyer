<?php
/**
 * Legal Disclaimer — إخلاء مسؤولية قانوني (نص طويل داخل محتوى الصفحة)
 *
 * ⚠️ ملحوظة: هذا مكون مختلف عن footer-disclaimer.php (اللي جوه الفوتر).
 * ده مكون بيتحط جوه محتوى الصفحة نفسها (مثال: صفحة الخبرات، صفحة خدمة معينة).
 *
 * مصدر التصميم: لم يظهر تصميم مخصص منفصل لهذا المكون داخل Home.tsx/Contact.tsx
 * بشكل صريح (اللي ظهر في الملفين كان نص "النتائج السابقة لا تضمن..." في قسم
 * experience-preview، ونص التنبيه في صفحة التواصل). بُني هنا بأسلوب محايد
 * ومتسق مع هوية الموقع (نفس الـ CSS variables) بانتظار مراجعة بصرية عند
 * توفر تصميم مخصص له.
 *
 * الاستخدام:
 * get_template_part('template-parts/shared/legal-disclaimer', null, [
 *     'text_ar' => 'النتائج السابقة لا تضمن تحقيق النتيجة نفسها في أي قضية أخرى...',
 *     'text_en' => 'Past results do not guarantee...',
 * ]);
 *
 * @var array $args {
 *     @type string $title_ar / $title_en اختياري — عنوان صغير فوق النص.
 *     @type string $text_ar / $text_en    إجباري — نص إخلاء المسؤولية.
 *     @type string $variant                'default' | 'subtle' (اختياري، شكل بصري أخف).
 * }
 */

$text_ar = $args['text_ar'] ?? 'النتائج السابقة لا تضمن تحقيق النتيجة نفسها في أي قضية أخرى، لأن كل حالة تخضع لوقائعها ومستنداتها والإجراءات القانونية الخاصة بها.';
$text_en = $args['text_en'] ?? 'Past results do not guarantee the same outcome in any other case.';

$title_ar = $args['title_ar'] ?? 'إخلاء مسؤولية';
$title_en = $args['title_en'] ?? 'Legal Disclaimer';
$variant  = ! empty( $args['variant'] ) ? sanitize_html_class( $args['variant'] ) : 'default';
?>
<div class="st-legal-disclaimer st-legal-disclaimer--<?php echo esc_attr( $variant ); ?>" role="note">
	<strong class="st-legal-disclaimer__title">
		<?php echo esc_html( st_l( $title_ar, $title_en ) ); ?>
	</strong>
	<p class="st-legal-disclaimer__text">
		<?php echo esc_html( st_l( $text_ar, $text_en ) ); ?>
	</p>
</div>