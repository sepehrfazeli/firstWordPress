<?php
wp_enqueue_style('dashicons');
$menus = wp_get_nav_menu_items(get_term(get_nav_menu_locations()['main'], 'nav_menu')->name, array('meta_key' => '_menu_item_menu_item_parent', 'meta_value' => '0'));
global $bigikala_options;
?>
<div class="bk_menu<?php if( $bigikala_options['menu_type'] == 'type1' ) { echo ' type1'; }elseif($bigikala_options['menu_type'] == 'type2'){ echo ' bk_new_menu'; }elseif($bigikala_options['menu_type'] == 'type3'){ echo ' bk_vertical_menu'; } if( isset($bigikala_options['menu_level']) && $bigikala_options['menu_level'] == 'four' ) { echo ' level';} ?>" >
	<div class="bigi">
        <?php if($menus) : ?>
		<ul>
			<?php foreach($menus as $menu) :
			    $all_items_url = $menu->url;
			    $all_items_title = $menu->title;
           ?>
				<li>
					<span class="title">
					    <a href="<?php echo $menu->url;?>" 
					        <?php if($menu->target) echo 'target="' . $menu->target . '" '; ?>
					        <?php if(implode($menu->classes, ' ')) echo 'class="' . implode($menu->classes, ' ') . '" '; ?>
					        <?php if($menu->xfn) echo 'rel="' . $menu->xfn . '" '; ?>
					        <?php if($menu->attr_title) echo 'title="' . $menu->attr_title . '" '; ?>
					    >
					        <?php echo $menu->title;?>
					    </a>
					</span>
					<span class="arrow dashicons dashicons-arrow-down-alt2"></span>
                    <?php if($menus = wp_get_nav_menu_items(get_term(get_nav_menu_locations()['main'], 'nav_menu')->name, array('meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $menu->ID))):?>
                    <?php if( isset($bigikala_options['menu_level']) && $bigikala_options['menu_level'] == 'four' ) { ?>
                        <ul class="level">
                            <?php foreach($menus as $menu) : ?>
                                <li>
                                    <span class="title2">
                                        <a href="<?php echo $menu->url;?>" 
                                          <?php if($menu->target) echo 'target="' . $menu->target . '" '; ?>
					                      <?php if(implode($menu->classes, ' ')) echo 'class="' . implode($menu->classes, ' ') . '" '; ?>
					                      <?php if($menu->xfn) echo 'rel="' . $menu->xfn . '" '; ?>
					                      <?php if($menu->attr_title) echo 'title="' . $menu->attr_title . '" '; ?>
					                    >
                                            <?php echo $menu->title;?>
                                        </a>
                                    </span>
	                                <?php if($menus = wp_get_nav_menu_items(get_term(get_nav_menu_locations()['main'], 'nav_menu')->name, array('meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $menu->ID))):?>
                                        <div class="submenu">
                                            <ul>
                                                <?php 
                                                    $menu_image = get_post_meta($menu->ID,'_menu_item_menuimage',true);
                                                ?>
                                                
                                                <?php foreach($menus as $menu) : ?>
                                                    <li class="title">
                                                        <span class="title3">
                                                        <a href="<?php echo $menu->url;?>" 
                                                        <?php if($menu->target) echo 'target="' . $menu->target . '" '; ?>
					                                    <?php if(implode($menu->classes, ' ')) echo 'class="' . implode($menu->classes, ' ') . '" '; ?>
					                                    <?php if($menu->xfn) echo 'rel="' . $menu->xfn . '" '; ?>
					                                    <?php if($menu->attr_title) echo 'title="' . $menu->attr_title . '" '; ?>>
                                                            <?php echo $menu->title;?>
                                                        </a>
                                                        </span>
                                                    </li>
                                                    <?php if($menus = wp_get_nav_menu_items(get_term(get_nav_menu_locations()['main'], 'nav_menu')->name, array('meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $menu->ID))):?>
                                                        <?php foreach($menus as $menu) : ?>
                                                        <li class="item">
                                                            <a href="<?php echo $menu->url;?>" 
                                                            <?php if($menu->target) echo 'target="' . $menu->target . '" '; ?>
					                                        <?php if(implode($menu->classes, ' ')) echo 'class="' . implode($menu->classes, ' ') . '" '; ?>
					                                        <?php if($menu->xfn) echo 'rel="' . $menu->xfn . '" '; ?>
					                                        <?php if($menu->attr_title) echo 'title="' . $menu->attr_title . '" '; ?>
                                                            >
                                                                <?php echo $menu->title;?>
                                                            </a>
                                                        </li>
                                                        <?php endforeach;?>
                                                    <?php endif;?>
                                                <?php endforeach;?>
                                            </ul>
                                            <div class="bk_image"<?php if($menu_image){?> style="background-image:url('<?php echo $menu_image; ?>');" <?php } ?>></div>
											<div class="lines">
                                                <div class="line"></div>
                                                <div class="line"></div>
                                                <div class="line"></div>
                                                <div class="line"></div>
                                            </div>
                                        </div>
                                    <?php endif;?>
                                </li>
                            <?php endforeach;?>
                        </ul>
                    <?php }else{ ?>
                            <?php 
                                $menu_image = get_post_meta($menu->ID,'_menu_item_menuimage',true);
                            ?>
                        <ul class="level">
                            <?php foreach($menus as $menu) : ?>
                                <ul class="submenu" >
                                <li class="title">
                                    <span class="title3">
                                        <a href="<?php echo $menu->url;?>" 
                                        <?php if($menu->target) echo 'target="' . $menu->target . '" '; ?>
					                    <?php if(implode($menu->classes, ' ')) echo 'class="' . implode($menu->classes, ' ') . '" '; ?>
					                    <?php if($menu->xfn) echo 'rel="' . $menu->xfn . '" '; ?>
					                    <?php if($menu->attr_title) echo 'title="' . $menu->attr_title . '" '; ?>
                                        >
                                            <?php echo $menu->title;?>
                                        </a>
                                    </span>
                                </li>
                                <?php if($menus = wp_get_nav_menu_items(get_term(get_nav_menu_locations()['main'], 'nav_menu')->name, array('meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $menu->ID))):?>
                                    <?php foreach($menus as $menu) : ?>
                                    <li class="item">
                                        <a href="<?php echo $menu->url;?>" 
                                        <?php if($menu->target) echo 'target="' . $menu->target . '" '; ?>
					                    <?php if(implode($menu->classes, ' ')) echo 'class="' . implode($menu->classes, ' ') . '" '; ?>
					                    <?php if($menu->xfn) echo 'rel="' . $menu->xfn . '" '; ?>
					                    <?php if($menu->attr_title) echo 'title="' . $menu->attr_title . '" '; ?>
                                        >
                                            <?php echo $menu->title;?>
                                        </a>
                                    </li>
                                    <?php endforeach;?>
                                <?php endif;?>
                                </ul>
                            <?php endforeach;?>
                        <div class="bk_image bk_menu_image"<?php if($menu_image){?> style="background-image:url('<?php echo $menu_image; ?>');" <?php } ?>></div>
						<div class="lines">
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                        </div>
                        <a class="all-items-link" href="<?php echo $all_items_url;?>"><?php echo __('All categories of ','bigikala').$all_items_title;?></a>
                        </ul>
                    <?php } endif;?>
				</li>
			<?php endforeach;?>
		</ul>
        <?php endif;?>
	</div>

</div>


<?php 
global $bigikala_options;

if(isset($bigikala_options['sticky_header']) && $bigikala_options['sticky_header'] == true ){
    ?>
    <script>
        jQuery(document).ready(function(){
            var menuStickyTop = jQuery('.navbar-primary').offset().top;
            
            jQuery(window).scroll(function(){
               
               var menu_sticky = jQuery('.navbar-primary');
               
               if(window.pageYOffset > menuStickyTop){
                   menu_sticky.addClass('fixed');
               } else{
                   menu_sticky.removeClass('fixed');
               }
            });
        })
    </script>
    <?php
}

?>
