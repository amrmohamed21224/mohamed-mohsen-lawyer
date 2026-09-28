<?php
/**
 * Pagination — ترقيم الصفحات (للمقالات لاحقًا)
 *
 * ⚠️ مكون نظام (System Component): لم يظهر تصميم مخصص له داخل Home.tsx أو
 * Contact.tsx. بُني بأسلوب محايد ومتسق مع هوية الموقع، بانتظار مراجعة بصرية
 * لاحقًا عند توفر تصميم مخصص له.
 *
 * لا يوجد استعلام (Query) داخل هذا الملف — يعتمد على WP_Query الحالي في
 * الصفحة (عبر $wp_query العام)، أو يقبل total_pages/current صراحة لو الصفحة
 * بتستخدم WP_Query مخصص.
 *
 * الاستخدام:
 * get_template_part('template-parts/shared/pagination'); // يعتمد على الاستعلام الرئيسي
 * // أو
 * get_template_part('template-parts/shared/pagination', null, [
 *     'total_pages' => $my_query->max_num_pages,
 *     'current'     => $paged,
 * ]);
 *
 * @var array $args {
 *     @type int $total_pages (اختياري — افتراضي: $wp_query->max_num_pages)
 *     @type int $current     (اختياري — افتراضي: الصفحة الحالية من الرابط)
 * }
 */

global $wp_query;

$total_pages = isset( $args['total_pages'] ) ? (int) $args['total_pages'] : (int) $wp_query->max_num_pages;
$current     = isset( $args['current'] ) ? (int) $args['current'] : max( 1, get_query_var( 'paged' ), get_query_var( 'page' ) );

if ( $total_pages < 2 ) {
	return;
}

$base_links = paginate_links( [
	'total'     => $total_pages,
	'current'   => $current,
	'mid_size'  => 1,
	'end_size'  => 1,
	'prev_text' => st_is_rtl() ? '→' : '←',
	'next_text' => st_is_rtl() ? '←' : '→',
	'type'      => 'array',
] );

if ( empty( $base_links ) ) {
	return;
}
?>
<nav class="st-pagination" aria-label="<?php echo esc_attr( st_l( 'ترقيم الصفحات', 'Pagination' ) ); ?>">
	<ul class="st-pagination__list" role="list">
		<?php foreach ( $base_links as $link ) : ?>
			<li class="st-pagination__item"><?php echo wp_kses_post( $link ); ?></li>
		<?php endforeach; ?>
	</ul>
</nav>