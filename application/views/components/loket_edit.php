
<div class="card setting-card" id="dataVue">
	<div class="card-body" style="overflow: hidden">
		<h4 class="card-title pb-3 border-bottom mb-3"><?= $settingsTitle;?></h4>
			<div class="setting-tab">
				<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Edit Loket</a>
					</li>
				</ul>
				<div class="tab-content" id="pills-tabContent">
					<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">


				<form class = "row pt-4" action = "<?= base_url("ComponentService/editLoket/".$currentData['loket_id'])?>" method="post">
                <div class="form-group row">
					<label for="font-family-timer" class="col-sm-2 col-form-label font-weight-medium">Layanan</label>
					<div class="col-sm-10 mb-3">
						<select name="locket_services" class="form-control border-primary is-edit" data-service="<?= $currentData['loket_layanan_id'] ?>">
							<?php
							foreach($layanan->result() as $s):
								if($currentData['loket_layanan_id'] == $s->layanan_id):
									?>
									<option selected value="<?= $s->layanan_id?>"><?= $s->layanan_nama?></option>
								<?php else:?>
									<option value="<?= $s->layanan_id?>"><?= $s->layanan_nama?></option>
								<?php
								endif;
							endforeach;
							?>
						</select>
					</div>

					<label for="locket_name" class="col-sm-2 col-form-label font-weight-medium">Nama Loket</label>
					<div class="col-sm-10 mb-3">
						<input type="text" value="<?= $currentData['loket_nama']?>" class="form-control" id="locket_name" name="locket_name" placeholder="Nama Loket">
					</div>

					<label for="locket_alias" class="col-sm-2 col-form-label font-weight-medium">Nama Alias</label>
					<div class="col-sm-10 mb-3">
						<input type="text" value="<?= $currentData['loket_alias']?>" class="form-control" id="locket_alias" name="locket_alias" placeholder="Nama Alias">
					</div>

					<label for="locket_officer" class="col-sm-2 col-form-label font-weight-medium">Nama Alias</label>
					<div class="col-sm-10 mb-3">
						<input type="text" value="<?= $currentData['loket_petugas']?>" class="form-control" id="locket_officer" name="locket_officer" placeholder="Petugas">
					</div>

					<label for="locket_number" class="col-sm-2 col-form-label font-weight-medium">Nomor Loket</label>
					<div class="col-sm-10 mb-3">
						<input value="<?= $currentData['loket_nomor']?>" type="text" class="form-control" id="locket_number" placeholder="Nomor Loket" name="locket_number" readonly>
					</div>

				</div>
            </div>
			     <div class="modal-footer">
					<a href="<?= base_url('settings/loket')?>" class="btn btn-secondary" data-dismiss="modal">Close</a>
					<button type="submit" name="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>
				</div>

	</div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Formulir Tambah Loket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
			<form class = "row pt-4" action = "<?= base_url("ComponentService/addLocket")?>" method="post">
                <div class="form-group row">
					<label for="locket_name" class="col-sm-2 col-form-label font-weight-medium">Nama Loket</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="locket_name" name="locket_name" placeholder="Nama Loket">
					</div>
					<label for="locket_number" class="col-sm-2 col-form-label font-weight-medium">Nomor Loket</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="locket_number" placeholder="Nomor Loket" name="locket_number">
					</div>
					<label for="font-family-timer" class="col-sm-2 col-form-label font-weight-medium">Layanan</label>
					<div class="col-sm-10">
						<select name="locket_services" class="form-control border-primary form-simulator select-simulator" data-transform="#time-content" data-change="font-family" name="font-family-timer">
							<?php
								foreach($layanan->result() as $s){
							?>
								<option value="<?= $s->layanan_id?>"><?= $s->layanan_nama?></option>	
							<?php
								}
							?>
						</select>
					</div>
				</div>
            </div>
			     <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" name="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>

        </div>
    </div>
</div>
