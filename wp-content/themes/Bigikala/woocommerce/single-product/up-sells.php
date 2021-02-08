<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
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

if ( $upsells ) : ?>

	<div class="section-products-carousel upsell-carousel">
		<header>
			<span><?php _e( 'You may also like this products', 'bigikala' ) ?></span>
		</header>
				
		<div class="scroller partial">
			
			<div class="items">
				<?php foreach ( $upsells as $upsell ) : ?>

					<?php
						$post_object = get_post( $upsell->get_id() );

						setup_postdata( $GLOBALS['post'] =& $post_object );
						
						global $product;
                        if($product->is_in_stock()):
					?>

					<a class="productItem" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
						<img class="flickity-lazyloaded" alt="<?php the_title(); ?>" src="<?php if (has_post_thumbnail()){
							$img_id = get_post_thumbnail_id($post_object->ID);
							$src = wp_get_attachment_image_src($img_id, 'shop_catalog'); echo $src[0];
							}  elseif ( ( $parent_id = wp_get_post_parent_id( $post_object->ID ) ) && has_post_thumbnail( $parent_id ) ) {
								$img_id = get_post_thumbnail_id($parent_id);
								$src = wp_get_attachment_image_src( $img_id, 'shop_catalog' ); echo $src[0];
							} else {
								echo esc_url( wc_placeholder_img_src() );
							} ?>">
						<b class="fatitle"><?php the_title(); ?></b>
		<span class="products__item-price">
				<?php if ( $product->is_on_sale() ) { 
					 echo  $product->get_price_html();
			    }else{ ?>
		        	<span class="matrix_wolffinal-price">
				    	<?php echo  $product->get_price_html(); ?>
			        </span>
			    <?php } ?>
		</span>
					</a>
						
				<?php endif; endforeach; ?>
						
			</div>
				
		</div>
				
	</div>

<?php endif;

wp_reset_postdata();
