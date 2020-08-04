<!DOCTYPE html>
<html lang="en">

	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title><?= $title?></title>
		<!-- plugins:css -->
		<link rel="stylesheet" href="<?= site_url()?>assets/node_modules/mdi/css/materialdesignicons.min.css">
		<link rel="stylesheet" href="<?= site_url()?>assets/node_modules/simple-line-icons/css/simple-line-icons.css">
		<link rel="stylesheet" href="<?= site_url()?>assets/node_modules/flag-icon-css/css/flag-icon.min.css">
		<link rel="stylesheet" href="<?= site_url()?>assets/node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css">
		<!-- endinject -->
		<!-- plugin css for this page -->
		<!-- End plugin css for this page -->
		<!-- inject:css -->
		<link rel="stylesheet" href="<?= site_url()?>assets/css/style.css">
        <link rel="stylesheet" href="<?= site_url()?>assets/css/animate.css">
		<!-- endinject -->
		<link rel="shortcut icon" href="<?= site_url()?>assets/images/favicon.png" />
	</head>

	<body>
		<div class="container-scroller">
			<div class="container-fluid page-body-wrapper">
				<div class="row">
					<div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-full-bg">
						<div class="row w-100">
							<div class="col-lg-4 mx-auto">
								<div class="auth-form-dark text-left p-5">
									<h2 class="text-center">ANTRIAN</h2>
									<h4 class="text-center font-weight-light">Aplikasi Antrian Pekanbaru </h4>
									<?php if (($this->session->flashdata('alert') === 'invalid')): ?>
										<div class="card bg-danger text-center animated shake col-12 pt-3">
											<h4 class="font-weight-light">
												<i class="icon-info"></i>
												periksa kembali nama pengguna dan kata sandi
											</h4>
										</div>
									<?php endif;?>
									<form class="pt-5" action="<?= site_url('login')?>" method="post">
										<div class="form-group">
											<label for="username">Nama Pengguna</label>
											<input type="text" class="form-control" id="username" placeholder="Nama Pengguna" name="username">
											<i class="mdi mdi-account"></i>
										</div>
										<div class="form-group">
											<label for="password">Kata Sandi</label>
											<input type="password" class="form-control" id="password" placeholder="Kata Sandi" name="password">
											<i class="mdi mdi-eye"></i>
										</div>
										<div class="mt-5">
											<button type="submit" class="btn btn-sm btn-primary btn-block" name="login">
												MASUK
											</button>
										</div>
										<div class="mt-3 text-center">
											<a href="#" class="auth-link text-white">Lupa Password ?</a>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<!-- content-wrapper ends -->
				</div>
				<!-- row ends -->
			</div>
			<!-- page-body-wrapper ends -->
		</div>
		<!-- container-scroller -->
		
		
		<!-- plugins:js -->
		<script src="<?= site_url()?>assets/node_modules/jquery/dist/jquery.min.js"></script>
		<script src="<?= site_url()?>assets/node_modules/popper.js/dist/umd/popper.min.js"></script>
		<script src="<?= site_url()?>assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="<?= site_url()?>assets/node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js"></script>
		<!-- endinject -->
		<!-- inject:js -->
		<script src="<?= site_url()?>assets/js/off-canvas.js"></script>
		<script src="<?= site_url()?>assets/js/hoverable-collapse.js"></script>
		<script src="<?= site_url()?>assets/js/misc.js"></script>
		<script src="<?= site_url()?>assets/js/settings.js"></script>
		<script src="<?= site_url()?>assets/js/todolist.js"></script>
		<!-- endinject -->
	
	</body>

</html>
