$(document).ready(function(){
	let con = new Connection();
	let location = window.location.href;
	let main = false;
	let settingsPage = con.BASE_URL+'settings/tombol';
	let settings = false;

	settings = location === settingsPage;

	main = location === con.BASE_URL;

	$(document).keydown(function (e) {
		e.preventDefault();
		let key = e.key;
		let url = con.BASE_URL+'Services/execKeyboard/'+key;
		$.get(url,function (response) {
			execute(response);
		},'json');
	});

	function execute(response) {
		if (settings !== true){
			if (response.type === 'redirect'){
				window.location.href = response.url;
			}else{
				if (main === true){
					$.get(response.url,function (data) {
						console.log(data);
					},'json');
				}
			}
		}
	}
});
