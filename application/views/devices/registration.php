<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title> Project Antrian </title>

	<!-- plugins:css -->
	<link rel="stylesheet" href="<?= base_url('assets/node_modules/mdi/css/materialdesignicons.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/node_modules/simple-line-icons/css/simple-line-icons.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/node_modules/flag-icon-css/css/flag-icon.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/animate.css') ?>">
	<!-- endinject -->

	<!-- plugin css for this page -->
	<link rel="stylesheet" href="<?= base_url('assets/node_modules/font-awesome/css/font-awesome.min.css') ?>"/>
	<link rel="stylesheet"
		  href="<?= base_url('assets/node_modules/jquery-bar-rating/dist/themes/fontawesome-stars.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/js/node_modules/bare-bones-slider/css/jquery.bbslider.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/js/node_modules/video.js/dist/video-js.css') ?>">
	<!-- End plugin css for this page -->

	<!-- inject:css -->
	<link rel="stylesheet" href="<?= base_url('assets/css/fonts.css?v=1.0.0&&load=' . time() . '') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/style.css?v=1.0.0&&load=' . time() . '') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/app.css?v=1.0.0&&load=' . time() . '') ?>">
	<!-- endinject -->

	<link rel="shortcut icon" href="<?= base_url('assets/images/icon-antrian.png') ?>"/>

</head>

<body style="background-color: #f6f8fa;height: 768px;max-height: 768px;overflow: hidden">
<div class="container" style="padding: 80px 280px">
	<div class="row">
		<div class="col-12">
			<form action="<?= base_url('devices/registration')?>" method="post" autocomplete="off">
				<div class="form-group row">
					<div class="col-12 mb-5 text-center">
						<h2 style="font-family: titilliumweb-regular">LOKET DAN LAYANAN</h2>
					</div>
					<div class="col-12">
						<select class="form-control" name="layanan" id="layanan" style="font-size: 24px;height: auto">
							<option disabled selected>PILIH LAYANAN</option>
							<?php
							foreach ($layanan as $k => $v):
								?>
								<option value="<?= $v['layanan_id']?>"><?=  ucwords($v['layanan_awalan']).' - '.$v['layanan_nama'] ?></option>
							<?php endforeach;?>
						</select>
					</div>
				</div>
				<div class="form-group row mt-5">
					<div class="col-12">
						<select class="form-control" name="loket" id="loket-select" style="font-size: 24px;height: auto">
							<option disabled selected>PILIH LOKET</option>
						</select>
					</div>
				</div>
				<div class="form-group row mt-5">
					<div class="col-12">
						<select class="form-control" name="alternatif" id="alternatif-loket-select" style="font-size: 24px;height: auto">
							<option disabled selected>PILIH LOKET ALTERNATIF</option>
						</select>
					</div>
				</div>

				<div class="form-group row mt-5">
					<div class="col-12">
						<button type="submit" class="btn btn-lg btn-primary col-12" name="masuk">
							MASUK
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>


<!-- plugins:js -->
<script src="<?= base_url('assets/node_modules/jquery/dist/jquery.min.js') ?>"></script>
<!--connection class-->
<script src="<?= base_url('assets/js/audio/Connection.js?v=1.0.0&&load=' . time()) ?>"></script>
<!-- connection class -->
<script src="<?= base_url('assets/node_modules/moment/moment.js') ?>"></script>
<!--		<script src="--><? //= base_url('assets/node_modules/moment/moment-with-locales.js')?><!--"></script>-->
<script src="<?= base_url('assets/node_modules/popper.js/dist/umd/popper.min.js') ?>"></script>
<script src="<?= base_url('assets/node_modules/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js') ?>"></script>
<!-- endinject -->

<!-- Plugin js for this page-->
<script src="<?= base_url('assets/') ?>node_modules/jquery-bar-rating/dist/jquery.barrating.min.js"></script>
<script src="<?= base_url('assets/') ?>node_modules/chart.js/dist/Chart.min.js"></script>
<script src="<?= base_url('assets/') ?>node_modules/raphael/raphael.min.js"></script>
<script src="<?= base_url('assets/') ?>node_modules/morris.js/morris.min.js"></script>
<script src="<?= base_url('assets/') ?>node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
<!-- End plugin js for this page-->

<!-- inject:js -->
<script src="<?= base_url('assets/') ?>js/off-canvas.js"></script>
<script src="<?= base_url('assets/') ?>js/hoverable-collapse.js"></script>
<script src="<?= base_url('assets/') ?>js/misc.js"></script>
<script src="<?= base_url('assets/') ?>js/settings.js"></script>
<script src="<?= base_url('assets/') ?>js/todolist.js"></script>
<!-- endinject -->

<!-- Custom js for this page-->
<script src="<?= base_url('assets/js/plugins/countdown.js') ?>"></script>
<script src="<?= base_url('assets/js/plugins/moment.js') ?>"></script>
<script src="<?= base_url('assets/')?>js/dashboard.js?v=1.0.0&&load="<?= time() ?>></script>
<script src="<?= base_url('assets/js/package/timer.js?v=1.0.0&&load=' . time() . '') ?>"></script>
<!-- End custom js for this page-->


<!-- JS inject for playing audio  -->
<script src="<?= base_url('assets/js/audio/Services.js?v=1.0.0&&load=' . time()) ?>"></script>
<script src="<?= base_url('assets/js/audio/AudioHelper.js?v=1.0.0&&load=' . time()) ?>"></script>
<script src="<?= base_url('assets/js/audio/MainAntrian.js?v=1.0.0&&load=' . time()) ?>"></script>
<!-- end inject -->

<!-- JS for device page -->
<script src="<?= base_url('assets/js/device/ChainSelect.js?v=1.0.0&load='.time())?>" type="text/javascript"></script>
<!-- end JS for device page -->

</body>

</html>
