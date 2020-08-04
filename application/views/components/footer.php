
<div class="card setting-card" id="dataVue">
	<div class="card-body" style="overflow: hidden">
		<h4 class="card-title pb-3 border-bottom mb-3"><?= $settingsTitle;?></h4>

		<h3 style="font-family: titilliumweb-bold">Preview</h3>
		<div class="row mb-3"  >
			<div class="col-12">
				<div id="footer-card-simulator" class="border-top border-bottom" style="background-color: <?= $footerComponent['background-footer']?>;">
					<marquee behavior="scroll" direction="left" id="running-text" style="font-size: 22px;color: <?= $footerComponent['color-footer']?>;font-family:  <?= $footerComponent['font-family-footer']?>"><?= $footerComponent['footer-text']?></marquee>
				</div>
			</div>
		</div>


		<form action="#" class="row pt-4 border-top" method="post" id="footerComponentData">
			<div class="col-12">
				<h4 style="font-family: titilliumweb-bold">Running Text</h4>
			</div>
			<div class="col-12">
				<div class="form-group row">
					<label for="footer-text" class="col-3 col-form-label font-weight-medium">Text</label>
					<textarea class="form-control col-9 form-simulator input-simulator change-value" id="text-footer" rows="2" data-transform="#running-text" name="footer-text"><?= $footerComponent['footer-text']?></textarea>
				</div>
			</div>
			<!-- text setting -->
			<div class="col-6">
				<div class="row mt-2">
					<label for="font-family-footer" class="col-6 col-form-label font-weight-medium">Gaya Huruf </label>
					<div class="col-6">
						<select class="form-control border-primary form-simulator select-simulator" data-transform="#running-text" data-change="font-family" name="font-family-footer">
							<option value="<?= $footerComponent['font-family-footer']?>" selected><?= $footerComponent['font-family-footer']?></option>
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
					<label for="color-footer" class="col-6 col-form-label font-weight-medium">Warna Text</label>
					<div class="col-6">
						<input type='text' class="color-picker form-control" value="<?= $footerComponent['color-footer']?>" name="color-footer" data-transform="#running-text" data-change="color"/>
					</div>
				</div>
				<div class="row mt-2">
					<label for="background-footer" class="col-6 col-form-label font-weight-medium">Warna Latar</label>
					<div class="col-6">
						<input type='text' class="color-picker form-control" value="<?= $footerComponent['background-footer']?>" name="background-footer" data-transform="#footer-card-simulator" data-change="background-color"/>
					</div>
				</div>
			</div>

			<div class="col-12 mt-5">
				<div class="d-flex justify-content-center">
					<button type="button" name="simpan" class="btn btn-primary col-12" id="footerSubmitBtn">SIMPAN</button>
				</div>
			</div>
		</form>

	</div>
</div>
