jQuery(document).ready(function($) {
    //$('body').persiaNumber();
    $('#bigihomeslider').carousel({
        interval: 4000
    });
    var clickEvent = !1;
    $('#bigihomeslider').on('click', '.nav a', function() {
        clickEvent = !0;
        $('.nav li').removeClass('active');
        $(this).parent().addClass('active')
    }).on('slid.bs.carousel', function(e) {
        if (!clickEvent) {
            var count = $('.nav').children().length - 1;
            var current = $('.nav li.active');
            current.removeClass('active').next().addClass('active');
            var id = parseInt(current.data('slide-to'));
            if (count == id) {
                $('.nav li').first().addClass('active')
            }
        }
        clickEvent = !1
    });
    var buttons = {
        previous: jQuery('#bigislider .button-previous'),
        next: jQuery('#bigislider .button-next')
    };
    jQuery('#bigislider').lofJSidernews({
        interval: 5000,
        easing: 'easeInOutExpo',
        direction: 'opacity',
        duration: 900,
        auto: !0,
        maxItemDisplay: 10,
        buttons: buttons
    });
    $('.items').flickity({
        cellAlign: 'right',
        rightToLeft: !0,
        contain: !0,
        cellSelector: '.productItem',
        pageDots: !1,
        groupCells: true
    });
    $('form#compare-search').on('submit', function(e) {
        $.ajax({
            type: 'POST',
            url: ajax_params.ajaxurl,
            data: {
                'action': 'compare_search',
                'brand': $('form#compare-search #brand').val(),
                'keyword': $('form#compare-search #keyword').val(),
                'cat_ids': $('form#compare-search #cats_ids').val(),
                'product_ids': $('form#compare-search #product_ids').val(),
                'page_url': $('form#compare-search #page_url').val(),
            },
            beforeSend: function() {
                jQuery('#productCompareModal .modal-body').html('');
                jQuery('.compare-section').append( '<div class="page-modal"><div class="page-content" id="loader"><img alt="site-logo" class="site-logo" src="'+ajax_params.lurl+'"><div class="c-remodal-loader__bullets"><i class="c-remodal-loader__bullet c-remodal-loader__bullet--1"></i><i class="c-remodal-loader__bullet c-remodal-loader__bullet--2"></i><i class="c-remodal-loader__bullet c-remodal-loader__bullet--3"></i><i class="c-remodal-loader__bullet c-remodal-loader__bullet--4"></i></div></div></div><div class="clearfix"></div>' );
            },
            success: function(data) {
                jQuery('.page-modal').remove();
                jQuery('#productCompareModal .modal-body').append( data );

            }
        });
        e.preventDefault()
    });
    
    $('form#login').on('submit', function(e) {
        var checkbox_value = "";
        if ($('#p-rememberme').is(":checked")) {
            checkbox_value = $('form#login #p-rememberme').val()
        }
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_params.ajaxurl,
            data: {
                'action': 'ajaxlogin',
                'username': $('form#login #p-username').val(),
                'password': $('form#login #p-password').val(),
                'rememberme': checkbox_value,
                'security': $('form#login #p-security').val()
            },
            beforeSend: function() {
                $('.overlay').show();
                $('#loading').show();
                $('form#login div.login-msg').html('')
            },
            success: function(data) {
                $('.overlay').hide();
                $('#loading').hide();
                $('form#login div.login-msg').html(data.message).fadeIn();
                if (data.loggedin == !0) {
                    window.location.href = ajax_params.loginRedirectURL
                }
            }
        });
        e.preventDefault()
    });
    $('form#sendtofriend').on('submit', function(e) {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_params.ajaxurl,
            data: {
                'action': 'ajaxsendtofriend',
                'email': $('form#sendtofriend #friendemail').val(),
                'product_id': $('form#sendtofriend #product_id').val(),
                'security': $('form#sendtofriend #security').val()
            },
            beforeSend: function() {
                $('#loading-img').fadeIn();
                $('form#sendtofriend div.message-container').html('')
            },
            success: function(data) {
                $('#loading-img').hide();
                $('form#sendtofriend div.message-container').html(data.message).fadeIn()
            }
        });
        e.preventDefault()
    });

    
    $(document).ready(function() {
        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) {
                $('#scrollUp').fadeIn()
            } else {
                $('#scrollUp').fadeOut()
            }
        });
        $('#scrollUp').click(function() {
            $('html, body').animate({
                scrollTop: 0
            }, 800);
            return !1
        });
        $('.wc-tabs li').click(function() {
            $('html, body').animate({
                scrollTop: jQuery('.woocommerce-tabs').offset().top
            }, 800);
        });
        $('#vendors-count-link').click(function() {
            if (this.hash !== "") {
                event.preventDefault();
                var hash = this.hash;
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 800, function(){
                    window.location.hash = hash;
                });
            } // End if
        });
    });
    $('#notify_offer_switch').click(function() {
        var notify_offer = $('#notify_offer').val();
        if (notify_offer == "0") {
            $('#notify_offer').val('1')
        } else {
            $('#notify_offer').val('0')
        }
        if ($(this).hasClass("inactive")) {
            $(this).toggleClass("inactive active")
        } else {
            $(this).toggleClass("active inactive")
        }
    });
    $('#notify_stock_switch').click(function() {
        var notify_stock = $('#notify_stock').val();
        if (notify_stock == "0") {
            $('#notify_stock').val('1')
        } else {
            $('#notify_stock').val('0')
        }
        if ($(this).hasClass("inactive")) {
            $(this).toggleClass("inactive active")
        } else {
            $(this).toggleClass("active inactive")
        }
    });
    $('form#matrix_wolfnotify_form').on('submit', function(e) {
        var email_enable = "";
        if ($('#notify_by_email').is(":checked")) {
            email_enable = $('form#matrix_wolfnotify_form #notify_by_email').val()
        }
        var sms_enable = "";
        if ($('#notify_by_sms').is(":checked")) {
            sms_enable = $('form#matrix_wolfnotify_form #notify_by_sms').val()
        }
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_params.ajaxurl,
            data: {
                'action': 'ajaxbiginotify',
                'offer': $('form#matrix_wolfnotify_form #notify_offer').val(),
                'stock': $('form#matrix_wolfnotify_form #notify_stock').val(),
                'email': email_enable,
                'sms': sms_enable,
                'u_id': $('form#matrix_wolfnotify_form #notify_u_id').val(),
                'p_id': $('form#matrix_wolfnotify_form #notify_p_id').val(),
                'security': $('form#matrix_wolfnotify_form #security').val()
            },
            beforeSend: function() {
                $('.notify_overlay').show();
                $('#notify_loading').show();
                $('form#matrix_wolfnotify_form div.message-container').html('')
            },
            success: function(data) {
                $('.notify_overlay').hide();
                $('#notify_loading').hide();
                $('form#matrix_wolfnotify_form div.message-container').html(data.message).fadeIn();
                if (data.notify == !0) {
                    setTimeout(function() {
                        $('#bigikala_product_notify').modal('toggle');
                        $('form#matrix_wolfnotify_form div.message-container').html('')
                    }, 1000);
                    if (data.remove == !0) {
                        $('.icon-notification').removeClass('done')
                    } else {
                        $('.icon-notification').addClass('done')
                    }
                }
            }
        });
        e.preventDefault()
    });
    $(".accordion-header").on("click", function(e) {
        $(this).children(".icon-arrow-gray-down").toggleClass("down")
    });
    !! function(t) {
        t.fn.iaoAlert = t.iaoAlert = function(o) {
            var e = t.extend({
                    msg: "This is default iao alert message.",
                    type: "notification",
                    mode: "light",
                    autoHide: !0,
                    alertTime: "3000",
                    fadeTime: "500",
                    closeButton: !0,
                    closeOnClick: !1,
                    fadeOnHover: !0,
                    position: "top-right",
                    zIndex: "999",
                    roundedCorner: !1,
                    alertClass: ""
                }, o),
                i = t.now(),
                a = {
                    chkPosition: "bottom-right" == e.position ? "bottom-right" : "bottom-left" == e.position ? "bottom-left" : "top-left" == e.position ? "top-left" : "top-right",
                    closeOption: e.closeButton ? "<iao-alert-close></iao-alert-close>" : "<style>#iao" + i + ":before,#iao" + i + ":after{display:none}</style>",
                    chkMsg: e.msg.indexOf(" ") ? "white-space:pre-wrap;word-wrap:break-word;" : ""
                },
                r = e.roundedCorner ? "round" : "";
            0 == t("iao-alert-box").length && t("body").append('<iao-alert-box position="top-left" style="z-index:' + e.zIndex + '"><iao-alert-start></iao-alert-start></iao-alert-box><iao-alert-box position="top-right" style="z-index:' + e.zIndex + '"><iao-alert-start></iao-alert-start></iao-alert-box><iao-alert-box position="bottom-right" style="z-index:' + e.zIndex + '"><iao-alert-start></iao-alert-start></iao-alert-box><iao-alert-box position="bottom-left" style="z-index:' + e.zIndex + '"><iao-alert-start></iao-alert-start></iao-alert-box>');
            var l = t('<iao-alert class="' + e.alertClass + '" id="iao' + i + '" close-on-click=' + e.closeOnClick + " fade-on-hover=" + e.fadeOnHover + ' mode="' + e.mode + '"type="' + e.type + '" style="' + a.chkMsg + '" corners="' + r + '">' + e.msg + a.closeOption + "</iao-alert>").insertAfter('iao-alert-box[position="' + a.chkPosition + '"] > iao-alert-start');
            return e.autoHide && setTimeout(function() {
                l.fadeOut(e.fadeTime, function() {
                    t(this).remove()
                })
            }, e.alertTime), t('iao-alert[close-on-click="true"]').click(function() {
                t(this).fadeOut(e.fadeTime, function() {
                    t(this).remove()
                })
            }), t("iao-alert > iao-alert-close").click(function() {
                t(this).parent().fadeOut(e.fadeTime, function() {
                    t(this).remove()
                })
            }), this
        }
    }(jQuery);
    var basecompare = $(".compare__button--compare").attr("href");
    $(".products__item-compare-txt input[type='checkbox']").on("click", function() {
        var id = $(this).parents(".product").data("id");
        var str = "";
        if ($(this).prop("checked") == !0) {
            $(this).parent('label').addClass("checked");
            $(".compare").fadeIn("fast");
            if ($('.compare ul li.product--placeholder').length > 0) {
                var cond = 0;
                $(".compare ul>li").each(function() {
                    if ($(this).data("id") == id) {
                        cond = 1
                    }
                });
                if (cond == 1) {
                    alert(ajax_params.eil)
                } else {
                    var number = 0;
                    $(".product input[type='checkbox']").each(function() {
                        if ($(this).prop("checked")) {
                            number++
                        }
                    });
                    $(".compare__action-wrapper>a>span").html(number);
                    $(".compare>span>span.num").html(number);
                    var counter = 0;
                    $('.products__item-compare-txt input[type="checkbox"]').each(function() {
                        if ($(this).prop("checked")) {
                            str += "<li class='product' data-id='" + $(this).parents(".product").data("id") + "'><div class='product__image'><img src='" + $(this).parents(".product").find(".products__item-image").attr("src") + "' alt='img' /></div>";
                            str += "<span class='product__title product__title--en'>" + $(this).parents(".product").data("en") + "</span>";
                            str += "<span class='product__title product__title--fa'>" + $(this).parents(".product").find(".products__item-fatitle").html() + "</span>";
                            str += "<span class='product__remove'></span></li>";
                            counter++
                        }
                    });
                    for (i = 0; i < 4 - counter; i++) {
                        str += '<li class="product product--placeholder"><span class="row row--image"></span><span class="row row--title row--title-first"></span><span class="row row--title row--title-last"></span></li>'
                    }
                    var temp = "";
                    $(".product input[type='checkbox']").each(function() {
                        if ($(this).prop("checked")) {
                            temp += $(this).parents(".product").attr("data-id") + ","
                        }
                    });
                    if ($(".compare__button--compare").attr("href").indexOf("myproducts")) {
                        $(".compare__button--compare").attr("href", $(".compare__button--compare").attr("href").substring(0, $(".compare__button--compare").attr("href").indexOf("myproducts")))
                    }
                    var temp1 = $(".compare__button--compare").attr("href");
                    temp = temp.substr(0, temp.lastIndexOf(","));
                    $(".compare__button--compare").attr("href", basecompare + temp1 + "?products=" + temp);
                    $(".compare .compare__flex-wrapper>ul").html(str)
                }
            } else {
                $.iaoAlert({
                    msg: ajax_params.cna,
                    type: "warning",
                    mode: "dark",
                    closeButton: !1,
                    fadeOnHover: !1,
                })
                $(this).prop("checked", !1);
                $(this).parent('label').removeClass("checked")
            }
        } else {
            $(this).parent('label').removeClass("checked");
            $(".compare ul>li").each(function() {
                if ($(this).data("id") == id) {
                    $(this).remove()
                }
            });
            var temp = "";
            $(".product input[type='checkbox']").each(function() {
                if ($(this).prop("checked")) {
                    temp += $(this).parents(".product").attr("data-id") + ","
                }
            });
            if ($(".compare__button--compare").attr("href").indexOf("myproducts")) {
                $(".compare__button--compare").attr("href", $(".compare__button--compare").attr("href").substring(0, $(".compare__button--compare").attr("href").indexOf("myproducts")))
            }
            var temp1 = $(".compare__button--compare").attr("href");
            temp = temp.substr(0, temp.lastIndexOf(","));
            $(".compare__button--compare").attr("href", basecompare + temp1 + "?products=" + temp);
            var number = 0;
            $(".product input[type='checkbox']").each(function() {
                if ($(this).prop("checked")) {
                    number++
                }
            });
            $(".compare__action-wrapper>a>span").html(number);
            $(".compare>span>span.num").html(number);
            var counter = 0;
            $('.products__item-compare-txt input[type="checkbox"]').each(function() {
                if ($(this).prop("checked")) {
                    str += "<li class='product' data-id='" + $(this).parents(".product").data("id") + "'><div class='product__image'><img src='" + $(this).parents(".product").find(".products__item-image").attr("src") + "' alt='img' /></div>";
                    str += "<span class='product__title product__title--en'>" + $(this).parents(".product").data("en") + "</span>";
                    str += "<span class='product__title product__title--fa'>" + $(this).parents(".product").find(".products__item-fatitle").html() + "</span>";
                    str += "<span class='product__remove'></span></li>";
                    counter++
                }
            });
            for (i = 0; i < 4 - counter; i++) {
                str += '<li class="product product--placeholder"><span class="row row--image"></span><span class="row row--title row--title-first"></span><span class="row row--title row--title-last"></span></li>'
            }
            $(".compare .compare__flex-wrapper>ul").html(str);
            if ($('.compare ul li.product--placeholder').length == 4) {
                $(".compare").removeClass("compare--active");
                $(".compare").hide()
            }
        }
    });
    $(".compare>span").on("click", function() {
        $('.compare').toggleClass("compare--active");
        $('.compare__toggle-handler--arrow').toggleClass("rotate")
    });
    $(".compare").on("click", ".product__remove", function() {
        var id = $(this).parents("li").data("id");
        $(".product").each(function() {
            if ($(this).data("id") == id) {
                $(this).find("input[type='checkbox']").prop("checked", !1);
                $(this).find("input[type='checkbox']").parent('label').removeClass("checked")
            }
        });
        if ($('.compare ul li.product--placeholder').length != 4) {
            var str = "";
            var number = 0;
            $(".product input[type='checkbox']").each(function() {
                if ($(this).prop("checked")) {
                    number++
                }
            });
            $(".compare__action-wrapper>a>span").html(number);
            $(".compare>span>span.num").html(number);
            var counter = 0;
            $('.products__item-compare-txt input[type="checkbox"]').each(function() {
                if ($(this).prop("checked")) {
                    str += "<li class='product' data-id='" + $(this).parents(".product").data("id") + "'><div class='product__image'><img src='" + $(this).parents(".product").find(".products__item-image").attr("src") + "' alt='img' /></div>";
                    str += "<span class='product__title product__title--en'>" + $(this).parents(".product").data("en") + "</span>";
                    str += "<span class='product__title product__title--fa'>" + $(this).parents(".product").find(".products__item-fatitle").html() + "</span>";
                    str += "<span class='product__remove'></span></li>";
                    counter++
                }
            });
            for (i = 0; i < 4 - counter; i++) {
                str += '<li class="product product--placeholder"><span class="row row--image"></span><span class="row row--title row--title-first"></span><span class="row row--title row--title-last"></span></li>'
            }
            var temp = "";
            $(".product input[type='checkbox']").each(function() {
                if ($(this).prop("checked")) {
                    temp += $(this).parents(".product").attr("data-id") + ","
                }
            });
            if ($(".compare__button--compare").attr("href").indexOf("myproducts")) {
                $(".compare__button--compare").attr("href", $(".compare__button--compare").attr("href").substring(0, $(".compare__button--compare").attr("href").indexOf("myproducts")))
            }
            var temp1 = $(".compare__button--compare").attr("href");
            temp = temp.substr(0, temp.lastIndexOf(","));
            $(".compare__button--compare").attr("href", basecompare + temp1 + "?products=" + temp);
            $(".compare .compare__flex-wrapper>ul").html(str)
        }
        if ($('.compare ul li.product--placeholder').length == 4) {
            $(".compare").hide()
        }
    });
    $(".compare__button--remove").on("click", function() {
        var number = 0;
        var str = "";
        if ($(".compare__button--compare").attr("href").indexOf("myproducts")) {
            $(".compare__button--compare").attr("href", $(".compare__button--compare").attr("href").substring(0, $(".compare__button--compare").attr("href").indexOf("myproducts")))
        }
        $(".compare__button--compare").attr("href", basecompare);
        $(".compare__action-wrapper>a>span").html(number);
        $(".compare>span>span.num").html(number);
        for (i = 0; i < 4; i++) {
            str += '<li class="product product--placeholder"><span class="row row--image"></span><span class="row row--title row--title-first"></span><span class="row row--title row--title-last"></span></li>'
        }
        $(".compare .compare__flex-wrapper>ul").html(str);
        $(".compare").hide();
        $(".product input[type='checkbox']").each(function() {
            $(this).prop("checked", !1);
            $(this).parent('label').removeClass("checked")
        });
        $(".compare").removeClass("compare--active")
    });
    $('.c-header__btn-container').click(function(e){
        $('.c-header__user-dropdown').toggle();
        $('.mini-cart-dropdown').hide();
         //e.stopPropagation();
    });
    $('.c-header__user-dropdown-login').click(function(e){
        $('.c-header__user-dropdown').hide();
    });
    $('.cart-box .dk-button-container').click(function(e){
        $('.mini-cart-dropdown').toggle();
        $('.c-header__user-dropdown').hide();
        //e.stopPropagation();
    });
    /*$(document).click( function() {
        $('.c-header__user-dropdown').hide();
        $('.mini-cart-dropdown').hide();
    });*/
    $('#more-link').click(function(){
        $('.hidden-mainfea').toggle();
        $('#more-link').text($('#more-link').hasClass("playing") ? ajax_params.moreitems : ajax_params.close2);
        $('#more-link').toggleClass("playing");
    });
    
if( jQuery(document.body).find('.short-description .innerContent').length !== 0){
    jQuery('.short-description .innerContent').readmore({
        moreLink: '<div class="readmore readmore_link text-center"><a href="#"><span>'+ajax_params.more+'</span></a></div>',
        lessLink: '<div class="readmore text-center"><a href="#"><span>'+ajax_params.close+'</span></div>'
    });
}

    //sticky tabs
if( jQuery(document.body).find('ul.wc-tabs').length !== 0){
  jQuery(window).scroll(function (event) {
    var top = jQuery('.products-tabs').offset().top;
    if( jQuery(document.body).find('.upsell-carousel').length !== 0){
        var b = jQuery('.upsell-carousel').offset().top - 55;
    }else if( jQuery(document.body).find('.smart-similar-products').length !== 0){
        var b = jQuery('.smart-similar-products').offset().top - 55;
    }else{
        var b = jQuery('.footer-section').offset().top - 55;
    }
	var y = jQuery(this).scrollTop();
		if ( y >= top && y<b) {
		  jQuery('ul.wc-tabs').addClass('sticky');
		  jQuery('.woocommerce-Tabs-panel').css('padding-top','90px');
		  jQuery('ul.wc-tabs').width(jQuery('ul.wc-tabs').parent().width());
		} else {
		  jQuery('ul.wc-tabs').removeClass('sticky');
		  jQuery('ul.wc-tabs').removeAttr('style');
		  jQuery('.woocommerce-Tabs-panel').css('padding-top','35px');
		}
  	});
}

//multi_cat_vc ajax func
jQuery(document).on( 'click', '.multicat_list a', function( event ) {
     event.preventDefault();
     var element = jQuery(this);
     var term_id = element.attr('data-term');
     element.parents().eq(1).find('a').removeClass('active');
     element.addClass('active');
     var limit = element.parents().eq(1).attr('data-limit');
     var sort = element.parents().eq(1).attr('data-sort');
     var order = element.parents().eq(1).attr('data-order');
     var discount = element.parents().eq(1).attr('data-discount');
     var instock = element.parents().eq(1).attr('data-instock');
     var coming_soon = element.parents().eq(1).attr('data-comingsoon');
		    data = {
			'action': 'load_products',
			'cat_item' : term_id,
			'limit' : limit,
			'sort' : sort,
			'order' : order,
			'discount' : discount,
			'instock' : instock,
			'coming_soon' : coming_soon
		};
 
		jQuery.ajax({
			url  :  ajax_params.ajaxurl, // AJAX handler
			data :  data,
			type :  'POST',
	beforeSend: function() {
		jQuery('.entry-content').append( '<div class="page-modal"><div class="page-content" id="loader"><img alt="site-logo" class="site-logo" src="'+ajax_params.lurl+'"><div class="c-remodal-loader__bullets"><i class="c-remodal-loader__bullet c-remodal-loader__bullet--1"></i><i class="c-remodal-loader__bullet c-remodal-loader__bullet--2"></i><i class="c-remodal-loader__bullet c-remodal-loader__bullet--3"></i><i class="c-remodal-loader__bullet c-remodal-loader__bullet--4"></i></div></div></div><div class="clearfix"></div>' );
	},
	success: function( html ) {
	    var content = html.slice(0,-1);
	    element.parents().eq(3).find('.flickity-slider').css('transform','translateX(0.56%)');
	    element.parents().eq(3).find('.flickity-slider .productItem').removeClass('is-selected');
	    element.parents().eq(3).find('.flickity-slider .productItem').first().addClass('is-selected');
	    element.parents().eq(3).find('.flickity-slider').html('');
		jQuery('.page-modal').remove();
		element.parents().eq(3).find('.flickity-slider').append( content );
	}
	});
});
jQuery('.select-option').click(function(){
setTimeout( function(){ 
   var ez =   jQuery('.wp-post-image').data('elevateZoom');	  
   var smallImage = jQuery('.woocommerce-product-gallery__wrapper .wp-post-image').attr('src');
   var largeImage = jQuery('.woocommerce-product-gallery__wrapper .wp-post-image').attr('data-src');
   ez.swaptheimage(smallImage, largeImage);
  }  , 200 );
});
jQuery('input.variation_id').change(function(){
setTimeout( function(){ 
   var ez =   jQuery('.wp-post-image').data('elevateZoom');	  
   var smallImage = jQuery('.woocommerce-product-gallery__wrapper .wp-post-image').attr('src');
   var largeImage = jQuery('.woocommerce-product-gallery__wrapper .wp-post-image').attr('data-src');
   ez.swaptheimage(smallImage, largeImage);
  }  , 400 );
});
	
//login tabs ===================================================================
$('ul.bigi-tabs').each(function(){
  // For each set of tabs, we want to keep track of
  // which tab is active and its associated content
  var  $active, $content, $links = $(this).find('a'), $default = $(this).find('a.active');

  // If the location.hash matches one of the links, use that as the active tab.
  // If no match is found, use the first link as the initial active tab.
  if($default.length !== 0){
    $active = $default;
  }else{
    $active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
  }
  $active.addClass('active');

  $content = $($active[0].hash);

  // Hide the remaining content
  $links.not($active).each(function () {
    $(this.hash).hide();
  });

  // Bind the click event handler
  $(this).on('click', 'a', function(e){
    // Make the old tab inactive.
    $active.removeClass('active');
    $content.hide();

    // Update the variables with the new link and content
    $active = $(this);
    $content = $(this.hash);

    // Make the tab active.
    $active.addClass('active');
    $content.show();

    // Prevent the anchor's default click action
    e.preventDefault();
  });
});
// show/hide password ==========================================================
$(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $(this).parent().find("input[name='password']");
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});

// quantity input ==============================================================
  
    $(document.body).on( 'click', '.yone-plus, .yone-minus', function() {
        
        // Get current quantity values
        var qty = $( this ).closest( '.quantity' ).find( '.qty' );
        var val = parseFloat(qty.val());
        var max = parseFloat(qty.attr( 'max' ));
        var min = parseFloat(qty.attr( 'min' ));
        var step = parseFloat(qty.attr( 'step' ));
        var diff = val - min ;
        var minus = $( this ).parents('.quantity').find('.yone-minus');

        // Change the value if plus or minus
        if ( $( this ).is( '.yone-plus' ) ) {
            if ( max && ( max <= val ) ) {
                qty.val( max ).change();
            }else {
                qty.val( val + step ).change();
            }
        }else {
            if ( min && ( diff <= step ) ) {
                if($('.woocommerce-cart-form__contents').length > 0){
                    qty.val( 0 ).change();
                }else{
                    qty.val( min ).change();
                }
            }else {
                qty.val( val - step ).change();
            }
        }
    });

// external product in dokan ===================================================
	$( 'select#product_type' ).change( function() {
	    var product_type = $( 'select#product_type' ).val();
	    if( product_type == 'external'){
		    var is_external = true;
	    }
		$( '.show_if_external' ).hide();
		$( '.hide_if_external' ).hide();
		if ( is_external ) {
			$( '.hide_if_external' ).hide();
		}
		if ( is_external ) {
			$( '.show_if_external' ).show();
		}
	});
	$( 'select#product_type' ).trigger( 'change' );
	
// night mode ==================================================================
    $('#night_mode_switcher').click(function() {
        if ($(this).hasClass("inactive")) {
            $(this).toggleClass("inactive active");
            $('body').addClass('night');
            var night_mode = 'active';
        } else {
            $(this).toggleClass("active inactive");
            $('body').removeClass('night');
            var night_mode = 'inactive';
        }
		jQuery.post( ajax_params.ajaxurl ,
		{
			action: "choose_night_mode",
			night_mode_status : night_mode,
		});
    });
    
// product box =================================================================
    $('.product-info-box .seller-info .header-section').click(function() {
        $(this).hide();
        $('.warranty-info').hide();
        $('.leadTime-info').hide();
        $('.price-section').hide();
        $('.woocommerce-variation-price').hide();
        $(this).parent().find('.body-section').show();
    });
    
    $('.product-info-box .seller-info .body-section .return').click(function() {
        $(this).parent().hide();
        $('.warranty-info').show();
        $('.leadTime-info').show();
        $('.price-section').show();
        $('.woocommerce-variation-price').show();
        $(this).parents('.product-info-box').find('.header-section').show();
    });
    
        $('.product-info-box .leadTime-info .header-section').click(function() {
        $(this).hide();
        $('.warranty-info').hide();
        $('.seller-info').hide();
        $('.price-section').hide();
        $('.woocommerce-variation-price').hide();
        $(this).parent().find('.body-section').show();
    });
    
    $('.product-info-box .leadTime-info .body-section .return').click(function() {
        $(this).parent().hide();
        $('.warranty-info').show();
        $('.seller-info').show();
        $('.price-section').show();
        $('.woocommerce-variation-price').show();
        $(this).parents('.product-info-box').find('.header-section').show();
    });

// change avatar ===============================================================
  $(".c-profile-box__btn-edit").click(function(event){
      $('#avatarModal').modal('show');
  });
  
  $("#avatarModal .new-avatar").click(function(event){
     var new_avatar_id = jQuery(this).data('name');
		    data = {
			'action': 'update_avatar',
			'new_avatar_id' : new_avatar_id,
		};
 
		jQuery.ajax({
			url  :  ajax_params.ajaxurl, // AJAX handler
			data :  data,
			type :  'POST',
	beforeSend: function() {
	    $('#avatarModal').modal('hide');
		jQuery('.entry-content').append( '<div class="page-modal"><div class="page-content" id="loader"><img alt="site-logo" class="site-logo" src="'+ajax_params.lurl+'"><div class="c-remodal-loader__bullets"><i class="c-remodal-loader__bullet c-remodal-loader__bullet--1"></i><i class="c-remodal-loader__bullet c-remodal-loader__bullet--2"></i><i class="c-remodal-loader__bullet c-remodal-loader__bullet--3"></i><i class="c-remodal-loader__bullet c-remodal-loader__bullet--4"></i></div></div></div><div class="clearfix"></div>' );
	},
	success: function( data ) {
	    jQuery('.page-modal').remove();
	    jQuery('.c-profile-box__avatar.user-avatar').html(data);
	}
	});
	
  });


// new comment form ============================================================
    var m = $("#comment_advantages, #comment_disadvantages"),
        p = function() {
            var a = $(this);
            a.val().trim().length > 0 ? a.siblings(".add-item").show() : a.siblings(".add-item").hide()
        };
    if (m.each(function() {
            p.bind(this)(), $(this).on("change keyup", p.bind(this))
        }), $(".advantages").delegate(".add-item", "click", function(a) {
            var o = $("#advantages_wrapper");
            if (!(o.find(".more-items").length >= 5)) {
                var t = $("#comment_advantages");
                t.val().trim().length > 0 && (o.append('<div class="more-items more-items-positive">\n' + t.val() + '<button type="button" class="items-remove"></button>\n<input type="hidden" name="comment_advantages[]" value="' + t.val() + '">\n</div>'), t.val("").change(), t.focus())
            }
        }).delegate(".items-remove", "click", function(a) {
            $(this).parent(".more-items").remove()
        }), $(".disadvantages").delegate(".add-item", "click", function(a) {
            var o = $("#disadvantages_wrapper");
            if (!(o.find(".more-items").length >= 5)) {
                var t = $("#comment_disadvantages");
                t.val().trim().length > 0 && (o.append('<div class="more-items more-items-negative">\n' + t.val() + '<button type="button" class="items-remove"></button>\n<input type="hidden" name="comment_disadvantages[]" value="' + t.val() + '">\n</div>'), t.val("").change(), t.focus())
            }
        }).delegate(".items-remove", "click", function(a) {
            $(this).parent(".more-items").remove()
        }), $(".rates .rate-bar").each(function(index) {
                $(this).on("change", function(){
                    var id = $(this).attr('id');
                    var value = $(this).val();
                    $('#v'+id).val(value);
                });
        }), $("#bigikalacomments").length);
    $(".rate-bar").each(function(){
        var ticks_labels = JSON.parse( $(this).attr('data-rslider-ticks-labels') );
        $(this).on("change", function() {
            var value = $(this).val();
	        $(this).next().text(ticks_labels[value - 1]);
        });
    });
    
//youone wishlist ==============================================================
  jQuery(".youone-wishlist").click(function(event){
     var element = jQuery(this);
     var product_id = jQuery(this).data('product-id');
		    data = {
			'action': 'update_user_wishlist',
			'product_id' : product_id,
		};
 
		jQuery.ajax({
			url  :  ajax_params.ajaxurl, // AJAX handler
			data :  data,
			type :  'POST',
	beforeSend: function() {
		jQuery('.entry-content').append( '<div class="page-modal"><div class="page-content" id="loader"><img alt="site-logo" class="site-logo" src="'+ajax_params.lurl+'"><div class="c-remodal-loader__bullets"><i class="c-remodal-loader__bullet c-remodal-loader__bullet--1"></i><i class="c-remodal-loader__bullet c-remodal-loader__bullet--2"></i><i class="c-remodal-loader__bullet c-remodal-loader__bullet--3"></i><i class="c-remodal-loader__bullet c-remodal-loader__bullet--4"></i></div></div></div><div class="clearfix"></div>' );
	},
	success: function() {
	    jQuery('.page-modal').remove();
	    jQuery(".youone-wishlist").toggleClass("active");
	    if(element.hasClass('remove')){
	        element.parent().remove();
	    }
	}
	});
	event.preventDefault();
  });
  
// Better product price ========================================================
$('#online_shop_switch').click(function(){
    if( $(this).is(':checked')) {
        $('.online_shop').slideUp();
        $('.shop-url-row').slideDown();
    } else{
        $('.shop-url-row').slideUp();
        $('.online_shop').slideDown(); 
    }
});

$('form#product_better_price_form').on('submit', function(e) {
    var online_shop = "";
    
    if ($('form#product_better_price_form input[name="online_shop_switch"]').is(":checked")) {
        online_shop = $('form#product_better_price_form input[name="online_shop_switch"]').val()
    }
    
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_params.ajaxurl,
            data: {
                'action': 'save_product_better_price_form',
                'product_id': $('form#product_better_price_form input[name="product_id"]').val(),
                'variation_id': $('.woocommerce-variation-add-to-cart input[name="variation_id"]').val(),
                'user_id': $('form#product_better_price_form input[name="user_id"]').val(),
                'online_shop': online_shop,
                'better_price': $('form#product_better_price_form input[name="better_price"]').val(),
                'shop_url': $('form#product_better_price_form input[name="shop_url"]').val(),
                'shop_name': $('form#product_better_price_form input[name="shop_name"]').val(),
                'shop_location': $('form#product_better_price_form select[name="shop_location"] option:selected').val(),
                'status': 'yes',
            },
            beforeSend: function() {
                $('#better-price__modal').modal('hide');
		        jQuery('.entry-content').append( '<div class="page-modal"><div class="page-content" id="loader"><img alt="site-logo" class="site-logo" src="'+ajax_params.lurl+'"><div class="c-remodal-loader__bullets"><i class="c-remodal-loader__bullet c-remodal-loader__bullet--1"></i><i class="c-remodal-loader__bullet c-remodal-loader__bullet--2"></i><i class="c-remodal-loader__bullet c-remodal-loader__bullet--3"></i><i class="c-remodal-loader__bullet c-remodal-loader__bullet--4"></i></div></div></div><div class="clearfix"></div>' );
            },
            success: function(data) {
                $('.page-modal').remove();
                if(data.response == true ){
                    $('.better-price-wrapper').html('');
                    $('.better-price-wrapper').text(data.message);
                    $('#better-price__modal').remove();
                }else{
                    $('.better-price-wrapper .message').text(data.message);
                }

            }
        });
        e.preventDefault()
    });
    
$('#better_price__no').on('click', function(e) {
  
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_params.ajaxurl,
            data: {
                'action': 'save_product_better_price_form',
                'product_id': $('form#product_better_price_form input[name="product_id"]').val(),
                'variation_id': $('.woocommerce-variation-add-to-cart input[name="variation_id"]').val(),
                'user_id': $('form#product_better_price_form input[name="user_id"]').val(),
                'online_shop': '',
                'better_price': '',
                'shop_url': '',
                'shop_name': '',
                'shop_location': '',
                'status': 'no',
            },
            beforeSend: function() {
                $('#better-price__modal').modal('hide');
		        jQuery('.entry-content').append( '<div class="page-modal"><div class="page-content" id="loader"><img alt="site-logo" class="site-logo" src="'+ajax_params.lurl+'"><div class="c-remodal-loader__bullets"><i class="c-remodal-loader__bullet c-remodal-loader__bullet--1"></i><i class="c-remodal-loader__bullet c-remodal-loader__bullet--2"></i><i class="c-remodal-loader__bullet c-remodal-loader__bullet--3"></i><i class="c-remodal-loader__bullet c-remodal-loader__bullet--4"></i></div></div></div><div class="clearfix"></div>' );
            },
            success: function(data) {
                $('.page-modal').remove();
                if(data.response == true ){
                    $('.better-price-wrapper').html('');
                    $('.better-price-wrapper').text(data.message);
                    $('#better-price__modal').remove();
                }else{
                    $('.better-price-wrapper .message').text(data.message);
                }

            }
        });
        e.preventDefault()
    });
// product response ============================================================
$('#duplicated_product_checkmark').click(function(){
    if( $(this).is(':checked')) {
        $('.duplicated-url-row').slideDown();
    } else{
        $('.duplicated-url-row').slideUp();
    }
});

$('form#product_response_form').on('submit', function(e) {
    var title = "";
    var img = "";
    var tech_spn = "";
    var desc = "";
    var dup = "";
    
    if ($('form#product_response_form input[name="user_feedback[\'title\']"]').is(":checked")) {
        title = $('form#product_response_form input[name="user_feedback[\'title\']"]').val()
    }
    if ($('form#product_response_form input[name="user_feedback[\'tech-specifications\']"]').is(":checked")) {
        img = $('form#product_response_form input[name="user_feedback[\'tech-specifications\']"]').val()
    }
    if ($('form#product_response_form input[name="user_feedback[\'image\']"]').is(":checked")) {
        tech_spn = $('form#product_response_form input[name="user_feedback[\'image\']"]').val()
    }
    if ($('form#product_response_form input[name="user_feedback[\'description\']"]').is(":checked")) {
        desc = $('form#product_response_form input[name="user_feedback[\'description\']"]').val()
    }
    if ($('form#product_response_form input[name="user_feedback[\'duplicate\']"]').is(":checked")) {
        dup = $('form#product_response_form input[name="user_feedback[\'duplicate\']"]').val()
    }
    
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_params.ajaxurl,
            data: {
                'action': 'save_product_response_form',
                'product_id': $('form#product_response_form input[name="product_id"]').val(),
                'user_id': $('form#product_response_form input[name="user_id"]').val(),
                'title': title,
                'img': img,
                'tech_spn': tech_spn,
                'desc': desc,
                'dup': dup,
                'duplicated_url': $('form#product_response_form input[name="duplicated_url"]').val(),
                'feedback_desc': $('form#product_response_form textarea[name="feedback_desc"]').val()
            },
            success: function(data) {
                if(data.response == true ){
                    $('#product_response_link').remove();
                    $('#product-response .message').text(data.message);
                    $('#product-response .message').removeClass('failed');
                    $('#product-response .message').addClass('success');
                    setTimeout(function() {
                        $('#product-response').modal('hide');
                        setTimeout(function() { $('#product-response').remove();}, 500);
                    }, 2000);
                }else{
                    $('#product-response .message').removeClass('success');
                    $('#product-response .message').addClass('failed');
                    $('#product-response .message').text(data.message);
                }

            }
        });
        e.preventDefault()
    });

})

/* ------------------------------ product filters ---------------------- */
function youone_product_filters(){
    jQuery("<span class=\"widget-toggle\"></span>").insertAfter("section.widget.woocommerce:not(.widget_price_filter):not(.widget_layered_nav_filters) > .widget-title");
    jQuery("<span class=\"widget-toggle opened\"></span>").insertAfter("section.widget.bigi-filter-widget.open > .widget-title");
    jQuery("<span class=\"widget-toggle\"></span>").insertAfter("section.widget.bigi-filter-widget.w-close > .widget-title");
    jQuery('.widget_product_categories .widget-toggle').addClass('opened');
    jQuery('.widget_product_search .widget-toggle').addClass('opened');

    jQuery(".widget-toggle").click(function(){
        jQuery(this).toggleClass('opened');
    });
    
    jQuery('.widget-title').click(function(){
        jQuery(this).parent().find('.widget-toggle').toggleClass('opened');
    });
    
    //footer readmore
    jQuery('.footer_more').click(function(){
        jQuery('.footer_description_inner').toggleClass('active');
        if(jQuery('.footer_description_inner').hasClass('active')){
            jQuery(this).text(jQuery(this).data('less'));
        }else{
            jQuery(this).text(jQuery(this).data('more'));
        }
    });
    
    // archive readmore
    var readmore_desc = jQuery('.woocommerce-products-header .term-description');
    var desc_height = readmore_desc.height();
    if(desc_height > 150){
        readmore_desc.addClass('readmore_desc');
        jQuery('.woocommerce-products-header').append('<span class="desc_more"></span>');
        jQuery('.desc_more').text(jQuery('.desc_more').hasClass("active") ? ajax_params.close : ajax_params.more);
    }
    jQuery('.desc_more').click(function(){
        readmore_desc.toggleClass('active');
        jQuery(this).toggleClass('active');
        if(jQuery(this).hasClass('active')){
            jQuery(this).text(ajax_params.close);
        }else{
            jQuery(this).text(ajax_params.more);
        }
    });
}

jQuery(document).ready(function(){

    youone_product_filters();
    
    function simulate_update_cart_click(){
        jQuery('button[type=submit][name=update_cart]').trigger('click');
    }

    jQuery(document).on('change', '.cart_item .qty', function(){
        simulate_update_cart_click();
    });
    
    // popup add to cart ===============================
    jQuery(document.body).on("added_to_cart", function() {
        swal.fire({
            title: ajax_params.add_to_cart_msg,
            type: 'success',
            showConfirmButton: false,
            timer: 1500
        });
    });
    
});
    

function updateQueryString(key, value, options) {
    if (!options) options = {};

    var url = options.url || location.href;
    var re = new RegExp("([?&])" + key + "=.*?(&|#|$)(.*)", "gi"), hash;

    hash = url.split('#');
    url = hash[0];
    if (re.test(url)) {
        if (typeof value !== 'undefined' && value !== null) {
            url = url.replace(re, '$1' + key + "=" + value + '$2$3');
        } else {
            url = url.replace(re, '$1$3').replace(/(&|\?)$/, '');
        }
    } else if (typeof value !== 'undefined' && value !== null) {
        var separator = url.indexOf('?') !== -1 ? '&' : '?';
        url = url + separator + key + '=' + value;
    }

    if ((typeof options.hash === 'undefined' || options.hash) &&
        typeof hash[1] !== 'undefined' && hash[1] !== null)
        url += '#' + hash[1];
    return url;
}

// type view ==================================================================
function youone_change_type_view(elm){
	
	jQuery('.type_view').removeClass('active');
	jQuery(elm).addClass('active');
	jQuery('.content-box-shop .products-box').removeClass('listing grid');
	var type_view = jQuery(elm).data('type_view');
	jQuery('.content-box-shop .products-box').addClass(type_view);
	jQuery.post( ajax_params.ajaxurl ,
	{
		action: "choose_type_view",
		type_view : jQuery(elm).data('type_view'),
	},
	function(data, status){
		//alert("Data: " + data + "\nStatus: " + status);
	});
		
}

jQuery( document.body ).on( 'updated_wc_div', function(){
    if( jQuery(document.body).find('.content-box form.woocommerce-cart-form').length == 0){
        jQuery('.sticky-sidebar').remove();
    }
});
