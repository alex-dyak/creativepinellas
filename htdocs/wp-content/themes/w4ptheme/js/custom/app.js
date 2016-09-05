(function () {
  jQuery(function($) {

    var $offCanvas = $(".off-canvas"),
      $mobileNavToggle = $('.js-mobileNavToggle'),
      $subNavToggle = $('.js-subNavToggle'),
      $touchNav = $('.js-touchNav'),
      $touchFocusBlock = $('.js-touchFocus'),
      $equalContainer = $('.js-community-equalHeight'),
      $select = $('select'),
      $datepicker = $('.js-datepicker'),
      $swipebox = $('.swipebox'),
      datepickerOptions = {};

    if($select.length > 0) {
      $select.selectBoxIt({
        autoWidth: false
      });
    }

    datepickerOptions = {
      dayNamesMin: ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'],
      firstDay: 1,
      prevText: '&larr;',
      nextText: '&rarr;',
      showOtherMonths: true,
      changeMonth: false,
      changeYear: false
    };
    if($datepicker.length > 0) {
      $datepicker.datepicker(datepickerOptions);
    }

    //update event form datepicker
    if($('.em-date-input-loc').length > 0) {
      $('#jquery-ui-css').remove();
      $(".em-date-input-loc").datepicker("option", datepickerOptions);
    }


    if($swipebox.length > 0) {
      $swipebox.swipebox();
    }

    $(document).foundation();


    $offCanvas.on("opened.zf.offcanvas", function(e) {
      $mobileNavToggle.addClass('is-open');
    });
    $offCanvas.on("closed.zf.offcanvas", function(e) {
      $mobileNavToggle.removeClass('is-open');
    });

    $(window).load(function () {
      communityEqualHeight($equalContainer);
    });

    $(window).resize(function () {
      if (Foundation.MediaQuery.atLeast('large')) {
        $offCanvas.foundation('close');
      }
      communityEqualHeight($equalContainer);
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
        $toggleBlock.find('input[type=search]').focus();
      });
    });
  });

  function communityEqualHeight($equalContainer) {
    var columns = $equalContainer.find('[data-equal]'),
      tallestcolumn = 0;
    columns.height('auto');
    columns.each(function() {
      var currentHeight = jQuery(this).find('.js-equalizer').width();
      if(currentHeight > tallestcolumn) {
        tallestcolumn = currentHeight;
      }
    });
    columns.height(tallestcolumn);
  }

})();
