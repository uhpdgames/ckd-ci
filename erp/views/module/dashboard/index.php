<div class="card">

	<div class="card-body collapse show">
		<a style="width: 100%; height:6px;" role="progressbar"
		   class="mt-5 progress-bar bg-danger wow animated progress-animated" data-toggle="collapse"
		   data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
			<span class="sr-only"></span>
		</a>
		<h2><span class="text-primary text">MARKING</span></h2>
		<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
			<div class="card-body">
				<div class="box-module">
					<div class="item" data-toggle="tooltip" data-placement="top"
						 title="Quản lý Sản phẩm">
						<a href="items">
							<span class="text-primary text"><i class="iconsminds-shopping-bag"></i></span>
						</a>
						<div class="card-text">Sản phẩm</div>
					</div>

					<div class="item disabled" data-toggle="tooltip" data-placement="top"
						 title="Quản lý phiếu giảm giá">
						<a href="voucher">
							<span class="text-primary text"><i class="iconsminds-gift-box"></i></span>
						</a>
						<div class="card-text">Voucher</div>
					</div>
					<div class="item disabled" data-toggle="tooltip" data-placement="top"
						 title="Email for marketing campaign">
						<a href="email_marking">
							<span class="text-primary text"><i class="iconsminds-mail-money"></i></span>
						</a>
						<div class="card-text">Email Marking</div>
					</div>
					<div class="item disabled" data-toggle="tooltip" data-placement="top"
						 title="Contact client">
						<a href="email_marking">
							<span class="text-primary text"><i class="iconsminds-mailbox-empty"></i></span>
						</a>
						<div class="card-text">Contact</div>
					</div>

					<!--<div class="item disabled" data-toggle="tooltip" data-placement="bottom" title="CHẤM CÔNG">
                        <a href="pages/report">
                            <span><i class="fas fa-gavel"></i></span>
                        </a>
                        <div class="card-text">CHẤM CÔNG</div>
                    </div>
					 -->
				</div>
			</div>
		</div>

		<a style="width: 100%; height:6px;" role="progressbar"
		   class="mt-5 progress-bar bg-danger wow animated progress-animated" data-toggle="collapse"
		   data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
			<span class="sr-only"></span>
		</a>
		<h2><span class="text-primary text">FORECAST</span></h2>
		<div id="collapseTwo" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
			<div class="card-body">
				<div class="box-module">
                    <div class="item" data-toggle="tooltip" data-placement="top"
                         title="Quản lý đơn hàng">
                        <a href="product">
                            <span class="text-primary text"><i class="iconsminds-shopping-basket"></i></span>
                        </a>
                        <div class="card-text">Đơn hàng</div>
                    </div>
                    <div class="item" data-toggle="tooltip" data-placement="top"
                         title="Quản lý&Backslash;Viettel Post">
                        <a href="product/tracking">
                            <span class="text-primary text"><i class="iconsminds-scooter"></i></span>
                        </a>
                        <div class="card-text">Vận chuyển</div>
                    </div>

				</div>
			</div>
		</div>


        <div class="cate-3">
            <a style="width: 100%; height:6px;" role="progressbar"
               class="mt-5 progress-bar bg-danger wow animated progress-animated" data-toggle="collapse"
               data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                <span class="sr-only"></span>
            </a>
            <h2><span class="text-primary text">Client</span></h2>
            <div id="collapseThree" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    <div class="box-module">
                        <div class="item" data-toggle="tooltip" data-placement="top"
                             title="Quản lý tài khoản khách hàng">
                            <a href="users">
                                <span class="text-primary text"><i class="iconsminds-user"></i></span>
                            </a>
                            <div class="card-text">Tài khoản khách hàng</div>
                        </div>




                    </div>
                </div>
            </div>
        </div>






	</div>
</div>


<style>

	.progress-bar {
		cursor: pointer;
	}

	.progress-bar span.text {
		font-size: 1.5rem;
		font-weight: 500;
		display: inline-block;
		background-color: transparent;
		width: 2rem;
		margin: 0 auto;
		color: #0a3622;
		padding: .5rem;
		border-radius: 5px;
		opacity: 1;
		transform: translateY(50%);
	}

	.box-module {

		display: inline-flex;
		flex-direction: row;
		flex-wrap: wrap;
		justify-content: flex-start;
		text-align: center;
		vertical-align: middle;

		/*border: 1px solid;*/
		gap: 5rem;

		width: 100%;
		margin: 0 auto;
		margin-top: 2rem;
		height: 5rem;
	}


	.box-module .item.disabled {
		cursor: none;
	}

	.box-module .item.disabled i {
		opacity: 1;
	}

	.box-module i {
		font-size: 4rem;
		transition: height 180ms ease-in;
		transform: translateY(1%) scale(1.02);
	}

	.box-module i:hover {
		transform: translateY(-5%) scale(1.05);
		transition-duration: 240ms;
		transition-timing-function: ease-out;
	}
</style>
