<?php
/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 5.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

wc_print_notices();
global $bigikala_options;
if ( isset($bigikala_options['offer_menu_cat']) && $bigikala_options['offer_menu_cat'] ) { 
	$term = get_term($bigikala_options['offer_menu_cat']); 
	if($term) {
	    $link = get_term_link($term);
	}elseif ( isset($bigikala_options['offer_menu_link']) && $bigikala_options['offer_menu_link'] ) {
	    $link = get_permalink($bigikala_options['offer_menu_link']);
	}
}
/**
 * @hooked wc_empty_cart_message - 10
 */
 
do_action( 'woocommerce_cart_is_empty' );?>
<div class="cart-empty-div"><div class="c-checkout-empty__icon"></div>
<?php if ( wc_get_page_id( 'shop' ) > 0 ) : ?>

<div class="c-checkout-empty"><div class="c-checkout-empty__links"><p><?php echo _e('You can go to the following pages to see more products','bigikala');?>
                        </p><div class="c-checkout-empty__link-urls">
                            <a href="<?php echo $link; ?>"><?php echo _e('Special Offers','bigikala');?></a>
                        <a href="<?php echo wc_get_account_endpoint_url( 'your-wishlist' ); ?>"><?php echo _e('My Wishlist','bigikala');?></a>
                            </a></div></div></div>
	<p class="return-to-shop">
        <a class="button wc-backward" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
			<?php _e( 'Return to shop', 'woocommerce' ) ?>
        </a>
    </p>
  
<?php endif; ?>
  </div>