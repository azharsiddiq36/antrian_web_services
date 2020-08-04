$(document).ready(function () {

	const baseUrl = window.location.origin + '/antrian/';

	/* -- events --*/
	$('.color-picker').on('asColorPicker::change',function (e) {
		let target = $(this).data('transform');
		let value = $(this).val();
		let changeType = $(this).data('change');
		transform(target,value,changeType);
	});

	/*-- functions --*/
	function transform(target,value,changeType) {
		$(target).css(changeType,value);
	}
});
