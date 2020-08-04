class Services extends Connection{

	/*
	* mendapatkan data API menggunakan ajax
	* */
	getData(url){
		return $.ajax({
			url : this.baseUrl()+url,
			method: 'GET',
			dataType: 'JSON',
			async: false,
			success: function (response) {
				return response;
			},
			error: function (response) {
				return response;
			}
		}).responseJSON;
	}

	/*
	* post data ke db menggunakan ajax
	* respon status insert
	* */
	postData(url,data){
		return $.ajax({
			url : this.baseUrl()+url,
			data: data,
			method: 'POST',
			dataType: 'JSON',
			async: false,
			success: function (response) {
				return response;
			},
			error: function (response) {
				return response;
			}
		}).responseJSON;
	}
}
