	// init();
	// var default_local = window.location.origin + '/antrian/';
	//
	// function init() {
	// 	var local = window.location.origin + '/antrian/';
	// 	var url = local + "totalloket";
	// 	$.ajax({
	// 		url: url,
	// 		type: 'ajax',
	// 		dataType: 'json',
	// 		method: 'POST',
	// 		async: true,
	// 		success: function (response) {
	//
	// 			currentNumber();
	// 			var content;
	// 			content = "";
	// 			for (var i = 0 ; i<response['total'];i++){
	// 				sisa(response['data'][i]['loket_id']);
	// 				currentNumber(response['data'][i]['loket_id']);
	//
	// 				content += "<button type='button' value='"+response['data'][i]['loket_id']+"@"+response['data'][i]['layanan_id']+"' onclick='tambah(this)'>Tambah</button> | " +
	// 					"<button type='button' value='"+response['data'][i]['loket_id']+"' onclick='call(this)'>Call</button> | " +
	// 					"<button type='button' value='"+response['data'][i]['loket_id']+"' onclick='recall(this)'>Recall</button> | " +
	// 					"<button type='button' value='"+response['data'][i]['loket_id']+"' onclick='alihkan(this)'>Alihkan</button>";
	// 				content += "<div class='queue-box' style='background-color: #0f1531;'>";
	// 				content += "<div class='queue-name'>";
	// 				content += "<h2 class='font-weight-light' style='color: white;font-size: 28px;font-family: Roboto'>";
	// 				content += "<span id='"+response['data'][i]['loket_id']+"'>"+response['data'][i]['layanan_nama']+"</span>";
	// 				content += "</h2>";
	// 				content += "</div>";
	// 				content += "<div class='queue-number d-flex justify-content-end' style='background-color: #0b51c5;'>";
	// 				content += "<h1 class='queue-number-content' ><span style='color: #fff;font-family: Roboto' class = 'sekarang"+response['data'][i]['loket_id']+"'></span></h1>";
	// 				content += "</div>";
	// 				content += "<div class='queue-footer d-flex justify-content-between' style='border-top: 4px #0b51c5 solid;background-color: #0f1531'>";
	// 				content += "<span style='color: white;font-family: Roboto'>Menuju Loket : 0"+response['data'][i]['loket_nama']+"</span>";
	// 				content += "<span class='sisa"+response['data'][i]['loket_id']+"' style='color: white;font-family: Roboto'></span>";
	// 				content += "</div>";
	// 				content += "</div>";
	//
	// 			}
	// 			$(".content").html(content);
	// 		},
	// 		error: function (data) {
	// 			console.log(data);
	// 		}
	// 	});
	// }
	//
	// function currentNumber(a){
	// 	var value = a;
	// 	var local = window.location.origin + '/antrian/';
	// 	var url = local + "antriansekarang";
	// 	$.ajax({
	// 		url: url,
	// 		type: 'ajax',
	// 		dataType: 'json',
	// 		method: 'POST',
	// 		async: true,
	// 		data: {"loket_id": value},
	// 		success: function (response) {
	// 			var sekarang = "";
	// 			if (response['sekarang']['antrian_nomor']){
	// 				sekarang += "0"+response['sekarang']['antrian_nomor'];
	// 			}
	// 			else{
	// 				sekarang += "N/Y";
	// 			}
	//
	// 			$(".sekarang"+a).html(sekarang);
	// 		},
	// 		error: function (data) {
	// 		}
	// 	});
	// }
	//
	// function sisa(a) {
	// 	var value = a;
	// 	var local = window.location.origin + '/antrian/';
	// 	var url = local + "sisaantrian";
	// 	$.ajax({
	// 		url: url,
	// 		type: 'ajax',
	// 		dataType: 'json',
	// 		method: 'POST',
	// 		async: true,
	// 		data: {"loket_id": value},
	// 		success: function (response) {
	// 			var sisa = "";
	// 			sisa += "Tersisa : "+response['sisa'];
	// 			$(".sisa"+a).html(sisa);
	// 		},
	// 		error: function (data) {
	// 		}
	// 	});
	// }
	//
	// function call(objButton){
	// 	var value = objButton.value;
	// 	var local = window.location.origin+"/antrian/";
	// 	var url = local + "callantrian";
	// 	$.ajax({
	// 		url: url,
	// 		type: 'ajax',
	// 		dataType: 'json',
	// 		method: 'POST',
	// 		async: true,
	// 		data: {"loket_id": value},
	// 		success: function (response) {
	// 			var sekarang = "";
	// 			var sisa = "";
	// 			if (response['status'] == 200) {
	// 				sekarang += "0" + response['sekarang']['antrian_nomor'];
	// 				var nomor = response['sekarang']['antrian_nomor'];
	// 				var splitnomor = nomor.split("");
	//
	// 				play('in', 1);
	// 				play('urut', 0);
	//
	// 				if (splitnomor.length <= 1) {
	// 					play(""+ splitnomor[0], 0); //Satuan
	// 				}
	// 				//
	// 				else if (splitnomor.length === 2) {
	// 					// if (splitnomor[0] === 1 && splitnomor[1] === 0) {
	// 					//     play('10', 0); //sepuluh
	// 					// }
	// 					// else {
	// 						if (nomor < 20) {
	// 							if (nomor == '10'){
	// 								play('10',0);
	// 							}
	// 							else if (nomor == '11'){
	// 								play('11',0)
	// 							}
	// 							else{
	// 								play(splitnomor[1],0);
	// 								play('belas', 0);//belas
	// 							}
	//
	// 						}
	// 						else {
	// 							play(splitnomor[0],0);
	// 							play('puluh', 0);//puluh
	// 							if (splitnomor[1]!='0'){
	// 								play(splitnomor[1]);
	// 							}
	// 						// }
	// 					}
	// 				}
	//
	// 				else if (splitnomor.length === 3) {
	// 					if (splitnomor[0] == '1'){
	// 						play('100',0);
	// 					}
	// 					else {
	// 						play(splitnomor[0],0);
	// 						play('ratus',0);
	// 					}
	// 					if (splitnomor[1] == '0'){
	// 						if (splitnomor[2] != '0'){
	// 							play(splitnomor[2],0);
	// 						}
	// 					}else{
	// 						var puluhan = ""+splitnomor[1]+""+splitnomor[2];
	// 						if (puluhan < 20) {
	// 							if (puluhan == '10'){
	// 								play('10',0);
	// 							}
	// 							else if (puluhan == '11'){
	// 								play('11',0)
	// 							}
	// 							else{
	// 								play(splitnomor[2],0);
	// 								play('belas', 0);//belas
	// 							}
	// 						}
	// 						else {
	// 							play(splitnomor[1],0);
	// 							play('puluh', 0);//puluh
	// 							if (splitnomor[2]!='0'){
	// 								play(splitnomor[2]);
	// 							}
	// 							// }
	// 						}
	// 					}
	//
	//
	// 				}
	//
	// 				play('loket',0);
	// 				play(''+response['sekarang']['antrian_loket_id'],0);
	// 					$(".sekarang" + value).html(sekarang);
	// 					sisa += "Tersisa : " + response['sisa'];
	// 					$(".sisa" + value).html(sisa);
	// 				}
	// 			else{
	// 				if (response['status'] == 403) {
	// 					alert(response['message']);
	// 				}
	// 			}
	// 		},
	// 		error: function (data) {
	// 		}
	// 	});
	//
	// }
	//
	// function recall(objButton){
	// 	var value = objButton.value;
	// 	var local = window.location.origin+"/antrian/";
	// 	var url = local + "recallantrian";
	// 	$.ajax({
	// 		url: url,
	// 		type: 'ajax',
	// 		dataType: 'json',
	// 		method: 'POST',
	// 		async: true,
	// 		data: {"loket_id": value},
	// 		success: function (response) {
	// 			console.log(response);
	// 			var sekarang = "";
	// 			var sisa = "";
	// 			if (response['status'] == 200) {
	// 				sekarang += "0" + response['sekarang']['antrian_nomor'];
	// 				var nomor = response['sekarang']['antrian_nomor'];
	// 				var splitnomor = nomor.split("");
	//
	// 				play('in', 1);
	// 				play('urut', 0);
	//
	// 				if (splitnomor.length <= 1) {
	// 					play(""+ splitnomor[0], 0); //Satuan
	// 				}
	// 				//
	// 				else if (splitnomor.length === 2) {
	// 					// if (splitnomor[0] === 1 && splitnomor[1] === 0) {
	// 					//     play('10', 0); //sepuluh
	// 					// }
	// 					// else {
	// 					if (nomor < 20) {
	// 						if (nomor == '10'){
	// 							play('10',0);
	// 						}
	// 						else if (nomor == '11'){
	// 							play('11',0)
	// 						}
	// 						else{
	// 							play(splitnomor[1],0);
	// 							play('belas', 0);//belas
	// 						}
	//
	// 					}
	// 					else {
	// 						play(splitnomor[0],0);
	// 						play('puluh', 0);//puluh
	// 						if (splitnomor[1]!='0'){
	// 							play(splitnomor[1]);
	// 						}
	// 						// }
	// 					}
	// 				}
	//
	// 				else if (splitnomor.length === 3) {
	// 					if (splitnomor[0] == '1'){
	// 						play('100',0);
	// 					}
	// 					else {
	// 						play(splitnomor[0],0);
	// 						play('ratus',0);
	// 					}
	// 					if (splitnomor[1] == '0'){
	// 						if (splitnomor[2] != '0'){
	// 							play(splitnomor[2],0);
	// 						}
	// 					}else{
	// 						var puluhan = ""+splitnomor[1]+""+splitnomor[2];
	// 						if (puluhan < 20) {
	// 							if (puluhan == '10'){
	// 								play('10',0);
	// 							}
	// 							else if (puluhan == '11'){
	// 								play('11',0)
	// 							}
	// 							else{
	// 								play(splitnomor[2],0);
	// 								play('belas', 0);//belas
	// 							}
	// 						}
	// 						else {
	// 							play(splitnomor[1],0);
	// 							play('puluh', 0);//puluh
	// 							if (splitnomor[2]!='0'){
	// 								play(splitnomor[2]);
	// 							}
	// 							// }
	// 						}
	// 					}
	//
	//
	// 				}
	//
	// 				play('loket',0);
	// 				play(''+response['sekarang']['antrian_loket_id'],0);
	// 				$(".sekarang" + value).html(sekarang);
	// 				sisa += "Tersisa : " + response['sisa'];
	// 				$(".sisa" + value).html(sisa);
	// 			}
	// 			else{
	// 				if (response['status'] == 403) {
	// 					alert(response['message']);
	// 				}
	// 			}
	// 		},
	// 		error: function (data) {
	// 		}
	// 	});
	//
	// }
	//
	// function tambah(objButton){
	// 		var value = objButton.value;
	// 		//console.log(value);
	//
	// 		var local = window.location.origin + '/antrian/';
	// 		var url = local + "tambahantrian";
	// 		$.ajax({
	// 			url: url,
	// 			type: 'ajax',
	// 			dataType: 'json',
	// 			method: 'POST',
	// 			async: true,
	// 			data: {"loket_id": value},
	// 			success: function (response) {
	// 				init();
	// 			},
	// 			error: function (data) {
	//
	// 			}
	// 		});
	// }
	//
	// const audioMap = {
	// 	'in': default_local+'assets/audios/in.wav',
	// 	'1': default_local+'assets/audios/1.MP3',
	// 	'2': default_local+'assets/audios/2.MP3',
	// 	'3': default_local+'assets/audios/3.MP3',
	// 	'4': default_local+'assets/audios/4.MP3',
	// 	'5': default_local+'assets/audios/5.MP3',
	// 	'6': default_local+'assets/audios/6.MP3',
	// 	'7': default_local+'assets/audios/7.MP3',
	// 	'8': default_local+'assets/audios/8.MP3',
	// 	'9': default_local+'assets/audios/9.MP3',
	// 	'out': default_local+'assets/audios/out.wav',
	// 	'urut': default_local+'assets/audios/nomor-urut.MP3',
	// 	'belas': default_local+'assets/audios/belas.MP3',
	// 	'konter': default_local+'assets/audios/konter.MP3',
	// 	'puluh': default_local+'assets/audios/puluh.MP3',
	// 	'ratus': default_local+'assets/audios/ratus.MP3',
	// 	'ribu': default_local+'assets/audios/ribu.MP3',
	// 	'11': default_local+'assets/audios/sebelas.MP3',
	// 	'10': default_local+'assets/audios/sepuluh.MP3',
	// 	'100': default_local+'assets/audios/seratus.MP3',
	// 	'loket': default_local+'assets/audios/loket.MP3',
	// };
	//
	// const main = new LocketAudio();
	//
	// function play(num,duration) {
	// 	main.playAudio(num,duration);
	// }
	//
	// function LocketAudio() {
	// 	this.queue = [];
	// 	this.playAudio = function(num,duration) {
	// 		let self = this;
	// 		self.queue.push(num);
	// 		if (self.queue.length === 1) {
	// 			self._call(duration);
	// 		}
	// 		console.log(this.queue);
	// 	};
	//
	// 	this._call = function(duration) {
	// 		let self = this;
	// 		if (self.queue.length) {
	// 			setTimeout(() => {
	// 				var audio = new Audio(audioMap[self.queue[0]]);
	// 				audio.play();
	// 				self.queue.shift();
	// 				audio.onended = function() {
	// 					self._call();
	// 				};
	// 			}, duration);
	// 		}
	// 	}
	// }
	//
