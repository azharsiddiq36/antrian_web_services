class AudioHelper extends Connection{

	audios = [];
	nomorAntrian;
	loketAktif;

	/*
	* void
	* arg1 = loket antrian yang terakhir kali di panggil (string [Cookies])
	* description : membunyikan audio yang berisi nomor antrian
	* */
	chainPlay(activeQueue,activeLocket){

		this.nomorAntrian = activeQueue;
		this.loketAktif = activeLocket;

		// initialisation:
		let pCount = 0;
		let playlistUrls = this.numberSpeak(this.nomorAntrian,this.loketAktif),

		// audio list
		howlerBank = [],
		loop = false;

		// playing i+1 audio (= chaining audio files)
		let onEnd = function(e) {
			if (loop === true ) {
				pCount = (pCount + 1 !== howlerBank.length)? pCount + 1 : 0;
			} else {
				pCount = pCount + 1;
			}
			if (howlerBank[pCount] !== undefined){
				howlerBank[pCount].play();
			}
		};

		// build up howlerBank:
		playlistUrls.forEach(function(current, i) {
			howlerBank.push(new Howl({ src: [playlistUrls[i]], onend: onEnd, buffer: true }))
		});

		// initiate the whole :
		howlerBank[0].play();
	}
	
	numberSpeak(number,locket){
		this.audios = [];
		let nomor = number,
			audiosUrl = this.baseUrl()+'assets/audios/';

		this.audios[0] = this.baseUrl()+'assets/audios/in.wav';
		this.audios[1] = this.baseUrl()+'assets/audios/nomor-urut.mp3';
		this.audios.splice(2,0,audiosUrl+nomor.toString()+'.mp3');
		this.audios.splice(3,0,audiosUrl+'loket.mp3');
		this.audios.splice(4,0,audiosUrl+locket.toString()+'.mp3');

		return this.audios;
	}

}
