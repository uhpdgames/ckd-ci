
<div class="modal fade" id="ModalContent" tabindex="-1" role="dialog"
	 aria-hidden="true">

	<form action="ajax/update_data" method="post" class="form-ajax-cate needs-validation tooltip-label-right form-ajax">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="ModalContentLabel">THÊM MỚI LOẠI GIẢM GIÁ</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>

				</div>
				<div class="modal-body">
					<div class="form-group position-relative error-l-50">
						<div class="input-daterange input-group" id="datepicker">
							<input type="text" class="datetimepicker input-sm form-control" name="start" value="" placeholder="Ngày có hiệu lực">
							<span class="input-group-addon"></span>
							<input type="text" class="datetimepicker input-sm form-control" name="end" value="" placeholder="Ngày hết hạn">
						</div>
					</div>
					<div class="form-group">
						<label for="recipient-name"
							   class="col-form-label">Tên mã giảm</label>
						<input type="text" class="input-sm form-control" name="ten" value="" placeholder="Tên mã giảm">

					</div>
					<div class="form-group">
						<label for="recipient-name"
							   class="col-form-label">Tên loại: <em>(mã-code: vui lòng nhập đúng định dạng)</em></label>
						<input type="text" class="input-sm form-control" name="name" value="" placeholder="Tên loại mã giảm giá">

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
						<input type="number" class="form-control" name="rate" value="" placeholder="Nhập phần trăm muốn giảm">
						<div class="invalid-tooltip">
							Nhập giá trị muốn giảm (%)
						</div>
					</div>
					<!--<div class="form-group position-relative">
						<div class="custom-control custom-checkbox">
							<input type="hidden" name="once" class="check_once"
								   value="">
							<input type="checkbox" class="custom-control-input" id="check_once"
								   value=""
								   required>
							<label class="custom-control-label" for="check_once">Sử dụng một lần</label>
						</div>
					</div>-->
				</div>


				<div class="modal-footer text-center justify-content-center align-items-center">

					<input type="hidden" value="<?=@$ajax['table']?>" id="table" name="table">
					<input type="hidden" value="0" id="id" name="id">
					<input type="hidden" value="1" id="once" name="once">

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
