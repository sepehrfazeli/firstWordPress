<?php


 global $bigikala_options;
 
 $current_user = wp_get_current_user();
 

?> 
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
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
	</head>
    <?php $night_mode =''; 
    if( (isset( $_COOKIE['night_mode'] ) && $_COOKIE['night_mode'] == 'active') || (!isset( $_COOKIE['night_mode'] ) && $bigikala_options['default_mode'] == 'night' ) ) $night_mode = 'night'; ?>
	<body <?php body_class($night_mode); ?>>
		<?php if ( isset($bigikala_options['google_tags']) && $bigikala_options['google_tags'] == true ) { 
		    echo $bigikala_options['google_tags'];
		} ?>
		<div class="container-bigikala matrix_wolfbody">
		    <header class="site-header<?php if(isset($bigikala_options['sticky_header']) && $bigikala_options['sticky_header'] == true ){ echo ' sticky-header'; }?>">
			<div class="row header">
				<?php if ( isset($bigikala_options['top_bar']) && $bigikala_options['top_bar'] ) { ?>
				<div class="top-header-banner">
					<?php if ( $bigikala_options['top_bar_type'] == 'bgtext' ) { ?>
						<?php if ( $bigikala_options['top_bar_link'] ) { ?>
						<a href="<?php echo $bigikala_options['top_bar_link'];?>" target="_blank">
						<?php } ?>
							<div class="tbar-background">
								<?php echo $bigikala_options['top_bar_bgtext_text'];?>
							</div>
						<?php if ( $bigikala_options['top_bar_link'] ) { ?>
						</a>
						<?php } ?>
					<?php } else { ?>
						<?php if ( $bigikala_options['top_bar_link'] ) { ?>
						<a href="<?php echo $bigikala_options['top_bar_link'];?>">
						<?php } ?>
							<div class="top-header-image">
								<img alt="top-bar-banner" src="<?php echo $bigikala_options['top_bar_image']['url'];?>">
							</div>
						<?php if ( $bigikala_options['top_bar_link'] ) { ?>
						</a>
						<?php } ?>
					<?php } ?>
				</div>
				<?php } ?>
			
				
				<div class="container-bigikala">
					<div class="container-bigikala header-row">
						<div class="col-md-9 row">
							<?php if ( isset($bigikala_options['show_cart']) && $bigikala_options['show_cart'] && $bigikala_options['catalog_mode'] == false && class_exists( 'WooCommerce' )) { 
							$cart_count = youone_get_cart_count(); ?>
							<div class="cart-box<?php if( $cart_count > 0 ){ echo ' fill';} ?>">
								<div class="dk-button-container hasIcon">
									<a 	<?php if( $cart_count == 0 ){ echo 'href="'.wc_get_cart_url().'"'; } ?> class="dk-button green">
										<div>
											<i class="dk-button-icon dk-button-icon-cart"></i>
											<div class="dk-button-label clearfix">
												<div class="dk-button-labelname"><?php echo _e('Cart','bigikala');?></div>
												<span class="cart-items-count"><?php echo en2fa($cart_count); ?></span>
												<?php if( $cart_count > 0 ){ echo '<i class="fa fa-angle-down"></i>'; } ?>
											</div>
										</div>
									</a>
								</div>
								<?php if( $cart_count > 0 ){ ?>
								<div class="mini-cart-dropdown" style="display:none"> 
								    <?php woocommerce_mini_cart(); ?>
								</div>
								<?php } ?>
							</div>
							<?php } ?>
							<?php if(class_exists( 'WooCommerce' )){ ?>
							 				<div class="tbar">
							 				    			
							    <div class="c-header__btn-container">
<div>
		                                <a class="c-header__btn-user js-dropdown-toggle">
		                                    
			                                <span>
			                                    <?php if ( !is_user_logged_in() ) { 
			                                        echo __('Login/Sign up','bigikala'); 
			                                    }else{
			                                        $firstname = get_user_meta ( $current_user->ID, 'first_name', true );
											        $lastname = get_user_meta ( $current_user->ID, 'last_name', true );
											        if ( $firstname && $lastname ) {
												        $user_name = $firstname . ' ' . $lastname;
											        } else {
												        $user_name = $current_user->display_name;
											        }
											        echo $user_name;
			                                    } ?></span>
		                                </a>
		                                <div class="c-header__user-dropdown js-dropdown-menu" style="display: none;">
		                                    <?php if ( !is_user_logged_in() ) { 
		                                        if ( isset($bigikala_options['popup_login']) && $bigikala_options['popup_login'] == true ) {
		                                        if( $bigikala_options['digits'] == true && function_exists('digit_get_login_fields')  ) { 
		                                            echo do_shortcode('[dm-login-modal]');
		                                        }else{?>
			                                <a  data-toggle="modal" data-target="#bigikala_login" class="c-header__user-dropdown-login"><?php echo _e('Login','bigikala');?></a>
			                                <?php 
		                                        }
			                                }else{ ?>
			                                <a  href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ).'?login=1'; ?>" class="c-header__user-dropdown-login"><?php echo _e('Login','bigikala');?></a>
			                                <?php } ?>
			                                <div class="c-header__user-dropdown-sign-up">
				                                <span><?php echo _e('New user?','bigikala');?></span>
				                                <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><?php echo _e('Register','bigikala');?></a>
			                                </div>
			                                <?php } ?>
			                                <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="c-header__user-dropdown-action c-header__user-dropdown-action--profile" data-event="profile_click" data-event-category="header_section" data-event-label="logged_in: False"><span class="user-menu"></span><?php _e('Profile','bigikala'); ?></a>
			                                <a class="c-header__user-dropdown-action c-header__user-dropdown-action--orders" href="<?php if ( isset($bigikala_options['top_bar_trackorder']) && $bigikala_options['top_bar_trackorder'] ) { echo get_permalink($bigikala_options['top_bar_trackorder']); } ?>">
											    <span class="orders-menu"></span>
											    <?php echo _e('Track Order','bigikala');?>
										    </a>
										    <a class="c-header__user-dropdown-action c-header__user-dropdown-action--orders" href="<?php echo wc_get_account_endpoint_url( 'your-wishlist' ); ?>">
											    <span class="icon-love"></span>
											    <?php echo _e('My Wishlist','bigikala');?>
										    </a>
										    <?php if ( is_user_logged_in() ) { ?>
                                                <a href="<?php echo wp_logout_url( home_url() ); ?>" class="c-header__user-dropdown-action c-header__user-dropdown-action--logout">
                                                    <i class="bigi-loguot"></i>
                                                    <?php echo _e('Exit','bigikala'); ?>
                                                </a>										        
										    <?php } ?>
		                                </div>
		                               </div>

                                </div>
							</div>
							<?php } ?>
								<?php if ( isset($bigikala_options['header_faq']) && $bigikala_options['header_faq'] ) { ?>
 <a href="<?php echo get_permalink($bigikala_options['headerinfobar_faq_p']); ?>" class="c-header__faq"><?php echo $bigikala_options['headerinfobar_faq']; ?></a><?php } ?>
							<?php if ( isset($bigikala_options['show_search']) && $bigikala_options['show_search'] ) { ?>
							<div class="navbar-search">
								<?php echo do_shortcode('[wcas-search-form]');?>
							</div>
							<?php } ?>
							
						</div>
						<?php if(is_front_page()){
						    $tag = 'h1';
						}else{
						    $tag = 'div';
						} ?>
						<<?php echo $tag; ?> class="col-md-3 row header-logo">
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
							    echo '<a class="dark-logo" href="'.home_url('/').'"><img src="'.$dark_logo.'" alt="'.get_bloginfo("name").'"></a>';
							} ?>
						</<?php echo $tag; ?>>
					</div>
				</div>
			</div>

			<div class="row navbar-primary">
				<div class="container-bigikala">
					<div class="container-bigikala main-menu-div">
					    <?php if( function_exists( 'ubermenu' ) ):
                                ubermenu( 'main' , array( 'theme_location' => 'uber' ) );
                              else: 
                                bkm_menu();
                              endif; 

						if ( isset($bigikala_options['enable_header_offer']) && $bigikala_options['enable_header_offer'] && class_exists( 'WooCommerce' ) ) {
						    if ( isset($bigikala_options['offer_menu_cat']) && $bigikala_options['offer_menu_cat'] ) { 
						        $term = get_term($bigikala_options['offer_menu_cat']); 
						        if($term) { ?>
						        <div class="col-md-2 promotion-badge">
							        <ul>
								        <li><a href="<?php echo get_term_link($term); ?>"><?php echo _e('Special Offers','bigikala');?></a></li>
								    </ul>
								</div>
						        <?php }
						    }elseif ( isset($bigikala_options['offer_menu_link']) && $bigikala_options['offer_menu_link'] ) { ?>
						<div class="col-md-2 promotion-badge">
							<ul>
								<li><a href="<?php echo get_permalink($bigikala_options['offer_menu_link']); ?>"><?php echo _e('Special Offers','bigikala');?></a></li>
							</ul>
						</div>
						<?php } 
						} ?>
						<?php if ( isset($bigikala_options['night_mode']) && $bigikala_options['night_mode'] == true ) { ?>
						  <div class="dk-switch-container">
						    <div id="night_mode_switcher" class="night_mode_switch dk-switch-wrapper clearfix <?php if( (isset( $_COOKIE['night_mode'] ) && $_COOKIE['night_mode'] == 'active') || (!isset( $_COOKIE['night_mode'] ) && $bigikala_options['default_mode'] == 'night' ) ){echo 'active';}else{echo 'inactive';} ?>">
						        <span class="dk-switch-enabled"></span>
						        <span class="dk-switch-disabled"></span>
						    </div>
						  </div>
						<?php } ?>
					</div>
				</div>
			</div>
		</header>
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
													<img alt="site-logo" class="site-logo" src="<?php echo $logo_href; ?>">
													<img alt="loading" class="site-loader" src="<?php echo $loading_href; ?>">
												</div>
												<div class="modal-header">
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