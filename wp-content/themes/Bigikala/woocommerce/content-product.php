<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
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

global $product, $bigikala_options;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
$matrix_wolfcompare = isset($bigikala_options['matrix_wolfcompare']) ? $bigikala_options['matrix_wolfcompare'] : false;
?>
<li <?php wc_product_class( '', $product ); ?> data-id=<?php echo $product->get_id();?> data-en="<?php echo get_post_meta($product->get_id(),'product_english_name',true);?>">
    <?php echo is_wonder($product); ?>
	<div class="products__item-img-color-wrapper">
		<a href="<?php echo get_the_permalink();?>"<?php if(isset($bigikala_options['new_tab']) && $bigikala_options['new_tab'] == true){ echo ' target="_blank"'; } ?> class="products__item-image-wrapper">
			<img alt="<?php echo get_the_title();?>" class="products__item-image" src="<?php if (has_post_thumbnail()){
							$img_id = get_post_thumbnail_id($product->get_id());
							$src = wp_get_attachment_image_src($img_id, 'shop_catalog'); echo $src[0];
							}  elseif ( ( $parent_id = wp_get_post_parent_id( $product->get_id() ) ) && has_post_thumbnail( $parent_id ) ) {
								$img_id = get_post_thumbnail_id($parent_id);
								$src = wp_get_attachment_image_src( $img_id, 'shop_catalog' ); echo $src[0];
							} else {
								echo esc_url( wc_placeholder_img_src() );
							} ?>">
		</a>
		<?php matrix_archive_color();?>
		
		
		
		<span class="products__item-colors-wrapper">
			<span class="products__item--colors">
				<span class="colors-wrapper">
				<?php
				remove_action( 'woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating', 5 );
				remove_action( 'woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price', 10 );
				?>
				<?php if ( $matrix_wolfcompare && is_product_category() ) { ?>
				<span class="products__item-compare">
					<label class="products__item-compare-txt"><?php echo _e('Compare','bigikala');?><input class="compare-chekcbox" value="on" type="checkbox" style="display:none;"></label>
				</span>
				<?php } ?>
				</span>
			</span>
		</span>
		<div class="products__item-info">
		    <?php 
		      remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash ', 10);
		      remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
		      do_action( 'woocommerce_before_shop_loop_item_title' ); 
		    ?>
			<a href="<?php echo get_the_permalink();?>"<?php if(isset($bigikala_options['new_tab']) && $bigikala_options['new_tab'] == true){ echo ' target="_blank"'; } ?> class="products__item-fatitle  force-rtl"><?php echo get_the_title();?></a>
            <?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
			<?php if ( function_exists( 'yith_advanced_reviews_instance' ) ) { ?>
			<span class="products__item-rate-wrapper">
				<span class="products__item-rate">
					<span class="rate">
						<span class="rate__value">
						<?php
						$YWAR_AdvancedReview	= yith_advanced_reviews_instance ();
						$reviews_count			= count ( $YWAR_AdvancedReview->get_product_reviews_by_rating ( $product->get_id() ) );
						$avg_rating_number		= number_format( $product->get_average_rating(), 1 );
						?>
							<svg class="svg-star" width="14" height="14"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-star_filled"><svg id="icon-star_filled" viewBox="0 0 1024 1024" width="100%" height="100%"><title>star_filled</title><path d="M817.582 956.314l-305.582-197.755-305.603 197.755 93.696-351.744-282.563-229.499 363.5-19.599 130.97-339.62 130.99 339.62 363.479 19.599-282.563 229.519 93.676 351.724z"></path></svg></use></svg>
							<?php echo $avg_rating_number;?>
						</span>
						<?php echo _e('From ','bigikala');?><?php echo $reviews_count; ?><?php echo _e(' Rate','bigikala'); ?>
					</span>
				</span>
			</span>
			<?php }
			
			if(get_post_meta($product->get_id(), '_coming_soon_product', true) == "on"){ ?>
			<span class="products__item-gift-price">
				<span class="products__item-price">
					<span class="products__item-price--final">
						<span class="coming_soon_archive"><?php echo _e('Coming soon','bigikala'); ?></span>
					</span>
				</span>
			</span>
			<?php }
			elseif ( $product->is_in_stock() ) { ?>
			<span class="products__item-gift-price">
		<span class="products__item-price">
				<?php if ( $product->is_on_sale() ) { 
					 echo  $product->get_price_html().loop_saving_percentage($product);
			    }else{ ?>
		        	<span class="matrix_wolffinal-price">
				    	<?php echo  $product->get_price_html(); ?>
			        </span>
			    <?php } 
			    if(isset($bigikala_options['show_modified_price_change']) && $bigikala_options['show_modified_price_change'] == true){ 
			    $diff = get_latest_price_change($product); if($diff): ?>
			      <div class="modified-info">
			        <span class="updated-price<?php if($diff['changes']<0){ echo ' down'; }elseif($diff['changes']>0){echo ' up';} ?>">
			            <?php echo wc_price($diff['changes']); if($diff['changes']<0){ echo '<i class="arrow-down"></i>'; }elseif($diff['changes']>0){echo '<i class="arrow-up"></i>';} ?>
			        </span>
			        <?php $d = strtotime( $diff['date'] ); ?>
			        <?php if(function_exists('jdate')){  ?>
			            <span class="modifued-date"><?php echo __('Update: ','bigikala').jdate("j F Y", $d); ?></span>
			        <?php }else{ ?>
			            <span class="modifued-date"><?php _e('Update: ','bigikala').date("j F Y", $d); ?></span>
			        <?php } ?>
			      </div>
			    <?php endif; } ?>
		</span>
			</span>
			<?php } else { ?>
			<span class="products__item-gift-price">
				<span class="products__item-price">
					<span class="products__item-price--final">
						<span class="out_stock"><?php _e('Out Of Stock ','bigikala'); ?></span>
					</span>
				</span>
			</span>
			<?php } ?>
			<?php if ( isset($bigikala_options['loop-cart']) && $bigikala_options['loop-cart'] && $bigikala_options['catalog_mode'] == false ) { ?>
			<div class="loop-add-to-cart">
				<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
			</div>
			<?php } ?>
			<?php
		   /* Start */
		   
		   $review_count = $product->get_review_count();
		   $avg_rating_number = number_format( $product->get_average_rating(), 1 );
		   $star = '<div class="custom-stars"><div class="customStar"><div class=""></div><p>'.$avg_rating_number.'</p></div><p>'.__("From ","bigikala"). $review_count.__(" Vote","bigikala").'  </p></div>' ;
		   echo $star;
		   if(function_exists('dokan_get_seller_rating')) :
		       $author_id = get_post_field('post_author', $product->get_id() );
               $store_info = dokan_get_store_info( $author_id ); ?>
        <div class="c-seller__info-loop">
            <i class="icon"></i>
            <?php echo _e('Sell By','bigikala');?> &nbsp; <a target="blank" class="seller-v" href="<?php echo dokan_get_store_url( $author_id ); ?>"> "<?php echo esc_html( $store_info['store_name'] ); ?>"</a>
        </div>
         <?php endif; ?>
		</div>
	</div>
	<div class="main-featured-loop">
	    <?php 
			$mainfea	= get_post_meta( $product->get_id() , 'main_features', true);
			if ( $mainfea ) { ?>	
			    <div class="main-features-title"><?php echo _e('Product Features','bigikala');?> </div>
				<ul class="main-features">
					<?php
					$i = 0;
					foreach ( $mainfea as $singlefea ) {
					    $i = $i+1;
					if($i < 6): ?>
					    <li><i class="icon-circle"></i><span class="title"><?php echo $singlefea['title']; ?></span>:<span class="value"><?php echo $singlefea['value']; ?></span></li>
					<?php
					    endif;
					    }
					?>
					</ul>
            <?php } ?>
	</div>
</li>
