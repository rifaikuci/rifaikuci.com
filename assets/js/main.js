// Animations
AOS.init({
  anchorPlacement: 'top-left',
  duration: 1000
});

// Add your javascript here

jQuery(document).ready(function($) {


  var mastheadheight = $('.ds-header').outerHeight();
  $(".ds-banner,.ds-main-section").css("margin-top" , mastheadheight);

  $(window).scroll(function(){
    if ($(window).scrollTop() >= 10) {
      $('.ds-header').addClass('ds-fixed-header');
    }
    else {
      $('.ds-header').removeClass('ds-fixed-header');
    }
  }).scroll();


});