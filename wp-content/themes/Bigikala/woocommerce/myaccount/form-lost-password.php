<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
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

do_action( 'woocommerce_before_lost_password_form' );
?>

<div class="auth rememberpassword">
    <div class="userbox rtl">
        <div class="box noback">
            <div class="head">
                <i class="icon icon-user-changepassword"></i>
                <h1><?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce' ) ); ?></h1>
            </div>

			<div class="content clearfix">
				<form method="post" class="woocommerce-ResetPassword lost_reset_password">
					<div class="userform">
					
						<div class="form-group clearfix">
							<p class="woocommerce-form-row">
								<label class="title full-width" for="user_login"><?php esc_html__( 'Username or email', 'woocommerce' ); ?></label>
								<input class="woocommerce-Input woocommerce-Input--text input-text en" type="text" name="user_login" id="user_login" />
							</p>
						</div>

						<div class="clear"></div>

						<?php do_action( 'woocommerce_lostpassword_form' ); ?>

						<div class="form-group clearfix">
							<div class="dk-button-container left">
								<a tabindex="2" class="dk-button blue" href="">
									<i class="dk-button-icon dk-button-icon-caretLeft"></i>
									<span class="dk-button-label clearfix">
										<span class="dk-button-labelname">
											<input type="hidden" name="wc_reset_password" value="true" />
											<button type="submit" class="woocommerce-Button button" value="<?php esc_attr_e( 'Reset password', 'woocommerce' ); ?>"><?php esc_html_e( 'Reset password', 'woocommerce' ); ?></button>
										</span>
									</span>
								</a>
							</div>
						</div>
						
						<?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>
						
					</div>
				</form>
				<?php do_action( 'woocommerce_after_lost_password_form' ); ?>
			</div>
        </div>

    </div>
</div>