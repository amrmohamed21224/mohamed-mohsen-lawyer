<?php
/**
 * template-parts/header/site-header.php
 *
 * الهيدر الرئيسي: الشعار + قائمة سطح المكتب (wp_nav_menu) + زر CTA
 * + زر فتح قائمة الموبايل. القائمة نفسها (Off-canvas) في mobile-nav.php.
 *
 * التفاعل (تأثير التمرير is-scrolled + فتح/قفل قائمة الموبايل)
 * موجود في assets/js/mobile-nav.js — لا تكتب JS هنا.
 */
?>
<header id="site-header" class="site-header" role="banner">
	<div class="site-header__inner">

		<a
			href="<?php echo esc_url( mml_lang_url( '' ) ); ?>"
			class="site-header__brand"
			aria-label="<?php echo esc_attr( sprintf( st_l( '%s — الصفحة الرئيسية', '%s — Homepage' ), get_bloginfo( 'name' ) ) ); ?>"
		>
			<span class="site-header__title">
				<?php
				$site_title = get_bloginfo( 'name' );
				echo esc_html( ( $site_title && $site_title !== 'My Blog' && $site_title !== 'Just another WordPress site' ) ? $site_title : st_l( 'محمد محسن', 'Mohamed Mohsen' ) );
				?>
				<span class="site-header__tagline">
					<?php echo esc_html( st_l( 'المحامي الجنائي', 'Criminal Defense Lawyer' ) ); ?>
				</span>
			</span>
		</a>

		<nav class="site-header__nav" aria-label="<?php echo esc_attr( st_l( 'القائمة الرئيسية', 'Main menu' ) ); ?>">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'site-header__menu',
				'fallback_cb'    => 'mml_primary_menu_fallback',
				'depth'          => 1,
			) );
			?>
		</nav>

		<a
			href="<?php echo esc_url( mml_contact_action_url() ); ?>"
			target="_blank"
			rel="noopener noreferrer"
			class="site-header__cta js-analytics-whatsapp"
		>
			<?php echo esc_html( st_l( 'تواصل عبر واتساب', 'WhatsApp Contact' ) ); ?>
		</a>

		<button
			type="button"
			id="mobile-nav-toggle"
			class="site-header__toggle"
			aria-label="<?php echo esc_attr( st_l( 'فتح القائمة', 'Open menu' ) ); ?>"
			aria-expanded="false"
			aria-controls="mobile-menu"
		>
			<span class="sr-only"><?php echo esc_html( st_l( 'قائمة', 'Menu' ) ); ?></span>
			<span class="site-header__burger" aria-hidden="true">
				<span></span>
				<span></span>
				<span></span>
			</span>
		</button>

	</div>
</header>

<?php get_template_part( 'template-parts/header/mobile-nav' ); ?>