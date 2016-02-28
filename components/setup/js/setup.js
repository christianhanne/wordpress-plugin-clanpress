/**
 * Contains client side logic for the setup page.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress
 */
(($) => {
  'use strict';

  var $modes;

  $(document).ready(() => {
    var $modes = $('.clanpress_modes__mode');
    var modeField = document.getElementById('clanpress_mode');

    $modes.click(function _onClick() {
      var $mode = $(this);

      $modes.removeClass('active');
      $mode.addClass('active');

      modeField.value = $mode.attr('data-mode');
    });
  });

})(jQuery);
