(function($) {
    $(document).ready(function() {
        $('.slideshow').each(function(index, slideShow) {
            var slidesContainer = $(slideShow).children('.slideshow-content');
            var activeSlide = 0;
            var slides = slidesContainer.children();
            var controls = $(slideShow).children('.slideshow-interface');

            controls.children().each(function(index, arrow) {
                $(arrow).click(function() {
                    if ($(this).hasClass('slideshow-left')) {
                        activeSlide = !activeSlide ? slides.length - 1 : activeSlide - 1;
                    } else {
                        activeSlide = ++activeSlide % slides.length;
                    }
                    var shiftAmount = (activeSlide * -100) + '%';
                    slidesContainer.css('left', shiftAmount);
                });
            });
/*             setInterval(function() {
                activeSlide = ++activeSlide % slides.length;
                var shiftAmount = (activeSlide * -100) + '%';
                slidesContainer.css('left', shiftAmount);
            }, 5000); */
        });
    });
}(jQuery));