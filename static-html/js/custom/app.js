(function () {
  jQuery(function($) {
    $('select').selectBoxIt();

    $(document).foundation();

    var $offCanvas = $(".off-canvas"),
      $mobileNavToggler = $('.js-mobileNavToggle');

    $offCanvas.on("opened.zf.offcanvas", function(e) {
      $mobileNavToggler.addClass('is-open');
    });
    $offCanvas.on("closed.zf.offcanvas", function(e) {
      $mobileNavToggler.removeClass('is-open');
    });

  });
})();