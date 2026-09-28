<?php
/**
 * index.php — Fallback Template
 */
get_header();
?>

<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'st-page-content' ); ?>>
			<div class="container">
				<h1 class="st-page-title"><?php the_title(); ?></h1>
				<div class="entry-content"><?php the_content(); ?></div>
			</div>
		</article>
	<?php endwhile; ?>
<?php else : ?>
	<?php get_template_part( 'template-parts/shared/empty-state' ); ?>
<?php endif; ?>

<?php
get_footer();
