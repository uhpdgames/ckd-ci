<section class="content">

	<div class="row">

		<?php if (isset($_SESSION['results'])): ?>
			<div class="col-12">
				<div id="results" style=" display: block;width: 100%" class="alert alert-success rounded" role="alert">
					<?= $_SESSION['results'] ?? '' ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
	<div class="row">
		<div class="col-12 col-md-6">
			<div class="card">
				<div class="card-body">


					<form novalidate method="post" action="binhluan/save" enctype="multipart/form-data">
						<input type="hidden" name="id_photo" value="<?= getRequest('id_photo') ?>">
						<div class="card-footer text-sm sticky-top">
							<button type="submit" class="btn btn-warning rounded-pill submit-check"><i
									class="far fa-save mr-2"></i>Lưu
							</button>
						</div>
						<!--	hinh-->
						<div class="form-group">
							<label class="change-photo" for="file">
								<p>Upload hình ảnh:</p>
								<div class="rounded">
									<img width="150" id="myphoto" class="img-upload" src="" alt="Alt Photo"/>
									<strong>
										<b class="text-sm text-split"></b>
										<span class="btn btn-success rounded-pill"><i class="fas fa-camera mr-2"></i>Chọn hình</span>
									</strong>
								</div>
							</label>
							<strong class="d-block mt-2 mb-2 text-sm"></strong>
							<div class="custom-file my-custom-file d-none">
								<input accept="image/*" onchange="loadFile(event)" type="file" class="custom-file-input"
									   name="file"
									   id="file">
								<label class="custom-file-label" for="file">Chọn file</label>
							</div>
						</div>

						<div class="row">
							<div class="col-3">
								<label for="sosao">Số sao (từ 1 đến 5 sao)</label><br/>
								<input id="sosao" type="number" min="1" max="5" name="link_video" class="form-control"
									   value="<?= @$items['link_video'] ?>"/>

								<br/>

								<label for="tieude">Tên khách hàng</label>
								<input id="tieude" type="text" name="tenvi" class="form-control"
									   value="<?= @$items['tenvi'] ?>"/>
							</div>
						</div>

						<label for="danhgia">Nội dung đánh giá</label>
						<textarea class="form-control for-seo" name="motavi" id="danhgia" rows="5"
								  placeholder="Đánh giá"><?= @$items['motavi'] ?></textarea>


					</form>


				</div>
			</div>
		</div>
	</div>

</section>

<script>
	function loadFile(event) {
		$('.text-split').hide();

		var output = document.getElementById('myphoto');
		output.src = URL.createObjectURL(event.target.files[0]);
		output.onload = function () {
			URL.revokeObjectURL(output.src) // free memory
		}

	}

	var id_details = "<?= @$item['id']  ?>";
	var table_name = 'table_gallery';


	setTimeout(function () {
		$('#results').hide();
	}, 5000)
</script>

