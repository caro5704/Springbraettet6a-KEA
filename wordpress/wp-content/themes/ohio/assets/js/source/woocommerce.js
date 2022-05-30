(function ($) {
    'use strict';

    /* Table of contents */
    /*
		# Shop masonry
		# Ajax cart
		# Search action
		# Single product gallery
		# Sticky product
		# Products grid
		# Zoom product
		# Product quickview
    */

    /* # Mini cart */

    $('[aria-label="cart"]').on("click", function (e) {
        e.preventDefault();
        $(".cart-mini").toggleClass("visible");
    });

    $('[aria-label="close"]').on("click", function () {
        $(".cart-mini").removeClass("visible");
    });

	/* # Shop masonry */

	function handleShopMasonry() {
		var shopMasonry = $('[data-shop-masonry]');
		if ( !$('body').hasClass('elementor-page')) {
			shopMasonry.each(function(){

				var product = $(this).find('> li.product');
	
				if (shopMasonry && !shopMasonry.parents('.shop-product-type_3').length && product.length > 1 ) {
					shopMasonry.masonry({
						percentPosition: true,
						columnWidth: ' .product:not(.double_width)'
					});
				}
			})
		}
	}

    /* # Ajax cart */

    jQuery(function ($) {

        $(".input-text.qty.text").on('keyup mouseup', function () {
            var value = $(this).val();
            $("#product_quantity").val(value)
        });

        $(document).on('click', '.single_add_to_cart_button', function (e) {

            if ($(this).hasClass('out_of_stock') || $(this).hasClass('product_type_variable') || $(this).closest('form').hasClass('external-product') || $(this).hasClass('product_type_external') || ( !$(this).hasClass('single_add_to_cart_button') && $(this).parents('ul.products') ) ) return;

            e.preventDefault();

            var $variation_form = $(this).closest('.variations_form');
            var var_id = $variation_form.find('input[name=variation_id]').val();
            var product_id = $variation_form.find('input[name=product_id]').val();
            var quantity = $variation_form.find('input[name=quantity]').val();

            $('.ajaxerrors').remove();
            var item = {},
                check = true;
            var variations = $variation_form.find('select[name^=attribute]');
            if (!variations.length) {
                variations = $variation_form.find('[name^=attribute]:checked');
            }
            if (!variations.length) {
                variations = $variation_form.find('input[name^=attribute]');
            }
            variations.each(function () {
                var $this = $(this),
                    attributeName = $this.attr('name'),
                    attributevalue = $this.val(),
                    index,
                    attributeTaxName;
                $this.removeClass('error');
                if (attributevalue.length === 0) {
                    index = attributeName.lastIndexOf('_');
                    attributeTaxName = attributeName.substring(index + 1);
                    $this.addClass('required error');
                    if ( !$this.parent().find('.please-select-message').length ) {
                        $this.before('<span class="please-select-message">' + $variation_form.data('please-select-message') + ' ' + attributeTaxName + '</span>')
                    }

                    check = false;
                } else {
                    item[attributeName] = attributevalue;
                }
            });

            if (!check) {
				if ($(this).hasClass('sticky-product-cart')) {
					$(this).removeClass('btn-loading');
					alert(wc_add_to_cart_variation_params.i18n_make_a_selection_text);
				}
                return false;
            }

            var $thisbutton = $(this);
            
            if ($thisbutton.is('.single_add_to_cart_button')) {
                $thisbutton.removeClass('added');
                $thisbutton.addClass('loading');

                if ( $('form.cart').hasClass('woo_c-cart-form') ) {
                    var serializeFormFields = $('form.cart').serializeArray();
                    
                    var data = {};
					var prevObj;

					$(serializeFormFields).each(function (index, obj) {

						if (obj.name == prevObj) {
							obj.index = index;
						}

						prevObj = obj.name
                    });

                    $(serializeFormFields ).each(function(index, obj){
						if (obj.index) {
							obj.name = obj.name + "-" + obj.index;
						}

                        data[obj.name] = obj.value;
                    });
    
                    data.action = 'ohio_ajax_add_to_cart_woo';

                    if ( $thisbutton.is('.sticky-product-cart') ) {
                        if ($('.single_variation_wrap').length && $('.single_variation_wrap').find('.single_add_to_cart_button.wc-variation-is-unavailable').length ) {
                            alert($thisbutton.data('unavailable-message'));
                            $thisbutton.removeClass('btn-loading loading');
                        }
                    }
                } else if ( $thisbutton.parents('.product-item-buttons').length ) {

                    var product_id = $thisbutton.siblings("input[name=product_id]").val();
                    var data = {
                        action: 'ohio_ajax_add_to_cart_woo_single',
                        product_id: product_id,
                        quantity: 1
                    };
                } else {

                    var serializeFormFields = $('form.cart').serializeArray();

                    var data = {};
                    $(serializeFormFields ).each(function(index, obj){
                        data[obj.name] = obj.value;
                    });
                    
                    if ( data['product_id'] == undefined) {
                        data['product_id'] = data['add-to-cart'];
                    }

                    delete data['add-to-cart'];

                    data.action = 'ohio_ajax_add_to_cart_woo';
                }

                $('body').trigger('adding_to_cart', [$thisbutton, data]);
                $.post(wc_cart_fragments_params.ajax_url, data, function (response) {
                    if (!response)
                        return;

                    var this_page = window.location.toString();
                    this_page = this_page.replace('add-to-cart', 'added-to-cart');
                    if (response.error && response.product_url) {

                        window.location = response.product_url;
                        return;
                    }

                    if (window.wc_add_to_cart_params && window.wc_add_to_cart_params.cart_redirect_after_add == 'yes') {
                        window.location = wc_add_to_cart_params.cart_url;
                        return;
                    } else {
                        $thisbutton.removeClass('loading');
                        var fragments = response.fragments;
                        var cart_hash = response.cart_hash;
                        if (fragments) {
                            $.each(fragments, function (key) {
                                $(key).addClass('updating');
                            });
                        }
                        $('.shop_table.cart, .updating, .cart_totals').fadeTo('400', '0.6').block({
                            message: null,
                            overlayCSS: {
                                opacity: 0.6
                            }
                        });
                        $thisbutton.addClass('added');
                        $thisbutton.text($thisbutton.data('product-added-text'));

                        var $classes = '';
                        if (($('body').hasClass('single-product') || $thisbutton.parents('.clb-popup').length) && !$thisbutton.hasClass('sticky-product-cart')) {
                            $classes = ' button view-cart';
                        } else if ($thisbutton.hasClass('sticky-product-cart')) {
                            $classes = $classes + ' button -text view-cart';
                        } else {
                            $classes = $classes + ' button view-cart';
                        }

                        $thisbutton.after('<a href="' + ohioVariables.cart_page + '" class="' + $classes + '">' + ohioVariables.view_cart + '</a>');
                        $thisbutton.css('display', 'none');

                        if (fragments) {
                            $.each(fragments, function (key, value) {
                                $(key).replaceWith(value);
                            });
                        }

                        $('.widget_shopping_cart, .updating').stop(true).css('opacity', '1').unblock();
                        $('.shop_table.cart').on('load', this_page + ' .shop_table.cart:eq(0) > *', function () {
                            $('.shop_table.cart').stop(true).css('opacity', '1').unblock();
                            $(document.body).trigger('cart_page_refreshed');
                        });
                        $('.cart_totals').on('load', this_page + ' .cart_totals:eq(0) > *', function () {
                            $('.cart_totals').stop(true).css('opacity', '1').unblock();
                        });

                        var productName = '';
                        if ($thisbutton.closest('.product').find('h1').length > 0) {
                            productName = $thisbutton.closest('.product').find('h1').text();
                        } else {
                            productName = $thisbutton.closest('.product').find('.woo-product-name').text();
                        }
                        if (productName == '') {
                            productName = $thisbutton.closest('.clb-popup-product').find('h1').text();
                        }
						miniCartTextButton();
                        $('footer').before('<div class="woo-alert-group "><div class="ajax-cart-response alert -small -fixed -success">' + productName + ' ' + ohioVariables.add_to_cart_message + '<a class="view_cart_button" href="' + ohioVariables.cart_page + '">' + ohioVariables.view_cart + '</a><button class="icon-button -small" aria-label=close> <i class="icon"><svg class="default" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 1.41L12.59 0L7 5.59L1.41 0L0 1.41L5.59 7L0 12.59L1.41 14L7 8.41L12.59 14L14 12.59L8.41 7L14 1.41Z"></path></svg><svg class="minimal" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M15.7552 0.244806C16.0816 0.571215 16.0816 1.10043 15.7552 1.42684L1.42684 15.7552C1.10043 16.0816 0.571215 16.0816 0.244806 15.7552C-0.0816021 15.4288 -0.0816021 14.8996 0.244806 14.5732L14.5732 0.244806C14.8996 -0.0816019 15.4288 -0.0816019 15.7552 0.244806Z"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M15.7552 15.7552C15.4288 16.0816 14.8996 16.0816 14.5732 15.7552L0.244807 1.42684C-0.0816013 1.10043 -0.0816013 0.571215 0.244807 0.244806C0.571215 -0.0816021 1.10043 -0.0816021 1.42684 0.244806L15.7552 14.5732C16.0816 14.8996 16.0816 15.4288 15.7552 15.7552Z"></path></svg></i></button></div></div>');
                    }
                });
                return false;
            } else {
                return true;
            }
        });
    });

	/* # Search action */

	$(document).on('click', '.search-results_btn', function(){
    	$('.search-woocommerce').trigger('submit');
    });

	/* Search action to keyup */

    $('.search-woocommerce input[name=s]').on("keyup", function (event) {
        if (!$('.search-woocommerce .search-submit').hasClass('btn-loading')) {
            $('.search-woocommerce .search-submit').addClass('btn-loading');
        }

        var form = $(this).closest('form');
        var data = {
            'action': 'ohio_ajax_search',
            'search_query': $(this).val(),
            'search_term': $('select[name="search_term"]').val()
        };

        $.post(ohioVariables.url, data, function (response) {
            $('.search-results').empty();
            $('.search-woocommerce .search-submit').removeClass('btn-loading');
            $('.search-results').append(response);
            form.attr('action', $('#search_form_action').attr('data-href'));


			$('body').trigger('ohio:btn-preloader');
        });
    });

    /* Search action to focus */

    $('.search-woocommerce input[name=s]').on("focus", function (event) {

        if ($('.search-results').children().length == 0) {
            if (!$('.search-woocommerce .search-submit').hasClass('btn-loading')) {
                $('.search-woocommerce .search-submit').addClass('btn-loading');
            }

            var form = $(this).closest('form');
            var data = {
                'action': 'ohio_ajax_search',
                'search_query': $(this).val(),
                'search_term': $('select[name="search_term"]').val()
            };

            $.post(ohioVariables.url, data, function (response) {
                $('.search-results').empty();
                $('.search-woocommerce .search-submit').removeClass('btn-loading');
                $('.search-results').append(response);
                form.attr('action', $('#search_form_action').attr('data-href'));

				$('body').trigger('ohio:btn-preloader');
            });
        }
    });

    /* Search action to select category */

    $(document).on('change', '.search-woocommerce select', function(){
        if (!$('.search-woocommerce .search-submit').hasClass('btn-loading')) {
            $('.search-woocommerce .search-submit').addClass('btn-loading');
        }

        var form = $(this).closest('form');
        var data = {
            'action': 'ohio_ajax_search',
            'search_query': $('input[name=s]').val(),
            'search_term': $('select[name="search_term"]').val()
        };

        $.post(ohioVariables.url, data, function (response) {
            $('.search-results').empty();
            $('.search-woocommerce .search-submit').removeClass('btn-loading');
            $('.search-results').append(response);
            form.attr('action', $('#search_form_action').attr('data-href'));
        });
    });

    /* # Single product gallery */

    function handleSingleProductGallery(scrollContainer, product) {

        if (scrollContainer === undefined) {
            var scrollContainer = $('body, html');
        }

        if (product === undefined) {
            var product = $('.woo-product.single-product');
        }

        var productImages = product.find('.woo-product-image .image-wrap img');

        if ( productImages.length > 1 && !product.find('.product-thumbs').length) {
            
            if ( !product.parents('.clb-popup-product').length ) {
                var data = 'data-ohio-content-scroll="#scroll-product"';
            }

            var productContainer = product.find('.woo-product-image').addClass('with-gallery');

            var imageDots = $('<div class="product-thumbs -sticky-block" ' + data + '></div>');

            imageDots.prependTo(productContainer);

            productImages.each(function(i){
                var clonedImg = $(this).clone();
                var dotImage = $('<div class="product-thumb" ></div>');

                clonedImg.appendTo(dotImage);
                dotImage.appendTo(imageDots);
                if (i == 0) {
                    dotImage.addClass('active');
                }
            });

            if (!product.parents('.clb-popup').length) {
                imageDots.css('height', imageDots.height());
            }
            

            var productOffset = product.offset().top;
            var productImageSlider = product.find('.woo-product-image-slider');

            productImageSlider.css({
                'width': productImageSlider.outerWidth()
            });

            var productImageDots = $('.product-thumb');

            var imagesOffset = [];

            if (product.parents('.clb-popup-product').length) {
                var sumHeight = 0;
                productImages.each(function(){
                    var imgHeight = $(this).height();
                    imagesOffset.push(sumHeight);
                    sumHeight += imgHeight;
                });
            } else {
                productImages.each(function(){
                    imagesOffset.push($(this).offset().top);
                });
            }

            //Slider
            var iteration = 0;

            productImageDots.on('click', function(){
                $('.product-thumb').removeClass('active');
                $(this).addClass('active');
                var index = $('.product-thumb').index(this);
                iteration = index;
                var curentImage = $(productImages[index]);
                scrollContainer.animate({
                    scrollTop: imagesOffset[iteration]
                }, 500)
            });

            scrollContainer.on('scroll wheel', function(e){
                var y = e.originalEvent.deltaY;

                if (($(this).scrollTop() >= imagesOffset[iteration]) && y > 0) {
                    productImageDots.removeClass('active');
                    $(productImageDots[iteration]).addClass('active');
                    iteration++;
                }
                else if (y < 0 && ($(this).scrollTop() >= imagesOffset[iteration - 1] && $(this).scrollTop() < imagesOffset[iteration])) {
                    iteration--;
                    productImageDots.removeClass('active');
                    $(productImageDots[iteration]).addClass('active');
                }

                if (iteration > productImages.length - 1 && y < 0) {
                    iteration--;
                }
            });
        }
        var singleProductGallery = $('.woocommerce-product-gallery');
		
        if ($(window).width() <= 1024) {
            singleProductGallery.clbSlider({
                dots: false,
                drag: true,
                navBtn: true
            });
        } else {
            setTimeout(function(){
                singleProductGallery.clbSlider('destroy');
            }, 400);
        }
    }

	/* # Sticky product */
    
    function handleStickyProduct() {
        var productImg = $('.woo-product-image');
        var stickyProduct = $('.sticky-product');
        var stickyProductImg = stickyProduct.find('.sticky-product-thumbnail');
        var stickyProductNav = $('.sticky-nav-product');

        $(window).scroll(function () {
            if ($(window).scrollTop() > productImg.height()) {
                stickyProduct.addClass('visible');
                stickyProductNav.addClass('hidden');
            } else {
                stickyProduct.removeClass('visible');
                stickyProductNav.removeClass('hidden');
            }
        });

        if (Clb.isMobile) {
            var contentWidth = $('#content').height();
            var contentOffset = $('#content').offset().top;
            var contentEnd = contentWidth + contentOffset - $(window).height();

            $(window).scroll(function () {
                if ($(window).scrollTop() > contentEnd) {
                    stickyProduct.removeClass('visible');
                }
            });
        }

        stickyProductImg.on("click", function () {
            $('body, html').animate({scrollTop: 0}, 500);
        });

        stickyProduct.find('[aria-label="close"]').on('click', function(){
            stickyProduct.removeClass('visible');
            setTimeout(function(){
                stickyProduct.hide;
            }, 300);
        });
    }

	/* # Products grid */

	function handleProductsGridGallery() {
		var productSlider = $('.product-item-grid .slider');
		var parentSlider = productSlider.parents('.slider');

		productSlider.each(function(){
			var slider = $(this);

			if ($('body').hasClass('elementor-page')) {
				if (parentSlider.length) {
					//Slider inside slider case
					setTimeout(function(){
						slider.width(slider.width());
					}, 200);
				} else {
					slider.width(slider.width());
				}
			}


			if (slider.find('img').length > 1) {
				if (parentSlider) {
					//Slider inside slider case
					setTimeout(function(){
						slider.clbSlider({
							dots: false,
							loop: true,
							navBtnClasses: ''
						});
					}, 200);
				} else {
					slider.clbSlider({
						dots: false,
						loop: true,
						navBtnClasses: ''
					});
				}

			}
		});

		setTimeout(function(){
			handleShopMasonry();
		}, 1000);
	} 

	/* # Zoom product */

	function handleZoomProductImage() {
        $('.woo-product-image.with-zoom .product_images .image-wrap')
        .on('mouseover', function(){
        $(this).find('img').css({'transform': 'scale(1.5)'});
        })
        .on('mouseout', function(){
        $(this).find('img').css({'transform': 'scale(1)'});
        })
        .on('mousemove', function(e){
        $(this).find('img').css({'transform-origin': ((e.pageX - $(this).offset().left) / $(this).width()) * 100 + '% ' + ((e.pageY - $(this).offset().top) / $(this).height()) * 100 +'%'});
        })
    }

    /* # Product quickview */

    function handleQuickviewPopup(items) {
        var link;

        if (items === undefined ) {
            link = $('.button-quickview');
        } else {
            link = items.find('.button-quickview');
        }

        link.on("click", function (event) {
            event.preventDefault
            $('.container-loading').removeClass('hidden');

			$('body').data('ohio:quickview-data', '.clb-popup.custom-popup');
			$('body').trigger('ohio:quickview');

            var link = $(this);

            $.ajax({
                url: ohioVariables.url,
                data: {
                    action: 'ohio_product_modal',
                    product_id: $(this).attr('data-product-id'),
                },
                dataType: 'html',
                type: 'POST',
                success: function (data) {
                    var popupInner = $('.custom-popup .clb-popup-holder').addClass('clb-popup-product');
                    popupInner.siblings('[data-button-loading]').removeClass('btn-loading');
                    popupInner.append(data);

                    // Add link for title
                    var productTitle = $('.clb-popup-product .woo-product-details-title');
                    var productLink = link.parent().find('.slider a');

                    productTitle.wrap('<div class="product-popup-title-link"><a href=' + productLink.attr('href') + ' target="_blank"></a></div>');

                    $('.container-loading').addClass('hidden');

					$('body').trigger('ohio:btn-preloader');

                    setTimeout(function(){
                        handleSingleProductGallery(popupInner.find('.woo-product'), popupInner.find('.post-' + link.attr('data-product-id') + ''));
                    }, 50);

                    popupInner.find('.woo-product-details-variations').wc_variation_form();
                }
            });
        });
    }

	function miniCartTextButton() {
		var cart = $('.woocommerce-mini-cart__buttons .button:not(.checkout)');

		cart.addClass('-text');
	}

	$(window).on('load', function () {
		handleShopMasonry();
		handleStickyProduct();
		handleSingleProductGallery();
		handleZoomProductImage();
		handleQuickviewPopup();
		miniCartTextButton();
		handleProductsGridGallery();

		$('body').on('ohio:lazy_load_complete', function(){
			handleQuickviewPopup($('body').data('lazy-items'));
			handleProductsGridGallery();
		});
	});

	var mobileResizeWidth = $(window).width();

	$(window).on('resize', function () {
		handleShopMasonry();

		//For disebling resize trigger on mobile scroll
		if($(window).width() !== mobileResizeWidth){
			handleSingleProductGallery();
			handleProductsGridGallery();
		}
	});

})(jQuery);