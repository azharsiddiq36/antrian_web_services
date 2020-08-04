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
	<!-- endinject -->

	<!-- plugin css for this page -->
	<link rel="stylesheet" href="<?= base_url('assets/node_modules/font-awesome/css/font-awesome.min.css') ?>"/>
	<link rel="stylesheet" href="<?= base_url('assets/node_modules/jquery-bar-rating/dist/themes/fontawesome-stars.css') ?>">

	<link rel="stylesheet" href="<?= base_url()?>/assets/node_modules/jquery-tags-input/dist/jquery.tagsinput.min.css">
	<link rel="stylesheet" href="<?= base_url()?>/assets/node_modules/jquery-bar-rating/dist/themes/fontawesome-stars.css">
	<link rel="stylesheet" href="<?= base_url()?>/assets/node_modules/jquery-bar-rating/dist/themes/bars-1to10.css">
	<link rel="stylesheet" href="<?= base_url()?>/assets/node_modules/jquery-bar-rating/dist/themes/bars-horizontal.css">
	<link rel="stylesheet" href="<?= base_url()?>/assets/node_modules/jquery-bar-rating/dist/themes/bars-movie.css">
	<link rel="stylesheet" href="<?= base_url()?>/assets/node_modules/jquery-bar-rating/dist/themes/bars-pill.css">
	<link rel="stylesheet" href="<?= base_url()?>/assets/node_modules/jquery-bar-rating/dist/themes/bars-reversed.css">
	<link rel="stylesheet" href="<?= base_url()?>/assets/node_modules/jquery-bar-rating/dist/themes/bars-square.css">
	<link rel="stylesheet" href="<?= base_url()?>/assets/node_modules/jquery-bar-rating/dist/themes/bootstrap-stars.css">
	<link rel="stylesheet" href="<?= base_url()?>/assets/node_modules/jquery-bar-rating/dist/themes/css-stars.css">
	<link rel="stylesheet" href="<?= base_url()?>/assets/node_modules/jquery-bar-rating/dist/themes/fontawesome-stars-o.css">
	<link rel="stylesheet" href="<?= base_url()?>/assets/node_modules/jquery-bar-rating/examples/css/examples.css">
	<link rel="stylesheet" href="<?= base_url()?>/assets/node_modules/font-awesome/css/font-awesome.min.css" />
	<link rel="stylesheet" href="<?= base_url()?>/assets/node_modules/dropify/dist/css/dropify.min.css">
	<link rel="stylesheet" href="<?= base_url()?>/assets/node_modules/jquery-file-upload/css/uploadfile.css">
	<link rel="stylesheet" href="<?= base_url()?>/assets/node_modules/clockpicker/dist/jquery-clockpicker.min.css" />
	<link rel="stylesheet" href="<?= base_url()?>/assets/node_modules/jquery-asColorPicker/dist/css/asColorPicker.min.css" />
	<link rel="stylesheet" href="<?= base_url()?>/assets/node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" />
	<link rel="stylesheet" href="<?= base_url()?>/assets/node_modules/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css">

	<!-- End plugin css for this page -->

	<!-- inject:css -->
	<link rel="stylesheet" href="<?= base_url('assets/css/fonts.css?v=1.0.0&&load='.time().'') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/style.css?v=1.0.0&&load='.time().'') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/app.css?v=1.0.0&&load='.time().'') ?>">
	<!-- endinject -->

	<link rel="shortcut icon" href="<?= base_url('assets/images/icon-antrian.png') ?>"/>


</head>

<body>
<!-- start container-->
<div class="container-scroller" style="padding-top: 40px">
	<div class="container-fluid"  id="main-container">

		<div class="row">
			<div class="col-12">
				<div class="alert  setting-alert" role="alert" id="settings-alert" style="display: none">

				</div>
			</div>

			<?php if ($this->session->flashdata('alert') === 'edit'):?>
				<div class="col-12">
					<div class="alert setting-alert alert-success" role="alert" id="settings-alert">
						berhasil menyimpan data
					</div>
				</div>
			<?php endif;?>

			<?php if ($this->session->flashdata('alert') === 'error'):?>
				<div class="col-12">
					<div class="alert setting-alert alert-danger" role="alert" id="settings-alert">
						Ada kesalahan saat operasi
					</div>
				</div>
			<?php endif;?>

			<div class="col-3">

				<div class="side-nav">

					<div class="nav-header">
						<div class="row">
							<div class="col-3">
								<h1>
									<i class="icon-settings"></i>
								</h1>
							</div>
							<div class="col-9">
								<h2 class="font-weight-medium">
									Pengaturan
								</h2>
							</div>
						</div>
					</div>

					<div class="nav-body">
						<ul>
							<?php
								$active = 'active-menu';
								$warna = '';
								$teks  = '';
								$suara  = '';
								$umum = '';
								$media = '';
								$cetakan = '';
								$loket = '';
								$header = '';
								$footer = '';
								$parent = '';
								$tombol = '';
								$users = '';
								$shortcut = '';

								switch ($activeMenu){
									case 'umum':
										$umum = $active; break;
									case 'warna':
										$warna = $active; break;
									case 'teks':
										$teks = $active; break;
									case 'suara':
										$suara = $active; break;
									case 'media':
										$media = $active; break;
									case 'cetakan':
										$cetakan = $active; break;
									case 'loket':
										$loket = $active;break;
									case 'header':
										$header = $active;break;
									case 'footer':
										$footer = $active;break;
									case 'parent':
										$parent = $active;break;
									case 'tombol':
										$tombol = $active;break;
									case 'users':
										$users = $active;break;
									case 'shortcut':
										$shortcut = $active;break;
								}

							?>
							<?php if ($this->session->userdata('level') === 'superAdmin'):?>
							<li>
								<a href="<?= base_url('settings/users')?>" class="<?php echo $users;?>">
									<i class="icon-user "></i>
									Pengguna
								</a>
							</li>
							<?php endif;?>
							<li>
								<a href="<?= base_url('settings/parent')?>" class="<?php echo $parent;?>">
									<i class="icon-screen-desktop "></i>
									Background
								</a>
							</li>
							<li>
								<a href="<?= base_url('settings/header')?>" class="<?php echo $header;?>">
									<i class="icon-credit-card "></i>
									Header
								</a>
							</li>
							<li>
								<a href="<?= base_url('settings/footer')?>" class="<?php echo $footer;?>">
									<i class="icon-frame "></i>
									Footer
								</a>
							</li>
							<li>
								<a href="<?= base_url('settings/loket')?>" class="<?php echo $loket;?>">
									<i class="icon-layers "></i>
									Loket
								</a>
							</li>
							<?php if ($this->session->userdata('tipe_aplikasi') === 'TIPE-1' || $this->session->userdata('tipe_aplikasi') === 'TIPE-2'):?>

							<li>
								<a href="<?= base_url('settings/tombol')?>" class="<?php echo $tombol;?>">
									<i class="icon-grid"></i>
									Keyboard
								</a>
							</li>
							<?php endif;?>
							<?php if ($this->session->userdata('tipe_aplikasi') === 'TIPE-1' || $this->session->userdata('tipe_aplikasi') === 'TIPE-3'):?>
							<li>
								<a href="<?= base_url('settings/shortcut')?>" class="<?php echo $shortcut;?>">
									<i class="icon-share-alt"></i>
									Shortcut
								</a>
							</li>
							<?php endif?>
							<li>
								<a href="<?= base_url('settings/media') ?>" class="<?= $media; ?>">
									<i class="icon-picture"></i>
									Media
								</a>
							</li>
<!--							<li>-->
<!--								<a href="--><?//= base_url('settings/print') ?><!--" class="--><?//= $cetakan; ?><!--">-->
<!--									<i class="icon-printer"></i>-->
<!--									Cetakan-->
<!--								</a>-->
<!--							</li>-->
							<li>
								<a href="<?= base_url('layanan/logout') ?>" >
									<i class="icon-power"></i>
									Keluar
								</a>
							</li>

						</ul>
					</div>

				</div>

			</div>

			<div class="col-9">

