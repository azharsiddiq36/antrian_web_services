class Logo extends Services{
	data;

	constructor(){
		super();

		this.data = this.getData('ApiController/app/1');
	}

	refresh(){
		let logoData = this.data.data.app_logo.replace('"','');
		let logoUrl = this.BASE_URL+logoData;
		$('#brand-content').attr('src',logoUrl.replace('"',''));

	}
}
