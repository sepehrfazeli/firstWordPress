<?php

global $bigikala_options;

?>

</div><!-- #content -->



<?php if ( isset($bigikala_options['footerproducts']) && $bigikala_options['footerproducts'] && class_exists( 'WooCommerce' ) ) { matrix_wolfviewed_products(); } ?>
<?php if(isset($bigikala_options['scrollup']) && $bigikala_options['scrollup'] == true) : ?>
<a href="#" id="scrollUp">
	<div class="c-footer__jumpup"><span id="js-jump-to-top" class="c-footer__jumpup-container"><span class="c-footer__jumpup-angle"></span>
                 <?php echo _e('Back to Top','bigikala');?>
                </span></div>
</a>
<?php endif; ?>
<footer class="footer-section">
    <div class="container-bigikala">
		
		<?php if ( isset($bigikala_options['footersubscribe']) && $bigikala_options['footersubscribe'] ) { ?>
		<div class="row footer-newsletter">
			<div class="container-bigikala">
				<div class="container-bigikala footer-div">
				    <div class="footer-svg"> <nav class="c-footer__feature-innerbox">
        <?php if ($bigikala_options['switch_Express_Shipping'] == true ){ ?>
            <a class="c-footer__badge" href="<?php if ( isset($bigikala_options['Express_Shipping']) && $bigikala_options['Express_Shipping'] ) { echo get_permalink($bigikala_options['Express_Shipping']); } ?>" target="_blank">
                <div class="c-footer__feature-item c-footer__feature-item--1" <?php if($bigikala_options['img_Express_Shipping']['url'] !=''){ echo 'style="background-image:url('.$bigikala_options['img_Express_Shipping']['url'].')"';} ?>>
                    <?php echo $bigikala_options['text_Express_Shipping'];?>
                </div>
            </a>
        <?php } ?>
        <?php if ($bigikala_options['switch_24_Hours_Support'] == true ){ ?>
            <a class="c-footer__badge" href="<?php if ( isset($bigikala_options['24_Hours_Support']) && $bigikala_options['24_Hours_Support'] ) { echo get_permalink($bigikala_options['24_Hours_Support']); } ?>" target="_blank">
                <div class="c-footer__feature-item c-footer__feature-item--3" <?php if($bigikala_options['img_24_Hours_Support']['url'] !=''){ echo 'style="background-image:url('.$bigikala_options['img_24_Hours_Support']['url'].')"';} ?>>
                    <?php echo $bigikala_options['text_24_Hours_Support'];?>
                </div>
            </a>
        <?php } ?>
        <?php if ($bigikala_options['switch_Payment_at_the_place'] == true ){ ?>
            <a class="c-footer__badge" href="<?php if ( isset($bigikala_options['Payment_at_the_place']) && $bigikala_options['Payment_at_the_place'] ) { echo get_permalink($bigikala_options['Payment_at_the_place']); } ?>" target="_blank">
                <div class="c-footer__feature-item c-footer__feature-item--4" <?php if($bigikala_options['img_Payment_at_the_place']['url'] !=''){ echo 'style="background-image:url('.$bigikala_options['img_Payment_at_the_place']['url'].')"';} ?>>
                    <?php echo $bigikala_options['text_Payment_at_the_place'];?>
                </div>
            </a>
        <?php } ?>
        <?php if ($bigikala_options['switch_back_guarantee'] == true ){ ?>
            <a class="c-footer__badge" href="<?php if ( isset($bigikala_options['back_guarantee']) && $bigikala_options['back_guarantee'] ) { echo get_permalink($bigikala_options['back_guarantee']); } ?>" target="_blank">
                <div class="c-footer__feature-item c-footer__feature-item--5" <?php if($bigikala_options['img_back_guarantee']['url'] !=''){ echo 'style="background-image:url('.$bigikala_options['img_back_guarantee']['url'].')"';} ?>>
                    <?php echo $bigikala_options['text_back_guarantee'];?>
                </div>
            </a>
        <?php } ?>
        <?php if ($bigikala_options['switch_Guarantee_of_Origin'] == true ){ ?>
            <a class="c-footer__badge" href="<?php if ( isset($bigikala_options['Guarantee_of_Origin']) && $bigikala_options['Guarantee_of_Origin'] ) { echo get_permalink($bigikala_options['Guarantee_of_Origin']); } ?>" target="_blank">
                <div class="c-footer__feature-item c-footer__feature-item--6" <?php if($bigikala_options['img_Guarantee_of_Origin']['url'] !=''){ echo 'style="background-image:url('.$bigikala_options['img_Guarantee_of_Origin']['url'].')"';} ?>>
                    <?php echo $bigikala_options['text_Guarantee_of_Origin'];?>
                </div>
            </a>
        <?php } ?>
	</nav>
</div>	
				    
				    <div class="col-md-9 no-padding">
						<div class="row col-md-4">
							<?php if ( is_active_sidebar( 'subscribe-col-1' ) ) { dynamic_sidebar( 'subscribe-col-1' ); } ?>
						</div>
						<div class="row col-md-4">
							<?php if ( is_active_sidebar( 'subscribe-col-2' ) ) { dynamic_sidebar( 'subscribe-col-2' ); } ?>
						</div>
						<div class="row col-md-4">
							<?php if ( is_active_sidebar( 'subscribe-col-3' ) ) { dynamic_sidebar( 'subscribe-col-3' ); } ?>
						</div>
					</div>
					<div class="col-md-3 no-padding">
						<div class="subscribe-form-div">
							<div class="widget-title"><?php echo $bigikala_options['footer_newsletter_title'];?></div>
							<div id="subscribe-form">
								<?php echo do_shortcode($bigikala_options["footer_newsletter_marketing_text"]); ?>
							</div>
						</div>
						<div class="subscribe-social">
							<div class="col-md-5 no-padding">
								<ul class="socials">
								<?php if ( isset($bigikala_options['facebook']) && $bigikala_options['facebook'] ) { ?>
									<li>
										<a target="_blank" href="<?php echo $bigikala_options['facebook']; ?>"><i class="icon icon-footer-facebook"></i></a>
									</li>
								<?php } ?>
								<?php if ( isset($bigikala_options['twitter']) && $bigikala_options['twitter'] ) { ?>
									<li>
										<a target="_blank" href="<?php echo $bigikala_options['twitter']; ?>"><i class="icon icon-footer-twitter"></i></a>
									</li>
								<?php } ?>
								<?php if ( isset($bigikala_options['googleplus']) && $bigikala_options['googleplus'] ) { ?>
									<li>
										<a target="_blank" href="<?php echo $bigikala_options['googleplus']; ?>"><i class="icon icon-footer-googleplus"></i></a>
									</li>
								<?php } ?>
								<?php if ( isset($bigikala_options['instagram']) && $bigikala_options['instagram'] ) { ?>
									<li>
										<a target="_blank" href="<?php echo $bigikala_options['instagram']; ?>"><i class="icon icon-footer-instagram"></i></a>
									</li>
								<?php } ?>
								<?php if ( isset($bigikala_options['youtube']) && $bigikala_options['youtube'] ) { ?>
									<li>
										<a target="_blank" href="<?php echo $bigikala_options['youtube']; ?>"><i class="icon icon-footer-aparat"></i></a>
									</li>
								<?php } ?>
								<?php if ( isset($bigikala_options['vimeo']) && $bigikala_options['vimeo'] ) { ?>
									<li>
										<a target="_blank" href="<?php echo $bigikala_options['vimeo']; ?>"><i class="icon icon-footer-telegram"></i></a>
									</li>
								<?php } ?>
								</ul>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
		
  		<?php if ( isset($bigikala_options['footerinfobar']) && $bigikala_options['footerinfobar'] ) { ?>
        <div class="row footerinfobar">
			<div class="container-bigikala">
				<div class="container-bigikala footer-div">
					<?php if ( isset($bigikala_options['footerinfobar_slogan']) && $bigikala_options['footerinfobar_slogan'] ) { ?>
						<p class="infobar-slogan"><?php echo $bigikala_options['footerinfobar_slogan'];?></p>
					<?php } ?>
					<ul>
						<?php if ( isset($bigikala_options['footerinfobar_email']) && $bigikala_options['footerinfobar_email'] ) { ?>
						<li><i class="icon icon-info-message"></i><span><?php _e('Email: ','bigikala'); ?></span><a><?php echo $bigikala_options['footerinfobar_email'];?></a></li>
						<?php } ?>
						<?php if ( isset($bigikala_options['footerinfobar_faq']) && $bigikala_options['footerinfobar_faq'] ) { ?>
						<li><i class="icon icon-info-faq"></i><a href="<?php echo get_permalink($bigikala_options['footerinfobar_faq_p']); ?>"><?php echo $bigikala_options['footerinfobar_faq'];?></a></li>
						<?php } ?>
						<?php if ( isset($bigikala_options['footerinfobar_phone']) && $bigikala_options['footerinfobar_phone'] ) { ?>
						<li><i class="icon icon-info-tell"></i><span><?php _e('Phone: ','bigikala'); ?></span><a href="<?php echo get_permalink($bigikala_options['footerinfobar_phone_p']); ?>"><?php echo $bigikala_options['footerinfobar_phone'];?></a></li>
						<?php } ?>
					</ul>
					<ul class="apps">
					    <?php if ( isset($bigikala_options['vine']) && $bigikala_options['vine'] ) { ?>
							<li>
								<a target="_blank" href="<?php echo $bigikala_options['vine']; ?>" class="ios-icon"></a>
							</li>
						<?php } ?>
						<?php if ( isset($bigikala_options['soundcloud']) && $bigikala_options['soundcloud'] ) { ?>
							<li>
								<a target="_blank" href="<?php echo $bigikala_options['soundcloud']; ?>" class="android-icon"></a>
							</li>
						<?php } ?>
						<?php if ( isset($bigikala_options['google_play']) && $bigikala_options['google_play'] ) { ?>
							<li>
								<a target="_blank" href="<?php echo $bigikala_options['google_play']; ?>" class="google_play-icon"></a>
							</li>
						<?php } ?>
					</ul>
				</div>
			</div>
        </div>
		<?php } ?>
		
		<?php if ( isset($bigikala_options['footermenu']) && $bigikala_options['footermenu'] && class_exists( 'WooCommerce' ) ) { ?>
		<div class="row footer-bottom-widgets">
			<div class="container-bigikala">
				<div class="container-bigikala footer-div">
					<div class="row">
						<?php
						for ( $i=1; $i<=6; $i++ ) {
							$optionname = 'footermenu_cat'.$i;
							if ( isset($bigikala_options[$optionname]) && $bigikala_options[$optionname] ) { 
							$cat = get_term ($bigikala_options[$optionname], 'product_cat' ); 
							if($cat): ?>
								<div class="col-md-2">
									<div class="widget-title">
										<a href="<?php echo get_term_link( $cat ); ?>"><?php echo $cat->name;?></a>
									</div>
									<ul>
									<?php 
										$childs = get_term_children( $cat->term_id, 'product_cat' );
										foreach ( $childs as $child ) {
											$getchild	= get_term ($child, 'product_cat' );
											$childpar	= $getchild->parent;
											if ( $childpar == $cat->term_id ) {
												echo '<li><a href="'. get_term_link( $getchild ) .'">'. $getchild->name .'</a></li>';
											}
										}
									?>
									</ul>
								</div>
							<?php endif; 
						    }
						} 
						
						?>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
		

		<?php 
		$display = true;
		if ( !is_front_page() ) {
			if ( isset($bigikala_options['footer-home']) && $bigikala_options['footer-home'] ) {
				$display = false;
			}
		}
		if ( $display ) {
		?>
		<div class="row about-bar">
			<div class="container-bigikala">
				<div class="container-bigikala footer-div">
					<div class="col-md-9 no-padding footer_description">
						<?php if ( isset($bigikala_options['footer_credit'])  ) { 
						    echo '<div class="footer_description_inner">';
						    echo $bigikala_options['footer_credit']; 
						    echo '</div>';
						    echo '<span class="footer_more" data-less="'.__('Less','bigikala').'" data-more="'.__('More','bigikala').'">'.__('More','bigikala').'</span>';
						} ?>
					</div>
					<div class="col-md-3 no-padding">
						<?php if ( isset($bigikala_options['footer_credit_left_html']) ) { echo $bigikala_options['footer_credit_left_html']; } ?>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
		
		<div class="row copyright-bar">
			<div class="container-bigikala">
				<div class="container-bigikala footer-div">
					<?php
					wp_nav_menu( array(
						'theme_location'	=> 'footer',
						'container_class'	=> '',
						'menu_class'		=> '',
					) );
					?>
					
					<div class="copyright-bar-text">
						<div class="no-padding section-one">
							<span><?php if ( isset($bigikala_options['copyright-one']) && $bigikala_options['copyright-one'] ) { echo $bigikala_options['copyright-one']; } ?></span>
						</div>
						<div class="no-padding section-two">
							<span><?php if ( isset($bigikala_options['copyright-two']) && $bigikala_options['copyright-two'] ) { echo $bigikala_options['copyright-two']; } ?></span>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</footer>

<?php wp_footer(); ?>
<?php if(!empty($bigikala_options['custom_js'])){ echo '<script>'.$bigikala_options['custom_js'].' </script>'; } ?>
	</body>
</html>