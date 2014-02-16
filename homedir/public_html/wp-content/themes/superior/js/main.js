jQuery(document).ready(function(){
		jQuery('ul.sf-menu').superfish({
			animation: {height:'show'},	// slide-down effect without fade-in
			delay:		 100			// 1.2 second delay on mouseout
		});
	});

/***************** Smooth Scrolling ******************/

  $(document).ready(function() {
	var nice = $("html").niceScroll({
			scrollspeed: 160,
			mousescrollstep: 40,
			cursorwidth: 12,
			cursorborder: 0,
			cursorcolor: '#888',
			cursorborderradius: 5,
			autohidemode: false,
			horizrailenabled: false
		}); 
  });


/*------------isotope--------------------*/

  $(window).load(function(){
    var $container = $('.portfolio-contener');
    $container.isotope({
        filter: '*',
        animationOptions: {
            duration: 750,
            easing: 'linear',
            queue: false
        }
    });
 
    $('.filter-tabs a').click(function(){
        $('.filter-tabs .active').removeClass('active');
        $(this).addClass('active');
 
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
});
  


/*------------Grid Blog--------------------*/
  

   (function ($){
      $('.grid-blog').imagesLoaded(function() {
        // Prepare layout options.
        var options = {
         autoResize: true, // This will auto-update the layout when the browser window is resized.
          container: $('#main-grid'), // Optional, used for some extra CSS styling
          offset: 25, // Optional, the distance between grid items
          outerOffset: 0, // Optional, the distance to the containers border
          itemWidth: 235 // Optional, the width of a grid item
        };

        // Get a reference to your grid items.
        var handler = $('.grid-blog li');

        // Call the layout function.
        handler.wookmark(options);
 
      });
    })(jQuery);
   // END OF DOCUMENT
   // 
/***************** fraction Slider ******************/

$(window).load(function(){
	$('.slider').fractionSlider({
		'fullWidth': 			true,
		'slideTransition' : 'scrollTop',
		'slideTransitionSpeed' : 750, 
		'controls': 			true, 
		'speedOut' : 1600,
		'timeout' : 3000,  
		'responsive': true,
		'dimensions': "1920,750",
		 'pager': true,
		 'controls': 			false, 
	    
		
	});

});


/***************** Grid Portfolio ******************/


			$(window).load(function() {
				Grid.init( );
			});
		

/***************** Dynamic Grid Portfolio ******************/
$(function(){
			$("#dynamic-grid").mason({
				itemSelector: ".box",
				ratio: 2.5,
				sizes: [
					[1,1],
					[1,2],
					[2,2]
				],
				columns: [
					[0,480,1],
					[480,780,2],
					[780,1080,3],
					[1080,1320,4],
					[1320,1680,5]
				],
			 
				layout: 'fluid',
				gutter: 2
			});
		});

/***************** flex slider******************/

    $(window).load(function(){
      $('.flexslider').flexslider({
        animation: "slide", 
		    controlNav: false,
		    directionNav: true,  
        start: function(slider){
          $('body').removeClass('flexslider-loding');
        }
      });
    });
 
/***************** flex slider for recent/work post slide******************/

  $(window).load(function() {
  $('.recent-post-slider').flexslider({
        animation: "slide",
        animationLoop: false,
        itemWidth: 330,
        itemMargin: 23, 
        maxItems: 3, 
        move: 1,
        controlNav: false,
        start: function(slider){
          $('.recent-post-slider').removeClass('flexslider-loding');
        }

  });
});

/*****************Colorbox lightbox******************/

$(document).ready(function(){
				//Examples of how to assign the Colorbox event to elements
				$(".colorlightbox").colorbox({rel:'colorlightbox'});
 
			});
 
 // Make ColorBox responsive
	jQuery.colorbox.settings.maxWidth  = '95%';
	jQuery.colorbox.settings.maxHeight = '95%';

	// ColorBox resize function
	var resizeTimer;
	function resizeColorBox()
	{
		if (resizeTimer) clearTimeout(resizeTimer);
		resizeTimer = setTimeout(function() {
				if (jQuery('#cboxOverlay').is(':visible')) {
						jQuery.colorbox.load(true);
				}
		}, 300);
	}

	// Resize ColorBox when resizing window or changing mobile device orientation
	jQuery(window).resize(resizeColorBox);
	window.addEventListener("orientationchange", resizeColorBox, false);




