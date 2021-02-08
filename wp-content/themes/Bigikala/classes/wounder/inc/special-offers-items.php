<?php
defined("ABSPATH") or die();
global $product;
global $bigikala_options;
$available = $product->get_stock_status();
	if ( $product->is_type( 'variable' ) ) {
	$haraj_price = $product->get_variation_sale_price();
	$normal_price = $product->get_variation_regular_price();
	} else{
	$normal_price = get_post_meta(get_the_id() , '_regular_price', true);
	$haraj_price = get_post_meta(get_the_id() , '_sale_price', true);
	}
?>
<div class="matrix_wolfspecial-product">
  <div class="matrix_wolfspecial-image <?php if($available == "outofstock") { echo "blur";}?>">
    <span class="discount clearfix"><span class="discount__amount"><?php echo wc_price($normal_price - $haraj_price);?></span><span class="takhfifat"><?php echo __('Discount', 'bigikala');?></span></span>
    <a href='<?php the_permalink();?>'>
      <?php if(has_post_thumbnail()){
        echo get_the_post_thumbnail(get_the_ID(), 'shop_catalog');
      } else{
        echo wc_placeholder_img('shop_catalog');
      }?>
    </a>
  </div>

  <div class="matrix_wolfspecial-des <?php if($available == "outofstock") { echo "blur";}?>">
    <div class="matrix_wolfproduct-title"><a href='<?php the_permalink();?>'><?php the_title();?></a></div>
    <div class="matrix_wolfproduct-attributes">

    </div>
    <div class="matrix_wolfproduct-prcie">
      <div class="matrix_wolfproduct-old-price"><?php echo wc_price($normal_price);?></div>
      <div class="matrix_wolfproduct-sale-price"><?php echo wc_price($haraj_price);?></div>
    </div>
    <div class="matrix_wolfproduct-view"><a href="<?php the_permalink();?>"><?php echo __('view and buy the product', 'bigikala');?></a></div>
  </div>
  <?php if($available == "outofstock") : ?>
    <?php if(!empty($bigikala_options['wounder_outofstock_image']['url'])) : ?>
    <div class="matrix_wolfspecial-product-finish"><img src="<?php echo $bigikala_options['wounder_outofstock_image']['url'];?>"></div>
    <?php else:?>
<div class="matrix_wolfspecial-product-finish"><img src="<?php
						echo get_template_directory_uri() . '/assets/images/finished.png'; ?>"></div>
    <?php endif;?>
  <?php endif;?>
</div>