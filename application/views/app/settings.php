				<div class="card setting-card" id="settings-card">
					<div class="card-body" id="dataVue">
						<h4 class="card-title pb-3 border-bottom"><?= $settingsTitle;?></h4>

						<!-- setting tab content -->
						<div class="setting-tab">
							<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Profil</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Layanan</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Tombol Pintasan</a>
								</li>
							</ul>

							<div class="tab-content" id="pills-tabContent">
								<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
									<form>

										<div class="form-group row">
											<label for="nama" class="col-2 col-form-label font-weight-medium">Nama</label>
											<div class="col-8">
												<input type="text" class="form-control" id="nama" placeholder="Nama Perusahaan/Instansi" v-model="warna" v-on:keyup="gantiWarna">
											</div>
											<div class="col-2">
												<input type="number" class="form-control" id="ukuran-font" placeholder="Font">
											</div>
										</div>

										<div class="form-group row">
											<label for="jargon" class="col-sm-2 col-form-label font-weight-medium">Jargon</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="jargon" placeholder="Jargon/Slogan Instansi">
											</div>
										</div>

										<div class="form-group row">
											<label for="runningText" class="col-2 col-form-label font-weight-medium">Running Text</label>
											<div class="col-10">
												<textarea name="running-text" id="runningText" cols="20" rows="10" class="form-control" placeholder="Atur Running Text"></textarea>
											</div>
										</div>


										<div class="form-group row mt-5">
											<div class="col-sm-12">
												<div class="d-flex justify-content-end">
													<button type="submit" class="btn btn-primary">Simpan</button>
												</div>
											</div>
										</div>
									</form>
								</div>
								<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">...</div>
								<div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
							</div>
						</div>
						<!-- end setting tab content -->


					</div>
				</div>
