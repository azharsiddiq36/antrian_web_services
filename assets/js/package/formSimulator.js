$(document).ready(function(){

	/*-- events --*/
	/*-- dropdown select simulator --*/
	$(document).on('change','.form-simulator.select-simulator',function () {
		let value  = $(this).val();
		let target = $(this).data('transform');
		let changeType = $(this).data('change');
		transform(target,value,changeType);

	});
	/*-- input text simulatr --*/
	$(document).on('keyup','.form-simulator.input-simulator.change-value', function () {
		let value = $(this).val();
		let target = $(this).data('transform');
		transformValue(target,value);
	});

	/*-- input text color simulator [special change border color] ---*/
	$(document).on('asColorPicker::change','color-picker.add-border', function () {
		let value  = $(this).val();
		let target = $(this).data('transform');
		let changeType = $(this).data('change');
		transform(target,value,changeType);
		console.log(target);
	});

	/*-- functions --*/
	/*-- dynamic css tranform for single element*/
	function transform(target,value,changeType) {
		$(target).css(changeType,value);
	}
	/*-- change for only single value --*/
	function transformValue(target,value) {
		$(target).html(value);
	}

});
