$(function () {

    var count = $("#theme-slideshow-images img").length;

    if (count > 1) {

        $('#theme-slideshow-images img:gt(0)').hide();
        setInterval(function () {
            $('#theme-slideshow-images :first-child').fadeOut(2000)
                    .next('img').fadeIn()
                    .end().appendTo('#theme-slideshow-images');
        }, 6000);
    }
    var count = $("#theme-slideshow-captions span").length;

    if (count > 1) {

        $('#theme-slideshow-captions span:gt(0)').hide();
        setInterval(function () {
            $('#theme-slideshow-captions :first-child').fadeOut()
                    .next('span').fadeIn(2000)
                    .end().appendTo('#theme-slideshow-captions');
        }, 6000);
    }
});

$(window).on("load resize", function () {

    /*//Old solution - resize to maximum image height
     $('#theme-slideshow-images').each(function () {
        var max_hgh = 0;
        $('#theme-slideshow-images').find('img').each(function () {
            if ($('#theme-slideshow-images img').height() > max_hgh) {
                max_hgh= $('#theme-slideshow-images img').height();
            }
        });

        $('#theme-slideshow').css('height', max_hgh);

    });
    */

     /*20-05-2015
    Resize slideshow to minimum image height
     */
    var max_hgh = 5000;
    var min_hgh;
    $('#theme-slideshow-images img').each(function(){
        min_hgh = $(this).height();
        if(min_hgh < max_hgh){
            max_hgh = min_hgh;
        }
    });
        $('#theme-slideshow').css('height',max_hgh);

});
