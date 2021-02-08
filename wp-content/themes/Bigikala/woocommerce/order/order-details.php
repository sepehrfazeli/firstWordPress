<?php
/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 5.0.0
 */

defined( 'ABSPATH' ) || exit;

$order = wc_get_order( $order_id ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited

if ( ! $order ) {
	return;
}

$order_items           = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
$show_purchase_note    = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
$downloads             = $order->get_downloadable_items();
$show_downloads        = $order->has_downloadable_item() && $order->is_download_permitted();

if ( $show_downloads ) {
	wc_get_template( 'order/order-downloads.php', array( 'downloads' => $downloads, 'show_title' => true ) );
}
?>
<section class="woocommerce-order-details payment_details">

	<?php do_action( 'woocommerce_order_details_before_order_table', $order ); ?>

	<div class="head"  style="margin-top: 25px;"><h2 class="title"><i class="icon icon-caret-left-blue"></i><?php _e( 'Your order detailes', 'bigikala' ) ?></h2></div>

	<div class="checkout-products">
		<div class="section-products-carousel" style="height:auto;">
			<div class="scroller partial">
				<div class="items">
					<?php 
					do_action( 'woocommerce_order_details_before_order_table_items', $order );
					
					foreach ( $order_items as $item_id => $item ) :
						$product = $item->get_product();	

					if ( apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
							
						$is_visible        = $product && $product->is_visible();
						$product_permalink = apply_filters( 'woocommerce_order_item_permalink', $is_visible ? $product->get_permalink( $item ) : '', $item, $order );
					?>
						<a class="productItem" title="<?php echo $item->get_name(); ?>" href="<?php echo $product_permalink;?>">
							<span class="product_count"><?php echo $item->get_quantity(); ?></span>
							<img style="width:auto;height:auto;" class="flickity-lazyloaded" alt="<?php echo $item->get_name(); ?>" src="<?php 
								$img_id = $product->get_image_id();
								$src = wp_get_attachment_image_src($img_id, 'shop_catalog'); echo $src[0];
								?>">
						</a>
								
					<?php } endforeach;
					do_action( 'woocommerce_order_details_after_order_table_items', $order );
					?>
				</div>
			</div>
		</div>
	</div>
	
	<div class="details">
	    	<table class="woocommerce-table woocommerce-table--order-details shop_table order_details">

		<thead>
			<tr>
				<th class="woocommerce-table__product-name product-name"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
				<th class="woocommerce-table__product-table product-total"><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
			</tr>
		</thead>

		<tbody>
			<?php
			do_action( 'woocommerce_order_details_before_order_table_items', $order );

			foreach ( $order_items as $item_id => $item ) {
				$product = $item->get_product();

				wc_get_template(
					'order/order-details-item.php',
					array(
						'order'              => $order,
						'item_id'            => $item_id,
						'item'               => $item,
						'show_purchase_note' => $show_purchase_note,
						'purchase_note'      => $product ? $product->get_purchase_note() : '',
						'product'            => $product,
					)
				);
			}

			do_action( 'woocommerce_order_details_after_order_table_items', $order );
			?>
		</tbody>

		<tfoot>
			<?php if ( $order->get_customer_note() ) : ?>
				<tr>
					<th><?php esc_html_e( 'Note:', 'woocommerce' ); ?></th>
					<td><?php echo wp_kses_post( nl2br( wptexturize( $order->get_customer_note() ) ) ); ?></td>
				</tr>
			<?php endif; ?>
		</tfoot>
	</table>
	</div>
	
	<div class="box noback payment_details_table">
		<table>
			<thead>
				<tr>
				<?php foreach ( $order->get_order_item_totals() as $key => $total ) { ?>
					<td><?php echo $total['label']; ?></td>
				<?php } ?>
				<?php if ( $order->get_customer_note() ) : ?>
					<td><?php _e( 'Note:', 'woocommerce' ); ?></td>
				<?php endif; ?>
				</tr>
			</thead>
			<tbody>
				<tr>
					<?php foreach ( $order->get_order_item_totals() as $key => $total ) { ?>
						<td><?php echo $total['value']; ?></td>
					<?php } ?>
					<?php if ( $order->get_customer_note() ) : ?>
						<td><?php echo wptexturize( $order->get_customer_note() ); ?></td>
					<?php endif; ?>
				</tr>
			</tbody>
		</table>
	</div>

	<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>
</section>
