<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
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

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$attachment_ids = $product->get_gallery_image_ids();
 

     if($attachment_ids){ ?>
	
		<ol class="youone-control-nav youone-control-thumbs" id="product-gallery">
			<?php
				$counter = 0;
			
				foreach($attachment_ids as $attachment_id){
					if ( $counter == 4 ) {
						
						echo '<li data-toggle="modal" data-target="#modal-video-gallery" onclick="run_swiper_slider()" ><a data-custom-open="modal-video-gallery" onclick="run_swiper_slider()" class="modal-opener woocommerce-product-gallery__trigger show_modal_gallery"><span class="matrix_wolfmore_gallery">...</span></a></li>';
						break;
					}	
					echo '<li data-toggle="modal" data-target="#modal-video-gallery" onclick="run_swiper_slider()" >'.wp_get_attachment_image( $attachment_id, 'shop_thumbnail', false, array() ).'</li>';
					$counter++;
				} 
			?>
		</ol>
	
	<?php } ?>