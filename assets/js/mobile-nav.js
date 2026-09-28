/**
 * assets/js/mobile-nav.js
 *
 * Vanilla JS لتفاعل القائمة وتأثير الهيدر بدون Layout Thrashing / Forced Reflow:
 * - فتح/قفل قائمة الموبايل (Off-canvas) + الخلفية المعتمة
 * - إغلاق بمفتاح Escape، أو الضغط على الخلفية، أو زر الإغلاق
 * - قفل تلقائي عند الرجوع لعرض سطح المكتب عبر matchMedia بدون reflow
 * - إضافة class "is-scrolled" على الهيدر عبر requestAnimationFrame
 */
document.addEventListener( 'DOMContentLoaded', function () {
	var header    = document.getElementById( 'site-header' );
	var toggleBtn = document.getElementById( 'mobile-nav-toggle' );
	var closeBtn  = document.getElementById( 'mobile-nav-close' );
	var menu      = document.getElementById( 'mobile-menu' );
	var overlay   = document.getElementById( 'mobile-nav-overlay' );

	if ( ! menu || ! toggleBtn ) {
		return;
	}

	function openMenu() {
		menu.classList.add( 'is-open' );
		if ( overlay ) {
			overlay.classList.add( 'is-open' );
		}
		toggleBtn.setAttribute( 'aria-expanded', 'true' );
		document.body.style.overflow = 'hidden';
		menu.focus();
	}

	function closeMenu() {
		menu.classList.remove( 'is-open' );
		if ( overlay ) {
			overlay.classList.remove( 'is-open' );
		}
		toggleBtn.setAttribute( 'aria-expanded', 'false' );
		document.body.style.overflow = '';
		toggleBtn.focus();
	}

	toggleBtn.addEventListener( 'click', function () {
		var isOpen = menu.classList.contains( 'is-open' );
		if ( isOpen ) {
			closeMenu();
		} else {
			openMenu();
		}
	} );

	if ( closeBtn ) {
		closeBtn.addEventListener( 'click', closeMenu );
	}

	if ( overlay ) {
		overlay.addEventListener( 'click', closeMenu );
	}

	document.addEventListener( 'keydown', function ( e ) {
		if ( e.key === 'Escape' && menu.classList.contains( 'is-open' ) ) {
			closeMenu();
		}
	} );

	// إغلاق القائمة تلقائيًا عبر MediaQueryList بدون قياسات تخطيط إجبارية (No Reflow)
	if ( window.matchMedia ) {
		var desktopMql = window.matchMedia( '(min-width: 1024px)' );
		var handleBreakpointChange = function ( e ) {
			if ( e.matches && menu.classList.contains( 'is-open' ) ) {
				closeMenu();
			}
		};
		if ( desktopMql.addEventListener ) {
			desktopMql.addEventListener( 'change', handleBreakpointChange );
		} else if ( desktopMql.addListener ) {
			desktopMql.addListener( handleBreakpointChange );
		}
	}

	// تأثير خلفية الهيدر عند التمرير بأداء فائق عبر requestAnimationFrame
	if ( header ) {
		var ticking = false;
		var updateHeader = function () {
			var scrollY = window.pageYOffset || document.documentElement.scrollTop || 0;
			if ( scrollY > 48 ) {
				header.classList.add( 'is-scrolled' );
			} else {
				header.classList.remove( 'is-scrolled' );
			}
			ticking = false;
		};

		window.addEventListener( 'scroll', function () {
			if ( ! ticking ) {
				window.requestAnimationFrame( updateHeader );
				ticking = true;
			}
		}, { passive: true } );

		// تهيئة أولية عبر rAF لتجنب حجب التخطيط الأولي
		window.requestAnimationFrame( updateHeader );
	}
} );
