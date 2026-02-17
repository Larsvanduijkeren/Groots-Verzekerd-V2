jQuery.noConflict();

(function ($) {
    $(document).ready(function () {
        smoothScroll();
        menu();
        headerController();
        megaMenus();
        reviewSlider();
        accordion();
        postIndex();
        headerUsps();
        scrollToTop();
        teamSlider();
        timelineSlider();
        matchForm();

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

    let scrollToTop = () => {
        $('.to-top').on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({ scrollTop: 0 }, 600);
        });
    }

    let headerUsps = () => {
        let slider = $(".top-bar .usps");

        if (slider && slider.length > 0) {
            slider.slick({
                autoplay: true,
                dots: false,
                arrows: false,
                variableWidth: false,
                slidesToShow: 3,
                responsive: [
                    {
                        breakpoint: 1300,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 1,
                        }
                    }
                ]
            });
        }
    };

    let postIndex = () => {
        let indexItem = $(".post-content .content h2");
        let didScroll = false;

        indexItem.each(function (index) {
            let title = $(this).text();

            let slug = "item-" + index;

            $(this).attr("id", slug);

            $(".post-content .index").append("<a data-ref=\"" + slug + "\" href=\"#" + slug + "\">" + title + "</a>");
        });
    };

    const accordion = () => {
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

    const timelineSlider = () => {
        let slider = $("section.timeline .slider");

        if (slider && slider.length > 0) {
            slider.slick({
                infinite: false,
                dots: false,
                arrows: true,
                variableWidth: true,
            });
        }
    }

    const teamSlider = () => {
        let slider = $("section.team-selection .slider");

        if (slider && slider.length > 0) {
            slider.slick({
                infinite: false,
                dots: true,
                arrows: false,
                slidesToShow: 4,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 1440,
                        settings: {
                            slidesToShow: 3,
                        }
                    },,
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 1,
                        }
                    }
                ]
            });
        }
    }

    const reviewSlider = () => {
        let slider = $("section.review-slider .card");

        if (slider && slider.length > 0) {
            slider.slick({
                infinite: false,
                dots: true,
                arrows: false,
                slidesToShow: 1,
                slidesToScroll: 1,
                fade: true,
            });
        }
    }

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

    const matchForm = () => {
        $('section.match-form').each(function () {
            const $section = $(this);
            const $form = $section.find('.match-questions-form');
            const $error = $section.find('.match-form-error');
            const $matchCheckStep = $section.find('.step.match-check');
            const $matchFormStep = $section.find('.step.match-form-step');
            const $noMatchStep = $section.find('.step.no-match');

            $form.find('input[type="radio"]').on('change', function () {
                $error.addClass('hide');
            });

            $form.on('submit', function (e) {
                e.preventDefault();
                $error.addClass('hide');

                let allAnswered = true;
                let allYes = true;
                $section.find('.match-question').each(function () {
                    const selected = $(this).find('input[type="radio"]:checked');
                    if (!selected.length) {
                        allAnswered = false;
                    } else if (selected.val() !== 'yes') {
                        allYes = false;
                    }
                });

                if (!allAnswered) {
                    $error.removeClass('hide');
                    return;
                }

                $matchCheckStep.addClass('hide');
                $matchFormStep.addClass('hide');
                $noMatchStep.addClass('hide');

                if (allYes) {
                    $matchFormStep.removeClass('hide');
                } else {
                    $noMatchStep.removeClass('hide');
                }
            });
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

