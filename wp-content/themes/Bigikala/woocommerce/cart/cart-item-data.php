<?php
/**
 * Cart item data (when outputting non-flat)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-item-data.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version 5.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $bigikala_options;

$color_attribute = '';
if ( isset($bigikala_options['product_color_taxonomy']) && $bigikala_options['product_color_taxonomy'] !== -1 ) {
	$color_taxonomy		= $bigikala_options['product_color_taxonomy'];
	$color_attribute	= wc_attribute_label($color_taxonomy);
}

$warranty_attribute = '';
if ( isset($bigikala_options['product_warranty_taxonomy']) && $bigikala_options['product_warranty_taxonomy'] !== -1 ) {
	$warranty_taxonomy	= $bigikala_options['product_warranty_taxonomy'];
	$warranty_attribute	= wc_attribute_label($warranty_taxonomy);
}
?>
<dl class="variation">
	<?php foreach ( $item_data as $data ) :  ?>
		<?php if (  $data['key'] !== $color_attribute && $data['key'] !== $warranty_attribute ) { ?>
			<dt class="<?php echo sanitize_html_class( 'variation variation-' . $data['key'] ); ?>"><?php echo wp_kses_post( $data['key'] ); ?>:</dt>
		<?php } ?>
			<?php if ( $data['key'] == $color_attribute ) { ?>
			    <dd class="<?php echo 'variation variation-color' ; ?>">
			    <?php $color_term = get_term_by( 'name', wp_kses_post( wpautop( $data['display'] ) ), $color_taxonomy );
			    $color = get_term_meta($color_term->term_id, $color_taxonomy.'_swatches_id_color', true); ?>
				<span class="cart-item-color" style="background-color:<?php echo $color; ?>"></span>
			<?php } ?>
			
			<?php if ( $data['key'] == $warranty_attribute ) { ?>
			    <dd class="<?php echo 'variation variation-warranty' ; ?>">
				<span class="warranty-icon"></span>
			<?php } ?>
			
			<?php echo wp_kses_post( wpautop( $data['display'] ) ); ?>
		</dd>
	<?php endforeach; ?>
</dl>
