class ExtendView extends Services{
	queueNumber;

	service;

	callData;

	activeQueue;

	activeLocket;

	constructor() {
		super();
		this.setCallData();
		this.setProperty();
	}

	getCallData(){
		return this.callData;
	}

	setCallData(){
		this.callData = super.getData('Services/getLastCall');
	}

	setProperty(){
		this.activeQueue = $('#activeQueue');
		this.activeLocket = $('#activeLocket');

		this.setActiveQueue();
	}

	setActiveQueue(){
		this.activeQueue.html(this.callData.data.antrian_nomor_aktif);
		this.activeLocket.html('LOKET '+this.callData.locket.loket_alias);
	}

	startMixer(){
		let extendView = this;
		let serviceComponent = new ServiceComponent();
		let container = $('#mixit-container');
		let mixer = mixitup(container, {
			behavior: {
				liveSort: true
			},
			selectors:{
				target: '.waiting-queue-card'
			},
			load: {
				sort: 'call:desc'
			}
		});

		$('.extend-view.waiting-queue-card').each(function () {
			let locketId = $(this).attr('id');
			let locket = extendView.getData('Services/loket/'+locketId);
			let activeQueue = serviceComponent.getActiveQueue(locketId);
			$(this).attr('data-call',locket.data.loket_waktu_panggilan);
			let activeQueueContent = $('#'+locketId+' .active-queue-number');
			activeQueueContent.html(activeQueue);
		});

		setTimeout(function () {
			mixer.sort('call:desc');
		},500);

	}

	refresh(){
		this.setCallData();
		this.setActiveQueue();

		this.startMixer();
	}
}
