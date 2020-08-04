class Background extends Services{
	data;

	constructor(){
		super();

		this.data = super.getData('ApiController/app/1');
	}

	refresh(){
		let backgroundData = JSON.parse(this.data.data.app_container);
		let backgroundStack = [];
		for (let i in backgroundData){
			backgroundStack.push(backgroundData[i])
		}
		let imageUrl = this.BASE_URL+backgroundStack[2];
		if (backgroundStack[1] === 'true'){
			$('#app-container').attr('style','background:url("'+imageUrl+'");background-repeat: no-repeat;' +
				'background-size: cover;'+
				'background-position: center;')
		}else{
			$('#app-container').attr('style','background-color:'+backgroundStack[0]);
		}
	}
}
