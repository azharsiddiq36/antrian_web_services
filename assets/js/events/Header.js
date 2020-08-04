class Header extends Services{
	data;

	constructor(){
		super();

		this.data = this.getData('ApiController/app/1');
	}

	refresh(){
		let headerData = JSON.parse(this.data.data.app_header);
		let headerStack = [];
		for (let i in headerData){
			headerStack.push(headerData[i])
		}
		$('#header-card').css('background-color',headerStack[1]);
		$('#bg-paralelogram').css('background-color',headerStack[2]);
		$('#date-time-wrapper').css('background-color',headerStack[3]);
		$('#time-content').css({
			'color' : headerStack[4],
			'font-family' : headerStack[5],
			'font-size':headerStack[6],
		});
		$('#date-content').css({
			'color' : headerStack[7],
			'font-family' : headerStack[8]
		});
	}
}
