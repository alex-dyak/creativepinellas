(function () {
  jQuery(function($) {
    $('select').selectBoxIt();

    $(document).foundation();

    var $offCanvas = $(".off-canvas"),
      $mobileNavToggle = $('.js-mobileNavToggle'),
      $subNavToggle = $('.js-subNavToggle'),
      $touchNav = $('.js-touchNav');

    $offCanvas.on("opened.zf.offcanvas", function(e) {
      $mobileNavToggle.addClass('is-open');
    });
    $offCanvas.on("closed.zf.offcanvas", function(e) {
      $mobileNavToggle.removeClass('is-open');
    });

    /*  Mobile navigation show subNav*/
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

    /*  desktop navigation show subNav on touch devices */
    $touchNav.each(function () {
      var $subNavItem = $(this).find('.js-hasSubNav');

      $subNavItem.on('touchstart', function(e) {
        var $t = $(this);
        if (!$t.find('a').is(':focus')) {
          e.preventDefault();
          $t.find('a').focus();
        }
      });
      $subNavItem.find('a').on('focus', function () {
        $(this).parent().addClass('is-open').siblings().removeClass('is-open');
      }).on('blur', function () {
        $(this).parent().removeClass('is-open');
      })
    })

  });
})();