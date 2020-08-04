	$(document).ready(function(){
		let aktif = $('input[name="media-aktif"]:checked').val();
		let media  = $('input[name="media-aktif"]');

		activateMediaOption(aktif);

		$(document).on('change',media,function () {
			let mediaAktif = $('input[name="media-aktif"]:checked').val();

			if (mediaAktif !== aktif){
				aktif = mediaAktif;
			}
			activateMediaOption(aktif);
		});

		function activateMediaOption(aktif){
			if (aktif === 'gambar'){
				$('input[name="video-option"]').val('');
				$('#video-submit-btn').fadeOut('slow');
				$('#gambar-submit-btn').fadeIn('slow');
				$('input[name="gambar-option"]').val('gambar');
			}else{
				$('input[name="gambar-option"]').val('');
				$('#gambar-submit-btn').fadeOut('slow');
				$('#video-submit-btn').fadeIn('slow');
				$('input[name="video-option"]').val('video');
			}
		}


	});
