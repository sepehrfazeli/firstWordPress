<?php
/**
 * My Account navbar-primary
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navbar-primary.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 5.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$current_user = wp_get_current_user();
$firstname = get_user_meta ( $current_user->ID, 'first_name', true );
$lastname = get_user_meta ( $current_user->ID, 'last_name', true );
if ( $firstname && $lastname ) {
	$user_name = $firstname . ' ' . $lastname;
} else {
	$user_name = $current_user->display_name;
}
do_action( 'woocommerce_before_account_navbar-primary' );
?>
<nav class="woocommerce-MyAccount-navbar-primary box noback">
    <div class="c-profile-box">
    <div class="c-profile-box__header">
    <div class="c-profile-box__avatar user-avatar"><?php echo get_avatar( $current_user->ID , 48 ); ?></div>
    <button class="c-profile-box__btn-edit js-change-avatar"></button>
    </div>
    <div class="c-profile-box__username"><?php echo $user_name; ?></div>
    <div class="c-profile-box__tabs">
    <a href="<?php echo esc_url( wc_customer_edit_account_url() ); ?>" class="c-profile-box__tab c-profile-box__tab--access"><?php _e ( 'Change Password','bigikala' ); ?></a>
    <a href="<?php echo wp_logout_url( home_url() ); ?>" class="c-profile-box__tab c-profile-box__tab--sign-out"><?php _e ( 'Logout','bigikala' ); ?></a>
    </div></div>
    <div class="c-menu">
	<ul>
	            <div class="c-profile-menu__header"><?php echo _e ('Your Profile Acount','bigikala');?></div>
	    		<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
			<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>
</div>
<?php do_action( 'woocommerce_after_account_navbar-primary' ); ?>

        <!-- Modal -->
        <div class="modal fade" id="avatarModal" tabindex="-1" role="dialog" aria-labelledby="avatarModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-header" align="center">
				<div class="title"><?php echo _e ('Change profile picture','bigikala');?></div>
				<a href="" data-dismiss="modal" aria-label="Close" class="close-icon"></a>
			</div>
            <div class="modal-content">
              <div class="modal-body">
                  <?php if ( class_exists( 'WeDevs_Dokan' ) ) {
                      $default_avatar = '<img alt="avatar" src="'.get_avatar_url($current_user->user_email, array('size' => 100)).'">'; 
                  }else{
                      $default_avatar = get_gravatar( $current_user->user_email , 100, 'mp', 'g', true, array() );
                  } ?>
                  <div class="default new-avatar" data-name="default"><?php echo $default_avatar; ?></div>
                  <div class="av1 new-avatar" data-name="av1"><img src="<?php echo get_template_directory_uri() . '/assets/images/avatars/av1.png';?>" alt="avatar"></div>
                  <div class="av2 new-avatar" data-name="av2"><img src="<?php echo get_template_directory_uri() . '/assets/images/avatars/av2.png';?>" alt="avatar"></div>
                  <div class="av3 new-avatar" data-name="av3"><img src="<?php echo get_template_directory_uri() . '/assets/images/avatars/av3.png';?>" alt="avatar"></div>
                  <div class="av4 new-avatar" data-name="av4"><img src="<?php echo get_template_directory_uri() . '/assets/images/avatars/av4.png';?>" alt="avatar"></div>
                  <div class="av5 new-avatar" data-name="av5"><img src="<?php echo get_template_directory_uri() . '/assets/images/avatars/av5.png';?>" alt="avatar"></div>
                  <div class="av6 new-avatar" data-name="av6"><img src="<?php echo get_template_directory_uri() . '/assets/images/avatars/av6.png';?>" alt="avatar"></div>
                  <div class="av7 new-avatar" data-name="av7"><img src="<?php echo get_template_directory_uri() . '/assets/images/avatars/av7.png';?>" alt="avatar"></div>
              </div>
            </div>
          </div>
        </div>
