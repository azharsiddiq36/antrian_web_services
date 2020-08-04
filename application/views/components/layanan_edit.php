<div class="card setting-card" id="dataVue">
	<div class="card-body" style="overflow: hidden">
		<h4 class="card-title pb-3 border-bottom mb-3"><?= $settingsTitle; ?></h4>
		<div class="setting-tab">
			<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
					   aria-controls="pills-home" aria-selected="true">Edit Layanan</a>
				</li>
			</ul>

			<div class="tab-content" id="pills-tabContent">
				<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
					<form class=" pt-4"
						  action="<?= base_url("ComponentService/editLayanan/" . $currentData['layanan_id']) ?>"
						  method="post">
						<div class="form-group row">
							<label for="service_name" class="col-3 col-form-label font-weight-medium">Nama Layanan</label>
							<div class="col-9">
								<select name="service_name" class="form-control border-primary">
									<?php
										foreach ($suara as $k => $v) {
											if (strlen($v['suara_nama']) > 1):
									?>
												<?php if ($v['suara_nama'] === $currentData['layanan_nama']):?>
													<option value="<?= $v['suara_nama'] ?>" selected><?= $v['suara_nama'] ?></option>
												<?php else:?>
													<option value="<?= $v['suara_nama'] ?>"><?= $v['suara_nama'] ?></option>
												<?php endif;?>
									<?php
											endif;
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="service_prefix" class="col-3 col-form-label font-weight-medium">Awalan Layanan</label>
							<div class="col-9">
								<select name="service_prefix" class="form-control border-primary">
									<?php
										foreach ($suara as $k => $v) {
											if (strlen($v['suara_nama']) <= 1):
									?>
												<?php if ($v['suara_nama'] === $currentData['layanan_awalan']):?>
													<option value="<?= $v['suara_nama'] ?>" selected><?= $v['suara_nama'] ?></option>
												<?php else:?>
													<option value="<?= $v['suara_nama'] ?>"><?= $v['suara_nama'] ?></option>
												<?php endif;?>
									<?php
											endif;
										}
									?>
								</select>
							</div>
						</div>

						<div class="form-group row d-flex justify-content-end pt-4">
							<div class="col-9">
								<div class="row">
									<div class="col-6">
										<a href="<?= base_url('settings/loket')?>"   class="btn btn-secondary col-12" >BATALKAN</a>
									</div>
									<div class="col-6">
										<button type="submit" name="submit" class="btn btn-primary col-12">SIMPAN</button>
									</div>
								</div>
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>

