<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="invoice">
<?php woocommerce_form_field( 'wms_want_factor', array(
	'type'          => 'checkbox',
	'class'         => array('my-field-class form-row-wide'),
	'label'         => __('<i class="icon icon-caret-left-blue" style="margin-left: 10px"></i> would you like to take invoice with this order?','bigikala'),
), false); ?>
</div>

<?php do_action( 'woocommerce_review_order_before_cart_contents' ); ?>
<div class="wms-order-review">
    <div class="zir-onvan"><i class="icon icon-caret-left-blue"></i><?php _e( 'Shipping List' , 'bigikala' ) ?></div>
    <div class="shipo"><?php _e( 'Products shipped in this procurement :' , 'bigikala' ) ?></div><div class='clearfix'></div>
        
	<div class="checkout-products">
		<div class="<?php if(wp_is_mobile()){echo 'p_carousel';}else{echo 'section-products-carousel';} ?>" style="height:auto;">
			<div class="scroller partial">
				<div class="items" data-flickity='{ "pageDots": false }'>
					<?php do_action( 'woocommerce_review_order_before_cart_contents' );
					
					foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
						$product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );	
	                    $product_permalink =  $product->get_permalink( $cart_item );
                        $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $product->get_image(), $cart_item, $cart_item_key );
					?>
						<a class="productItem" title="<?php echo $product->get_name( $cart_item ); ?>" href="<?php echo $product_permalink;?>">
						    <span class="product_count"><?php echo $cart_item['quantity']; ?></span>
                            <?php echo $thumbnail; ?>
						</a>						 
								
					<?php }
					do_action( 'woocommerce_review_order_after_cart_contents' );
					?>
				</div>
			</div>
		</div>
	</div>
        
    <div class='clearfix'></div>
</div>

<?php do_action( 'woocommerce_review_order_after_cart_contents' ); ?>


<?php do_action( 'youone_review_order_after_shipping' ); ?>
		