<?php
/**
 * Related Products edited by youone
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
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

if ( isset($bigikala_options['show_related']) && $bigikala_options['show_related'] ) {
    if ( isset($bigikala_options['bigi_related_products']) && $bigikala_options['bigi_related_products'] == true ) {
          global $post;
  
  //get wonder term 
  $wonder_term = get_term($bigikala_options['offer_menu_cat']);
  if($wonder_term) {$wonder_cat_id = $wonder_term->term_id;}else{$wonder_cat_id;}

  // get categories
  $terms = wp_get_post_terms( $post->ID, 'product_cat' );
  $cats_array = array();
  foreach ( $terms as $term ){ 
    $children = get_term_children( $term->term_id, 'product_cat' );
    if ( !sizeof( $children ) && $term->term_id != $wonder_cat_id )
      $cats_array[] = $term->term_id;
  }
  $query_args = array( 
    'post__not_in' => array( $post->ID ), 
    'posts_per_page' => 10, 
    'no_found_rows' => 1, 
    'post_status' => 'publish', 
    'post_type' => 'product', 
    'tax_query' => array( 
      array(
        'taxonomy' => 'product_cat',
        'field' => 'id',
        'terms' => $cats_array
      )
    ),
    'meta_query' => array(
      array(
		'key' => '_stock_status', 
		'value' => 'outofstock', 
		'compare' => 'NOT LIKE'
	  )
	)
  );
  $youone_related = new WP_Query($query_args);
if ( $youone_related->have_posts() ) : ?>
	<div class="section-products-carousel">
		<header>
			<h2><?php esc_html_e( 'Related products', 'woocommerce' ); ?></h2>
		</header>
				
		<div class="scroller partial">
			
			<div class="items">
				<?php while ($youone_related->have_posts()) :
					$youone_related->the_post(); 
					global $product; 
						if($product->is_in_stock()):
						$price_html = isset($bigikala_options['price_html']) ? $bigikala_options['price_html'] : false;

					?>

					<a class="productItem" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
						<img class="flickity-lazyloaded" alt="<?php the_title(); ?>" src="<?php if (has_post_thumbnail()){
							$img_id = get_post_thumbnail_id($product->get_id());
							$src = wp_get_attachment_image_src($img_id, 'shop_catalog'); echo $src[0];
							}  elseif ( ( $parent_id = wp_get_post_parent_id( $product->get_id() ) ) && has_post_thumbnail( $parent_id ) ) {
								$img_id = get_post_thumbnail_id($parent_id);
								$src = wp_get_attachment_image_src( $img_id, 'shop_catalog' ); echo $src[0];
							} else {
								echo esc_url( wc_placeholder_img_src() );
							} ?>">
						<h4><b class="fatitle"><?php the_title(); ?></b></h4>
						<?php
						if(get_post_meta($product->get_id(), '_coming_soon_product', true) == "on"){?>
						    <span class="products__item-gift-price">
                				<span class="products__item-price">
                					<span class="products__item-price--final">
                						<span class="coming_soon_archive"><?php echo _e('Coming soon','bigikala'); ?></span>
                					</span>
                				</span>
                			</span>
						<?php } else{ ?>
						    
					
		<span class="products__item-price">
				<?php if ( $product->is_on_sale() ) { 
					 echo  $product->get_price_html();
			    }else{ ?>
		        	<span class="matrix_wolffinal-price">
				    	<?php echo  $product->get_price_html(); ?>
			        </span>
			    <?php } ?>
		</span>
    				    <?php } ?>
					</a>
						
				<?php endif; endwhile; ?>
						
			</div>
				
		</div>
				
	</div>

<?php endif;

wp_reset_postdata();

    }else{
        if ( $related_products ) : ?>
        
        	<div class="section-products-carousel">
		<header>
			<h2><?php esc_html_e( 'Related products', 'woocommerce' ); ?></h2>
		</header>
				
		<div class="scroller partial">
			
			<div class="items">
			    <?php foreach ( $related_products as $related_product ) : 
			    $post_object = get_post( $related_product->get_id() ); 
			    setup_postdata( $GLOBALS['post'] =& $post_object ); 
			    global $product; ?>
					<a class="productItem" title="<?php echo get_the_title(); ?>" href="<?php echo get_the_permalink();?>">
						<img class="flickity-lazyloaded" alt="<?php echo get_the_title(); ?>" src="<?php if (has_post_thumbnail()){
							$img_id = get_post_thumbnail_id($product->get_id());
							$src = wp_get_attachment_image_src($img_id, 'shop_catalog'); echo $src[0];
							}  elseif ( ( $parent_id = wp_get_post_parent_id( $product->get_id() ) ) && has_post_thumbnail( $parent_id ) ) {
								$img_id = get_post_thumbnail_id($parent_id);
								$src = wp_get_attachment_image_src( $img_id, 'shop_catalog' ); echo $src[0];
							} else {
								echo esc_url( wc_placeholder_img_src() );
							} ?>">
						<h4><b class="fatitle"><?php echo get_the_title(); ?></b></h4>
						<?php
						if(get_post_meta($product->get_id(), '_coming_soon_product', true) == "on"){?>
						    <span class="products__item-gift-price">
                				<span class="products__item-price">
                					<span class="products__item-price--final">
                						<span class="coming_soon_archive"><?php echo _e('Coming soon','bigikala'); ?></span>
                					</span>
                				</span>
                			</span>
						<?php } else{ ?>
						    
					
		<span class="products__item-price">
				<?php if ( $product->is_on_sale() ) { 
					 echo  $product->get_price_html();
			    }else{ ?>
		        	<span class="matrix_wolffinal-price">
				    	<?php echo  $product->get_price_html(); ?>
			        </span>
			    <?php } ?>
		</span>
    				    <?php } ?>
					</a>
		<?php endforeach; ?>
        </div>
				</div>
		</div>
        <?php endif;
        wp_reset_postdata();
    }
    

}


?>