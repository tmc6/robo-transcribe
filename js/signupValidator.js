$(function () {
	
	$('#submit-signup').prop('disabled', true);

	var usernameCheck = false;
	var passwordCheck = false;

	$('#i4ne3v').on('input', function () {
		if (usernameCheck && passwordCheck) {
			$('#submit-signup').prop('disabled', false);
		}
		else {
			$('#submit-signup').prop('disabled', true);
		}
	});

	$("#username-input").on("input", function () {



		var userInput = $(this).val();
		if (userInput.length > 2) {

			$.ajax({
				type: "GET",
				url: "http://videosubtitle/usersignup.php",
				data: { "username": userInput, "nameCheck": true },
				success: function (result) {

					if (result == "available") {

						$("#usernamecheckmark").css("visibility", "visible");
						if ($("#usernamexmark").css("visibility") == "visible") {

							$("#usernamexmark").css("visibility", "hidden");

							usernameCheck = true;

						}
					}
					else if (result = "unavailable") {
						$("#usernamexmark").css("visibility", "visible");
						if ($("#usernamecheckmark").css("visibility") == "visible") {
							$("#usernamecheckmark").css("visibility", "hidden");
							usernameCheck = false;

						}
					}
					else {
						alert(result);
					}
				}
			});


		}
		else if (userInput.length == 1 || userInput.length == 2) {
			if ($("#usernamecheckmark").css("visibility") == "visible") {
				$("#usernamecheckmark").css("visibility", "hidden");

			}
			else if ($("#usernamexmark").css("visibility") == "visible") {

				$("#usernamexmark").css("visibility", "hidden");

			}

		}

	});
	$("#email-input").on("input", function () {
		if ($("#emailxmark").css("visibility") == "visible") {
			$("#emailxmark").css("visibility", "hidden");
			$("#emailmsg").css("visibility", "hidden");
		}
	});
	$("#password").on("input", function () {

		if (($(this).val() !== $("#password2").val()) && ($("#password2").val() != '')) {
			$(".passwordxmark").css("visibility", "visible");
			$(".passwordcheckmark").css("visibility", "hidden");
			passwordCheck = false;
		}
		else if (($(this).val() == $("#password2").val()) && ($("#password2").val() != '')) {
			$(".passwordxmark").css("visibility", "hidden");

			$(".passwordcheckmark").css("visibility", "visible");
			passwordCheck = true;
		}
	});
	$("#password2").on("input", function () {

		if (($(this).val() !== $("#password").val()) && ($("#password").val() != '')) {
			$(".passwordxmark").css("visibility", "visible");
			$(".passwordcheckmark").css("visibility", "hidden");
			passwordCheck = false;
		}
		else if (($(this).val() == $("#password").val()) && ($("#password").val() != '')) {
			$(".passwordxmark").css("visibility", "hidden");

			$(".passwordcheckmark").css("visibility", "visible");
			passwordCheck = true;

		}

	});
});