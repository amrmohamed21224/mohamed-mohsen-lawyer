<?php
/**
 * template-parts/footer/site-footer.php
 *
 * الفوتر الرئيسي مع روابط السوشيال ميديا وأيقونات SVG الاحترافية
 */
$phone   = mml_get_option( 'primary_phone', '01064397662' );
$email   = mml_get_option( 'public_email', 'info@mohamed-mohsen-lawyer.com' );
$address = st_l(
	(string) mml_get_option( 'office_address_ar', 'المنصورة، محافظة الدقهلية، مصر' ),
	(string) mml_get_option( 'office_address_en', 'Mansoura, Dakahlia Governorate, Egypt' )
);
$disclaimer = st_l(
	(string) mml_get_option( 'footer_disclaimer_ar', 'المحتوى الوارد في هذا الموقع هو معلومات عامة وليس استشارة قانونية لحالة محددة. إرسال طلب تواصل لا يُنشئ علاقة محامٍ وموكل.' ),
	(string) mml_get_option( 'footer_disclaimer_en', 'Content on this site is general information, not legal advice. Contact requests do not create an attorney-client relationship.' )
);

$nav_links = [
	[ 'label_ar' => 'الرئيسية', 'label_en' => 'Home', 'url' => mml_lang_url( '' ) ],
	[ 'label_ar' => 'عن المستشار', 'label_en' => 'About', 'url' => mml_lang_url( 'about' ) ],
	[ 'label_ar' => 'الخدمات القانونية', 'label_en' => 'Services', 'url' => mml_lang_url( 'services' ) ],
	[ 'label_ar' => 'الخبرات والنتائج', 'label_en' => 'Experience', 'url' => mml_lang_url( 'experience' ) ],
	[ 'label_ar' => 'الفيديوهات', 'label_en' => 'Media', 'url' => mml_lang_url( 'media' ) ],
];

// جلب روابط السوشيال ميديا من ACF مع Fallback للروابط الرسمية المعتمدة
$raw_socials = function_exists( 'get_field' ) ? get_field( 'social_links', 'option' ) : null;
$social_links = [];

if ( ! empty( $raw_socials ) && is_array( $raw_socials ) ) {
	foreach ( $raw_socials as $s ) {
		if ( ! empty( $s['url'] ) ) {
			$social_links[] = [
				'platform' => $s['platform'] ?? 'other',
				'url'      => $s['url'],
			];
		}
	}
}

// إذا لم يتم إدخال روابط مخصصة بعد، نضع الروابط الرسمية من وثيقة المشروع
if ( empty( $social_links ) ) {
	$social_links = [
		[
			'platform' => 'facebook',
			'url'      => 'https://www.facebook.com/p/محمد-محسن-المحامى-100054629881049/',
		],
		[
			'platform' => 'tiktok',
			'url'      => 'https://www.tiktok.com/@mohamedmohsenelmhdy',
		],
	];
}
?>
<footer id="site-footer" class="site-footer" role="contentinfo">
	<div class="site-footer__inner container">
		<div class="site-footer__grid">
			<div class="site-footer__brand-col">
				<div class="site-footer__brand">
					<span class="site-footer__name">
						<?php
						$site_title = get_bloginfo( 'name' );
						echo esc_html( ( $site_title && $site_title !== 'My Blog' && $site_title !== 'Just another WordPress site' ) ? $site_title : st_l( 'محمد محسن', 'Mohamed Mohsen' ) );
						?>
					</span>
				</div>
				<p class="site-footer__desc">
					<?php echo esc_html( st_l(
						'مكتب قانوني متخصص في القضايا الجنائية بالمنصورة، الدقهلية، مصر. نسعى إلى تقديم مساندة قانونية قائمة على دراسة دقيقة للوقائع، مع الالتزام الكامل بسرية الموكل.',
						'A criminal law firm in Mansoura, Egypt, committed to careful case review and client confidentiality.'
					) ); ?>
				</p>

				<?php if ( ! empty( $social_links ) ) : ?>
					<div class="site-footer__socials">
						<span class="site-footer__socials-label"><?php echo esc_html( st_l( 'تابعنا على:', 'Follow us:' ) ); ?></span>
						<div class="site-footer__social-icons">
							<?php foreach ( $social_links as $social ) :
								$plat = strtolower( $social['platform'] );
								$url  = $social['url'];
								?>
								<a
									href="<?php echo esc_url( $url ); ?>"
									target="_blank"
									rel="noopener noreferrer"
									class="site-footer__social-btn site-footer__social-btn--<?php echo esc_attr( $plat ); ?>"
									aria-label="<?php echo esc_attr( ucfirst( $plat ) ); ?>"
								>
									<?php if ( $plat === 'facebook' ) : ?>
										<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
									<?php elseif ( $plat === 'tiktok' ) : ?>
										<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
									<?php elseif ( $plat === 'youtube' ) : ?>
										<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
									<?php elseif ( $plat === 'linkedin' ) : ?>
										<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
									<?php elseif ( $plat === 'instagram' ) : ?>
										<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
									<?php else : ?>
										<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg>
									<?php endif; ?>
								</a>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>

				<p class="site-footer__note"><?php echo esc_html( $disclaimer ); ?></p>
			</div>

			<div class="site-footer__col">
				<h3 class="site-footer__heading"><?php echo esc_html( st_l( 'صفحات الموقع', 'Site pages' ) ); ?></h3>
				<ul class="site-footer__links" role="list">
					<?php foreach ( $nav_links as $link ) : ?>
						<li>
							<a href="<?php echo esc_url( $link['url'] ); ?>">
								<?php echo esc_html( st_l( $link['label_ar'], $link['label_en'] ) ); ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>

			<div class="site-footer__col">
				<h3 class="site-footer__heading"><?php echo esc_html( st_l( 'التواصل', 'Contact' ) ); ?></h3>
				<address class="site-footer__address">
					<p><?php echo esc_html( $address ); ?></p>
					<?php if ( $phone ) : ?>
						<p><a href="<?php echo esc_url( mml_tel_link( $phone ) ); ?>" class="js-analytics-phone"><?php echo esc_html( $phone ); ?></a></p>
					<?php endif; ?>
					<?php if ( $email ) : ?>
						<p><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></p>
					<?php endif; ?>
				</address>

				<h3 class="site-footer__heading site-footer__heading--legal"><?php echo esc_html( st_l( 'قانوني', 'Legal' ) ); ?></h3>
				<ul class="site-footer__links" role="list">
					<li>
						<a href="<?php echo esc_url( mml_lang_url( 'legal-disclaimer' ) ); ?>">
							<?php echo esc_html( st_l( 'إخلاء المسؤولية', 'Legal disclaimer' ) ); ?>
						</a>
					</li>
				</ul>
			</div>
		</div>

		<?php get_template_part( 'template-parts/footer/footer-disclaimer' ); ?>
	</div>
</footer>
