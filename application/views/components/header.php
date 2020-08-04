
<div class="card setting-card" id="dataVue">
	<div class="card-body" style="overflow: hidden">
		<h4 class="card-title pb-3 border-bottom mb-3"><?= $settingsTitle;?></h4>

		<h3>Preview</h3>
		<form action="<?= base_url('ComponentService/unggahLogo')?>" class="form-row" method="post" enctype="multipart/form-data">
			<div class="form-group col-12">
				<h4 class="border-bottom" style="font-family: titilliumweb-bold">
					Gambar Logo
				</h4>
				<input type="file" class="dropify" data-height="126"
					   name="logo-img" data-default-file="<?= base_url().$logo?>"
					   data-allowed-file-extensions="jpg png jpeg"
					   data-min-width="600"
					   data-min-height="120"
					   required>
			</div>

			<button type="submit" class="btn btn-primary col-12" name="unggah">
				unggah
			</button>
		</form>


		<div class="row mb-3 mt-3" id="bg-header-simulator" style="background-color: <?=$headerComponent['background-header']?>;overflow: hidden" >
			<div class="col-8">
				<!-- ---- TAG LINE AND BRAND SECTION -->
				<div id="tagline-head">
					<div class="tagline-wrapper">
						<div class="parallelogram" style="background: <?=$headerComponent['background-paralelogram']?>;" id="bg-paralelogram-simulator">
						</div>
						<div class="brand-wrapper" style='background-image: url("<?= base_url('assets/images/doodle/diamond.png')?>");background-repeat: no-repeat;background-position: right;background-size: inherit;'>
							<img src="<?= base_url($logo) ?>" alt="" width="100%" height="90%">
						</div>
					</div>
				</div>
				<!-- ---- END BRAND AND TAG LINE SECTION -->
			</div>
			<div class="col-4">
				<div id="date-time-indicator" >
					<div id="date-time-wrapper" style="background-color: <?=$headerComponent['background-timer']?>" >
						<div class="time-indicator d-flex justify-content-center">
							<h1 style="color:<?=$headerComponent['color-timer']?>;line-height: 60px;font-family: <?=$headerComponent['font-family-timer']?>" class="m-0" id="time-content">
							</h1>
						</div>
						<div class="date-indicator d-flex justify-content-center">
							<h4 style="color: <?=$headerComponent['color-date']?>;font-family: <?=$headerComponent['font-family-date']?>, sans-serif;line-height: 44px;font-size: 16px" class="m-0" id="date-content" >

							</h4>
						</div>
					</div>
				</div>
			</div>
		</div>

		<form action="#" class="row pt-4 border-top" method="post" id="headerComponentData">
			<div class="col-6">
				<div class="row mt-2">
					<div class="col-12" >
						<h3 style="font-family: titilliumweb-bold" class="border-bottom">Warna</h3>
					</div>
					<label for="background-header" class="col-6 col-form-label font-weight-medium">Warna Latar Header</label>
					<div class="col-6">
						<input type='text' class="color-picker" value="<?=$headerComponent['background-header']?>" name="background-header" data-transform="#bg-header-simulator" data-change="background-color"/>
					</div>
				</div>
				<div class="row mt-2">
					<label for="background-paralelogram" class="col-6 col-form-label font-weight-medium">Warna Latar logo</label>
					<div class="col-6">
						<input type='text' class="color-picker" value="<?=$headerComponent['background-paralelogram']?>" name="background-paralelogram" data-transform="#bg-paralelogram-simulator" data-change="background-color"/>
					</div>
				</div>
				<div class="row mt-2">
					<label for="background-timer" class="col-6 col-form-label font-weight-medium">Warna Latar Waktu</label>
					<div class="col-6">
						<input type='text' class="color-picker" value="<?=$headerComponent['background-timer']?>" name="background-timer" data-transform="#date-time-wrapper" data-change="background-color"/>
					</div>
				</div>
				<div class="row mt-2">
					<label for="color-timer" class="col-6 col-form-label font-weight-medium">Warna Jam</label>
					<div class="col-6">
						<input type='text' class="color-picker" value="<?=$headerComponent['color-timer']?>" name="color-timer" data-transform="#time-content" data-change="color"/>
					</div>
				</div>
				<div class="row mt-2">
					<label for="color-date" class="col-6 col-form-label font-weight-medium">Warna Tanggal</label>
					<div class="col-6">
						<input type='text' class="color-picker" value="<?=$headerComponent['color-date']?>" name="color-date" data-transform="#date-content" data-change="color"/>
					</div>
				</div>
			</div>

			<!-- text setting -->
			<div class="col-6">
				<div class="row mt-2">
					<div class="col-12">
						<h3 style="font-family: titilliumweb-bold" class="border-bottom">Text</h3>
					</div>
					<label for="font-family-timer" class="col-6 col-form-label font-weight-medium">Gaya Huruf Jam</label>
					<div class="col-6">
						<select class="form-control border-primary form-simulator select-simulator" data-transform="#time-content" data-change="font-family" name="font-family-timer">
							<option value="<?=$headerComponent['font-family-timer']?>" selected><?=$headerComponent['font-family-timer']?></option>
							<option value="Roboto">Roboto</option>
							<option value="girassol-regular">Girassol</option>
							<option value="titilliumweb-bold">Titillium Web</option>
							<option value="sans-serif">Sans Serif</option>
							<option value="digi-regular">Digital</option>
							<option value="digi-bold">Digital Bold</option>
						</select>
					</div>
				</div>
				<div class="row mt-2">
					<label for="gaya-huruf-tanggal" class="col-6 col-form-label font-weight-medium">Gaya Huruf Tanggal</label>
					<div class="col-6">
						<select class="form-control border-primary form-simulator select-simulator" data-transform="#date-content" data-change="font-family" name="font-family-date">
							<option value="<?=$headerComponent['font-family-date']?>" selected><?=$headerComponent['font-family-date']?></option>
							<option value="robot-bold">Roboto</option>
							<option value="girassol-regular">Girassol</option>
							<option value="titilliumweb-bold">Titillium Web</option>
							<option value="sans-serif">Sans Serif</option>
							<option value="digi-regular">Digital</option>
							<option value="digi-bold">Digital Bold</option>
						</select>
					</div>
				</div>

				<!-- position setting -->
<!--				<div class="row mt-2">-->
<!--					<div class="col-12">-->
<!--						<h3 style="font-family: titilliumweb-bold" class="border-bottom">Logo</h3>-->
<!--					</div>-->
<!--					<label for="gaya-huruf-waktu" class="col-6 col-form-label font-weight-medium">Posisi Logo</label>-->
<!--					<div class="col-6">-->
<!--						<div class="form-group">-->
<!--							<div class="form-radio">-->
<!--								<label class="form-check-label">-->
<!--									<input type="radio" class="form-check-input" name="logo-position" id="left-to-right" value="left-to-right" checked="">-->
<!--									Kiri-->
<!--									<i class="input-helper"></i>-->
<!--								</label>-->
<!--							</div>-->
<!--							<div class="form-radio">-->
<!--								<label class="form-check-label">-->
<!--									<input type="radio" class="form-check-input" name="logo-position" id="right-to-left" value="right-to-left">-->
<!--									Kanan-->
<!--									<i class="input-helper"></i></label>-->
<!--							</div>-->
<!--						</div>-->
<!--					</div>-->
<!--				</div>-->

			</div>


			<div class="col-12 mt-5">
				<div class="d-flex justify-content-center">
					<button type="button" name="simpan" class="btn btn-primary col-12" id="headerSubmitBtn">simpan</button>
				</div>
			</div>
		</form>

	</div>
</div>
