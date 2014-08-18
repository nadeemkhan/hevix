// Important note! If you're adding CSS3 transition to slides, fadeInLoadedSlide should be disabled to avoid fade-conflicts.
jQuery(document).ready(function($) {
  var si = $('#gallery-1').royalSlider({
    addActiveClass: true,
    arrowsNav: true,
    controlNavigation: 'bullets',
    autoScaleSlider: true,    
    autoScaleSliderHeight: 170,
    loop: true,
    fadeinLoadedSlide: false,
    globalCaption: true,
    keyboardNavEnabled: true,
    globalCaption:true,
    startSlideId: 1,

    visibleNearby: {
      enabled: true,
      centerArea: 0.23,
      center: true,
      breakpoint: 650,
      breakpointCenterArea: 0.64,
      navigateByCenterClick: false
    }
  }).data('royalSlider');



  $('body').keypress(function(eventObject){
    $("#login").addClass('opened');
    $("#title").css("display", "none");
  });



});


$(document).ready(function(){
  //Initial load of page
  $(document).ready(sizeContent);
  $(window).resize(sizeContent);

//Dynamically assign height

function sizeContent() {
    var windowWidth = $(window).width();
    var windowHeight = $(document).height();

    $(".rsGCaption").css("width", windowWidth + "px");
  };
});

// Счетчик Google

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-43881408-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();