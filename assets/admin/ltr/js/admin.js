	$(document).ready(function () {

		$('[data-uploadonclick="ReadUploadOnClick"]').ReadUploadOnClick({
			return_files: '.get_upload_img',
			input_name: 'file_upload',
//			other_html: '<span class="insert_editor_this_img fa fa-plus"></span>',
			call_back: function () {
				$('.remove_this_img').off('click');
				$('.remove_this_img').on('click', function () {
					var $index = $('.remove_this_img').index(this);
					$('.remove_this_img').eq($index).parent().parent().remove();
					
				});

				$('.insert_editor_this_img').off('click');
				$('.insert_editor_this_img').on('click', function () {
					var $eq = $('.insert_editor_this_img').index(this);
					var $img = $('base').attr('href') + $('.img_list img').eq($eq).attr('src');
					CKEDITOR.instances.page_text.insertHtml('<img src="' + $img + '">');
				});
			}
		});
		if ($('.remove_this_img').length > 0) {
			$('.remove_this_img').off('click');
			$('.remove_this_img').on('click', function () {
				var $index = $('.remove_this_img').index(this);
				$('.remove_this_img').eq($index).parent().parent().remove();
			});

			$('.insert_editor_this_img').off('click');
			$('.insert_editor_this_img').on('click', function () {
				var $eq = $('.insert_editor_this_img').index(this);
				var $img = $('base').attr('href') + $('.img_list img').eq($eq).attr('src');
				CKEDITOR.instances.page_text.insertHtml('<img src="' + $img + '">');
			});
		}
	});