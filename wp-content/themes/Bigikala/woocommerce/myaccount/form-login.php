<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
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

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
global $bigikala_options;
do_action( 'woocommerce_before_customer_login_form' ); ?>

<div class="auth auth--register">
    <?php if(isset($bigikala_options['popup_login']) && $bigikala_options['popup_login'] == false): ?>
    <ul class='bigi-tabs'>
        <li><a href='#tab1'><?php _e('Register','bigikala'); ?></a></li>
        <li><a href='#tab2' <?php if($_GET['login']) echo 'class="active"'; ?> ><?php _e('Login','bigikala'); ?></a></li>
    </ul>
    <?php endif; ?>
    <div class="auth__content box noback">
        <div class="auth__form auth_form--register" id="tab1">
            <div class="form noback">
                <h1 class="auth__title"><?php _e( 'Register On Site', 'bigikala' ); ?></h1>
				
				<form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

				<?php do_action( 'woocommerce_register_form_start' ); ?>
                <div class="userform">
				
					<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
					<div class="form-group clearfix">
						<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
							<label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?> <span class="required">*</span></label>
							<a class="c-ui-input c-ui-input--account-login"></a>
							<input type="text" class="woocommerce-Input woocommerce-Input--text input-text en" name="username" id="reg_username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" placeholder="<?php _e('Enter your username','bigikala'); ?>" />
							
						</p>
					</div>
					<?php endif; ?>
				
					<div class="form-group clearfix">
						<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
							<label for="reg_email" class="full-width"><?php esc_html_e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label>
                              <a class="c-ui-input c-ui-input--account-login"></a>
                              <input name="email" type="email" placeholder="<?php _e('Enter your email','bigikala'); ?>" id="reg_email" tabindex="1" class="en" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" />
						</p>
					</div>
					
					<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
					<div class="form-group clearfix" style="position: relative;">
						<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
							<label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
                               <a class="c-ui-input c-ui-input--account-password"></a>
                               <b class="fa fa-fw fa-eye field-icon toggle-password"></b>
                               <input name="password" type="password" tabindex="2" class="en" id="reg_password" placeholder="<?php _e('Enter your password','bigikala'); ?>" />
							
							   
						</p>
					</div>
					<?php endif; ?>
					
					<?php do_action( 'woocommerce_register_form' ); ?>

					<?php
						$terms_page_id = wc_get_page_id( 'terms' );
						if ( $terms_page_id > 0 && apply_filters( 'woocommerce_checkout_show_terms', true ) ) {
							$terms_page_link = get_permalink ($terms_page_id);
					?>
					<div class="form-group clearfix rules">
						<div class="ckeckbox-control right">
							<input id="checkagreement" type="checkbox" disabled="disabled" checked="checked">
                                <label for="checkagreement"></label>
						</div>
						
						
						
						<div class="agreement">
							<label>
								<a target="_blank" href="<?php echo $terms_page_link; ?>"><?php _e( 'Terms & Conditions ', 'bigikala' ); ?></a><?php _e( 'I have read and accept.', 'bigikala' ); ?>
							</label>
						</div>

						<div class="clear"></div>

					</div>
					<?php } ?>
					
					<div class="form-group clearfix">
					
						<div class="hasIcon large full">
							<a id="btnRegister" class="dk-button blue">
								<i class="dk-button-icon dk-button-icon-signup"></i>
								<span class="dk-button-label clearfix">
									<span class="dk-button-labelname">
										<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
										<button type="submit" class="woocommerce-Button button bigi_reg_btn" name="register" value="<?php esc_attr_e( 'Register On Site', 'bigikala' ); ?>"><?php esc_html_e( 'Register On Site', 'bigikala' ); ?></button>
									</span>
								</span>
							</a>
						</div>

					</div>

				</div>
				<?php do_action( 'woocommerce_register_form_end' ); ?>
				</form>
			</div>
            <?php if(isset($bigikala_options['popup_login']) && $bigikala_options['popup_login'] == true){ ?>
            <div class="auth__nav">
                    <?php _e( 'I Am Registered Before?', 'bigikala' );
            if( $bigikala_options['digits'] == true && function_exists('digit_get_login_fields')  ) {
                echo do_shortcode('[dm-login-modal]');
            } else{ ?>
			
					<a href="" data-toggle="modal" data-target="#bigikala_login"><?php _e( 'Login', 'bigikala' ); ?></a>
			
			<?php } ?>
			</div>
			<?php } ?>
		</div>
        <?php if(isset($bigikala_options['popup_login']) && $bigikala_options['popup_login'] == false){ ?>
        <div class="auth__form auth_form--register" id="tab2">
            <div class="form noback">
                <h1 class="auth__title"><?php _e( 'Login to Site', 'bigikala' ); ?></h1>
				
				<form method="post" class="woocommerce-form woocommerce-form-login login" >

				<?php do_action( 'woocommerce_login_form_start' ); ?>
                <div class="userform">
				
					<div class="form-group clearfix">
						<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
							<label for="username"><?php esc_html_e( 'Username', 'woocommerce' ); ?> <span class="required">*</span></label>
							<a class="c-ui-input c-ui-input--account-login tab2"></a>
							<input type="text" class="woocommerce-Input woocommerce-Input--text input-text en" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" placeholder="<?php _e('Enter your username','bigikala'); ?>" />
						</p>
					</div>
					
					<div class="form-group clearfix" style="position: relative;">
						<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
							<label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
                               <a class="c-ui-input c-ui-input--account-password"></a>
                               <b class="fa fa-fw fa-eye field-icon toggle-password"></b>
                               <input name="password" type="password" tabindex="2" class="en" id="password" autocomplete="current-password" placeholder="<?php _e('Enter your password','bigikala'); ?>" />
							  
						</p>
					</div>

					<?php do_action( 'woocommerce_login_form' ); ?>

					<div class="form-group clearfix">
					
						<div class="dk-button-login hasIcon large full form-row">
							<a id="btnLogin" class="dk-button blue">
								<i class="dk-button-icon dk-button-icon-signin"></i>
								<span class="dk-button-label clearfix">
									<span class="dk-button-labelname">
										<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
										<button type="submit" class="woocommerce-Button button bigi_login_btn" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>
									</span>
								</span>
							</a>
						</div>

					</div>

				</div>
				<?php do_action( 'woocommerce_login_form_end' ); ?>
				</form>
			</div>

			<div class="auth__nav">
                    <?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?>
					<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>" ><?php _e( 'Reset password', 'bigikala' ); ?></a>
			</div>
		</div>
        <?php } ?>
        <div class="auth__guidance guidance noback">

			<div class="guidance__thumb">
               </div>

            <div class="guidance__rules">
				<?php
				global $bigikala_options;
				$feauters = $bigikala_options['register_text'];
				foreach ( $feauters as $feauters ) {
					echo '<li><i class="icon icon-userbox-cart"></i><span>'. $feauters .'</span></li>';
				}
				?>
            </div>
        </div>
    </div>
</div>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
