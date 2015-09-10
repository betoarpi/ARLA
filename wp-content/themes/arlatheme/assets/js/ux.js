$(function(){
	//BX Slider
	$('.bxslider').bxSlider({
		auto: false,
		autoHover: true,
		pause: 500,
		speed: 1000,
		pager: false,
		controls: false,
		adaptiveHeight: true,
		randomStart: true,
	});

	//Navigation Effect
	function showNav (){
    	$('.main-nav ul').slideToggle();
	}
	$('.devices-menu').on('click', showNav);

	$('.devices-menu').on('click', function(){
		event.preventDefault()
	});

	//Smooth links
	$('a.smooth[href*=#]:not([href=#])').click(function() {
	    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
	      var target = $(this.hash);
	      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
	      if (target.length) {
	        $('html,body').animate({
	          scrollTop: target.offset().top
	        }, 1000);
	        return false;
	      }
	    }
	});

	//Sticky Nav
	$('#nuestro-proceso').on('mouseenter', function(){
    	$('.header').addClass('sticky-header');
	});

	$('#servicios').on('mouseenter', function(){
	    $('.header').removeClass('sticky-header');
	});

	if ($(window).width() < 992) {
		$('.main-nav ul li a').on('click', showNav);
		
	    $('#servicios').on('scrollstart', function(){
	      $('.header').addClass('sticky-header');
	    });

	    $('.sliding-banner').on('scrollstart', function(){
	      $('.header').removeClass('sticky-header');
	    });
  	}

  	// Full Height elements
  	if (window.screen.width < 479) {
		var padding = 50;
	}
	else {
		var padding = 270;
	}
	function fixHeight(){
		//debugger;
		var totalHeight = $(window).height();
		minHeight = totalHeight-padding;
		$('.full-height').css('height',minHeight);
		$('.bx-viewport').css('min-height', minHeight);
	};
	fixHeight();

	// Resize for Full Height elements
	$(window).resize(function(){
		fixHeight();
	});
});