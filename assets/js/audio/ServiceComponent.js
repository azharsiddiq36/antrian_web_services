class ServiceComponent extends Services{
	antrianNumber;
	serviceBg;

	constructor(){
		super();
		this.serviceBg = this.BASE_URL+'assets/images/background/servicecard-bg.png';
	}

	serviceComponent(){
		let service = this;
		let container = $('#queue-box-wrapper');
		let mixer = mixitup(container, {
			behavior: {
				liveSort: true
			},
			load: {
				sort: 'panggilan:desc'
			}
		});
		$('.card-service.mix').each(function () {
			let locketId = $(this).data('loket');
			let locket = service.getData('Services/loket/'+locketId);
			$(this).attr('data-panggilan',locket.data.loket_waktu_panggilan);
			let activeQueue = service.getActiveQueue(locketId);
			let activeQueueContent = $('#loket-'+locketId+' .active-queue-number');
			activeQueueContent.html(activeQueue);
		});

		setTimeout(function () {
			mixer.sort('panggilan:desc');
		},100);
	}

	getActiveQueue(locketId){
		let activeData = this.getData('Services/activeNumber/'+locketId);

		return activeData.antrian;
	}

	refresh(locketId){
		this.serviceComponent();
		let activeQueue = this.getActiveQueue(locketId);
		let activeQueueContent = $('#loket-'+locketId+' .active-queue-number');
		let activeQueueContainer = $('#loket-'+locketId+'');
		activeQueueContent.html(activeQueue);
		$('.active-queue-number').removeClass('flash');
		activeQueueContainer.addClass('flash');
	}
}
