/**
 * Initializes the teamspeak status plugin.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress\Teamspeak
 */
(($) => {
  'use scrict';

  $(document).ready(() => {
    $('.teamspeak-status').each(function _initViewer() {
      let $element = $(this);

      let ts3Address = $element.attr('data-ts3-address');
      let ts3Port = $element.attr('data-ts3-port');

      if (ts3Address && ts3Port) {
        $element.ts3status({
          host: ts3Address,
          port: ts3Port
        });
      } else {
        console.error('Missing or empty attributes.');
      }
    });
  });
})(jQuery);
