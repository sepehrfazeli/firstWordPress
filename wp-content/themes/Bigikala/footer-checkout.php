<?php

global $bigikala_options;

?>

</div><!-- #content -->

<footer class="footer-section checkout-footer">
  	<?php if ( isset($bigikala_options['footerinfobar']) && $bigikala_options['footerinfobar'] ) { ?>
        <div class="row footerinfobar">
			<div class="container-bigikala">
				<div class="container-bigikala footer-div">
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
					<div class="copun-notice">
					    <?php _e('It is possible to use the gift card or discount code on the payment page.','bigikala'); ?>
					</div>
					<div class="no-padding section-two">
						<span><?php if ( isset($bigikala_options['copyright-two']) && $bigikala_options['copyright-two'] ) { echo $bigikala_options['copyright-two']; } ?></span>
					</div>
				</div>
			</div>
        </div>
	<?php } ?>
</footer>

<?php wp_footer(); ?>
<?php if(!empty($bigikala_options['custom_js'])){ echo '<script>'.$bigikala_options['custom_js'].' </script>'; } ?>
	</body>
</html>