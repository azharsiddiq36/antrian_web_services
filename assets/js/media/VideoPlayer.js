$(document).ready(function(){
	let connection = new Connection();
	let videoPath = connection.BASE_URL+'assets/videos/';
	var player = videojs('my-player');

	player.playlist([
	{
		sources: [{
			src: videoPath+'videoplayback.mp4',
			type: 'video/mp4'
		}],
	},
	{
		sources: [{
			src: videoPath+'didi.mp4',
			type: 'video/mp4'
		}],
	},
	]);

// Play through the playlist automatically.
	player.playlist.autoadvance(0);
	player.playlist.repeat(true);
});
