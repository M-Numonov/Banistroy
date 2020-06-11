$(document).ready(function(){

	/*- main-navi -*/
	$('.main-navi-btn').click(function(e) {
		
		if($(this).parent().hasClass('open')) {
			$(this).parent().removeClass('open');
			$('[data-menu="menu"]')
			.removeClass('open-navi')
		} else {
			$(this).parent().addClass('open');
			$('[data-menu="menu"]')
			.addClass('open-navi');	
			
		}
		return false;
	});
	
	$(document).on("click", '.main-navi__item.more > a', function(){
    if ($(this).hasClass('click')) {
			$(this).removeClass('click');
			$('.more__dropdown').fadeOut(350);
			  return false;
		}else{
		   $(this).addClass('click');
			$('.more__dropdown').fadeIn(350);
			  return false;
		}
	});
	
	$(document).click( function(event){
		if( $(event.target).closest(".more__dropdown").length ) 
		return;
		$(".more__dropdown").fadeOut(350);
		$(".main-navi__item.more > a").removeClass("click");
		event.stopPropagation();
	});
	
	/*- search-form -*/
    $(document).on("click", '.search-form__btn', function(){
    if ($(this).hasClass('click')) {
			$(this).removeClass('click');
			$('.search-form input').fadeOut(350);
			  return false;
		}else{
		   $(this).addClass('click');
			$('.search-form input').fadeIn(350);
			  return false;
		}
	});
	
	$(document).click( function(event){
		if( $(event.target).closest(".search-form input").length ) 
		return;
		$(".search-form input").fadeOut(350);
		$(".search-form__btn").removeClass("click");
		event.stopPropagation();
	});

    /*- project-list -*/
    $('.project-list__info__more').on('click', function(){
	    var $that = $(this),
	        nc = $that.prev('.project-list__info__in').length,
	        block = nc ? $that.prev('.project-list__info__in') : $that.parent('.project-list__info__in');
	    block.slideToggle(function(){
	        $('.project-list__info__more',block).add(block.next('.project-list__info__more'))
	        .text(block.is(':visible') ? 'скрыть' : 'более подробнее');
	    });  
	});

	/*- promo-slider -*/
	$('.promo-slider').slick({
		arrows: false,
		adaptiveHeight: true,
		dots: true,
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1
	});
	
	/*- product-slider -*/
	$('.product-slider').slick({
		arrows: true,
		adaptiveHeight: true,
		dots: true,
		infinite: false,
		slidesToShow: 4,
		slidesToScroll: 1,
		responsive: [
			{
			  breakpoint: 992,
			  settings: {
				slidesToShow: 3,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 601,
			  settings: {
				slidesToShow: 2,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 400,
			  settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 0,
			  settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			  }
			}
		]
	});

	/*- photo-slider -*/
	$('.photo-slider').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		fade: true,
		asNavFor: '.info-slider'
	});

	/*- info-slider -*/
	$('.info-slider').slick({
		arrows: true,
		adaptiveHeight: true,
		fade: true,
		dots: true,
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		asNavFor: '.photo-slider',
	});
	
	/*- article-slider -*/
	$('.article-slider').slick({
		arrows: true,
		adaptiveHeight: true,
		dots: true,
		infinite: false,
		slidesToShow: 3,
		slidesToScroll: 1,
		responsive: [
			{
			  breakpoint: 1200,
			  settings: {
				slidesToShow: 2,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 767,
			  settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 0,
			  settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			  }
			}
		]
	});

	/*- project-info__slider -*/
	$('.project-info__slider__big').slick({
		infinite: false,
  		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		dots: false,
		fade: true,
		asNavFor: '.project-info__slider__small'
	});
	$('.project-info__slider__small').slick({
		arrows: true,
		infinite: false,
		slidesToShow: 5,
		slidesToScroll: 1,
		asNavFor: '.project-info__slider__big',
		dots: false,
		focusOnSelect: true,
		responsive: [
			{
			  breakpoint: 542,
			  settings: {
				slidesToShow: 4,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 479,
			  settings: {
				slidesToShow: 3,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 360,
			  settings: {
				slidesToShow: 2,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 0,
			  settings: {
				slidesToShow: 2,
				slidesToScroll: 1
			  }
			}
		]
	});


	/*- photogallery-list -*/
    $('.photogallery-list').lightGallery({
        thumbnail: false
    }); 

    /*- project-info__slider__big -*/
    $('.project-info__slider__big .slick-track').lightGallery({
        thumbnail: false
    }); 

    /*- project-info__choice__tabs -*/
    $('.project-info__choice__tabs__nav').on('click', 'li:not(.active)', function() {
		$(this)
	    	.addClass('active').siblings().removeClass('active')
	    	.closest('.project-info__choice__tabs').find('.project-info__choice__tabs__content').removeClass('active').eq($(this).index()).addClass('active');
		console.log($(this).index());
		console.log($('.project-info__choice__tabs__content').index());
	});
		
});











