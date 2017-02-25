$('.gallery, .event').each(function () {
    var $pic = $(this),
        getItems = function () {
            var items = [];
            $pic.find('.swipe').each(function () {
                var $href = $(this).attr('href'),
                    $size = $(this).data('size').split('x'),
                    $width = $size[0],
                    $height = $size[1];

                var item = {
                    src: $href,
                    w: $width,
                    h: $height
                };

                items.push(item);
            });
            return items;
        };

    var items = getItems();

    var $pswp = $('.pswp')[0];
    $pic.on('click', '.swipe', function (event) {
        event.preventDefault();

        var $index = $(this).data('index');

        var options = {
            index: $index,
            bgOpacity: 0.7,
            showHideOpacity: true
        };

        // Initialize PhotoSwipe
        var lightBox = new PhotoSwipe($pswp, PhotoSwipeUI_Default, items, options);
        lightBox.init();
    });
});