jQuery(document).on( 'click', '.products-box .woocommerce-pagination a,.widget_layered_nav_filters a,.wc-layered-nav-rating a, .custom_order_by_sort, .woocommerce-widget-layered-nav-list__item.wc-layered-nav-term a', function( event ) {
	var page_link_url = jQuery(this).attr('href');
	event.preventDefault();
    jQuery('html, body').animate({scrollTop:0},800);
	jQuery('.content-box-shop').append( '<div class="page-modal"><div class="page-content" id="loader"><img alt="site-logo" class="site-logo" src="'+loadmore_params.lurl+'"><div class="c-remodal-loader__bullets"><i class="c-remodal-loader__bullet c-remodal-loader__bullet--1"></i><i class="c-remodal-loader__bullet c-remodal-loader__bullet--2"></i><i class="c-remodal-loader__bullet c-remodal-loader__bullet--3"></i><i class="c-remodal-loader__bullet c-remodal-loader__bullet--4"></i></div></div></div><div class="clearfix"></div>' );
    jQuery('#content').load(page_link_url + ' #content', function(responseTxt, statusTxt, xhr){
        jQuery('.page-modal').remove();
        if(statusTxt == "success"){
            youone_product_filters();
		    window.history.pushState({path:page_link_url},'',page_link_url);
		    fix_price_filter();
		    fix_compare_field();
        }
        if(statusTxt == "error"){
            alert("Error: " + xhr.status + ": " + xhr.statusText);
        }
    });
});

jQuery(document).on( 'click', '.widget_price_filter .price_slider_wrapper .button', function( event ) {
    event.preventDefault();
    var href = '';
    var t    = jQuery(this);
    var form = t.parents('form'),
                l = window.location,
                shop_uri = l.origin + l.pathname,
                is_filtered = shop_uri != l.href,
                search = l.search,
                min_price = jQuery('.price_slider_amount #min_price').val(),
                max_price = jQuery('.price_slider_amount #max_price').val(),
                regex_min = new RegExp('^min_price', 'i'),
                regex_max = new RegExp('^max_price', 'i');

    href = l.href;

    if (is_filtered == true) {
        href = YouOneRemoveParameterFromUrl(href, 'min_price');
        href = YouOneRemoveParameterFromUrl(href, 'max_price');
    }

    var concat = shop_uri == href  ? '?' : '&';

    href = href + concat + jQuery.param(
        {
            min_price: min_price,
            max_price: max_price
        }
    );
    
    jQuery('html, body').animate({scrollTop:0},800);
	jQuery('.content-box-shop').append( '<div class="page-modal"><div class="page-content" id="loader"><img alt="site-logo" class="site-logo" src="'+loadmore_params.lurl+'"><div class="c-remodal-loader__bullets"><i class="c-remodal-loader__bullet c-remodal-loader__bullet--1"></i><i class="c-remodal-loader__bullet c-remodal-loader__bullet--2"></i><i class="c-remodal-loader__bullet c-remodal-loader__bullet--3"></i><i class="c-remodal-loader__bullet c-remodal-loader__bullet--4"></i></div></div></div><div class="clearfix"></div>' );
    jQuery('#content').load(href + ' #content', function(responseTxt, statusTxt, xhr){
        jQuery('.page-modal').remove();
        if(statusTxt == "success"){
            youone_product_filters();
		    window.history.pushState({path:href},'',href);
		    fix_price_filter();
        }
        if(statusTxt == "error"){
            alert("Error: " + xhr.status + ": " + xhr.statusText);
        }
    });
});   

function YouOneRemoveParameterFromUrl(url, parameter) {
    return url
    .replace(new RegExp('[?&]' + parameter + '=[^&#]*(#.*)?$'), '$1')
    .replace(new RegExp('([?&])' + parameter + '=[^&]*&'), '$1');
}

function fix_price_filter(){
    
    jQuery( function( $ ) {

	// woocommerce_price_slider_params is required to continue, ensure the object exists
	if ( typeof woocommerce_price_slider_params === 'undefined' ) {
		return false;
	}

	$( document.body ).bind( 'price_slider_create price_slider_slide', function( event, min, max ) {

		$( '.price_slider_amount span.from' ).html( accounting.formatMoney( min, {
			symbol:    woocommerce_price_slider_params.currency_format_symbol,
			decimal:   woocommerce_price_slider_params.currency_format_decimal_sep,
			thousand:  woocommerce_price_slider_params.currency_format_thousand_sep,
			precision: woocommerce_price_slider_params.currency_format_num_decimals,
			format:    woocommerce_price_slider_params.currency_format
		} ) );

		$( '.price_slider_amount span.to' ).html( accounting.formatMoney( max, {
			symbol:    woocommerce_price_slider_params.currency_format_symbol,
			decimal:   woocommerce_price_slider_params.currency_format_decimal_sep,
			thousand:  woocommerce_price_slider_params.currency_format_thousand_sep,
			precision: woocommerce_price_slider_params.currency_format_num_decimals,
			format:    woocommerce_price_slider_params.currency_format
		} ) );

		$( document.body ).trigger( 'price_slider_updated', [ min, max ] );
	});

	function init_price_filter() {
		$( 'input#min_price, input#max_price' ).hide();
		$( '.price_slider, .price_label' ).show();

		var min_price         = $( '.price_slider_amount #min_price' ).data( 'min' ),
			max_price         = $( '.price_slider_amount #max_price' ).data( 'max' ),
			step              = $( '.price_slider_amount' ).data( 'step' ) || 1,
			current_min_price = $( '.price_slider_amount #min_price' ).val(),
			current_max_price = $( '.price_slider_amount #max_price' ).val();

		$( '.price_slider:not(.ui-slider)' ).slider({
			range: true,
			animate: true,
			min: min_price,
			max: max_price,
			step: step,
			values: [ current_min_price, current_max_price ],
			create: function() {

				$( '.price_slider_amount #min_price' ).val( current_min_price );
				$( '.price_slider_amount #max_price' ).val( current_max_price );

				$( document.body ).trigger( 'price_slider_create', [ current_min_price, current_max_price ] );
			},
			slide: function( event, ui ) {

				$( 'input#min_price' ).val( ui.values[0] );
				$( 'input#max_price' ).val( ui.values[1] );

				$( document.body ).trigger( 'price_slider_slide', [ ui.values[0], ui.values[1] ] );
			},
			change: function( event, ui ) {

				$( document.body ).trigger( 'price_slider_change', [ ui.values[0], ui.values[1] ] );
			}
		});
	}

	init_price_filter();

	var hasSelectiveRefresh = (
		'undefined' !== typeof wp &&
		wp.customize &&
		wp.customize.selectiveRefresh &&
		wp.customize.widgetsPreview &&
		wp.customize.widgetsPreview.WidgetPartial
	);
	if ( hasSelectiveRefresh ) {
		wp.customize.selectiveRefresh.bind( 'partial-content-rendered', function() {
			init_price_filter();
		} );
	}
}); 
}// end of price filter fixed

function fix_compare_field(){
    
    var url = jQuery(".compare__button--compare").attr("href");
    var a = url.indexOf("?");
    if(a != -1){
        var b =  url.substring(a);
        var basecompare = url.replace(b,"");
    }else{
        basecompare = url;
    }
    jQuery(".products .product").each(function() {
        var id = jQuery(this).data("id");
        var cond = 0;
        jQuery(".compare ul>li").each(function() {
            if (jQuery(this).data("id") == id) {
                cond =1;
            }
        });
        if (!jQuery(this).find(".products__item-compare-txt").hasClass("checked") && cond==1) {
            jQuery(this).find(".products__item-compare-txt").addClass("checked");
            jQuery(this).find(".products__item-compare-txt input[type='checkbox']").attr("checked","checked");
        }
    });
    jQuery(".products__item-compare-txt input[type='checkbox']").on("click", function() {
        var id = jQuery(this).parents(".product").data("id");
        var str = "";
        if (jQuery(this).prop("checked") == !0) {
            jQuery(this).parent('label').addClass("checked");
            jQuery(".compare").fadeIn("fast");
            if (jQuery('.compare ul li.product--placeholder').length > 0) {
                var cond = 0;
                jQuery(".compare ul>li").each(function() {
                    if (jQuery(this).data("id") == id) {
                        cond = 1
                    }
                });
                if (cond == 1) {
                    alert(translate_object.eil)
                } else {
                    var number = 0;
                    jQuery(".product input[type='checkbox']").each(function() {
                        if (jQuery(this).prop("checked")) {
                            number++
                        }
                    });
                    jQuery(".compare__action-wrapper>a>span").html(number);
                    jQuery(".compare>span>span.num").html(number);
                    var counter = 0;
                    jQuery('.products__item-compare-txt input[type="checkbox"]').each(function() {
                        if (jQuery(this).prop("checked")) {
                            str += "<li class='product' data-id='" + jQuery(this).parents(".product").data("id") + "'><div class='product__image'><img src='" + jQuery(this).parents(".product").find(".products__item-image").attr("src") + "' alt='img' /></div>";
                            str += "<span class='product__title product__title--en'>" + jQuery(this).parents(".product").data("en") + "</span>";
                            str += "<span class='product__title product__title--fa'>" + jQuery(this).parents(".product").find(".products__item-fatitle").html() + "</span>";
                            str += "<span class='product__remove'></span></li>";
                            counter++
                        }
                    });
                    for (i = 0; i < 4 - counter; i++) {
                        str += '<li class="product product--placeholder"><span class="row row--image"></span><span class="row row--title row--title-first"></span><span class="row row--title row--title-last"></span></li>'
                    }
                    var temp = "";
                    jQuery(".product input[type='checkbox']").each(function() {
                        if (jQuery(this).prop("checked")) {
                            temp += jQuery(this).parents(".product").attr("data-id") + ","
                        }
                    });
                    if (jQuery(".compare__button--compare").attr("href").indexOf("myproducts")) {
                        jQuery(".compare__button--compare").attr("href", jQuery(".compare__button--compare").attr("href").substring(0, jQuery(".compare__button--compare").attr("href").indexOf("myproducts")))
                    }
                    var temp1 = jQuery(".compare__button--compare").attr("href");
                    temp = temp.substr(0, temp.lastIndexOf(","));
                    jQuery(".compare__button--compare").attr("href", basecompare + temp1 + "?products=" + temp);
                    jQuery(".compare .compare__flex-wrapper>ul").html(str)
                }
            } else {
                jQuery.iaoAlert({
                    msg: translate_object.cna,
                    type: "warning",
                    mode: "dark",
                    closeButton: !1,
                    fadeOnHover: !1,
                })
                jQuery(this).prop("checked", !1);
                jQuery(this).parent('label').removeClass("checked")
            }
        } else {
            jQuery(this).parent('label').removeClass("checked");
            jQuery(".compare ul>li").each(function() {
                if (jQuery(this).data("id") == id) {
                    jQuery(this).remove()
                }
            });
            var temp = "";
            jQuery(".product input[type='checkbox']").each(function() {
                if (jQuery(this).prop("checked")) {
                    temp += jQuery(this).parents(".product").attr("data-id") + ","
                }
            });
            if (jQuery(".compare__button--compare").attr("href").indexOf("myproducts")) {
                jQuery(".compare__button--compare").attr("href", jQuery(".compare__button--compare").attr("href").substring(0, jQuery(".compare__button--compare").attr("href").indexOf("myproducts")))
            }
            var temp1 = jQuery(".compare__button--compare").attr("href");
            temp = temp.substr(0, temp.lastIndexOf(","));
            jQuery(".compare__button--compare").attr("href", basecompare + temp1 + "?products=" + temp);
            var number = 0;
            jQuery(".product input[type='checkbox']").each(function() {
                if (jQuery(this).prop("checked")) {
                    number++
                }
            });
            jQuery(".compare__action-wrapper>a>span").html(number);
            jQuery(".compare>span>span.num").html(number);
            var counter = 0;
            jQuery('.products__item-compare-txt input[type="checkbox"]').each(function() {
                if (jQuery(this).prop("checked")) {
                    str += "<li class='product' data-id='" + jQuery(this).parents(".product").data("id") + "'><div class='product__image'><img src='" + jQuery(this).parents(".product").find(".products__item-image").attr("src") + "' alt='img' /></div>";
                    str += "<span class='product__title product__title--en'>" + jQuery(this).parents(".product").data("en") + "</span>";
                    str += "<span class='product__title product__title--fa'>" + jQuery(this).parents(".product").find(".products__item-fatitle").html() + "</span>";
                    str += "<span class='product__remove'></span></li>";
                    counter++
                }
            });
            for (i = 0; i < 4 - counter; i++) {
                str += '<li class="product product--placeholder"><span class="row row--image"></span><span class="row row--title row--title-first"></span><span class="row row--title row--title-last"></span></li>'
            }
            jQuery(".compare .compare__flex-wrapper>ul").html(str);
            if (jQuery('.compare ul li.product--placeholder').length == 4) {
                jQuery(".compare").removeClass("compare--active");
                jQuery(".compare").hide()
            }
        }
    });


}