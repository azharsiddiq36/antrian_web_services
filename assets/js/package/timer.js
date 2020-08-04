	$(document).ready(function () {
		var dataHari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jum&#39at','Sabtu'];
		var dataBulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

		var datetime = null,
			date = null,
			timeContent = null;

		var update = function () {
			date = moment(new Date());
			let tanggal = date.format('D');
			let hari = date.format('d');
			let bulan = date.format('M');
			let tahun = date.format('Y');
			datetime.html(date.format('H:mm:ss'));
			timeContent.html(dataHari[hari]+', '+ tanggal+' '+dataBulan[bulan-1]+' '+tahun);
		};

		datetime = $('#time-content');
		timeContent = $('#date-content');
		update();
		setInterval(update, 1000);


	});
