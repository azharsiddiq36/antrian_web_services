$(document).ready(function(){
	let baseUrl = window.location.origin+'/antrian/'; // development
	// let baseUrl = window.location.origin; // production

	// selector
	let footerComponentData = $('#footerComponentData');
	let submitBtn = $('#footerSubmitBtn');
	let alertContainer = $('#settings-alert');


	//events
	submitBtn.click(function () {
		let footerData = footerComponentData.serializeArray();
		editFooter(footerData);
	});


	// functions
	function editFooter(data) {
		$.ajax({
			url : baseUrl+'ComponentService/editFooter',
			data : data,
			type : 'POST',
			async : true,
			dataType : 'JSON',
			method : 'post',
			success : function (response) {
				if (response.status === 'success'){
					$('html,body').animate({ scrollTop: 0 }, 'slow');
					settingsAlert(true,'alert-success','berhasil menyimpan data');
					setInterval(function () {
						window.location.reload();
					},4000);
				}else {
					settingsAlert(false);
				}
			},
			error : function (response) {
				console.log(response);
			}
		})
	}

	// setting alert
	function settingsAlert(visibility,type ='',message ='') {
		if (visibility === true){
			alertContainer.fadeIn('slow');
			alertContainer.addClass(type);
			alertContainer.html(message);

			setInterval(function () {
				alertContainer.fadeOut('slow');
			},3000);
		}else{
			alertContainer.fadeOut('slow');
			alertContainer.html('');
		}
	}

});
