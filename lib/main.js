$(document).ready(function() {

  $('.upButton').click(function() {
    $('body,html').animate({
      scrollTop: 0
    }, 800);
    return false;
  });

  $('.carousel').carousel({
    interval: 6000
  })

  window.onload = function() {
    var sliderDiv = $(document).width() + 120;
    $(".slider").css("width", sliderDiv + "px");

    var sliideWidth = $(".slick-slide").width();
    $(".slick-track").css("margin-left", sliideWidth + "px");

    var sliideHeight = $(".circle").width();
    $(".circle").css("height", sliideHeight + "px");
  }

  setTimeout(
    function() {
      $('.content').addClass('loaded');
    }, 2000);
});
