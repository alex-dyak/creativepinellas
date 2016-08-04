(function () {
  jQuery(function($) {
    $('select').selectBoxIt();

    $(document).foundation();

    var $offCanvas = $(".off-canvas"),
      $mobileNavToggle = $('.js-mobileNavToggle'),
      $subNavToggle = $('.js-subNavToggle');

    $offCanvas.on("opened.zf.offcanvas", function(e) {
      $mobileNavToggle.addClass('is-open');
    });
    $offCanvas.on("closed.zf.offcanvas", function(e) {
      $mobileNavToggle.removeClass('is-open');
    });

    $subNavToggle.click(function (e) {
      e.preventDefault();
      e.stopPropagation();
      var $t = $(this),
        $parentHasSubNav = $t.parents('.js-hasSubNav:first');

      if ($parentHasSubNav.hasClass('is-open')) {
        $parentHasSubNav.removeClass('is-open');
        $parentHasSubNav.find('.js-subNav').slideUp();
      } else {
        $t.parents('.js-mobileNavigation:first').find('.js-subNav').slideUp();
        $parentHasSubNav.addClass('is-open').siblings().removeClass('is-open');
        $parentHasSubNav.find('.js-subNav').slideDown();
      }
    });

  });
})();