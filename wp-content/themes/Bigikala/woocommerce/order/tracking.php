<?php
/**
 * Order tracking
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/tracking.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 5.0.0
 */

defined( 'ABSPATH' ) || exit;

$notes = $order->get_customer_order_notes();
?>

<p class="order-info <?php if ( $order->has_status( 'failed' ) || $order->has_status( 'cancelled' ) ) { echo 'red'; } else { echo 'green'; } ?>" style="text-align:center;">

    <?php
	echo wp_kses_post(
		apply_filters(
			'woocommerce_order_tracking_status',
			sprintf(
				/* translators: 1: order number 2: order date 3: order status */
				__( 'Order #%1$s was placed on %2$s and is currently %3$s.', 'woocommerce' ),
				'<mark class="order-number">' . $order->get_order_number() . '</mark>',
				'<mark class="order-date">' . wc_format_datetime( $order->get_date_created() ) . '</mark>',
				'<mark class="order-status">' . wc_get_order_status_name( $order->get_status() ) . '</mark>'
			)
		)
	);
	?>
	
</p>

<?php if ( $notes ) : ?>
	<div class="head"><h2 class="title"><i class="icon icon-caret-left-blue"></i><?php _e( 'Order updates', 'woocommerce' ); ?></h2></div>
	
	<div class="order_receipt" style="padding:0;">
		<table>
			<thead>
				<tr>
					<td class="first" style="padding:5px;width:50px;"><?php _e( '#Num', 'bigikala' ); ?></td>
					<td><?php _e( 'Description', 'bigikala' ); ?></td>
					<td class="last"><?php _e( 'Date', 'bigikala' ); ?></td>
				</tr>
			</thead>
			<tbody>
				<?php $n = 1; foreach ( $notes as $note ) {	?>
				<tr>
					<td style="font-size:12px;padding:5px;"><?php echo $n; ?></td>
					<td style="font-size:12px;padding:5px;"><?php echo wpautop( wptexturize( $note->comment_content ) ); ?></td>
					<td style="font-size:12px;padding:5px;"><?php echo date_i18n( __( 'l j F Y, h:i a', 'woocommerce' ), strtotime( $note->comment_date ) ); ?></td>
				</tr>
				<?php $n++; } ?>
			</tbody>
		</table>
	</div>
<?php endif; ?>

<?php do_action( 'woocommerce_view_order', $order->get_id() ); ?>
