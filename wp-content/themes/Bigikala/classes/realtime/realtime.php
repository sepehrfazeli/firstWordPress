<?php
if(!defined('ABSPATH')){
	die('No script kids! ');
}

if(!class_exists('matrix_wolfrealtime')){

	class matrix_wolfrealtime{


		private static function get_offered_products($cats = null ,$cm = null){

			$args = array(
				'post_type' => 'product',
				'fields' => 'ids',
				'posts_per_page' => 10,
				'order' => 'desc',
				'orderby' => 'rand'
			);
			
	    	$metas[] = array(
                'key'     => '_stock_status',
                'value'   => 'outofstock',
                'compare' => 'NOT LIKE',
            );
            
            $metas[] = array(
                'key'     => '_price',
                'value'   => 0,
                'compare' => '>',
            );
            
            if($cats){
              $category = explode(',',$cats);
			  $args['tax_query'] = array(
				array(
					'taxonomy'  => 'product_cat',
					'field'		=> 'term_id',
					'terms'		=>  $category
				)
			  );
            }
	        if( $cm ){
	    	    $metas[] = array(
                   'key'     => '_coming_soon_product',
                   'compare' => 'NOT EXISTS',
                );
	        }
	        
	        $args['meta_query'] = array_merge( WC()->query->get_meta_query(), $metas );
			$posts = get_posts($args);

			return $posts;
		}


		public static function offers($atts){
		    $a = shortcode_atts( array(
		         'title' => __('Realtime offer','bigikala'),
		         'category' => '',
		         'coming_soon' => ''
	        ), $atts );
	        $cats = $a['category'];
	        $products = self::get_offered_products($cats ,$a['coming_soon']);
			ob_start(); ?>

			<div class='matrix_wolfbox'>
			<div class='matrix_wolfheader'><?php echo $a['title']; ?></div>
			<?php if($products): ?><div class='matrix_wolfloader'><div class='matrix_wolfborder-top'></div><div class='layer'></div></div><?php endif; ?>
			<div class="realtime-slider">
			    <?php if($products): ?>
			    <ul>
			    <?php foreach($products as $p){
			        $pro = new WC_Product($p);
			        if($pro->get_price() !=0 && $pro->get_price() !=''){
			        $image = has_post_thumbnail($p) ? get_the_post_thumbnail_url($p, 'shop_catalog') : wc_placeholder_img_src() ; ?>
			        <li>
			        <a href='<?php the_permalink($p); ?>' class='matrix_wolflink'>
			            <img alt="<?php echo get_the_title($p); ?>" src='<?php echo $image; ?>' class='matrix_wolfimg'>
			            <div class='matrix_wolfname'><?php echo get_the_title($p); ?></div>
			            <div class='matrix_wolffooter'>
			                <div class='matrix_wolfshow-btn'><?php echo __('View','bigikala'); ?></div>
			                <div class='matrix_wolfprice'><?php echo $pro->get_price_html(); ?></div>
			            </div>
			        </a>
			        </li>
			    <?php } 
			    } ?>
			    </ul>
			    <?php else: echo '<span class="empty-realtime-slider">'.__('Nothing found!','bigikala').'</span>'; endif; ?>
			</div>
			</div>
        <script>
		jQuery('.realtime-slider').djSlider({
            slideTime: 8000,  //ms
            speed: 500,  // ms
            autoSlide_outAnimation: 'swipeRight',  // or : swipeRight , swipeLeft , fade
            autoSlide_inAnimation: 'swipeRight',  // or : swipeRight , swipeLeft , fade
            captionSupport: false,  // or : false
            autoSlide: true,  // or : false
            pauseOnHover: false,  // or : false
            touchSupport: false  // or : false
        });
    // options
    var width = 0,
        x = 0.14;
        
    // start
    bigiUpdate();

    function bigiUpdate(){
        setInterval(function(){ 
            width = width + x;
            if(width < 100){
                jQuery('.matrix_wolfloader .layer').css("width", width + "%");
            }
        }, 10);

    }
    function bigikUpdate(){
        width = 0
    }
</script>
            <?php 
			return ob_get_clean();
		}

	}

}

add_shortcode('electro_vc_product_onsale', array("matrix_wolfrealtime", 'offers'));