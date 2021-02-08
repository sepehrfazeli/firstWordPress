<?php
global $bigikala_options;

if( $bigikala_options['checkout_header'] == true){
    get_header('checkout');
}else{
    get_header();
} ?> 

<div class="container-bigikala main-warp<?php if( $bigikala_options['checkout_header'] == true){ echo ' minimal-checkout'; } ?>">
		<main id="main" class="site-main">

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content content-box">
					<?php the_content(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-## -->

			<?php endwhile; // End of the loop.	?>

		</main><!-- #main -->
</div><!-- .container main -->

<?php
if( $bigikala_options['checkout_header'] == true){
    get_footer('checkout');
}else{
    get_footer();
} ?> 
