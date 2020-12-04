$(document).ready(function(){

  console.log('index.js ready');
	$('#actualitat-slider').slick({
		infinite: true,
		slidesToShow: 4,
		slidesToScroll: 1,
		adaptiveHeight: true,
		autoplay: true,
		autoplaySpeed: 3000,
		appendArrows: $("#arrows"),
		nextArrow: "<i class=\"fas fa-arrow-right\"></i>",
		prevArrow: "<i class=\"fas fa-arrow-left\"></i>",
		responsive: [
		{
		breakpoint: 1200,
		settings: {
		  slidesToShow: 3,
		  slidesToScroll: 1,
		  infinite: true
		}
		},
		{
		breakpoint: 1024,
		settings: {
		  slidesToShow: 2,
		  slidesToScroll: 1
		}
		},
		{
		breakpoint: 768,
		settings: {
		  slidesToShow: 1,
		  slidesToScroll: 1
		}
		}
		]
	});

	$('.menu-icon').click(function(event) {
		$('#mobile-menu').slideToggle();
		$('body').toggleClass("overflow-hidden");
	});

	$('.notifications').click(function(event) {
		$('.notification-messages').toggle();

        var url = $('#markAsRead').attr('action');
        var data = $('#markAsRead').serializeArray();
        $.ajax({
            method: "POST",
            url: url,
            data: data,
            /*success: function(data){
            	$('#schools_container').append('<h4>'+data.school+' - '+data.year+'</h4>');
            },
            error: function(result){
                alert(result);
            },*/
            dataType: 'json',
        });
	});

	$('#add-pic').click(function(event) {
		$('#add-pictures').slideToggle();
	});

});
