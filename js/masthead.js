
  jQuery(document).ready(function() {

    var navpos = jQuery('#masthead').offset();
    console.log(navpos.top);
      jQuery(window).bind('scroll', function() {
        if (jQuery(window).scrollTop() > navpos.top) {
          jQuery('#masthead').addClass('fixie');
          jQuery('#spacer').addClass('on');
         }
         else {
          jQuery('#masthead').removeClass('fixie');
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

    //Tabbed widget scripting

    jQuery('ul.tabs li').click(function(){
  		var tab_id = jQuery(this).attr('data-tab');

  		jQuery('ul.tabs li').removeClass('current');
  		jQuery('.tab-content').removeClass('current');

  		jQuery(this).addClass('current');
  		jQuery("#"+tab_id).addClass('current');
  	})


  });
