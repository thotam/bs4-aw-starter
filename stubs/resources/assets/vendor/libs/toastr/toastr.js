import * as toastr from "toastr/toastr.js";

export { toastr };

//Toastr thông báo
window.addEventListener("toastr", (event) => {
	toastr[event.detail.type](event.detail.message, event.detail.title, {
		positionClass: "toast-top-right",
		closeButton: true,
		progressBar: true,
		timeOut: 15000,
		extendedTimeOut: 2000,
		preventDuplicates: false,
		newestOnTop: true,
		rtl: $("body").attr("dir") === "rtl" || $("html").attr("dir") === "rtl",
	});
});
