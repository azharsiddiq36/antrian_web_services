
<div class="card setting-card" id="dataVue">
	<div class="card-body" style="overflow: hidden">
		<h4 class="card-title pb-3 mb-3"><?= $settingsTitle;?></h4>
		<button href="#" type="button" data-toggle="modal" data-target="#exampleModal" name="tambah"
				class="btn btn-primary  mb-1" id="serviceSubmitBtn"><i class="icon-plus"></i>TAMBAH SHORTCUT
		</button>
		<div class="table-responsive-sm border-top mt-3">
			<table class="table">
				<thead class="thead-dark">
				<tr>
					<th>No</th>
					<th>Fungsi</th>
					<th>Numpad</th>
					<th>Layanan</th>
					<th style="width: 100px" class="text-center"><i class="icon-settings"></i></th>
				</tr>
				</thead>
				<tbody>
				<?php
				$number = 1;
				foreach ($locketShortcuts as $key => $value):
					?>
					<tr>
						<td><?= $number?></td>
						<td>Cetak Karcis</td>
						<td><code><?= $value['numpad']?></code></td>
						<td><?= $value['loket']?></td>
						<td class="text-center">
							<a href="<?= base_url('ComponentService/deleteShortcut/'.$value['id'])?>" class="btn btn-danger p-2" onclick="return confirm('Hapus Item ?')"><i class="icon-trash"></i></a>
						</td>
					</tr>
				<?php endforeach;$number++;?>
				</tbody>
			</table>
		</div>

	</div>

	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		 aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Tambah Shortcut Loket</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div class="modal-body pt-0 pb-2">
					<form action="<?= base_url('ComponentService/addShortcut')?>" class="row pt-4 border-top" method="post">
						<!-- text setting -->
						<div class="col-12">
							<div class="row mt-2">
								<label for="font-family-footer" class="col-4 col-form-label font-weight-medium">Cetak Karcis </label>
								<div class="col-4">
									<select class="form-control" name="url" required>
										<option selected="" disabled="" value="">PILIH LAYANAN</option>
										<?php foreach ($servicesList as $key => $val):?>
											<option value="Services/takeQueue/<?= $val['layanan_id']?>"><?= $val['layanan_nama']?></option>
										<?php endforeach;?>
									</select>
								</div>
								<div class="col-4">
									<input type="text" hidden name="type" value="locket">
									<input type="number" name="numpad" maxlength="1" class="form-control bt-max-length" placeholder="NUMPAD" style="font-size: 18px!important;text-transform: uppercase" value="" required max="9">
								</div>
							</div>
						</div>

						<div class="col-12 mt-5">
							<div class="d-flex justify-content-center">
								<button type="submit" name="simpan" class="btn btn-primary col-12" id="footerSubmitBtn">SIMPAN</button>
							</div>
						</div>
					</form>

				</div>

			</div>
		</div>
	</div>

	<div class="modal fade" id="addServices" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		 aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Tambah Shortcut Umum</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div class="modal-body pt-0 pb-2">
					<form action="#" class="row pt-4 border-top" method="post" id="footerComponentData">
						<!-- text setting -->
						<div class="col-12">
							<div class="row mt-2">
								<label for="font-family-footer" class="col-4 col-form-label font-weight-medium">Cetak Karcis </label>
								<div class="col-4">
									<select class="form-control" name="loket-select" required >
										<option selected="" disabled="">PILIH LOKET</option>
										<?php foreach ($dataLoket as $key => $val):?>
											<option value="<?= $val['loket_id']?>"><?= $val['loket_nama']?></option>
										<?php endforeach;?>
									</select>
									<span class="badge badge-danger" id="locket-alert" style="display: none">loket telah memiliki data keyboard</span>
								</div>
								<div class="col-4">
									<input type="number" name="" maxlength="1" class="form-control bt-max-length" placeholder="NUMPAD" style="font-size: 18px!important;text-transform: uppercase" value="">
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
		</div>
	</div>

</div>
