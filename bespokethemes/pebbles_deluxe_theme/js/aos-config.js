/* AOS */

$(document).on("ready", function(){
  if(!$('body').hasClass('cms_edit') && $(window).outerWidth() > 1024){
    $( '.page-main-page .sj-outer-row-1 .column-2col-1' ).attr({
      "data-aos": "fade-right",
      "data-aos-mirror": "true",
      "data-aos-duration": 2000  
    });
    $( '.page-main-page .sj-outer-row-1 .column-2col-2' ).attr({
      "data-aos": "fade-left",
      "data-aos-mirror": "true",
      "data-aos-duration": 1500  
    });
    $( '.page-main-page .sj-outer-row-2 .column' ).attr({
      "data-aos": "fade-up",
      "data-aos-mirror": "true",
      "data-aos-duration": 1250  
    });
    $( '.page-main-page .sj-outer-row-3 .sj_element_news ul' ).attr({
      "data-aos": "fade-right",
      "data-aos-mirror": "true",
      "data-aos-duration": 1500  
    });
    AOS.init({
      delay: 100,
      disable: 'mobile'
    });
  }
});