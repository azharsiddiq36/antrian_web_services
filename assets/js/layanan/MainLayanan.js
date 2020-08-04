$(document).ready(function(){
	let connection = new Connection();
	let services = new Services();



	$('.take-queue').click(function (e) {
		e.preventDefault();
		let url = $(this).data('url');
		let response = services.getData('Services/'+url);
		if (response.status === '200'){
			receiptsPrint(response);
			// receiptsPrint(response);
			// $('#ticket-number-print').html(response.antrian_nomor);
			// $('#service-name-print').html(response.service_name);
			// $('#left-queue-print').html(response.left_queue);
			// swal({
			// 	title: 'BERHASIL MENGAMBIL ANTRIAN',
			// 	html: '<h4>Nomor Antrian Anda </h4><br>' +
			// 		'<h1>'+response.antrian_nomor+'</h1><br>' +
			// 		'<h5>Silahkan Cetak Karcis dan Menunggu</h5>'
			// 	,
			// 	type: 'success',
			// 	allowOutsideClick: false,
			// 	showCloseButton: false,
			// 	showCancelButton: false,
			// 	confirmButtonText:
			// 		'<button class="btn btn-success" id="cetak-karcis" data-antrian="'+response.antrian_nomor+'"><i class="fa fa-print"></i> cetak</button>',
			// });
		}
	});

	function receiptsPrint(response){
		$('input[name="queue_number"]').val(response.antrian_nomor);
		$('input[name="service_name"]').val(response.service_name);
		$('input[name="left_queue"]').val(response.left_queue);

		$('#printSubmit').submit();
	}

	$(document).on('click','#cetak-karcis', function () {
		// $('#ticket-preview').printThis({
		// 	debug: false,               // show the iframe for debugging
		// 	importCSS: true,            // import parent page css
		// });
		window.location.reload();
	})
});
