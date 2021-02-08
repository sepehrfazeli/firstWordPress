<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
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
 * @version 5.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product, $bigikala_options;

//echo wc_get_stock_html( $product );

?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>
	
	<?php if ( $product->is_in_stock() ) : ?>
	
	<form class="cart" method="post" enctype='multipart/form-data'>
		<?php
			/**
			 * @since 2.1.0.
			 */
			do_action( 'woocommerce_before_add_to_cart_button' );

			/**
			 * @since 4.0.0.
			 */
			do_action( 'woocommerce_before_add_to_cart_quantity' ); ?>
        <p class="single_quantity">
		<?php
			/**
			 * @since 2.1.0.
			 */

			/**
			 * @since 4.0.0.
			 */
            if( (!isset($bigikala_options['catalog_mode']) || $bigikala_options['catalog_mode'] == false) && get_post_meta($product->get_id(), '_coming_soon_product', true) != "on" ){
			woocommerce_quantity_input( array(
			    'input_name'            => 'quantity',
				'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
				'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
				'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : $product->get_min_purchase_quantity(),
			) );
            }
			/**
			 * @since 4.0.0.
			 */
			do_action( 'woocommerce_after_add_to_cart_quantity' );
		?>
        </p>

		<?php if(!matrix_wolfis_catalog_mode() && get_post_meta($product->get_id(), '_coming_soon_product', true) != "on") : ?>
	    <div class="add-to-cart-holder">
		<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button dk-button">
			<span class="dk-button-container hasIcon">
				<?php echo esc_html( $product->single_add_to_cart_text() ); ?>
			</span>
		</button>
		</div>
        <?php endif;?>

		<?php
			/**
			 * @since 2.1.0.
			 */
			do_action( 'woocommerce_after_add_to_cart_button' );
		?>
	</form>
	
	<?php else : ?>
		<p class="woocommerce-error" style="margin-top:25px;display: block;"><?php _e ( 'Sorry, This product is out of stock now.','bigikala'); ?></p>
	<?php endif; ?>
	
	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
