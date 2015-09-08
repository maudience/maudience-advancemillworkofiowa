;(function($, window, document, undefined) {
	var $win = $(window);
	var $doc = $(document);

	$.fn.equalizeHeight = function() {
	    var maxHeight = 0, itemHeight;
	 
	    for (var i = 0; i < this.length; i++) {
	        itemHeight = $(this[i]).height();
	        if (maxHeight < itemHeight) {
	            maxHeight = itemHeight;
	        }
	    }
	 
	    return this.height(maxHeight);
	}

	$doc.bind('gform_post_render', function(){
		$('.section-search label').inFieldLabels();
    });

	$doc.ready(function() {
		$('.gallery-image').magnificPopup({
			delegate: 'a',
			type: 'image',
			tLoading: 'Loading image #%curr%...',
			mainClass: 'mfp-img-mobile',
			gallery: {
				enabled: true,
				navigateByImgClick: true,
				preload: [0,1]
			},
			image: {
				titleSrc: function(item) {
					return item.el.attr('title');
				}
			}
		});


		$('.popup-youtube').magnificPopup({
		    type: 'iframe',
		});

		$('.section-search label').inFieldLabels();

		$('.slider .slide .video-btn, .video-btn-alt').on('click', function() {
			var $sliderVideo = $(this);
			$sliderVideo.parents('li')
				.addClass('show-video')
					.siblings()
					.removeClass('show-video');
		});

		$('.menu-btn').on('click', function(e) {
			var $this = $(this);

			$('.nav').toggleClass('show');

			e.preventDefault();
		});

		if (screen.width < 767 ){
			$('.header .nav li:has(.sub-menu) > a').click(function(e){
		    	e.preventDefault();
			    e.stopPropagation();
			    $(this).parent().addClass('clicked_link');
			});
		}

		$('.nav li.return-link a').on('click', function(event) {
			var minHeight = 0;

			if ( $('.nav > ul > li').hasClass('clicked_link') ) {
				$('.nav > ul > li').removeClass('clicked_link');
				minHeight = $('.nav li ul:visible').height();
			} else {
				$('.nav > ul').removeClass('clicked_link');
				minHeight = $('.nav > ul').height();
			}			

			$('.nav').css('height', minHeight );

			event.preventDefault();
		});
	});

	$win.on('load', function() {
	    var $container = $('.portfolioContainer');
	    $container.isotope({
	        filter: '*',
	        animationOptions: {
	            duration: 750,
	            easing: 'linear',
	            queue: false
	        }
	    });
	 
	    $('.portfolioFilter a').click(function(){
	        $('.portfolioFilter .current').removeClass('current');
	        $(this).addClass('current');
	 
	        var selector = $(this).attr('data-filter');
	        $container.isotope({
	            filter: selector,
	            animationOptions: {
	                duration: 750,
	                easing: 'linear',
	                queue: false
	            }
	         });
	         return false;
	    });
	    $(".about").equalizeHeight();
	    if ( $win.width() > 767 ) { 
	   		// $(".about").equalizeHeight();
	    	
	    	$(".slide-content-alt .alt").equalizeHeight();
	    }

	    if ( $win.width() < 767 ) { 
	    	$(".nav .menu").equalizeHeight();
	    }

	    if ( $('.slider .slides').length ) {
			$('.slider .slides').carouFredSel({
				auto: false,
				circular: true,
		        infinite: true,
		        height: 'variable',
		        width: '100%',
			    align: 'center',			    
			    items: {
					visible: 3,
					start: 0,
					height: 'variable',
					width: 'variable',
				},
				// swipe: {
				// 	onTouch: true
				// },
				scroll: {
					items: 1,
					duration: 1000,
					timeoutDuration: 3000
				},
				prev: {
					button: '.slider .slider-prev'
				},
				next: {
					button: '.slider .slider-next'
				},
				pagination: '.slider-paging'
			});
		}

		$('.slider').animate({
			'opacity': 1
		}, 300);
	});

	$win.resize(function(){
   		$(".about").equalizeHeight();
	})
})(jQuery, window, document);