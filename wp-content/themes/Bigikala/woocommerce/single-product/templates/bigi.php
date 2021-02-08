<?php global $product, $bigikala_options; ?>
<div class="row main-content">
	<div class="col-md-9">
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
                       if($j<=2){
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
        
	    if(function_exists('dokan_get_seller_rating')) :
	        $author_id = get_post_field('post_author', $product->get_id() );
            $store_info = dokan_get_store_info( $author_id );
        endif;
        if(function_exists('dokan_get_seller_rating') & !$product->is_type( 'variable' ) ) : 
            $dps_pt = get_user_meta(  $author_id , '_dps_pt', true );
            $_processing_time  = get_post_meta( $product->get_id() , '_dps_processing_time', true );
            $porduct_shipping_pt     = ( $_processing_time ) ? $_processing_time : $dps_pt;
											
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
            } ?>
            
            <div class="c-seller__detail">
                <div class="c-seller__info c-seller__info--title">
                    <i class="icon"></i>
                    <span><?php echo _e('Sell By','bigikala');?></span> &nbsp; 
                    <a target="blank" class="seller-v" href="<?php echo dokan_get_store_url( $author_id ); ?>"><?php echo esc_html( $store_info['store_name'] ); ?></a>
                </div>
                <div class="c-seller__info c-seller__rating">
                    <i class="icon"></i>
                    <span><?php echo _e('Purchase Satisfaction :','bigikala');?>&nbsp;</span>
                    <span class="green c-seller__rating">
                        <?php echo en2fa(dokan_get_seller_rating($author_id)['rating'] * 20)  ;?> %
                    </span>
                </div>
                <div class="c-seller__info c-seller__info--shipment">
                    <i class="icon"></i>
                    <span><?php echo _e('Packing and shipping by','bigikala');?></span> &nbsp; 
                    <a> <?php echo esc_html( $store_info['store_name'] ); ?></a>
                </div>
                <?php if ( $product->is_in_stock()  ) { ?>
                    <div class="c-seller__info c-seller__info--leadTime">
                        <?php if( $shipping_time == '' ){ ?>
                            <i class="icon ready"></i>
                            <?php echo _e('Ready to send','bigikala');?> &nbsp; 
                            <a> <?php echo esc_html( $store_info['store_name'] ); ?></a>
                            <div class="js-dk-wiki-trigger c-wiki c-wiki__holder">
                                <span class="c-wiki-sign"></span>
                                <div class="c-wiki__container js-dk-wiki is-right">
                                    <div class="c-wiki__arrow"></div>
                                    <p class="c-wiki__text"> <?php echo _e('This Product is in Stock & Ready to Deliver','bigikala');?> </p>
                                </div>
                            </div>
                        <?php }else{ ?>
                            <i class="icon"></i>
                            <?php echo _e('Ready to send from stock','bigikala');?><a> <?php echo esc_html( $store_info['store_name'] ); ?></a>
                            <span> &nbsp; <?php echo $shipping_time;?></span>
                            <div class="js-dk-wiki-trigger days c-wiki c-wiki__holder">
                                <span class="c-wiki-sign"></span>
                                <div class="c-wiki__container js-dk-wiki is-right days">
                                    <div class="c-wiki__arrow"></div>
                                    <p class="c-wiki__text"> <?php echo _e('This Product is in Stock. You Must Wait for Deliver','bigikala'); ?> </p>
                                </div>
                            </div>
                        <?php }?>
                    </div>
                <?php } ?>
            </div>
        <?php endif; ?>
        
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
			if(!$product->is_type( 'variable' )){ do_action( 'youone_before_atc' ); }
			do_action( 'woocommerce_single_product_summary' );
			do_action('youone_after_add_to_cart');
		?>
	</div>
	
    <div class="col-md-3">
		<?php if( class_exists( 'Dokan_SPMV_Products' ) ) {
            //$reseller = new Dokan_SPMV_Products();
            $lists = Dokan_SPMV_Products::get_other_reseller_vendors( $product->get_id() );
		    if ( $lists ) { ?>
		    	<a href="#other-vendor-camparison" id="vendors-count-link" class="vendors-count"><i class="icon"></i><span><?php echo count($lists);?></span>&nbsp;<?php _e ('Other vendor','bigikala');?></a>
            <?php }
        }
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
					
		<?php matrix_wolftemplate_single_brand(); ?>

	</div>
</div>