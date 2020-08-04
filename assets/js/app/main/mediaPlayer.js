$(document).ready(function(){
	let media = new MediaService();
	let connection = new Connection();
	let service = new Services();

	let cache = 0;
	let lastRefresh = service.getData('Services/getLastRefresh');
	cache = lastRefresh.time;
	let sse = new EventSource(connection.BASE_URL+'broadcast.php');

	let result = service.getData('ComponentService/getMedia');
	let mediaSource = result.data;

	let mediaData = [];

	for (let i = 0; i < mediaSource.length; i++) {
		mediaData.push({
			src: connection.BASE_URL+mediaSource[i].source,
			type: mediaSource[i].type,
			mediaType: mediaSource[i].media_type,
			imageDuration: mediaSource[i].image_duration
		});
	}

	media.setData(mediaData);
	console.log(media.getData());
	sse.addEventListener('refresh',function (e) {
		if (e.data !== 'null'){
			let response = JSON.parse(e.data);
			if (response.time !== cache ){
				if (response.data === 'add-media'){
					pushMedia();
				}else{
					pullMedia();
				}
				cache = response.time;
			}
		}
	});

	function pushMedia()
	{
		let mediaStack = service.getData('ComponentService/getMedia');
		let topOfStack = mediaStack.data[(mediaStack.data.length-1)];
		media.pushData({
			'imageDuration' : topOfStack.image_duration,
			'mediaType' : topOfStack.media_type,
			'src' : connection.BASE_URL+topOfStack.source,
			'type' : topOfStack.type
		});
		console.log(media.getData());

	}

	function pullMedia()
	{
		let result = service.getData('ComponentService/getMedia');
		let mediaSource = result.data;

		let mediaData = [];

		for (let i = 0; i < mediaSource.length; i++) {
			mediaData.push({
				src: connection.BASE_URL+mediaSource[i].source,
				type: mediaSource[i].type,
				mediaType: mediaSource[i].media_type,
				imageDuration: mediaSource[i].image_duration
			});
		}

		media.setData(mediaData);
		console.log(media.getData());
	}
	media.play(mediaData[0]);

});
