<?php
$default_ar = 'لا يوجد محتوى متاح حاليًا.';
$default_en = 'No content available at the moment.';
$message_ar = $args['message_ar'] ?? $default_ar;
$message_en = $args['message_en'] ?? $default_en;
$icon       = $args['icon'] ?? '📭';
?>
<div class="st-empty">
	<span class="st-empty__icon" aria-hidden="true"><?php echo esc_html( $icon ); ?></span>
	<p><?php echo esc_html( st_l( $message_ar, $message_en ) ); ?></p>
</div>
