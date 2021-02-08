<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version 5.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $bigikala_options;
?>
<div class="main_custom_order_by_sort">
    <span><?php _e('Sortby: ', 'bigikala'); ?> </span>
    <?php foreach ( $catalog_orderby_options as $id => $name ) : 
        $title = str_replace('Sort by ', '', esc_html( $name )) ;
        
					
        echo '<span style="display:none">';
        $x = selected( $orderby, $id );
        echo '</span>';
        if ( $x ) {
            $selected = 'selected';
        } else {
            $selected = '';
        }
        global $wp;  
        $current_url  = add_query_arg( $_SERVER['QUERY_STRING'], '', home_url( $wp->request ).'/' );
    ?>
    <a href="<?php echo youone_merge_querystring( $current_url ,'?orderby='.esc_attr( $id ) ); ?>" data-sort="<?php echo esc_attr( $id ); ?>" class="custom_order_by_sort <?php echo $selected; ?>" rel="nofollow">
        <?php echo $title; ?>
    </a>
    <?php endforeach; ?>

    <span data-type_view="listing" onClick="youone_change_type_view(this)" class="type_view type_view_listing <?php if( isset( $_COOKIE['type_view'] ) && $_COOKIE['type_view'] == 'listing' ) echo 'active'; ; if ( !isset( $_COOKIE['type_view'] ) && $bigikala_options['archive_style'] == 'listing') echo 'active';?>"></span>
    <span data-type_view="grid" onClick="youone_change_type_view(this)" class="type_view type_view_grid <?php if( isset( $_COOKIE['type_view'] ) && $_COOKIE['type_view'] == 'grid' ) echo 'active'; if ( !isset( $_COOKIE['type_view'] ) && $bigikala_options['archive_style'] == 'grid') echo 'active'; ?>"></span>
</div>
