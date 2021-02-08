<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version 5.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$wishlist = get_user_meta($current_user->ID , 'youone_wishlist' , true);
$firstname = get_user_meta ( $current_user->ID, 'first_name', true );
$lastname = get_user_meta ( $current_user->ID, 'last_name', true );
if ( $firstname && $lastname ) {
	$user_name = $firstname . ' ' . $lastname;
} else {
	$user_name = $current_user->display_name;
}
$user_email = $current_user->user_email;
$user_register = strtotime ($current_user->user_registered);
//$user_mobile = get_user_meta ( $current_user->ID, 'billing_mobile', true ) ? get_user_meta ( $current_user->ID, 'billing_mobile', true ) : '--' ;
$user_mobile = get_the_author_meta('digits_phone_no', $user->ID) ? esc_attr(get_the_author_meta('digits_phone_no', $user->ID)): '--' ;
$user_phone = get_user_meta ( $current_user->ID, 'billing_phone', true ) ? get_user_meta ( $current_user->ID, 'billing_phone', true ) : '--';
$user_state = get_user_meta ( $current_user->ID, 'billing_state', true ) ? get_user_meta ( $current_user->ID, 'billing_state', true ) : '--';
$user_city = get_user_meta ( $current_user->ID, 'billing_city', true ) ? get_user_meta ( $current_user->ID, 'billing_city', true ) : '--';
$user_address = get_user_meta ( $current_user->ID, 'billing_address_1', true ) ? get_user_meta ( $current_user->ID, 'billing_address_1', true ) : '--';
$user_postcode = get_user_meta ( $current_user->ID, 'billing_postcode', true ) ? get_user_meta ( $current_user->ID, 'billing_postcode', true ) : '--';


?>

<div class="report-wrapper box noback<?php if($wishlist) echo ' half-width'; ?>">
    <header class="report-title"><?php _e ( 'User Information','bigikala' ); ?></header>
    <div class="report-info-wrapper">
        <div class="report-info-table">
            <table>
                <tbody>
                    <tr>
                        <td>
                            <span class="title"><?php _e ( 'Full Name: ','bigikala' ); ?></span>
                            <span class="_txt">
								<?php echo $user_name; ?>
                            </span>
                        </td>
                        <td>
                            <span class="title"><?php _e ( 'Email: ','bigikala' ); ?></span>
                            <span class="_txt">
                                <?php echo $user_email; ?>
                            </span>
                        </td>
						<td>
                            <span class="title"><?php _e ( 'Mobile: ','bigikala' ); ?></span>
                            <span class="_txt ltr">
                                 <?php echo $user_phone; ?>
                            </span>
                        </td>
						<td>
                            <span class="title"><?php _e ( 'Register Time: ','bigikala' ); ?></span>
                            <span class="_txt">
                                <?php echo date_i18n ( 'j F Y', $user_register); ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
						<td>
                            <span class="title"><?php _e ( 'State: ','bigikala' ); ?></span>
                            <span class="_txt">
                                <?php 
                                    if (is_numeric($user_state)) {
                                        $state_term = get_term($user_state);
                                        if($state_term) { 
                                            echo $state_term->name;
                                        }else{
                                            echo $user_state;
                                        }
                                    }else{
                                        echo $user_state;
                                    }
                                ?>
                            </span>
                        </td>
                        <td>
                            <span class="title"><?php _e ( 'City: ','bigikala' ); ?></span>
                            <span class="_txt">
                                <?php 
                                    if (is_numeric($user_city)) {
                                        $city_term = get_term($user_city);
                                        if($city_term) { 
                                            echo $city_term->name;
                                        }else{
                                            echo $user_city;
                                        }
                                    }else{
                                        echo $user_city;
                                    }
                                ?>
                            </span>
                        </td>
						<td>
                            <span class="title"><?php _e ( 'Postal Code: ','bigikala' ); ?></span>
                            <span class="_txt">
                                <?php echo $user_postcode; ?>
                            </span>
                        </td>
						<td>
                            <span class="title"><?php _e ( 'Address: ','bigikala' ); ?></span>
                            <span class="_txt">
                                <?php echo $user_address; ?>
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="report-button-container clearfix">
            <a href="<?php echo wc_get_endpoint_url( 'edit-account' );?>">
				<span class="edit-info left dk-box"><?php _e ( 'Edit Account','bigikala' ); ?></span>
            </a>
            <a href="<?php echo wc_get_endpoint_url( 'edit-address' );?>">                            
				<span class="change-address left dk-box"><?php _e ( 'Edit Address','bigikala' ); ?></span>
            </a>
        </div>
    </div>
</div>
<?php if($wishlist){ $k = 0; ?>
<div class="report-wrapper box noback half-width">
    <header class="report-title"><?php _e ( 'Your latest wishlist','bigikala' ); ?></header>
        <div class="report-info-wrapper">
            <ul class="wishlist-wrapper">
                <?php foreach($wishlist as $product_id){ 
                    if($k<4) :
                    $_product = wc_get_product( $product_id ); 
                    if($_product){ ?>
                    <li class="wishlist-item">
                        <a href="<?php echo get_permalink($product_id); ?>">
                            <?php $thumb = get_the_post_thumbnail($product_id,'thumbnail');
                            if ($thumb) {
                                echo $thumb;
                            }else{
                                echo wc_placeholder_img();
                            } 
                            echo '<span>'.get_the_title($product_id).'</span>'; ?>
                        </a>
                        <span class="price"><?php echo $_product->get_price_html(); ?></span>
                        <a data-product-id="<?php echo $product_id ?>" class="remove youone-wishlist"></a>
                    </li>
                    <?php } ?>
                <?php endif; $k++; } ?>
            </ul>
            <?php if($k>3) echo '<a class="edit-wishlist" href="'.wc_get_endpoint_url( 'your-wishlist' ).'">'.__("View and edit your wishlist","bigikala").'</a>'; ?>
        </div>
</div>
<?php } ?>
        <?php 
            $args = array(
                'limit' => 4,
                'customer_id' => $current_user->ID,
            );
            
            $orders = wc_get_orders( $args );
            $j = 0;
if ( $orders ) : ?>
<div class="report-wrapper box noback">
    <header class="report-title"><?php _e ( 'Latest orders','bigikala' ); ?></header>
    <div class="report-info-wrapper">

	<table class="woocommerce-orders-table woocommerce-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table">
		<thead>
			<tr>
				<?php foreach ( wc_get_account_orders_columns() as $column_id => $column_name ) : ?>
					<th class="woocommerce-orders-table__header woocommerce-orders-table__header-<?php echo esc_attr( $column_id ); ?>"><span class="nobr"><?php echo esc_html( $column_name ); ?></span></th>
				<?php endforeach; ?>
			</tr>
		</thead>

		<tbody>
			<?php foreach ( $orders as $customer_order ) :
			    $j++;
				$order      = wc_get_order( $customer_order );
				$item_count = $order->get_item_count();
				?>
				<tr class="woocommerce-orders-table__row woocommerce-orders-table__row--status-<?php echo esc_attr( $order->get_status() ); ?> order">
					<?php foreach ( wc_get_account_orders_columns() as $column_id => $column_name ) : ?>
						<td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-<?php echo esc_attr( $column_id ); ?>" data-title="<?php echo esc_attr( $column_name ); ?>">
							<?php if ( has_action( 'woocommerce_my_account_my_orders_column_' . $column_id ) ) : ?>
								<?php do_action( 'woocommerce_my_account_my_orders_column_' . $column_id, $order ); ?>

							<?php elseif ( 'order-number' === $column_id ) : ?>
								<a href="<?php echo esc_url( $order->get_view_order_url() ); ?>">
									<?php echo _x( '#', 'hash before order number', 'woocommerce' ) . $order->get_order_number(); ?>
								</a>

							<?php elseif ( 'order-date' === $column_id ) : ?>
								<time datetime="<?php echo esc_attr( $order->get_date_created()->date( 'c' ) ); ?>"><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></time>

							<?php elseif ( 'order-status' === $column_id ) : ?>
								<?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?>

							<?php elseif ( 'order-total' === $column_id ) : ?>
								<?php
								/* translators: 1: formatted order total 2: total order items */
								printf( _n( '%1$s for %2$s item', '%1$s for %2$s items', $item_count, 'woocommerce' ), $order->get_formatted_order_total(), $item_count );
								?>

							<?php elseif ( 'order-actions' === $column_id ) : ?>
								<?php
								$actions = wc_get_account_orders_actions( $order );

								if ( ! empty( $actions ) ) {
									foreach ( $actions as $key => $action ) {
										echo '<a href="' . esc_url( $action['url'] ) . '" class="woocommerce-button button ' . sanitize_html_class( $key ) . '">' . esc_html( $action['name'] ) . '</a>';
									}
								}
								?>
							<?php endif; ?>
						</td>
					<?php endforeach; ?>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<?php if($j>=4){ ?><div class="all-orders"><a href="<?php echo wc_get_endpoint_url('orders'); ?>"><?php _e('View orders list', 'bigikala'); ?></a></div><?php } ?>

    </div>
</div>
<?php endif; ?>
<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
?>

