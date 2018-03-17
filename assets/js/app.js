
(function($) {

  // Testimonials Slider
  $('.testimonials-slider').slick({
    prevArrow: '<span class="slick-arrow arrow-prev pe-7s-angle-left-circle"></span>',
    nextArrow: '<span class="slick-arrow arrow-next pe-7s-angle-right-circle"></span>',
    slidesToShow: 1,
    infinite: true,
    slidesToScroll: 1,
    adaptiveHeight: false,
    arrows: true
  });
  // Accreditations Slider
  $('.accreditations-slider').slick({
    prevArrow: '<span class="slick-arrow arrow-prev pe-7s-angle-left-circle"></span>',
    nextArrow: '<span class="slick-arrow arrow-next pe-7s-angle-right-circle"></span>',
    slidesToShow: 1,
    infinite: true,
    slidesToScroll: 1,
    adaptiveHeight: false,
    arrows: true
  });
  // Banner Slider
  $('.banner-slider-main').slick({
    prevArrow: '<span class="slick-arrow arrow-prev pe-7s-angle-left-circle"></span>',
    nextArrow: '<span class="slick-arrow arrow-next pe-7s-angle-right-circle"></span>',
    slidesToShow: 1,
    infinite: true,
    slidesToScroll: 1,
    adaptiveHeight: false,
    arrows: true,
    fade: true
  });
  // News Slider
  $('.news-slider').slick({
    prevArrow: '<span class="slick-arrow arrow-prev pe-7s-asngle-left-circle"></span>',
    nextArrow: '<span class="slick-arrow arrow-next pe-7s-angle-right-circle"></span>',
    slidesToShow: 6,
    slidesToScroll: 1,
    infinite: true,
    autoplay: false,
    adaptiveHeight: true,
    arrows: true,
    dots: true,
    dotsClass: 'slider-paging-number',
    customPaging: function (slick) { return 'Page ' + (slick.currentSlide + 1) + ' of ' + slick.slideCount; }
    }).on('afterChange', function (event, slick, currentSlide) {
  	$(this).find('*[role="tablist"]').find('li').eq(0).text(slick.options.customPaging.call(this, slick, currentSlide));
  });

  // Homepage tabs
  $(document).ready(function(){

	$('.feature').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('.feature').removeClass('current');
		$('.banner-slide').removeClass('current');

		$(this).addClass('current');
		$("#"+tab_id).addClass('current');
	})

})

// Filter & search
jQuery(function($){
	$('#filter').submit(function(){
		var filter = $('#filter');
		$.ajax({
			url:filter.attr('action'),
			data:filter.serialize(), // form data
			type:filter.attr('method'), // POST
			beforeSend:function(xhr){
				filter.find('button').text('Processing...'); // changing the button label
			},
			success:function(data){
				filter.find('button').text('Apply filter'); // changing the button label back
				$('#response').html(data); // insert data
			}
		});
		return false;
	});
});


})( jQuery );
