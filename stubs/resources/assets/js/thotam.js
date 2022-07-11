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
