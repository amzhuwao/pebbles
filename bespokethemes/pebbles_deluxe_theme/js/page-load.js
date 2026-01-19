$(document).on("ready", function(){
    setTimeout(function(){
        window.scrollTo(0, 0);
        $('.preloader-wrapper').fadeOut();
        $('body.page-main-page').removeClass('preloader-site');
    }, 1000);
});