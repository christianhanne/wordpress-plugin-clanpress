/**
 * @file
 * Initializes an upload field's behavior.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */
(($, wp) => {
  'use scrict';

  $(document).ready(() => {
    $('.clanpress-upload-field').each(function _initField() {
      let $field = $(this);
      let $images = $field.parent().find('.clanpress-upload-image');
      let $button = $field.parent().find('.clanpress-upload-button');

      $button.click(function _selectImage(e) {
        e.preventDefault();

        wp.media.editor.send.attachment = function(props, attachment) {
          let previewUrl = attachment.sizes.thumbnail.url
          $images.html('<img src="' + previewUrl + '" alt="Preview" />');

          $field.val(attachment.id);
        };

        wp.media.editor.open(this);
      });
    });
  });
})(jQuery, wp);
