<div class="card setting-card" id="dataVue">
	<div class="card-body" style="overflow: hidden">
		<h4 class="card-title pb-3 border-bottom mb-3"><?= $settingsTitle; ?></h4>
		<div class="setting-tab">
			<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-daftar-loket"
					   role="tab" aria-controls="pills-profile" aria-selected="false">Loket</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="pills-service-tab" data-toggle="pill" href="#pills-service-lists" role="tab"
					   aria-controls="pills-profile" aria-selected="false">Layanan</a>
				</li>
			</ul>

			<div class="tab-content" id="pills-tabContent">

				<div class="tab-pane fade show active" id="pills-daftar-loket" role="tabpanel"
					 aria-labelledby="pills-profile-tab">
					<button href="#" type="button" data-toggle="modal" data-target="#exampleModal" name="tambah"
							class="btn btn-primary  mb-1" id="serviceSubmitBtn"><i class="icon-plus"></i>Tambah Loket
					</button>
					<div class="table-responsive-sm">
						<table class="table">
							<thead class="thead-dark">
							<tr>
								<th>No</th>
								<th>Nama Loket</th>
								<th>Nama Alias</th>
								<th>Petugas</th>
								<th>Nomor Loket</th>
								<th>Layanan</th>
								<th style="width: 100px" class="text-center"><i class="icon-settings"></i></th>
							</tr>
							</thead>
							<tbody>
							<?php
							$no = 1;
							foreach ($loket->result() as $l) {
								?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $l->loket_nama ?></td>
									<td><?= $l->loket_alias ?></td>
									<td><?= $l->loket_petugas ?></td>
									<td><?= $l->loket_nomor ?></td>
									<td><?= $l->layanan_nama ?></td>
									<td>
										<div class="row">
											<div class="col-6">
												<a href="<?= base_url("ComponentService/editLoket/" . $l->loket_id) ?>"
												   class="btn btn-warning p-1"><i class="fa fa-pencil"></i></a>
											</div>
											<div class="col-6">
												<a onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
												   href="<?= base_url("ComponentService/deleteLocket/" . $l->loket_id) ?>"
												   class="btn btn-danger p-1"><i class="fa fa-trash"></i></a>
											</div>
										</div>
									</td>
								</tr>
								<?php
							}
							?>
							</tbody>
						</table>
					</div>
				</div>

				<div class="tab-pane fade " id="pills-service-lists" role="tabpanel"
					 aria-labelledby="pills-service-tab">
					<button href="#" type="button" data-toggle="modal" data-target="#addServices" name="tambah"
							class="btn btn-primary  mb-1" id="addServiceModal"><i class="icon-plus"></i>Tambah Layanan
					</button>
					<div class="table-responsive-sm">
						<table class="table">
							<thead class="thead-dark">
							<tr>
								<th>No</th>
								<th>Nama Layanan</th>
								<th>Awalan</th>
								<th style="width: 100px" class="text-center"><i class="icon-settings"></i></th>
							</tr>
							</thead>
							<tbody>
							<?php
							$no = 1;
							foreach ($layanan->result_array() as $k => $v) {
								?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $v['layanan_nama'] ?></td>
									<td><?= ucwords($v['layanan_awalan']) ?></td>
									<td>
										<div class="row">
											<div class="col-6">
												<a href="<?= base_url("ComponentService/editLayanan/" . $v['layanan_id']) ?>"
												   class="btn btn-warning p-1"><i class="fa fa-pencil"></i></a>
											</div>
											<div class="col-6">
												<a onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
												   href="<?= base_url("ComponentService/deleteLayanan/" . $v['layanan_id']) ?>"
												   class="btn btn-danger p-1"><i class="fa fa-trash"></i></a>
											</div>
										</div>
									</td>
								</tr>
								<?php
							}
							?>
							</tbody>
						</table>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	 aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Formulir Tambah Loket</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form class="pt-4" action="<?= base_url("ComponentService/addLocket") ?>" method="post">
				<div class="modal-body">
						<div class="form-group row">
							<label for="locket_services"
								   class="col-3 col-form-label font-weight-medium">Layanan</label>
							<div class="col-9">
								<select name="locket_services"
										class="form-control border-primary " id="locket_services" required>
									<option disabled selected>PILIH LAYANAN</option>
									<?php
										foreach ($layanan->result() as $s) {
											?>
											<option value="<?= $s->layanan_id ?>"><?= $s->layanan_nama ?></option>
											<?php
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="locket_name" class="col-3 col-form-label font-weight-medium">Nama Loket</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="locket_name" name="locket_name"
									   placeholder="nama loket" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="locket_alias" class="col-3 col-form-label font-weight-medium">Nama Alias</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="locket_name" name="locket_alias"
									   placeholder="nama alias" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="locket_officer" class="col-3 col-form-label font-weight-medium">Petugas</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="locket_officer" name="locket_officer"
									   placeholder="petugas" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="locket_number" class="col-3 col-form-label font-weight-medium">Nomor
								Loket
							</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="locket_number" placeholder="Nomor Loket"
									   name="locket_number" value="" readonly>
							</div>
						</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">BATALKAN</button>
					<button type="submit" name="submit" class="btn btn-primary">SIMPAN</button>
				</div>
			</form>


		</div>
	</div>
</div>

<div class="modal fade" id="addServices" tabindex="-1" role="dialog" aria-labelledby="addServiceModal"
	 aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Formulir Tambah Layanan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form class="pt-4" action="<?= base_url("ComponentService/addService") ?>" method="post">
				<div class="modal-body">
					<div class="form-group row">
						<label for="service_name" class="col-3 col-form-label font-weight-medium">Nama Layanan</label>
						<div class="col-9">
							<select name="service_name" class="form-control border-primary">
								<option disabled selected>PILIH NAMA YANG TERSEDIA</option>
								<?php
									foreach ($suara as $k => $v) {
										if (strlen($v['suara_nama']) > 1):
								?>
									<option value="<?= $v['suara_nama'] ?>"><?= $v['suara_nama'] ?></option>
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
								<option disabled selected>PILIH AWALAN</option>
								<?php
									foreach ($suara as $k => $v) {
										if (strlen($v['suara_nama']) <= 1):
											?>
											<option value="<?= $v['suara_nama'] ?>"><?= $v['suara_nama'] ?></option>
										<?php
										endif;
									}
								?>
							</select>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">BATALKAN</button>
					<button type="submit" name="submit" class="btn btn-primary">SIMPAN</button>
				</div>
			</form>


		</div>
	</div>
</div>

