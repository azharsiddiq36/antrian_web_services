class Footer extends Services{
	data;

	constructor(){
		super();

		this.data = this.getData('ApiController/app/1');
	}

	refresh(){
		let footerData = JSON.parse(this.data.data.app_footer);
		let footerStack = [];
		for (let i in footerData){
			footerStack.push(footerData[i])
		}
		$('#footer-card').attr('style','background-color:'+footerStack[0]);
		$('#running-text').attr('style','font-size:22px;color:'+footerStack[1]+';font-family:'+footerStack[2]);
		$('#running-text').html(footerStack[3]);
	}
}
