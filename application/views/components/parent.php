
<div class="card setting-card" id="dataVue">
	<div class="card-body" style="overflow: hidden">
		<h4 class="card-title pb-3 border-bottom mb-3"><?= $settingsTitle;?></h4>

		<form action="<?= base_url('ComponentService/unggahLatar')?>" class="form-row" method="post" id="parentImageData" enctype="multipart/form-data">
			<div class="form-group col-12">
				<?php
					if ($container['background-image'] === 'true'):
				?>
						<div class="form-radio">
							<label class="form-check-label">
								<input type="radio" class="form-check-input" name="background-image" id="left-to-right" value="true" checked>
								latar gambar
								<i class="input-helper"></i>
							</label>
						</div>
						<div class="form-radio">
							<label class="form-check-label">
								<input type="radio" class="form-check-input" name="background-image" id="right-to-left" value="false">
								latar warna
								<i class="input-helper"></i></label>
						</div>
				<?php else:?>
						<div class="form-radio">
							<label class="form-check-label">
								<input type="radio" class="form-check-input" name="background-image" id="left-to-right" value="true" >
								latar gambar
								<i class="input-helper"></i>
							</label>
						</div>
						<div class="form-radio">
							<label class="form-check-label">
								<input type="radio" class="form-check-input" name="background-image" id="right-to-left" value="false" checked>
								latar warna
								<i class="input-helper"></i></label>
						</div>
				<?php endif;?>
			</div>
			<div class="form-group col-12">
				<h4 class="border-bottom" style="font-family: titilliumweb-bold">
					Gambar Latar
				</h4>
				<input type="file" class="dropify" data-height="480"
					   name="background-image-src" data-default-file="<?= base_url().$container['background-image-src']?>"
					   data-allowed-file-extensions="jpg png jpeg"
					   data-min-width="920"
					   data-min-height="540" >
			</div>

			<div class="form-group col-12 ">
				<label for="background-header" class="col-4 col-form-label font-weight-medium">Warna Latar</label>
				<div class="col-8">
					<input type='text' class="color-picker" value="<?= $container['background-color']?>" name="background-color" data-transform="#parent-simulator" data-change="background-color" required/>
				</div>
			</div>

			<button type="submit" class="btn btn-primary col-12" name="unggah">
				unggah
			</button>
		</form>

	</div>
</div>
