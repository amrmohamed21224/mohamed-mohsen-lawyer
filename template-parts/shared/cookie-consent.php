<?php
/**
 * Cookie Consent Banner
 */
?>
<div id="st-cookie-consent" class="st-cookie-consent" role="dialog" aria-live="polite" aria-label="<?php echo esc_attr( st_l( 'إشعار الكوكيز', 'Cookie notice' ) ); ?>" hidden>
	<div class="st-cookie-consent__inner">
		<p class="st-cookie-consent__text">
			<?php
			echo esc_html(
				st_l(
					'نستخدم ملفات تعريف الارتباط لتحسين تجربتك على الموقع. يمكنك قبول جميع الكوكيز أو رفض غير الضروري منها.',
					'We use cookies to improve your experience. You can accept all cookies or reject non-essential ones.'
				)
			);
			?>
			<a href="<?php echo esc_url( mml_lang_url( 'legal-disclaimer' ) ); ?>" class="st-cookie-consent__link">
				<?php echo esc_html( st_l( 'إخلاء المسؤولية', 'Legal disclaimer' ) ); ?>
			</a>
		</p>

		<div class="st-cookie-consent__actions">
			<button type="button" class="st-cookie-consent__btn st-cookie-consent__btn--reject js-cookie-reject">
				<?php echo esc_html( st_l( 'رفض', 'Reject' ) ); ?>
			</button>
			<button type="button" class="st-cookie-consent__btn st-cookie-consent__btn--settings js-cookie-settings">
				<?php echo esc_html( st_l( 'إعدادات', 'Settings' ) ); ?>
			</button>
			<button type="button" class="st-cookie-consent__btn st-cookie-consent__btn--accept js-cookie-accept">
				<?php echo esc_html( st_l( 'قبول الكل', 'Accept all' ) ); ?>
			</button>
		</div>

		<div class="st-cookie-consent__settings" id="st-cookie-settings-panel" hidden>
			<div class="st-cookie-consent__row">
				<span><?php echo esc_html( st_l( 'كوكيز ضرورية', 'Necessary cookies' ) ); ?></span>
				<span class="st-cookie-consent__always-on"><?php echo esc_html( st_l( 'مفعّلة دائمًا', 'Always on' ) ); ?></span>
			</div>
			<div class="st-cookie-consent__row">
				<label for="st-cookie-analytics">
					<?php echo esc_html( st_l( 'كوكيز تحليلية', 'Analytics cookies' ) ); ?>
				</label>
				<input type="checkbox" id="st-cookie-analytics" class="js-cookie-analytics-toggle">
			</div>
			<button type="button" class="st-cookie-consent__btn st-cookie-consent__btn--save js-cookie-save">
				<?php echo esc_html( st_l( 'حفظ التفضيلات', 'Save preferences' ) ); ?>
			</button>
		</div>
	</div>
</div>
