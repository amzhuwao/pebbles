$(function() {
  //20-05-2015
  //Hide sidenav if it's empty (for top menu with side submenu)
  if ($('.sidenav ul').length == 0) {
      $('body').removeClass('has-side-menu');
      $('.sidenav').remove();
  }
  $('.custom_title').each(function() {
      if ($(this).text() == "") {
          $(this).hide();
      }
  });
  $('.nav_hidden').slicknav({
      showChildren: false,
      prependTo: '.nav_mobile',
      duration: '500',
      nestedParentLinks: false,
      allowParentLinks: true
  });
  $('.nav ul').each(function() {
      $(this).children('li').last().addClass('last');
      $(this).children('li').first().addClass('first');
  });
  if ($('.sj_preview.page-main-page .element-text p:contains("popup-box")').length > 0) {
      $('.sj_preview.page-main-page .element-text :contains("popup-box"), .cms_show.page-main-page .element-text :contains("popup-box")').hide().parent('.element-text').appendTo(".popup-box");
      if (localStorage.getItem("contentPopup") === null) {
          $(".sj_preview .popup-wrapper").fadeIn(500);
      }
  }
  $(document).on("click", ".popup-box #closepop", function() {
      localStorage.setItem("contentPopup", "true");
      $(".sj_preview .popup-wrapper").fadeOut(500);
  });
  latestNewsEventsHeaderChange();
});

$(window).on("load", function() {
  calendar();
  $('.fc-button-month, .fc-button-next, .fc-button-prev, .fc-button-today').click(function() {
      calendar();
  });
  $('.extra.more > ul > li').eq(0).addClass('item1');
  $('.horizontalFixed').next().css('margin-top', $('.horizontalFixed').height() + 'px');
  checkSideNav();
  // Mobile Menu
  $(document).on("click", ".nav-mobile .menu-btn > .hamburger", function() {
      $(".hamburger").toggleClass("is-active");
      $(".nav-mobile-wrapper").toggleClass("open");
  });
  $(".nav-mobile-inner ul li.parent").each(function() {
      $(this).append('<div class="toggle-icon"><i class="fa fa-chevron-down"></i></div>');
  });
  $(document).on("click", ".nav-mobile-inner ul li.parent > .toggle-icon", function() {
      $(this).closest(".parent").toggleClass("open");
  });
})

$(window).on('load resize', function() {
  $('.header-bar .theme-social').removeAttr("style");
  $('.header-bar .theme-social').css('line-height', $('.header-bar').height() + "px");

  $('.ie8 .nav ul li > ul').mouseenter(function() {
      var rt = ($(window).width() - ($(this).offset().left + $(this).outerWidth()));
      if ($(this).outerWidth() >= rt) {
          $(this).addClass("offset-right");
      }
  });
  $('.ie8 .nav ul li > ul').mouseleave(function() {
      $(this).removeClass("offset-right");
  });
});

$(document).on("ready", function() {
  $(".bs3-breadcrumb").prepend('<li><a href="/">Home</a></li>');
  if ($(".page-main-page .sj-content-row-4 .element").hasClass("element-map")) {
      $(".page-main-page:not(.cms_edit) .sj-content-row-4 .element-map").appendTo("#footer_map");
  }
  $(".element-events h2").each(function() {
      if ($(this).text().length > 0) {
          $(this).siblings("h3").hide();
      } else {
          $(this).hide();
      }
  });
  $(".element-newsletters h2").each(function() {
      if ($(this).text().length > 0) {
          $(this).siblings("h3").hide();
      } else {
          $(this).hide();
      }
  });
  $("#theme-slideshow-captions").insertBefore(".scroll-btn");
  $(".info-btn").on("click", function() {
      var infoID = $(this).attr("data-identify");
      $(".info-bar").each(function() {
          if ($(this).attr("data-identify") == infoID) {
              if ($(this).hasClass("active")) {
                  $(this).slideUp(300);
                  $(this).removeClass("active");
              } else {
                  $(this).slideDown(300);
                  $(this).addClass("active");
              }
          } else {
              $(this).slideUp(300);
              $(this).removeClass("active");
          }
      });
  });
  $(".info-close").on("click", function() {
      $(this).parents(".info-bar").slideUp(300);
      $(this).parents(".info-bar").removeClass("active");
  });
  $(".slide-btn").on("click", function() {
      var infoID = $(this).attr("data-identify");
      $(".slide-bar").each(function() {
          if ($(this).attr("data-identify") == infoID) {
              if ($(this).hasClass("open")) {
                  $(this).removeClass("open");
              } else {
                  $(this).addClass("open");
              }
          } else {
              $(this).removeClass("open");
          }
      });
  });
  // Row 3 News
  $('.page-main-page .sj-outer-row-3 .sj_element_news ul li').wrapAll('<div class="news-list"></div>');
  $('.sj_element_news .news-list').slick({
    dots: false,
    infinite: true,
    arrows: true,
    speed: 300,
    slidesToShow: 3,
    slidesToScroll: 1,
    responsive: [
      {
        breakpoint: 1281,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 800,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });
  // Awards
  $('.sj_preview .footer-images, .cms_show .footer-images').slick({
      dots: false,
      infinite: true,
      speed: 500,
      slidesToShow: 5,
      autoplay: true,
      slidesToScroll: 1,
      responsive: [{
          breakpoint: 768,
          settings: {
              slidesToShow: 4,
              slidesToScroll: 1
          }
      }, {
          breakpoint: 630,
          settings: {
              slidesToShow: 3,
              slidesToScroll: 1
          }
      }, {
          breakpoint: 480,
          settings: {
              slidesToShow: 2,
              slidesToScroll: 1
          }
      }]
  });
  $(".page-main-page").removeClass("has-side-menu").find("sidenav").remove();
});

$(window).on('load resize', function(){
  var newsHeight = 0;
  $(".page-main-page .sj-outer-row-3 .element-news li.slick-slide").each(function(){
    $(this).css("height", "auto");
    if($(this).outerHeight() > newsHeight){
      newsHeight = $(this).outerHeight();
    }
  });
  $(".page-main-page .sj-outer-row-3 .element-news li.slick-slide").css("height", newsHeight);
});

$(window).on('load scroll', function() {
  var scroll = $(document).scrollTop();
  if (scroll > $(".header-inner").outerHeight()) { //header-inner optional. Insert your element above menu 
      $('body:not(.cms_edit) .header-details .nav').addClass("fixed");
  } else {
      $('body:not(.cms_edit) .header-details .nav').removeClass('fixed');
  }
});


function checkSideNav() {
  //20-05-2015
  //Hide sidenav if it's empty (for top menu with side submenu)
  if ($('.sidenav ul').length == 0) {
      $('body').removeClass('has-side-menu');
      $('.sidenav').remove();
      var resizeEvent = window.document.createEvent('UIEvents');
      resizeEvent.initUIEvent('resize', true, false, window, 0);
      window.dispatchEvent(resizeEvent);
  }
}

function latestNewsEventsHeaderChange() {
  $('.sj_element_news > h3').text('News');
  $('.sj_element_events > h3').text('Events Calendar');
  $('.sj_element_newsletters > h3').text('Newsletters');
}

//CALENDAR
function calendar() {
  $('.page-Generated-calendar #calendar').addClass('element-calendar');
  $('.element-calendar').each(function() {
      $(this).find('.fc-week').each(function(i) {
          if ($(this).index() % 2 == 0) {
              $(this).addClass('even');
          } else {
              $(this).addClass('odd');
          }
          $(this).find('.fc-day').each(function(i) {
              if ($(this).index() % 2 == 0) {
                  $(this).addClass('even');
              } else {
                  $(this).addClass('odd');
              }
          });
      });
  });
}

/* Row 2 Quicklinks */
$(window).on('load', function() {
  if($(window).outerWidth() > 960){
      var qlsrc;
      $(".page-main-page .sj-outer-row-2 .column-3col-1 .element-image img").each(function(){
          qlsrc = $(this).attr("src");
          $(this).replaceWith("<div class='ele-bg-img' style='background-image: url("+qlsrc+")'>");
      });
  }
});
$(window).on('load resize', function(){
  $(".ele-bg-img").css({"height": ($(".page-main-page .sj-outer-row-2 .column-3col-2 .element-image").outerHeight() / 2) - 10});
});