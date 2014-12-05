function resizeWindow() {
	var sliderDiv = $(document).width() - 120;
	$(".slider").css("width", sliderDiv + "px");

	if ($(document).width() < 700) {
		$(".slider").css("width", sliderDiv + 100 + "px");
	}

	var sliideWidth = $(".slick-slide").width();
	$(".slick-track").css("margin-left", sliideWidth + "px").css("height", sliideWidth + "px");

	var sliderHeight = $(".slider").height();
	$("#header .wrapper").css("height", sliderHeight + 200 + "px");

	var sliideHeight = $(".circle").width();
	$(".circle").css("height", sliideHeight + 1 + "px");
	
	$(".slick-prev").css("width", sliideHeight - 176 + "px").css("height", sliideHeight + "px").css("line-height", sliideHeight + "px");
	$(".slick-next").css("width", sliideHeight - 176 + "px").css("height", sliideHeight + "px").css("line-height", sliideHeight + "px");

	// var slickActive = $(".slick-active > div").height();
	// $(".slick-slide").css("height", slickActive + "px");

	// var slickTrackWidth = $('.sliide').width();
	// $(".slick-track").css("margin-left", slickTrackWidth + "px");
}

function loadWork() {
	$(".loadingWork").empty();
	if ( $(".slide1").hasClass("slick-active") ) {
	  $(".loadingWork").load("works/slide1.html");
  }
  if ( $(".slide2").hasClass("slick-active") ) {
	  $(".loadingWork").load("works/slide2.html");
  }
 	if ( $(".slide3").hasClass("slick-active") ) {
	  $(".loadingWork").load("works/slide3.html");
  }
  if ( $(".slide4").hasClass("slick-active") ) {
	  $(".loadingWork").load("works/slide4.html");
  }

}

$(document).ready(function(){
  $('.slider').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  slide: '.sliide',
  draggable: false,
  dots: true,
  infinite: true,
  cssEase: 'ease-in-out',
  speed: '400'
  });

  //  $(".slick-active").next("div").hover(
	 //  function () {
	 //    $(this).addClass('next');
	 //  }, 
	 //  function () {
	 //    $(this).removeClass('next');
	 //  }
  // );
   
  // $(".slick-active").prev("div").hover(
	 //  function () {
	 //    $(this).addClass('prev');
	 //  }, 
	 //  function () {
	 //    $(this).removeClass('prev');
	 //  }
  // );

	$('.slick-prev').click(loadWork);
	$('.slick-next').click(loadWork);

	$( ".slick-prev" ).hover(
	  function() {
	    $(".slick-list").addClass("prev");
	    $(".slick-active").prev().addClass("prev");
	  }, function() {
	    $(".slick-list").removeClass("prev");
	    $(".slick-active").prev().removeClass("prev");
	  }
	);

	$( ".slick-prev" ).click(
		function() {
	    $(".slick-list").removeClass("prev");
	    $(".slick-active").prev().removeClass("prev");
	  }
	 );

	$( ".slick-next" ).hover(
	  function() {
	    $(".slick-list").addClass("next");
	    $(".slick-active").next().addClass("next");
	  }, function() {
	    $(".slick-list").removeClass("next");
	    $(".slick-active").next().removeClass("next");
	  }
	);

	$( ".slick-next" ).click(
		function() {
	    $(".slick-list").removeClass("next");
	    $(".slick-active").next().removeClass("next");
	  }
	 );


	$('.upButton').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
	});


  window.onload = function() {
  		var sliderDiv = $(document).width() + 120;
	$(".slider").css("width", sliderDiv + "px");

	var sliideWidth = $(".slick-slide").width();
	$(".slick-track").css("margin-left", sliideWidth + "px");

	var sliideHeight = $(".circle").width();
	$(".circle").css("height", sliideHeight + "px");
  }

  $(window).scroll(function(){
		// var headerHeight = $("#header").height() - 500;
		var scrollTopHeight = $("#header").height() - ($(window).scrollTop()*2);

	  if (scrollTopHeight < 0) {
	  $("#content").css("margin-top", + 40 + scrollTopHeight/10 + "px");
	  } else {
	    $("#content").css("margin-top", + 40 + "px");
	  }
	});

});



$(document).ready(resizeWindow);
$(document).ready(loadWork);
$(window).resize(resizeWindow);