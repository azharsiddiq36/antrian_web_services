
	$(document).ready(function(){
		let con = new Connection();
		$(document).on('change','#layanan',function () {
			let value = $(this).val();
			$.get(con.BASE_URL+'LayananController/loketApi?layanan_id='+value,function (response) {
				chain(response.data);
				alternatifChain(response.data);
			},'JSON');
		});

		function chain(data) {
			$('#loket-select option').remove();
			let options = '<option selected disabled>PILIH LOKET</option>';
			for (let i = 0; i < data.length; i++) {
				options+= '<option value="'+data[i].loket_id+'">'+data[i].loket_nama+'</option>'
			}
			$('#loket-select').append(options);
		}

		function alternatifChain(data) {
			$('#alternatif-loket-select option').remove();
			let options = '<option selected disabled>PILIH LOKET ALTERNATIF</option>';
			for (let i = 0; i < data.length; i++) {
				options+= '<option value="'+data[i].loket_id+'">'+data[i].loket_nama+'</option>'
			}
			$('#alternatif-loket-select').append(options);
		}
	});
