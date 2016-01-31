'use strict';

/**
 * @file
 * Initializes the teamspeak viewer plugin.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */
(function ($) {
  'use scrict';

  $(document).ready(function () {
    $('.teamspeak-viewer').each(function () {
      var $element = $(undefined);

      var ts3Address = $element.attr('data-ts3-address');
      var ts3Port = $element.attr('data-ts3-port');

      if (ts3Address && ts3Port) {
        $element.tsviewer({
          host: ts3Address,
          port: ts3Port
        });
      } else {
        console.error('Missing or empty attributes.');
      }
    });
  });
})(jQuery);