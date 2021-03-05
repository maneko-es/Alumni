$(document).ready(function(){
	// $(".registry-form").parent().parent().find("button").hide();
  $('.galleries-container').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    dots: true,
    // centerMode: true
    // accessibility: false,
    // focusOnSelect: true

  });

  if($('.breadcrumb li').first().find('a').text() == "Imatges "){
    $('.breadcrumb li').first().find('a').removeAttr("href");
  }
});
