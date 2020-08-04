$(document).ready(function(){
	let conn = new Connection();

	$(document).on('keydown',function (e) {
		let key = e.key;

		$.get(conn.BASE_URL+'Services/execKeyboard/'+key,function (response) {
			if (response !== null){
				receiptPrint(response.url);
			}
		},'json');

		function receiptPrint(url) {
			$.get(conn.BASE_URL+url,function (response) {
				if (response.status === '200') {
					submitTicket(response);
				}
			},'json');
		}

		function submitTicket(ticket) {
			$('input[name="queue_number"]').val(ticket.antrian_nomor);
			$('input[name="service_name"]').val(ticket.service_name);
			$('input[name="left_queue"]').val(ticket.left_queue);

			$('#printSubmit').submit();
		}
	});
});
