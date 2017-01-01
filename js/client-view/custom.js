/**
 * Template Name: Daily Shop
 * Version: 1.0
 * Template Scripts
 * Author: MarkUps
 * Author URI: http://www.markups.io/

 Custom JS


 1. CARTBOX
 2. TOOLTIP
 3. PRODUCT VIEW SLIDER
 4. POPULAR PRODUCT SLIDER (SLICK SLIDER)
 5. FEATURED PRODUCT SLIDER (SLICK SLIDER)
 6. LATEST PRODUCT SLIDER (SLICK SLIDER)
 7. TESTIMONIAL SLIDER (SLICK SLIDER)
 8. CLIENT BRAND SLIDER (SLICK SLIDER)
 9. PRICE SLIDER  (noUiSlider SLIDER)
 10. SCROLL TOP BUTTON
 11. PRELOADER
 12. GRID AND LIST LAYOUT CHANGER
 13. RELATED ITEM SLIDER (SLICK SLIDER)


 **/

jQuery(function ($) {

    /* ----------------------------------------------------------- */
    /*  2. TOOLTIP
     /* ----------------------------------------------------------- */
    jQuery('[data-toggle="tooltip"]').tooltip();
    jQuery('[data-toggle2="tooltip"]').tooltip();

    /* ----------------------------------------------------------- */
    /*  3. PRODUCT VIEW SLIDER
     /* ----------------------------------------------------------- */

    jQuery('#demo-1 .simpleLens-thumbnails-container img').simpleGallery({
        loading_image: 'demo/images/loading.gif'
    });

    jQuery('#demo-1 .simpleLens-big-image').simpleLens({
        loading_image: 'demo/images/loading.gif'
    });

    /* ----------------------------------------------------------- */
    /*  4. POPULAR PRODUCT SLIDER (SLICK SLIDER)
     /* ----------------------------------------------------------- */

    jQuery('.aa-popular-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });


    /* ----------------------------------------------------------- */
    /*  5. FEATURED PRODUCT SLIDER (SLICK SLIDER)
     /* ----------------------------------------------------------- */

    jQuery('.aa-featured-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });

    /* ----------------------------------------------------------- */
    /*  6. LATEST PRODUCT SLIDER (SLICK SLIDER)
     /* ----------------------------------------------------------- */
    jQuery('.aa-latest-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });

    /* ----------------------------------------------------------- */
    /*  7. TESTIMONIAL SLIDER (SLICK SLIDER)
     /* ----------------------------------------------------------- */

    jQuery('.aa-testimonial-slider').slick({
        dots: true,
        infinite: true,
        arrows: false,
        speed: 300,
        slidesToShow: 1,
        adaptiveHeight: true
    });

    /* ----------------------------------------------------------- */
    /*  8. CLIENT BRAND SLIDER (SLICK SLIDER)
     /* ----------------------------------------------------------- */

    jQuery('.aa-client-brand-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        autoplay: true,
        autoplaySpeed: 2000,
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });

    /* ----------------------------------------------------------- */
    /*  9. PRICE SLIDER  (noUiSlider SLIDER)
     /* ----------------------------------------------------------- */

    jQuery(function () {
        //if($('body').is('.productPage')){
        var skipSlider = document.getElementById('skipstep');
        noUiSlider.create(skipSlider, {
            range: {
                'min': 0,
                /*'10%': 10,
                 '20%': 20,
                 '30%': 30,
                 '40%': 40,
                 '50%': 50,
                 '60%': 60,
                 '70%': 70,
                 '80%': 80,
                 '90%': 90,*/
                'max': 10000
            },
            //pips: true,
            //snap: true,
            steps: 100,
            connect: true,
            start: [2000, 7000]
        });
        // for value print
        var skipValues = [
            document.getElementById('skip-value-lower'),
            document.getElementById('skip-value-upper')
        ];

        skipSlider.noUiSlider.on('update', function (values, handle) {
            skipValues[handle].innerHTML = values[handle];
        });
        //}
    });


    /* ----------------------------------------------------------- */
    /*  10. SCROLL TOP BUTTON
     /* ----------------------------------------------------------- */

    //Check to see if the window is top if not then display button

    jQuery(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.scrollToTop').fadeIn();
        } else {
            $('.scrollToTop').fadeOut();
        }
    });

    //Click event to scroll to top

    jQuery('.scrollToTop').click(function () {
        $('html, body').animate({scrollTop: 0}, 800);
        return false;
    });

    /* ----------------------------------------------------------- */
    /*  11. PRELOADER
     /* ----------------------------------------------------------- */

    jQuery(window).load(function () { // makes sure the whole site is loaded
        jQuery('#wpf-loader-two').delay(200).fadeOut('slow'); // will fade out
    })

    /* ----------------------------------------------------------- */
    /*  12. GRID AND LIST LAYOUT CHANGER
     /* ----------------------------------------------------------- */

    jQuery("#list-catg").click(function (e) {
        e.preventDefault(e);
        jQuery(".aa-product-catg").addClass("list");
    });
    jQuery("#grid-catg").click(function (e) {
        e.preventDefault(e);
        jQuery(".aa-product-catg").removeClass("list");
    });


    /* ----------------------------------------------------------- */
    /*  13. RELATED ITEM SLIDER (SLICK SLIDER)
     /* ----------------------------------------------------------- */

    jQuery('.aa-related-item-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });

});

    /* ************************** MENU ********************* */
    var menu_link = document.querySelectorAll(".categories.cat_level_2 a"),
        top_menu_links = document.querySelectorAll(".navbar-nav ul a"),
        menu_link_length = menu_link.length || top_menu_links.length
    root_link = document.querySelector(".aa-catg-nav")
    var i1 = localStorage.getItem('link_aaa') || 0

    var chekcParent = function (node1) {
        if (node1.parentNode != root_link) {
            if (node1.parentNode.tagName == "UL") {
                node1.parentNode.style.display = "block"
            }
            return arguments.callee(node1.parentNode)
        }
    }
    if (typeof menu_link[i1] != "undefined") {
        menu_link[i1].classList.add("active")
        chekcParent(menu_link[i1])
    }
    for (var i = 0; i < menu_link_length; i++) {
        var plus = document.createElement("span")
        // add id to localstorage on click
        top_menu_links[i].addEventListener("click", function (x) {
            return function () {
                localStorage.setItem('link_aaa', x)
            }
        }(i))
        // если не на главной
        if (menu_link.length == 0) continue
        menu_link[i].addEventListener("click", function (x) {
            return function () {
                localStorage.setItem('link_aaa', x)
            }
        }(i))
        // add plus icon
        plus.className = "fa fa-chevron-down"
        if (menu_link[i].nextSibling != null) {
            menu_link[i].appendChild(plus)
            // раскрытие
            plus.addEventListener("click", function (ev) {
                ev.preventDefault()
                // open
                if (this.classList[1] == "fa-chevron-down") {
                    this.classList.remove("fa-chevron-down")
                    this.classList.add("fa-chevron-up")
                    this.parentNode.nextSibling.style.display = "block"
                }// close
                else {
                    this.classList.add("fa-chevron-down")
                    this.classList.remove("fa-chevron-up")
                    this.parentNode.nextSibling.style.display = "none"
                }
            })
        }

    }

    /* ----------------------------------------------------------- */
    /*  1. LOGIN MODAL
     /*  */
    $(document).on("click", ".login-btn", function (ev) {
        ev.preventDefault()
        var data = $(this).parent().serialize(),
            elem = $(this),
            href = $(this).parent().attr("action")
        ajax4(elem, href, data)
    })
    /* ****** LOGOUT  */
    $(document).on("click", ".logout-btn", function (ev) {
        ev.preventDefault()
        //var elem = $(this),
        var elem = '',
            href = $(this).attr("href")
        ajax1(elem, href)
        window.location = window.location
    })

    /* ----------------------------------------------------------- */
    /*  1. ADD TO CART
     /* ----------------------------------------------------------- */

    $(document).on("click", ".add-to-cart2", function (ev) {
        ev.preventDefault()
        var href = $(this).attr("href"),
            elem = $(this),
            size = $(".add-to-cart-form").find(".aa-prod-view-size input:checked").val(),
            quantity = $(".add-to-cart-form").find(".aa-prod-quantity option:selected").val()
            if(size == undefined){
                $(".add-to-cart-form").find(".aa-prod-view-size .radio").addClass("alert-danger")
                return
            }else{
                $(".add-to-cart-form").find(".aa-prod-view-size .radio").removeClass("alert-danger")
            }
        var data = $.param({'size': size, 'quantity': quantity})
        ajax1(elem, href, data)
        ajax2("/cart/count") // count
    })
    /* ----------------------------------------------------------- */
    /*  1. ADD TO WHISLIST
     /* ----------------------------------------------------------- */

    $(document).on("click", ".add-to-wishlist, .aa-add-to-wish-btn", function (ev) {
        ev.preventDefault()
        var href = $(this).attr("href"),
            elem = $(this)
        ajax1(elem, href)
    })

    /* ----------------------------------------------------------- */
    /*  1. smallcart
     /* ----------------------------------------------------------- */

    jQuery(".aa-cartbox").hover(function () {
            ajax3($(this), "cart/smallcart")
            jQuery(this).find(".aa-cartbox-summary").fadeIn(500);
        }, function () {
            jQuery(this).find(".aa-cartbox-summary").fadeOut(500);
        }
    );
    /* ************** remove in smallcart ********* */
    $(document).on("click", ".aa-cartbox-summary .aa-remove-product", function (ev) {
        ev.preventDefault()
        var href = $(this).attr("href"),
            elem = $(this)
        ajax1(elem, href)
        ajax2("/cart/count")// re count
        window.location = window.location
    })
// ******************* quick view in catalog ********* */
    $(".cat_quick_mod").on("click", function (ev) {
        ev.preventDefault()
        var href = $(this).attr("href"),
            target_id = $(this).data("target")
        ajax5(target_id, href)
    })
    /* ************** ADD TO CART or WHISHLIST ************ */
    function ajax1(elem, href, data) {
        $.ajax({
            url: href,
            type: "post",
            data: data,
            beforeSend: function () {
                if (elem.length)
                    elem.prepend("<span class='fa fa-spinner fa-spin'></span>")
            },
            success: function (data) {
                if (elem.length)
                    elem.find(".fa-spin").remove()
                //console.log(data, "good!")
            },
            error: function (xhr) {
                if (elem.length)
                    elem.find(".fa-spin").remove()
                //console.log(xhr.responseText)
            }
        })
    }

    /* ****************  COUNT IN SMALL CART *************** */
    function ajax2(href) {
        $.ajax({
            url: href,
            type: "get",
            success: function (data) {
                localStorage.setItem("cart_count", data)
                $(".aa-cartbox .aa-cart-notify").text(data)
            },
            error: function (xhr) {
                console.log(xhr.responseText)
            }
        })
    }

    ajax2("/cart/count")
    if (localStorage.getItem("cart_count") != null) {
        $(".aa-cartbox .aa-cart-notify").text(localStorage.getItem("cart_count"))
    }
    /* ******************  ELEMENTS IN SMALL CART  ********************* */
    function ajax3(elem, href) {
        $.ajax({
            url: href,
            type: "get",
            success: function (data) {
                elem.find(".aa-cartbox-summary").html(data)
            },
            error: function (xhr) {
                console.log(xhr.responseText)
            }
        })
    }

    /* ******************* LOGIN FORM ************************* */
    function ajax4(elem, href, data) {
        $.ajax({
            url: href,
            type: "post",
            data: data,
            beforeSend: function () {
                elem.prepend("<span class='fa fa-spin fa-spinner'></span>")
            },
            success: function (data) {
                elem.find(".fa-spinner").remove()
                $(".alert").remove()
                elem.parent().prepend(data)
            },
            error: function (xhr) {
                elem.find(".fa-spinner").remove()
                console.log(xhr.responseText)
            }
        })
    }

    /* ******************************  QUICK MODAL IN CATALOG ********** */
    function ajax5(target_id, href) {
        $.ajax({
            url: href,
            type: "get",
            success: function (data) {
                $(target_id).html(data)
                /* ----------------------------------------------------------- */
                /*  3. PRODUCT VIEW SLIDER
                 /* ----------------------------------------------------------- */
                setTimeout(function () {
                    jQuery(target_id + ' .simpleLens-thumbnails-container img').simpleGallery();
                    jQuery(target_id + ' .simpleLens-big-image').simpleLens();
                }, 500)
            },
            error: function (xhr) {
                $(target_id).html(xhr.responseText)
            }
        })
    }

    /* **************** */
