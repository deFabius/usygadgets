(function($) {
    $('.image-viewer').each(function(index, viewer) {
        var magnified = $(viewer).children('.magnified');
        var interface = $(viewer).children('.thumbnail-container').children('.thumbnail-interface');
        var picsContainer = $(viewer).children('.thumbnail-container').children('.thumbnail-pics');
        picsContainer.css('left', 0);
        var pics = picsContainer.children('.attachment-thumbnail');
        var picsContainerPos = 0;
        var scrolling = null;

        pics.click(function(thumb) {
            var fullImg = thumb.currentTarget.getAttribute('src').replace('-150x150', '');
            magnified.css('background-image', 'url(' + fullImg + ')');
        });

        interface.mouseover(function (btn) {
            var direction = $(btn.target).hasClass('thumbnail-interface-left') ? -1 : 1;
            var refW = magnified.width();
            var deltaW = picsContainer.width() - refW + 50;

            if (deltaW > 0 && !scrolling) {
                scrolling = setInterval((function scroller() {
                    picsContainerPos += direction;

                    if( picsContainerPos < 0) {
                        picsContainerPos = 0;
                    }

                    var shift = picsContainerPos * 160;

                    if (shift > deltaW) {
                        shift = deltaW;
                        picsContainerPos --;
                    }
                    
                    picsContainer.css('left', -shift);

                    return scroller;
                }()), 500);
            }
        });

        interface.mouseout(function(btn) {
            clearInterval(scrolling);
            scrolling = null;
        })
    });
}(jQuery));
