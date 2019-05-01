function uploadImage() {
	var formData = new FormData();
	formData.append("file", $("#HotelFeaturedImg")[0].files[0]);

	$.ajax({
		url: siteUrl + "ajax/uploadhotelImage",
		type: "POST",
		data: formData,
		processData: false, // tell jQuery not to process the data
		contentType: false, // tell jQuery not to set contentType
		dataType: "json",
		success: function(data) {
			$(".img").html(
				'<div><img class="img-responsive" width="150" src="' +
					data.file +
					'"><a href="javascript:void(0)" class="imgdelete" data-action="hotelImagedelete" data-imgId="" data-imgName="' +
					data.fileName +
					'"><i class="fas fa-times"></i></a><input type="hidden" name="data[Hotel][featured_image]" value="' +
					data.fileName +
					'"></div>'
			);
		}
	});
}

function handleFileSelect(evt) {
	var ofiles = evt.target.files;
	var files = evt.target.files;
	var action = $("#files").attr("data-action");
	var model = $("#files").attr("data-model");
	var deleteAction = $("#files").attr("data-deleteAction");
	for (var i = 0, f; (f = files[i]); i++) {
		var reader = new FileReader();
		reader.onload = (function(theFile) {
			var ext = theFile.name.substr(-3);
			if (
				ext != "jpeg" &&
				ext != "jpg" &&
				ext != "png" &&
				ext != "JPEG" &&
				ext != "JPG" &&
				ext != "PNG" &&
				ext != "peg" &&
				ext != "PEG"
			) {
				swal(
					{
						title: "Error!!",
						text: "Please choose valid file type.",
						type: "warning",
						showCancelButton: false,
						closeOnConfirm: true
					},
					function() {
						return false;
					}
				);
				return false;
			}
			var $data = new FormData();
			$data.append("file", theFile);
			$.ajax({
				url: siteUrl + "ajax/" + action,
				data: $data,
				processData: false,
				contentType: false,
				type: "POST",
				dataType: "json",
				success: function(data) {
					if (data.status == true) {
						$("#images").append(
							'<li><div class="img-thumb" style="background-image:url(' +
								data.file +
								')"><a href="javascript:void(0)" class="imgdel" data-action="' +
								deleteAction +
								'" data-imgId="" data-imgName="' +
								data.fileName +
								'"><i class="fas fa-times"></i></a><input type="hidden" name="data[' +
								model +
								'][images][]" value="' +
								data.fileName +
								'"><input type="hidden" name="data[' +
								model +
								'][alt][]" value="' +
								data.alt +
								'"></div></li>'
						);
					}
				}
			});
		})(f);
		reader.readAsDataURL(f);
	}
}
function handleFileSelectNew(evt) {
	var ofiles = evt.target.files;
	var files = evt.target.files;
	var action = $("#filesRoom").attr("data-action");
	var model = $("#filesRoom").attr("data-model");
	var deleteAction = $("#filesRoom").attr("data-deleteAction");
	for (var i = 0, f; (f = files[i]); i++) {
		var reader = new FileReader();
		reader.onload = (function(theFile) {
			var ext = theFile.name.substr(-3);
			if (
				ext != "jpeg" &&
				ext != "jpg" &&
				ext != "png" &&
				ext != "JPEG" &&
				ext != "JPG" &&
				ext != "PNG" &&
				ext != "peg" &&
				ext != "PEG"
			) {
				swal(
					{
						title: "Error!!",
						text: "Please choose valid file type.",
						type: "warning",
						showCancelButton: false,
						closeOnConfirm: true
					},
					function() {
						return false;
					}
				);
				return false;
			}
			var $data = new FormData();
			$data.append("file", theFile);
			$.ajax({
				url: siteUrl + "ajax/" + action,
				data: $data,
				processData: false,
				contentType: false,
				type: "POST",
				dataType: "json",
				success: function(data) {
					if (data.status == true) {
						$("#imagesBedType").append(
							'<li><div class="img-thumb" style="background-image:url(' +
								data.file +
								')"><a href="javascript:void(0)" class="imgdel" data-action="' +
								deleteAction +
								'" data-imgId="" data-imgName="' +
								data.fileName +
								'"><i class="fas fa-times"></i></a><input type="hidden" name="data[' +
								model +
								'][images][]" value="' +
								data.fileName +
								'"><input type="hidden" name="data[' +
								model +
								'][alt][]" value="' +
								data.alt +
								'"></div></li>'
						);
					}
				}
			});
		})(f);
		reader.readAsDataURL(f);
	}
}
// function for  validate file extension
var validExt = ".mp4";
function fileExtValidate(fdata) {
	var filePath = fdata.value;
	var getFileExt = filePath
		.substring(filePath.lastIndexOf(".") + 1)
		.toLowerCase();
	var pos = validExt.indexOf(getFileExt);
	if (pos < 0) {
		$("#HotelVideo").val("");
		alert("This file is not allowed, please upload valid file.");
		return false;
	} else {
		return true;
	}
}

var maxSize = "3024";

function fileSizeValidate(fdata) {
	if (fdata.files && fdata.files[0]) {
		var fsize = fdata.files[0].size / 1024;
		if (fsize > maxSize) {
			$("#HotelVideo").val("");
			alert("Maximum file size exceed, This file size is: " + fsize + "KB");
			return false;
		} else {
			return true;
		}
	}
}
function fileSizeValidate(fdata) {
	if (fdata.files && fdata.files[0]) {
		var fsize = fdata.files[0].size / 1024;
		if (fsize > maxSize) {
			alert("Maximum file size exceed, This file size is: " + fsize + "KB");
			return false;
		} else {
			return true;
		}
	}
}
function fileSizeValidate(fdata) {
	if (fdata.files && fdata.files[0]) {
		var fsize = fdata.files[0].size / 1024;
		if (fsize > maxSize) {
			alert("Maximum file size exceed, This file size is: " + fsize + "KB");
			return false;
		} else {
			return true;
		}
	}
}
var maxSize = "3024";

function fileSizeValidate(fdata) {
	if (fdata.files && fdata.files[0]) {
		var fsize = fdata.files[0].size / 1024;
		if (fsize > maxSize) {
			alert("Maximum file size exceed, This file size is: " + fsize + "KB");
			return false;
		} else {
			return true;
		}
	}
}

$("#HotelVideo").change(function() {
	if (fileExtValidate(this)) {
		// file extension validation function
		if (fileSizeValidate(this)) {
			// file size validation function
			var formData = new FormData();
			formData.append("file", $("#HotelVideo")[0].files[0]);
			$.ajax({
				url: siteUrl + "ajax/uploadhotelVideo",
				type: "POST",
				data: formData,
				processData: false, // tell jQuery not to process the data
				contentType: false, // tell jQuery not to set contentType
				dataType: "json",
				success: function(data) {
					alert(data.fileName);
					$(".video").html(
						'<video width="180" height="100" controls><source src="' +
							data.file +
							'" type="video/mp4"></video><a href="javascript:void(0)" class="videodelete" data-action="hotelImagedelete" data-imgId="" data-imgName="' +
							data.fileName +
							'"><i class="fas fa-times"></i></a><input type="hidden" name="data[Hotel][video]" value="' +
							data.fileName +
							'">'
					);
				}
			});
		}
	}
});

$(document).ready(function() {
	$("body").on("change", ".get_bed_type", function() {
		var roomId = $(this).val();
		$.ajax({
			url: siteUrl + "ajax/get_bed_type",
			data: { roomId: roomId },
			type: "POST",
			dataType: "json",
			success: function(data) {
				if (data.status == true) {
					var html = '<option value="">Please Select...</option>';
					$.each(data.info, function(index, value) {
						html +=
							'<option value="' +
							value.BedType.id +
							'">' +
							value.BedType.title +
							"</option>";
					});
					$("#RoomRatesBedTypeId").html(html);
				}
			}
		});
	});
	$(document).on("blur", "#RoomRatesAdultOneRate", function() {
		var roomRate = $("#RoomRatesAdultOneRate").val();
		if (roomRate <= 999) {
			tax = 0;
		} else if (roomRate > 1000 && roomRate <= 2499) {
			tax = 12;
		} else {
			tax = 18;
		}
		if (roomRate != "") {
			var calculation = (roomRate * tax) / 100;
			$("#RoomRatesTax").val(tax);
			$("#RoomRatesAdultOneTax").val(calculation);
		}
	});
	$(document).on("blur", "#RoomRatesAdultTwoRate", function() {
		var tax = $("#RoomRatesTax").val();
		if (tax == "") {
			tax = 0;
		}
		var value = $(this).val();
		if (value != "") {
			var calculation = (value * tax) / 100;
			$("#RoomRatesAdultTwoTax").val(calculation);
		}
	});
	$(document).on("blur", "#RoomRatesExtraBed", function() {
		var tax = $("#RoomRatesTax").val();
		if (tax == "") {
			tax = 0;
		}
		var value = $(this).val();
		if (value != "") {
			var calculation = (value * tax) / 100;
			$("#RoomRatesExtraBedTax").val(calculation);
		}
	});
	$(document).on("blur", "#RoomRatesChild", function() {
		var tax = $("#RoomRatesTax").val();
		if (tax == "") {
			tax = 0;
		}
		var value = $(this).val();
		if (value != "") {
			var calculation = (value * tax) / 100;
			$("#RoomRatesChildTax").val(calculation);
		}
	});
	$("body").on("click", ".imgdel", function() {
		var id = $(this).attr("data-imgId");
		var file = $(this).attr("data-imgName");
		var action = $(this).attr("data-action");
		var event = $(this);
		swal(
			{
				title: "Are you sure?",
				text: "You will not be able to recover this record!",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Yes, delete it!",
				closeOnConfirm: true
			},
			function() {
				$.ajax({
					url: siteUrl + "ajax/" + action,
					data: { id: id, file: file },
					type: "POST",
					dataType: "json",
					success: function(data) {
						if (data.status == true) {
							event.closest("li").remove();
						}
					}
				});
			}
		);
	});
	$(function() {
		$('[data-toggle="tooltip"]').tooltip();
	});

	$("body").on("click", ".imgdelete", function() {
		var id = $(this).attr("data-imgId");
		var file = $(this).attr("data-imgName");
		var action = $(this).attr("data-action");
		var event = $(this);
		swal(
			{
				title: "Are you sure?",
				text: "You will not be able to recover this record!",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Yes, delete it!",
				closeOnConfirm: true
			},
			function() {
				$.ajax({
					url: siteUrl + "ajax/" + action,
					data: { id: id, file: file },
					type: "POST",
					dataType: "json",
					success: function(data) {
						if (data.status == true) {
							$(".img").html("");
							//event.closest( "li" ).remove();
						}
					}
				});
			}
		);
	});
	$("body").on("click", ".videodelete", function() {
		var id = $(this).attr("data-imgId");
		var file = $(this).attr("data-imgName");
		var action = $(this).attr("data-action");
		var event = $(this);
		swal(
			{
				title: "Are you sure?",
				text: "You will not be able to recover this record!",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Yes, delete it!",
				closeOnConfirm: true
			},
			function() {
				$.ajax({
					url: siteUrl + "ajax/" + action,
					data: { id: id, file: file },
					type: "POST",
					dataType: "json",
					success: function(data) {
						if (data.status == true) {
							$(".video").html("");
						}
					}
				});
			}
		);
	});

	$(document).on("change", ".loadartdata", function() {
		var artCode = $(this).val();
		var request = $.ajax({
			url: siteUrl + "ajax/loadartdata",
			method: "POST",
			data: { artCode: artCode },
			dataType: "html"
		});
		request.done(function(response) {
			$(".data").html(response);
			$("select").select2({
				width: "100%"
			});
		});
		request.fail(function(jqXHR, textStatus) {
			Command: toastr["error"]("No data found for this Art Code..");
			toastr.options = {
				closeButton: false,
				debug: false,
				newestOnTop: false,
				progressBar: true,
				positionClass: "toast-top-center",
				preventDuplicates: false,
				onclick: null,
				showDuration: "3000",
				hideDuration: "1000",
				timeOut: "5000",
				extendedTimeOut: "5000",
				showEasing: "swing",
				hideEasing: "linear",
				showMethod: "fadeIn",
				hideMethod: "fadeOut"
			};
		});
	});

	$(document).on("submit", "#addFrom", function(e) {
		e.preventDefault();
		var fid = $("form").attr("id");
		var formData = $("#" + fid).serialize();
		var FormAction = $(this).attr("action");
		$.ajax({
			type: "POST",
			url: FormAction,
			data: formData,
			beforeSend: function() {
				$("#save").html('<i class="fas fa-spin fa-spinner"></i> Saving...');
				$("#save").attr("disabled", true);
				$(".error-message").remove();
			},
			success: function(response) {
				var response1 = jQuery.parseJSON(response);
				$("#save").attr("disabled", false);
				$("#save").html('<i class="fa fa-check"></i> Save');
				if (response1.status == "success") {
					Command: toastr["success"](response1.message);
					toastr.options = {
						closeButton: false,
						debug: false,
						newestOnTop: false,
						progressBar: true,
						positionClass: "toast-top-center",
						preventDuplicates: false,
						onclick: null,
						showDuration: "3000",
						hideDuration: "1000",
						timeOut: "5000",
						extendedTimeOut: "5000",
						showEasing: "swing",
						hideEasing: "linear",
						showMethod: "fadeIn",
						hideMethod: "fadeOut"
					};
					$("#" + fid)[0].reset();
					$("#form_modal").modal("hide");
					$("#datatable")
						.DataTable()
						.ajax.reload();
				} else if (response1.status == "error") {
					$("#save").attr("disabled", false);
					$("#save").val("Save");
					$(".msg").text(response1.message);
					$.each(response1.data, function(model, errors) {
						for (fieldName in this) {
							var element = $("#" + camelcase(model + "_" + fieldName));
							var create = $(document.createElement("div")).insertAfter(
								element
							);
							create.addClass("error-message").text(this[fieldName][0]);
						}
					});
				}
			},
			error: function() {}
		});
	});
	$(document).on("submit", "#addFromRoom", function(e) {
		e.preventDefault();
		var fidRoom = $(this).attr("id");
		var formData = $("#" + fidRoom).serialize();

		var FormAction = $(this).attr("action");
		$.ajax({
			type: "POST",
			url: FormAction,
			data: formData,
			beforeSend: function() {
				$("#saveroom").html('<i class="fas fa-spin fa-spinner"></i> Saving...');
				$("#saveroom").attr("disabled", true);
				$(".error-message").remove();
			},
			success: function(response) {
				var response1 = jQuery.parseJSON(response);
				$("#saveroom").attr("disabled", false);
				$("#saveroom").html('<i class="fa fa-check"></i> Save');
				if (response1.status == "success") {
					Command: toastr["success"](response1.message);
					toastr.options = {
						closeButton: false,
						debug: false,
						newestOnTop: false,
						progressBar: true,
						positionClass: "toast-top-center",
						preventDuplicates: false,
						onclick: null,
						showDuration: "3000",
						hideDuration: "1000",
						timeOut: "5000",
						extendedTimeOut: "5000",
						showEasing: "swing",
						hideEasing: "linear",
						showMethod: "fadeIn",
						hideMethod: "fadeOut"
					};
					$("#" + fidRoom)[0].reset();
					$("#form_modal").modal("hide");
					$("#datatable")
						.DataTable()
						.ajax.reload();
				} else if (response1.status == "error") {
					$("#save").attr("disabled", false);
					$("#save").val("Save");
					$(".msg").text(response1.message);
					$.each(response1.data, function(model, errors) {
						for (fieldName in this) {
							var element = $("#" + camelcase(model + "_" + fieldName));
							var create = $(document.createElement("div")).insertAfter(
								element
							);
							create.addClass("error-message").text(this[fieldName][0]);
						}
					});
				}
			},
			error: function() {}
		});
	});
	$(document).on("submit", "#hotelAdd", function(e) {
		e.preventDefault();
		var fid = $("form").attr("id");
		var formData = new FormData(this);
		var FormAction = $(this).attr("action");
		$.ajax({
			type: "POST",
			url: FormAction,
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function() {
				$("#saveHowToReach").html(
					'<i class="fas fa-spin fa-spinner"></i> Saving...'
				);
				$("#saveHowToReach").attr("disabled", true);
				$(".error-message").remove();
			},
			success: function(response) {
				var response1 = jQuery.parseJSON(response);
				$("#saveHowToReach").attr("disabled", false);
				$("#saveHowToReach").html("Next");
				if (response1.status == "success") {
					$("#HotelId").val(response1.data.Hotel.id);
					$(".hotel_id").val(response1.data.Hotel.id);
					$('.nav-pills a[href="#s_reach"]').removeClass("disabled");
					$('.nav-pills a[href="#s_reach"]').tab("show");
				} else if (response1.status == "error") {
					$("#saveHowToReach").attr("disabled", false);
					$("#save").val("Save");
					$(".msg").text(response1.message);
					$.each(response1.data, function(model, errors) {
						for (fieldName in this) {
							var element = $("#" + camelcase(model + "_" + fieldName));
							var create = $(document.createElement("div")).insertAfter(
								element
							);
							create.addClass("error-message").text(this[fieldName][0]);
						}
					});
				}
			},
			error: function() {}
		});
	});
	$(document).on("submit", "#FacilityAdd", function(e) {
		e.preventDefault();
		var fid = $("form").attr("id");
		var formData = $("#FacilityAdd").serialize();
		var FormAction = $(this).attr("action");
		$.ajax({
			type: "POST",
			url: FormAction,
			data: formData,
			dataType: "json",
			beforeSend: function() {
				$("#saveFacility").html(
					'<i class="fas fa-spin fa-spinner"></i> Saving...'
				);
				$("#saveFacility").attr("disabled", true);
				$(".error-message").remove();
			},
			success: function(response) {
				$("#saveFacility").attr("disabled", false);
				$("#saveFacility").html("Next");
				if (response.status == "success") {
					$("#HotelId").val(response.id);
					$(".hotel_id").val(response.id);
					$('.nav-pills a[href="#s_attractions"]').removeClass("disabled");
					$('.nav-pills a[href="#s_attractions"]').tab("show");
				}
			},
			error: function() {}
		});
	});
	$(document).on("submit", "#AttractionAdd", function(e) {
		e.preventDefault();
		var fid = $("form").attr("id");
		var formData = $("#AttractionAdd").serialize();
		var FormAction = $(this).attr("action");
		$.ajax({
			type: "POST",
			url: FormAction,
			data: formData,
			dataType: "json",
			beforeSend: function() {
				$("#saveAttraction").html(
					'<i class="fas fa-spin fa-spinner"></i> Saving...'
				);
				$("#saveAttraction").attr("disabled", true);
				$(".error-message").remove();
			},
			success: function(response) {
				$("#saveAttraction").attr("disabled", false);
				$("#saveAttraction").html("Next");
				if (response.status == true) {
					$("#HotelId").val(response.id);
					$(".hotel_id").val(response.id);
					$('.nav-pills a[href="#s_policies"]').removeClass("disabled");
					$('.nav-pills a[href="#s_policies"]').tab("show");
				}
			},
			error: function() {}
		});
	});
	$(document).on("submit", "#PolicyAdd", function(e) {
		e.preventDefault();
		var fid = $("form").attr("id");
		var formData = $("#PolicyAdd").serialize();
		var FormAction = $(this).attr("action");
		for (instance in CKEDITOR.instances) {
			CKEDITOR.instances[instance].updateElement();
		}
		$.ajax({
			type: "POST",
			url: FormAction,
			data: formData,
			dataType: "json",
			beforeSend: function() {
				$("#savePolicy").html(
					'<i class="fas fa-spin fa-spinner"></i> Saving...'
				);
				$("#savePolicy").attr("disabled", true);
				$(".error-message").remove();
			},
			success: function(response) {
				$("#savePolicy").attr("disabled", false);
				$("#savePolicy").html("Next");
				if (response.status == true) {
					$("#HotelId").val(response.id);
					$(".hotel_id").val(response.id);
					$('.nav-pills a[href="#s_rooms"]').removeClass("disabled");
					$('.nav-pills a[href="#s_rooms"]').tab("show");
				}
			},
			error: function() {}
		});
	});
	$(document).on("submit", "#RoomAdd", function(e) {
		e.preventDefault();
		var fid = $("form").attr("id");
		var formData = $("#RoomAdd").serialize();
		var FormAction = $(this).attr("action");
		$.ajax({
			type: "POST",
			url: FormAction,
			data: formData,
			dataType: "json",
			beforeSend: function() {
				$("#saveRoom").html('<i class="fas fa-spin fa-spinner"></i> Saving...');
				$("#saveRoom").attr("disabled", true);
				$(".error-message").remove();
			},
			success: function(response) {
				$("#saveRoom").attr("disabled", false);
				$("#saveRoom").html("Next");
				if (response.status == true) {
					$("#HotelId").val(response.id);
					$(".hotel_id").val(response.id);
					$('.nav-pills a[href="#s_rates"]').removeClass("disabled");
					$('.nav-pills a[href="#s_rates"]').tab("show");
				}
			},
			error: function() {}
		});
	});
	$(document).on("submit", "#SeasionRateAdd", function(e) {
		e.preventDefault();
		var fid = $("form").attr("id");
		var formData = $("#SeasionRateAdd").serialize();
		var FormAction = $(this).attr("action");
		$.ajax({
			type: "POST",
			url: FormAction,
			data: formData,
			dataType: "json",
			beforeSend: function() {
				$("#saveSeason").html(
					'<i class="fas fa-spin fa-spinner"></i> Saving...'
				);
				$("#saveSeason").attr("disabled", true);
				$(".error-message").remove();
			},
			success: function(response) {
				$("#saveSeason").attr("disabled", false);
				$("#saveSeason").html("Next");
				if (response.status == true) {
					$("#HotelId").val(response.id);
					$(".hotel_id").val(response.id);
					$('.nav-pills a[href="#s_extra"]').removeClass("disabled");
					$('.nav-pills a[href="#s_extra"]').tab("show");
				}
			},
			error: function() {}
		});
	});

	$(document).on("submit", "#HowToReachAdd", function(e) {
		e.preventDefault();
		var fid = $("form").attr("id");
		var formData = $("#HowToReachAdd").serialize();
		var FormAction = $(this).attr("action");
		$.ajax({
			type: "POST",
			url: FormAction,
			data: formData,
			dataType: "JSON",
			beforeSend: function() {
				$("#saveHowToReach").html(
					'<i class="fas fa-spin fa-spinner"></i> Saving...'
				);
				$("#saveHowToReach").attr("disabled", true);
				$(".error-message").remove();
			},
			success: function(response) {
				$("#saveHowToReach").attr("disabled", false);
				$("#savehow").html('<i class="fa fa-check"></i> Save');
				if (response.status == true) {
					$('.nav-pills a[href="#s_facilities"]').removeClass("disabled");
					$('.nav-pills a[href="#s_facilities"]').tab("show");
				}
			},
			error: function() {}
		});
	});
	$(document).on("click", ".edit", function() {
		var action = $(this).attr("data-action");
		var id = $(this).attr("data-editid");
		var model = $(this).attr("data-model");
		var request = $.ajax({
			url: siteUrl + "ajax/" + action,
			method: "POST",
			data: { id: id, model: model },
			dataType: "html"
		});
		request.done(function(response) {
			$("#form_modal").html(response);
			$("select").select2({
				width: "100%"
			});
			$("#form_modal").modal("show");
		});
		request.fail(function(jqXHR, textStatus) {
			alert("Request failed: " + textStatus);
		});
	});
	$(document).on("click", ".editn", function() {
		var action = $(this).attr("data-action");
		var id = $(this).attr("data-editid");
		var model = $(this).attr("data-model");
		var request = $.ajax({
			url: siteUrl + model + "/" + action,
			method: "POST",
			data: { id: id, model: model },
			dataType: "html"
		});
		request.done(function(response) {
			$("#form_modal").html(response);
			$("select").select2({
				width: "100%"
			});
			$("#form_modal").modal("show");
		});
		request.fail(function(jqXHR, textStatus) {
			alert("Request failed: " + textStatus);
		});
	});
	$(document).on("click", ".process", function() {
		var jobId = $(this).attr("data-jobid");
		var request = $.ajax({
			url: siteUrl + "ajax/process_list",
			method: "POST",
			data: { jobId: jobId },
			dataType: "html"
		});
		request.done(function(response) {
			$("#form_modal").html(response);
			$("select").select2({
				width: "100%"
			});
			$("#form_modal").modal("show");
		});
		request.fail(function(jqXHR, textStatus) {
			alert("Request failed: " + textStatus);
		});
	});
	function camelcase(inputstring) {
		var a = inputstring.split("_"),
			i;
		s = [];
		for (i = 0; i < a.length; i++) {
			s.push(a[i].charAt(0).toUpperCase() + a[i].substring(1));
		}
		s = s.join("");
		return s;
	}
});
$(function() {
	if ($("#action").length) {
		loadDataTable();
	}
	if (
		$(".doj").length ||
		$(".time").length ||
		$(".dob").length ||
		$(".datepicker").length ||
		$("#date-end").length ||
		$("#date-start  ").length
	) {
		$(".doj").bootstrapMaterialDatePicker({
			format: "DD MMMM YYYY",
			time: false,
			minDate: new Date()
		});
		$(".dob").bootstrapMaterialDatePicker({
			format: "DD MMMM YYYY",
			time: false,
			maxDate: new Date()
		});
		$(".datepicker").bootstrapMaterialDatePicker({
			format: "DD MMMM YYYY",
			time: false
		});
		$("#date-end").bootstrapMaterialDatePicker({ weekStart: 0 });
		$("#date-start")
			.bootstrapMaterialDatePicker({ weekStart: 0, time: false })
			.on("change", function(e, date) {
				$("#date-end").bootstrapMaterialDatePicker("setMinDate", date);
			});
		$(".time").bootstrapMaterialDatePicker({
			format: "hh:mm A",
			time: true,
			year: false,
			date: false
		});
	}
	$(document).on("click", "#add_service_block", function() {
		var html = $(".service_block").html();
		var randomValue = randomString(5);
		html = html.replace(/textarea_1/g, "textarea_" + randomValue);

		$(".service_block_items").append(html);
		var editor = CKEDITOR.replace("textarea_" + randomValue, {
			filebrowserUploadUrl: siteUrl + "ajax/upload",
			filebrowserImageBrowseUrl:
				siteUrl + "assets/extra-libs/ckfinder/ckfinder.html?type=Images"
		});
		CKFinder.setupCKEditor(editor, "../");
	});
	$("body").on("click", "#add_route", function() {
		$(".route_block")
			.find("select")
			.select2("destroy");
		var html = $(".route_block").html();
		var randomValue = randomString(5);

		html = html.replace(/_value/g, "");
		$(".route_items").append(html);
		//$('select').select2('destroy');
		$(".route_items")
			.find("select")
			.select2({
				width: "100%"
			});
	});
	$("body").on("click", ".btn-cancel", function() {
		var html = $(".copy_row").html();
		var randomValue = randomString(5);
		html = html.replace(/Add New Cutoff/g, "Remove");
		html = html.replace(/btn-primary/g, "btn-danger");
		html = html.replace(/btn-cancel/g, "btn-delete");

		$(".cancel_items").append(html);
		$(".cancel_items .block-fee")
			.last()
			.find(".form-control")
			.val("");
		$(".time").bootstrapMaterialDatePicker({
			format: "hh:mm A",
			time: true,
			year: false,
			date: false
		});
	});
	$("body").on("click", "#add_room", function() {
		$(".room_block")
			.find("select")
			.select2("destroy");
		var html = $(".room_block").html();
		var randomValue = randomString(5);

		html = html.replace(/_value/g, "");
		$(".room_items").append(html);
		//$('select').select2('destroy');
		$(".room_items")
			.find("select")
			.select2({
				width: "100%"
			});
	});
	$("body").on("click", "#add_season", function() {
		$(".season_block")
			.find("select")
			.select2("destroy");
		var html = $(".season_block").html();
		var randomValue = randomString(5);

		html = html.replace(/_value/g, "");
		$(".season_items").append(html);
		$(".datepicker").bootstrapMaterialDatePicker({
			format: "DD MMMM YYYY",
			time: false
		});
		//$('select').select2('destroy');
		$(".season_items")
			.find("select")
			.select2({
				width: "100%"
			});
	});
	$("body").on("click", ".btn-delete", function() {
		$(this)
			.closest(".block-fee")
			.remove();
	});
	$(document).on("click", ".removeRoomblock", function() {
		var deleteId = $(this).attr("data-id");
		if (deleteId > 0) {
			$.ajax({
				url: siteUrl + "ajax/delete_room",
				type: "POST",
				data: { deleteId: deleteId },
				dataType: "json",
				success: function(response) {
					if (response.status == true) {
						swal("Done!", "Room succesfully deleted!", "success");
					} else {
						swal("Error deleting!", "Please try again", "error");
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					swal("Error deleting!", "Please try again", "error");
				}
			});
		}

		$(this)
			.closest(".room_block_remove")
			.remove();
	});
	$(document).on("click", ".removeSeasonblock", function() {
		$(this)
			.closest(".season_block_remove")
			.remove();
	});
	$(document).on("click", ".Routremoveblock", function() {
		$(this)
			.closest(".route_block_remove")
			.remove();
	});

	$("#files").change(handleFileSelect);

	if ($("#editor1").length) {
		var editor = CKEDITOR.replace("editor1", {
			allowedContent: true
		});
		// CKFinder.setupCKEditor( editor, '../' );
	}
	if ($("#editor2").length) {
		var editor2 = CKEDITOR.replace("editor2", {
			allowedContent: true
		});
		//CKFinder.setupCKEditor( editor2, '../' );
	}
	if ($("#editor3").length) {
		var editor3 = CKEDITOR.replace("editor3", {
			allowedContent: true
		});
		// CKFinder.setupCKEditor( editor3, '../' );
	}
	if ($("#editor4").length) {
		var editor3 = CKEDITOR.replace("editor4", {
			allowedContent: true
		});
		// CKFinder.setupCKEditor( editor3, '../' );
	}

	$(document).on("click", ".delete", function() {
		var model = $(this).attr("data-model");
		var id = $(this).attr("data-deleteid");
		swal(
			{
				title: "Are you sure?",
				text: "You will not be able to recover this data!",
				type: "warning",
				showCancelButton: true,
				confirmButtonText: "Yes, delete it!",
				closeOnConfirm: false
			},
			function(isConfirm) {
				if (!isConfirm) return;
				$.ajax({
					url: siteUrl + "ajax/delete_data",
					type: "POST",
					data: { id: id, model: model },
					dataType: "json",
					success: function(response) {
						if (response.status == true) {
							swal("Done!", "It was succesfully deleted!", "success");
							$("#datatable")
								.DataTable()
								.ajax.reload();
						} else {
							swal("Error deleting!", "Please try again", "error");
						}
					},
					error: function(xhr, ajaxOptions, thrownError) {
						swal("Error deleting!", "Please try again", "error");
					}
				});
			}
		);
	});

	$(document).on("click", ".load_modal", function() {
		var action = $(this).attr("data-action");
		var model = $(this).attr("data-model");
		var hotelId = 0;
		if (action == "form_room") {
			hotelId = $(".hotel_id").val();
		}
		var request = $.ajax({
			url: siteUrl + "ajax/" + action,
			method: "POST",
			dataType: "html",
			data: { model: model, hotelId: hotelId }
		});
		request.done(function(response) {
			$("#form_modal").html(response);
			$("select").select2({
				width: "100%"
			});
			$("#form_modal").modal("show");
		});
		request.fail(function(jqXHR, textStatus) {
			alert("Request failed: " + textStatus);
		});
	});
	$(document).on("click", ".view_bed_type", function() {
		var action = "list_bed_type_hotel";
		var roomId = $(this).attr("data-room");

		var request = $.ajax({
			url: siteUrl + "ajax/" + action,
			method: "POST",
			dataType: "html",
			data: { roomId: roomId }
		});
		request.done(function(response) {
			$("#form_modal").html(response);
			$("#form_modal").modal("show");
		});
		request.fail(function(jqXHR, textStatus) {
			alert("Request failed: " + textStatus);
		});
	});

	$("body").on("click", ".add_bed_type", function() {
		var bedId = 0;
		if ($(this).attr("data-bed")) {
			bedId = $(this).attr("data-bed");
		}
		var roomId = $(this).attr("data-room");
		var request = $.ajax({
			url: siteUrl + "ajax/add_bed_type",
			method: "POST",
			dataType: "html",
			data: { roomId: roomId, bedId: bedId }
		});
		request.done(function(response) {
			$("#form_modal").html(response);
			$("select").select2({
				width: "100%"
			});
			$("#filesRoom").change(handleFileSelectNew);
			$("#form_modal").modal("show");
		});
		request.fail(function(jqXHR, textStatus) {
			alert("Request failed: " + textStatus);
		});
	});
	$(document).on("click", ".load_modaln", function() {
		var action = $(this).attr("data-action");
		var model = $(this).attr("data-model");
		var request = $.ajax({
			url: siteUrl + model + "/" + action,
			method: "POST",
			dataType: "html",
			data: { model: model }
		});
		request.done(function(response) {
			$("#form_modal").html(response);
			$("select").select2({
				width: "100%"
			});
			$("#form_modal").modal("show");
		});
		request.fail(function(jqXHR, textStatus) {
			alert("Request failed: " + textStatus);
		});
	});

	("use strict");

	$(".preloader").fadeOut();
	// ==============================================================
	// sidebar-hover
	// ==============================================================

	$(".left-sidebar").hover(
		function() {
			$(".navbar-header").addClass("expand-logo");
		},
		function() {
			$(".navbar-header").removeClass("expand-logo");
		}
	);
	// this is for close icon when navigation open in mobile view
	$(".nav-toggler").on("click", function() {
		$("#main-wrapper").toggleClass("show-sidebar");
		$(".nav-toggler i").toggleClass("ti-menu");
	});
	$(".search-box a, .search-box .app-search .srh-btn").on("click", function() {
		$(".app-search").toggle(200);
		$(".app-search input").focus();
	});

	// ==============================================================
	// Right sidebar options
	// ==============================================================
	$(function() {
		$(".service-panel-toggle").on("click", function() {
			$(".customizer").toggleClass("show-service-panel");
		});
		$(".page-wrapper").on("click", function() {
			$(".customizer").removeClass("show-service-panel");
		});
	});
	// ==============================================================
	// This is for the floating labels
	// ==============================================================
	$(".floating-labels .form-control")
		.on("focus blur", function(e) {
			$(this)
				.parents(".form-group")
				.toggleClass("focused", e.type === "focus" || this.value.length > 0);
		})
		.trigger("blur");

	// ==============================================================
	//tooltip
	// ==============================================================

	// ==============================================================
	//Popover
	// ==============================================================
	$(function() {
		$('[data-toggle="popover"]').popover();
		$("select").select2({
			width: "100%"
		});
	});

	// ==============================================================
	// Perfact scrollbar
	// ==============================================================
	$(".message-center, .customizer-body, .scrollable").perfectScrollbar({
		wheelPropagation: !0
	});

	/*var ps = new PerfectScrollbar('.message-body');
    var ps = new PerfectScrollbar('.notifications');
    var ps = new PerfectScrollbar('.scroll-sidebar');
    var ps = new PerfectScrollbar('.customizer-body');*/

	// ==============================================================
	// Resize all elements
	// ==============================================================
	$("body, .page-wrapper").trigger("resize");
	$(".page-wrapper")
		.delay(20)
		.show();

	// ==============================================================
	// Collapsable cards
	// ==============================================================
	$('a[data-action="collapse"]').on("click", function(e) {
		e.preventDefault();
		$(this)
			.closest(".card")
			.find('[data-action="collapse"] i')
			.toggleClass("ti-minus ti-plus");
		$(this)
			.closest(".card")
			.children(".card-body")
			.collapse("toggle");
	});
	// Toggle fullscreen
	$('a[data-action="expand"]').on("click", function(e) {
		e.preventDefault();
		$(this)
			.closest(".card")
			.find('[data-action="expand"] i')
			.toggleClass("mdi-arrow-expand mdi-arrow-compress");
		$(this)
			.closest(".card")
			.toggleClass("card-fullscreen");
	});
	// Close Card
	$('a[data-action="close"]').on("click", function() {
		$(this)
			.closest(".card")
			.removeClass()
			.slideUp("fast");
	});
	// ==============================================================
	// LThis is for mega menu
	// ==============================================================
	$(document).on("click", ".mega-dropdown", function(e) {
		e.stopPropagation();
	});
	// ==============================================================
	// Last month earning
	// ==============================================================
	var sparklineLogin = function() {
		$(".lastmonth").sparkline([6, 10, 9, 11, 9, 10, 12], {
			type: "bar",
			height: "35",
			barWidth: "4",
			width: "100%",
			resize: true,
			barSpacing: "8",
			barColor: "#2961ff"
		});
	};
	var sparkResize;

	$(window).resize(function(e) {
		clearTimeout(sparkResize);
		sparkResize = setTimeout(sparklineLogin, 500);
	});
	sparklineLogin();

	// ==============================================================
	// This is for the innerleft sidebar
	// ==============================================================
	$(".show-left-part").on("click", function() {
		$(".left-part").toggleClass("show-panel");
		$(".show-left-part").toggleClass("ti-menu");
	});
});
function randomString(len, charSet) {
	charSet =
		charSet || "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
	var randomString = "";
	for (var i = 0; i < len; i++) {
		var randomPoz = Math.floor(Math.random() * charSet.length);
		randomString += charSet.substring(randomPoz, randomPoz + 1);
	}
	return randomString;
}
function loadDataTable() {
	var action = $("#action").val();
	var model = $("#model").val();
	if ($("#hotelId").length) {
		var hotelId = $("#hotelId").val();
	} else {
		var hotelId = 0;
	}

	if (action == "listing_room") {
		hotelId = $(".hotel_id").val();
	}
	if ($("#userId").length) {
		var userId = $("#userId").val();
	} else {
		var userId = 0;
	}

	$("#datatable").DataTable({
		bProcessing: true,
		bServerSide: true,
		ajax: {
			url: siteUrl + "ajax/" + action,
			type: "POST",
			deferRender: true,
			data: { model: model, hotelId: hotelId, userId: userId }
		},
		aoColumnDefs: [
			{
				bSortable: false,
				aTargets: ["nosort"]
			}
		]
	});
}
