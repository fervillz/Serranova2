var image_field;
jQuery(function ($) {
  $(document).on('click', 'input.Serranova-select-img', function (evt) {
    image_field = $(this).siblings('.img');
    tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
    return false;
  });
  var original_send_to_editor = window.send_to_editor;
	function showSettingsFor(userId) {
		$('.Serranova-author-box-widget-container #Serranova-author-box-settings-' + userId).show();
	}

	function hideAllSettings() {
		$('.Serranova-author-box-widget-container .hidden').hide();
	}

	function setCurrentAuthor(userId) {
		$('.Serranova-author-box-widget-container #Serranova-current-author').val(userId);
	}

  window.send_to_editor = function (html) {
    if (!image_field) {
      return original_send_to_editor(html);
    }
    imgurl = $('img', html).attr('src');
    image_field.val(imgurl);
    tb_remove();
  }
	$('body').on('change', '.Serranova-author-box-widget-container #author', function (e) {
		hideAllSettings();
		showSettingsFor(e.currentTarget.value);
		setCurrentAuthor(e.currentTarget.value);
	});
}(jQuery));