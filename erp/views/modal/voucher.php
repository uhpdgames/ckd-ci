
<div class="modal fade" id="ModalContent" tabindex="-1" role="dialog"
	 aria-hidden="true">

	<form action="ajax/update_data" class="needs-validation tooltip-label-right" id="form-ajax">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="ModalContentLabel">THÊM MỚI MÃ GIẢM GIÁ</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>

				</div>
				<div class="modal-body">
					<div class="form-group">
						<?=select_users()?>
					</div>

					<div class="form-group position-relative error-l-50">
						<div class="input-daterange input-group" id="datepicker">
							<input type="text" class="input-sm form-control" name="start_date" value="<?=@$item['start_date'] ?? ''?>" placeholder="Ngày có hiệu lực">
							<span class="input-group-addon"></span>
							<input type="text" class="input-sm form-control" name="end_date" value="<?=@$item['end_date'] ?? ''?>" placeholder="Ngày hết hạn">
						</div>
					</div>
					<div class="form-group">
						<label for="recipient-name"
							   class="col-form-label">Mô tả:</label>
						<input type="text" class="disabled input-sm form-control" name="description" value="Đăng ký mới thành viên CKD được giảm 10% giá trị đơn hàng" placeholder="Đăng ký mới thành viên CKD được giảm 10% giá trị đơn hàng">

					</div>




					<div class="form-group position-relative error-l-50">
						<label>Loại mã giảm giá</label>
						<input type="text" class="form-control disabled" required name="type" value="<?=@$item['type']?? 'register'?>">
						<div class="invalid-tooltip">
							Name is required!
						</div>
					</div>
					<div class="form-group position-relative error-l-50">
						<label>Mã giảm giá</label>
						<input type="text" class="disabled form-control" name="code" value="<?=@$ajax['code']?? ''?>" required>
						<div class="invalid-tooltip">
							Nhập giá trị muốn giảm (%)
						</div>
					</div>

					<div class="form-group position-relative error-l-50">
						<label>Tỷ lệ giảm (%)</label>
						<input type="number" class="form-control" name="discount_percentage" value="<?=@$item['discount_percentage']?? '10'?>" required>
						<div class="invalid-tooltip">
							Nhập giá trị muốn giảm (%)
						</div>
					</div>


					<div class="form-group position-relative">

						<div class="custom-control custom-checkbox">
							<input  type="hidden" name="is_one_time_use" class="disabled check_once" value="<?=@$item['is_one_time_use']??'1'?>">
							<input  type="checkbox" class="disabled custom-control-input" id="check_once" value="<?=@$item['is_one_time_use']??'1'?>"
								   checked required <?=@$item['is_one_time_use']? 'checked': ''?>>
							<label class="custom-control-label" for="check_once">Sử dụng một lần</label>
						</div>

					</div>
				</div>


				<div class="modal-footer text-center justify-content-center align-items-center">

					<input type="hidden" value="<?=@$ajax['table']?>" id="table" name="table">
					<input type="hidden" value="<?=@$ajax['id']?>" id="id" name="id">
					<input type="hidden" value="1" id="is_one_time_use" name="is_one_time_use">
					<button id="submit" data-from="top" data-align="left" type="submit" class="btn btn-primary">Lưu lại</button>

					<button type="button" class="btn btn-secondary"
							data-dismiss="modal">Bỏ qua
					</button>
				</div>

			</div>
		</div>
	</form>
</div>




<style>


	.disabled{
		user-select: none;
		pointer-events: none;
		cursor: not-allowed;
		filter: opacity(0.6);
	}


</style>
<script>
	$("#ModalContent").on("show.bs.modal", function (event) {
		var button = $(event.relatedTarget);
		var recipient = button.data("whatever");
		var modal = $(this);
		//modal.find(".modal-title").text("New message to " + recipient);
		/*#modal.find(".modal-body input").val(recipient);*/
	});

</script>
<script>
	$("#form-ajax").submit(function (event) {
		event.preventDefault();

		var $form = $(this),
			url = $form.attr('action');

		$data = $.param($(this).serializeArray()) ;


		var posting = $.post(url, $data);

		posting.done(function (data) {

			showNotification($(this).data("from"), $(this).data("align"), "primary", 'Thông báo', 'Thêm dữ liệu thành công!');

			$('#result').fadeIn(500);
			$('#result').text('Cập nhật thành công!');
			setTimeout(function (){
				$('#result').fadeOut(500);

				$('#ModalContent').modal('hide');
				
				location.reload();
			}, 3000);




		});
		posting.fail(function () {
			showNotification($(this).data("from"), $(this).data("align"), "primary", 'Thông báo', 'Cập nhật thất bại!');

			$('#result').fadeIn(500);
			$('#result').text('Cập nhật thất bại');
			setTimeout(function (){
				$('#result').fadeOut(500);

				$('#ModalContent').modal('show');
			}, 3000)
		});



	});



	$('#datepicker').datepicker({ format: 'dd/mm/yyyy' });

	$('#check_once').click(function() {
		if($('#check_once').prop('checked')){
			$('.check_once').val(1);
		}else{
			$('.check_once').val(0);
		}
	});




	function showNotification(placementFrom, placementAlign, type, title, message) {
		$.notify(
			{
				title: title,
				message:message,
				target: "_blank"
			},
			{
				element: "body",
				position: null,
				type: type,
				allow_dismiss: true,
				newest_on_top: false,
				showProgressbar: false,
				placement: {
					from: placementFrom,
					align: placementAlign
				},
				offset: 20,
				spacing: 10,
				z_index: 99999,
				delay: 4000,
				timer: 2000,
				url_target: "_blank",
				mouse_over: null,
				animate: {
					enter: "animated fadeInDown",
					exit: "animated fadeOutUp"
				},
				onShow: null,
				onShown: null,
				onClose: null,
				onClosed: null,
				icon_type: "class",
				template:
					'<div data-notify="container" class="col-11 col-sm-3 alert  alert-{0} " role="alert">' +
					'<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
					'<span data-notify="icon"></span> ' +
					'<span data-notify="title">{1}</span> ' +
					'<span data-notify="message">{2}</span>' +
					'<div class="progress" data-notify="progressbar">' +
					'<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
					"</div>" +
					'<a href="{3}" target="{4}" data-notify="url"></a>' +
					"</div>"
			}
		);
	}
</script>
