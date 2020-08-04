
<div class="card setting-card" >
	<div class="card-body" style="overflow: hidden">
		<h4 class="card-title pb-3 mb-3"><?= $settingsTitle;?></h4>

		<?php if ($macUser !== null):?>
			<form action="<?= base_url('ComponentService/editUser')?>" class=" pt-4 border-top row" method="post" >
		<?php else:?>
			<form action="<?= base_url('ComponentService/addUser')?>" class=" pt-4 border-top row" method="post" >
		<?php endif;?>
			<div class="col-12">
				<h4 style="font-family: titilliumweb-regular">Data Login</h4>
			</div>
			<div class="form-group col-12">
				<div class="row">
					<label for="username" class="col-4 col-form-label">username</label>
					<input type="text" class="form-control form-control-lg col-8" id="username"  name="username" placeholder="username"
						<?php if ($licensedUser !== null):?>
							value="<?= $licensedUser['username']; ?>"
					    <?php endif;?>
				    required >

				</div>
			</div>

			<div class="form-group col-12">
				<div class="row">
					<label for="password" class="col-4 col-form-label">Password</label>
					<input type="password" class="form-control form-control-lg col-8" id="password" name="password" placeholder="password" required>
				</div>
			</div>

			<div class="col-12">
				<h4 style="font-family: titilliumweb-regular">Data Pengguna</h4>
			</div>
			<div class="form-group col-12">
				<div class="row">
					<label for="app_username" class="col-4 col-form-label">Nama Pengguna</label>
					<input type="text" class="form-control form-control-lg col-8" id="app_username" name="app_username" required
						   placeholder="instansi/perorangan"
							<?php if ($macUser!==null):?>
								value="<?= $macUser['nama_pengguna']?>"
							<?php endif;?>
					>
				</div>
			</div>

			<div class="form-group col-12">
				<div class="row">
					<label for="mac" class="col-4 col-form-label">MAC Address</label>
					<input type="text" class="form-control form-control-lg col-8" id="mac" name="mac" readonly value="<?= $mac?>">
				</div>
			</div>

			<div class="form-group col-12">
				<div class="row">
					<label for="type" class="col-4 col-form-label">Tipe Software</label>
					<select name="type" id="type" class="form-control form-control-lg col-8">
						<option value="<?= $licenseData['tipe_aplikasi']?>" selected disabled><?= $licenseData['tipe_aplikasi']?></option>
						<option value="TIPE-1"> TIPE 1</option>
						<option value="TIPE-2"> TIPE 2</option>
						<option value="TIPE-3"> TIPE 3</option>
						<option value="TIPE-4"> TIPE 4</option>
						<option value="TIPE-5"> TIPE 5</option>
					</select>
				</div>
			</div>

			<div class="form-group col-12">
				<div class="row">
					<label for="activate_at" class="col-4 col-form-label">Tanggal Aktivasi</label>
					<input type="date" class="form-control form-control-lg col-8"
						   id="activate_at" name="activate_at"
						   <?php if ($macUser!== null):?>
							   value="<?php $activateAt = new DateTime($macUser['tanggal_aktivasi']);echo $activateAt->format('Y-m-d');?>"
						   <?php endif;?>
					>
				</div>
			</div>

			<div class="form-group col-12">
				<div class="row">
					<label for="activation_duration" class="col-4 col-form-label">Durasi Aktivasi</label>
					<input type="number" class="form-control form-control-lg col-8" id="activation_duration" name="activation_duration" placeholder="jangka waktu aktif dalam bulan" readonly
						   <?php if ($macUser!==null):?>
						   	value="<?= $macUser['durasi_aktivasi']?>"
					       <?php endif;?>
					>
				</div>
			</div>

			<div class="form-group col-12">
				<div class="row">
					<label for="expire_at" class="col-4 col-form-label">Tanggal Jatuh Tempo</label>
					<input type="date" class="form-control form-control-lg col-8" id="expire_at" name="expire_at" readonly
						<?php if ($macUser!== null):?>
							value="<?php $activateAt = new DateTime($macUser['tanggal_tempo']);echo $activateAt->format('Y-m-d');?>"
						<?php endif;?>
					>
				</div>
			</div>

			<!-- text setting -->

			<div class="col-12 mt-5">
				<div class="d-flex justify-content-center">
					<button type="submit" name="submit" class="btn btn-primary col-12" >
						<?php if ($macUser !== null):?>
							PERBAHARUI
						<?php else:?>
							SIMPAN
						<?php endif;?>
					</button>
				</div>
			</div>
		</form>

	</div>
</div>
