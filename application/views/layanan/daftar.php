<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title> Project Antrian </title>

	<!-- plugins:css -->
	<link rel="stylesheet" href="<?= base_url('assets/node_modules/mdi/css/materialdesignicons.min.css')?>">
	<link rel="stylesheet" href="<?= base_url('assets/node_modules/simple-line-icons/css/simple-line-icons.css')?>">
	<link rel="stylesheet" href="<?= base_url('assets/node_modules/flag-icon-css/css/flag-icon.min.css')?>">
	<link rel="stylesheet" href="<?= base_url('assets/node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css')?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/animate.css')?>">
	<!-- endinject -->

	<!-- plugin css for this page -->
	<link rel="stylesheet" href="<?= base_url('assets/node_modules/font-awesome/css/font-awesome.min.css')?>"/>
	<link rel="stylesheet" href="<?= base_url('assets/node_modules/jquery-bar-rating/dist/themes/fontawesome-stars.css')?>">
	<link rel="stylesheet" href="<?= base_url('assets/js/node_modules/bare-bones-slider/css/jquery.bbslider.css')?>">
	<link rel="stylesheet" href="<?= base_url('assets/node_modules/sweetalert2/dist/sweetalert2.min.css')?>">
	<link rel="stylesheet" href="<?= base_url('assets/js/node_modules/video.js/dist/video-js.css')?>">
	<!-- End plugin css for this page -->

	<!-- inject:css -->
	<link rel="stylesheet" href="<?= base_url('assets/css/fonts.css?v=1.0.0&&load='.time().'') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/style.css?v=1.0.0&&load='.time().'')?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/app.css?v=1.0.0&&load='.time().'')?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/layanan.css?v=1.0.0&&load='.time().'')?>">
	<!-- endinject -->

	<link rel="shortcut icon" href="<?= base_url('assets/images/icon-antrian.png') ?>"/>

</head>

<body style='background-image: url("<?= base_url()?>assets/images/background/layanan.png");
	background-size: cover;background-repeat: no-repeat;background-position: initial;'>

	<div id="layananan-container" >

		<div id="layanan-header">
			<div class="row">
				<div class="col-12 d-flex justify-content-end" style="padding-right: 30px">
					<div class="col-4 animated bounceInDown">
						<div id="date-time-indicator" >
							<div id="date-time-wrapper" style="background-color: white" class="card">
								<div class="time-indicator d-flex justify-content-center">
									<h1 style="color:blue;line-height: 60px;font-family: titilliumweb-bold;font-size: 45px" class="m-0" id="time-content">
									</h1>
								</div>
								<div class="date-indicator d-flex justify-content-center">
									<h4 style="color:blue;font-family: titilliumweb-bold, sans-serif;line-height: 44px" class="m-0" id="date-content">

									</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="layanan-body " style="padding-left: 40px;
		padding-right: 40px;padding-top: 14px;height: 460px;max-height: 460px;overflow: auto;
		margin-top: 26px;">

			<div class="row">
				<div class="col-12 d-flex justify-content-end">
					<span class="text-primary" style="font-family: titilliumweb-bold">geser kebawah untuk melihat layanan lainnya <i class="icon-arrow-down"></i></span>
				</div>

				<?php
					foreach ($dataLayanan as $k => $v):
						$sisaAntrian;
						$activeQueue = $antrian->get_join_where(array(
							'antrian_layanan_id' => $v['layanan_id'],
							'antrian_status' => 'aktif'
						));

						$leftQueue = $antrian->get_join_where(array(
							'antrian_layanan_id' => $v['layanan_id'],
							'antrian_status' => 'menunggu'
						));

						if ($leftQueue->num_rows() > 0){
							$sisaAntrian = $activeQueue->num_rows()+$leftQueue->num_rows();
						}else{
							$sisaAntrian = $activeQueue->num_rows();
						}
				?>
					<div class="col-6 grid-margin animated bounceIn ">
						<div class="col-12">
							<h2 class="text-primary" style="font-family: titilliumweb-bold"><?= ucwords($v['layanan_awalan'])?> - <?= $v['layanan_nama']?></h2>
						</div>
							<a href="#" class="take-queue" data-url="takeQueue/<?= $v['layanan_id']?>">
								<div class="card bg-behance card-shadow" style='background-image: url("<?= base_url()?>assets/images/background/batik.png");
									background-size: cover;background-repeat: no-repeat;background-position: initial;'>
									<div class="card-body pt-3 pb-0 px-3" style="height: 74px;min-height: 74px">
										<div class="row">
											<h1 class="col-2"><i class="fa fa-ticket text-white icon-md"></i></h1>
											<div class="col-10">
												<h2 class="text-facebook text-white" style="font-family: titilliumweb-bold"><?= substr($v['layanan_nama'],0,40)?> .</h2>
											</div>
										</div>
									</div>
									<div class="card-footer p-2">
										<div class="d-flex justify-content-between">
											<span class="badge badge-light text-dark"><?= $sisaAntrian?> sisa antrian</span>
										</div>
									</div>
								</div>
							</a>
						</div>

					<?php
					endforeach;
				?>

			</div>
		</div>

		<div id="layanan-footer">
			<div class="row">
				<div class="col-12 d-flex justify-content-end">
					<div class="col-2 grid-margin">
						<a href="<?= base_url('layanan')?>">
							<div class="card bg-warning card-shadow">
								<div class="card-body p-2">
									<div class="d-flex flex-row align-items-top" style="padding-top: 6px">
										<i class="icon-arrow-left text-white "></i>
										<div class="ml-3">
											<h4 class="text-facebook text-white">KEMBALI</h4>
										</div>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>

		<!-- component hasil cetak -->
		<div class="col-12" style="padding: 4px 120px; box-sizing: border-box">
			<div class="card card-shadow" id="ticket-preview" style="font-family: inherit;color: black">
				<div class="card-header bg-white p-0" style="border-bottom: 2px black solid;">
					<div class="row">
						<div class="col-12">
							<img src="<?= base_url('assets/images/logo-dintanak.png')?>" alt="" width="100%" height="auto">
						</div>
					</div>
				</div>
				<div class="card-body p-2" >
					<div class="row">
						<div class="col-12 d-flex justify-content-between">
							<p style="font-family: inherit;color: inherit" id="list-date-content"></p>
							<p style="font-family: inherit;color: inherit" id="list-time-content"></p>
						</div>

						<div class="col-12 d-flex justify-content-center">
							<h2 style="font-family: inherit;text-transform: uppercase;color: inherit" id="service-name-print">nama layanan</h2>
						</div>

						<div class="col-12 d-flex justify-content-center">
							<h4 style="font-family: inherit;color: inherit">Nomor Antrian Anda : </h4>
						</div>

						<div class="col-12 d-flex justify-content-center my-2">
							<h1 style="font-family: titilliumweb-bold;text-transform: uppercase;font-size: 56px;color: inherit" id="ticket-number-print">A-009</h1>
						</div>

						<div class="col-12 d-flex justify-content-center">
							<h4 style="font-family: inherit;color: inherit">sisa antrian : <span id="left-queue-print"></span></h4>
						</div>
					</div>
				</div>
				<div class="card-footer bg-white border-0 p-0">
					<div class="row">
						<div class="col-12 d-flex justify-content-center">
							<h3 style="font-family: inherit;color: inherit" id="text-footer" class="text-center">Silahkan Menunggu Nomor Anda Dipanggil</h3>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- component hasil cetak -->

		<form action="<?= base_url('Services/receiptPrint')?>" id="printSubmit" method="post">
			<input type="text" name="queue_number" hidden>
			<input type="text" name="service_name" hidden>
			<input type="text" name="left_queue" hidden>
		</form>

	</div>

	<!-- plugins:js -->
	<script src="<?= base_url('assets/node_modules/jquery/dist/jquery.min.js')?>"></script>
	<!--connection class-->
	<script src="<?= base_url('assets/js/audio/Connection.js?v=1.0.0&&load='.time()) ?>"></script>
	<!-- connection class -->
	<script src="<?= base_url('assets/node_modules/moment/moment.js')?>"></script>
	<!--		<script src="--><?//= base_url('assets/node_modules/moment/moment-with-locales.js')?><!--"></script>-->
	<script src="<?= base_url('assets/node_modules/popper.js/dist/umd/popper.min.js') ?>"></script>
	<script src="<?= base_url('assets/node_modules/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
	<script src="<?= base_url('assets/node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js')?>"></script>
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
	<script src="<?= base_url('assets/') ?>js/dashboard.js?v=1.0.0&&load="<?= time()?>></script>
	<script src="<?= base_url('assets/js/package/timer.js?v=1.0.0&&load='.time().'') ?>"></script>
	<script src="<?= base_url('assets/js/package/listTimer.js?v=1.0.0&&load='.time().'') ?>"></script>
	<script src="<?= base_url('assets/node_modules/sweetalert2/dist/sweetalert2.min.js') ?>"></script>
	<script src="<?= base_url('assets/node_modules/jquery.avgrund/jquery.avgrund.min.js')?>"></script>
	<script src="<?= base_url('assets/js/alerts.js')?>"></script>
	<script src="<?= base_url('assets/js/avgrund.js')?>"></script>

	<!-- End custom js for this page-->

	<!-- JS inject for playing audio  -->
	<script src="<?= base_url('assets/js/audio/Services.js?v=1.0.0&&load='.time()) ?>"></script>
	<script src="<?= base_url('assets/js/audio/AudioHelper.js?v=1.0.0&&load='.time()) ?>"></script>
	<script src="<?= base_url('assets/js/audio/MainAntrian.js?v=1.0.0&&load='.time()) ?>"></script>
	<!-- end inject -->

	<!-- JS inject for media -->
	<script src="<?= base_url('assets/js/node_modules/bare-bones-slider/js/jquery.bbslider.js')?>"></script>
	<script src="<?= base_url('assets/js/node_modules/video.js/dist/video.min.js')?>"></script>
	<script src="<?= base_url('assets/js/node_modules/videojs-playlist/dist/videojs-playlist.min.js')?>"></script>
	<!-- JS inject for media -->

	<!-- JS for print-->
<!--	<script src="--><?//= base_url('assets/js/plugins/printThis/printThis.js')?><!--"></script>-->
<!--	<script src="--><?//= base_url('assets/js/print/recta.min.js')?><!--" type="text/javascript"></script>-->
	<script src="https://cdn.jsdelivr.net/npm/recta/dist/recta.js" type="text/javascript"></script>
	<!-- JS for print-->

	<!-- JS Inject for service / take queue-->
	<!-- if touchscreen active -->
	<?php
		if ($this->session->userdata('mac_pengguna') !== ''):
	?>
		<?php if ($this->session->userdata('tipe_aplikasi') === 'TIPE-1' || $this->session->userdata('tipe_aplikasi') === 'TIPE-3'):?>
			<script src="<?= base_url('assets/js/layanan/KeyboardListener.js?v=1.0.0&&load='.time())?>"></script>
		<?php else:?>
			<!-- else -->
			<script src="<?= base_url('assets/js/layanan/MainLayanan.js?v=1.0.0&&load='.time())?>"></script>
		<?php endif;?>
	<?php endif;?>
<!--	<script type="text/javascript" src="--><?//= base_url('assets/js/audio/MainKeyboard.js?v=1.0.0&&load='.time().'')?><!--"></script>-->
	<!-- JS Inject for service / take queue-->

</body>

</html>
