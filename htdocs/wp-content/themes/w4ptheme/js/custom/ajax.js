/**
 * Custom Ajax pagination on the
 */
jQuery(function($) {
    $(document).ready(function () {
        $(document).on('click', '.nav-links a', function (e) {
            e.preventDefault();
            var link = jQuery(this).attr('href');
            $('#wrapper_content').load(link + ' .cont');
            history.pushState(null,null, link);
        });
    });
});