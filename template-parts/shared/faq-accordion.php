<?php
/**
 * FAQ Accordion — الأسئلة المتكررة
 *
 * مصدر التصميم: مستخرج من Home.tsx (AccordionItem + قسم FAQ) — مطابق للسكرين شوت المرفق.
 *
 * البيانات تُجلب من CPT: faq_item (خارج هذا الملف — لا يوجد WP_Query هنا).
 *
 * الاستخدام:
 * get_template_part('template-parts/shared/faq-accordion', null, [
 *     'label_ar'   => 'أسئلة شائعة',
 *     'label_en'   => 'FAQ',
 *     'heading_ar' => 'الأسئلة المتكررة',
 *     'heading_en' => 'Frequently Asked Questions',
 *     'faqs'       => [
 *         [ 'id' => 12, 'question_ar' => '...', 'question_en' => '...', 'answer_ar' => '...', 'answer_en' => '...' ],
 *     ],
 * ]);
 *
 * @var array $args {
 *     @type string $label_ar / $label_en   نص صغير فوق العنوان (اختياري).
 *     @type string $heading_ar / $heading_en عنوان القسم (اختياري، له قيمة افتراضية).
 *     @type array[] $faqs مصفوفة الأسئلة (إجباري).
 *     @type string $instance_prefix بادئة فريدة لو الكومبوننت هيتكرر أكتر من مرة بنفس الصفحة (اختياري).
 * }
 */

$faqs = isset( $args['faqs'] ) && is_array( $args['faqs'] ) ? $args['faqs'] : [];

if ( empty( $faqs ) ) {
	get_template_part( 'template-parts/shared/empty-state', null, [
		'message_ar' => 'لا توجد أسئلة شائعة متاحة حاليًا.',
		'message_en' => 'No FAQs available at the moment.',
	] );
	return;
}

$label_ar   = $args['label_ar'] ?? 'أسئلة شائعة';
$label_en   = $args['label_en'] ?? 'FAQ';
$heading_ar = $args['heading_ar'] ?? 'الأسئلة المتكررة';
$heading_en = $args['heading_en'] ?? 'Frequently Asked Questions';
$prefix     = ! empty( $args['instance_prefix'] ) ? sanitize_html_class( $args['instance_prefix'] ) : 'faq';
?>
<section class="st-faq" aria-labelledby="<?php echo esc_attr( $prefix ); ?>-heading">
	<div class="st-faq__intro">
		<span class="st-section-label"><?php echo esc_html( st_l( $label_ar, $label_en ) ); ?></span>
		<h2 id="<?php echo esc_attr( $prefix ); ?>-heading" class="st-faq__title">
			<?php echo esc_html( st_l( $heading_ar, $heading_en ) ); ?>
		</h2>
	</div>

	<dl class="st-faq__list">
		<?php foreach ( $faqs as $index => $faq ) :
			$item_id  = $prefix . '-' . ( $faq['id'] ?? $index );
			$question = st_l( $faq['question_ar'] ?? '', $faq['question_en'] ?? '' );
			$answer   = st_l( $faq['answer_ar'] ?? '', $faq['answer_en'] ?? '' );
			?>
			<div class="st-faq__item">
				<dt>
					<button
						type="button"
						class="st-faq__question js-faq-toggle"
						id="faq-btn-<?php echo esc_attr( $item_id ); ?>"
						aria-expanded="false"
						aria-controls="faq-panel-<?php echo esc_attr( $item_id ); ?>"
					>
						<span><?php echo esc_html( $question ); ?></span>
						<span class="st-faq__icon" aria-hidden="true">+</span>
					</button>
				</dt>
				<dd
					id="faq-panel-<?php echo esc_attr( $item_id ); ?>"
					class="st-faq__answer"
					role="region"
					aria-labelledby="faq-btn-<?php echo esc_attr( $item_id ); ?>"
					hidden
				>
					<div class="st-faq__answer-inner"><?php echo wp_kses_post( $answer ); ?></div>
				</dd>
			</div>
		<?php endforeach; ?>
	</dl>
</section>