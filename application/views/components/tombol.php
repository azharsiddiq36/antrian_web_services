
<div class="card setting-card" id="dataVue">
	<div class="card-body" style="overflow: hidden">
		<h4 class="card-title pb-3 mb-3"><?= $settingsTitle;?></h4>
		<button href="#" type="button" data-toggle="modal" data-target="#exampleModal" name="tambah"
				class="btn btn-primary  mb-1" id="serviceSubmitBtn"><i class="icon-plus"></i>Tambah Loket
		</button>

		<form action="<?= base_url('ComponentService/editTombol')?>" class=" pt-4 border-top row" method="post" id="keyboardData">
		<?php
			foreach ($keyevent as $key => $val):

		?>
			<div class="col-4">
				<h4 style="font-family: titilliumweb-bold" class="mb-4">Loket</h4>
				<div class="form-group  row">
					<div class="col-12">
						<input type="text"  class="form-control bt-max-length"  value="<?= $val['loket']?>" readonly>
					</div>
				</div>
			</div>

			<div class="col-4">
				<h4 style="font-family: titilliumweb-bold " class="mb-4">Keyboard</h4>

				<div class="form-group  row">
					<div class="col-12">
						<input type="text"    class="form-control bt-max-length"  value="<?= $val['keyboard']?>" readonly>
					</div>
				</div>
			</div>

			<div class="col-3">
				<div class="row">
					<div class="col-6">
						<h4 style="font-family: titilliumweb-bold " class="mb-4">Call</h4>

						<div class="form-group  row">
							<div class="col-12">
								<input type="text" name="settings"  maxlength="1" class="form-control bt-max-length"  placeholder="key"  value="<?= $val['call_numpad']?>" readonly>
							</div>
						</div>
					</div>
					<div class="col-6">
						<h4 style="font-family: titilliumweb-bold " class="mb-4">Recall</h4>

						<div class="form-group  row">
							<div class="col-12">
								<input type="text" name="settings"  maxlength="1" class="form-control bt-max-length"  placeholder="key" value="<?= $val['recall_numpad']?>" readonly>
							</div>
						</div>
					</div>
				</div>

			</div>

			<div class="col-1 " style="padding-top: 44px">
				<a href="<?= base_url('ComponentService/deleteKeyEvent?call='.$val['call_id'].'&recall='.$val['recall_id'])?>" class="btn btn-danger p-2" onclick="return confirm('Hapus Item ?')"><i class="icon-trash"></i></a>
			</div>
		<?php endforeach;?>
		</form>

		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
			 aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Tambah Keyboard Event</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body pt-0 pb-2">
						<form action="<?= base_url('ComponentService/addKeyEvent')?>" class=" pt-4 border-top row" method="post" id="keyboardData">

							<div class="col-4">
								<h4 style="font-family: titilliumweb-bold" class="mb-4">Loket</h4>
								<div class="form-group  row">
									<div class="col-12">
										<select class="form-control" name="loket" required >
											<option selected="" disabled="">PILIH LOKET</option>
											<?php foreach ($dataLoket as $key => $val):?>
											<option value="<?= $val['loket_id']?>"><?= $val['loket_nama']?></option>
											<?php endforeach;?>
										</select>
										<span class="badge badge-danger" id="locket-alert" style="display: none">loket telah memiliki data keyboard</span>
									</div>

								</div>
							</div>

							<div class="col-4">
								<h4 style="font-family: titilliumweb-bold " class="mb-4">Keyboard</h4>

								<div class="form-group  row">
									<div class="col-12">
										<select class="form-control" name="keyboard" required id="keyboard-select">
											<option selected="" disabled="">PILIH KEYBOARD</option>
											<?php
												foreach ($keyboard as $key => $val):
												$dateObject = new DateTime($val['create_at']);
											?>
											<option value="<?= $val['code']?>"><?= $val['manufacture'].' | '.$dateObject->format('m-d-Y')?></option>
											<?php endforeach;?>
										</select>
									</div>
								</div>
							</div>

							<div class="col-2">
								<h4 style="font-family: titilliumweb-bold " class="mb-4">Call</h4>

								<div class="form-group  row">
									<div class="col-12 numpad-container" id="call-numpad-container">
										<input type="number" name="call" maxlength="1" class="form-control bt-max-length" style="font-size: 18px!important;text-transform: uppercase" value="" required>
										<input type="number" name="call-code"  hidden>
										<span class="badge badge-danger" id="call-alert" style="display: none">nomor telah digunakan</span>
									</div>
								</div>
							</div>

							<div class="col-2">
								<h4 style="font-family: titilliumweb-bold " class="mb-4">Recall</h4>

								<div class="form-group  row">
									<div class="col-12 numpad-container" id="recall-numpad-container">
										<input type="text" name="recall" maxlength="1" class="form-control bt-max-length"  style="font-size: 18px!important;text-transform: uppercase" value="" required>
										<input type="text" name="recall-code" hidden>
										<span class="badge badge-danger" id="recall-alert" style="display: none">nomor telah digunakan</span>
									</div>
								</div>
							</div>

							<!-- text setting -->

							<div class="col-12 mt-5">
								<div class="d-flex justify-content-center">
									<button type="submit" name="simpan" class="btn btn-primary col-12" >SIMPAN</button>
								</div>
							</div>
						</form>

					</div>

				</div>
			</div>
		</div>


	</div>
</div>
