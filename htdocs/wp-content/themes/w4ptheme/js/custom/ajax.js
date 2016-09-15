/**
 * Custom Ajax pagination on the
 */
jQuery(function($) {
    $(document).ready(function () {
      $(document).on('click', '.nav-links a', function (e) {
        e.preventDefault();
        var $t = $(this),
          link = $t.attr('href'),
          postsWrapper = '.js-postsWrapper';

        loadPosts(link, postsWrapper);
        history.pushState({ url: link , postsContainer: postsWrapper}, null, link);
      });

      window.addEventListener('popstate', function(e){
        loadPosts(e.state.url, e.state.postsContainer);
      }, false);

      function loadPosts(url, postsWrapper) {
        var $ajaxLoader = $(postsWrapper).find('.js-ajaxLoader');

        $.ajax({
          type: "GET",
          url: url,
          dataType: "html",
          beforeSend: function (e) {
            $ajaxLoader.addClass('is-active');
            $(postsWrapper).css({
              height: $(postsWrapper).height() + 40
            });
          },
          success: function (a) {
            var pageHtml = $.parseHTML(a),
              $posts = $(pageHtml).find('.js-posts');

            $(postsWrapper).html($posts);
          },
          error: function (a, st, er) {
            $(postsWrapper).html('<section class="row column"><h3>Something went wrong... try to reload your page</h3></section>');
          },
          complete: function () {
            $(postsWrapper).css({
              height: 'auto'
            });
            $ajaxLoader.removeClass('is-active');
          }
        });
      }
    });
});
