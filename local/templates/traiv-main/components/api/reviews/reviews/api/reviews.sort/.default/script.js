/*!
 * $.fn.apiReviewsSort
 */
(function ($) {

	"use strict"; // Hide scope, no $ conflict

	var location = window.history.location || window.location;
	var defaults = {};
	var methods = {
		init: function (params) {

			var options = $.extend(true, {}, defaults, options, params);
			if (!this.data('apiReviewsSort')) {
				this.data('apiReviewsSort', options);

				var reviewsId = '#reviews .api-reviews-list';
				var sortId = '#reviews .api-reviews-sort';

				$(sortId).on('click', 'a', function (e) {
					$.fn.apiWait('show');
					//console.log('Hi');

					var href = $(this).attr('href');

					//������� �������� ������
					$.ajax({
						type: 'POST',
						url: href,
						async: true,
						data: {
							sessid: BX.bitrix_sessid(),
							API_REVIEWS_LIST_AJAX: 'Y',
							API_REVIEWS_LIST_ACTION: 'sort'
						},
						error: function (jqXHR, textStatus, errorThrown) {
							console.error('textStatus: ' + textStatus);
							console.error('errorThrown: ' + errorThrown);
						},
						success: function (reviewsData) {

							//������ ����������
							$.ajax({
								type: 'POST',
								url: href,
								async: false,
								data: {
									sessid: BX.bitrix_sessid(),
									API_REVIEWS_SORT_AJAX: 'Y'
								},
								error: function (jqXHR, textStatus, errorThrown) {
									console.log('textStatus: ' + textStatus);
									console.log('errorThrown: ' + errorThrown);
								},
								success: function (sortData) {
									$(sortId).html(sortData);
								}
							});

							$(reviewsId).replaceWith(reviewsData);

							/**
							 @param {Object} [data]
							 @param {string} [title]
							 @param {string} [url]
							 @return {void}
							 */
							history.pushState({}, '', href);

							$.fn.apiWait('hide');
						}
					});

					e.preventDefault();
				})

			}

			return this;
		},
	};

	$.fn.apiReviewsSort = function (method) {
		if (methods[method]) {
			return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
		} else if (typeof method === 'object' || !method) {
			return methods.init.apply(this, arguments);
		} else {
			$.error('Error! Method "' + method + '" not found in plugin $.fn.apiReviewsSort');
		}
	};

})(jQuery);
