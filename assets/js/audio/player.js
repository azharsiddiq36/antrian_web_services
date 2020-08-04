$(document).ready(function(){
	
	let connection = new Connection();
	let antrian = new MainAntrian();
	let layanan = new ServiceComponent();
	const BASE_URL = connection.BASE_URL;
	layanan.serviceComponent();

	let callData = antrian.getCallData();


	let audioMap = {
		'in': BASE_URL+'assets/audios/in.wav',
		'1': BASE_URL+'assets/audios/1.MP3',
		'2': BASE_URL+'assets/audios/2.MP3',
		'3': BASE_URL+'assets/audios/3.MP3',
		'4': BASE_URL+'assets/audios/4.MP3',
		'5': BASE_URL+'assets/audios/5.MP3',
		'6': BASE_URL+'assets/audios/6.MP3',
		'7': BASE_URL+'assets/audios/7.MP3',
		'8': BASE_URL+'assets/audios/8.MP3',
		'9': BASE_URL+'assets/audios/9.MP3',
		'out': BASE_URL+'assets/audios/out.wav',
		'urut': BASE_URL+'assets/audios/nomor-urut.MP3',
		'antrian': BASE_URL+'assets/audios/static/nomor-antrian.MP3',
		'belas': BASE_URL+'assets/audios/belas.MP3',
		'konter': BASE_URL+'assets/audios/konter.MP3',
		'puluh': BASE_URL+'assets/audios/puluh.MP3',
		'ratus': BASE_URL+'assets/audios/ratus.MP3',
		'ribu': BASE_URL+'assets/audios/ribu.MP3',
		'11': BASE_URL+'assets/audios/sebelas.MP3',
		'10': BASE_URL+'assets/audios/sepuluh.MP3',
		'100': BASE_URL+'assets/audios/seratus.MP3',
		'loket': BASE_URL+'assets/audios/loket.MP3',
		'menuju' : BASE_URL+'assets/audios/static/silahkan-menuju.MP3'
	};

	// realtime check data on call table
	setInterval(function () {
		let call = antrian.getCallData();
		if (callData.panggilan_updated !== call.panggilan_updated){
			let queue;
			let locket;
			let locketNumber;
			let isSwitch = false;
			if (call.panggilan_jenis === 'call'){
				isSwitch = false;

				audioMap.prefix = BASE_URL+call.layanan_suara_awalan;
				queue = call.panggilan_antrian;
				locket = call.panggilan_loket;
				locketNumber = call.loket_nomor;
				layanan.refresh(locket);
			}else if (call.panggilan_jenis === 'switch'){
				isSwitch = true;

				audioMap.prefix = BASE_URL+call.switchcall_prefix;
				audioMap.service = BASE_URL+call.layanan_suara_nama;
				queue = call.panggilan_antrian;
				locket = call.panggilan_loket;
				locketNumber = call.loket_nomor;
				layanan.refresh(locket);
			}else if (call.panggilan_jenis === 'switchRecall'){
				isSwitch = true;
				console.log(call.panggilan_jenis);

				audioMap.prefix = BASE_URL+call.switchcall_prefix;
				audioMap.service = BASE_URL+call.layanan_suara_nama;
				queue = call.recall_antrian;
				locketNumber = call.recall_loket;
			}else{
				isSwitch = false;

				audioMap.prefix = BASE_URL+call.recall_path;
				queue = call.recall_antrian;
				locketNumber = call.recall_loket;
			}
			speak(queue,locketNumber,isSwitch);
			callData = call;
		}
	},1000);

	const main = new LocketAudio();

	function play(num,duration) {
		main.playAudio(num,duration);
	}

	function LocketAudio() {
		this.queue = [];
		this.playAudio = function(num,duration) {
			let self = this;
			self.queue.push(num);
			if (self.queue.length === 1) {
				self._call(duration);
			}
		};

		this._call = function(duration) {
			let self = this;
			if (self.queue.length) {
				setTimeout(() => {
					var audio = new Audio(audioMap[self.queue[0]]);
					audio.play();
					self.queue.shift();
					audio.onended = function() {
						self._call();
					};
				}, duration);
			}
		}
	}

	function speak(queueNumber,locketId,isSwitch) {
		var nomor = queueNumber;
		var splitnomor = nomor.split("");

		play('in', 1);
		play('antrian', 0);
		play('prefix', 0);

		if (splitnomor.length <= 1) {
			play(""+ splitnomor[0], 0); //Satuan
		}
		//
		else if (splitnomor.length === 2) {
			// if (splitnomor[0] === 1 && splitnomor[1] === 0) {
			//     play('10', 0); //sepuluh
			// }
			// else {
			if (nomor < 20) {
				if (nomor == '10'){
					play('10',0);
				}
				else if (nomor == '11'){
					play('11',0)
				}
				else{
					play(splitnomor[1],0);
					play('belas', 0);//belas
				}

			}
			else {
				play(splitnomor[0],0);
				play('puluh', 0);//puluh
				if (splitnomor[1]!='0'){
					play(splitnomor[1]);
				}
				// }
			}
		}

		else if (splitnomor.length === 3) {
			if (splitnomor[0] == '1'){
				play('100',0);
			}
			else {
				play(splitnomor[0],0);
				play('ratus',0);
			}
			if (splitnomor[1] == '0'){
				if (splitnomor[2] != '0'){
					play(splitnomor[2],0);
				}
			}else{
				var puluhan = ""+splitnomor[1]+""+splitnomor[2];
				if (puluhan < 20) {
					if (puluhan == '10'){
						play('10',0);
					}
					else if (puluhan == '11'){
						play('11',0)
					}
					else{
						play(splitnomor[2],0);
						play('belas', 0);//belas
					}
				}
				else {
					play(splitnomor[1],0);
					play('puluh', 0);//puluh
					if (splitnomor[2]!='0'){
						play(splitnomor[2]);
					}
					// }
				}
			}
		}

		if (isSwitch===true){
			play('menuju',0);
			play('service',0);
		}
		play('loket',0);
		play(locketId,0);

	}


});

