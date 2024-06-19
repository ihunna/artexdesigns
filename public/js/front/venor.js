(function ($) {
    'use strict';

    function debounce(func, wait) {
        let timeout;
        return function () {
            const context = this, args = arguments;
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(context, args), wait);
        };
    }

    $(document).ready(function () {

        /*==============================
        Menu
        ==============================*/
        $('.header__btn__venor').on('click', function() {
            $(this).toggleClass('header__btn--active');
            $('.header__menu__venor').toggleClass('header__menu__venor--active');
        });

        $('.header__search__venor .close, .header__action--search button').on('click', function() {
            $('.header__search__venor').toggleClass('header__search--active');
        });

        $(".header__menu__venor .header__nav > li > a").each(function () {
            const link = $(this).attr('href');
            if (link === window.location.href) {
                $(this).addClass('active');
            }
        });

        if ($('.pace-cover').length) {
            Pace.on('done', function() {
                window.sr = ScrollReveal();

                const elementsToReveal = [
                    { selector: '.slider-content h1.active', delay: 200 },
                    { selector: '.slider-content h2.active', delay: 300 },
                    { selector: '.slider-content .slider-body.active', delay: 400 },
                    { selector: '.slider-venor-section .header-social-share', delay: 500 },
                    { selector: 'h4.about-heading1-home', delay: 300 },
                    { selector: 'h3.about-heading2-home', delay: 400 },
                    { selector: 'h3.about-heading2-home span', delay: 450 },
                    { selector: '.about-section p', delay: 500 },
                    { selector: '.about-section ul', delay: 600 },
                    { selector: '.about-section .btn.btn-style1', delay: 600 },
                    { selector: '.exp-about', delay: 700 },
                    { selector: '.services-section h3', delay: 300 },
                    { selector: '.description-services p', delay: 300 },
                    { selector: '.service-boxes-slider', delay: 300 },
                    { selector: 'h3.fun-facts-heading1', delay: 100 },
                    { selector: '.fun-facts-section p', delay: 200 },
                    { selector: '.row.fun-facts-timer .col-md-3:nth-child(1) .radial', delay: 300 },
                    { selector: '.row.fun-facts-timer .col-md-3:nth-child(2) .radial', delay: 400 },
                    { selector: '.row.fun-facts-timer .col-md-3:nth-child(3) .radial', delay: 500 },
                    { selector: '.row.fun-facts-timer .col-md-3:nth-child(4) .radial', delay: 600 },
                    { selector: '.portfolio-section h4', delay: 200 },
                    { selector: '.portfolio-section h3', delay: 250 },
                    { selector: '.project-box-div > a', delay: 300 },
                    { selector: '.project-number', delay: 350 },
                    { selector: '.project-category', delay: 400 },
                    { selector: '.project-meta-title', delay: 450 },
                    { selector: '.portfolio-section .project-button', delay: 500 },
                    { selector: '.portfolio-slider .owl-nav', delay: 600 },
                    { selector: '.portfolio-slider .owl-dots', delay: 650 },
                    { selector: '.testimonial-section .container > h3', delay: 300 },
                    { selector: '.testimonial-section .container > p', delay: 350 },
                    { selector: '.testimonial-section-slider', delay: 400 },
                    { selector: 'h3.blog-section-subtitle', delay: 300 },
                    { selector: '.blog-section .blog-section-title', delay: 400 },
                    { selector: '.blog-section article.blog-single-post', delay: 500 },
                    { selector: '.banner-section h1.banner-title', delay: 300 },
                    { selector: '.banner-section p.banner-desc', delay: 400 },
                    { selector: '.banner-section .header-social-share', delay: 500 },
                    { selector: '.about-us p', delay: 300 },
                    { selector: '.about-us ul', delay: 400 },
                    { selector: '.about-us .btn.btn-style1', delay: 600 },
                    { selector: '.members-section h3.members-heading1', delay: 300 },
                    { selector: '.members-section .venor-team', delay: 400 },
                    { selector: '.clients-slider', delay: 50 }
                ];

                elementsToReveal.forEach(function (item) {
                    sr.reveal(item.selector, { scale: 1, duration: 500, delay: item.delay, reset: true });
                });
            });
        }

        $('[data-tooltip-tit]').hover(function() {
            $('<div class="div-tooltip-tit"></div>').text($(this).attr('data-tooltip-tit')).appendTo('.avo-tooltip').fadeIn('slow')
        }, function() {
            $('.div-tooltip-tit').remove()
        }).mousemove(function(e) {
            $('.div-tooltip-tit').css({ top: e.clientY + 10, left: e.clientX + 20 })
        });

        $('[data-tooltip-sub]').hover(function() {
            $('<div class="div-tooltip-sub"></div>').text($(this).attr('data-tooltip-sub')).appendTo('.avo-tooltip').fadeIn('slow')
        }, function() {
            $('.div-tooltip-sub').remove()
        }).mousemove(function(e) {
            $('.div-tooltip-sub').css({ top: e.clientY + 60, left: e.clientX + 20 })
        });

        /*==============================
        Multi level dropdowns
        ==============================*/
        $('ul.dropdown-menu [data-toggle="dropdown"]').on('click', function(event) {
            event.preventDefault();
            event.stopPropagation();
            $(this).siblings().toggleClass('show');
        });

        $(document).on('click', function () {
            $('.dropdown-menu').removeClass('show');
        });

        /* HOME SLIDE */
        $(window).on("load", function() {
            $('body:not(.rtl) .slider-venor, body.rtl .slider-venor').owlCarousel({
                loop: false,
                rewind: true,
                animateIn: 'fadeIn',
                animateOut: 'fadeOut',
                mouseDrag: false,
                touchDrag: false,
                margin: 10,
                // lazyLoad: true, // Disabled lazy load
                responsiveClass: true,
                smartSpeed: 500,
                autoplayTimeout: 8000,
                dots: false,
                navText: ["<i class='fas fa-angle-double-left'></i>", "<i class='fas fa-angle-double-right'></i>"],
                responsive: {
                    0: { items: 1, nav: true },
                    600: { items: 1, nav: true },
                    1000: { items: 1, nav: true }
                }
            });
        });

        /* HOME ABOUT PARALLAX */
        if ($(window).width() > 768) {
            const img1 = document.getElementsByClassName('thumparallax');
            new simpleParallax(img1, { delay: 2 });

            const img2 = document.getElementsByClassName('thumparallax-down');
            new simpleParallax(img2, { delay: 2, orientation: 'down' });
        }

        /* FUN FACTS COUNTS */
        if ($('#fun-facts').length) {
            function isScrolledIntoView(el) {
                const rect = el.getBoundingClientRect();
                return rect.top >= 0 && rect.bottom <= window.innerHeight;
            }

            $(window).on('scroll', debounce(function(e) {
                if (isScrolledIntoView(document.getElementById('fun-facts'))) {
                    $('.timer').countTo();
                    $(window).off(e);
                }
            }, 200));
        }

        /* SERVICES BOXES */
        $('body:not(.rtl) .service-boxes-slider, .rtl .service-boxes-slider').owlCarousel({
            autoplay: false,
            loop: false,
            smartSpeed: 500,
            autoplayTimeout: 6000,
            margin: 10,
            nav: true,
            arrows: true,
            dots: true,
            responsiveClass: true,
            responsive: {
                0: { items: 1 },
                600: { items: 2 },
                1000: { items: 3 }
            }
        });

        $('body:not(.rtl) .portfolio-slider').owlCarousel({
            autoplay: false,
            loop: false,
            smartSpeed: 500,
            autoplayTimeout: 6000,
            margin: 10,
            nav: true,
            arrows: true,
            dots: true,
            responsiveClass: true,
            responsive: {
                0: { items: 1 },
                600: { items: 2 },
                1000: { items: 3 }
            }
        });

        $('.rtl .portfolio-slider').owlCarousel({
            rtl: true,
            autoplay: false,
            loop: false,
            smartSpeed: 500,
            autoplayTimeout: 6000,
            margin: 10,
            nav: true,
            arrows: true,
            dots: true,
            responsiveClass: true,
            responsive: {
                0: { items: 1 },
                600: { items: 2 },
                1000: { items: 3 }
            }
        });

        /* TESTIMONIAL */
        $('body:not(.rtl) .testimonial-section-slider').owlCarousel({
            loop: true,
            autoplay: true,
            smartSpeed: 500,
            autoplayTimeout: 4000,
            nav: false,
            arrows: false,
            dots: false,
            loop: true,
            responsiveClass: true,
            responsive: {
                0: { items: 1 },
                600: { items: 2 },
                1000: { items: 2 }
            }
        });

        $('.rtl .testimonial-section-slider').owlCarousel({
            rtl: true,
            autoplay: true,
            smartSpeed: 500,
            autoplayTimeout: 4000,
            nav: false,
            arrows: false,
            dots: false,
            loop: true,
            responsiveClass: true,
            responsive: {
                0: { items: 1 },
                600: { items: 2 },
                1000: { items: 2 }
            }
        });

        /* SIDEBAR */
        jQuery('.header-burger').on("click", function() {
            jQuery('body').toggleClass('menu-open');
            jQuery(this).toggleClass('open-menu');
            jQuery(this).parent().find('#navbar').toggleClass('hidden');
            jQuery('.fixed-sidebar-menu-overlay').toggleClass('visible');
        });
        jQuery('.fixed-sidebar-menu-overlay').on("click", function() {
            jQuery('body').removeClass('menu-open');
            jQuery(this).removeClass('visible');
            jQuery('.side_panel_sidebar').removeClass('open-menu');
        });

        jQuery(document).on("keyup", function(e) {
            if (e.keyCode == 27) {
                jQuery('body').removeClass('menu-open');
                jQuery('.fixed-sidebar-menu-overlay').removeClass('visible');
                jQuery('.side_panel_sidebar').removeClass('open-menu');
            }
        });

        /* back to top */
        var progressPath = document.querySelector('.progress-wrap path');
        var pathLength = progressPath.getTotalLength();
        progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
        progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
        progressPath.style.strokeDashoffset = pathLength;
        progressPath.getBoundingClientRect();
        progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';
        var updateProgress = function () {
            var scroll = $(window).scrollTop();
            var height = $(document).height() - $(window).height();
            var progress = pathLength - (scroll * pathLength / height);
            progressPath.style.strokeDashoffset = progress;
        }
        updateProgress();
        $(window).scroll(updateProgress);
        var offset = 50;
        var duration = 550;
        jQuery(window).on('scroll', function() {
            if (jQuery(this).scrollTop() > offset) {
                jQuery('.progress-wrap').addClass('active-progress');
            } else {
                jQuery('.progress-wrap').removeClass('active-progress');
            }
        });
        jQuery('.progress-wrap').on('click', function(event) {
            event.preventDefault();
            jQuery('html, body').animate({scrollTop: 0}, duration);
            return false;
        })

        /* CLIENTS */
        $('body:not(.rtl) .clients-slider').owlCarousel({
            loop: true,
            // lazyLoad: true, // Disabled lazy load
            autoplay: true,
            smartSpeed: 500,
            autoplayTimeout: 4000,
            margin: 15,
            nav: false,
            arrows: false,
            dots: false,
            responsiveClass: true,
            responsive: {
                0: { items: 1 },
                600: { items: 3 },
                1000: { items: 4 }
            }
        });

        $('.rtl .clients-slider').owlCarousel({
            rtl: true,
            loop: true,
            // lazyLoad: true, // Disabled lazy load
            autoplay: true,
            smartSpeed: 500,
            autoplayTimeout: 4000,
            margin: 15,
            nav: false,
            arrows: false,
            dots: false,
            responsiveClass: true,
            responsive: {
                0: { items: 1 },
                600: { items: 3 },
                1000: { items: 4 }
            }
        });

        if (jQuery('.gallery').length) {
            jQuery('.gallery').magnificPopup({
                delegate: 'a',
                type: 'image',
                gallery: {
                    enabled: true
                },
                // other options
            });
        }

        if (jQuery('.popup-vimeo-video').length) {
            $(".popup-vimeo-video").magnificPopup({
                type: "iframe",
                removalDelay: 160,
                preloader: false,
                fixedContentPos: false
            });
        }

        jQuery(window).on("scroll", function() {
            (jQuery(window).scrollTop() > 250 && jQuery(window).width() > 1200 && (
                jQuery("body").addClass("sticky"),
                jQuery(".header-burger .burger").addClass("animated fadeInDown"),
                jQuery(".header__content__venor").addClass("animated fadeInDown"
                )),
                jQuery(window).scrollTop() < 250 && (jQuery("body").removeClass("sticky"),
                    jQuery(".header-burger .burger").removeClass("animated fadeInDown"),
                    jQuery(".header__content__venor").removeClass("animated fadeInDown")))

        }), jQuery(window).resize(function() {
            jQuery(window).width() < 1200 && jQuery("body").removeClass("sticky")
        });

    });
} (jQuery));

// Lazy loading removal
/*
!function(window){
  var $q = function(q, res){
        if (document.querySelectorAll) {
          res = document.querySelectorAll(q);
        } else {
          var d=document
            , a=d.styleSheets[0] || d.createStyleSheet();
          a.addRule(q,'f:b');
          for(var l=d.all,b=0,c=[],f=l.length;b<f;b++)
            l[b].currentStyle.f && c.push(l[b]);

          a.removeRule(0);
          res = c;
        }
        return res;
      }
    , addEventListener = function(evt, fn){
        window.addEventListener
          ? this.addEventListener(evt, fn, false)
          : (window.attachEvent)
            ? this.attachEvent('on' + evt, fn)
            : this['on' + evt] = fn;
      }
    , _has = function(obj, key) {
        return Object.prototype.hasOwnProperty.call(obj, key);
      }
    ;

  function loadImage (el, fn) {
    var img = new Image()
      , src = el.getAttribute('data-src');
    img.onload = function() {
      if (!! el.parent)
        el.parent.replaceChild(img, el)
      else
        el.src = src;

      fn? fn() : null;
    }
    img.src = src;
  }

  function elementInViewport(el) {
    var rect = el.getBoundingClientRect()

    return (
       rect.top    >= 0
    && rect.left   >= 0
    && rect.top <= (window.innerHeight || document.documentElement.clientHeight)
    )
  }

    var images = new Array()
      , query = $q('img.lazy')
      , processScroll = function(){
          for (var i = 0; i < images.length; i++) {
            if (elementInViewport(images[i])) {
              loadImage(images[i], function () {
                images.splice(i, i);
              });
            }
          };
        }
      ;
    // Array.prototype.slice.call is not callable under our lovely IE8 
    for (var i = 0; i < query.length; i++) {
      images.push(query[i]);
    };

    processScroll();
    addEventListener('scroll',processScroll);

}(this);

function BackgroundNode({node, loadedClassName}) {
    let src = node.getAttribute('data-background-image-url');
    let show = (onComplete) => {
        requestAnimationFrame(() => {
            node.style.backgroundImage = `url(${src})`
            node.classList.add(loadedClassName);
            onComplete();
        })
    }

    return {
        node,

        // onComplete is called after the image is done loading.
        load: (onComplete) => {
            let img = new Image();
            img.onload = show(onComplete);
            img.src = src;
        }
    }
}

let defaultOptions = {
    selector: '[data-background-image-url]',
    loadedClassName: 'loaded'
}

function BackgroundLazyLoader({selector, loadedClassName} = defaultOptions) {
    let nodes = [].slice.apply(document.querySelectorAll(selector))
        .map(node => new BackgroundNode({node, loadedClassName}));

    let callback = (entries, observer) => {
        entries.forEach(({target, isIntersecting}) => {
            if (!isIntersecting) {
                return;
            }

            let obj = nodes.find(it => it.node.isSameNode(target));

            if (obj) {
                obj.load(() => {
                    // Unobserve the node:
                    observer.unobserve(target);
                    // Remove this node from our list:
                    nodes = nodes.filter(n => !n.node.isSameNode(target));

                    // If there are no remaining unloaded nodes,
                    // disconnect the observer since we don't need it anymore.
                    if (!nodes.length) {
                        observer.disconnect();
                    }
                });
            }
        })
    };

    let observer = new IntersectionObserver(callback);
    nodes.forEach(node => observer.observe(node.node));
};

BackgroundLazyLoader();
*/

function offset(element) {
  const bodyRect = document.body.getBoundingClientRect()
  const elemRect = element.getBoundingClientRect()
  return elemRect.top - bodyRect.top;
}

function handler(event) {
    const progress = document.querySelector('.progress-wrap');
    const header = document.querySelector('.logo-chat');
    const dark = document.querySelectorAll('.light-section');

    const headerOffset = offset(header)
    const headerHeight = header.clientHeight;

    const check = [...dark].some(section => {
        const sectionOffset = offset(section);
        const sectionHeight = section.clientHeight;

        const topCheck = headerOffset + headerHeight / 2 >= sectionOffset;
        const bottomCheck = headerOffset + headerHeight / 2 < sectionOffset + sectionHeight

        if (topCheck && bottomCheck) {
            return true
        }
    })

    if (check) {
        header.classList.add('light')
        header.classList.remove('dark')

        progress.classList.add('light')
        progress.classList.remove('dark')
    } else {
        header.classList.add('dark')
        header.classList.remove('light')

        progress.classList.add('dark')
        progress.classList.remove('light')
    }
}

['scroll', 'resize'].forEach(function(e) {
  window.addEventListener(e, handler);
});
