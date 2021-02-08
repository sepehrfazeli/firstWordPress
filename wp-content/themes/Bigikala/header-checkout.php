<?php

 global $bigikala_options;
 
 $current_user = wp_get_current_user();
 

?> <!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
	<head>
	    <meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=0, maximum-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php 
		if ( isset( $bigikala_options['bigikala_favicon'] ) && strlen( $bigikala_options['bigikala_favicon']['url'] ) > 0 ) {
			$favicon_href = $bigikala_options['bigikala_favicon']['url'];
		} else {
			$favicon_href = get_template_directory_uri().'/assets/images/favicon.png';
		}
												?>
		<link rel="shortcut icon" href="<?php echo $favicon_href; ?>"/>
		<link rel="apple-touch-icon" href="<?php echo $favicon_href; ?>">
		<meta name="msapplication-TileColor" content="#ff6600">
        <meta name="msapplication-TileImage" content="<?php echo $favicon_href; ?>">
		<?php wp_head(); ?>
		<?php if(!empty($bigikala_options['tracking_code'])){ echo $bigikala_options['tracking_code']; } ?>
		<?php if(!empty($bigikala_options['custom_css'])){ echo '<style id="user-style">'.$bigikala_options['custom_css'].' </style>'; } ?>
	</head>
    <?php $night_mode =''; if( isset( $_COOKIE['night_mode'] ) && $_COOKIE['night_mode'] == 'active') $night_mode = 'night'; ?>
	<body <?php body_class($night_mode); ?>>
		<?php if ( isset($bigikala_options['google_tags']) && $bigikala_options['google_tags'] == true ) { 
		    echo $bigikala_options['google_tags'];
		} ?>
		<div class="container-bigikala matrix_wolfbody">
			<div class="row header checkout-header">
				<div class="container-bigikala">
					<div class="container-bigikala header-row">
						<div class="col-md-3 row header-logo">
							<?php 
							if ( isset( $bigikala_options['site_header_logo'] ) && strlen( $bigikala_options['site_header_logo']['url'] ) > 0 ) {
								$logo_href = $bigikala_options['site_header_logo']['url'];
							} else {
								$logo_href = get_template_directory_uri().'/assets/images/logo.png';
							}
							?>
							<a class="white-logo" href="<?php echo home_url('/');?>"><img src="<?php echo $logo_href; ?>" alt="<?php echo get_bloginfo();?>"></a>
							<?php 
							if ($bigikala_options['night_mode'] == true && isset( $bigikala_options['dark_logo'] ) && strlen( $bigikala_options['dark_logo']['url'] ) > 0){
							    $dark_logo = $bigikala_options['dark_logo']['url'];
							    echo '<a class="dark-logo" href="'.home_url('/').'"><img src="'.$dark_logo.'" alt="'.get_bloginfo().'"></a>';
							} ?>
						</div>
					</div>
				</div>
			</div>
			
			<?php if ( !is_user_logged_in() && ( $bigikala_options['digits'] != true || !function_exists('digit_get_login_fields') ) ) { ?>
									<div class="modal fade" id="bigikala_login" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
										<div class="modal-dialog">
											<div class="modal-content">
												<div id="loading" style="display:none;">
												<?php 
													if ( isset( $bigikala_options['site_header_logo'] ) && strlen( $bigikala_options['site_header_logo']['url'] ) > 0 ) {
														$logo_href = $bigikala_options['site_header_logo']['url'];
													} else {
														$logo_href = get_template_directory_uri().'/assets/images/logo.png';
													}
														$loading_href = get_template_directory_uri().'/assets/images/overlayloading.gif';
												?>
													<img class="site-logo" src="<?php echo $logo_href; ?>">
													<img class="site-loader" src="<?php echo $loading_href; ?>">
												</div>
												<div class="modal-header" >
													<div class="title"><?php echo _e ('Login To Site','bigikala');?></div>
													<a href="" data-dismiss="modal" aria-label="Close" class="close-icon"></a>
												</div>
													<div class="overlay" style="display:none;"></div>
													<!-- Begin # Login Form -->
													<form id="login" action="login" method="post">
														<div class="modal-body">
														
															<div class="login-msg"></div>
															
															<div class="form-group clearfix">
																<label for="p-username" style="width:100%"><?php echo _e('Username','bigikala'); ?></label>
																<label class="c-ui-input c-ui-input--account-login">
                              <input name="username" type="text" id="p-username" tabindex="1" class="en" placeholder="<?php _e('Enter your email or mobile number','bigikala'); ?>" >
                            </label>
																
															</div>
															
															<div class="form-group clearfix">
																<label for="p-password"><?php echo _e('Password','bigikala'); ?></label>
																<a class="forget" href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php echo _e('Lost your password?','bigikala'); ?></a>
																<label class="c-ui-input c-ui-input--account-password">
                               <input name="password" type="password" id="p-password" tabindex="2" class="en" placeholder="<?php _e('Enter your password','bigikala'); ?>"> </label>
                               <span class="fa fa-fw fa-eye field-icon toggle-password"></span>
															</div>
															
															<div class="form-group clearfix">
																<div class="ckeckbox-control">
																	<input name="rememberme" type="checkbox" id="p-rememberme" class="rememberme" tabindex="3">
																</div>
																<label for="p-rememberme"><?php echo _e('Remember me','bigikala'); ?></label>
															</div>
															
														
															
															<div class="form-group clearfix" style="margin-bottom:50px;">
																<div class="dk-button-container hasIcon large full">
																	<button type="submit" name="submit" id="wp-submit">
																		<span class="dk-button blue">
																			<i class="dk-button-icon dk-button-icon-login"></i>
																			<span class="dk-button-label clearfix">
																				<span id="sumbitclick" class="dk-button-labelname">
																					<?php echo _e ('Login To Site','bigikala');?>
																				</span>
																			</span>
																		</span>
																	</button>
																</div>
															</div>
															
														</div>
														
														<div id="login_footerbox" class="footer box">
															<div class="register"><?php echo _e ('You Are Not Register Before?','bigikala');?>
																<a id="Register" target="_blank" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><?php echo _e ('Register To Site','bigikala');?></a>
															</div>
														</div>
														<?php wp_nonce_field( 'ajax-login-nonce', 'p-security' ); ?>
													</form>
													<!-- End # Login Form -->
											</div>
										</div>
									</div>
			<?php }?>