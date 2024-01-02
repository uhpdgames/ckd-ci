<?php if ($isMobile): ?>
	<div class="toolbar nav">
		<ul>
			<li><a href="/" trang title="title" class="nav__link"> <img src="<?= image_default('iconhome') ?>"
																		alt="<?= getLang('trangchu') ?>"> <br>
					<span><?= getLang('trangchu') ?></span> </a></li>
			<li><a href="san-pham" title="title" class="nav__link"> <img src="<?= image_default('iconshop') ?>"
																		 alt="shop"> <br> <span>Shop</span> </a></li>
			<li><a id="giohang" href="gio-hang" title="title " class="nav__link"> <span> <img
							src="<?= image_default('shopping-card') ?>" alt="shop"> </span> <br>
					<span><?= getLang('giohang') ?></span> </a></li>
			<li><a class="nav__link" href="https://zalo.me/<?= preg_replace('/[^0-9]/', '', $optsetting['zalo']); ?>"
				   title="title" target="_blank"> <!-- <img src="assets/images/zalom.png" alt="shop"> --> <img
						src="<?= image_default('iconzalo') ?>" alt="shop"> <br> <span>Zalo</span> </a></li>
			<li><a id="chatfb" class="nav__link" href="https://www.facebook.com/Bluepinkckdguaranteed" title="title" target="_blank">
					<img src="<?= image_default('iconmess') ?>" alt="shop"> <br> <span>Mess</span> </a></li>
		</ul>
	</div>
<?php
endif;
?>
<?php $this->load->view('all/footer_pc'); ?>
<?php $this->load->view('all/footer_mb'); ?>
<!--KHÔNG THAY ĐỔI NỘI DUNG BÊN DƯỚI-->
<?php if ($isMobile) : echo link_tag(site_url() . 'assets/css/mobile.css?v=' . time()); ?>
<?php endif; ?>
<div id="modal"></div>
<div id="overlay" class="overlay-addon"></div>
<div class="scrollToTop">
	<div
	onclick="_scrollTo()" class="gototop">
	</div>
</div>

<script type="text/javascript" src="<?= MYSITE ?>assets/bootstrap/bootstrap.js?v=<?= time() ?>"></script>

<script defer type="text/javascript">
	<?= htmlspecialchars_decode($setting['bodyjs']) ?>
</script>

<style>
	.star-rating {
		white-space: nowrap;
	}
	.star-rating [type="radio"] {
		appearance: none;
	}
	.star-rating i {
		font-size: 1.2em;
		transition: 0.3s;
	}

	.star-rating label:is(:hover) i {
		transform: scale(1.25)
		color: #faec1b;
		animation: jump 0.5s  calc(0.3s + (3 - 1) * 0.15s) alternate infinite;
		cursor: pointer;
	}
	.star-rating label i.active {
		color: #FDE16D;
		text-shadow: 0 0 2px #ffffff, 0 0 0px #ffee58;
		font-size: .7em;
	}
	.star-rating label i:not(.active) {
		opacity: .5;
		font-size: .7em;
	}

	@keyframes jump {
		0%,
		50% {
			transform: translatey(0) scale(1.35);
		}
		100% {
			transform: translatey(-15%) scale(1.35);
		}
	}



	@charset "UTF-8";
.rating-input > label, .rating-score > .rating-score-item {
  display: inline-block;
}
.rating-input > label:after, .rating-score > .rating-score-item:after {
  font-family: "FontAwesome";
  font-size: 1em;
  color: #ffc600;
}

.rating-input:hover > input + label:hover:after, .rating-input:hover > input + label:hover ~ input + label:after, .rating-input > input:checked ~ label:after, .rating-score[data-rating="4.5"] > .rating-score-item:nth-child(-n+4):after, .rating-score[data-rating="3.5"] > .rating-score-item:nth-child(-n+3):after, .rating-score[data-rating="2.5"] > .rating-score-item:nth-child(-n+2):after, .rating-score[data-rating="1.5"] > .rating-score-item:nth-child(-n+1):after, .rating-score[data-rating="0.5"] > .rating-score-item:nth-child(-n+0):after, .rating-score[data-rating="5"] > .rating-score-item:nth-child(-n+5):after, .rating-score[data-rating="4"] > .rating-score-item:nth-child(-n+4):after, .rating-score[data-rating="3"] > .rating-score-item:nth-child(-n+3):after, .rating-score[data-rating="2"] > .rating-score-item:nth-child(-n+2):after, .rating-score[data-rating="1"] > .rating-score-item:nth-child(-n+1):after {
  content: "\f005";
}

.rating-score[data-rating="4.5"] > .rating-score-item:nth-child(5):after, .rating-score[data-rating="3.5"] > .rating-score-item:nth-child(4):after, .rating-score[data-rating="2.5"] > .rating-score-item:nth-child(3):after, .rating-score[data-rating="1.5"] > .rating-score-item:nth-child(2):after, .rating-score[data-rating="0.5"] > .rating-score-item:nth-child(1):after {
  content: "\f005";
}

.rating-input:hover > input + label:after, .rating-input > label:after, .rating-score > .rating-score-item:after {
  content: "\f005";
}

.rating-score {
  display: inline-flex;
  flex-direction: row;
  align-items: flex-start;
  margin: 0;
  padding: 0;
}
.rating-input {
  border: none;
  display: inline-flex;
  flex-direction: row-reverse;
  justify-content: flex-end;
  margin: 0;
  padding: 0;
}
.rating-input > input {
  display: none;
}
</style>
