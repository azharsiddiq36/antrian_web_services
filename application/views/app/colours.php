				<div class="card setting-card" id="dataVue">
					<div class="card-body">
						<h4 class="card-title pb-3 border-bottom"><?= $settingsTitle;?></h4>
						<!-- setting tab content -->
						<div class="setting-tab" >
							<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Utama</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Layanan</a>
								</li>
							</ul>

							<div class="tab-content" id="pills-tabContent">

								<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
									<form>

										<div class="form-group row">
											<h4 class="font-weight-medium col-12 border-bottom" >Latar Aplikasi</h4>
											<label for="warna-latar-app" class="col-2 col-form-label font-weight-medium">Warna Latar</label>
											<div class="col-2">
												<input type='text' class="color-picker" value="#0ba1b5" name="warna-latar-app" data-transform="#preview-box-app" data-change="background-color"/>
											</div>
											<label for="warna-text-latar" class="col-2 col-form-label font-weight-medium">Warna Text</label>
											<div class="col-2">
												<input type='text' class="color-picker" value="#000000" name="warna-text-latar" id="warna-text-latar" data-transform="#preview-text-app" data-change="color"/>
											</div>
											<label for="preview-box" class=" col-2 col-form-label font-weight-medium">Preview : </label>
											<div class="col-2">
												<div class="text-center preview-box" id="preview-box-app">
													<span  id="preview-text-app">Teks Tampil</span>
												</div>
											</div>
										</div>

										<div class="form-group row">
											<h4 class="font-weight-medium col-12 border-bottom" >Header</h4>
											<label for="warna-latar-header" class="col-2 col-form-label font-weight-medium">Warna Latar</label>
											<div class="col-2">
												<input type='text' class="color-picker" value="#0ba1b5" name="warna-latar-header"  id="warna-latar-header" data-transform="#preview-box-header" data-change="background-color"/>
											</div>
											<label for="warna-text-header" class="col-2 col-form-label font-weight-medium">Warna Text</label>
											<div class="col-2">
												<input type='text' class="color-picker" value="#000000" name="warna-text-header" id="warna-text-header" data-transform="#preview-text-header" data-change="color"/>
											</div>
											<label for="preview-box" class=" col-2 col-form-label font-weight-medium">Preview : </label>
											<div class="col-2">
												<div class="text-center preview-box" id="preview-box-header">
													<span  id="preview-text-header">Teks Tampil</span>
												</div>
											</div>
										</div>

										<div class="form-group row">
											<h4 class="font-weight-medium col-12 border-bottom" >Header Logo</h4>
											<label for="warna-latar-header-logo" class="col-2 col-form-label font-weight-medium">Warna Latar</label>
											<div class="col-2">
												<input type='text' class="color-picker" value="#0ba1b5" name="warna-latar-app-logo"  id="warna-latar-header-logo" data-transform="#preview-box-header-logo" data-change="background-color"/>
											</div>
											<label for="warna-text-header" class="col-2 col-form-label font-weight-medium">Warna Text</label>
											<div class="col-2">
												<input type='text' class="color-picker" value="#000000" name="warna-text-header-logo" id="warna-text-header-logo" data-transform="#preview-text-header-logo" data-change="color"/>
											</div>
											<label for="preview-box" class=" col-2 col-form-label font-weight-medium">Preview : </label>
											<div class="col-2">
												<div class="text-center preview-box" id="preview-box-header-logo">
													<span  id="preview-text-header-logo">Teks Tampil</span>
												</div>
											</div>
										</div>

										<div class="form-group row">
											<h4 class="font-weight-medium col-12 border-bottom" >Footer</h4>
											<label for="warna-latar-footer" class="col-2 col-form-label font-weight-medium">Warna Latar</label>
											<div class="col-2">
												<input type='text' class="color-picker" value="#0ba1b5" name="warna-latar-footer"  id="warna-latar-footer" data-transform="#preview-box-footer" data-change="background-color"/>
											</div>
											<label for="warna-text-header" class="col-2 col-form-label font-weight-medium">Warna Text</label>
											<div class="col-2">
												<input type='text' class="color-picker" value="#000000" name="warna-text-footer" id="warna-text-footer" data-transform="#preview-text-footer" data-change="color"/>
											</div>
											<label for="preview-box" class=" col-2 col-form-label font-weight-medium">Preview : </label>
											<div class="col-2">
												<div class="text-center preview-box" id="preview-box-footer">
													<span  id="preview-text-footer">Teks Tampil</span>
												</div>
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
							</div>
						</div>
						<!-- end setting tab content -->


					</div>
				</div>
