<?php

get_header(); ?>

<div class="container-bigikala main-warp default-page-template">
		<main id="main" class="site-main">
			<?php bigikala_breadcrumbs(); ?>
			
			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content content-box">
					<?php the_content(); ?>
					<?php 
					    // If comments are open or we have at least one comment, load up the comment template.
			            if ( comments_open() ) :
				           comments_template();
			            endif;
			        ?>
					</div><!-- .entry-content -->
				</article><!-- #post-## -->

			<?php endwhile; // End of the loop.	?>

		</main><!-- #main -->
</div><!-- .container main -->

<?php get_footer();
