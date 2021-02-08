<?php

function youone_style_body_class($classes) {
    global $bigikala_options;
    if(isset($bigikala_options['main_color']) && !empty($bigikala_options['main_color'])){
        $class = $bigikala_options['main_color'];
    }else{
        $class = 'main-color';
    }
    $classes[] = $class;
    return $classes;
}

add_filter('body_class', 'youone_style_body_class');

function youone_front_styles_method() {
    global $bigikala_options;
    $css = '';
    if(isset($bigikala_options['body_bg_color']) && !empty($bigikala_options['body_bg_color'])){
        $css .= ".matrix_wolfbody { background-color : ".$bigikala_options['body_bg_color']." }";
    }
    if(isset($bigikala_options['body_bg_image']) && !empty($bigikala_options['body_bg_image']['url'])){
        $css .= ".matrix_wolfbody { background-image : url('".$bigikala_options['body_bg_image']['url']."') !important;  }";
    }
    if(isset($bigikala_options['accent_color1']) && !empty($bigikala_options['accent_color1'])){
        $css .= ".dk-button-container.full,.rememberpassword .dk-button-container .dk-button.blue,.woocommerce a.button, .woocommerce a.button:hover {
            background-color : ".$bigikala_options['accent_color1']." !important; border-color : ".$bigikala_options['accent_color1'].";}";
    }
    if(isset($bigikala_options['accent_color1']) && !empty($bigikala_options['accent_color1'])){
        $css .= "a.dokan-btn-theme, .c-profile-box__header, .header .cart-box.fill .dk-button-container .dk-button, .header .cart-box.fill .dk-button-container,
        .matrix_wolfspecial-offers-homepage-page a, .products__item-compare-txt.checked::before,.compare__toggle-handler,
        .footer-newsletter input[type=submit],.custom_order_by_sort.selected, .woocommerce button.button, .woocommerce button.button:hover,
        .woocommerce .widget_price_filter .ui-slider .ui-slider-range,.compare__button--compare, .btn.product-dle-btn,.woocommerce button.button,
        .woocommerce button.button:hover, .products-tabs ul.tabs.wc-tabs li.active[role=tab]::before, span.blue-ratebar, .form-submit .submit ,
        .header .cart-box.fill .dk-button-container, .c-navi-list__basket-submit:hover,.c-navi-list__basket-submit, .widget_price_filter .price_slider_amount .button,
        .dk-button-container .dk-button .dk-button-label, .products-box.listing .loop-saving-percentage,
        .c-remodal-loader__bullet,.wms-checkout-button, .wms-proceed-buttons .next, .checkout-products .product_count, input.input-radio:checked + span.newlabel::before,
        input[type=checkbox]:checked + span.required.fill::before,.wms-progress-bar .retrangle .step.active i, .wms-progress-bar .retrangle .step.active i::before,
        #night_mode_switcher .dk-switch-enabled,.container-bigikala.main-menu-div .dk-switch-container,.edit-info,.woocommerce-Button.button,
        .available_widget .woocommerce-widget-layered-nav-list__item--chosen a::before, .cart-box .cart-items-count,
        .woocommerce .woocommerce-widget-layered-nav-list .woocommerce-widget-layered-nav-list__item--chosen a::before,.activeItem,.captionItem:hover,
        .c-header__user-dropdown-login,.dk-button .dk-button-container .dk-button .dk-button-label,.form-submit input#submit,.comment-reply-link,
        .main-wp-post-image .cat_of_post,.loop-add-to-cart a.button.product_type_simple.add_to_cart_button.ajax_add_to_cart,
        .woocommerce nav.woocommerce-pagination ul li span.current,.rememberpassword .dk-button-container .dk-button.blue,
        .dk-button-container .dk-button, .dk-button-container .dk-button i.dk-button-icon,input.c-ui-radio__check:checked + span.c-ui-radio__check::before,
        .order-again a.button, .order-again a.button:hover, .woocommerce a.button.alt, .woocommerce a.button.alt:hover,.loop-saving-percentage,
        .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,a.return,
        #bigikala_login .dk-button-container .dk-button.blue,.radio-control input[type=radio]:checked + label,.bigi-tabs li a.active::after,
        a.woocommerce-button.woocommerce-button--next.woocommerce-Button.woocommerce-Button--next.button,.section-products-carousel .loop-saving-percentage,
        .ckeckbox-control input[type=checkbox]:checked + label,.available_widget .woocommerce-widget-layered-nav-list__item:hover::before,
        .woocommerce .woocommerce-widget-layered-nav-list .woocommerce-widget-layered-nav-list__item:hover::before,.wishlist-item .btn.btn-blue.woocommerce-Button.button,
        .woocommerce a.button, .woocommerce a.button:hover, a.button.product_type_external, a.button.product_type_simple,
        #feedback_submit { background-color : ".$bigikala_options['accent_color1']."; border-color : ".$bigikala_options['accent_color1'].";}";
        
        $css .= ".header .cart-box.fill .cart-items-count,.cart-discount th,.cart-discount td.final,.cart-discount .final,
        .wms-progress-bar .retrangle .step.active span,.chosen_shipping_method,.smart-similar-products h3,.shipping_method_box[checked=checked], .label.shipping_method_box[checked=checked],
        .bk_menu.bk_new_menu .submenu .title a::before,.bk_menu.bk_new_menu .submenu .title a,#night_mode_switcher .dk-switch-disabled::before,
        #night_mode_switcher .dk-switch-disabled::before,a.all-items-link::before,a.all-items-link,a.all-items-link:hover,
        .section-products-carousel header .boxmore a,.icon-blue-plus::before,
        .woocommerce-MyAccount-navbar-primary ul li.is-active a,li.woocommerce-MyAccount-navigation-link.is-active::before,.woocommerce-MyAccount-navbar-primary ul li a:hover,
        .woocommerce-MyAccount-navbar-primary ul li.is-active a,.address_list .address_item .control-btn td.edit i::before,
        .available_widget .woocommerce-widget-layered-nav-list__item a:hover,.woocommerce .woocommerce-widget-layered-nav-list,.woocommerce-widget-layered-nav-list__item a:hover,
        .post-body a:link, .post-body a:link:hover,.c-seller__info.ready,.shipping_method_box[checked=checked] .label,.shipping_method_box[checked=checked] .dashicons-awards::before,
        .shipping_method_box[checked=checked] .price b,
        .header .dk-button-container.hasIcon .dk-button-label,.captionItem,
        .archive-header .media-header__follow-btn,.bk_menu.bk_new_menu .submenu .title a:hover,.captionItem,
        a.all-items-link:hover ,.ship::before,.cart-discount td.final span.woocommerce-Price-amount.amount,.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
        .widget_price_filter .ui-slider .ui-slider-handle::before, .widget_price_filter .ui-slider .ui-slider-handle:last-child::before,
        .c-header__user-dropdown-sign-up a,span.sku,.seller-v,.dk-product-meta span a, .readmore a, .readmore a:hover,#vendors-count-link,#more-link,
        .show-more-seller,.vendors-table-col--sellerTitle a,.vendors-rate, .vendors-table-col--shipping,.report-button-container .edit-info,
        .report-button-container .change-address,.report-button-container .change-address::before,.report-button-container .edit-info::before,
        span.comment-rules a,.return-to-product a,.wms-thanks-description .thank,.bottom-box .qus a,#bigikala_login .forget,#bigikala_login .footer .register a,
        .userform .form-group .agreement > label a,.auth__nav a,.bigi-tabs li a.active,.bk_menu.bk_new_menu .bigi > ul > li > ul.level h3 a,
        .bk_menu.bk_new_menu .bigi > ul > li > ul.level h3 a:hover,#bigikala_product_notify .modal-header .close-icon:hover::before,
        #bigikala_login .modal-header .close-icon:hover::before, #bigikala_price_change .modal-header .close-icon:hover::before, 
        #bigikala_product_video .modal-header .close-icon:hover::before, .wishlistpopup .modal-header .close-icon:hover::before, #modal-video-gallery .close-icon:hover::before,
        li.woocommerce-MyAccount-navigation-link:hover::before,.c-navi-list__basket-link,.c-navi-list__basket-link:hover,.product-info-box .seller-performance span,
        .vendors-table .vendor-button,.product-info-box #vendors-count-link span.view,.vendors-table-row.vendors-table-row--highlight .vendors-table-col--sellerTitle a::after,
        .post-body a:link, .post-body a:link:hover, .post-body a:link:focus, .short-description a:link, .short-description a:link:hover, .short-description a:link:focus,
        .wpb_text_column a:link, .wpb_text_column a:link:hover, .wpb_text_column a:link:focus,.product-list-table td a,.woocommerce nav.woocommerce-pagination ul li a:hover,
        .available_widget .woocommerce-widget-layered-nav-list__item a, .woocommerce .woocommerce-widget-layered-nav-list .woocommerce-widget-layered-nav-list__item a:hover,
        #avatarModal .close-icon:hover::before,.close-icon:hover::before,.woocommerce .star-rating span,.bk_menu.bk_vertical_menu.level .bigi > ul > li > ul.level > li > .title2 a:hover::before,
        .bk_menu.bk_vertical_menu.level .bigi > ul > li:hover > ul.level > li:hover > .title2:hover a
        { color : ".$bigikala_options['accent_color1'].";}";
        
        $css .= ".captionItem.activeItem, .captionItem:hover
        { color : ".$bigikala_options['accent_color1']." !important; background-color : ".$bigikala_options['accent_color1']." !important;}";
        
        $css .= ".c-header__user-dropdown-sign-up a, .c-header__user-dropdown-login
        { color : ".$bigikala_options['accent_color1']." !important;}";
        
        $css .= ".go_checkout .wms-checkout-button,.go_checkout .wms-checkout-button:hover,.wms-proceed-buttons.youone-proceed-btns .prev,
        .wms-proceed-buttons.youone-proceed-btns .next,.wms-progress-bar .retrangle .step.active span,.wms-proceed-buttons.youone-proceed-btns .prev a,
        .wms-proceed-buttons.youone-proceed-btns .prev a:hover,a.edit-wishlist::before,a.edit-wishlist, #total_rate,.bk_menu .bigi > ul > li:hover > ul.level > li:hover > .title2,
        .woocommerce-orders-table__cell.woocommerce-orders-table__cell-order-number a,.gallery-thumbs .swiper-slide-active
        { color : ".$bigikala_options['accent_color1']." !important;border-color : ".$bigikala_options['accent_color1']." !important;}";
        
        $css .= " .woocommerce button.button, .woocommerce button.button:hover,a.c-navi-list__basket-submit,.woocommerce div.product form.cart .button,
        .product-info-box .dk-button-discount,.rslider-handle, .profile-info-img.dummy-image,#dokan-content .bigi-tabs li a.active::before
        { background-color : ".$bigikala_options['accent_color1']." !important;}";
        
        $css .= ".wms-progress-bar .retrangle .step.active i, .wms-progress-bar .retrangle .step.active i::before,.dokan-pagination-container .dokan-pagination li.active a
        { background-color : ".$bigikala_options['accent_color1']." !important; border-color:".$bigikala_options['accent_color1']." !important;}";
        
        $css .= ".rslider-selection.tick-rslider-selection,.rslider-tick.in-selection
        { background-image : linear-gradient(to bottom,".$bigikala_options['accent_color1']." 0,".$bigikala_options['accent_color1']." 100%);}";
        
        $css .= ".vendors-table-row--highlight,.woocommerce-MyAccount-navbar-primary ul li.is-active a,.address_list .address_item .control-btn td.edit
        { background-color : ".$bigikala_options['accent_color1']."10;}";
        
        
        $css .= ".address_list .address_item::before
        { background: linear-gradient(90deg,".$bigikala_options['accent_color1']." 48px,".$bigikala_options['accent_color2']." 0) repeat-x; 10;background-size: 96px 3px}";

        $css .= ".header .cart-box .dk-button-container,.hr-widget .blog-widget-title span,
        .archive-header .media-header__follow-btn,.bk_menu.bk_new_menu .submenu .title a:hover,.ship::before,.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
        .c-header__user-dropdown-sign-up a,span.sku,div.swatch-wrapper.selected .color-title,.seller-v,.dk-product-meta span a,.woocommerce div.product form.cart .button,
        .readmore a, .readmore a:hover,.title__sep,#more-link,.show-more-seller::after,.vendors-table-col--sellerTitle a,.page-numbers.current,.report-button-container .edit-info,
        .report-button-container .change-address,.address_list .address_item,.input-text, input[type=email], input[type=password], input[type=search], input[type=text], input[type=url],
        textarea,.select2-container--default .select2-selection--single,span.comment-rules a,.return-to-product a,.bottom-box .qus a,#bigikala_login .forget,
        #bigikala_login .footer .register a,.bk_menu.bk_new_menu .bigi > ul > li:hover > ul.level > li:hover > h3,.vendors-table .vendor-button,.vendors-table-row--highlight,
        .vendors-table-row--highlight,.show-more-seller.playing::after,.wishlist-item .btn.btn-blue.woocommerce-Button.button, #feedback_submit,.bk_menu .bigi > ul > li:hover,
        .product-list-table td a, .bk_menu.bk_new_menu .bigi > ul > li:hover > ul.level > li > .submenu > ul > li.title a:hover,.ship,.profile-img img
        { border-color : ".$bigikala_options['accent_color1'].";}";
        
        $css .= ".bk_menu .bigi > ul > li:hover > ul.level > li:hover > .title2::before
        { border-bottom: 7px solid ".$bigikala_options['accent_color1'].";}";
        
        $css .= ".icon-caret-left-blue::before,.comment-filter > span::before
        { border-color : transparent transparent transparent ".$bigikala_options['accent_color1'].";}";
        
        $css .= ".compare-products > ul
        { border-bottom : 2px solid ".$bigikala_options['accent_color1'].";}";

        $css .= ".compare-singleitem::after
        { border-color: transparent transparent ".$bigikala_options['accent_color1'].";}";

        $css .= ".bk_menu.bk_new_menu .submenu .title a 
        { color : ".$bigikala_options['accent_color1']."!important;}";

        $css .= ".wms-checkout-button
        { background-color : ".$bigikala_options['accent_color1']." !important; border-color : ".$bigikala_options['accent_color1']." !important;}";
        
    }
    
    if(isset($bigikala_options['accent_color2']) && !empty($bigikala_options['accent_color2'])){
        $css .= ".columnone label,.columnone .wonder-price-discount,.lofslidervoc ul.navigator-wrap-inner li.active::before,.columnone .special,
        .lofslidervoc ul.navigator-wrap-inner li.active,#yith-searchsubmit,
        .section-products-carousel header span::before, .section-products-carousel header h2::before, .section-products-carousel.brands header strong::before,
        .navbar-primary .promotion-badge ul li a::before,.loop-saving-percentage,.content-box-shop .flip-clock-dot,.products-box.listing .loop-saving-percentage,
        .wonderful_offer_archive,.c-header__user-dropdown::before,.product_bar_left .flip-clock-dot,.dk-button-discount,.multicat-link.active,
        .section-products-carousel header span::before, .section-products-carousel header h3::before, .section-products-carousel.brands header strong::before
        { background-color : ".$bigikala_options['accent_color2'].";}";

        $css .= "h3.blog-post-list-title,.special-offer-hint,.products-box.listing .special-offer-hint,.bk_menu .bigi > ul > li:hover,
        .bk_menu .bigi > ul > li:hover > ul.level > li:hover > h3::before
        { border-color : ".$bigikala_options['accent_color2'].";}";

        $css .= ".special-offer-hint::before,.content-box-shop .flip-clock-wrapper ul li a div div.inn,.wc-descrip .woocommerce-Price-currencySymbol,
        .compare__button--remove::before,.recomendation-wrapper.matrix_wolfrating::before,.product_bar::before,.product_bar_left .flip-clock-wrapper ul li a div div.inn,
        .c-navi-list__basket-total .woocommerce-Price-amount,.bk_menu.bk_new_menu .bigi > ul > li:hover > ul.level > li > .submenu > ul > li.title a:hover,
        .bk_menu .bigi > ul > li:hover > ul.level > li > .submenu > ul > li.title a,.bk_menu .bigi > ul > li:hover > ul.level > li:hover > h3,.bk_menu a:focus,
        .compare__button--remove,.bk_menu a:hover,.table-cell .woocommerce-Price-amount,.bk_menu.bk_new_menu .bigi > ul > li > ul.level .title2 a:hover,
        .bk_menu.bk_vertical_menu.level .bigi > ul > li:hover > ul.level > li:hover > h3,.bk_menu.bk_vertical_menu.level .bigi > ul > li > ul.level > li > h3 a:hover::before,
        .bk_menu.bk_vertical_menu.level .bigi > ul > li:hover > ul.level > li:hover > h3:hover a,.bk_menu .bigi > ul > li:hover > ul.level > li > .submenu > ul > li.item a:hover,
        .bk_menu.bk_new_menu .bigi > ul > li > ul.level .title2 a
        { color : ".$bigikala_options['accent_color2'].";}";

        $css .= ".bk_menu.bk_vertical_menu.level .submenu .title a:hover
        { color : ".$bigikala_options['accent_color2']."!important;}";

        $css .= ".c-header__user-dropdown::after,.product_bar,
        .bk_menu .bigi > ul > li:hover > ul.level > li:hover > h3::before,.bk_menu .bigi > ul > li:hover > ul.level > li:hover > h3
        { border-color: transparent transparent ".$bigikala_options['accent_color2'].";}";
        
    }
    
    // top bar and footer background
    $css .= ".footerinfobar {";
    if($bigikala_options['footerinfobar_bg']){
        $css .= "background-color:".esc_attr( $bigikala_options['footerinfobar_bg']).";";
    }
    if($bigikala_options['footerinfobar_color']){
        $css .= "color:".esc_attr( $bigikala_options['footerinfobar_color']).";";
    }
    $css .= "}";
    
    if($bigikala_options['footerinfobar_color']){
        $css .= ".footerinfobar a {
		color:".esc_attr( $bigikala_options['footerinfobar_color'] ).";}";
    }

    $css .= ".matrix_wolfbody {";
    if($bigikala_options['body_bg_color']){
        $css .= "background-color:".esc_attr( $bigikala_options['body_bg_color'] ).";";
    }
    if($bigikala_options['body_bg_image']['url'] ){
        $css .= "background-image:url(".esc_attr( $bigikala_options['body_bg_image']['url'] ).");";
    }
    $css .= "}";

    $css .= ".tbar-background {";
    if($bigikala_options['top_bar_bgtext_bg']){
        $css .= "background-color:".esc_attr( $bigikala_options['top_bar_bgtext_bg']).";";
    }
    if($bigikala_options['top_bar_bgtext_color']){
        $css .= "color:".esc_attr( $bigikala_options['top_bar_bgtext_color']).";";
    }
    $css .= "}";
    
    if(isset($bigikala_options['custom_css']) && !empty($bigikala_options['custom_css'])){
        $css .= $bigikala_options['custom_css'];
    }

	wp_add_inline_style('bigikala-main-theme', $css);
}
add_action( 'wp_enqueue_scripts', 'youone_front_styles_method' , 100 );
