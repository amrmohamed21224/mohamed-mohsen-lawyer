<?php
/**
 * Breadcrumbs — مسار التنقل
 *
 * مصدر التصميم: مستخرج من Contact.tsx (nav aria-label="مسار التنقل")
 *
 * الاستخدام:
 * get_template_part('template-parts/shared/breadcrumbs', null, [
 *     'items' => [
 *         [ 'label_ar' => 'تواصل معنا', 'label_en' => 'Contact', 'url' => null ], // null = الصفحة الحالية
 *     ],
 * ]);
 *
 * ملحوظة: رابط "الرئيسية" يُضاف تلقائيًا كأول عنصر، لا داعي لتمريره ضمن $args['items'].
 *
 * @var array $args {
 *     @type array[] $items مصفوفة عناصر إضافية بعد الرئيسية.
 *                          كل عنصر: label_ar, label_en, url (اتركه null للعنصر الحالي/الأخير).
 * }
 */

$items = isset( $args['items'] ) && is_array( $args['items'] ) ? $args['items'] : [];

$home_item = [
	'label_ar' => 'الرئيسية',
	'label_en' => 'Home',
	'url'      => mml_lang_url( '' ),
];

$all_items = array_merge( [ $home_item ], $items );
$last_index = count( $all_items ) - 1;
?>
<nav class="st-breadcrumbs" aria-label="<?php echo esc_attr( st_l( 'مسار التنقل', 'Breadcrumb' ) ); ?>">
	<ol class="st-breadcrumbs__list" role="list">
		<?php foreach ( $all_items as $index => $item ) :
			$is_current = ( null === $item['url'] ) || ( $index === $last_index );
			$label      = st_l( $item['label_ar'], $item['label_en'] );
			?>
			<li class="st-breadcrumbs__item">
				<?php if ( ! $is_current && ! empty( $item['url'] ) ) : ?>
					<a class="st-breadcrumbs__link" href="<?php echo esc_url( $item['url'] ); ?>">
						<?php echo esc_html( $label ); ?>
					</a>
					<span class="st-breadcrumbs__sep" aria-hidden="true">/</span>
				<?php else : ?>
					<span class="st-breadcrumbs__current" aria-current="page">
						<?php echo esc_html( $label ); ?>
					</span>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
	</ol>
</nav>