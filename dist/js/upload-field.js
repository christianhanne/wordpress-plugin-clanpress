'use strict';

/**
 * @file
 * Initializes an upload field's behavior.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */
(function ($, wp) {
  'use scrict';

  $(document).ready(function () {
    $('.clanpress-upload-field').each(function _initField() {
      var $field = $(this);
      var $images = $field.parent().find('.clanpress-upload-image');
      var $button = $field.parent().find('.clanpress-upload-button');
      var $description = $field.parent().find('.description');

      $button.click(function _selectImage(e) {
        e.preventDefault();

        var uploader = undefined,
            options = {
          button: {
            text: $button.attr('value')
          },
          multiple: false
        };

        if ($description.size() > 0) {
          options.title = $description.text();
        }

        uploader = wp.media(options);
        uploader.on('select', function _onSelect() {
          var attachment = uploader.state().get('selection').first().toJSON();
          var previewUrl = attachment.sizes.thumbnail.url;
          $images.html('<img src="' + previewUrl + '" alt="Preview" />');

          $field.val(attachment.id);
        });

        uploader.open();
      });
    });
  });
})(jQuery, wp);