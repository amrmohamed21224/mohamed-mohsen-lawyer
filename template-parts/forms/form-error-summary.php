<?php
$errors = $args['errors'] ?? [];
if ( empty( $errors ) ) {
	return;
}
?>
<div class="st-form-errors" role="alert">
	<p><strong><?php echo esc_html( st_l( 'يرجى تصحيح الأخطاء التالية:', 'Please fix the following errors:' ) ); ?></strong></p>
	<ul>
		<?php foreach ( $errors as $error ) : ?>
			<li><?php echo esc_html( $error ); ?></li>
		<?php endforeach; ?>
	</ul>
</div>
