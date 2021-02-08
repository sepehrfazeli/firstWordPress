<?php global $product, $bigikala_options; ?>

<?php if($product->is_type('variable')){
	remove_action ('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
    remove_action ('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
	remove_action ('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
	remove_action ('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
	do_action( 'woocommerce_single_product_summary' );
}else{ ?>
<div class="row main-content">
	<div class="col-md-7">
		<?php if ( $bigikala_options['show_sku'] || $bigikala_options['show_category'] || $bigikala_options['show_tag'] ) { ?>
	        <div class="dk-product-meta product_meta">
            <?php youone_get_product_brand(); ?>
		    <?php if ( $bigikala_options['show_sku'] ) {
		    	if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
		    		<span class="sku_wrapper"><?php esc_html_e( 'SKU:', 'woocommerce' ); ?> <span class="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></span></span>
		    	<?php endif;
		    }
            if ( $bigikala_options['show_category'] && !$product->is_type('grouped') ) {
		    	echo '<span class="posted_in">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'woocommerce' );
		    	$terms = get_the_terms( $product->get_id() , 'product_cat' );
		    	$j = 0;
		    	if($terms){
                    foreach ($terms as $term) {
                       $term_link = get_term_link( $term );
                       if($j == 0){
                           echo '<a href="' .$term_link. '" rel="tag" >' . $term->name . '</a><span class="cama"> ,</span>';
                       }
                       $j = $j+1;
                   }
		    	}
                echo '</span>';
		    }
            if ( $bigikala_options['show_tag'] ) {
		    	echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'woocommerce' ) . ' ', '</span>' ); 
		    } ?>
        </div>
        <?php }
        
        $mainfea = get_post_meta( $product->get_id() , 'main_features', true);
		if ( $mainfea ) { ?>	
		    <div class="main-features-title"> <?php echo _e('Product Features','bigikala');?> </div> 					
			<ul class="main-features">
			<?php if ( $mainfea ) {
				$i = 0;
				foreach ( $mainfea as $singlefea ) {
					$i = $i+1; ?>
					<li class="<?php if($i>4){ echo 'hidden-mainfea';} ?>" ><i class="icon-circle"></i><span class="title"><?php echo $singlefea['title']; ?></span>:<span class="value"><?php echo $singlefea['value']; ?></span></li>
				<?php }
				if($i>4){ echo '<span id="more-link" class="">'.__("More items +","bigikala").'</span>'; } 
			} ?>
            </ul>
        <?php } ?>
    </div>
    
    <div class="col-md-5">
	    <?php if(function_exists('dokan_get_seller_rating')) :
	        $author_id = get_post_field('post_author', $product->get_id() );
            $store_info = dokan_get_store_info( $author_id );
        endif;
        if(function_exists('dokan_get_seller_rating') & !$product->is_type( 'variable' ) ) : 
            $dps_pt = get_user_meta(  $author_id , '_dps_pt', true );
            $_processing_time  = get_post_meta( $product->get_id() , '_dps_processing_time', true );
            $porduct_shipping_pt     = ( $_processing_time ) ? $_processing_time : $dps_pt;
            
            $performance_rating = get_user_meta( $author_id, 'performance_rating', true);
            $timely_supply = get_user_meta( $author_id, 'timely_supply', true);
            $posting_commitment = get_user_meta( $author_id, 'posting_commitment', true);
            $no_return = get_user_meta( $author_id, 'no_return', true);
            
            $rating_count = $product->get_rating_count();
            $average      = $product->get_average_rating();
            $percent = $average*100/5;
            
            switch ($porduct_shipping_pt) {
                case 1:
                    $shipping_time = __('1 work day','bigikala');
                    break;
                case 2:
                    $shipping_time = __('1 to 2 work day','bigikala');
                    break;
                case 3:
                    $shipping_time = __('1 to 3 work day','bigikala');
                    break;
                case 4:
                    $shipping_time = __('3 to 5 work day','bigikala');
                    break;
                case 5:
                    $shipping_time = __('1 to 2 work week','bigikala');
                    break;
                case 6:
                    $shipping_time = __('2 to 3 work week','bigikala');
                    break;
                case 7:
                    $shipping_time = __('3 to 4 work week','bigikala');
                    break;
                case 8:
                    $shipping_time = __('4 to 6 work week','bigikala');
                    break;
                case 9:
                    $shipping_time = __('6 to 8 work week','bigikala');
                    break;
                default:
                    $shipping_time = '';
            }
            endif; ?>
            <div class="product-info-box">
                <?php if(function_exists('dokan_get_seller_rating')){ ?>
                <div class="seller-info">
                    <div class="header-section">
                        <span><?php echo _e('Sell By','bigikala');?></span> &nbsp; 
                        <a target="blank" class="seller-v" href="<?php echo dokan_get_store_url( $author_id ); ?>"><?php echo esc_html( $store_info['store_name'] ); ?></a>
                        <div class="seller-performance">
                            <?php if($performance_rating){ ?>
                                <span><?php _e('Performance: ', 'bigikala'); ?></span> <span> <?php echo $performance_rating . __(' from 5', 'bigikala'); ?></span>
                            <?php }
                            if($rating_count > 0){
                               echo '<span>' . '%'.$percent . __(' Product satisfaction','bigikala') . '</span>';
                            } ?>
                        </div>
                        <span class="more_icon"></span>
                    </div>
                    <div class="body-section">
                    <span class="return"><?php _e('Return','bigikala'); ?></span>
                    <span class="store-name"><?php echo esc_html( $store_info['store_name'] ); ?></span>
                    <?php
                    if($timely_supply || $posting_commitment || $no_return) : ?>
                    <div class="youone-admin-rates">
                        <?php if($performance_rating){ ?>
                            <span><?php _e('Performance: ', 'bigikala'); ?></span> <span> <?php echo $performance_rating . __(' from 5', 'bigikala'); ?></span>
                        <?php } ?>
                        <?php if($timely_supply): ?>
                        <div>
                            <span class="<?php if($timely_supply >= 95){ echo 'green'; }else{ echo 'red'; } ?> "><?php echo $timely_supply; ?> ٪</span>
                            <span class="vendor-rate"><?php _e('Timely supply','bigikala'); ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if($posting_commitment): ?>
                        <div>
                            <span class="<?php if($posting_commitment >= 95){ echo 'green'; }else{ echo 'red'; } ?> "><?php echo $posting_commitment; ?> ٪</span>
                            <span class="vendor-rate"><?php _e('Posting commitment','bigikala'); ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if($no_return): ?>
                        <div>
                            <span class="<?php if($no_return >= 95){ echo 'green'; }else{ echo 'red'; } ?> "><?php echo $no_return; ?> ٪</span>
                            <span class="vendor-rate"><?php _e('No return','bigikala'); ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endif;
                    if($rating_count > 0){ 
                        $rating_1 = $product->get_rating_count(1);
                        $rating_2 = $product->get_rating_count(2);
                        $rating_3 = $product->get_rating_count(3);
                        $rating_4 = $product->get_rating_count(4);
                        $rating_5 = $product->get_rating_count(5);
                        
                        $five_review = $rating_5/$rating_count*100;
                        $four_review = $rating_4/$rating_count*100;
                        $three_review = $rating_3/$rating_count*100;
                        $two_review = $rating_2/$rating_count*100;
                        $one_review = $rating_1/$rating_count*100;
                        
                        
                        echo '<div class="product-rating-section">';
                        echo '<span>' . '%'.$percent . __(' Product satisfaction','bigikala') . $rating_count . '</span>'; ?>
                        <ul class="rating-details">
						<li>
							<i class="icon icon-emoji-laugh-s"></i>
							<span class="vendor-rate-rating_title"><?php _e('Full Satisfy','bigikala'); ?></span>

							<span class="vendor-rate-rating_bar">
								<span style="background: rgb(14, 180, 12) none repeat scroll 0% 0%; width: <?php echo $five_review;?>%;"></span>
							</span>

							<span class="vendor-rate-rating_rate-wrapper">
								<span class="vendor-rate-rating_percentage"><?php echo en2fa($five_review);?></span>&nbsp;٪
							</span>
						</li>
						<li>
							<i class="icon icon-emoji-laugh-s"></i>
							<span class="vendor-rate-rating_title"><?php _e('Satisfy','bigikala'); ?></span>
							<span class="vendor-rate-rating_bar">
								<span style="background: rgb(134, 237, 44) none repeat scroll 0% 0%; width: <?php echo $four_review;?>%;"></span>
							</span>
							<span class="vendor-rate-rating_rate-wrapper">
								<span class="vendor-rate-rating_percentage"><?php echo en2fa($four_review);?></span>&nbsp;٪
							</span>
						</li>
						<li>
							<i class="icon icon-emoji-noidea-s"></i>
							<span class="vendor-rate-rating_title"><?php _e('No Idea','bigikala'); ?></span>
							<span class="vendor-rate-rating_bar">
								<span style="background: rgb(253, 195, 100) none repeat scroll 0% 0%; width: <?php echo $three_review;?>%;"></span>
							</span>
							<span class="vendor-rate-rating_rate-wrapper">
								<span class="vendor-rate-rating_percentage"><?php echo en2fa($three_review);?></span>&nbsp;٪
							</span>
						</li>
						<li>
							<i class="icon icon-emoji-dissatisfied-s"></i>
							<span class="vendor-rate-rating_title"><?php _e('Not Satisfy','bigikala'); ?></span>
							<span class="vendor-rate-rating_bar">
								<span style="background: rgb(245, 154, 5) none repeat scroll 0% 0%; width: <?php echo $two_review;?>%;"></span>
							</span>
							<span class="vendor-rate-rating_rate-wrapper">
								<span class="vendor-rate-rating_percentage"><?php echo en2fa($two_review);?></span>&nbsp;٪
							</span>
						</li>
						<li>
							<i class="icon icon-emoji-absolutelysisSatisfied-s"></i>
							<span class="vendor-rate-rating_title"><?php _e('Full Not Satisfy','bigikala'); ?></span>
							<span class="vendor-rate-rating_bar">
								<span style="background: rgb(239, 86, 97) none repeat scroll 0% 0%; width: <?php echo $one_review;?>%;"></span>
							</span>
							<span class="vendor-rate-rating_rate-wrapper">
								<span class="vendor-rate-rating_percentage"><?php echo en2fa($one_review);?></span>&nbsp;٪
							</span>
						</li>
					</ul>
                        <?php echo '</div>';
                    } ?>
                    </div>
                </div>
                <?php } 
                if( isset( $bigikala_options['product_warranty_taxonomy'] ) ) {
                    $warranty_taxonomy = $bigikala_options['product_warranty_taxonomy'];
	            } 
	            $warranty = $product->get_attribute( $warranty_taxonomy );
				if($warranty){ ?>
                <div class="warranty-info">
					<span class="vendor-warranty">
					    <?php echo $warranty; ?>
					</span>
				</div>
				<?php } ?>
				<?php if ( $product->is_in_stock() && function_exists('dokan_get_seller_rating') ) { ?>
                    <div class="leadTime-info">
                        <?php if( $shipping_time == '' ){ ?>
                        <div class="header-section">
                            <i class="icon ready"></i>
                            <?php echo _e('Ready to send','bigikala');?> &nbsp; 
                            <a> <?php echo esc_html( $store_info['store_name'] ); ?></a>
                            <span class="more_icon"></span>
                        </div>
                        <div class="body-section">
                            <span class="return"><?php _e('Return','bigikala'); ?></span>
                            <b><?php echo _e('Ready to send','bigikala');?></b>
                            <p class="text"> <?php echo _e('This Product is in Stock & Ready to Deliver','bigikala');?> </p>
                        </div>
                        <?php }else{ ?>
                        <div class="header-section">
                            <i class="icon"></i>
                            <?php echo _e('Ready to send from stock','bigikala');?><a> <?php echo esc_html( $store_info['store_name'] ); ?></a>
                            <span> &nbsp; <?php echo $shipping_time;?></span>
                            <span class="more_icon"></span>
                        </div>
                        <div class="body-section">
                            <span class="return"><?php _e('Return','bigikala'); ?></span>
                            <p class="text"> <?php echo _e('This Product is in Stock. You Must Wait for Deliver','bigikala'); ?> </p>
                        </div>
                        <?php } ?>
                    </div>
                <?php } ?>
           
					<?php
						/**
						 * woocommerce_single_product_summary hook.
						 *
						 * @hooked woocommerce_template_single_title - 5
						 * @hooked woocommerce_template_single_rating - 10
						 * @hooked woocommerce_template_single_price - 10
						 * @hooked woocommerce_template_single_excerpt - 20
						 * @hooked woocommerce_template_single_add_to_cart - 30
						 * @hooked woocommerce_template_single_meta - 40
						 * @hooked woocommerce_template_single_sharing - 50
						 * @hooked WC_Structured_Data::generate_product_data() - 60
						 */
						remove_action ('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
						remove_action ('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
						remove_action ('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
						remove_action ('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
						do_action( 'youone_before_atc' );
						do_action( 'woocommerce_single_product_summary' ); 
						
			if( class_exists( 'Dokan_SPMV_Products' ) ) {
                //$reseller = new Dokan_SPMV_Products();
                $lists = Dokan_SPMV_Products::get_other_reseller_vendors( $product->get_id() );
				if ( $lists ) { 
				$min_price = $product->get_price();
				foreach ( $lists as $key => $list ){
				    $product_obj    = wc_get_product( $list->product_id );
				    $product_obj_price = $product_obj->get_price();
				    if($product_obj_price < $min_price) $min_price = $product_obj_price;
				} 
				if( $min_price < $product->get_price() ): ?>
				    <a href="#other-vendor-camparison" id="vendors-count-link" class="vendors-count"><span><?php echo sprintf(__('From %s by other sellers','bigikala'),wc_price($min_price));?></span><span><?php _e('View','bigikala'); ?></span></a>
				<?php else: ?>
					<a href="#other-vendor-camparison" id="vendors-count-link" class="vendors-count"><span><?php echo count($lists);?>&nbsp;<?php _e ('Seller of this product','bigikala');?></span><span><?php _e('View','bigikala'); ?></span></a>
                <?php 
                endif; 
				}
            } ?>
        </div>
        <?php do_action('youone_after_add_to_cart'); ?>
    </div>
</div>
<?php } ?>