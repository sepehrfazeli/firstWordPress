<?php
/**
 * My Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address.php.
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
	exit; // Exit if accessed directly
}

$customer_id = get_current_user_id();

$current_user = wp_get_current_user();

//$user_mobile = get_user_meta ( $current_user->ID, 'billing_mobile', true ) ? get_user_meta ( $current_user->ID, 'billing_mobile', true ) : '--' ;
$user_phone = get_user_meta ( $current_user->ID, 'billing_phone', true ) ? get_user_meta ( $current_user->ID, 'billing_phone', true ) : '--';
$user_email = get_user_meta ( $current_user->ID, 'billing_email', true ) ? get_user_meta ( $current_user->ID, 'billing_email', true ) : '--';

$user_map = get_user_meta ( $current_user->ID, 'billing_map_lat_long', true ) ? get_user_meta ( $current_user->ID, 'billing_map_lat_long', true ) : false;

$get_addresses = apply_filters( 'woocommerce_my_account_get_addresses', array(
	'billing' => __( 'Billing address', 'woocommerce' ),
), $customer_id );

$oldcol = 1;
$col    = 1;
?>

<?php 
foreach ( $get_addresses as $name => $title ) : 

	$address = wc_get_account_formatted_address( $name );
	if ( $address ) {
	$address = explode ('<br/>', $address);
	
	if ( count($address) == 6 ) {
		$fullname = $address[1];
		$company = $address[0];
		$state = $address[2];
		$city = $address[3];
		$adress = str_replace(' -','',$address[4]);
		$postcode = $address[5];
	} else {
		$company = false;
		$fullname = $address[0];
		$state = $address[1];
		$city = $address[2];
		$adress = str_replace(' -','',$address[3]);
		$postcode = $address[4];
	}
	
?>

<div class="report-wrapper box noback">
	<div class="address_list">
		<div class="address_item">
			<table>
				<tbody>
					<tr>
						<td class="fr txtright" colspan="3" style="border-left: 0;">
							<h3 style="display: inline-block"><?php echo $fullname; if ($company){ echo ' ( '.$company.' )'; }?></h3>
							<?php 
							    global $bigikala_options; 
							    if( isset($bigikala_options['hidemap_layout']) && $bigikala_options['hidemap_layout'] == false ){ 
							      if ( $user_map ) { ?>
								    <span class="hasmap"><?php _e ( 'Thanks to help us for better services by set your location on map','bigikala' ); ?></span>
							      <?php } else { ?>
								    <span class="nomap"><?php _e ( 'For better services, set your location on map','bigikala' ); ?></span>
							      <?php } 
							    } ?>
						</td>
						<td class="last" rowspan="3">
							<table class="control-btn">
								<tbody>
									<tr>
										<td class="edit">
											<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', $name ) ); ?>" class="act edit click-handler shipping-btn" title="<?php _e ( 'Edit Address','bigikala' ); ?>"><i title="<?php _e ( 'Edit Address','bigikala' ); ?>"></i></a>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr>
						<td class="txtright fr addresss">
							<span class="label"><?php _e ( 'State: ','bigikala' ); ?></span>
							<span class="label-value"><?php echo $state; ?></span>
						</td>
						<td rowspan="2" class="addresss">
							<p class="txtright"></p>
							<p class="txtright"><?php echo $adress; ?></p>
							<p class="txtright">
								<span class="label"><?php _e ( 'Postal Code: ','bigikala' ); ?></span>
								<span class="label-value"><?php echo $postcode; ?></span>
							</p>
						</td>
						<td class="fr" style="border-left: 0;">
							<span class="label"><?php _e ( 'Mobile: ','bigikala' ); ?></span>
							<span class="label-value"><?php echo $user_phone; ?></span>
						</td>
					</tr>
					<tr>
						<td class="txtright addresss">
							<span class="label"><?php _e ( 'City: ','bigikala' ); ?></span>
							<span class="label-value"><?php echo $city; ?></span>
						</td>
						<td style="border-left: 0;">
							<span class="label"><?php _e ( 'Email: ','bigikala' ); ?></span>
							<span class="label-value"><?php echo $user_email; ?></span>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

<?php } else { ?>
<div class="report-wrapper box noback">
    <div class="report-info-wrapper">
        <div class="report-info-table">
            <p><?php _e( 'You have not set up this type of address yet.', 'woocommerce' ); ?></p>
        </div>
        
        <div class="report-button-container clearfix">
            <a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', $name ) ); ?>">                            
				<span class="change-address left dk-box"><?php _e ( 'Edit Address','bigikala' ); ?></span>
            </a>
        </div>
    </div>
</div>
<?php } ?>

<?php endforeach; ?>
