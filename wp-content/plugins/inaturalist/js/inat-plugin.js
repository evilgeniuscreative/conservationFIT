/**
 * Created by iaaron on 4/14/17.
 */
;(function ($) {
    $(document).ready(function () {
        $modal = $('<div/>', {id: 'inat-modal'});
        $modal.on('click',function(){
            $(this).removeClass('visible');
        })
        $('body').append($modal);
        $('.inat-photo-thumb').on('click', function () {
            $pic = $(this).siblings().clone(true);
            $modal.addClass('visible');
            $modal.append($pic);
        });
        $('.inat-photo-large').find('i').on('click', function () {
            $modal.removeClass('visible');
            $(this).parent().remove();
        });
    });

})(jQuery);