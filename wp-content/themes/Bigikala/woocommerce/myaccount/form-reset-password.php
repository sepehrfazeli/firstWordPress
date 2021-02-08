<?php
/**
 * Lost password reset form.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-reset-password.php.
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

do_action( 'woocommerce_before_reset_password_form' );
?>

<div class="auth rememberpassword">
    <div class="userbox rtl">
        <div class="box noback">
            <div class="head">
                <i class="icon icon-user-changepassword"></i>
                <h1><?php echo apply_filters( 'woocommerce_reset_password_message', __( 'Enter a new password below.', 'woocommerce' ) ); ?></h1>
            </div>

			<div class="content clearfix">
				<form method="post" class="woocommerce-ResetPassword lost_reset_password">
					<div class="userform">

						<div class="form-group clearfix">
							<p class="woocommerce-form-row">
								<label class="title full-width" for="password_1"><?php esc_html_e( 'New password', 'woocommerce' ); ?> <span class="required">*</span></label>
								<input type="password" class="woocommerce-Input woocommerce-Input--text input-text en" name="password_1" id="password_1" />
							</p>
						</div>

						<div class="form-group clearfix">
							<p class="woocommerce-form-row">
								<label class="title full-width" for="password_2"><?php esc_html_e( 'Re-enter new password', 'woocommerce' ); ?> <span class="required">*</span></label>
								<input type="password" class="woocommerce-Input woocommerce-Input--text input-text en" name="password_2" id="password_2" />
							</p>
						</div>
						
						<input type="hidden" name="reset_key" value="<?php echo esc_attr( $args['key'] ); ?>" />
						<input type="hidden" name="reset_login" value="<?php echo esc_attr( $args['login'] ); ?>" />

						<div class="clear"></div>

						<?php do_action( 'woocommerce_resetpassword_form' ); ?>

						<div class="form-group clearfix">
							<div class="dk-button-container left">
								<a tabindex="2" class="dk-button blue" href="">
									<i class="dk-button-icon dk-button-icon-caretLeft"></i>
									<span class="dk-button-label clearfix">
										<span class="dk-button-labelname">
											<input type="hidden" name="wc_reset_password" value="true" />
											<button type="submit" class="woocommerce-Button button" value="<?php esc_attr_e( 'Save', 'woocommerce' ); ?>"><?php esc_html_e( 'Save', 'woocommerce' ); ?></button>
										</span>
									</span>
								</a>
							</div>
						</div>
						
						<?php wp_nonce_field( 'reset_password', 'woocommerce-reset-password-nonce' ); ?>
						
					</div>
				</form>
				<?php do_action( 'woocommerce_after_reset_password_form' ); ?>
			</div>
        </div>

    </div>
</div>