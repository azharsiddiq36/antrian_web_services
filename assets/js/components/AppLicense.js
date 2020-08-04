	$(document).ready(function(){
		let activateAt;
		let expireDate;
		let duration;

		$(document).on('change','input#activate_at', function () {
			activateAt = $(this).val();
			$('input#activation_duration').attr('readonly',false);
		});

		$('input#activation_duration').keyup(function () {
			duration = $(this).val();
			expireDate = moment(activateAt).add(parseInt(duration),'M').format("YYYY-MM-DD");
			$('input#expire_at').val(expireDate);
		});

	});
