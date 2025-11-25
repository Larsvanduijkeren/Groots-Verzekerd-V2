jQuery.noConflict();

(function ($) {
    $(document).ready(function () {
        smoothScroll();
        menu();
        accordion();
        headerController();
        megaMenus();

        if ($(window).width() > 991) {
            lenis();

            AOS.init({
                offset: 50,
                duration: 1000,
            });
        } else {
            AOS.init({
                offset: 50,
                duration: 600,
            });
        }
    });

    let megaMenus = () => {
        let menuTriggers = [];

        for (let i = 1; i <= 10; i++) {
            menuTriggers.push(`trigger-menu-${i}`);
        }

        menuTriggers.forEach(function (className) {
            $(`.${className}`).addClass('has-mega-menu');
        });

        $('header, .mobile-nav').on('click', '.has-mega-menu', function (e) {
            e.preventDefault();

            let className = $(this).attr('class').split(/\s+/)[0];

            if ($(this).hasClass('active')) {
                closeAllMenus();
            } else {
                closeAllMenus();
                $(this).addClass('active');
                $('body').addClass('mega-menu-open');
                $(`.mega-menu[data-trigger=${className}]`).addClass('active');
            }
        });

        $('.mega-menu .overlay, .hamburger, .mega-menu .go-back').click(closeAllMenus);

        function closeAllMenus() {
            $('header li.has-mega-menu, .mobile-nav li').removeClass('active');
            $('.mega-menu').removeClass('active');
            $('body').removeClass('mega-menu-open');
        }
    };

    let headerController = function () {
        let scrollWrapper = $(window);
        let body = $("body");

        if (scrollWrapper.scrollTop() > 0) {
            body.addClass("scrolled");
        }

        scrollWrapper.scroll(function () {
            if (scrollWrapper.scrollTop() > 10) {
                body.addClass("scrolled");
            } else {
                body.removeClass("scrolled");
            }
        });
    };

    let accordion = () => {
        let list = $(".accordion");

        if (list) {
            list.accordion({
                collapsible: true,
                active: false,
                header: "h4",
                heightStyle: "content",
            });
        }

        $(".accordion .question").click(function () {
            if ($(this).find(".ui-accordion-header").hasClass("ui-state-active")) {
                $(".accordion .question").removeClass("open");
                $(this).addClass("open");
            } else {
                $(".accordion .question").removeClass("open");
            }
        });
    };

    let lenis = () => {
        const lenis = new Lenis();

        function raf(time) {
            lenis.raf(time);
            requestAnimationFrame(raf);
        }

        requestAnimationFrame(raf);
    };

    let smoothScroll = function () {
        $(document).on("click", "a[href^=\"#\"]", function (event) {
            event.preventDefault();

            $("html, body").animate({
                scrollTop: $($.attr(this, "href")).offset().top - 120,
            }, 500);
        });
    };

    var menu = function () {
        $('.mobile-nav .menu-item-has-children > a').on('click', function (e) {
            e.preventDefault();
            console.log('hold');
            $(this).toggleClass('open');
        });

        $(".hamburger").click(function () {
            $("body").toggleClass("mobile-nav-open");

            setTimeout(function () {
                $("body, html").toggleClass("no-scroll");
            }, 500);
        });
    };
})(jQuery);

