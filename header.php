<?php
/**
 * header.php
 *
 * يفتح هيكل HTML الأساسي للصفحة (html/head/body)، يستدعي wp_head(),
 * يستدعي الهيدر الفعلي من template-parts/header/site-header.php،
 * ثم يفتح عنصر <main> اللي كل صفحات القالب هتقفله في footer.php.
 *
 * ⚠️ ممنوع كتابة أي محتوى هيدر مباشرة هنا — التعديل يبقى في
 * template-parts/header/site-header.php أو template-parts/header/mobile-nav.php
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> dir="<?php echo st_is_rtl() ? 'rtl' : 'ltr'; ?>">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#main-content">
	<?php echo esc_html( st_l( 'تخطي إلى المحتوى', 'Skip to content' ) ); ?>
</a>

<?php get_template_part( 'template-parts/header/site-header' ); ?>

<main id="main-content" tabindex="-1" class="site-main">