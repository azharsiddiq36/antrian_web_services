$(document).ready(function(){
	let connection = new Connection();
	let keyboard = null;

	$('.bt-max-length').on('click',function () {
		$(this).select();
	});

	$('select[name="loket"]').change(function () {
		let locketId = $(this).val();
		$.get(connection.BASE_URL+'ComponentService/checkLocketExists/'+locketId,function (response) {
			if (response > 0){
				$('#locket-alert').fadeIn();
				$(this).val('');
			}else {
				$('#locket-alert').fadeOut();
			}
		},'json');
	});

	$('#keyboard-select').change(function () {
		keyboard = $(this).val();
		$('input[name="call"]').val('');
		$('input[name="recall"]').val('');
	});

	$(document).on('keydown','.bt-max-length', function (e) {
		let key = e.keyCode;
		$(this).next().val(key);
		let parent = $(this).parent().attr('id');
		let checkData = {
			'keyboard' : keyboard,
			'code' : key
		};
		$.post(connection.BASE_URL+'ComponentService/codeExistCheck',checkData,function (response) {
			if (response === 1){
				$('#'+parent+' span').fadeIn();
				$(this).val('');
			}else{
				$('#'+parent+' span').fadeOut();
			}
		},'json');
	});


});
