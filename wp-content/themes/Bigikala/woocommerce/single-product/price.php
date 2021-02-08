<?php
/**
 * Single Product Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 5.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( $product->is_type( 'variable' ) ) {
    return;
}
?>
<div class="price-section clearfix">
    
	<?php 
	if(get_post_meta($product->get_id(), '_coming_soon_product', true) == "on"){ ?>
	    <p><?php echo __("Coming soon", "bigikala");?></p>
	<?php }
	else  { ?>
		<p class="price"><?php echo $product->get_price_html(); ?></p>
	<?php } ?>
</div>
