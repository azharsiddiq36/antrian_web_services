<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title> Epire Lisensi </title>
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

	<body>
		<div class="container pt-5">
			<div class="d-flex justify-content-center ">
				<h2>
					<?= $message?>
				</h2>
			</div>
			<div class="d-flex justify-content-center">
				<h4>Silahkan hubungi admin </h4><br>
			</div>
			<div class="d-flex justify-content-center">
				<h2>Atau melakukan <a href="<?= base_url('layanan/registrasi')?>">Login</a></h2>
			</div>
		</div>
	</body>

</html>
