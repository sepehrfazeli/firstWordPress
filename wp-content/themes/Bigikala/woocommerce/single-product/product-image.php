<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
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

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $post, $product, $bigikala_options, $current_user;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
	'woocommerce-product-gallery',
	'woocommerce-product-gallery--' . ( has_post_thumbnail() ? 'with-images' : 'without-images' ),
	'woocommerce-product-gallery--columns-' . absint( $columns ),
	'images',
) );

?>
<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
	<div class="product-gallery-warp">
		<ul class="clearfix">
			<li class="youone-tooltip">
			<span class="youone-tooltiptext"><?php echo __('Add to wishlist','bigikala'); ?></span>
			<?php if ( !is_user_logged_in() ) {
			if($bigikala_options['popup_login'] == true ):
	        if( $bigikala_options['digits'] == true && function_exists('digit_get_login_fields')  ) { ?>
	            <span class="icon icon-love addtowishlist"><?php echo do_shortcode('[dm-login-modal]'); ?></span>
	        <?php } else{ ?>
		<a href="" data-toggle="modal" data-target="#bigikala_login" class="icon icon-love addtowishlist"></a>
	<?php }
	else: ?>
	    <a class="icon icon-love addtowishlist" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ).'?login=1'; ?>"></a>
	<?php endif;
	} else{ 
			        $wishlist = get_user_meta($current_user->ID , 'youone_wishlist' , true);
			        if ( is_array($wishlist) && in_array($product->get_id(), $wishlist)){
			            $active = ' active';
			        }else{
			            $active = '';
			        } ?>
			        <a data-product-id="<?php echo $product->get_id() ?>" class="icon icon-love addtowishlist youone-wishlist<?php echo $active; ?>"></a>
			    <?php 
			} ?>
			</li>
		<?php if ( isset($bigikala_options['show_share']) && $bigikala_options['show_share'] ) { ?>
			<li class="youone-tooltip">
			    <span class="youone-tooltiptext"><?php echo __('Share','bigikala'); ?></span>
				<a data-toggle="modal" data-target="#bigikala_sharebtn" id="ProductSocialShareForm" class="icon icon-share"></a>
			</li>
		<?php } ?>
		
		<?php if ( isset($bigikala_options['show_matrix_wolfnotify']) && $bigikala_options['show_matrix_wolfnotify'] &&  !$product->is_type('grouped')) {
			$special_offer = is_special_offer(get_the_id());
			if ( !$special_offer || !$product->is_in_stock() || $product->get_price() == '' ) {
				$stock_subscriber = check_user_stock_notify(get_the_id(),$current_user->ID);
				$offer_subscriber = check_user_offer_notify(get_the_id(),$current_user->ID);
				if ( $stock_subscriber || $offer_subscriber ) {
					$is_subscriber = true;
				} else {
					$is_subscriber = false;
				}
			?>
				<li class="youone-tooltip">
				    <span class="youone-tooltiptext"><?php echo __('Notify me','bigikala'); ?></span>
					<?php if ( !is_user_logged_in() ) { 
					if($bigikala_options['popup_login'] == true ):
	                if( $bigikala_options['digits'] == true && function_exists('digit_get_login_fields')  ) { ?>
	                    <span class="icon icon-notification"><?php echo do_shortcode('[dm-login-modal]'); ?></span>
	                <?php } else{ ?>
		                <a href="" data-toggle="modal" data-target="#bigikala_login" class="icon icon-notification"></a>
                	<?php }
	                else: ?>
	                    <a class="icon icon-notification" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ).'?login=1'; ?>"></a>
	                <?php endif;
					} else { ?>
						<a href="" data-toggle="modal" data-target="#bigikala_product_notify" class="icon icon-notification <?php if ($is_subscriber){ echo'done'; }?>"></a>
					<?php } ?>
				</li>
		<?php }
		}
		$matrix_wolf_compare = isset($bigikala_options['matrix_wolfcompare']) ? $bigikala_options['matrix_wolfcompare'] : false;
		$compare_page = isset($bigikala_options['compare_page']) ? get_permalink($bigikala_options['compare_page']) : false; 
		if ( $matrix_wolf_compare && $compare_page ) { ?>
			<li class="youone-tooltip">
			    <span class="youone-tooltiptext"><?php echo __('Compare','bigikala'); ?></span>
				<div class="woocommerce product compare-button">
					<a href="<?php echo $compare_page.'?products='.get_the_id(); ?>" target="_blank" class="icon icon-compare" rel="nofollow"></a>
				</div>
            </li>
		<?php } else {
			if( function_exists( 'yith_woocompare_premium_constructor' ) ) { ?>
			<li class="youone-tooltip">
			    <span class="youone-tooltiptext"><?php echo __('Compare','bigikala'); ?></span>
				<?php echo do_shortcode('[yith_compare_button]');?>
            </li>
		<?php } } ?>
		<?php 
		if ( isset($bigikala_options['show_price_change']) && $bigikala_options['show_price_change'] ) {
			$has_price_changes = get_post_meta (get_the_id(), 'has_price_changes', true);
			if ( $has_price_changes && $has_price_changes == 1 ) { ?>
				<li class="youone-tooltip">
				    <span class="youone-tooltiptext"><?php echo __('Price change','bigikala'); ?></span>
					<a href="" data-toggle="modal" data-target="#bigikala_price_change" class="icon icon-statistics"></a>
				</li>
			<?php } 
		}
		
		$product_video_type = get_post_meta (get_the_id(), 'video_type', true);

		if ( $product_video_type && $product_video_type != '' ) {
		?>
			<li data-toggle="modal" data-target="#modal-video-gallery" onclick="run_swiper_slider()"  class="youone-tooltip">
			    <span class="youone-tooltiptext"><?php echo __('Product video','bigikala'); ?></span>
				<a class="current-product-video" title="<?php echo get_the_title();?>">Video</a>
			</li>		
		<?php } ?>
		
		</ul>
	</div>
	<figure class="woocommerce-product-gallery__wrapper">
		<?php
		if ( has_post_thumbnail() ) {
            $html = bigi_get_gallery_image_html( $post_thumbnail_id, true );			
		} else {
			$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
			$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
			$html .= '</div>';
		}

		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id );

		do_action( 'woocommerce_product_thumbnails' );
		?>
	</figure>
<?php if(isset($bigikala_options['zoom_pic']) && $bigikala_options['zoom_pic'] == true){ ?>
		<div id="show_zoom_container"></div>
<script>
function youone_zoom(){
jQuery('.wp-post-image').elevateZoom({
	zoomWindowFadeIn: 200,
	zoomWindowFadeOut: 200,
	zoomWindowWidth:500,
	zoomWindowHeight:550,
	easing : true,
	zoomWindowPosition: "show_zoom_container",
	lensSize    : 200,
	lensOpacity: 1,
	lensColour: false , //colour of the lens background
	cursor:"crosshair",
	lensBorderColour: "#EF5661",
	lensBorderSize: 2.5,
	borderSize: 1,
	borderColour: "#666",

}); 
}
    youone_zoom();

    
</script>
<?php } ?>
</div>
<div class="modal fade-scale"  id="bigikala_sharebtn" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
		    <div class="y-modal-header">
				<a href="" data-dismiss="modal" aria-label="Close" class="close-icon"></a>
			</div>
		    <div class="c-remodal-share__aside"><div class="c-remodal-share__title-ilu"><?php echo _e('Sharing','bigikala');?></div><div class="c-remodal-share__ilu"></div></div>
				<div id="form_ProductSocialShareForm" class="sharing-panel" style="height: auto;">
					<div class="sharing-socials clearfix">
						<span class="sharing-socials-label"><?php echo _e('Share','bigikala');?></span>
						<ul class="clearfix">
							<li>
								<a href="https://www.facebook.com/sharer.php?v=4&src=bm&u=<?php echo esc_url(site_url()).'/?p='.$post->ID;?>" target="_blank" data-title="<?php echo get_the_title();?>" data-url="<?php echo esc_url(site_url()).'/?p='.$post->ID;?>" class="icon icon-facebook" title="<?php echo _e('Share On Facebook','bigikala');?>"><?php echo _e('Facebook','bigikala');?></a>
							</li>
							<li>
								<a href="https://twitter.com/home?status=<?php echo esc_url(site_url()).'/?p='.$post->ID;?>" target="_blank" data-title="<?php echo get_the_title();?>" data-url="<?php echo esc_url(site_url()).'/?p='.$post->ID;?>" class="icon icon-twitter" title="<?php echo _e('Share On Twitter','bigikala');?>"><?php echo _e('Twitter','bigikala');?></a>
							</li>
							<li>
								<a href="http://www.linkedin.com/shareArticle?mini=true&amp;title=<?php echo get_the_title(); ?>&amp;url=<?php echo esc_url(site_url()).'/?p='.$post->ID; ?>" target="_blank" data-title="<?php echo get_the_title();?>" data-url="<?php echo esc_url(site_url()).'/?p='.$post->ID;?>" class="icon icon-linkedin" title="<?php echo _e('Share On Linkedin','bigikala');?>"><?php echo _e('Linkedin','bigikala');?></a>
							</li>
							<li>
								<a href="https://telegram.me/share/url?url=<?php echo esc_url(site_url()).'/?p='.$post->ID;?>" target="_blank" class="icon icon-telegram" title="<?php echo _e('Share On Telegram','bigikala');?>" rel="nofollow"><?php echo _e('Telegram','bigikala');?></a>
							</li>
							<li>
							    <a href="whatsapp://send?text=<?php echo esc_url(site_url()).'/?p='.$post->ID;?>" target="_blank" class="icon icon-whatsapp" title="<?php echo _e('Share On Whatsapp','bigikala');?>" rel="nofollow"></a>
							</li>
						</ul>
					</div>
					
					<div class="sharing-shortlink clearfix">
						<label for="shortlink"><?php echo _e('Page Address','bigikala');?></label>
						<input type="text" id="shortlink" name="ShareUrl" value="<?php echo esc_url(site_url()).'/?p='.$post->ID;?>" readonly="readonly" style="direction: ltr; text-align: left;">
					</div>
					
					<form id="sendtofriend" action="sendtofriend" method="post">
						<div class="sharing-friends clearfix">
							<label for="friendemail"><?php echo _e('Send To A Friend','bigikala');?></label>
							<input type="text" id="friendemail" name="friendemail" style="direction: ltr;" placeholder="<?php echo _e('Your Friend Email','bigikala');?>">
						</div>
						
						<div class="sharing-submit clearfix">
							<div class="message-container"></div>
							<img alt="Loading..." id="loading-img" src="<?php echo esc_url( admin_url( 'images/loading.gif' ) ) ?>" style="display:none;">
							<div class="big-button-container small">
								<button class="wp-submit" type="submit" name="submit" id="sendtofriend-submit">
									<span class="big-button blue">
										<span class="big-button-label big-button-labelname clearfix">
											<?php echo _e('Send','bigikala');?>
										</span>
									</span>
								</button>
							</div>
						</div>
						<input type="hidden" id="product_id" name="product_id" value="<?php echo $post->ID;?>">
						<?php wp_nonce_field( 'ajax-sendtofriend-nonce', 'security' ); ?>
					</form>
				</div>
		</div>
	</div>
</div>