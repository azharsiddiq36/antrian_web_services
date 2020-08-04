
<div class="card setting-card" >
	<div class="card-body" style="overflow: hidden">
		<h4 class="card-title pb-3 border-bottom mb-3"><?= $settingsTitle;?></h4>

		<h3>Preview Hasil Cetak</h3>
		<div class="row mb-3" id="bg-header-simulator" >

			<!-- component hasil cetak -->
				<div class="col-12" style="padding: 4px 120px; box-sizing: border-box">
					<div class="card card-shadow" id="ticket-preview" style="font-family: inherit;color: black">
						<div class="card-header bg-white p-0" style="border-bottom: 2px black solid;">
							<div class="row">
								<div class="col-12">
									<img src="<?= base_url('assets/images/logo-dintanak.png')?>" alt="" width="100%" height="auto">
								</div>
							</div>
						</div>
						<div class="card-body p-2" >
							<div class="row">
								<div class="col-12 d-flex justify-content-between">
									<p style="font-family: inherit;color: inherit" id="date-content"></p>
									<p style="font-family: inherit;color: inherit" id="time-content"></p>
								</div>

								<div class="col-12 d-flex justify-content-center">
									<h2 style="font-family: inherit;text-transform: uppercase;color: inherit">nama layanan</h2>
								</div>

								<div class="col-12 d-flex justify-content-center">
									<h4 style="font-family: inherit;color: inherit">Nomor Antrian Anda : </h4>
								</div>

								<div class="col-12 d-flex justify-content-center my-2">
									<h1 style="font-family: inherit;text-transform: uppercase;font-size: 56px;color: inherit">A-009</h1>
								</div>

								<div class="col-12 d-flex justify-content-center">
									<h4 style="font-family: inherit;color: inherit">Silahkan Menunggu Nomor Anda Dipanggil</h4>
								</div>
							</div>
						</div>
						<div class="card-footer bg-white border-0 p-0">
							<div class="row">
								<div class="col-12 d-flex justify-content-center">
									<h3 style="font-family: inherit;color: inherit" id="text-footer" class="text-center">Silahkan Menunggu Nomor Anda Dipanggil</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
			<!-- component hasil cetak -->

		</div>

		<form action="#" class="form-row" method="post" enctype="multipart/form-data">
			<div class="form-group col-12">
				<h4 class="border-bottom" style="font-family: titilliumweb-bold">
					Pengaturan Text
				</h4>

				<div class="row">
					<div class="col-12">
						<div class="form-group row">
							<label for="footer-text" class="col-3 col-form-label font-weight-medium">Text Footer</label>
							<textarea class="form-control col-9 form-simulator input-simulator change-value" rows="2" data-transform="#text-footer" name="footer-text">Silahkan Menunggu Nomor Anda Dipanggil</textarea>
						</div>
					</div>

					<div class="col-6 ">
						<label for="background-header" class="col-6 col-form-label font-weight-medium pl-0">Warna Text</label>
						<input type='text' class="color-picker" value="#000000" name="background-header" data-transform="#ticket-preview" data-change="color"/>
					</div>

					<div class="col-6 ">
						<label for="font-family-timer" class="col-12 col-form-label font-weight-medium">Gaya Huruf</label>
						<div class="col-12">
							<select class="form-control border-primary form-simulator select-simulator"
									name="font-family-ticket" data-transform="#ticket-preview" data-change="font-family">
								<option value="Roboto">Roboto</option>
								<option value="girassol-regular">Girassol</option>
								<option value="titilliumweb-bold">Titillium Web</option>
								<option value="sans-serif">Sans Serif</option>
								<option value="digi-regular">Digital</option>
								<option value="digi-bold">Digital Bold</option>
							</select>
						</div>					</div>
				</div>

			</div>

			<button type="submit" class="btn btn-primary col-12" name="unggah">
				simpan
			</button>
		</form>

	</div>
</div>
