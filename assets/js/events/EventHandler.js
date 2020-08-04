$(document).ready(function(){
	let con = new Connection();
	let service = new Services();

	let cache = 0;
	let lastRefresh = service.getData('Services/getLastRefresh');
	cache = lastRefresh.time;
	let sse = new EventSource(con.BASE_URL+'broadcast.php');

	sse.addEventListener('refresh',function (e) {
		if (e.data !== 'null'){
			let response = JSON.parse(e.data);
			if (response.time !== cache ){
				refresh(e);
				cache = response.time;
			}
		}
	});

	function refresh(data) {
		let response = JSON.parse(data.data);

		switch (response.data) {
			case 'footer':
				let footer = new Footer();
				footer.refresh(); break;
			case 'background':
				let background = new Background();
				background.refresh(); break;
			case 'logo':
				let logo = new Logo();
				logo.refresh(); break;
			case 'header':
				let header = new Header();
				header.refresh(); break;
		}
	}
});
