<?php
/**
 * template-parts/header/mobile-nav.php
 *
 * قائمة الموبايل (Off-canvas) + الخلفية المعتمة خلفها.
 * الفتح/القفل بالكامل عبر assets/js/mobile-nav.js
 * (إضافة/إزالة class "is-open" على #mobile-menu و #mobile-nav-overlay).
 */
?>
<div id="mobile-nav-overlay" class="mobile-nav-overlay" aria-hidden="true"></div>

<div
	id="mobile-menu"
	class="mobile-nav"
	role="dialog"
	aria-modal="true"
	aria-label="<?php echo esc_attr( st_l( 'القائمة الرئيسية', 'Main menu' ) ); ?>"
	tabindex="-1"
>
	<div class="mobile-nav__header">
		<a href="<?php echo esc_url( mml_lang_url( '' ) ); ?>" class="mobile-nav__brand">
			<?php
			$site_title = get_bloginfo( 'name' );
			echo esc_html( ( $site_title && $site_title !== 'My Blog' && $site_title !== 'Just another WordPress site' ) ? $site_title : st_l( 'محمد محسن', 'Mohamed Mohsen' ) );
			?>
		</a>
		<button
			type="button"
			id="mobile-nav-close"
			class="mobile-nav__close"
			aria-label="<?php echo esc_attr( st_l( 'إغلاق القائمة', 'Close menu' ) ); ?>"
		>
			<span aria-hidden="true">&times;</span>
		</button>
	</div>

	<nav class="mobile-nav__nav" aria-label="<?php echo esc_attr( st_l( 'قائمة الجوال', 'Mobile menu' ) ); ?>">
		<?php
		wp_nav_menu( array(
			'theme_location' => 'primary',
			'container'      => false,
			'menu_class'     => 'mobile-nav__menu',
			'fallback_cb'    => 'mml_primary_menu_fallback',
			'depth'          => 1,
		) );
		?>
	</nav>

	<div class="mobile-nav__footer">
		<a
			href="<?php echo esc_url( mml_contact_action_url() ); ?>"
			target="_blank"
			rel="noopener noreferrer"
			class="mobile-nav__cta js-analytics-whatsapp"
		>
			<?php echo esc_html( st_l( 'تواصل عبر واتساب', 'WhatsApp Contact' ) ); ?>
		</a>
	</div>
</div>