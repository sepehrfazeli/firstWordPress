<?php
/**
 * Description tab
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/description.php.
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
	exit; // Exit if accessed directly
}

global $post, $bigikala_options;
$short_desc = apply_filters( 'woocommerce_short_description', $post->post_excerpt );
?>
<?php if($short_desc && $bigikala_options['show_shortdesc'] == true ): ?>
<div class="col-md-12 short-description">
	<h2 class="product_seo_title">
		<span><?php echo _e( 'Product Short Description', 'bigikala' ); ?></span>
		<?php echo $post->post_title; ?>
	</h2>
	<div class="innerContent">
		<?php echo $short_desc; ?>
	</div>
	
</div>
<?php endif; ?>

<?php if(isset($bigikala_options['adv_disadv_admin']) && $bigikala_options['adv_disadv_admin'] == true){ 
    echo '<div class="row">';
    
    $admin_rates = get_post_meta($post->ID, 'admin_rates', true);
    echo '<div class="col-sm-12 col-md-6">';
    if($admin_rates){
        echo '<div class="review-summary">';
        foreach ( $admin_rates as $admin_rate) {
			if ( isset($admin_rate['title']) ) { 
 		        switch($admin_rate['value']){
 		            case 1 :
 		                $value_text = __('Very bad','bigikala');
 		                break;
 		            case 2 :
 		                $value_text = __('Bad','bigikala');
 		                break;
 		            case 3 :
 		                $value_text = __('Mediocre','bigikala');
 		                break;
 		            case 4 :
 		                $value_text = __('Good','bigikala');
 		                break;
 		            case 5 :
 		                $value_text = __('Very good','bigikala');
 		                break;
 		            default :
 		                $value_text = '';
 		         }
 		        if(!$admin_rate['value']) $admin_rate['value'] = 3;
			    $percent = ($admin_rate['value']/5)*100; ?>
			    <div class="rate-item">
                    <span class="rate-title"><?php echo $admin_rate['title']; ?></span> 
                    <div class="rate-value">
                        <span class="gray-ratebar"></span>
                        <span class="blue-ratebar" style="width:<?php echo $percent.'%'; ?>" data-value="<?php echo $percent; ?>"></span>
                    </div>
                    <span class="rate-value-text"><?php echo $value_text; ?></span>
                </div>
			<?php }
        }
        echo '</div>';
    }
    echo '</div>';
    
    $advs = get_post_meta( $post->ID, 'advantages_metas', true ); 
    $disadvs = get_post_meta( $post->ID, 'disadvantages_metas', true ); 
    echo '<div class="admin-advantages col-md-6">';
    if($advs){
        echo '<div class="advantages">';
        echo '<span>'.__("Advantages","bigikala").'</span>';
        echo '<ul>';
        foreach($advs as $adv){
            echo '<li>'.$adv.'</li>';
        }
        echo '</ul>';
        echo '</div>';
    }
    if($disadvs){
        echo '<div class="disadvantages">';
        echo '<span>'.__("Disdvantages","bigikala").'</span>';
        echo '<ul>';
        foreach($disadvs as $disadv){
            echo '<li>'.$disadv.'</li>';
        }
        echo '</ul>';
        echo '</div>';
    }
    echo '</div>';
echo '</div>';
 } ?>
<?php the_content(); ?>
