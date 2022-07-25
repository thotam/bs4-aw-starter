import "select2/dist/js/select2.full.js";

//Livewire with select2
window.thotam_select2 = function (thotam_el, thotam_livewire_id) {
	setTimeout(function () {
		$(thotam_el).select2({
			placeholder: $(thotam_el).attr("thotam-placeholder"),
			minimumResultsForSearch: $(thotam_el).attr("thotam-search"),
			allowClear: !!$(thotam_el).attr("thotam-allow-clear"),
			dropdownParent: $("#" + $(thotam_el).attr("id") + "_div"),
		});

		if (!!$(thotam_el).attr("multiple")) {
			$(thotam_el).on("select2:close", function (e) {
				thotam_livewire_id.set(
					$(thotam_el).attr("wire:model"),
					$(thotam_el).val()
				);
			});
		} else {
			$(thotam_el).on("change", function (e) {
				thotam_livewire_id.set(
					$(thotam_el).attr("wire:model"),
					$(thotam_el).val()
				);
			});
		}
	}, 250);
};

//Livewire with ajax_select2
window.thotam_ajax_select2 = function (
	thotam_el,
	thotam_livewire_id,
	url,
	perPage,
	token,
	mail_tag = null
) {
	$(thotam_el).select2({
		placeholder: $(thotam_el).attr("thotam-placeholder"),
		minimumResultsForSearch: $(thotam_el).attr("thotam-search"),
		allowClear: !!$(thotam_el).attr("thotam-allow-clear"),
		dropdownParent: $("#" + $(thotam_el).attr("id") + "_div"),
		ajax: {
			url: url,
			dataType: "json",
			method: "POST",
			headers: {
				"X-CSRF-TOKEN": token,
			},
			delay: 1000,
			data: function (params) {
				return {
					search: params.term, // search term
					page: params.page || 1,
					perPage: perPage,
					mail_tag: mail_tag,
				};
			},
			processResults: function (data, params) {
				params.page = params.page || 1;

				return {
					results: data.data,
					pagination: {
						more: params.page * perPage < data.total_count,
					},
				};
			},
			cache: true,
		},
	});

	if (!!$(thotam_el).attr("multiple")) {
		$(thotam_el).on("select2:close", function (e) {
			thotam_livewire_id.set(
				$(thotam_el).attr("wire:model"),
				$(thotam_el).val()
			);
		});
	} else {
		$(thotam_el).on("change", function (e) {
			thotam_livewire_id.set(
				$(thotam_el).attr("wire:model"),
				$(thotam_el).val()
			);
		});
	}
};

//Livewire filter with select2
window.thotam_filter_select2 = function (thotam_el, thotam_livewire_id) {
	$(thotam_el)
		.wrap('<div class="position-relative dt-select2"></div>')
		.select2({
			placeholder: $(thotam_el).attr("placeholder"),
			minimumResultsForSearch: 6,
			allowClear: false,
			dropdownParent: $("div.card-datatable.table-responsive"),
		});

	if (!!$(thotam_el).attr("multiple")) {
		$(thotam_el).on("select2:close", function (e) {
			thotam_livewire_id.set(
				$(thotam_el).attr("wire:model"),
				$(thotam_el).val()
			);
		});
	} else {
		$(thotam_el).on("change", function (e) {
			thotam_livewire_id.set(
				$(thotam_el).attr("wire:model"),
				$(thotam_el).val()
			);
		});
	}
};
