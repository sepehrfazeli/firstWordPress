<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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
 * @version     5.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $post, $bigikala_options;

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();
$single_style = $bigikala_options['single_product_style'];

?>

<?php
	/**
	 * woocommerce_before_single_product hook.
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="col-md-12 p-section-one">
		<div class="col-md-4 product-gallery">
			<?php
				/**
				 * woocommerce_before_single_product_summary hook.
				 *
				 * @hooked woocommerce_show_product_sale_flash - 10
				 * @hooked woocommerce_show_product_images - 20
				 */
				do_action( 'woocommerce_before_single_product_summary' );
			?>
		</div>

		<div class="col-md-8 product-det">
			<div class="col-md-12 header">
	            <div class="col-md-8 info-header">
					<h1><?php the_title (); ?>
						<span><?php echo get_post_meta ($post->ID, 'product_english_name', true); ?></span>
					</h1>
				</div>
                <?php if(isset($bigikala_options['new_comment_template']) && $bigikala_options['new_comment_template'] == true){ 
                    $comments = get_comments( array( 'post_id' => get_the_id(), 'status'    => 'approve' ) );
                    $i=0;
 		            if ( $comments ) : 
 		                foreach($comments as $comment){
 		                    $recommendation = get_comment_meta( $comment->comment_ID, 'recommendation', true );
 		                    if ($recommendation == 'yes') $i++;
 		                }
 		            endif;
 		            ?>
 		        <?php if ($i>0) : ?>
                <div class="recomendation-wrapper matrix_wolfrating">
                    <i class="tick"></i>
                    <span><?php echo sprintf(__('More than %s buyes recommend this product','bigikala'),$i); ?></span>
                </div>
                <?php endif; ?>
                <?php }else{ ?>
				<div class="matrix_wolfrating">
					<div class="disable-stars">
						<div style="width:<?php echo ( $average / 5 ) * 100 ; ?>%" class="enable-stars"></div>
					</div>
					<div class="rating-count">
					<span><?php echo _e('Out Of ','bigikala'); echo $rating_count; echo _e(' Rate','bigikala'); ?></span>
					</div>
				</div>
				<?php } ?>
				
			</div>
			<?php if($single_style == 'boxed'){ 
			    wc_get_template_part('single-product/templates/boxed');
			}else{
			    wc_get_template_part('single-product/templates/bigi');
			} ?>

		</div>
	</div><!-- .summary -->
	
    <div class="c-product__feature--body">
        <aside class="c-product__feature">
            <div class="o-grid">
              <div class="row">
                <?php if ($bigikala_options['switch_Express_Shipping'] == true ){ ?>
                  <div class="c-product__feature-col">
                    <a href="<?php if ( isset($bigikala_options['Express_Shipping']) && $bigikala_options['Express_Shipping'] ) { echo get_permalink($bigikala_options['Express_Shipping']); } ?>" target="_blank" class="c-product__feature-item c-product__feature-item--1">
                        <span><?php _e('facility','bigikala'); ?></span><?php echo $bigikala_options['text_Express_Shipping']; ?>
                    </a>
                  </div>
                <?php } ?>
                <?php if ($bigikala_options['switch_24_Hours_Support'] == true ){ ?>
                  <div class="c-product__feature-col">
                    <a href="<?php if ( isset($bigikala_options['24_Hours_Support']) && $bigikala_options['24_Hours_Support'] ) { echo get_permalink($bigikala_options['24_Hours_Support']); } ?>"  target="_blank" class="c-product__feature-item c-product__feature-item--3" >
                        <span><?php _e('facility','bigikala'); ?></span><?php echo $bigikala_options['text_24_Hours_Support'];?>
                    </a>
                  </div>
                <?php } ?>
                <?php if ($bigikala_options['switch_Payment_at_the_place'] == true ){ ?>
                  <div class="c-product__feature-col"><a href="<?php if ( isset($bigikala_options['Payment_at_the_place']) && $bigikala_options['Payment_at_the_place'] ) { echo get_permalink($bigikala_options['Payment_at_the_place']); } ?>" target="_blank" class="c-product__feature-item c-product__feature-item--4" >
                    <span><?php _e('facility','bigikala'); ?></span><?php echo $bigikala_options['text_Payment_at_the_place'];?>
                    </a>
                  </div>
                <?php } ?>
                <?php if ($bigikala_options['switch_back_guarantee'] == true ){ ?>
                  <div class="c-product__feature-col">
                    <a href="<?php if ( isset($bigikala_options['back_guarantee']) && $bigikala_options['back_guarantee'] ) { echo get_permalink($bigikala_options['back_guarantee']); } ?>" target="_blank" class="c-product__feature-item c-product__feature-item--5" >
                        <span><?php _e('facility','bigikala'); ?></span><?php echo $bigikala_options['text_back_guarantee'];?>
                    </a>
                  </div>
                <?php } ?>
                <?php if ($bigikala_options['switch_Guarantee_of_Origin'] == true ){ ?>
                  <div class="c-product__feature-col">
                    <a href="<?php if ( isset($bigikala_options['Guarantee_of_Origin']) && $bigikala_options['Guarantee_of_Origin'] ) { echo get_permalink($bigikala_options['Guarantee_of_Origin']); } ?>" target="_blank" class="c-product__feature-item c-product__feature-item--6" >
                        <span><?php _e('facility','bigikala'); ?></span><?php echo $bigikala_options['text_Guarantee_of_Origin'];?>
                    </a>
                  </div>
                <?php } ?>
              </div>
            </div>
        </aside>
    </div>

	<div>
		<?php
			/**
			 * woocommerce_after_single_product_summary hook.
			 *
			 * @hooked woocommerce_output_product_data_tabs - 10
			 * @hooked woocommerce_upsell_display - 15
			 * @hooked woocommerce_output_related_products - 20
			 */
			do_action( 'woocommerce_after_single_product_summary' );
		?>
	</div>
    <?php do_action( 'woocommerce_after_single_product' ); ?>
</div><!-- #product-<?php the_ID(); ?> -->

