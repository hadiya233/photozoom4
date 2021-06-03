/*global $,alert,console*/
$(document).ready( function () {
    
   'use strict'

  $("html").niceScroll();
    
    $('.Service').click(function () {
			
			$('html, body').animate({

				scrollTop: $('#ssss').offset().top
			}, 1500);
			
		});
       $('.Contact').click(function () {
			
			$('html, body').animate({

				scrollTop: $('#Contact').offset().top
			}, 1500);
			
		});
         $('.sent').click(function () {
			
			$('html, body').animate({

				scrollTop: $('#Contact').offset().top
			}, 1500);
			
		});


    


});

     //lodaing screen
      $(window).load(function(){
 
      //lodaind element
      
	    $(".ccover h1").fadeOut(1000,
		   function()
		   {
		       $(".ccover h1").parent().fadeOut(2500,
			       function()
			          {  

				         //show scroll
	                      $("body").css("overflow","auto");
			              $(this).remove();
		});
	});
});