<?php
/**
 * Confidentiality Note — تنبيه عدم إرسال بيانات حساسة
 *
 * مصدر التصميم: مستخرج من Contact.tsx (البوكس الأصفر فوق textarea الموضوع) —
 * مطابق تمامًا للسكرين شوت المرفق (Image 2).
 *
 * الاستخدام الافتراضي (بدون تمرير args):
 * get_template_part('template-parts/shared/confidentiality-note');
 *
 * أو بنص مخصص:
 * get_template_part('template-parts/shared/confidentiality-note', null, [
 *     'text_ar' => '...', 'text_en' => '...',
 * ]);
 *
 * @var array $args {
 *     @type string $text_ar / $text_en نص مخصص (اختياري — له قيمة افتراضية مطابقة للتصميم الأصلي).
 * }
 */

$default_ar = 'لا ترسل أرقامًا قومية أو مستندات قضايا أو بيانات مالية أو معلومات شديدة الحساسية من خلال هذا النموذج.';
$default_en = 'Please do not submit national ID numbers, case documents, financial data, or highly sensitive information through this form.';

$text_ar = $args['text_ar'] ?? $default_ar;
$text_en = $args['text_en'] ?? $default_en;
?>
<div class="st-confidentiality-note" role="note">
	<?php echo esc_html( st_l( $text_ar, $text_en ) ); ?>
</div>