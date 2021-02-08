<?php
/**
 *   Template Name: Products list
 */
    get_header('checkout');
    
    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => -1,
    );
    
    $paged = (int) (!isset($_REQUEST["dpage"]) ? 1 : $_REQUEST["dpage"]); 
    
    $j = 0;
    $i = 0;
    $per_page = 10;
    
    $loop = new WP_Query( $args );
    $s_products = array();
    while ( $loop->have_posts() ) : $loop->the_post(); 
        global $product; 
                        
        if ( $product->is_type( 'variable' ) ) {
	        #0 if set default variation get the default item
            $default_attributes = youone_get_default_attributes( $product );
            $variation_id = youone_find_matching_product_variation( $product, $default_attributes );
            if($variation_id != 0){
                $variation_product = new WC_Product_Variation( $variation_id );
                $_product = $variation_product;
                $reg_price = $variation_product->regular_price;
                $price  = $variation_product->price;
                if($reg_price != $price){ $regprice = $reg_price; }else{ $regprice = ''; }
                $stock_status = $variation_product->stock_status;
                $main_price = $price;
                if($regprice){ $second_price = $regprice;}else{$second_price = $price;}
                if($stock_status != 'instock'){ $stock = 0; } else{ $stock = 1; }
            }else{
            #1 Get product variations
            $product_variations = $product->get_available_variations();
            #2 Get variation ids of a product
            $oprice;
            $regprice;
            $stock;
            foreach($product_variations as $var){
                $var_id = $var['variation_id'];
                $variation_product = new WC_Product_Variation( $var_id );
                $_product = $variation_product;
                $reg_price = $variation_product->regular_price;
                $price  = $variation_product->price;
                $stock_status = $variation_product->stock_status;
                    $oprice = $price;
                    if($stock_status != 'instock'){ $stock = 0; } else{ $stock = 1; }
                    if($reg_price != $price){ $regprice = $reg_price; }else{ $regprice = ''; }
                
            }
            $main_price = $oprice;
            if($regprice) { 
                $second_price = $regprice;
            } else{
                $second_price = $oprice;
            }
            }
        }else{
            $main_price = $product->get_price();
            $_product = $product;
            if($product->is_on_sale()){$second_price = $product->get_regular_price(); }else{$second_price = $main_price;}
            if($product->get_stock_status() != 'instock'){
                $stock = 0;
            }else{
                $stock = 1;
            }
        }
        if($stock == 1 && $main_price && $second_price && $_product->is_purchasable() ):
            $s_products[] = array( 'id' => $_product->get_id(), 'mprice' => $main_price, 'sprice' => $second_price);
            $j++;
        endif;
        endwhile;
     wp_reset_query(); ?>

<div class="container-bigikala main-warp minimal-checkout">
		<main id="main" class="site-main">
        <h1><?php echo sprintf(__('%s products list','bigikala'), get_bloginfo('name') ); ?></h1>
            <table class="product-list-table">
                <thead>
                    <tr>
                        <td>
                            <?php _e('Title','bigikala'); ?>
                        </td>
                        <td>
                            <?php _e('Image','bigikala'); ?>
                        </td>
                        <td>
                            <?php global  $woocommerce; echo __('Price ','bigikala').'('.get_woocommerce_currency_symbol().')'; ?>
                        </td>
                        <td>
                            <?php echo __('Sale price ','bigikala').'('.get_woocommerce_currency_symbol().')'; ?>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <?php  
                    foreach($s_products as $key => $s_product){
                        if ($key < ($paged-1)*$per_page) continue;
                        if($i<$per_page):
                        $i++;
                        $id = $s_product['id'];
                        $image = has_post_thumbnail($id) ? get_the_post_thumbnail_url($id, 'shop_catalog') : wc_placeholder_img_src() ;
                        $main_price = $s_product['mprice'];
                        $second_price = $s_product['sprice'];
                    ?>
                        <tr>
                            <td>
                                <a href="<?php echo get_permalink($id); ?>"><?php echo get_the_title($id); ?></a>
                            </td>
                            <td>
                                <?php echo '<img alt="'. get_the_title($id).'" src="'.$image.'"'; ?>
                            </td>
                            <td class="price">
                                <?php echo $second_price; ?>
                            </td>
                            <td class="price">
                                <?php echo $main_price; ?>
                            </td>
                        </tr>
            <?php endif; } ?>
            </tbody>
            </table>
            <?php		    
            $total_pages = ceil($j/$per_page);
            $current_page = $paged;
    if ($total_pages > 1){
        global $wp;
        $first =  home_url( $wp->request ); 
        echo '<div class="pagination"';
        
        echo paginate_links(array(
            'base' => $first . '%_%',
            'format' => '?dpage=%#%',
            'current' => $current_page,
            'total' => $total_pages,
            'prev_text'    => __('« prev','bigikala'),
            'next_text'    => __('next »','bigikala'),
        ));
        echo '</div>';
    } ?>
		</main><!-- #main -->
</div><!-- .container main -->

<?php get_footer();
