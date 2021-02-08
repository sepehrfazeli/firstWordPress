<?php

$error_logo = get_template_directory_uri().'/assets/images/404-page.png';

get_header(); ?>

<div class="container-bigikala main-warp">
	<main id="main" class="site-main">
		<?php bigikala_breadcrumbs(); ?>
			<section class="error-404 not-found">
			    <h1 class="title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'bigikala' ); ?></h1>
				<p class="guide-text"><?php _e( 'You can choose your category from top menu or', 'bigikala' ); ?>
					<a href="<?php echo home_url(); ?>" class="guide-text-link"><?php _e( ' Home Page ', 'bigikala' ); ?></a>
				<?php _e( 'go to', 'bigikala' ); ?></p>
				<img class="error-404-logo" src="<?php echo $error_logo; ?>" alt="error page">
			</section><!-- .error-404 -->
			
	</main><!-- #main -->
</div><!-- .container main -->

<?php get_footer();