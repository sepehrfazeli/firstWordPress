<?php
/**
 * Single variation cart button
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 5.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
?>


<div class="woocommerce-variation-add-to-cart variations_button">
    <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
	<?php
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
            if(!matrix_wolfis_catalog_mode()) : 
			woocommerce_quantity_input( array(
			    'input_name'            => 'quantity',
				'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
				'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
				'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : $product->get_min_purchase_quantity(),
			) );
			endif;

			/**
			 * @since 4.0.0.
			 */
			do_action( 'woocommerce_after_add_to_cart_quantity' );
		?>
        </p>

<?php if(!matrix_wolfis_catalog_mode() && get_post_meta($product->get_id(), '_coming_soon_product', true) != "on" ) : ?>            
<div class="add-to-cart-holder">
	<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button dk-button">
		<span class="dk-button-container hasIcon">
			<?php echo esc_html( $product->single_add_to_cart_text() ); ?>
		</span>
	</button>
</div>

	<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="variation_id" class="variation_id" value="0" />
	<?php endif; ?>
	<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
</div>
