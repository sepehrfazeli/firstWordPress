<?php
/**
 * Order tracking form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/form-tracking.php.
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

global $post;
?>

<div class="auth rememberpassword">
    <div class="userbox rtl">
        <div class="order_track">
            <div class="head">
                <i class="icon icon-trackorder"></i>
                <h1><?php esc_html_e( 'To track your order please enter your Order ID in the box below and press the "Track" button. This was given to you on your receipt and in the confirmation email you should have received.', 'woocommerce' ); ?></h1>
            </div>

			<div class="content clearfix">
				<form action="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" method="post" class="track_order">
					<div class="userform">

						<div class="form-group clearfix">
							<p class="woocommerce-form-row">
								<label for="orderid"><?php esc_html_e( 'Order ID', 'woocommerce' ); ?></label>
								<input class="input-text" type="text" name="orderid" id="orderid" value="<?php echo isset( $_REQUEST['orderid'] ) ? esc_attr( wp_unslash( $_REQUEST['orderid'] ) ) : ''; ?>" placeholder="<?php esc_attr_e( 'Found in your order confirmation email.', 'woocommerce' ); ?>" />
							</p>
						</div>
						
						<div class="form-group clearfix">
							<p class="woocommerce-form-row">
								<label for="order_email"><?php esc_html_e( 'Billing email', 'woocommerce' ); ?></label>
								<input class="input-text" type="text" name="order_email" id="order_email" value="<?php echo isset( $_REQUEST['order_email'] ) ? esc_attr( wp_unslash( $_REQUEST['order_email'] ) ) : ''; ?>" placeholder="<?php esc_attr_e( 'Email you used during checkout.', 'woocommerce' ); ?>" />
							</p>
						</div>
						
						<div class="clear"></div>

						<div class="form-group clearfix">
							<div class="dk-button-container left">
								<a tabindex="2" class="dk-button blue" href="">
									<i class="dk-button-icon dk-button-icon-caretLeft"></i>
									<span class="dk-button-label clearfix">
										<span class="dk-button-labelname">
											<button type="submit" class="button" name="track" value="<?php esc_attr_e( 'Track', 'woocommerce' ); ?>"><?php esc_html_e( 'Track', 'woocommerce' ); ?></button>
										</span>
									</span>
								</a>
							</div>
						</div>

						<?php wp_nonce_field( 'woocommerce-order_tracking', 'woocommerce-order-tracking-nonce' ); ?>

					</div>

				</form>
				
			</div>
        </div>

    </div>
</div>