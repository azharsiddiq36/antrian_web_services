$(document).ready(function(){
	let con = new Connection();
	let service = new Services();
	let serviceComponent = new ServiceComponent();
	let ev = null;

	let cache = 0;
	let recallCache = 0;

	let lastCallData = service.getData('Services/getLastCall');
	let lastRecallData = service.getData('Services/getLastRecall');
	recallCache = lastRecallData.time;
	cache = lastCallData.time;

	let sse = new EventSource(con.BASE_URL+'broadcast.php');

	const BASE_URL = con.BASE_URL;

	if (window.location.href.indexOf("extend") < 0) {
		serviceComponent.serviceComponent();
	}else{
		ev = new ExtendView();
		ev.startMixer();
	}

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

	const  main = new LocketAudio();

	sse.addEventListener('call',function (e) {
		if (e.data === 'null'){
			onResponseEmpty();
		}else {
			onResponseExists(e);
		}
	});

	sse.addEventListener('recall',function (e) {
		if (e.data === 'null'){
			onResponseEmpty();
		}else{
			onRecallExist(e);
		}
	});

	function onResponseExists(e) {
		let response = JSON.parse(e.data);
		if (response.time !== cache ){
			let locketId = response.locket.loket_nomor;
			let queueNumber =  response.data.antrian_nomor;
			let queueId = response.data.antrian_id;
			if (response.data.antrian_jenis_panggilan === 'alihan'){

				audioMap[queueId] = response.data.antrian_suara_alihan_prefix;
				audioMap.service = response.audio.layanan_suara_nama;
				speak(queueId,queueNumber,locketId,true);
			}else{

				audioMap[queueId] = response.audio.layanan_suara_awalan;
				speak(queueId,queueNumber,locketId,false);
			}

			if (window.location.href.indexOf("extend") > -1) {
				ev.refresh();
			}else{
				serviceComponent.refresh(locketId);
			}
			cache = response.time;
		}

	}

	function onResponseEmpty() {
		window.location.reload();
	}

	function onRecallExist(e) {
		let response = JSON.parse(e.data);
		if (response.time !== recallCache){
			let locketId = response.locket.loket_nomor;
			let queueNumber =  response.data.antrian_nomor;
			let queueId = response.data.antrian_id;
			if (response.data.antrian_jenis_panggilan === 'alihan'){
				audioMap[queueId] = response.data.antrian_suara_alihan_prefix;
				audioMap.service = response.audio.layanan_suara_nama;
				speak(queueId,queueNumber,locketId,true);
			}else{

				audioMap[queueId] = response.audio.layanan_suara_awalan;
				speak(queueId,queueNumber,locketId,false);
			}

			recallCache = response.time;
		}
	}

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
			let vid = $('#video-player');
			if (vid.length >0){
				vid[0].volume = 0.3;
			}
			let self = this;
			if (self.queue.length) {
				setTimeout(() => {
					var audio = new Audio(audioMap[self.queue[0]]);
					audio.play();
					self.queue.shift();
					audio.onended = function() {
						self._call();
						let vid = $('#video-player');
						if (vid.length >0){
							vid[0].volume = 0.3;
						}
					};
				}, duration);
			}else{
				$(document).ready(function(){
					let vid = $('#video-player');
					if ( vid.length >0){
						vid[0].volume = 1;
						vid.attr('volume',1);
					}
				});
			}
		}
	}

	function speak(queueId,queueNumber,locketId,isSwitch) {

		play('in', 1);
		play('antrian', 0);
		play(queueId, 0);

		speakLogic(queueNumber);

		if (isSwitch===true){
			play('menuju',0);
			play('service',0);
		}
		play('loket',0);
		speakLogic(locketId);

		delete audioMap.queueId;
	}

	function speakLogic(number) {
		let nomor = number;
		let splitnomor = nomor.split("");

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
	}

});
