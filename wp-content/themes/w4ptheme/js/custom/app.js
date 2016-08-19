(function () {
  jQuery(function($) {

    $('select').selectBoxIt({
      autoWidth: false
    });

    $('.js-datepicker').datepicker({
      dayNamesMin: [ 'SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT' ],
      firstDay: 1,
      prevText: '&larr;',
      nextText: '&rarr;',
      showOtherMonths: true
    });

    $('.swipebox').swipebox();

    $(document).foundation();

    var $offCanvas = $(".off-canvas"),
      $mobileNavToggle = $('.js-mobileNavToggle'),
      $subNavToggle = $('.js-subNavToggle'),
      $touchNav = $('.js-touchNav'),
      $touchFocusBlock = $('.js-touchFocus');

    $offCanvas.on("opened.zf.offcanvas", function(e) {
      $mobileNavToggle.addClass('is-open');
    });
    $offCanvas.on("closed.zf.offcanvas", function(e) {
      $mobileNavToggle.removeClass('is-open');
    });

    $(window).resize(function () {
      if (Foundation.MediaQuery.atLeast('large')) {
        $offCanvas.foundation('close');
      }
    });

    /**  Mobile navigation show subNav*/
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

    /**  desktop navigation show subNav on touch devices */
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
    });

    $touchFocusBlock.on('touchstart', function(e) {
      var $t = $(this);
      if (!$t.is(':focus')) {
        e.preventDefault();
        $t.focus();
      }
    });

    /**  slide toggle element */
    $('.js-toggle').click(function (e) {
      e.preventDefault();
      var $toggleBlock = $('.' + $(this).data('toggle') );
      $toggleBlock.slideToggle(function() {
        $toggleBlock.find('select').each(function () {
          $(this).data("selectBox-selectBoxIt").refresh();
        });
      });
    })

  });
})();
