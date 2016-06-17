
  jQuery(document).ready(function() {

    var navpos = jQuery('#masthead').offset();
    console.log(navpos.top);
      jQuery(window).bind('scroll', function() {
        if (jQuery(window).scrollTop() > navpos.top) {
          jQuery('#masthead').addClass('fixed');
          jQuery('#spacer').addClass('on');
         }
         else {
          jQuery('#masthead').removeClass('fixed');
          jQuery('#spacer').removeClass('on');
         }
      });

    jQuery("#menu-on").click(function(){
      jQuery("#menu").toggleClass("on");
      jQuery("#overlay").toggleClass("on");
    });

    jQuery("#overlay").click(function(){
      jQuery("#menu").removeClass("on");
      jQuery("#overlay").removeClass("on");
    });

    jQuery(".fa-times").click(function(){
      jQuery("#menu").removeClass("on");
      jQuery("#overlay").removeClass("on");
    });


  });
