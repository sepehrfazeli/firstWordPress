<div class="sign">
  <div class="login">
	<i class="icon icons-lock"></i>
		<p><?php _e( 'Do you member of this site?', 'bigikala' ) ?></p>
		<?php global $bigikala_options;
		if ( isset($bigikala_options['popup_login']) && $bigikala_options['popup_login'] == true ) {
		if( $bigikala_options['digits'] == true && function_exists('digit_get_login_fields')  ) { 
		   echo do_shortcode('[dm-login-modal]');
		} else{?>
	        <a href="" data-toggle="modal" data-target="#bigikala_login"><?php _e( 'Login' , 'bigikala' ) ?> </a>
	   <?php }
	   }else{ ?>
	        <a  href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ).'?login=1'; ?>" ><?php _e( 'Login' , 'bigikala' ) ?> </a>
	   <?php } ?>
  </div>
  <div class="signup">
	<i class="icon icons-admin-users"></i>
	<p><?php _e( 'Dont Have any Account?' , 'bigikala' ) ?><p>
	<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><?php _e( 'Regester' , 'bigikala' ) ?></a>
	<div class="clearfix"></div>
  </div>
</div>