				<div class="card setting-card" >
					<div class="card-body">
						<h4 class="card-title pb-3 border-bottom"><?= $settingsTitle;?></h4>

						<!-- setting tab content -->
						<div class="setting-tab">
							<form action="<?= base_url('ComponentService/setMedia')?>" class="form-row" method="post" enctype="multipart/form-data">
								<div class="col-5">
									<input type="text" name="gambar-option" hidden value="">
									<div class="row">
										<div class="form-group col-11">
											<h5  style="font-family: titilliumweb-bold">Unggah Media</h5>
											<input type="file" class="dropify"
												   name="media-upload"
												   data-allowed-file-extensions="jpg png jpeg mp4" id="media-upload" required>
										</div>
										<div class="form-group col-11">
											<h5 style="font-family: titilliumweb-bold">Durasi Slide Gambar (detik)</h5>
											<input type="number" class="form-control" name="duration" value="<?= $duration?>" required>
										</div>
									</div>
								</div>
								<div class="col-7">
									<h5 style="font-family: titilliumweb-bold" class="mb-2">Daftar Putar</h5>
									<div class="list-wrapper media-gambar-list" style="height: 300px;overflow: auto">
										<ul class="d-flex flex-column-reverse todo-list">
											<?php foreach ($media as $key => $val): ?>
												<li  style="padding: 4px !important;">
													<a href="<?= base_url($val['source'])?>" target="_blank" title="lihat gambar">
														<?= $val['title']?>
													</a>
													<a href="<?= base_url('ComponentService/deleteMedia/'.$val['id'])?>" class="delete mdi mdi-close-circle-outline" onclick="return confirm('Hapus Item ?')"></a>
												</li>
											<?php endforeach;?>
										</ul>
									</div>
								</div>

								<button type="submit" class="btn btn-primary col-12 mt-2" name="simpan" id="gambar-submit-btn">
									simpan
								</button>

							</form>
						</div>
						<!-- end setting tab content -->

					</div>

				</div>
