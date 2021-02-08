<?php
/**
 * Template Name: Home page template
 */
__('Home page template','bigikala');
get_header(); ?>

<div class="container-bigikala main-warp">
		<main id="main" class="site-main1">

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content">
					<?php the_content(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-## -->

			<?php endwhile; // End of the loop.	?>

		</main><!-- #main -->
</div><!-- .container main -->

<?php get_footer();
