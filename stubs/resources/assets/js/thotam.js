var isRtl = $("html").attr("dir") === "rtl";

// ThoTam_BlockUI
function ThoTam_BlockUI() {
	$.blockUI({
		message:
			'<div class="sk-fold sk-primary mx-auto mb-4"><div class="sk-fold-cube"></div><div class="sk-fold-cube"></div><div class="sk-fold-cube"></div><div class="sk-fold-cube"></div></div><h5 class="text-primary">Đang xử lý...</h5>',
		css: {
			backgroundColor: "transparent",
			border: "0",
			zIndex: 9999999,
		},
		overlayCSS: {
			backgroundColor: "#fff",
			opacity: 0.6,
			zIndex: 9999990,
		},
		centerX: true,
		centerY: true,
		onBlock: function () {
			$("div.blockUI.blockMsg.blockPage").css(
				"top",
				"calc(50% - " +
					$("div.blockUI.blockMsg.blockPage").height() / 2 +
					"px )"
			);

			$("div.blockUI.blockMsg.blockPage").css(
				"left",
				"calc(50% - " +
					$("div.blockUI.blockMsg.blockPage").width() / 2 +
					"px )"
			);
		},
	});
}

$(document).on("click", "[thotam-blockui]", function () {
	ThoTam_BlockUI();
});

//$.blockUI();
window.addEventListener("blockUI", function (e) {
	ThoTam_BlockUI();
});

//$.unblockUI();
window.addEventListener("unblockUI", function (e) {
	$.unblockUI();
});

//Gọi livewire method
$(document).on("click", "[thotam-livewire-method]", function () {
	ThoTam_BlockUI();
	Livewire.emit(
		$(this).attr("thotam-livewire-method"),
		$(this).attr("thotam-model-id")
	);
});

//Xử lý khi dữ liệu đã được load xong
document.addEventListener("DOMContentLoaded", () => {
	Livewire.hook("message.failed", (message, component) => {
		$.unblockUI();
	});

	Livewire.hook("message.processed", (message, component) => {
		thotam_rerender();
	});
});

//Datatable Custom fillter
if ($("select.colum_filter_id_single").length != 0) {
	$("select.colum_filter_id_single").each(function (e) {
		$(this)
			.wrap('<div class="position-relative dt-select2"></div>')
			.select2({
				placeholder: $(this).attr("placeholder"),
				minimumResultsForSearch: 6,
				allowClear: false,
				dropdownParent: $("div.card-datatable.table-responsive"),
			});
	});
}

if ($("select.colum_filter_id_multi").length != 0) {
	$("select.colum_filter_id_multi").each(function (e) {
		$(this)
			.wrap('<div class="position-relative dt-select2"></div>')
			.select2({
				placeholder: $(this).attr("placeholder"),
				minimumResultsForSearch: 6,
				allowClear: false,
				dropdownParent: $("div.card-datatable.table-responsive"),
			});
	});
}

if ($("input.colum_filter_id_date").length != 0) {
	$("input.colum_filter_id_date").each(function (e) {
		$(this).datepicker({
			language: "vi",
			autoclose: true,
			toggleActive: true,
			todayHighlight: true,
			todayBtn: "linked",
			clearBtn: $(this).attr("thotam-clearBtn") == "false" ? false : true,
			maxViewMode: 3,
			minViewMode: 1,
			startView: !!$(this).attr("thotam-startview")
				? $(this).attr("thotam-startview")
				: 1,
			weekStart: 1,
			format: "mm-yyyy",
			container: !!$(this).attr("thotam-container")
				? "#" + $(this).attr("thotam-container")
				: "body",
			orientation: isRtl ? "auto right" : "auto left",
		});
	});
}

$("[thotam-clear-btn]").on("click", function () {
	$("[thotam-clear-target=" + $(this).attr("thotam-clear-btn") + "]").val(
		null
	);

	dt_draw_event_function();
});

$("[thotam_dt_date_range_filter]").on("change", function () {
	dt_draw_event_function();
});

$("[thotam_dt_date_filter]").on("change", function () {
	dt_draw_event_function();
});

$("[thotam_dt_month_filter]").on("change", function () {
	dt_draw_event_function();
});

$("[thotam_dt_colum_filter]").on("change", function () {
	dt_draw_event_function();
});

$("[thotam_dt_clear_button]").on("click", function () {
	$($(this).attr("thotam_dt_clear_button")).val(null);
	dt_draw_event_function();
});

function dt_draw_event_function() {
	var dt_draw_event; // The custom event that will be created
	if (document.createEvent) {
		dt_draw_event = document.createEvent("HTMLEvents");
		dt_draw_event.initEvent("dt_draw", true, true);
		dt_draw_event.eventName = "dt_draw";
		window.dispatchEvent(dt_draw_event);
	} else {
		dt_draw_event = document.createEventObject();
		dt_draw_event.eventName = "dt_draw";
		dt_draw_event.eventType = "dt_draw";
		window.fireEvent("on" + dt_draw_event.eventType, dt_draw_event);
	}
}

//Ẩn toàn bộ modal
window.addEventListener("hide_modals", function (e) {
	$(".modal.fade").modal("hide");
});

//Ản modal cụ thể
window.addEventListener("hide_modal", (event) => {
	$(event.detail).modal("hide");
});

//Hiện modal cụ thể
window.addEventListener("show_modal", (event) => {
	$(event.detail).modal("show");
});

//Ẩn sau đó hiện modal
window.addEventListener("hide_then_show_modal", (event) => {
	$(".modal.fade").modal("hide");
	window.show_modal = event.detail;
});

$(".modal.fade").on("hidden.bs.modal", function (e) {
	if (!!window.show_modal) {
		$.unblockUI();
		$(window.show_modal).modal("show");
	}
});

$(".modal.fade").on("shown.bs.modal", function (e) {
	window.show_modal = null;
});

//Rerendering when updated
function thotam_rerender() {
	if ($("select[thotam-select2-rerender]").length != 0) {
		$("select[thotam-select2-rerender]").each(function (e) {
			thotam_livewire_id = eval($(this).attr("thotam-livewire-id"));

			if (!!$(this).attr("multiple")) {
				html = "";
			} else {
				html = "<option selected></option>";
			}

			array_data = thotam_livewire_id.get(
				$(this).attr("thotam-select2-rerender")
			);

			array_data.forEach((element) => {
				html +=
					"<option value='" +
					element.value +
					"'>" +
					element.text +
					"</option>";
			});

			$(this).html(html);

			$(this).val(thotam_livewire_id.get($(this).attr("wire:model")));

			$(this).trigger("change.select2");
		});
	}

	if ($("input[thotam-datepicker='true']").length != 0) {
		$("input[thotam-datepicker='true']").each(function (e) {
			$(this).datepicker("update");
		});
	}

	if ($("input[thotam-datetimepicker='true']").length != 0) {
		$("input[thotam-datetimepicker='true']").each(function (e) {
			$(this).datetimepicker("update");
		});
	}
}
