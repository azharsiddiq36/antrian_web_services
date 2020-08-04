$(document).ready(function(){
	let base = new Connection();
	$(document).on('change','select[name="locket_services"]',function () {
		let isEdit = $(this).hasClass('is-edit');
		let serviceEdit = $(this).data('service');
		let serviceId = $(this).val();
		let serviceName = $('select[name="locket_services"] option:selected').html();
		let url = base.BASE_URL+'LayananController/loketApi?layanan_id='+serviceId;
		$.get(url,function (response) {
			let data = response.data;
			let locketNumber;
			if (isEdit === true){
				if (parseInt(serviceId) === serviceEdit){
					locketNumber = data.length;
				}else{
					locketNumber = data.length+1;
				}
			}else {
				locketNumber = data.length+1;
			}
			$('input[name="locket_number"]').val(locketNumber);
			$('input[name="locket_name"]').val(serviceName+' - '+locketNumber);
			$('input[name="locket_name"]').attr('placeholder','contoh : '+serviceName+' - '+locketNumber);
		},'json');
	})
});
