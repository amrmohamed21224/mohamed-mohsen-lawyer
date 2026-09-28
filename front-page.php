<?php
/**
 * Template: Front Page
 */
get_header();
?>

<?php get_template_part( 'template-parts/home/hero' ); ?>
<?php get_template_part( 'template-parts/home/trust-strip' ); ?>
<?php get_template_part( 'template-parts/home/services-preview' ); ?>
<?php get_template_part( 'template-parts/home/about-preview' ); ?>
<?php get_template_part( 'template-parts/home/why-us' ); ?>
<?php get_template_part( 'template-parts/home/experience-preview' ); ?>
<?php get_template_part( 'template-parts/home/featured-video' ); ?>
<?php get_template_part( 'template-parts/home/faq-preview' ); ?>
<?php get_template_part( 'template-parts/home/final-cta' ); ?>

<?php
get_footer();
