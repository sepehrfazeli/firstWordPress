<?php

// use bigikala options

$plug_url = get_template_directory_uri() . '/classes/wounder/';
define('SOURCE', $plug_url);
add_action('wp_enqueue_scripts', 'wounder_enqueue_scripts');


function wounder_enqueue_scripts()
{
  
  global $bigikala_options;
  	wp_enqueue_script('jquery');
	wp_register_script('jquery-flipclock', get_template_directory_uri() . '/classes/wounder/js/flipclock.min.js', array(
		'jquery'
	));
	wp_enqueue_script('jquery-flipclock');
	wp_register_script('jquery-lif', get_template_directory_uri() . '/classes/wounder/js/jquery.countdown.js', array(
		'jquery'
	));

	wp_enqueue_script('jquery-lif');

	if (!empty($bigikala_options['wounder_amazing_icon_image']['url'])) {
		$css = ".product_bar{
            background: url('" . $bigikala_options['wounder_amazing_icon_image']['url'] . "') 97.5% center no-repeat #fff5f5;
            }";
		wp_add_inline_style('bigikala-main-theme', $css);
	}

	if (!empty($bigikala_options['wounder_index_color1'])) {
		$color = $bigikala_options['wounder_index_color1'];
		$css_color = "
    dell span::before {
    border-bottom: 1px solid $color!important
    }
    .columnone inss {
    background-color: $color!important;
    }
    .columnone label {
    color: $color!important;
    }
    .lofslidervoc ul.navigator-wrap-inner li.active {
    background: $color;
    }
    .lofslidervoc ul.navigator-wrap-inner li::before {
    background-color: $color!important;
    }
    .promotion__timer {
    background: $color;
    }
    .clock {
    background-color: $color;
    }
    .special_offers .discount {
    background: $color;
    }
    .matrix_wolfproduct-sale-price {
    color: $color;
    }
    .product_bar_price inss {
    background: $color;
    }
    .new-price {
    background: $color;
    }
    .old-price::before {
    border-bottom: 1px solid $color;
    }
    .matrix_wolfadaptive-prices .matrix-wolffinal-price {
    background: $color;
    }
    ";
		wp_add_inline_style('bigikala-main-theme', $css_color);
	}

	if (!empty($bigikala_options['wounder_index_color2'])) {
		$color2 = $bigikala_options['wounder_index_color2'];
		$css_color2 = "
        .special_offers .takhfifat {
        background: $color2;
        }
        .promotion__header {
        background-color: $color2;
        }
        .columnone label {
        background-color: $color2;
        }
        .wc-descrip .matrix_wolffinal-price .woocommerce-Price-amount {
        background-color: $color2!important;
        }
    ";
		wp_add_inline_style('bigikala-main-theme', $css_color2);
	}

	if (!empty($bigikala_options['wounder_old_price_color'])) {
		$color7 = $bigikala_options['wounder_old_price_color'];
		$css_grey = "
        .old-price {
            background-color: $color7;
        }
        .columnone dell span {
        background: $color7;
        }
        dell span::after {
        border-right: 10px solid $color7;
        }
        .wc-descrip .matrix_wolfold-price {
		            background-color: $color7;
        }
        .matrix_wolfadaptive-prices .matrix-wolfold-price {
         background-color: $color7;
        }
    ";
		wp_add_inline_style('bigikala-main-theme', $css_grey);
	}

if (!empty($bigikala_options['theme-color'])) {
		$color22 = $bigikala_options['theme-color'];
		$css_color22 = "
    ";	
		wp_add_inline_style('bigikala-main-theme', $css_color22);
	}
	
	if (!empty($bigikala_options['wounder_countdown_color'])) {
		$color6 = $bigikala_options['wounder_countdown_color'];
		$css_counter = "
        .flip-clock-wrapper ul li a div div.inn {
            background-color: $color6;
        }
        .matrix_wolftimer .hour, .matrix_wolftimer .minutes {
        background: $color6;
        }
    ";
		wp_add_inline_style('bigikala-main-theme', $css_counter);
	}

	if (!empty($bigikala_options['wounder_basket_cart_color'])) {
		$color3 = $bigikala_options['wounder_basket_cart_color'];
		$css_green = "
        .matrix_wolfproduct-view {
           background-color: $color3;
        }
    ";
		wp_add_inline_style('bigikala-main-theme', $css_green);
	}

	if (!empty($bigikala_options['wounder_button_color'])) {
		$color4 = $bigikala_options['wounder_button_color'];
		$css_button = "
        .matrix_wolfspecial-offers-homepage-page a {
           background-color: $color4;
        }
        .carousel--incredible__button {
        background: $color4;
        }
        .matrix_wolfspecial-offers-homepage-page a:active,
.matrix_wolfspecial-offers-homepage-page a:focus,
.matrix_wolfspecial-offers-homepage-page a:hover {
    background-color:$color4!important;
}
    ";
		wp_add_inline_style('bigikala-main-theme', $css_button);
	}

	if (!empty($bigikala_options['wounder_product_header_background'])) {
		$color5 = $bigikala_options['wounder_product_header_background'];
		$css_background = "
.product_bar {
    background-color: $color5;

}
    ";
		wp_add_inline_style('bigikala-main-theme', $css_background);
	}
}

function base_shortcode_func()
{
    global $bigikala_options;
	if (wp_is_mobile()) {
		echo do_shortcode('[special_adaptive_shortcode]');
	}
	else {

		ob_start();
		//date_default_timezone_set('Asia/Tehran');
		//$getdate = date("Y-m-d 00:52:00");
		$gettime = time();

	    global $wpdb;
	    $product_fdb = $wpdb->get_col( "
            (SELECT p.ID FROM {$wpdb->prefix}posts as p
            INNER JOIN {$wpdb->prefix}postmeta as pm ON p.ID = pm.post_id
            INNER JOIN {$wpdb->prefix}postmeta as pm2 ON p.ID = pm2.post_id
            WHERE p.post_type = 'product'
            AND pm.meta_key = '_sale_price_dates_to'
            AND pm.meta_value > {$gettime}
            AND pm2.meta_key = '_sale_price_dates_from'
            AND pm2.meta_value < {$gettime}
            AND p.post_status = 'publish')
            UNION
            (SELECT p2.ID FROM {$wpdb->prefix}posts as p2
            INNER JOIN {$wpdb->prefix}posts as p3 ON p3.post_parent = p2.ID
            INNER JOIN {$wpdb->prefix}postmeta as pm ON p3.ID = pm.post_id
            INNER JOIN {$wpdb->prefix}postmeta as pm2 ON p3.ID = pm2.post_id
            WHERE p2.post_type = 'product'
            AND pm.meta_key = '_sale_price_dates_to'
            AND pm.meta_value > {$gettime}
            AND pm2.meta_key = '_sale_price_dates_from'
            AND pm2.meta_value < {$gettime}
            AND p2.post_status = 'publish'
            AND p3.post_status = 'publish')
        " );
        //var_dump($product_fdb);

		$prodctargs = array(
			'post_type' => 'product',
			'posts_per_page' => 9,
			'post__in'		=> $product_fdb
		);
		$productsquery = new WP_Query();
		$productsquery->query($prodctargs);
		if ($productsquery->have_posts() && $product_fdb) { ?>
		<div id="lofslider" class="lofslidervoc">
			<div class="preloader"><div></div></div>

			<div class="lofslidermain"><ul class="lofslidersmain">
				<?php
			$counter = 1;
			$offer_slider_products_title = array();
			while ($productsquery->have_posts()):
				$productsquery->the_post();
				global $product, $post;
				if ( $product->is_type( 'variable' ) ) {
				    
            $default_attributes = youone_get_default_attributes( $product );
            $variation_id = youone_find_matching_product_variation( $product, $default_attributes );
            $oprice;
            $regprice;
            $zamanepayan;
            if($variation_id != 0){
                $variation_product = new WC_Product_Variation( $variation_id );
                $reg_price = $variation_product->get_regular_price();
                $price  = $variation_product->get_price();
				$wcgetmojod = get_post_meta($variation_id, '_manage_stock', true);
				$wcgettedad = $variation_product->get_stock_quantity();
				$zamanepayani = get_post_meta($variation_id, '_sale_price_dates_to', true);
                if($reg_price != $price && $zamanepayani){ 
                    $regprice = $reg_price; 
                    $oprice = $price; 
                    $zamanepayan = $zamanepayani; 
                    $var_p = $variation_product; 
                    $variation_price = $variation_product->get_price_html(); 
                    $saving_percentages = '%'.en2fa(round( 100 - ( $price / $reg_price * 100 ), 1 )) . ' <span>'.__('Discount','bigikala').'</span>';
                }else{
                  #1 Get product variations
                  $product_variations = $product->get_available_variations();
                  #2 Get variation ids of a product
                  foreach($product_variations as $var){
                    $variation_id = $var['variation_id'];
                    $variation_product = new WC_Product_Variation( $variation_id );
				    $wcgetmojodi = get_post_meta($variation_id, '_manage_stock', true);
				    $wcgettedadi = $variation_product->get_stock_quantity();
				    $zamanepayani = get_post_meta($variation_id, '_sale_price_dates_to', true);
                    $reg_price = $variation_product->get_regular_price();
                    $price  = $variation_product->get_price();
                    if ( $zamanepayani && $reg_price != $price && ( !isset($oprice) || $reg_price != $price ) ){
                        $var_p = $variation_product;
                        $oprice = $price;
                        $regprice = $reg_price;
                        $zamanepayan = $zamanepayani;
                        $wcgetmojod = $wcgetmojodi;
                        $wcgettedad = $wcgettedadi;
                        $variation_price = $variation_product->get_price_html();
                        $saving_percentages = '%'.en2fa(round( 100 - ( $price / $reg_price * 100 ), 1 )) . ' <span>'.__('Discount','bigikala').'</span>';
                    }
                  }
                }
            }else{
                #1 Get product variations
                $product_variations = $product->get_available_variations();
                #2 Get variation ids of a product
                foreach($product_variations as $var){
                    $variation_id = $var['variation_id'];
                    $variation_product = new WC_Product_Variation( $variation_id );
				    $wcgetmojodi = get_post_meta($variation_id, '_manage_stock', true);
				    $wcgettedadi = $variation_product->get_stock_quantity();
				    $zamanepayani = get_post_meta($variation_id, '_sale_price_dates_to', true);
                    $reg_price = $variation_product->get_regular_price();
                    $price  = $variation_product->get_price();
                    if ( $zamanepayani && $reg_price != $price && ( !isset($oprice) || $reg_price != $price ) ){
                        $var_p = $variation_product;
                        $oprice = $price;
                        $regprice = $reg_price;
                        $zamanepayan = $zamanepayani;
                        $wcgetmojod = $wcgetmojodi;
                        $wcgettedad = $wcgettedadi;
                        $variation_price = $variation_product->get_price_html();
                        $saving_percentages = '%'.en2fa(round( 100 - ( $price / $reg_price * 100 ), 1 )) . ' <span>'.__('Discount','bigikala').'</span>';
                    }
                }
            }
            


			}else{
				$wcgetmojod = get_post_meta($post->ID, '_manage_stock', true);
				$wcgettedad = $product->get_stock_quantity();
				$zamanepayan = get_post_meta($post->ID, '_sale_price_dates_to', true);

			}
?>
					<li><a href="<?php
				the_permalink(); ?>" ><div class="wc-thumb <?php
				if ($wcgetmojod == 'yes' && $wcgettedad == 0 || $zamanepayan < $gettime) {
					echo 'napadid';
				} ?>"><img alt="<?php the_title(); ?>" src="<?php
				$img_id = get_post_thumbnail_id($post->ID);
				$src =wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), array('300','300'), true );
				echo $src[0]; ?>"></div><div class="wc-descrip"><div class="columnone <?php
				if ($wcgetmojod == 'yes' && $wcgettedad == 0 || $zamanepayan < $gettime) {
					echo 'napadid';
				} ?>">
<span class="special"><?php echo __('special offers', 'bigikala'); ?></span>
				<?php if($product->is_type('variable') ) {echo $variation_price.'<div class="wonder-price-discount">'.$saving_percentages.'</div>'; }
				else{echo $product->get_price_html().'<div class="wonder-price-discount">'.saving_percentage($product).'</div>'; } ?>
				
				<h2><?php
 the_title(); ?></h2>
</div>

<div class="columntwo <?php
				if ($wcgetmojod == 'yes' && $wcgettedad == 0 || $zamanepayan < $gettime) {
					echo 'napadid';
				} ?>"><?php
				$mainfea	= get_post_meta( $post->ID , 'main_features', true);
			    if ( $mainfea ) { ?>	
				<div class="slider-main-features">
					<?php
					$i = 0;
					foreach ( $mainfea as $singlefea ) {
					    $i = $i+1;
					if($i < 5): ?>
					    <div><span class="title"><?php echo $singlefea['title']; ?></span>:<span class="value"><?php echo $singlefea['value']; ?></span></div>
					<?php
					    endif;
					    }
					?>
				</div>
                <?php }  ?>
</div>
<?php
				if ($wcgetmojod == 'yes' && $wcgettedad == 0 || $zamanepayan < $gettime) { ?>
	<?php
					if (!empty($bigikala_options['wounder_outofstock_image']['url'])) { ?>
		<div class="tamamshode"><img alt="Out of stock" src="<?php
						echo $bigikala_options['wounder_outofstock_image']['url']; ?>"></div>
	<?php
					}
					else { ?>
		<div class="tamamshode"><img alt="Finished" src="<?php
						echo get_template_directory_uri() . '/assets/images/finished.png'; ?>"></div>
	<?php
					} ?>

<?php
				} ?>
<div class="columncounter <?php
				if ($wcgetmojod == 'yes' && $wcgettedad == 0 || $zamanepayan < $gettime) {
					echo 'counter-hide';
				} ?>"><span>
				
				<?php
				if(!empty($bigikala_options['wounder_title'])) { echo $bigikala_options['wounder_title']; }
				else {
					echo 'offer timeout';
				} ?></span>
                        <div id="bigiCountDown" class="bigicountDown<?php
				echo $post->ID; ?>"></div>
        <script>
	      jQuery(document).ready(function() {
			var clock;

			clock = jQuery('.bigicountDown<?php
				echo $post->ID; ?>').FlipClock({
		        clockFace: 'DailyCounter',
		        autoStart: false,

		    });

		    clock.setTime(<?php
				echo $zamanepayan - time(); ?>);
		    clock.setCountdown(true);
		    clock.start();

		});
	      </script>
      </div></div></a></li>
			<?php
				$short_title = get_post_meta($post->ID,'product_short_name','true');
				if($short_title){
				    $offer_slider_products_title[] = $short_title;
				}else{
				    $offer_slider_products_title[] = get_the_title();
				}
			endwhile;
				
?>
				</ul></div>
	<div class="navigator-content">
	  <div class="navigator-wrapper">
	    <ul class="navigator-wrap-inner">
	        <?php foreach($offer_slider_products_title as $title) echo '<li><span>' . $title . '</span></li>'; ?>
	    </ul>
	    <div class="matrix_wolfspecial-offers-homepage-page">
	        <?php if ( isset($bigikala_options['offer_menu_cat']) && $bigikala_options['offer_menu_cat'] ) { 
	            $term = get_term($bigikala_options['offer_menu_cat']); ?>
		        <a href="<?php if($term) echo get_term_link($term); ?>"><?php echo _e('veiw all Special Offers','bigikala');?></a>
	        <?php }elseif ( isset($bigikala_options['offer_menu_link']) && $bigikala_options['offer_menu_link'] ) { ?>
		        <a href="<?php echo get_permalink($bigikala_options['offer_menu_link']); ?>"><?php echo _e('veiw all Special Offers','bigikala');?></a>
	        <?php } ?>
		</div>
	  </div>
	  <div class="button-previous"></div>
	  <div class="button-next"></div>
	</div>
</div>


		<?php
		}else{
		    echo '<div class="wonder-no-products">'.__('No wonderful products found.','bigikala').'</div>';
		}
		
		wp_reset_query();
		return ob_get_clean();
	}
}

add_shortcode('bigikala-slider-off', 'base_shortcode_func');

if ($bigikala_options['wounder_show_product_header'] && $bigikala_options['wounder_show_product_header'] == 1) {
	add_action('woocommerce_before_single_product_summary', 'display_product_timer',5);
}

function display_product_timer(){
	global $product;
	//date_default_timezone_set('Asia/Tehran');
	if ( $product->is_type( 'variable' ) ) {
        $default_attributes = youone_get_default_attributes( $product );
        $var_id = youone_find_matching_product_variation( $product, $default_attributes );

    	$variation_min_price = $product->get_variation_sale_price();
    	$variation_max_price = $product->get_variation_regular_price();
    	if($variation_min_price && $variation_max_price)
    	$final_price = $variation_max_price - $variation_min_price;

        $start_array = array();
        $end_array = array();
        $default_var = '';
            
        $product_variations = $product->get_available_variations();
        foreach($product_variations as $var){
            $variation_id = $var['variation_id'];
            $variation_product = new WC_Product_Variation( $variation_id );
                    
	        $s = get_post_meta($variation_id, '_sale_price_dates_from', true);
	        $e = get_post_meta($variation_id , '_sale_price_dates_to', true);
            if ($s && $e && time() < $e) {
                $start_array[$variation_id] = $s;
                $end_array[$variation_id] = $e;
                $default_var = $variation_id;
            }
        }

        $start = get_post_meta($default_var, '_sale_price_dates_from', true);
        $end = get_post_meta($default_var , '_sale_price_dates_to', true);
        if ($start && $end && time() < $end && time() > $start) { ?>
			<div class="product_bar" style="display:none;"><div class="product_bar_left"><div id="bigiCountDown" class="bigicountDown<?php
		echo get_the_ID(); ?> small"></div><?php
		if (true) { ?>
				<script>
	      jQuery(document).ready(function() {
			var clock;

			clock = jQuery('.bigicountDown<?php
			echo get_the_ID(); ?>').FlipClock({
		        clockFace: 'DailyCounter',
		        autoStart: false,

		    });

		    clock.setTime(<?php
			echo $end - time(); ?>);
		    clock.setCountdown(true);
		    clock.start();
		    jQuery('input.variation_id').change(function(){
		        var var_id = jQuery('input.variation_id').val();
		        var ends = {<?php foreach($end_array as $key => $value){
		            echo $key.':'.$value.', ';
		        } ?> }
		        var time = ends[var_id] - <?php echo time(); ?> ;
		        if (!isNaN(time)){
		            clock.setTime( time);
		            jQuery('.product_bar').show();
		        }else{
		            jQuery('.product_bar').hide();
		        }
		    });

		});
	      </script>

                <?php
		} ?><div class="product_bar_price"><inss><span><?php
		echo format_prices($final_price); ?></span><em><?php
		echo get_woocommerce_currency_symbol(); ?></em></ins><span class="product_bar_dis"><?php
		echo __('Discount', 'bigikala'); ?></span></div></div></div>
		<?php
	}
        
    }else{
	$start = get_post_meta(get_the_id() , '_sale_price_dates_from', true);
	$end = get_post_meta(get_the_id() , '_sale_price_dates_to', true);
    $normal_price = get_post_meta(get_the_id() , '_regular_price', true);
	$haraj_price = get_post_meta(get_the_id() , '_sale_price', true);
	

    if ($normal_price && $haraj_price && $start && $end && time() < $end && time() > $start) { 
    $final_price = $normal_price - $haraj_price; ?>
    
			<div class="product_bar"><div class="product_bar_left"><div id="bigiCountDown" class="bigicountDown<?php
		echo get_the_ID(); ?> small"></div><?php
		if (true) { ?>
				<script>
	      jQuery(document).ready(function() {
			var clock;

			clock = jQuery('.bigicountDown<?php
			echo get_the_ID(); ?>').FlipClock({
		        clockFace: 'DailyCounter',
		        autoStart: false,

		    });

		    clock.setTime(<?php
			echo $end - time(); ?>);
		    clock.setCountdown(true);
		    clock.start();

		});
	      </script>

                <?php
		} ?><div class="product_bar_price"><inss><span><?php
		echo format_prices($final_price); ?></span><em><?php
		echo get_woocommerce_currency_symbol(); ?></em></ins><span class="product_bar_dis"><?php
		echo __('Discount', 'bigikala'); ?></span></div></div></div>
		<?php
	}
}
}

if (!function_exists('format_prices')) {
	function format_prices($price, $args = array())
	{
		extract(apply_filters('wc_price_args', wp_parse_args($args, array(
			'ex_tax_label' => false,
			'currency' => '',
			'decimal_separator' => wc_get_price_decimal_separator() ,
			'thousand_separator' => wc_get_price_thousand_separator() ,
			'decimals' => wc_get_price_decimals() ,
			'price_format' => get_woocommerce_price_format() ,
		))));
		$negative = $price < 0;
		$price = apply_filters('raw_woocommerce_price', floatval($negative ? $price * -1 : $price));
		$price = apply_filters('formatted_woocommerce_price', number_format($price, $decimals, $decimal_separator, $thousand_separator) , $price, $decimals, $decimal_separator, $thousand_separator);
		if (apply_filters('woocommerce_price_trim_zeros', false) && $decimals > 0) {
			$price = wc_trim_zeros($price);
		}

		$formatted_price = ($negative ? '-' : '') . sprintf($price_format, '', $price);
		$return = $formatted_price;
		return apply_filters('wc_price', $return, $price, $args);
	}
}

//add_action('save_post', 'fix_varation_products_slider', 10, 2);

function fix_varation_products_slider($post_id, $post)
{
	$product = wc_get_product($post_id);
	if (!$product) {
		return;
	}

	if ($product->has_child()) {
		$child_id = array_keys(get_children(array(
			'post_parent' => $post_id,
			'post_type' => 'product_variation',
			'post_status' => 'publish',
			'numberposts' => 1
		))) [0];
		add_filter('woocommerce_price_trim_zeros', '__return_true');
		$productV = new WC_Product_Variable($post_id);
		update_post_meta($post_id, '_regular_price', round($productV->get_variation_regular_price('max')));
		update_post_meta($post_id, '_sale_price', round($productV->get_variation_sale_price('min')));
		if (!empty(get_post_meta($child_id, '_sale_price_dates_to', true)) && !empty(get_post_meta($child_id, '_sale_price_dates_from', true))) {
			update_post_meta($post_id, '_sale_price_dates_to', get_post_meta($child_id, '_sale_price_dates_to', true));
			update_post_meta($post_id, '_sale_price_dates_from', get_post_meta($child_id, '_sale_price_dates_from', true));
		}
	}
}

// / special offers page ( shortcode )

function special_offers_page_shortcode()
{
if ( get_query_var('paged') ) {
    $paged = get_query_var('paged');
} elseif ( get_query_var('page') ) { // 'page' is used instead of 'paged' on Static Front Page
    $paged = get_query_var('page');
} else {
    $paged = 1;
}
	$products = new WP_Query(array(
		'post_type' => 'product',
		'posts_per_page' => 10,
		'paged' => $paged,
		'meta_query' => array(
			array(
				'key' => '_sale_price_dates_to',
				'value' => date('Y-m-d 00:00:00') ,
				'compare' => '>',
				'type' => 'numeric'
			) ,
		)
	));
	if ($products->have_posts()):
		while ($products->have_posts()):
			$products->the_post();
			include dirname(__FILE__) . '/inc/special-offers-items.php';

		endwhile;
	    $total_pages = $products->max_num_pages;

    if ($total_pages > 1){

        $current_page = max(1, get_query_var('paged'));
        echo '<div class="clearfix"></div><div class="special-pagination">';
        echo paginate_links(array(
            'base' => get_pagenum_link(1) . '%_%',
            'format' => '/page/%#%',
            'current' => $current_page,
            'total' => $total_pages,
            'prev_text'    => __('« prev','bigikala'),
            'next_text'    => __('next »','bigikala'),
        ));
        echo '</div>';
    }    

	endif;
wp_reset_postdata();
}

add_shortcode('special_offers_page', 'special_offers_page_shortcode');

function special_offer_sticky_shortcode()
{
	include dirname(__FILE__) . '/inc/special-offers-header.php';

}

add_shortcode('special_offer_sticky', 'special_offer_sticky_shortcode');

// special offers page

if(isset($bigikala_options['offer_menu_link']) && $bigikala_options['offer_menu_link'] !=''){
add_action('page_template', 'special_offers_page_template', 10, 1);
}
function special_offers_page_template($template)
{
    global $bigikala_options;
    

	if (is_page(get_post_field('post_name', $bigikala_options['offer_menu_link']))) {
		$template = dirname(__FILE__) . '/template-offers.php';
	}

	return $template;
}

// adaptive shortcode

function adaptive_slider_shortcode()
{
	ob_start();
	include dirname(__FILE__) . '/inc/adaptive-slider.php';

	return ob_get_clean();
}

add_shortcode("special_adaptive_shortcode", 'adaptive_slider_shortcode');
?>