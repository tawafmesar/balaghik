$(document).ready(function(){

	  var header = $('header'),
			      btn    = $('button.toggle-nav');

	  btn.on('click', function(){
		    header.toggleClass('active');
	  });

});

AOS.init({
        offset: 60, // offset (in px) from the original trigger point
        delay: 0, // values from 0 to 3000, with step 50ms
        duration: 1500 // values from 0 to 3000, with step 50ms
      });
