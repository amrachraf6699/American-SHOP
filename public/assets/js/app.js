(function (window, document, $, undefined) {
    'use strict';

    var llInit = {
        i: function (e) {
            llInit.s();
            llInit.methods();
        },

        s: function (e) {
            this._window = $(window),
                this._document = $(document),
                this._body = $('body'),
                this._html = $('html')
        },

        methods: function (e) {
            llInit.w();
            llInit.preloader();
            llInit.stickyCategory();
            llInit.popupAccount();
            llInit.ProductRange();
            llInit.ContactValidate();
            llInit.CountDown();
            llInit.llBackToTop();
            llInit.stickyHeaderMenu();
            llInit.mobileMenuActivation();
            llInit.salActivation();
            llInit.llSwepActivation();
            llInit.llSwepSliderActivation();
            llInit.llProductSlickActivation();
            llInit.DealProductSlickActivation();
            llInit.ImageBox();
            llInit.tiltAnimation();
            llInit.menuLinkActive();

        },

        w: function (e) {
            this._window.on('load', llInit.l).on('scroll', llInit.res)
        },

        preloader: function () {
            $("#preloader").fadeOut();
        },

        stickyCategory: function () {
            var categoryList = $('.category-menu');
            var menuIcon = $('#menuIcon');

            categoryList.on('click', function () {
                $('.category-submenu').toggleClass('show');
            })

            $('body').on('click', function (event) {
                if (!$(event.target).closest('.category-menu').length && !$(event.target).hasClass('category-menu')) {
                    $('.category-submenu').removeClass('show');
                }
            });
        },

        popupAccount: function () {
            $(".btn-close-popup, .box-cart-overlay").on("click", function (e) {
                e.preventDefault();
                $(".box-cart-wrapper").removeClass("active");
                $(".box-popup-cart").css("visibility", "hidden");
            });

            $(".btn-close-popup-account, .box-account-overlay").on("click", function (e) {
                e.preventDefault();
                $(".popup-account").hide();
            });


            $("a.account-icon.cart").on("click", function (e) {
                e.preventDefault();
                $(".box-popup-cart").css("visibility", "visible");
                $(".box-cart-wrapper").addClass("active");
            });

            $("a.account-icon.login").on("click", function (e) {
                $(".popup-account").show();
            });

            $(".btn-login").on("click", function (e) {
                e.preventDefault();
                $(".popup-account").hide();
            });

            $(".button-tab").on("click", function (e) {
                e.preventDefault();
                $(".button-tab").removeClass("active");
                $(this).addClass("active");
                if ($(this).hasClass("btn-for-login")) {
                    $(".form-login").show();
                    $(".form-register").hide();
                }
                if ($(this).hasClass("btn-for-signup")) {
                    $(".form-login").hide();
                    $(".form-register").show();
                }
            });

            $(".login-now").on("click", function (e) {
                e.preventDefault();
                $(".button-tab").removeClass("active");
                $(".btn-for-login").addClass("active");
                $(".form-login").show();
                $(".form-register").hide();
                $(".form-account-info").show();
                $(".form-password-info").hide();
            });

            $(".register-now").on("click", function (e) {
                e.preventDefault();
                $(".button-tab").removeClass("active");
                $(".btn-for-login").addClass("active");
                $(".form-login").show();
                $(".form-register").hide();
                $(".form-account-info").hide();
                $(".form-password-info").show();
                $(".form-registerd-info").hide();
            });

            $(".buttun-forgotpass").on("click", function (e) {
                e.preventDefault();
                $(".form-account-info").hide();
                $(".form-password-info").show();
            });


            $(".btn-register").on("click", function (e) {
                e.preventDefault();
                $(".form-account-info").hide();
                $(".form-password-info").hide();
                $(".form-registerd-info").show();
            });

            $(".list-sizes .item-size").on("click", function () {
                $(".list-sizes .item-size").removeClass("active");
                $(this).addClass("active");
            });


        },

        ProductRange: function () {
            var rangeOne = document.querySelector('input[name="rangeOne"]'),
                rangeTwo = document.querySelector('input[name="rangeTwo"]'),
                outputOne = document.querySelector('.outputOne'),
                outputTwo = document.querySelector('.outputTwo'),
                inclRange = document.querySelector('.incl-range');

            function updateView() {
                if (!rangeOne || !rangeTwo || !inclRange) {
                    return;
                }

                if (this.getAttribute('name') === 'rangeOne') {
                    outputOne.innerHTML = this.value;
                } else {
                    outputTwo.innerHTML = this.value;
                }

                var maxValue = parseInt(this.getAttribute('max'));
                if (!isNaN(maxValue)) {
                    var value1 = parseInt(rangeOne.value);
                    var value2 = parseInt(rangeTwo.value);
                    var width = Math.abs(value1 - value2) / maxValue * 100 + '%';
                    var left = Math.min(value1, value2) / maxValue * 100 + '%';
                    inclRange.style.width = width;
                    inclRange.style.left = left;
                }
            }

            document.addEventListener('DOMContentLoaded', function () {
                if (rangeOne && rangeTwo && inclRange) {
                    rangeOne.value = 100;
                    rangeTwo.value = 300;

                    updateView.call(rangeOne);
                    updateView.call(rangeTwo);

                    $('input[type="range"]').on('mouseup', function () {
                        this.blur();
                    }).on('mousedown input', function () {
                        updateView.call(this);
                    });
                }
            });
        },

        ContactValidate: function () {
            var contactDetails = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(contactDetails)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        },

        CountDown: function () {
            function startCountdown() {
                const daysElement = document.getElementById("days");
                const hoursElement = document.getElementById("hours");
                const minutesElement = document.getElementById("minutes");
                const secondsElement = document.getElementById("seconds");
        
                // Check if countdown elements exist
                if (!daysElement || !hoursElement || !minutesElement || !secondsElement) {
                    console.error("One or more countdown elements not found.");
                    return;
                }
        
                const countdownDate = new Date("2025-05-01T00:00:00").getTime();
        
                const countdownInterval = setInterval(function () {
                    const now = new Date().getTime();
                    const distance = countdownDate - now;
        
                    if (distance < 0) {
                        clearInterval(countdownInterval);
                        daysElement.innerHTML = hoursElement.innerHTML = minutesElement.innerHTML = secondsElement.innerHTML = "0";
                        return;
                    }
        
                    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
                    daysElement.innerHTML = days;
                    hoursElement.innerHTML = hours;
                    minutesElement.innerHTML = minutes;
                    secondsElement.innerHTML = seconds;
                }, 1000);
            }
        
            if (document.getElementById("days") && document.getElementById("hours") && document.getElementById("minutes") && document.getElementById("seconds")) {
                startCountdown();
            }
        },
        
        llBackToTop: function () {
            var btn = $('#backto-top');
            $(window).on('scroll', function () {
                if ($(window).scrollTop() > 300) {
                    btn.addClass('show');
                } else {
                    btn.removeClass('show');
                }
            });
            btn.on('click', function (e) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: 0
                }, '300');
            });
        },

        ImageBox: function () {
            var MainImg = document.getElementById('MainImg');
            var SmallImg = document.getElementsByClassName('small-img');

            for (var i = 0; i < SmallImg.length; i++) {
                SmallImg[i].onclick = function () {
                    MainImg.src = this.src;
                }
            }
        },

        stickyHeaderMenu: function () {
            $(window).on('scroll', function () {
                // Sticky Class Add
                if ($('body').hasClass('sticky-header')) {
                    var stickyPlaceHolder = $('#ll-sticky-placeholder'),
                        menu = $('.header-mainmenu'),
                        menuH = menu.outerHeight(),
                        topHeaderH = $('.ll-header-top').outerHeight() || 0,
                        targrtScroll = topHeaderH + 200;
                    if ($(window).scrollTop() > targrtScroll) {
                        menu.addClass('ll-sticky');
                        stickyPlaceHolder.height(menuH);
                    } else {
                        menu.removeClass('ll-sticky');
                        stickyPlaceHolder.height(0);
                    }
                }
            });
        },

        mobileMenuActivation: function (e) {

            $('.menu-item-has-children > a').append('<span class="submenu-toggle-btn"></span>');

            $('.menu-item-has-children > a .submenu-toggle-btn').on('click', function (e) {

                var targetParent = $(this).parents('.mainmenu-nav'),
                    target = $(this).parent().siblings('.ll-submenu'),
                    targetSiblings = $(this).parents('.menu-item-has-children').siblings().find('.ll-submenu');

                if (targetParent.hasClass('offcanvas')) {
                    $(target).slideToggle(400);
                    $(targetSiblings).slideUp(400);
                    $(this).parents('.menu-item-has-children').toggleClass('open');
                    $(this).parents('.menu-item-has-children').siblings().removeClass('open');
                }

            });

            function resizeClassAdd() {
                if (window.matchMedia('(min-width: 992px)').matches) {
                    $('body').removeClass('mobilemenu-active');
                    $('#mobilemenu-popup').removeClass('offcanvas show').removeAttr('style');
                    $('.ll-mainmenu .offcanvas-backdrop').remove();
                    $('.ll-submenu').removeAttr('style');
                } else {
                    $('body').addClass('mobilemenu-active');
                    $('#mobilemenu-popup').addClass('offcanvas');
                    $('.menu-item-has-children > a').on('click', function (e) {
                        e.preventDefault();
                    });
                }
            }

            $(window).on('resize', function () {
                resizeClassAdd();
            });

            resizeClassAdd();
        },

        salActivation: function () {
            sal({
                threshold: 0.1,
                once: true
            });
        },

        llSwepActivation: function () {
            $(".swiper-7-items").each(function () {
                var swiper_7_items = new Swiper(this, {
                    spaceBetween: 15,
                    slidesPerView: 7,
                    slidesPerGroup: 1,
                    loop: true,
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                    pagination: {
                        el: ".swiper-pagination-items-7",
                        clickable: true
                    },
                    autoplay: {
                        delay: 10000
                    },
                    breakpoints: {
                        1399: {
                            slidesPerView: 7
                        },
                        1200: {
                            slidesPerView: 6
                        },
                        991: {
                            slidesPerView: 5
                        },
                        767: {
                            slidesPerView: 4
                        },
                        575: {
                            slidesPerView: 3
                        },
                        400: {
                            slidesPerView: 1
                        },
                        300: {
                            slidesPerView: 1
                        }
                    }
                });
            });
        },

        llSwepSliderActivation: function () {
            $(".swiper-6-items").each(function () {
                var swiper_6_items = new Swiper(this, {
                    spaceBetween: 15,
                    slidesPerView: 6,
                    slidesPerGroup: 1,
                    loop: true,
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                    pagination: {
                        el: ".swiper-pagination-items-6",
                        clickable: true
                    },
                    autoplay: {
                        delay: 10000
                    },
                    breakpoints: {
                        1399: {
                            slidesPerView: 6
                        },
                        900: {
                            slidesPerView: 4
                        },
                        700: {
                            slidesPerView: 3
                        },
                        550: {
                            slidesPerView: 2
                        },
                        400: {
                            slidesPerView: 2
                        },
                        350: {
                            slidesPerView: 1
                        },
                        320: {
                            slidesPerView: 1
                        }
                    }
                });
            });
        },

        DealProductSlickActivation: function () {
            $(".dealing-top-products").slick({
                slidesToShow: 6,
                slidesToScroll: 1,
                centerPadding: '10px',
                dots: false,
                focusOnSelect: true,
                prevArrow: '<div class="slide-arrow-left"><i class="fas fa-chevron-left"></i></div>',
                nextArrow: '<div class="slide-arrow-right"><i class="fas fa-chevron-right"></i></div>',
                responsive: [
                    {
                        breakpoint: 1199,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 1,
                            infinite: true,
                        }
                    },
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 1,
                            infinite: true,
                        }
                    },
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 440,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        },

        llProductSlickActivation: function () {
            $(".banner-slider").slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true,
                focusOnSelect: true,
                prevArrow: false,
                nextArrow: false,
            });
        },

        menuLinkActive: function () {
            var currentPage = location.pathname.split("/"),
                current = currentPage[currentPage.length - 1];
            $('.mainmenu li a, .main-navigation li a').each(function () {
                var $this = $(this);
                if ($this.attr('href') === current) {
                    $this.addClass('active');
                    $this.parents('.menu-item-has-children').addClass('menu-item-open open')
                }
            });
        },

        tiltAnimation: function () {
            var _tiltAnimation = $('.paralax-image');
            if (_tiltAnimation.length) {
                _tiltAnimation.tilt({
                    max: 12,
                    speed: 1e3,
                    easing: 'cubic-bezier(.03,.98,.52,.99)',
                    transition: !1,
                    perspective: 1e3,
                    scale: 1
                })
            }
        },


    }
    llInit.i();

})(window, document, jQuery);