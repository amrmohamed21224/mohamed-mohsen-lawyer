<?php
/**
 * Page Template: Fallback for generic WordPress pages
 *
 * @package MohamedMohsenLawyer
 */
$slug = get_post_field( 'post_name', get_queried_object_id() );

if ( $slug === 'about' ) {
	include get_template_directory() . '/page-templates/page-about.php';
	return;
}

if ( $slug === 'legal-disclaimer' ) {
	include get_template_directory() . '/page-templates/page-legal-disclaimer.php';
	return;
}

if ( $slug === 'thank-you' ) {
	include get_template_directory() . '/page-templates/page-thank-you.php';
	return;
}

get_header();
?>
<section class="st-page-hero">
	<div class="container">
		<?php get_template_part( 'template-parts/shared/breadcrumbs', null, [
			'items' => [ [ 'label_ar' => get_the_title(), 'label_en' => get_the_title(), 'url' => null ] ],
		] ); ?>
		<h1 class="st-page-hero__title"><?php the_title(); ?></h1>
	</div>
</section>

<section class="st-page-content">
	<div class="container st-prose" style="max-width:52rem">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				the_content();
			endwhile;
		endif;
		?>
	</div>
</section>

<?php
get_footer();
