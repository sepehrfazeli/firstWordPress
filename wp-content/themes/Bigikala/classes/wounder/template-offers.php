<?php get_header(); ?>
    <div class="page-content">
    	<div class="content-block mt-0 bg-white block-shadow">
<?php do_shortcode('[special_offer_sticky]');?>
	<div class="special_offers">
		<main id="main">
<?php do_shortcode('[special_offers_page]');?>
		</main><!-- #main -->
	</div><!-- #primary -->
</div>
		</div>
<?php get_footer();