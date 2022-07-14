import "bootstrap-datepicker/dist/js/bootstrap-datepicker.js";
import "bootstrap-datepicker/dist/locales/bootstrap-datepicker.vi.min.js";

//Livewire with datepicker
window.thotam_datepicker = function (
	thotam_el,
	thotam_livewire_id,
	minview = 0,
	startview = 0,
	format = "dd-mm-yyyy",
	vertical_align = "auto"
) {
	$(thotam_el)
		.datepicker({
			language: "vi",
			autoclose: true,
			toggleActive: true,
			todayHighlight: true,
			todayBtn: "linked",
			clearBtn: $(this).attr("thotam-clearBtn") == "false" ? false : true,
			maxViewMode: 3,
			minViewMode: minview,
			startView: startview,
			weekStart: 1,
			format: format,
			container: !!$(thotam_el).attr("thotam-container")
				? "#" + $(thotam_el).attr("thotam-container")
				: "body",
			orientation:
				$("html").attr("dir") === "rtl"
					? vertical_align + " right"
					: vertical_align + " left",
		})
		.on("hide", function (e) {
			thotam_livewire_id.set(
				$(thotam_el).attr("wire:model"),
				$(thotam_el).val()
			);
		});

	$(thotam_el).attr("thotam-datepicker", true);
};
