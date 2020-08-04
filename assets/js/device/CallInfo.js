	$(document).ready(function(){
		let con = new Connection();
		let callBtn  = $('#callBtn');
		let recallBtn = $('#recallBtn');
		let alternatifBtn = $('#alternatifBtn');
		let activeNumberElem = $('#activeQueueNumber');
		let leftQueue = $('#leftQueueNumber');

		$(document).on('click', '#callBtn',function () {
			let locket =callBtn.data('locket');
			
			// perform call API
			$.get(con.BASE_URL+'Services/call/'+locket,function (response) {
				if (response.data.length !== 0){
					$('input[name="nomor"]').val(response.data.antrian_nomor);
					$('input[name="text"]').val(response.data.layanan_awalan+'-'+response.antrian);
					recallBtn.data('type',response.data.antrian_jenis_panggilan);
				}

				$.get(con.BASE_URL+'Services/leftQueue/'+locket,function (data) {
					leftQueue.html(data.sisa_antrian);
				},'JSON');

				// perform activeNumber
				$.get(con.BASE_URL+'Services/activeNumber/'+locket,function (data) {
					let activeNumber = data.antrian;
					activeNumberElem.html(activeNumber);
				},'JSON');

			},'JSON');
		});

		$(document).on('click','#recallBtn',function () {
			let locket = recallBtn.data('locket');
			let callType = recallBtn.data('type');


			// perform recall API
			$.get(con.BASE_URL+'Services/recall/'+locket,function (response) {
				console.log(response);
			},'JSON');
		});

		$(document).on('click','#alternatifBtn',function () {
			let locket = alternatifBtn.data('locket');
			$.get(con.BASE_URL+'Services/call/'+locket,function (response) {
				console.log(response);
			},'JSON');
		});


	});
