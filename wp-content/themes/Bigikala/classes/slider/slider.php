<?php 

if(!defined("ABSPATH")) { die(); }

function bigikala_slider_shortcode_handle(){
    
    // use bigikala options
    global $bigikala_options;
    ob_start();
    ?>
    
    <div id="wrapper">
        <div id="slider">
            <ul>
                <?php if(!empty($bigikala_options['homepage-slides'])) : foreach($bigikala_options['homepage-slides'] as $slide) : ?>
                <li><a href="<?php echo $slide['url']; ?>" title="<?php echo $slide['title'] ?>"><img alt="<?php echo $slide['title'] ?>" class="slider-img" src="<?php echo $slide['image']; ?>"/></a></li>
                <?php endforeach; endif;?>
            </ul>
            
        </div>
    </div>
    
    <script>
        <?php if(!empty($bigikala_options['slider-height'])) { echo 'var height = '.$bigikala_options['slider-height'].';' ;} ?>
        <?php if(!empty($bigikala_options['slider-width'])) { echo 'var width = '.$bigikala_options['slider-width'].';' ;} ?>
        var ratio = height/width;
        var slider_width = jQuery('#slider').width();
        var slider_height = slider_width * ratio;
        jQuery('#slider').css( 'height' , slider_height);
     	jQuery('img').loadImages({
    			template : "<div class='box loading'>    "+"</div>",
    			//add your own loading template
    			callback : function(){
    				console.log("some image loaded !") //callback when some image loaded
    	  		}
    		});
        jQuery('#slider').djSlider({
            navigationSupport: true,  // or : false
            slideTime: 5000,  //ms
            speed: 500,  // ms
            autoSlide_outAnimation: 'fade',  // or : swipeRight , swipeLeft , fade
            autoSlide_inAnimation: 'fade',  // or : swipeRight , swipeLeft , fade
            swipeRight_outAnimation: 'swipeRight',  // or : swipeRight , swipeLeft , fade
            swipeRight_inAnimation: 'swipeRight',  // or : swipeRight , swipeLeft , fade
            swipeLeft_outAnimation: 'swipeLeft',  // or : swipeRight , swipeLeft , fade
            swipeLeft_inAnimation: 'swipeLeft',  // or : swipeRight , swipeLeft , fade
            nextBtn_outAnimation: 'fade',  // or : swipeRight , swipeLeft , fade
            nextBtn_inAnimation: 'fade',  // or : swipeRight , swipeLeft , fade
            prevBtn_outAnimation: 'fade',  // or : swipeRight , swipeLeft , fade
            prevBtn_inAnimation: 'fade',  // or : swipeRight , swipeLeft , fade
            nextItemCaption_outAnimation: 'fade',  // or : swipeRight , swipeLeft , fade
            nextItemCaption_inAnimation: 'fade',  // or : swipeRight , swipeLeft , fade
            prevItemCaption_outAnimation: 'fade',  // or : swipeRight , swipeLeft , fade
            prevItemCaption_inAnimation: 'fade',  // or : swipeRight , swipeLeft , fade
            captionSupport: true,  // or : false
            autoSlide: true,  // or : false
            pauseOnHover: false,  // or : false
            touchSupport: true  // or : false
        })
    </script>
    <?php
    
    
    return ob_get_clean();
}

add_shortcode('djks', 'bigikala_slider_shortcode_handle');
?>