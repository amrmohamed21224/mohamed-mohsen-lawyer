<?php
$message = $args['message'] ?? st_l( 'تم إرسال طلبك بنجاح. سيتواصل المكتب معك بعد مراجعة البيانات.', 'Your request was sent successfully.' );
?>
<div class="st-form-success" role="status">
	<p><?php echo esc_html( $message ); ?></p>
</div>
