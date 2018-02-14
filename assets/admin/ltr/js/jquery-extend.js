	var $files_upload = [];
	var $uptourl = '';
	var $callbackfunction = false;
	var $loding_html = '<span class="loading fa fa-refresh"></span>';
	var $error_tpl = '<p class="text-%s text-left clearfix error_html">%s</p>';
	var $mask_tpl = '<div class="mask"></div>';
	var $maskupload_tpl = '<div class="maskupload"></div>';
	var $upload_file_tpl = '<input type="file" name="file_upload[]" class="uploadonclick" />';
	var $readfile_upload_tpl = '<input type="file" name="readfile_upload[]" class="readfileonclick" multiple />';
	var $alert_message_tpl = '<div class="modal fade message_modal"><div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header"> <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button> <h4 class="modal-title">%s</h4> </div><div class="modal-body"> <h5>%s</h5> </div><div class="modal-footer"> <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">لا</button> <button type="button" class="btn btn-sm btn-primary message_action">نعم</button> </div></div></div></div>';
	var $tp_scroll_tpl = '<div class="tp-mask-scroll"><span class="tp-scroll"></span></div>';
	var $img_upload_tpl = '<div class="img_list"><input type="hidden" name="%s[]" value="%s"><img class="img-thumbnail" src="%s"><div class="buttons">%s</div></div>';
	(function ($) {

		$.sprintf = function (format, etc) {
			var parameters = arguments;
			var i = 1;
			return format.replace(/%((%)|s)/g, function (b) {
				return b[2] || parameters[i++];
			});
		};

		$.print = function (str, type) {
			if (type === true) {
				console.clear();
				console.log(str);
			} else {
				console.log("\n" + str);
			}
		};


		$.trim = function (str) {
			return str.replace(/^\s+|\s+$/g, '');
		};

		$.stripcslashes = function (str) {
			str = String(str);
			return str.replace(/\\|\\+/g, '');
		};

		$.tohtml = function (str) {
			var $html = '<div class="convert_to_html" style=" display: none; visibility: hidden;"></div>';
			$('body').append($html);
			$('.convert_to_html').html(str);
			str = $('.convert_to_html').text();
			$('.convert_to_html').remove();
			return str;
		};

		$.alert_message = {
			'show': function (options) {
				var settings = {
					'title': 'تحذير',
					'text': 'هل تريد تنفيذ هذا الاجراء',
					callback_function: function () {
					},
					opne_function: function () {
					}
				};
				if (options) {
					$.extend(settings, options);
				}
				$('.message_modal').remove();
				$('body').append($.sprintf($alert_message_tpl, settings.title, settings.text));

				settings.opne_function();
				$('.message_modal').modal('show');
				$('.message_action').off('click');
				$('.message_action').on('click', function () {
					settings.callback_function();
				});
				$('*').on('keydown', function (key) {
					if (key.keyCode == 27) {
						$('.message_modal').modal('hide');
					}
				});
			},
			'hide': function () {
				$('.message_modal').modal('hide');
			}
		};

		$.get_text_length = function (options) {
			var settings = {
				from_text: '.text_get_count',
				return_count: '.text_count'
			};
			if (options) {
				$.extend(settings, options);
			}

			var $this_text = null;
			var $this_count = null;
			if (typeof $(settings.from_text).eq(0).val() != 'undefined') {
				$this_text = $(settings.from_text).eq(0);
				$this_count = $(settings.return_count).eq(0);
				function get_length() {
					var $string = String($this_text.val());
					var $line_count = $string.match(/\n/g);
					if ($line_count === null) {
						$line_count = 0;
					} else {
						$line_count = $line_count.length;
					}
					$this_count.find(".count").text($this_text.val().length);
					var $thistextlength = ($this_text.val().length + $line_count);
					$this_count.find(".count").text($thistextlength);
					var $max = $this_count.find(".max").val();
					var $msg = $this_count.find(".max").attr('data-error');
					$this_count.removeClass('text-danger');
					$this_count.find(".count").text($thistextlength);
					$this_count.find(".inline").text($.sprintf('متبقى %s حرف', ($max - $thistextlength)));
					if ($thistextlength > $max) {
						$this_count.find(".count").text($.sprintf($msg, $max));
						$this_count.addClass('text-danger');
					}
				}
				get_length();
				$(settings.from_text).on({
					click: function () {
						var $index = $(settings.from_text).index(this);
						$this_text = $(settings.from_text).eq($index);
						$this_count = $(settings.return_count).eq($index);
						get_length();
					},
					change: function () {
						var $index = $(settings.from_text).index(this);
						$this_text = $(settings.from_text).eq($index);
						$this_count = $(settings.return_count).eq($index);
						get_length();
					},
					keyup: function () {
						var $index = $(settings.from_text).index(this);
						$this_text = $(settings.from_text).eq($index);
						$this_count = $(settings.return_count).eq($index);
						get_length();
					},
					keydown: function () {
						var $index = $(settings.from_text).index(this);
						$this_text = $(settings.from_text).eq($index);
						$this_count = $(settings.return_count).eq($index);
						get_length();
					},
					keypress: function () {
						var $index = $(settings.from_text).index(this);
						$this_text = $(settings.from_text).eq($index);
						$this_count = $(settings.return_count).eq($index);
						get_length();
					}

				});
			}
		};

		$.get_fragment = function (data) {
			var $href = String(data);
			if ($href == 'undefined') {
				$href = String(location.href);
			}
			if ($href.match(/\#/g)) {
				$href = $href.split('#');
				return $href[1];
			} else {
				return false;
			}
		};

		$.ckedit = function (options) {
			var settings = {};
			if (options) {
				$.extend(settings, options);
			}

			for (i in settings) {
				if ($('[name="' + settings[i] + '"]').attr("name") == settings[i]) {
					var $toolbar = 'minitoolbar', $height = '200', $uiColor = '#EDEDED';
					if ($('[name="' + settings[i] + '"]').attr("data-toolbar") > "") {
						$toolbar = $('[name="' + settings[i] + '"]').attr("data-toolbar");
					}
					if ($('[name="' + settings[i] + '"]').attr("data-height") > "") {
						$height = $('[name="' + settings[i] + '"]').attr("data-height");
					}
					if ($('[name="' + settings[i] + '"]').attr("data-uiColor") > "") {
						$uiColor = $('[name="' + settings[i] + '"]').attr("data-uiColor");
					}
					CKEDITOR.replace(settings[i], {
						width: '100%',
						height: $height,
						uiColor: $uiColor,
						language: 'ar',
						toolbar: $toolbar,
						resize_enabled: true,
						on: {
							instanceReady: function (ev) {
								this.dataProcessor.writer.setRules('p', {
									indent: false,
									breakBeforeOpen: true,
									breakAfterOpen: false,
									breakBeforeClose: false,
									breakAfterClose: true
								});
								this.dataProcessor.writer.setRules('div', {
									indent: false,
									breakBeforeOpen: true,
									breakAfterOpen: false,
									breakBeforeClose: false,
									breakAfterClose: true
								});
								this.dataProcessor.writer.setRules('font', {
									indent: false,
									breakBeforeOpen: true,
									breakAfterOpen: false,
									breakBeforeClose: false,
									breakAfterClose: true
								});
							}
						}
					});
				}
			}
		};


		$.timer_down = function ($time) {
			var $datetime_now,
					$seconds_new,
					$datetime,
					$time_remaining,
					$return_year,
					$return_month,
					$return_day,
					$return_hours,
					$return_minutes,
					$return_seconds,
					$milliseconds;

			$datetime_now = new Date();
			$datetime = new Date($time);
			$seconds_new = $datetime_now.getSeconds();


			if ($datetime.getTime() > $datetime_now.getTime()) {
				$time_remaining = parseInt($datetime.getTime() - $datetime_now.getTime());

				$milliseconds = parseInt($time_remaining / 1000);

				$return_minutes = parseInt($time_remaining / 1000 / 60);
				$return_hours = parseInt($return_minutes / 60);
				$return_day = parseInt($return_hours / 24);
				$return_month = parseInt($return_day / 30);
				$return_year = parseInt($return_month / 12);

				$return_seconds = String($seconds_new - 59).replace("-", "");
				if ($return_seconds <= 9) {
					$return_seconds = "0" + $return_seconds;
				}
				if ($return_minutes <= 119 && $return_minutes >= 60) {
					$return_minutes = parseInt($return_minutes - 60);
				} else if ($return_minutes >= 120) {
					$return_minutes = String(parseInt(($return_hours * 60) - $return_minutes)).replace('-', '');
					if ($return_minutes < 1) {
						$return_minutes = "59";
						$return_hours = parseInt($return_hours - 1);
					}
				}

				if ($return_minutes <= 9) {
					$return_minutes = "0" + $return_minutes;
				}

				if ($return_hours <= 9) {
					$return_hours = "0" + $return_hours;
				}
				return $return_hours + ":" + $return_minutes + ":" + $return_seconds;

			} else {
				return false;
			}

		};

		$.fn.SetDatePicker = function (options) {
			var settings = {
				changeMonth: true,
				changeYear: true,
				dateFormat: "yy-mm-dd",
				isRTL: true
			};
			if (options) {
				$.extend(settings, options);
			}
			$(this).datepicker(settings);
		};

		$.fn.loading = function (options) {
			var $this = $(this);
			$('.maskupload').remove();
			if (options !== false) {
				$this.append($maskupload_tpl);
				$('.maskupload').show(0);
				$('.maskupload').append($loding_html);
			} else {
				$('.maskupload').fadeOut(200, function () {
					$('.maskupload').remove(0);
				});
			}
		};

		$.fn.checked = function (options) {
			var settings = {
				Thisphp_check_class: '.checkbox_this'
			};
			if (options) {
				$.extend(settings, options);
			}
			var $this = $(this);
			$this.on('change', function () {
				if ($this.prop("checked") === true) {
					$('.row-data').addClass("warning");
					$(settings.Thisphp_check_class).prop("checked", true);
				} else {
					$('.row-data').removeClass("warning");
					$(settings.Thisphp_check_class).prop("checked", false);
				}
				return false;
			});
		};

		$.fn.btn_switc = function (options) {
			var settings = {
				'yes': 'Yes',
				'no': 'No'
			};
			if (options) {
				$.extend(settings, options);
			}

			var $this = $(this);
			$this.each(function (index) {
				var $this_name = $this.eq(index).attr("name");
				var $this_val = $this.eq(index).val();
				if ($this.eq(index).attr("data-val")) {
					var $data_val = String($this.eq(index).attr("data-val"));
					var $_val = $data_val.split("|");
					settings.yes = $_val[0];
					settings.no = $_val[1];
				}
				var $html = $.sprintf('<div class="switcher">\n\
							<span class="switch-text">' + settings.yes + '</span>\n\
							<span class="switch-handle"></span>\n\
							<input type="hidden" name="%s" id="%s" value="%s">\n\
						</div>', $this_name, $this_name, $this_val);
				$this.eq(index).replaceWith($html);
				if ($this_val === "1") {
					$(".switcher").eq(index).addClass("toggle");
					$(".switcher").eq(index).find(".switch-handle").addClass("toggle");
					$(".switcher").eq(index).find(".switch-text").addClass("toggle");
					$(".switcher").eq(index).find(".switch-text").text(settings.no);
				} else {
					$(".switcher").eq(index).removeClass("toggle");
					$(".switcher").eq(index).find(".switch-handle").removeClass("toggle");
					$(".switcher").eq(index).find(".switch-text").removeClass("toggle");
					$(".switcher").eq(index).find(".switch-text").text(settings.yes);
				}
			});
			$(".switcher").on('click', function () {
				if ($(this).attr('class').match(/disabled/g) === null) {
					var $index = $(".switcher").index(this);
					var $switcher = $(".switcher").eq($index);
					var $btn = $(".switcher").eq($index).find('[type="hidden"]');
					var $type = $btn.val();
					if ($type === "1") {
						$switcher.removeClass("toggle");
						$switcher.find(".switch-handle").removeClass("toggle");
						$switcher.find(".switch-text").removeClass("toggle");
						$switcher.find(".switch-text").text(settings.yes);
						$type = '0';
						$btn.val($type);
					} else {
						$switcher.addClass("toggle");
						$switcher.find(".switch-handle").addClass("toggle");
						$switcher.find(".switch-text").addClass("toggle");
						$switcher.find(".switch-text").text(settings.no);
						$type = '1';
						$btn.val($type);
					}
				}
			});
		};

		$.fn.upload = function (options) {
			var settings = {
				input_FileName: 'file_upload[]',
				callback_function: function () {
				}
			};
			if (options) {
				$.extend(settings, options);
			}
			$(this).on("click", function () {
				$(".start_upload").removeAttr("disabled");
				if ($(this).attr('data-element') == 'true') {
					$callbackfunction = false;
					$(".more_upload").hide(0);
				} else {
					$callbackfunction = true;
					$(".more_upload").show(0);
				}
				if ($(this).attr('data-src') != undefined) {
					$uptourl = 'ajax/upload/' + $(this).attr('data-src');
				} else {
					$uptourl = 'ajax/upload/other';
				}
			});
			var $this = $(".start_upload");
			$this.off('click');
			$this.on('click', function () {
				$(".result").html($loding_html);
				$(".loading").fadeIn(500);
				var $files = $(".upload_file");
				var $formdata = new FormData();
				$.each($files, function (iq, file_data) {
					$.each($files[iq].files, function (i, files_d_date) {
						$formdata.append(settings.input_FileName, files_d_date);
					});
				});
				$.ajax({
					type: 'POST',
					url: $uptourl,
					data: $formdata,
					cache: false,
					contentType: false,
					processData: false,
					success: function (data) {
						$(".loading").fadeOut(500);
						if ($callbackfunction == true) {
							settings.callback_function(data);
						} else {
							var $json_date = jQuery.parseJSON(data);
							var $file = $json_date[0];
							$('.retuurn_upload').val($file);
							$('.img_retuurn_upload').attr({'src': $file});
							$('.upload_modal').modal('hide');
						}
						return false;
					}

				});
			});
		};

		$.fn.UploadOnClick = function (options) {
			var settings = {
				input_File: 'file_upload[]',
				return_callback: false,
				callback_function: function () {
				}
			};
			if (options) {
				$.extend(settings, options);
			}
			var $this = $(this);
			$this.on('click', function () {
				$('.maskupload').remove();
				$(".uploadonclick").remove();
				var $index = $this.index(this);
				$('body').append($upload_file_tpl);
				$('body').append($maskupload_tpl);
				$('.maskupload').slideUp(0);
				var $uploadonclick = $('.uploadonclick');
				$uploadonclick.click();
				$uploadonclick.on('change', function () {
					var $maskupload = $('.maskupload');
					$maskupload.slideDown(0);
					$maskupload.append($loding_html);
					var $files = $("body > .uploadonclick");
					var $dirupload = $this.eq($index).attr('data-src');
					if ($dirupload != '' || $dirupload != 'undefined') {
						$dirupload = '';
					}
					$uptourl = 'ajax/upload/' + $dirupload;
					var $formdata = new FormData();
					$.each($files, function (iq, file_data) {
						$.each($files[iq].files, function (i, files_d_date) {
							$formdata.append(settings.input_File, files_d_date);
						});
					});
					$.ajax({
						type: 'POST',
						url: $uptourl,
						data: $formdata,
						cache: false,
						contentType: false,
						processData: false,
						success: function (data) {
							$('.maskupload').remove();
							$(".uploadonclick").remove();
							var $json_date = $.parseJSON(data);
							var $file = $json_date[0];
							$('.retuurn_upload').val($file);
							if (settings.return_callback === false) {
								$this.eq($index).html('<img src="' + $file + '" class="img-responsive img_retuurn_upload"><span class="chenge" data-text="&nbsp; تغيير&nbsp;"></span>');
							} else {
								settings.callback_function($json_date);
							}
						}
					});
				});
				$uploadonclick.on('click', function (events) {});
			});
		};

		$.fn.ReadUploadOnClick = function (options) {
			var settings = {
				call_back: null,
				input_name: 'image_upload',
				other_html: '',
				max_upload: 10,
				return_files: '.get_upload_img'
			};
			if (options) {
				$.extend(settings, options);
			}

			var $this = $(this);
			var $this_data_src = $this.attr('data-src');
			if ($this_data_src == 'undefined') {
				$this_data_src = '';
			}
			if ($this.attr('max_upload')) {
				settings.max_upload = $this.attr('max_upload');
			}
			$this.on('click', function () {
				$('.readfileonclick').remove();
				$('body').append($readfile_upload_tpl);
				var $readfileonclick = $('.readfileonclick');
				$readfileonclick.hide(0);

				$readfileonclick.click();
				$readfileonclick.on('change', function (change_event) {
					var $count_upload = 1;
					var $input_target = change_event.target;
					var $formdata = new FormData();
					$.each($input_target.files, function (file_index) {
						if ($this.find('.img_list').length < settings.max_upload) {
							if ($count_upload <= settings.max_upload) {
								var File_Reader = new FileReader();

								$formdata.append('file_upload[]', $input_target.files[file_index]);

								File_Reader.readAsDataURL($input_target.files[file_index]);
								$count_upload++;
							}
						}
					});
					$('body').loading(true);
					$.ajax({
						url: 'ajax/upload/' + $this_data_src,
						type: 'POST',
						data: $formdata,
						cache: false,
						contentType: false,
						processData: false,
						success: function (data) {
							var $json_date = $.parseJSON(data);
							$.each($json_date.data, function ($img) {
								var $img_url = $json_date.data[$img].replace(/\\/g, '');
								$(settings.return_files).append($.sprintf($img_upload_tpl, settings.input_name, $img_url, $img_url, settings.other_html + '<span class="remove_this_img fa fa-times"></span>'));
							});
							$('body').loading(false);
						}
					});

					$(settings.return_files).on('DOMSubtreeModified', function () {
						$('.remove_this_img').off('click');
						$('.remove_this_img').on('click', function () {
							var $index = $('.remove_this_img').index(this);
							$('.remove_this_img').eq($index).parent().parent().remove();
						});
						if (settings.call_back !== null) {
							settings.call_back();
						}
					});
					$readfileonclick.remove();
				});


			});


		};

		$.fn.DragDropUpload = function (options) {
			var settings = {
				call_back: null,
				toggle_class: 'DD_Upload',
				input_name: 'image_upload',
				other_html: '',
				max_upload: 10
			};
			if (options) {
				$.extend(settings, options);
			}
			var $this = $(this).eq($(this).index(this));
			if ($this.attr('max_upload')) {
				settings.max_upload = $this.attr('max_upload');
			}
			var $this_data_src = $this.attr('data-src');
			if ($this_data_src == 'undefined') {
				$this_data_src = '';
			}
			$this.on('dragover', function (event) {
				$this.addClass(settings.toggle_class);
				event.stopPropagation();
				event.preventDefault();
			});

			$this.on('dragleave', function (event) {
				$this.removeClass(settings.toggle_class);
				event.stopPropagation();
				event.preventDefault();
			});

			$this.bind('drop', function (event) {
				$this.removeClass(settings.toggle_class);
				event.stopPropagation();
				event.preventDefault();
				var $count_upload = 1;
				var $FilesDropToUpload = event.originalEvent.target.files || event.originalEvent.dataTransfer.files;
				var $formdata = new FormData();
				$.each($FilesDropToUpload, function (index, file_data) {
					if ($this.find('.img_list').length < settings.max_upload) {
						if ($count_upload <= settings.max_upload) {
							var File_Reader = new FileReader();
							$formdata.append('file_upload[]', file_data);
							File_Reader.readAsDataURL($FilesDropToUpload[index]);
							$count_upload++;
						}
					}
				});
				$('body').loading(true);
				$.ajax({
					url: 'ajax/upload/' + $this_data_src,
					type: 'POST',
					data: $formdata,
					cache: false,
					contentType: false,
					processData: false,
					success: function (data) {
						$.print(data, true);
						var $json_date = $.parseJSON(data);
						$.each($json_date, function ($img) {
							var $img_url = $json_date[$img].replace(/\\/g, '');
							$this.append($.sprintf($img_upload_tpl, settings.input_name, $img_url, $img_url, settings.other_html + '<span class="remove_this_img" data-icon="&#xe36b"></span>'));
						});
						$('body').loading(false);
					}
				});

				$this.on('DOMSubtreeModified', function () {
					$('.remove_this_img').off('click');
					$('.remove_this_img').on('click', function () {
						var $index = $('.remove_this_img').index(this);
						$('.remove_this_img').eq($index).parent().parent().remove();
					});
				});
			});
		};

		$.fn.tpscroll = function (options) {
			var settings = {};

			if (options) {
				$.extend(settings, options);
			}

			var $this = $(this);
			$this.addClass('parent-tp-mask-scroll');
			$this.each(function (index) {
				var $this_index = $this.index(index);
				var $tp_prop = $this.eq($this_index).attr('data-tpscroll-align');
				var $tp_height = $this.eq($this_index).attr('data-tpscroll-height');

				/* add tp_scroll template */
				$this.eq($this_index).parent().append($tp_scroll_tpl);

				/* set height size */
				var $this_height = $this.eq(index).css('height');
				$this.eq(index).attr({
					'oregnal_height': $this_height
				});
				$this.eq(index).css({
					'height': $tp_height
				});


				/* set left class */
				if ($tp_prop == "left") {
					$('.parent-tp-mask-scroll .tp-mask-scroll').addClass('left-scroll');
				}

				$this_height = parseInt(parseInt($this_height) / parseInt($tp_height));
				var $tp_mask_scroll = parseInt($('.tp-mask-scroll').eq(index).height() / $this_height);
				/* set tp-scroll height size */
				$('.tp-mask-scroll .tp-scroll').eq(index).css({'height': $tp_mask_scroll + 'px'})

			});


			$('.tp-mask-scroll .tp-scroll').off('mousedown');
			$('.tp-mask-scroll .tp-scroll').on('mousedown', function (scroll_event) {
				$('.tp-mask-scroll').on('mousemove', function (mask_event) {
					var $tp_scroll_index = $('.tp-mask-scroll .tp-scroll').index(this);
					var $tp_scroll = $('.tp-mask-scroll .tp-scroll').eq($tp_scroll_index);
					var $tp_scroll_top = parseInt(mask_event.offsetY / 2);
					$tp_scroll.css({'top': $tp_scroll_top + 'px'});
					$('.parent-tp-mask-scroll').eq($tp_scroll_index).scrollTop($tp_scroll_top);
				});
			});
		};


		$.cookie = function (options, ctype) {
			var settings = {}
			var $cookiesname = options;
			if (options) {
				$.extend(settings, options);
			}
			if (ctype) {
				var $get_cookies = document.cookie.split(";");
				var $array_keys = Array();
				$.each($get_cookies, function ($key, $val) {
					var k = new String($val);
					k = k.replace(/^\s+|\s+$/g, "");
					$array_keys[k.substr(0, k.indexOf("="))] = k.substr(k.indexOf("=") + 1);
				});
				return $array_keys[$cookiesname];
			} else {
				$.each(settings, function ($keys, $vals) {
					document.cookie = $keys + "=" + $vals;
				});
			}
		};

		$.GoogleMapsAutocomplete = function (options) {
			var settings = {
				AutoComplete: 'pac-input',
				MapConvas: 'map-canvas',
				callback: false,
				callback_function: function () {
				},
				default_lat: '',
				default_lng: '',
				select_map: true,
			};
			var markers = [];
			var map;
			var searchBox;
			var input = null;
			if (options) {
				$.extend(settings, options);
			}
			if (settings.default_lat == '') {
				settings.default_lat = $("#" + settings.MapConvas).attr('data-lat');
			}
			if (settings.default_lng == '') {
				settings.default_lng = $("#" + settings.MapConvas).attr('data-lng');
			}
			function initialize() {
				map = new google.maps.Map(document.getElementById(settings.MapConvas), {
					mapTypeId: google.maps.MapTypeId.ROADMAP
				});
				var defaultBounds = new google.maps.LatLngBounds(
						new google.maps.LatLng(settings.default_lat, settings.default_lng),
						new google.maps.LatLng(settings.default_lat, settings.default_lng)
						);
				map.fitBounds(defaultBounds);

				input = (document.getElementById(settings.AutoComplete));
				map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
				searchBox = new google.maps.places.SearchBox((input));
				var $Event_data;
				google.maps.event.addListener(searchBox, 'places_changed', function () {
					var places = searchBox.getPlaces();

					if (places.length == 0) {
						return;
					}
					for (var i = 0, marker; marker = markers[i]; i++) {
						marker.setMap(null);
					}

					markers = [];
					var bounds = new google.maps.LatLngBounds();
					for (var i = 0, place; place = places[i]; i++) {
						var image = {
							url: place.icon,
							size: new google.maps.Size(71, 71),
							origin: new google.maps.Point(0, 0),
							anchor: new google.maps.Point(17, 34),
							scaledSize: new google.maps.Size(25, 25)
						};

						var marker = new google.maps.Marker({
							map: map,
							icon: image,
							title: place.name,
							position: place.geometry.location
						});

						markers.push(marker);
						$Event_data = {
							'place': place,
							'name': place.name,
							'lat': place.geometry.location.lat(),
							'lng': place.geometry.location.lng(),
							'events': google.maps.event
						};
						map.fitBounds(new google.maps.LatLngBounds(
								new google.maps.LatLng(place.geometry.location.lat(), place.geometry.location.lng()),
								new google.maps.LatLng(place.geometry.location.lat(), place.geometry.location.lng())
								));
						if (settings.callback === true) {
							settings.callback_function($Event_data);
						}
						bounds.extend(place.geometry.location);
					}
					if (settings.select_map != true) {
						map.fitBounds(bounds);
					}
				});

				google.maps.event.addListener(map, 'click', function (event) {
					var $lat = event.latLng.lat();
					var $lng = event.latLng.lng();

					var service = new google.maps.places.PlacesService(map);
					service.nearbySearch({
						location: {
							lat: $lat,
							lng: $lng
						},
						radius: 3
					}, function (place, status) {
						if (status == google.maps.places.PlacesServiceStatus.OK) {
							map.fitBounds(new google.maps.LatLngBounds(
									new google.maps.LatLng($lat, $lng),
									new google.maps.LatLng($lat, $lng)
									));

							service.getDetails({
								placeId: place[0].place_id
							}, function (place, status) {
								if (status === google.maps.places.PlacesServiceStatus.OK) {
									$Event_data = {
										'place': place,
										'name': place.formatted_address,
										'lat': place.geometry.location.lat(),
										'lng': place.geometry.location.lng(),
										'events': google.maps.event
									};
									if (settings.callback === true) {
										settings.callback_function($Event_data);
									}
								}
							});



						}
					});



				});

			}
			google.maps.event.addDomListener(window, 'load', initialize);


		};

	})(jQuery);