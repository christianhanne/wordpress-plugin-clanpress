/**
 * Initializes an upload field's behavior.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress\Shared
 */
(($, wp) => {
  'use scrict';

  $(document).ready(() => {
    $('.clanpress-upload-field').each(function _initField() {
      let $field = $(this);
      let $images = $field.parent().find('.clanpress-upload-image');
      let $button = $field.parent().find('.clanpress-upload-button');
      let $description = $field.parent().find('.description');

      $button.click(function _selectImage(e) {
        e.preventDefault();

        let uploader, options = {
          button: {
            text: $button.attr('value')
          },
          multiple: false
        };

        if ( $description.size() > 0 ) {
          options.title = $description.text();
        }

        uploader = wp.media(options);
        uploader.on('select', function _onSelect() {
          let attachment = uploader.state().get('selection').first().toJSON();
          let previewUrl = attachment.sizes.thumbnail.url
          $images.html('<img src="' + previewUrl + '" alt="Preview" />');

          $field.val(attachment.id);
        });

        uploader.open();
      });
    });
  });
})(jQuery, wp);
