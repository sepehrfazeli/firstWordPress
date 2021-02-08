<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     5.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header( 'shop' );
global $bigikala_options;
$class = '';
if ( is_tax() ){
	if ( $bigikala_options['offer_menu_cat'] && get_queried_object()->term_id == $bigikala_options['offer_menu_cat'] )  {
		echo '<div class="wonderful_offer_archive"><div class="container"> <span>'.__('Special Offers','bigikala').'</span></div></div>';
		$class= "special-offer-archive";
	}
}

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );



if ( isset($bigikala_options['side_width']) && $bigikala_options['side_width'] == 'big' ) {
	$side_width = 3;
	$shop_width = 9;
} else {
	$side_width = 2;
	$shop_width = 10;
}

?>
<div class="shop-page">
	<?php if ( is_active_sidebar( 'shop-sidebar' ) ) { ?>
	<div class="col-md-<?php echo $side_width;?> filters-panel">
		<?php dynamic_sidebar( 'shop-sidebar' ); ?>
	</div>
	<?php } ?>
	
	
	<div class="<?php if ( is_active_sidebar( 'shop-sidebar' ) ) { echo 'col-md-'.$shop_width ; } ?> <?php echo $class; ?>">
	    <?php do_action('youone_breadcrumb'); ?>
		    <p class="woocommerce-result-count">
				<span class="options__meta">
					<?php
					global $wp_query;
					$paged    = max( 1, $wp_query->get( 'paged' ) );
					$per_page = $wp_query->get( 'posts_per_page' );
					$total    = $wp_query->found_posts;
					$first    = ( $per_page * $paged ) - $per_page + 1;
					$last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged ); ?>
					<span class="options__product-numbers--txt"><?php echo _e( 'Display ', 'bigikala' ); ?></span>
					<span class="options__product-numbers--txt first"><?php echo en2fa($first);?></span>
					<span class="options__product-numbers--txt"> - </span>
					<span class="options__product-numbers--txt last"><?php echo en2fa($last);?></span>
					<span class="options__product-numbers--txt"><?php echo _e( ' Product Of ', 'bigikala' ); ?></span>
					<span class="options__product-numbers--txt total"><?php echo en2fa($total);?></span>
				</span>
			</p>
			
		<div class="content-box-shop">

<?php if ( have_posts() ) {

	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked wc_print_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	remove_action( 'woocommerce_before_shop_loop','woocommerce_result_count', 20 );
	do_action( 'woocommerce_before_shop_loop' ); ?>
	
    <div class="products-box <?php if( (isset( $_COOKIE['type_view'] ) && $_COOKIE['type_view'] == 'listing') || (!isset( $_COOKIE['type_view'] ) && $bigikala_options['archive_style'] == 'listing') ) echo 'listing'; ?>">
    <?php
	woocommerce_product_loop_start();

	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();

			/**
			 * Hook: woocommerce_shop_loop.
			 *
			 * @hooked WC_Structured_Data::generate_product_data() - 10
			 */
			do_action( 'woocommerce_shop_loop' );

			wc_get_template_part( 'content', 'product' );
		}
	}

	woocommerce_product_loop_end();

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
} 
?>
        </div>
		</div>
	</div>
	
	<div class="woocommerce-products-header">
				<?php
					/**
					 * woocommerce_archive_description hook.
					 *
					 * @hooked woocommerce_taxonomy_archive_description - 10
					 * @hooked woocommerce_product_archive_description - 10
					 */
					do_action( 'woocommerce_archive_description' );
				?>
	</div>
</div>
<?php

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );
