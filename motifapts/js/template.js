(function(){
    "use strict";

  var isMobileWidth = false;

	function checkMobileWidth(){
	  isMobileWidth = ($(window).width() <= 768);
	}	

  function jumpLink(){
    $('.jump').on({
      click:function(e){
        e.preventDefault();
        $('html, body').animate({
          scrollTop: $( $.attr(this, 'href') ).offset().top
        }, 750);
      }
    });
  }

  function checkbox() {
  	$('#faux-box').on('click', function(e) {
  		$('#faux-box').toggleClass('active');
	  });

  }

  // Do stuff on document ready
	$(document).ready(function(){
		checkbox();
    jumpLink();
	});

}());
