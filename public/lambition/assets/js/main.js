    "use strict";


    /*--
        preloader
    -----------------------------------*/
     $(window).on('load', function(event) {
        $('.preloader').delay(500).fadeOut(500);
    });
    

    /*--
        Header Sticky
    -----------------------------------*/

    window.onscroll = function () {
        const left = document.getElementById("header");

        if (left.scrollTop > 50 || self.pageYOffset > 50) {
            left.classList.add("sticky")
        } else {
            left.classList.remove("sticky");
        }
    }    


    /*--
        header_search
    -----------------------------------*/
    
    $(".header-search").each(function(){  
        $(".search-btn", this).on("click", function(e){

            e.preventDefault();
            e.stopPropagation();

            $(".header-search-content").toggleClass("on");

                if ($('.header-search a').hasClass('open')) {

                    $( ".header-search a i" ).removeClass('flaticon-close').addClass('flaticon-loupe');
                    
                    $(this).removeClass('open').addClass('sclose');    

                } 

                else {
                    $(".header-search a").removeClass('sclose').addClass('open');

                    $( ".header-search a i" ).removeClass('flaticon-loupe').addClass('flaticon-close');  
                    
                }
            });

    });


   
    /*--
        Shopping Cart
    -----------------------------------*/

	$(".header-cart").on("click", function () {

		$(".shopping-cart").addClass("cart-opened");

		$(".body-overlay").addClass("opened");

	});


	$(".body-overlay").on("click", function () {

		$(".shopping-cart").removeClass("cart-opened");

		$(".body-overlay").removeClass("opened");

	});




    /*--
        Menu parent Element Icon
    -----------------------------------*/
    const $subMenu = document.querySelectorAll('.sub-menu');
    $subMenu.forEach(function (subMenu) {
        const menuExpand = document.createElement('span')
        menuExpand.classList.add('menu-icon')
        // menuExpand.innerHTML = '+'
        subMenu.parentElement.insertBefore(menuExpand, subMenu)
        if (subMenu.classList.contains('mega-menu')) {
            subMenu.classList.remove('mega-menu')
            subMenu.querySelectorAll('ul').forEach(function (ul) {
                ul.classList.add('sub-menu')
                const menuExpand = document.createElement('span')
                menuExpand.classList.add('menu-icon')
                menuExpand.innerHTML = '+'
                ul.parentElement.insertBefore(menuExpand, ul)
            })
        }
    })

    
    /*--
        Mobile Menu 
    -----------------------------------*/

    /* Get Sibling */
    const getSiblings = function (elem) {
        const siblings = []
        let sibling = elem.parentNode.firstChild
        while (sibling) {
            if (sibling.nodeType === 1 && sibling !== elem) {
                siblings.push(sibling)
            }
            sibling = sibling.nextSibling
        }
        return siblings
    }

    /* Slide Up */
    const slideUp = (target, time) => {
        const duration = time ? time : 500;
        target.style.transitionProperty = 'height, margin, padding'
        target.style.transitionDuration = duration + 'ms'
        target.style.boxSizing = 'border-box'
        target.style.height = target.offsetHeight + 'px'
        target.offsetHeight
        target.style.overflow = 'hidden'
        target.style.height = 0
        window.setTimeout(() => {
            target.style.display = 'none'
            target.style.removeProperty('height')
            target.style.removeProperty('overflow')
            target.style.removeProperty('transition-duration')
            target.style.removeProperty('transition-property')
        }, duration)
    }

    /* Slide Down */
    const slideDown = (target, time) => {
        const duration = time ? time : 500;
        target.style.removeProperty('display')
        let display = window.getComputedStyle(target).display
        if (display === 'none') display = 'block'
        target.style.display = display
        const height = target.offsetHeight
        target.style.overflow = 'hidden'
        target.style.height = 0
        target.offsetHeight
        target.style.boxSizing = 'border-box'
        target.style.transitionProperty = 'height, margin, padding'
        target.style.transitionDuration = duration + 'ms'
        target.style.height = height + 'px'
        window.setTimeout(() => {
            target.style.removeProperty('height')
            target.style.removeProperty('overflow')
            target.style.removeProperty('transition-duration')
            target.style.removeProperty('transition-property')
        }, duration)
    }

    /* Slide Toggle */
    const slideToggle = (target, time) => {
        const duration = time ? time : 500;
        if (window.getComputedStyle(target).display === 'none') {
            return slideDown(target, duration)
        } else {
            return slideUp(target, duration)
        }
    }


    /*--
		Offcanvas/Collapseable Menu 
	-----------------------------------*/
    const offCanvasMenu = function (selector) {

        const $offCanvasNav = document.querySelector(selector),
            $subMenu = $offCanvasNav.querySelectorAll('.sub-menu');
        $subMenu.forEach(function (subMenu) {
            const menuExpand = document.createElement('span')
            menuExpand.classList.add('menu-expand')
            // menuExpand.innerHTML = '+'
            subMenu.parentElement.insertBefore(menuExpand, subMenu)
            if (subMenu.classList.contains('mega-menu')) {
                subMenu.classList.remove('mega-menu')
                subMenu.querySelectorAll('ul').forEach(function (ul) {
                    ul.classList.add('sub-menu')
                    const menuExpand = document.createElement('span')
                    menuExpand.classList.add('menu-expand')
                    menuExpand.innerHTML = '+'
                    ul.parentElement.insertBefore(menuExpand, ul)
                })
            }
        })

        $offCanvasNav.querySelectorAll('.menu-expand').forEach(function (item) {
            item.addEventListener('click', function (e) {
                e.preventDefault()
                const parent = this.parentElement
                if (parent.classList.contains('active')) {
                    parent.classList.remove('active');
                    parent.querySelectorAll('.sub-menu').forEach(function (subMenu) {
                        subMenu.parentElement.classList.remove('active');
                        slideUp(subMenu)
                    })
                } else {
                    parent.classList.add('active');
                    slideDown(this.nextElementSibling)
                    getSiblings(parent).forEach(function (item) {
                        item.classList.remove('active')
                        item.querySelectorAll('.sub-menu').forEach(function (subMenu) {
                            subMenu.parentElement.classList.remove('active');
                            slideUp(subMenu)
                        })
                    })
                }
            })
        })
    }
    offCanvasMenu('.offcanvas-menu');


    /*--
		Mousemove Parallax
	-----------------------------------*/
    var b = document.getElementsByTagName("BODY")[0];  

    b.addEventListener("mousemove", function(event) {
    parallaxed(event);

    });

    function parallaxed(e) {
        var amountMovedX = (e.clientX * -0.3 / 8);
        var amountMovedY = (e.clientY * -0.3 / 8);
        var x = document.getElementsByClassName("parallaxed");
        var i;
        for (i = 0; i < x.length; i++) {
            x[i].style.transform='translate(' + amountMovedX + 'px,' + amountMovedY + 'px)'
        }
    }


    /*--
        Testimonial Active
	-----------------------------------*/
      var swiper = new Swiper('.testimonial-active', {
        slidesPerView: 3,
        spaceBetween: 30,
        loop: true,
        navigation: {
          nextEl: '.testimonial-active .swiper-button-next',
          prevEl: '.testimonial-active .swiper-button-prev',
        },
        pagination: {
            el: ".testimonial-active .swiper-pagination",
            clickable: true,
        },
        breakpoints: {
          0: {
            slidesPerView: 1,
          },
          576: {
            slidesPerView: 1,
          },
          768: {
            slidesPerView: 2,
          },
          992: {
            slidesPerView: 3,
          }
        }
    });

    /*--
        Testimonial-2 Active
	-----------------------------------*/
    var swiper = new Swiper('.testimonial-2-active', {
        slidesPerView: 1,
        loop: true,
        navigation: {
          nextEl: '.testimonial-2-active .swiper-button-next',
          prevEl: '.testimonial-2-active .swiper-button-prev',
        },
    });

    /*--
        Testimonial-4 Active
	-----------------------------------*/
    var swiper = new Swiper('.testimonial-4-active', {
        slidesPerView: 1,
        loop: true,
        navigation: {
          nextEl: '.testimonial-4-active .swiper-button-next',
          prevEl: '.testimonial-4-active .swiper-button-prev',
        },
    });



    /*--
		magnificPopup video view 
	-----------------------------------*/	
	$('.popup-video').magnificPopup({
		type: 'iframe'
	});


    /*--    
        Brand Active
    -----------------------------------*/
    var swiper = new Swiper(".brand-active .swiper-container", {
        slidesPerView: 4,
        spaceBetween: 30,
        loop: true,
        breakpoints: {
          0: {
            slidesPerView: 1,
          },
          576: {
            slidesPerView: 2,
            spaceBetween: 20,
          },
          768: {
            slidesPerView: 3,
          },
          992: {
            slidesPerView: 4,
          },
        },
    });


     /*--
      Isotope Project  
    -----------------------------------*/
    $('.container').imagesLoaded(function () {
        var $grid = $('.grid').isotope({
    
        });
        
        // filter items on button click
        $('.top-courses-filter ul').on( 'click', 'li', function() {
          var filterValue = $(this).attr('data-filter');
          $grid.isotope({ filter: filterValue });
        });
        
        //for menu active class
        $('.top-courses-filter ul li').on('click', function (event) {
            $(this).siblings('.active').removeClass('active');
            $(this).addClass('active');
            event.preventDefault();
        });
    });


    /*--
        AOS
    -----------------------------------*/
    
    AOS.init({
        duration: 1200,
        once: true,
    });


/*--    
    Counter Up
-----------------------------------*/  

$('.counter').counterUp({
    delay: 10,
    time: 1500,
});

/*--    
    Progress Bar
-----------------------------------*/  

if($('.progress-line').length) {
    $('.progress-line').appear(function(){
        var el = $(this);
        var percent = el.data('width');
        $(el).css('width', percent+'%');
    }, {accY: 0});
   }



    /*--
        Back To Top
    -----------------------------------*/

    // Scroll Event
    $(window).on('scroll', function () {
        var scrolled = $(window).scrollTop();
        if (scrolled > 300) $('.back-btn').addClass('active');
        if (scrolled < 300) $('.back-btn').removeClass('active');
    });

    // Click Event
    $('.back-btn').on('click', function () {
        $("html, body").animate({
            scrollTop: "0"
        }, 1200);
    });

