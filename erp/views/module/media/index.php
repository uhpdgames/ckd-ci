<div class="container-fluid library-app">
	<div class="row">
		<div class="col-12">
			<div class="mb-3">
				<h1>Media Library</h1>
				<div class="text-zero top-right-button-container">
					<button type="button" class="btn btn-primary btn-lg top-right-button mr-1">ADD NEW</button>
					<div class="btn-group">
						<div class="btn btn-primary btn-lg pl-4 pr-0 check-button">
							<label class="custom-control custom-checkbox mb-0 d-inline-block">
								<input type="checkbox" class="custom-control-input" id="checkAll">
								<span class="custom-control-label"></span>
							</label>
						</div>
						<button type="button"
								class="btn btn-lg btn-primary dropdown-toggle dropdown-toggle-split"
								data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="sr-only">Toggle Dropdown</span>
						</button>
						<div class="dropdown-menu dropdown-menu-right">
							<a class="dropdown-item" href="#">Action</a>
							<a class="dropdown-item" href="#">Another action</a>
						</div>
					</div>
				</div>
				<nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
					<ol class="breadcrumb pt-0">
						<li class="breadcrumb-item">
							<a href="#">Home</a>
						</li>
						<li class="breadcrumb-item">
							<a href="#">Library</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Data</li>
					</ol>
				</nav>
			</div>

			<div class="mb-2">
				<a class="btn pt-0 pl-0 d-inline-block d-md-none" data-toggle="collapse" href="#displayOptions"
				   role="button" aria-expanded="true" aria-controls="displayOptions">
					Display Options
					<i class="simple-icon-arrow-down align-middle"></i>
				</a>
				<div class="collapse d-md-block" id="displayOptions">
					<div class="d-block d-md-inline-block">
						<div class="btn-group float-md-left mr-1 mb-1">
							<button class="btn btn-outline-dark btn-xs dropdown-toggle" type="button"
									data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Order By
							</button>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Another action</a>
							</div>
						</div>
						<div class="search-sm d-inline-block float-md-left mr-1 mb-1 align-top">
							<input placeholder="Search...">
						</div>
					</div>
					<div class="float-md-right">
						<span class="text-muted text-small">Displaying 1-10 of 210 items </span>
						<button class="btn btn-outline-dark btn-xs dropdown-toggle" type="button"
								data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							20
						</button>
						<div class="dropdown-menu dropdown-menu-right">
							<a class="dropdown-item" href="#">10</a>
							<a class="dropdown-item active" href="#">20</a>
							<a class="dropdown-item" href="#">30</a>
							<a class="dropdown-item" href="#">50</a>
							<a class="dropdown-item" href="#">100</a>
						</div>
					</div>
				</div>
			</div>
			<div class="separator mb-5"></div>
		</div>
	</div>

	<div class="row">
		<div class="col-12 col-xl-4 drop-area-container">
			<div class="card drop-area">
				<div class="card-body">
					<form action="/file-upload">
						<div class="dropzone ">
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-12 col-xl-8 list disable-text-selection" data-check-all="checkAll">
			<div class="row">

				<div class="col-xxl-4 col-xl-6 col-12">
					<div class="card d-flex flex-row mb-4 media-thumb-container">
						<a class="d-flex align-self-center media-thumbnail-icon"
						   href="Apps.MediaLibrary.ViewFolder.html">
							<i class="iconsminds-folder-open"></i>
						</a>
						<div class="d-flex flex-grow-1 min-width-zero">
							<div
								class="card-body align-self-center d-flex flex-column justify-content-between min-width-zero align-items-lg-center">
								<a href="Apps.MediaLibrary.ViewFolder.html" class="w-100">
									<p class="list-item-heading mb-1 truncate">Cakes</p>
								</a>
								<p class="mb-1 text-muted text-small w-100 truncate">14.11.2018</p>
							</div>
							<div class="pl-1 align-self-center">
								<label class="custom-control custom-checkbox mb-0">
									<input type="checkbox" class="custom-control-input">
									<span class="custom-control-label"></span>
								</label>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xxl-4 col-xl-6 col-12">
					<div class="card d-flex flex-row mb-4 media-thumb-container">
						<a class="d-flex align-self-center media-thumbnail-icon"
						   href="Apps.MediaLibrary.ViewFolder.html">
							<i class="iconsminds-folder-open"></i>
						</a>
						<div class="d-flex flex-grow-1 min-width-zero">
							<div
								class="card-body align-self-center d-flex flex-column justify-content-between min-width-zero align-items-lg-center">
								<a href="Apps.MediaLibrary.ViewFolder.html" class="w-100">
									<p class="list-item-heading mb-1 truncate">Desserts</p>
								</a>
								<p class="mb-1 text-muted text-small w-100 truncate">18.11.2018</p>
							</div>
							<div class="pl-1 align-self-center">
								<label class="custom-control custom-checkbox mb-0">
									<input type="checkbox" class="custom-control-input">
									<span class="custom-control-label"></span>
								</label>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xxl-4 col-xl-6 col-12">
					<div class="card d-flex flex-row mb-4 media-thumb-container">
						<a class="d-flex align-self-center media-thumbnail-icon"
						   href="Apps.MediaLibrary.ViewAudio.html">
							<i class="iconsminds-guitar"></i>
						</a>
						<div class="d-flex flex-grow-1 min-width-zero">
							<div
								class="card-body align-self-center d-flex flex-column justify-content-between min-width-zero align-items-lg-center">
								<a href="Apps.MediaLibrary.ViewAudio.html" class="w-100">
									<p class="list-item-heading mb-1 truncate">commercial-back.mp3</p>
								</a>
								<p class="mb-1 text-muted text-small w-100 truncate">02.10.2018</p>
							</div>
							<div class="pl-1 align-self-center">
								<label class="custom-control custom-checkbox mb-0">
									<input type="checkbox" class="custom-control-input">
									<span class="custom-control-label"></span>
								</label>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xxl-4 col-xl-6 col-12">
					<div class="card d-flex flex-row mb-4 media-thumb-container">
						<a class="d-flex align-self-center media-thumbnail-icon"
						   href="Apps.MediaLibrary.ViewAudio.html">
							<i class="iconsminds-guitar"></i>
						</a>
						<div class="d-flex flex-grow-1 min-width-zero">
							<div
								class="card-body align-self-center d-flex flex-column justify-content-between min-width-zero align-items-lg-center">
								<a href="Apps.MediaLibrary.ViewAudio.html" class="w-100">
									<p class="list-item-heading mb-1 truncate">ambiance.mp3</p>
								</a>
								<p class="mb-1 text-muted text-small w-100 truncate">22.12.2018</p>
							</div>
							<div class="pl-1 align-self-center">
								<label class="custom-control custom-checkbox mb-0">
									<input type="checkbox" class="custom-control-input">
									<span class="custom-control-label"></span>
								</label>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xxl-4 col-xl-6 col-12">
					<div class="card d-flex flex-row mb-4 media-thumb-container">
						<a class="d-flex align-self-center media-thumbnail-icon"
						   href="Apps.MediaLibrary.ViewVideo.html">
							<i class="iconsminds-camera-4"></i>
						</a>
						<div class="d-flex flex-grow-1 min-width-zero">
							<div
								class="card-body align-self-center d-flex flex-column justify-content-between min-width-zero align-items-lg-center">
								<a href="Apps.MediaLibrary.ViewVideo.html" class="w-100">
									<p class="list-item-heading mb-1 truncate">big-buck-bunny.mp4</p>
								</a>
								<p class="mb-1 text-muted text-small w-100 truncate">07.10.2018</p>
							</div>
							<div class="pl-1 align-self-center">
								<label class="custom-control custom-checkbox mb-0">
									<input type="checkbox" class="custom-control-input">
									<span class="custom-control-label"></span>
								</label>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xxl-4 col-xl-6 col-12">
					<div class="card d-flex flex-row mb-4 media-thumb-container">
						<a class="d-flex align-self-center" href="Apps.MediaLibrary.ViewImage.html">
							<img src="img/products/bebinca-thumb.jpg" alt="uploaded image"
								 class="list-media-thumbnail responsive border-0" />
						</a>
						<div class="d-flex flex-grow-1 min-width-zero">
							<div
								class="card-body align-self-center d-flex flex-column justify-content-between min-width-zero align-items-lg-center">
								<a href="Apps.MediaLibrary.ViewImage.html" class="w-100">
									<p class="list-item-heading mb-1 truncate">bebinca-thumb.jpg</p>
								</a>
								<p class="mb-1 text-muted text-small w-100 truncate">16.09.2018 14:04</p>
							</div>
							<div class="pl-1 align-self-center">
								<label class="custom-control custom-checkbox mb-0">
									<input type="checkbox" class="custom-control-input">
									<span class="custom-control-label"></span>
								</label>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xxl-4 col-xl-6 col-12">
					<div class="card d-flex flex-row mb-4 media-thumb-container ">
						<a class="d-flex align-self-center" href="Apps.MediaLibrary.ViewImage.html">
							<img src="img/products/cheesecake-thumb.jpg" alt="uploaded image"
								 class="list-media-thumbnail responsive border-0" />
						</a>
						<div class="d-flex flex-grow-1 min-width-zero">
							<div
								class="card-body align-self-center d-flex flex-column justify-content-between min-width-zero align-items-lg-center">
								<a href="Apps.MediaLibrary.ViewImage.html" class="w-100">
									<p class="list-item-heading mb-1 truncate">cheesecake-thumb.jpg</p>
								</a>
								<p class="mb-1 text-muted text-small w-100 truncate">16.09.2018 14:05</p>
							</div>
							<div class="pl-1 align-self-center">
								<label class="custom-control custom-checkbox mb-0">
									<input type="checkbox" class="custom-control-input">
									<span class="custom-control-label"></span>
								</label>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xxl-4 col-xl-6 col-12">
					<div class="card d-flex flex-row mb-4 media-thumb-container">
						<a class="d-flex align-self-center" href="Apps.MediaLibrary.ViewImage.html">
							<img src="img/products/chocolate-cake-thumb.jpg" alt="uploaded image"
								 class="list-media-thumbnail responsive border-0" />
						</a>
						<div class="d-flex flex-grow-1 min-width-zero">
							<div
								class="card-body align-self-center d-flex flex-column justify-content-between min-width-zero align-items-lg-center">
								<a href="Apps.MediaLibrary.ViewImage.html" class="w-100">
									<p class="list-item-heading mb-1 truncate">chocolate-cake-thumb.jpg</p>
								</a>
								<p class="mb-1 text-muted text-small w-100 truncate">16.09.2018 14:08</p>
							</div>
							<div class="pl-1 align-self-center">
								<label class="custom-control custom-checkbox mb-0">
									<input type="checkbox" class="custom-control-input">
									<span class="custom-control-label"></span>
								</label>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xxl-4 col-xl-6 col-12">
					<div class="card d-flex flex-row mb-4 media-thumb-container">
						<a class="d-flex align-self-center" href="Apps.MediaLibrary.ViewImage.html">
							<img src="img/products/coconut-cake.jpg" alt="uploaded image"
								 class="list-media-thumbnail responsive border-0" />
						</a>
						<div class="d-flex flex-grow-1 min-width-zero">
							<div
								class="card-body align-self-center d-flex flex-column justify-content-between min-width-zero align-items-lg-center">
								<a href="Apps.MediaLibrary.ViewImage.html" class="w-100">
									<p class="list-item-heading mb-1 truncate">coconut-cake.jpg</p>
								</a>
								<p class="mb-1 text-muted text-small w-100 truncate">16.09.2018 14:15</p>
							</div>
							<div class="pl-1 align-self-center">
								<label class="custom-control custom-checkbox mb-0">
									<input type="checkbox" class="custom-control-input">
									<span class="custom-control-label"></span>
								</label>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xxl-4 col-xl-6 col-12">
					<div class="card d-flex flex-row mb-4 media-thumb-container">
						<a class="d-flex align-self-center" href="Apps.MediaLibrary.ViewImage.html">
							<img src="img/products/cremeschnitte-thumb.jpg" alt="uploaded image"
								 class="list-media-thumbnail responsive border-0" />
						</a>
						<div class="d-flex flex-grow-1 min-width-zero">
							<div
								class="card-body align-self-center d-flex flex-column justify-content-between min-width-zero align-items-lg-center">
								<a href="Apps.MediaLibrary.ViewImage.html" class="w-100">
									<p class="list-item-heading mb-1 truncate">cremeschnitte-thumb.jpg</p>
								</a>
								<p class="mb-1 text-muted text-small w-100 truncate">16.09.2018 14:23</p>
							</div>
							<div class="pl-1 align-self-center">
								<label class="custom-control custom-checkbox mb-0">
									<input type="checkbox" class="custom-control-input">
									<span class="custom-control-label"></span>
								</label>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xxl-4 col-xl-6 col-12">
					<div class="card d-flex flex-row mb-4 media-thumb-container">
						<a class="d-flex align-self-center" href="Apps.MediaLibrary.ViewImage.html">
							<img src="img/products/fat-rascal-thumb.jpg" alt="uploaded image"
								 class="list-media-thumbnail responsive border-0" />
						</a>
						<div class="d-flex flex-grow-1 min-width-zero">
							<div
								class="card-body align-self-center d-flex flex-column justify-content-between min-width-zero align-items-lg-center">
								<a href="Apps.MediaLibrary.ViewImage.html" class="w-100">
									<p class="list-item-heading mb-1 truncate">fat-rascal-thumb.jpg</p>
								</a>
								<p class="mb-1 text-muted text-small w-100 truncate">16.09.2018 14:27</p>
							</div>
							<div class="pl-1 align-self-center">
								<label class="custom-control custom-checkbox mb-0">
									<input type="checkbox" class="custom-control-input">
									<span class="custom-control-label"></span>
								</label>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xxl-4 col-xl-6 col-12">
					<div class="card d-flex flex-row mb-4 media-thumb-container">
						<a class="d-flex align-self-center" href="Apps.MediaLibrary.ViewImage.html">
							<img src="img/products/financier-thumb.jpg" alt="uploaded image"
								 class="list-media-thumbnail responsive border-0" />
						</a>
						<div class="d-flex flex-grow-1 min-width-zero">
							<div
								class="card-body align-self-center d-flex flex-column justify-content-between min-width-zero align-items-lg-center">
								<a href="Apps.MediaLibrary.ViewImage.html" class="w-100">
									<p class="list-item-heading mb-1 truncate">financier-thumb.jpg</p>
								</a>
								<p class="mb-1 text-muted text-small w-100 truncate">16.09.2018 14:32</p>
							</div>
							<div class="pl-1 align-self-center">
								<label class="custom-control custom-checkbox mb-0">
									<input type="checkbox" class="custom-control-input">
									<span class="custom-control-label"></span>
								</label>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xxl-4 col-xl-6 col-12">
					<div class="card d-flex flex-row mb-4 media-thumb-container">
						<a class="d-flex align-self-center" href="Apps.MediaLibrary.ViewImage.html">
							<img src="img/products/fruitcake-thumb.jpg" alt="uploaded image"
								 class="list-media-thumbnail responsive border-0" />
						</a>
						<div class="d-flex flex-grow-1 min-width-zero">
							<div
								class="card-body align-self-center d-flex flex-column justify-content-between min-width-zero align-items-lg-center">
								<a href="Apps.MediaLibrary.ViewImage.html" class="w-100">
									<p class="list-item-heading mb-1 truncate">fruitcake-thumb.jpg</p>
								</a>
								<p class="mb-1 text-muted text-small w-100 truncate">16.09.2018 14:33</p>
							</div>
							<div class="pl-1 align-self-center">
								<label class="custom-control custom-checkbox mb-0">
									<input type="checkbox" class="custom-control-input">
									<span class="custom-control-label"></span>
								</label>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xxl-4 col-xl-6 col-12">
					<div class="card d-flex flex-row mb-4 media-thumb-container">
						<a class="d-flex align-self-center" href="Apps.MediaLibrary.ViewImage.html">
							<img src="img/products/genoise-thumb.jpg" alt="uploaded image"
								 class="list-media-thumbnail responsive border-0" />
						</a>
						<div class="d-flex flex-grow-1 min-width-zero">
							<div
								class="card-body align-self-center d-flex flex-column justify-content-between min-width-zero align-items-lg-center">
								<a href="Apps.MediaLibrary.ViewImage.html" class="w-100">
									<p class="list-item-heading mb-1 truncate">genoise-thumb.jpg</p>
								</a>
								<p class="mb-1 text-muted text-small w-100 truncate">16.09.2018 14:35</p>
							</div>
							<div class="pl-1 align-self-center">
								<label class="custom-control custom-checkbox mb-0">
									<input type="checkbox" class="custom-control-input">
									<span class="custom-control-label"></span>
								</label>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xxl-4 col-xl-6 col-12">
					<div class="card d-flex flex-row mb-4 media-thumb-container">
						<a class="d-flex align-self-center" href="Apps.MediaLibrary.ViewImage.html">
							<img src="img/products/gingerbread-thumb.jpg" alt="uploaded image"
								 class="list-media-thumbnail responsive border-0" />
						</a>
						<div class="d-flex flex-grow-1 min-width-zero">
							<div
								class="card-body align-self-center d-flex flex-column justify-content-between min-width-zero align-items-lg-center">
								<a href="Apps.MediaLibrary.ViewImage.html" class="w-100">
									<p class="list-item-heading mb-1 truncate">gingerbread-thumb.jpg</p>
								</a>
								<p class="mb-1 text-muted text-small w-100 truncate">16.09.2018 14:38</p>
							</div>
							<div class="pl-1 align-self-center">
								<label class="custom-control custom-checkbox mb-0">
									<input type="checkbox" class="custom-control-input">
									<span class="custom-control-label"></span>
								</label>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xxl-4 col-xl-6 col-12">
					<div class="card d-flex flex-row mb-4 media-thumb-container">
						<a class="d-flex align-self-center" href="Apps.MediaLibrary.ViewImage.html">
							<img src="img/products/magdalena-thumb.jpg" alt="uploaded image"
								 class="list-media-thumbnail responsive border-0" />
						</a>
						<div class="d-flex flex-grow-1 min-width-zero">
							<div
								class="card-body align-self-center d-flex flex-column justify-content-between min-width-zero align-items-lg-center">
								<a href="Apps.MediaLibrary.ViewImage.html" class="w-100">
									<p class="list-item-heading mb-1 truncate">magdalena-thumb.jpg</p>
								</a>
								<p class="mb-1 text-muted text-small w-100 truncate">16.09.2018 14:39</p>
							</div>
							<div class="pl-1 align-self-center">
								<label class="custom-control custom-checkbox mb-0">
									<input type="checkbox" class="custom-control-input">
									<span class="custom-control-label"></span>
								</label>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xxl-4 col-xl-6 col-12">
					<div class="card d-flex flex-row mb-4 media-thumb-container">
						<a class="d-flex align-self-center" href="Apps.MediaLibrary.ViewImage.html">
							<img src="img/products/parkin-thumb.jpg" alt="uploaded image"
								 class="list-media-thumbnail responsive border-0" />
						</a>
						<div class="d-flex flex-grow-1 min-width-zero">
							<div
								class="card-body align-self-center d-flex flex-column justify-content-between min-width-zero align-items-lg-center">
								<a href="Apps.MediaLibrary.ViewImage.html" class="w-100">
									<p class="list-item-heading mb-1 truncate">parkin-thumb.jpg</p>
								</a>
								<p class="mb-1 text-muted text-small w-100 truncate">16.09.2018 14:39</p>
							</div>

							<div class="pl-1 align-self-center">
								<label class="custom-control custom-checkbox mb-0">
									<input type="checkbox" class="custom-control-input">
									<span class="custom-control-label"></span>
								</label>
							</div>
						</div>
					</div>
				</div>


			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12 col-xl-8 offset-0 offset-xl-4">
			<nav class="mt-4 mb-3">
				<ul class="pagination justify-content-center mb-0">
					<li class="page-item ">
						<a class="page-link first" href="#">
							<i class="simple-icon-control-start"></i>
						</a>
					</li>
					<li class="page-item ">
						<a class="page-link prev" href="#">
							<i class="simple-icon-arrow-left"></i>
						</a>
					</li>
					<li class="page-item active">
						<a class="page-link" href="#">1</a>
					</li>
					<li class="page-item ">
						<a class="page-link" href="#">2</a>
					</li>
					<li class="page-item">
						<a class="page-link" href="#">3</a>
					</li>
					<li class="page-item ">
						<a class="page-link next" href="#" aria-label="Next">
							<i class="simple-icon-arrow-right"></i>
						</a>
					</li>
					<li class="page-item ">
						<a class="page-link last" href="#">
							<i class="simple-icon-control-end"></i>
						</a>
					</li>
				</ul>
			</nav>

		</div>
	</div>
</div>
