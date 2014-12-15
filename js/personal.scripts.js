jQuery( function( $ ){
	$('#slides').superslides();
	
 
	$(document).ready(function() {
			$('#nav').onePageNav({
			easing: 'easeInOutCubic'					
			});
	});

	
	$("a[href='#about']").click(function(){
    $('html, body').animate({
        scrollTop: $( $.attr(this, 'href') ).offset().top+20
    }, 600);
    return false;
	}); 
	
	$("a[href='#go-to-top']").click(function() {
		$("html, body").animate({ scrollTop: 0 }, "slow");
		return false;
	});
	
	
	function progress(percent, element) {
	var progressBarWidth = percent * element.width() / 100;
	// With labels:
	element.find('div').animate({ width: progressBarWidth }, 3000).html(percent + "%&nbsp;"); 
				
	// Without labels:
	//element.find('div').animate({ width: progressBarWidth }, 500);
	}
			
	$(document).scroll(function() {  
		$('.progressBar').each(function() { 
		//alert('Hello');
		var bar = $(this);
		var max = $(this).attr('id');
		max = max.substring(3);

		progress(max, bar);
		}); 
		});
		
	$('.details').waypoint(function() { 
	$('#odometer1').html($('#od1').val())  // with jQuery     
	$('#odometer2').html($('#od2').val()) // with jQuery  
	$('#odometer3').html($('#od3').val()) // with jQuery 
	$('#odometer4').html($('#od4').val())  // with jQuery 
	$('#odometer5').html($('#od5').val())  // with jQuery 
	}, {
  offset: '100%'
}); 
	 
});