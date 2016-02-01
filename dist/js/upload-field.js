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

      $button.click(function _selectImage(e) {
        e.preventDefault();

        wp.media.editor.send.attachment = function (props, attachment) {
          var previewUrl = attachment.sizes.thumbnail.url;
          $images.html('<img src="' + previewUrl + '" alt="Preview" />');

          $field.val(attachment.id);
        };

        wp.media.editor.open(this);
      });
    });
  });
})(jQuery, wp);