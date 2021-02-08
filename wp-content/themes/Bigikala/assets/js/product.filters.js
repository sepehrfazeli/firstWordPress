jQuery(document).ready(function(){
    jQuery("<span class=\"widget-toggle\"></span>").insertAfter("section.widget.woocommerce:not(.widget_price_filter):not(.widget_layered_nav_filters) > .widget-title");
    
    jQuery('.widget_product_categories .widget-toggle').addClass('opened');
    jQuery('.widget_product_search .widget-toggle').addClass('opened');

    jQuery(".widget-toggle").click(function(){
        jQuery(this).toggleClass('opened');
    });
    
    
    jQuery('.instock_product').click(function(e){
        e.preventDefault();
        e.stopPropagation();
        console.log(jQuery(this).hasClass("checked"));
        if(jQuery(this).hasClass("checked")){
            window.location.href = updateQueryString("oinstock", "");
        } else{
            window.location.href = updateQueryString("oinstock", "true");
        }
    });
    
    jQuery('.widget-title').click(function(){
        jQuery(this).parent().find('.widget-toggle').toggleClass('opened');
    })
    
    
    
    
    
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