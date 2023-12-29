<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">

	<div class="row">
		<div class="col-12">
			<div class="mb-2">
				<h1>Danh sách <?= $module ?></h1>
				<div class="top-right-button-container">


				</div>

				<nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
					<ol class="breadcrumb pt-0">
						<li class="breadcrumb-item">
							<a href=".">Home</a>
						</li>
						<li class="breadcrumb-item">
							<a href=<?= strtolower($module) ?>><?= $module ?></a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Danh sách</li>
					</ol>
				</nav>
			</div>

		</div>
	</div>

	<div class="row">

		<div class="col-12">
			<div id="results" style=" display: none;width: 100%" class="alert alert-success rounded" role="alert">

			</div>
		</div>
	</div>
</div>


<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
	<!-- ============================================================== -->
	<!-- Start Page Content -->
	<!-- ============================================================== -->
	<div class="row">
		<div class="col-12 list">
			<div class="card">
				<div class="card-body">
					<div class="wp-action">
						<a

							id="getItem"
							class="btn btn-primary btn-lg top-right-button mr-1"

							href="javascript:void(0)"><i class="iconsminds-edit"></i>


							Nhận tất cả các đường dẫn của website: CKD VIỆT NAM
						</a>


						<a

							id="sendItem"
							class="btn btn-primary btn-lg top-right-button mr-1"

							href="javascript:void(0)"><i class="iconsminds-edit"></i>
							Gửi TRANG đến Google Indexing API
						</a>


					</div>

					<div class="my-contenteditable"
						 contenteditable="true"
						 contenteditable="plaintext-only"
					>
						<div class="rs-link">Ấn nút bên trên để lấy dữ liệu</div>
					</div>




				</div>
			</div>
		</div>
	</div>
</div>

<script>
	var table_name = '';
	var id_details = '';

	$(document).ready(function() {
		$('#getItem').on('click',getUrl);
		//$('#sendItem').on('click',setUrl);


	});




	function setUrl(){

		alert('Tạm khóa!');

		return false;
		$.ajax({
			async: false,
			type: 'post',
			url: '<?=MYSITE?>' + 'Api/sendAllUrlToGoogle',
			success: function (result) {
				if(result){

					alert('Đã gửi đến google index thành công!')
				}else{
					alert('Có lỗi xảy ra')
				}
			}
		});
	}

	function getUrl() {
		$.ajax({
				dataType: 'html',
				async: false,
				type: 'post',
				url: '<?=MYSITE?>' + 'Api/getAllCKDLink',
				beforeSend: function () {
					//$('#getItem').prop('disabled', true);
					$(".rs-link").html('Đang tải dữ liệu, vui lòng chờ đợi....');
				},
				success: function (result) {
					//	result = JSON.parse(result);


					$(".rs-link").html(result);
					$('#getItem').addClass('disabled');
				},
				complete: function () {
					//$('#getItem').prop('disabled', false)
				}
			}
		)
	}
</script>


<style>
	.my-contenteditable {
		background: #eee;
		border-radius: 5px;
		margin: 16px 0;
	}

	.my-contenteditable .rs-link {
		padding: 15px;
	}


	[contenteditable='true'] {
		caret-color: red;
	}

</style>
