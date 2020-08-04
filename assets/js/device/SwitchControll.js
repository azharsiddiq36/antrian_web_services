	$(document).ready(function(){
		let con = new Connection();

		$(document).on('click','.switchBtn',function () {
			let service = $(this).data('service');
			let data = $('#callData').serializeArray();
			$.post(con.BASE_URL+'Services/switchApi/'+service,data,function (response) {
				if (response.status === '200'){
					$('#redirectModal').modal('hide');
					$('#alertContainer').html('<div class="alert alert-success animated bounceIn">' +
						'' +response.message+
						'</div>');
					setTimeout(function () {
						$('#alertContainer div.alert').remove();
						window.location.reload();
					},3000);
				}else{
					$('#redirectModal').modal('hide');
					$('#alertContainer').html('<div class="alert alert-danger animated shake">' +
						'' +response.message+
						'</div>');

					setTimeout(function () {
						$('#alertContainer div.alert').remove();
						window.location.reload();
					},3000);
				}
			},'json');
		});
	});
