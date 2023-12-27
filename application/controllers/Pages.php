<?php
if (!defined('BASEPATH')) exit('BẠN KHÔNG CÓ QUYỀN TRUY CẬP VÀO TRANG NÀY');

class Pages extends MY_Controller
{
	protected $com = '';

	function __construct()
	{
		parent::__construct();
	}

	public function view($page = 'static')
	{
	/*	$com = $this->uri->segment(1);//cate
		if (!file_exists(SHAREDVIEW . 'sites/' . $page . '.php')) {
			show_404();
		}
		$this->data['url'] = $com;
		$this->data['template'] = 'sites/' . $page;
		$this->load->view('template', $this->data);
		return;*/


		$com = $this->uri->segment(1);//cate

		$template = $title_crumb = $type = $source = '';

		$this->data['url'] = $com;


		//var_dump($com);

		/* Tối ưu link */
		$requick = array(
			/* Sản phẩm */
			array("tbl" => "product_list", "field" => "idl", "source" => "product", "com" => "san-pham", "type" => "san-pham"),
			array("tbl" => "product", "field" => "id", "source" => "product", "com" => "san-pham", "type" => "san-pham", 'menu' => true),

			array("tbl" => "news", "field" => "id_thuonghieu", "source" => "news", "com" => "thuong-hieu", "type" => "thuong-hieu", 'menu' => true),
			array("tbl" => "news", "field" => "id_dong", "source" => "news", "com" => "dong", "type" => "dong", 'menu' => true),

			array("tbl" => "news_list", "field" => "idl", "source" => "news", "com" => "tin-tuc", "type" => "tin-tuc"),
			array("tbl" => "news", "field" => "id", "source" => "news", "com" => "tin-tuc", "type" => "tin-tuc", 'menu' => true),
			array("tbl" => "news", "field" => "id", "source" => "news", "com" => "su-kien", "type" => "su-kien", 'menu' => true),
			array("tbl" => "news", "field" => "id", "source" => "news", "com" => "thong-bao", "type" => "thong-bao", 'menu' => false),
			array("tbl" => "news", "field" => "id", "source" => "news", "com" => "chinh-sach", "type" => "chinh-sach", 'menu' => false),
			array("tbl" => "news", "field" => "id", "source" => "news", "com" => "bai-viet-thuong-hieu", "type" => "bai-viet-thuong-hieu", 'menu' => false),
			array("tbl" => "news", "field" => "id", "source" => "news", "com" => "ho-tro", "type" => "ho-tro", 'menu' => false),
			array("tbl" => "static", "field" => "id", "source" => "static", "com" => "gioi-thieu", "type" => "gioi-thieu", 'menu' => true),
			array("tbl" => "static", "field" => "id", "source" => "contact", "com" => "lien-he", "type" => "lien-he", 'menu' => true),
		);
		if ($com != 'tim-kiem' && $com != 'account' && $com != 'sitemap') {
			foreach ($requick as $k => $v) {
				$url_tbl = (isset($v['tbl']) && $v['tbl'] != '') ? $v['tbl'] : '';
				$url_tbltag = (isset($v['tbltag']) && $v['tbltag'] != '') ? $v['tbltag'] : '';
				$url_type = (isset($v['type']) && $v['type'] != '') ? $v['type'] : '';
				$url_field = (isset($v['field']) && $v['field'] != '') ? $v['field'] : '';
				$url_com = (isset($v['com']) && $v['com'] != '') ? $v['com'] : '';

				if ($url_tbl != '' && $url_tbl != 'static' && $url_tbl != 'photo') {
					$row = $this->data['d']->rawQueryOne("select id from #_$url_tbl where $this->sluglang = ? and type = ? and hienthi > 0 limit 0,1", array($com, $url_type));

					if (isset($row['id']) && $row['id'] > 0) {
						$_GET[$url_field] = $row['id'];
						$com = $url_com;
						$this->com = $url_com;

						break;
					}
				}
			}
		}

		/* Switch coms */
		switch ($com) {
			/*case 'lien-he':
				$source = "contact";
				$template = "contact/contact";
				$type = $com;
				$title_crumb = getLang('lienhe');
				break;

			case 'gioi-thieu':
				$source = "static";
				$template = "static/static";
				$type = $com;
				$title_crumb = getLang('gioithieu');
				break;

			case 'review':
				$source = "news";
				$template = "news/review";
				$type = $com;
				$title_crumb = getLang('review');
				break;

			case 'tin-tuc':
				$source = "news";
				$template = isset($_GET['id']) ? "news/news_detail" : "news/news";
				$type = $com;
				$title_crumb = getLang('tintuc');
				break;

			case 'su-kien':
				$source = "news";
				$template = isset($_GET['id']) ? "news/news_detail" : "news/news";
				$type = $com;
				$title_crumb = getLang('sukien');
				break;

			case 'thong-bao':
			case 'chinh-sach':
			case 'bai-viet-thuong-hieu':
			case 'ho-tro':
				$source = "news";
				$template = isset($_GET['id']) ? "news/news_detail" : "";
				$type = $com;
				$title_crumb = null;
				break;*/

			case 'san-pham':
				$source = "product";
				$type = $com;
				$title_crumb = getLang('sanpham');
				break;
			case 'tot-nhat':
				$source = "product";
				$type = 'san-pham';
				$title_crumb = getLang('totnhat');
				break;
			case 'khuyen-mai':
				$source = "product";
				$type = 'san-pham';
				$title_crumb = getLang('sanphamkhuyenmai');
				break;
			case 'moi':
				$source = "product";
				$template = "product/product";
				$type = 'san-pham';
				$title_crumb = getLang('moi');
				break;
			case 'thuong-hieu':
				$source = "product";
				$type = 'san-pham';
				$title_crumb = getLang('thuonghieu');
				break;
			case 'dong':
				$source = "product";
				$type = 'san-pham';
				$title_crumb = getLang('dong');
				break;

			case 'tim-kiem':
				$source = "product";//"search";
				$template = "product/product";
				$title_crumb = getLang('timkiem');
				break;

		/*	case 'gio-hang':
				$source = "order";
				$template = 'order/order';
				$title_crumb = getLang('giohang');
				break;*/


			default:

				if (!file_exists(SHAREDVIEW . 'sites/' . $page . '.php')) {
					show_404();
				}
				$this->data['template'] = 'sites/' . $page;
				$this->load->view('template', $this->data);
				return;
		}


		$this->data['source'] = $source;
		$this->data['template'] = $template;
		$this->data['title_crumb'] = $title_crumb;
		$this->data['type'] = $type;

		switch ($source){
			case 'product':$this->product_init();break;
		}

	}

	private function request_init()
	{
		$com = $this->uri->segment(1);//cate
		//request
		@$id = getRequest('id');
		@$idl = getRequest('idl');
		@$idc = getRequest('idc');
		@$idi = getRequest('idi');
		@$ids = getRequest('ids');
		@$idb = getRequest('idb');
		@$id_thuonghieu = getRequest('id_thuonghieu');
		@$id_dong = getRequest('id_dong');
		@$isPromotion = getRequest('khuyen_mai');

		$this->data['id'] = !empty($id) ? $id : '';
		$this->data['idl'] = !empty($idl) ? $idl : '';
		$this->data['idc'] = !empty($idc) ? $idc : '';
		$this->data['idi'] = !empty($idi) ? $idi : '';
		$this->data['ids'] = !empty($ids) ? $ids : '';
		$this->data['idb'] = !empty($idb) ? $idb : '';
		$this->data['id_thuonghieu'] = !empty($id_thuonghieu) ? $id_thuonghieu : '';
		$this->data['id_dong'] = !empty($id_dong) ? $id_dong : '';
		$this->data['isPromotion'] = !empty($isPromotion) ? $isPromotion : '';
		$this->data['lang'] = $this->current_lang;
	}


    private function product_init()
    {
        $this->mydata = $this->data;

        $com = $this->uri->segment(2);
        $cate = $this->uri->segment(1);


        $this->mydata['url'] = $cate;

        if ($cate != 'san-pham') {
            $com = $this->uri->segment(1);
        }


        $sluglang = $this->sluglang;

        $requick = array(

            array("tbl" => "product_list", "field" => "idl", "source" => "product", "com" => "san-pham", "type" => "san-pham"),
            array("tbl" => "product", "field" => "id", "source" => "product", "com" => "san-pham", "type" => "san-pham", 'menu' => true),
            array("tbl" => "news", "field" => "id_thuonghieu", "source" => "news", "com" => "thuong-hieu", "type" => "thuong-hieu", 'menu' => true),
            array("tbl" => "news", "field" => "id_dong", "source" => "news", "com" => "dong", "type" => "dong", 'menu' => true),
            array("tbl" => "news_list", "field" => "idl", "source" => "news", "com" => "tin-tuc", "type" => "tin-tuc"),
            array("tbl" => "news", "field" => "id", "source" => "news", "com" => "tin-tuc", "type" => "tin-tuc", 'menu' => true),
            array("tbl" => "news", "field" => "id", "source" => "news", "com" => "su-kien", "type" => "su-kien", 'menu' => true),
            array("tbl" => "news", "field" => "id", "source" => "news", "com" => "thong-bao", "type" => "thong-bao", 'menu' => false),
            array("tbl" => "news", "field" => "id", "source" => "news", "com" => "chinh-sach", "type" => "chinh-sach", 'menu' => false),
            array("tbl" => "news", "field" => "id", "source" => "news", "com" => "bai-viet-thuong-hieu", "type" => "bai-viet-thuong-hieu", 'menu' => false),
            array("tbl" => "news", "field" => "id", "source" => "news", "com" => "ho-tro", "type" => "ho-tro", 'menu' => false),
            array("tbl" => "static", "field" => "id", "source" => "static", "com" => "gioi-thieu", "type" => "gioi-thieu", 'menu' => true),
            array("tbl" => "static", "field" => "id", "source" => "contact", "com" => "lien-he", "type" => "lien-he", 'menu' => true),
        );


        foreach ($requick as $v) {
            $url_tbl = (isset($v['tbl']) && $v['tbl'] != '') ? $v['tbl'] : '';
            //$url_tbltag = (isset($v['tbltag']) && $v['tbltag'] != '') ? $v['tbltag'] : '';
            $url_type = (isset($v['type']) && $v['type'] != '') ? $v['type'] : '';
            $url_field = (isset($v['field']) && $v['field'] != '') ? $v['field'] : '';
            $url_com = (isset($v['com']) && $v['com'] != '') ? $v['com'] : '';

            if ($url_tbl != '' && $url_tbl != 'static' && $url_tbl != 'photo') {
                $row = $this->data['d']->rawQueryOne("select id from #_$url_tbl where $sluglang = ? and type = ? and hienthi > 0 limit 0,1", array($com, $url_type));

                if (isset($row['id']) && $row['id'] > 0) {
                    $_GET[$url_field] = $row['id'];
                    $com = $url_com;

                    break;
                }
            }
        }


        $this->mydata['source'] = 'product';
        $this->mydata['title_crumb'] = getLang('sanpham');
        $this->mydata['breadcr'] = '';


        //request
        @$id = htmlspecialchars(getRequest('id'));
        @$idl = htmlspecialchars(getRequest('idl'));
        @$idc = htmlspecialchars(getRequest('idc'));
        @$idi = htmlspecialchars(getRequest('idi'));
        @$ids = htmlspecialchars(getRequest('ids'));
        @$idb = htmlspecialchars(getRequest('idb'));
        @$id_thuonghieu = htmlspecialchars(getRequest('id_thuonghieu'));
        @$id_dong = htmlspecialchars(getRequest('id_dong'));
        @$isPromotion = htmlspecialchars(getRequest('khuyen_mai'));


        $this->mydata['id'] = !empty($id) ? $id : '';
        $this->mydata['idl'] = !empty($idl) ? $idl : '';
        $this->mydata['idc'] = !empty($idc) ? $idc : '';
        $this->mydata['idi'] = !empty($idi) ? $idi : '';
        $this->mydata['ids'] = !empty($ids) ? $ids : '';
        $this->mydata['idb'] = !empty($idb) ? $idb : '';
        $this->mydata['id_thuonghieu'] = !empty($id_thuonghieu) ? $id_thuonghieu : '';
        $this->mydata['id_dong'] = !empty($id_dong) ? $id_dong : '';
        $this->mydata['isPromotion'] = !empty($isPromotion) ? $isPromotion : '';
        $this->mydata['lang'] = $this->current_lang;


        $data = $this->data;
        $d = $data['d'];
        $lang = $this->current_lang;
        $type = $this->com;
        $seo = $data['seo'];
        $seolang = $data['seolang'];
        $func = $data['func'];
        $config_base = site_url();

        $optsetting = $data['optsetting'];
        $title_crumb = $data['title_crumb'];

        $this->mydata['template'] = isset($_GET['id']) ? "page/product/product_detail" : "page/product/product";

        if ($id != '') {

            /* Lấy sản phẩm detail */
            $row_detail = $d->rawQueryOne("select id_thuonghieu, nhaplieu_daban, gift, thetich, hethang, type, id, ten$lang as ten, tenkhongdauvi, tenkhongdauen, mota$lang as mota, noidung$lang as noidung,noidungthanhphan$lang as noidungthanhphan, masp, luotxem, id_brand, id_mau, id_size, id_list, id_cat, id_item, id_sub, id_tags, photo, options, giakm, giamoi, gia, soluong from #_product where id = ? and type = ? and hienthi > 0 $isPromotion limit 0,1", array($id, $type));


            if (isset($_POST['submit-contact'])) {
                if (true) {
                    $data = array();

                    if (isset($_FILES["file"])) {
                        $file_name = $func->uploadName($_FILES["file"]["name"]);
                        if ($photo = $func->uploadImage("file", 'jpg|png|gif|JPG|PNG|GIF|WEBP|webp', UPLOAD_PRODUCT_L, $file_name)) {
                            $data['photo'] = $photo;
                        }
                    }
                    $data['link_video'] = (isset($_POST['link_video']) && $_POST['link_video'] != '') ? htmlspecialchars($_POST['link_video']) : 0;
                    $data['tenvi'] = (isset($_POST['tenvi']) && $_POST['tenvi'] != '') ? htmlspecialchars($_POST['tenvi']) : '';
                    $data['motavi'] = (isset($_POST['motavi']) && $_POST['motavi'] != '') ? htmlspecialchars($_POST['motavi']) : '';
                    $data['ngaytao'] = time();
                    $data['stt'] = 1;
                    $data['hienthi'] = 1;
                    $data['kind'] = 'man';
                    $data['com'] = 'product';
                    $data['type'] = $type;
                    $data['val'] = 'video';
                    $data['id_photo'] = $id;
                    $data['id_member'] = $_SESSION[$this->data['login_member']]['id'];

                    if ($d->insert('gallery', $data)) {
                        transfer("Gửi đánh giá thành công. Xin cảm ơn.", getCurrentPageURL());
                    } else {
                        transfer("Gửi đánh giá thất bại. Vui lòng thử lại sau.", getCurrentPageURL(), false);
                    }
                }
            }

            /* Cập nhật lượt xem */
            $data_luotxem['luotxem'] = $row_detail['luotxem'] + 1;
            $d->where('id', $row_detail['id']);
            $d->update('product', $data_luotxem);

            /* Lấy tags */
            if ($row_detail['id_tags']) $pro_tags = $d->rawQuery("select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen from #_tags where id in (" . $row_detail['id_tags'] . ") and type='" . $type . "'");

            /* Lấy thương hiệu */
            $pro_brand = $d->rawQuery("select ten$lang as ten, tenkhongdauvi, tenkhongdauen, id from #_product_brand where id = ? and type = ? and hienthi > 0", array($row_detail['id_brand'], $type));

            /* Lấy màu */
            if ($row_detail['id_mau']) $mau = $d->rawQuery("select loaihienthi, photo, mau, id from #_product_mau where type='" . $type . "' and find_in_set(id,'" . $row_detail['id_mau'] . "') and hienthi > 0 order by stt,id desc");

            /* Lấy size */
            if ($row_detail['id_size']) $size = $d->rawQuery("select id, ten$lang as ten from #_product_size where type='" . $type . "' and find_in_set(id,'" . $row_detail['id_size'] . "') and hienthi > 0 order by stt,id desc");

            /* Lấy cấp 1 */
            $pro_list = $d->rawQueryOne("select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen from #_product_list where id = ? and type = ? and hienthi > 0 limit 0,1", array($row_detail['id_list'], $type));

            /* Lấy cấp 2 */
            $pro_cat = $d->rawQueryOne("select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen from #_product_cat where id = ? and type = ? and hienthi > 0 limit 0,1", array($row_detail['id_cat'], $type));

            /* Lấy cấp 3 */
            $pro_item = $d->rawQueryOne("select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen from #_product_item where id = ? and type = ? and hienthi > 0 limit 0,1", array($row_detail['id_item'], $type));

            /* Lấy cấp 4 */
            $pro_sub = $d->rawQueryOne("select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen from #_product_sub where id = ? and type = ? and hienthi > 0 limit 0,1", array($row_detail['id_sub'], $type));

            /* Lấy hình ảnh con */
            $hinhanhsp = $d->rawQuery("select photo from #_gallery where id_photo = ? and com='product' and type = ? and kind='man' and val = ? and hienthi > 0 order by stt,id desc", array($row_detail['id'], $type, $type));

            /* Lấy sản phẩm cùng loại */
            $where = "id <> '" . $id . "' and id_list = '" . $row_detail['id_list'] . "' and type = '" . $type . "' and hienthi > 0";

            /* SEO */
            if (!empty($row_detail['photo'])) $seo->setSeo('photo:img', MYSITE  . UPLOAD_PRODUCT_L . $row_detail['photo']);

            $seoDB = $seo->getSeoDB($row_detail['id'], 'product', 'man', $row_detail['type']);
            $seo->setSeo('h1', $row_detail['ten']);
            if (!empty($seoDB['title' . $seolang])) $seo->setSeo('title', $seoDB['title' . $seolang]);
            else $seo->setSeo('title', $row_detail['ten']);
            if (!empty($seoDB['keywords' . $seolang])) $seo->setSeo('keywords', $seoDB['keywords' . $seolang]);
            if (!empty($seoDB['description' . $seolang])) $seo->setSeo('description', $seoDB['description' . $seolang]);
            $seo->setSeo('url', $func->getPageURL());
            $img_json_bar = (isset($row_detail['options']) && $row_detail['options'] != '') ? json_decode($row_detail['options'], true) : null;
            if ($img_json_bar == null || ($img_json_bar['p'] != $row_detail['photo'])) {
                $img_json_bar = $func->getImgSize($row_detail['photo'], UPLOAD_PRODUCT_L . $row_detail['photo']);
                $seo->updateSeoDB(json_encode($img_json_bar), 'product', $row_detail['id']);
            }
            if (is_array($img_json_bar) && count($img_json_bar) > 0) {
                $seo->setSeo('photo', $config_base . '/' . $img_json_bar['w'] . 'x' . $img_json_bar['h'] . 'x2/' . UPLOAD_PRODUCT_L . $row_detail['photo']);
                $seo->setSeo('photo:width', $img_json_bar['w']);
                $seo->setSeo('photo:height', $img_json_bar['h']);
                $seo->setSeo('photo:type', $img_json_bar['m']);
            }

            /* breadCrumbs */
            $breadcr = $this->data['breadcr'];
            if (!empty($this->com)) $breadcr->setBreadCrumbs($this->com, $this->mydata['title_crumb']);
            //if(isset($title_crumb) && $title_crumb != '') $breadcr->setBreadCrumbs($com,$title_crumb);
            if ($pro_list != null) $breadcr->setBreadCrumbs($this->com . '/' . $pro_list[$sluglang], $pro_list['ten']);
            /*if($pro_list != null) $breadcr->setBreadCrumbs($pro_list[$sluglang],$pro_list['ten']);
            if($pro_cat != null) $breadcr->setBreadCrumbs($pro_cat[$sluglang],$pro_cat['ten']);
            if($pro_item != null) $breadcr->setBreadCrumbs($pro_item[$sluglang],$pro_item['ten']);
            if($pro_sub != null) $breadcr->setBreadCrumbs($pro_sub[$sluglang],$pro_sub['ten']);*/

            if (!$this->data['isMobile']) $breadcr->setBreadCrumbs($this->com . '/' . $row_detail[$sluglang], $row_detail['ten']);
            $breadcrumbs = $breadcr->getBreadCrumbs();


            $curPage = !empty($_REQUEST['p']) ? $_REQUEST['p'] : 1;
            #if ($id > 0) $per_page = $optsetting['soluong_tin'];
            #else $per_page = $optsetting['soluong_tin'];

            $per_page = 5;

            $startpoint = ($curPage * $per_page) - $per_page;
            $limit_danhgia = " limit " . $startpoint . "," . $per_page;

            $where_danhgia = "id_photo = ? and com='product' and kind='man' and link_video > 0 and photo<>'' and hienthi > 0";
            $params_danhgia = array($row_detail['id']);
            $sqlNum = "select count(*) as 'num' from #_gallery where $where_danhgia";
            $count = $d->rawQueryOne($sqlNum, $params_danhgia);
            $total = $count['num'];
            $this->mydata['count_danhgia'] = @$total;
            $url = getCurrentPageURL();
            $paging_danhgia = $func->pagination($total, $per_page, $curPage, $url, '#box_binhluan');

            $this->mydata['paging_danhgia'] = $paging_danhgia;
            $danhgia = $d->rawQuery("select ngaytao, id,tenvi,motavi, photo, link_video, id_member from #_gallery where $where_danhgia order by ngaytao desc $limit_danhgia",$params_danhgia);

            $trungbinh = $d->rawQueryOne("select avg(link_video) as tb from #_gallery where photo<>'' and id_photo = ? and com='product' and type = ? and kind='man' and val = ? and hienthi > 0 order by stt,id desc", array($row_detail['id'], $type, 'video'));


            $sao1 = $d->rawQueryOne("select count(id) as dem from #_gallery where photo<>'' and id_photo = ? and com='product' and type = ? and kind='man' and val = ? and hienthi > 0 and link_video='1' order by stt,id desc", array($row_detail['id'], $type, 'video'));

            $sao2 = $d->rawQueryOne("select count(id) as dem from #_gallery where photo<>'' and id_photo = ? and com='product' and type = ? and kind='man' and val = ? and hienthi > 0 and link_video='2' order by stt,id desc", array($row_detail['id'], $type, 'video'));

            $sao3 = $d->rawQueryOne("select count(id) as dem from #_gallery where photo<>'' and id_photo = ? and com='product' and type = ? and kind='man' and val = ? and hienthi > 0 and link_video='3' order by stt,id desc", array($row_detail['id'], $type, 'video'));

            $sao4 = $d->rawQueryOne("select count(id) as dem from #_gallery where photo<>'' and id_photo = ? and com='product' and type = ? and kind='man' and val = ? and hienthi > 0 and link_video='4' order by stt,id desc", array($row_detail['id'], $type, 'video'));

            $sao5 = $d->rawQueryOne("select count(id) as dem from #_gallery where photo<>'' and id_photo = ? and com='product' and type = ? and kind='man' and val = ? and hienthi > 0 and link_video='5' order by stt,id desc", array($row_detail['id'], $type, 'video'));

            $this->mydata['title_crumb'] = '';
            $this->mydata['title_cat'] = $row_detail['ten'];

        } else if ($id_dong != '') {
            /* Lấy cấp 1 detail */
            $row_detail = $d->rawQueryOne("select id,type, ten$lang as ten, tenkhongdauvi, tenkhongdauen, noidung$lang as noidung, photo, options from #_news where id = ? and type = ? and hienthi > 0 limit 0,1", array($id_dong, 'dong'));

            /* SEO */
            if (!empty($row_detail['photo'])) $seo->setSeo('photo:img', MYSITE  . UPLOAD_PRODUCT_L . $row_detail['photo']);

            $title_cat = $row_detail['ten'];
            $this->mydata['breadcr'] = create_BreadCrumbs($this->com, $title_cat);
            $noidung_cap = $row_detail['noidung'];

            $seoDB = $seo->getSeoDB($row_detail['id'], 'news', 'man', $row_detail['type']);
            $seo->setSeo('h1', $row_detail['ten']);
            if (!empty($seoDB['title' . $seolang])) $seo->setSeo('title', $seoDB['title' . $seolang]);
            else $seo->setSeo('title', $row_detail['ten']);
            if (!empty($seoDB['keywords' . $seolang])) $seo->setSeo('keywords', $seoDB['keywords' . $seolang]);
            if (!empty($seoDB['description' . $seolang])) $seo->setSeo('description', $seoDB['description' . $seolang]);
            $seo->setSeo('url', $func->getPageURL());
            $img_json_bar = (isset($row_detail['options']) && $row_detail['options'] != '') ? json_decode($row_detail['options'], true) : null;
            if ($img_json_bar == null || ($img_json_bar['p'] != $row_detail['photo'])) {
                $img_json_bar = $func->getImgSize($row_detail['photo'], UPLOAD_NEWS_L . $row_detail['photo']);
                $seo->updateSeoDB(json_encode($img_json_bar), 'news', $row_detail['id']);
            }
            if (is_array($img_json_bar) && count($img_json_bar) > 0) {
                $seo->setSeo('photo', $config_base . '/' . $img_json_bar['w'] . 'x' . $img_json_bar['h'] . 'x2/' . UPLOAD_NEWS_L . $row_detail['photo']);
                $seo->setSeo('photo:width', $img_json_bar['w']);
                $seo->setSeo('photo:height', $img_json_bar['h']);
                $seo->setSeo('photo:type', $img_json_bar['m']);
            }

            /* Lấy sản phẩm */
            $where = "";
            $where = "id_dong = '" . $id_dong . "' and type = '" . $type . "' and hienthi > 0";
            //$params = array($id_dong,$type);

            /* breadCrumbs */
            /*if(isset($title_crumb) && $title_crumb != '') $breadcr->setBreadCrumbs($com,$title_crumb);
            if($row_detail != null) $breadcr->setBreadCrumbs($row_detail[$sluglang],$pro_list['ten']);
            $breadcrumbs = $breadcr->getBreadCrumbs();*/
            $this->mydata['title_crumb'] = $title_cat;
            $this->mydata['breadcr'] = create_BreadCrumbs($this->com, $title_cat);
        } else if ($id_thuonghieu != '') {
            /* Lấy cấp 1 detail */
            $row_detail = $d->rawQueryOne("select id,type, ten$lang as ten, tenkhongdauvi, tenkhongdauen, noidung$lang as noidung, photo, options from #_news where id = ? and type = ? and hienthi > 0 limit 0,1", array($id_thuonghieu, 'thuong-hieu'));

            /* SEO */
            if (!empty($row_detail['photo'])) $seo->setSeo('photo:img', MYSITE  . UPLOAD_PRODUCT_L . $row_detail['photo']);

            $title_cat = $row_detail['ten'];
            $this->mydata['breadcr'] = create_BreadCrumbs($this->com, $title_cat);
            $noidung_cap = $row_detail['noidung'];

            $seoDB = $seo->getSeoDB($row_detail['id'], 'news', 'man', $row_detail['type']);
            $seo->setSeo('h1', $row_detail['ten']);
            if (!empty($seoDB['title' . $seolang])) $seo->setSeo('title', $seoDB['title' . $seolang]);
            else $seo->setSeo('title', $row_detail['ten']);
            if (!empty($seoDB['keywords' . $seolang])) $seo->setSeo('keywords', $seoDB['keywords' . $seolang]);
            if (!empty($seoDB['description' . $seolang])) $seo->setSeo('description', $seoDB['description' . $seolang]);
            $seo->setSeo('url', $func->getPageURL());
            $img_json_bar = (isset($row_detail['options']) && $row_detail['options'] != '') ? json_decode($row_detail['options'], true) : null;
            if ($img_json_bar == null || ($img_json_bar['p'] != $row_detail['photo'])) {
                $img_json_bar = $func->getImgSize($row_detail['photo'], UPLOAD_NEWS_L . $row_detail['photo']);
                $seo->updateSeoDB(json_encode($img_json_bar), 'news', $row_detail['id']);
            }
            if (is_array($img_json_bar) && count($img_json_bar) > 0) {
                $seo->setSeo('photo', $config_base . '/' . $img_json_bar['w'] . 'x' . $img_json_bar['h'] . 'x2/' . UPLOAD_NEWS_L . $row_detail['photo']);
                $seo->setSeo('photo:width', $img_json_bar['w']);
                $seo->setSeo('photo:height', $img_json_bar['h']);
                $seo->setSeo('photo:type', $img_json_bar['m']);
            }

            /* Lấy sản phẩm */
            $where = "id_thuonghieu = '" . $id_thuonghieu . "' and type = '" . $type . "' and hienthi > 0";
            //$params = array($id_thuonghieu,$type);

            /* breadCrumbs */
            /*if(isset($title_crumb) && $title_crumb != '') $breadcr->setBreadCrumbs($com,$title_crumb);
            if($row_detail != null) $breadcr->setBreadCrumbs($row_detail[$sluglang],$pro_list['ten']);
            $breadcrumbs = $breadcr->getBreadCrumbs();*/
            $this->mydata['title_crumb'] = $title_cat;
            $this->mydata['breadcr'] = create_BreadCrumbs($this->com, $title_cat);
        } else if ($idl != '') {
            /* Lấy cấp 1 detail */
            $pro_list = $d->rawQueryOne("select id, ten$lang as ten,noidung$lang as noidung, tenkhongdauvi, tenkhongdauen, type, photo, options from #_product_list where id = ? and type = ? limit 0,1", array($idl, $type));

            /* SEO */
            if (!empty($row_detail['photo'])) $seo->setSeo('photo:img', MYSITE  . UPLOAD_PRODUCT_L . $row_detail['photo']);

            $title_cat = $pro_list['ten'];
            $this->mydata['breadcr'] = create_BreadCrumbs($this->com, $title_cat);
            $noidung_cap = $pro_list['noidung'];

            $seoDB = $seo->getSeoDB($pro_list['id'], 'product', 'man_list', $pro_list['type']);
            $seo->setSeo('h1', $pro_list['ten']);
            if (!empty($seoDB['title' . $seolang])) $seo->setSeo('title', $seoDB['title' . $seolang]);
            else $seo->setSeo('title', $pro_list['ten']);
            if (!empty($seoDB['keywords' . $seolang])) $seo->setSeo('keywords', $seoDB['keywords' . $seolang]);
            if (!empty($seoDB['description' . $seolang])) $seo->setSeo('description', $seoDB['description' . $seolang]);
            $seo->setSeo('url', $func->getPageURL());
            $img_json_bar = (isset($pro_list['options']) && $pro_list['options'] != '') ? json_decode($pro_list['options'], true) : null;
            if ($img_json_bar == null || ($img_json_bar['p'] != $pro_list['photo'])) {
                $img_json_bar = $func->getImgSize($pro_list['photo'], UPLOAD_PRODUCT_L . $pro_list['photo']);
                $seo->updateSeoDB(json_encode($img_json_bar), 'product_list', $pro_list['id']);
            }
            if (is_array($img_json_bar) && count($img_json_bar) > 0) {
                $seo->setSeo('photo', $config_base . '/' . $img_json_bar['w'] . 'x' . $img_json_bar['h'] . 'x2/' . UPLOAD_PRODUCT_L . $pro_list['photo']);
                $seo->setSeo('photo:width', $img_json_bar['w']);
                $seo->setSeo('photo:height', $img_json_bar['h']);
                $seo->setSeo('photo:type', $img_json_bar['m']);
            }

            /* Lấy sản phẩm */
            $where = "id_list = '" . $idl . "' and type = '" . $type . "' and hienthi > 0  order by stt, id desc";

            /* breadCrumbs */
            /*if(isset($title_crumb) && $title_crumb != '') $breadcr->setBreadCrumbs($com,$title_crumb);
            if($pro_list != null) $breadcr->setBreadCrumbs($pro_list[$sluglang],$pro_list['ten']);
            $breadcrumbs = $breadcr->getBreadCrumbs();*/
            $this->mydata['title_crumb'] = $title_cat;
            $this->mydata['breadcr'] = create_BreadCrumbs($this->com, $title_cat);
        } else if ($idc != '') {
            /* Lấy cấp 2 detail */
            $pro_cat = $d->rawQueryOne("select id, id_list, ten$lang as ten,noidung$lang as noidung, tenkhongdauvi, tenkhongdauen, type, photo, options from #_product_cat where id = ? and type = ? limit 0,1", array($idc, $type));

            /* Lấy cấp 1 */
            $pro_list = $d->rawQueryOne("select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen from #_product_list where id = ? and type = ? limit 0,1", array($pro_cat['id_list'], $type));

            /* Lấy sản phẩm */
            $where = "id_cat = ? and type = ? and hienthi > 0  order by stt, id desc";
            $params = array($idc, $type);

            /* SEO */
            if (!empty($row_detail['photo'])) $seo->setSeo('photo:img', MYSITE  . UPLOAD_PRODUCT_L . $row_detail['photo']);

            $title_cat = $pro_cat['ten'];
            $this->mydata['breadcr'] = create_BreadCrumbs($this->com, $title_cat);
            $noidung_cap = $pro_cat['noidung'];

            $seoDB = $seo->getSeoDB($pro_cat['id'], 'product', 'man_cat', $pro_cat['type']);
            $seo->setSeo('h1', $pro_cat['ten']);
            if (!empty($seoDB['title' . $seolang])) $seo->setSeo('title', $seoDB['title' . $seolang]);
            else $seo->setSeo('title', $pro_cat['ten']);
            if (!empty($seoDB['keywords' . $seolang])) $seo->setSeo('keywords', $seoDB['keywords' . $seolang]);
            if (!empty($seoDB['description' . $seolang])) $seo->setSeo('description', $seoDB['description' . $seolang]);
            $seo->setSeo('url', $func->getPageURL());
            $img_json_bar = (isset($pro_cat['options']) && $pro_cat['options'] != '') ? json_decode($pro_cat['options'], true) : null;
            if ($img_json_bar == null || ($img_json_bar['p'] != $pro_cat['photo'])) {
                $img_json_bar = $func->getImgSize($pro_cat['photo'], UPLOAD_PRODUCT_L . $pro_cat['photo']);
                $seo->updateSeoDB(json_encode($img_json_bar), 'product_cat', $pro_cat['id']);
            }
            if (is_array($img_json_bar) && count($img_json_bar) > 0) {
                $seo->setSeo('photo', $config_base . '/' . $img_json_bar['w'] . 'x' . $img_json_bar['h'] . 'x2/' . UPLOAD_PRODUCT_L . $pro_cat['photo']);
                $seo->setSeo('photo:width', $img_json_bar['w']);
                $seo->setSeo('photo:height', $img_json_bar['h']);
                $seo->setSeo('photo:type', $img_json_bar['m']);
            }

            /* breadCrumbs */
            /*if(isset($title_crumb) && $title_crumb != '') $breadcr->setBreadCrumbs($com,$title_crumb);
            if($pro_list != null) $breadcr->setBreadCrumbs($pro_list[$sluglang],$pro_list['ten']);
            if($pro_cat != null) $breadcr->setBreadCrumbs($pro_cat[$sluglang],$pro_cat['ten']);
            $breadcrumbs = $breadcr->getBreadCrumbs();*/
            $this->mydata['title_crumb'] = $title_cat;
            $this->mydata['breadcr'] = create_BreadCrumbs($this->com, $title_cat);
        } else if ($idi != '') {
            /* Lấy cấp 3 detail */
            $pro_item = $d->rawQueryOne("select id, id_list, id_cat, ten$lang as ten,noidung$lang as noidung, tenkhongdauvi, tenkhongdauen, type, photo, options from #_product_item where id = ? and type = ? limit 0,1", array($idi, $type));

            /* Lấy cấp 1 */
            $pro_list = $d->rawQueryOne("select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen from #_product_list where id = ? and type = ? limit 0,1", array($pro_item['id_list'], $type));

            /* Lấy cấp 2 */
            $pro_cat = $d->rawQueryOne("select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen from #_product_cat where id_list = ? and id = ? and type = ? limit 0,1", array($pro_item['id_list'], $pro_item['id_cat'], $type));

            /* Lấy sản phẩm */
            $where = "id_item = ? and type = ? and hienthi > 0";
            $params = array($idi, $type);

            /* SEO */
            if (!empty($row_detail['photo'])) $seo->setSeo('photo:img', MYSITE  . UPLOAD_PRODUCT_L . $row_detail['photo']);

            $title_cat = $pro_item['ten'];
            $this->mydata['breadcr'] = create_BreadCrumbs($this->com, $title_cat);
            $noidung_cap = $pro_item['noidung'];

            $this->mydata['title_crumb'] = $title_cat;
            $this->mydata['breadcr'] = create_BreadCrumbs($this->com, $title_cat);

        } else if ($ids != '') {
            /* Lấy cấp 4 */
            $pro_sub = $d->rawQueryOne("select id, id_list, id_cat, id_item, ten$lang as ten,noidung$lang as noidung, tenkhongdauvi, tenkhongdauen, type, photo, options from #_product_sub where id = ? and type = ? limit 0,1", array($ids, $type));

            /* Lấy cấp 1 */
            $pro_list = $d->rawQueryOne("select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen from #_product_list where id = ? and type = ? limit 0,1", array($pro_sub['id_list'], $type));

            /* Lấy cấp 2 */
            $pro_cat = $d->rawQueryOne("select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen from #_product_cat where id_list = ? and id = ? and type = ? limit 0,1", array($pro_sub['id_list'], $pro_sub['id_cat'], $type));

            /* Lấy cấp 3 */
            $pro_item = $d->rawQueryOne("select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen from #_product_item where id_list = ? and id_cat = ? and id = ? and type = ? limit 0,1", array($pro_sub['id_list'], $pro_sub['id_cat'], $pro_sub['id_item'], $type));

            /* Lấy sản phẩm */
            $where = "id_sub = ? and type = ? and hienthi > 0";
            $params = array($ids, $type);

            /* SEO */
            if (!empty($row_detail['photo'])) $seo->setSeo('photo:img', MYSITE  . UPLOAD_PRODUCT_L . $row_detail['photo']);

            $title_cat = $pro_sub['ten'];
            $this->mydata['breadcr'] = create_BreadCrumbs($this->com, $title_cat);
            $noidung_cap = $pro_sub['noidung'];


        } else if ($idb != '') {
            /* Lấy brand detail */
            $pro_brand = $d->rawQueryOne("select ten$lang as ten, tenkhongdauvi, tenkhongdauen, id, type, photo, options from #_product_brand where id = ? and type = ? limit 0,1", array($idb, $type));

            /* SEO */
            if (!empty($row_detail['photo'])) $seo->setSeo('photo:img', MYSITE  . UPLOAD_PRODUCT_L . $row_detail['photo']);

            $title_cat = $pro_brand['ten'];
            $this->mydata['breadcr'] = create_BreadCrumbs($this->com, $title_cat);


            /* Lấy sản phẩm */
            $where = "id_brand = '" . $pro_brand['id'] . "' and type = '" . $type . "' and hienthi > 0";

        } else if ($com == 'khuyen-mai') {


            $row_detail = $d->rawQueryOne("select nhaplieu_daban, gift, thetich, hethang, type, id, ten$lang as ten, tenkhongdauvi, tenkhongdauen, mota$lang as mota, noidung$lang as noidung,noidungthanhphan$lang as noidungthanhphan, masp, luotxem, id_brand, id_mau, id_size, id_list, id_cat, id_item, id_sub, id_tags, photo, options, giakm, giamoi, gia, soluong from #_product where type = ? and hienthi > 0  and khuyenmai = 1", array($type));

            /* SEO */
            if (!empty($row_detail['photo'])) $seo->setSeo('photo:img', MYSITE  . UPLOAD_PRODUCT_L . $row_detail['photo']);


            /* Lấy tất cả sản phẩm */


            $where = "type = '" . $type . "' and hienthi > 0 and khuyenmai = 1 order by stt, id desc";

            /* breadCrumbs */

        } else if ($com == 'tot-nhat') {
            /* SEO */

            if (!empty($row_detail['photo'])) $seo->setSeo('photo:img', MYSITE  . UPLOAD_PRODUCT_L . $row_detail['photo']);

            /* Lấy tất cả sản phẩm */
            $where = "type = '" . $type . "' and hienthi > 0 and noibat > 0  order by stt, id desc";

            /* breadCrumbs */

        } else if ($com == 'moi') {
            /* SEO */

            if (!empty($row_detail['photo'])) $seo->setSeo('photo:img', MYSITE  . UPLOAD_PRODUCT_L . $row_detail['photo']);

            /* Lấy tất cả sản phẩm */
            $where = "type = '" . $type . "' and hienthi > 0 and moi > 0  order by stt, id desc";

            /* breadCrumbs */

        } else if ($com == 'khuyen-mai') {


            /* Lấy tất cả sản phẩm */
            $where = "type = '" . $type . "' and hienthi > 0 and banchay > 0  order by stt, id desc";


        } else {

            /* SEO */

            if (!empty($row_detail['photo'])) $seo->setSeo('photo:img', MYSITE  . UPLOAD_PRODUCT_L . $row_detail['photo']);

            /* Lấy tất cả sản phẩm */
            $where = "type = '" . $type . "' and hienthi > 0 order by stt, id desc";

            /* breadCrumbs */

        }

        $sosp = $optsetting['soluong_sp'] ?? 10;
        //$where = " $where";
        $dem = $d->rawQueryOne("SELECT count(id) AS numrows FROM #_product where $where");

        $solan_max = ceil($dem['numrows'] / $sosp);


        $this->mydata['noidung_cap'] = !empty($noidung_cap) ? $noidung_cap : '';
        $this->mydata['pro_brand'] = !empty($pro_brand) ? $pro_brand : '';
        $this->mydata['row_detail'] = !empty($row_detail) ? $row_detail : '';
        //var_dump($where);die;
        $this->mydata['where'] = $where;
        $this->mydata['sosp'] = $sosp;
        $this->mydata['dem'] = $dem;
        $this->mydata['solan_max'] = $solan_max;
        //$this->mydata['title_cat'] = !empty($title_cat) ? $title_cat : '';
        //$this->mydata['title_crumb'] = $title_crumb;



        $sluglang_cat = $this->uri->segment(2);

        $pro_cat = $d->rawQueryOne("select photo from #_product_list where tenkhongdau$lang = ? and  type = ? limit 0,1",

            array($sluglang_cat, $this->com));

        $this->mydata['pro_cat'] = !empty($pro_cat) ? $pro_cat : '';


        if ($this->mydata['template'] != 'page/product/product') {
            $this->mydata['danhgia'] = !empty($danhgia) ? $danhgia : '';
            $this->mydata['trungbinh'] = !empty($trungbinh) ? $trungbinh : '';
            $this->mydata['sao1'] = !empty($sao1) ? $sao1 : '';
            $this->mydata['sao2'] = !empty($sao2) ? $sao2 : '';
            $this->mydata['sao3'] = !empty($sao3) ? $sao3 : '';
            $this->mydata['sao4'] = !empty($sao4) ? $sao4 : '';
            $this->mydata['sao5'] = !empty($sao5) ? $sao5 : '';
            $this->mydata['mau'] = !empty($mau) ? $mau : '';
            $this->mydata['size'] = !empty($size) ? $size : '';
            $this->mydata['pro_tags'] = !empty($pro_tags) ? $pro_tags : '';
            $this->mydata['pro_list'] = !empty($pro_list) ? $pro_list : '';
            $this->mydata['pro_item'] = !empty($pro_item) ? $pro_item : '';
            $this->mydata['pro_sub'] = !empty($pro_sub) ? $pro_sub : '';
            $this->mydata['hinhanhsp'] = !empty($hinhanhsp) ? $hinhanhsp : '';
            $this->mydata['active'] = true;//$config['order']['active']
            $this->mydata['breadcr'] = !empty($breadcrumbs) ? $breadcrumbs : '';


            $detect = new MobileDetect();

            $isMobile = $detect->isMobile();

            if($isMobile){

                $this->mydata['template'] = 'page/product/product_detail_mb';
                $this->load->view('product_details', $this->mydata);
            }else{
                $this->mydata['template'] = 'page/product/product_detail';
                $this->load->view('template', $this->mydata);
            }

        }else{
            $this->load->view('template', $this->mydata);

        }

    }


	private function binhluan_process(){
		if (isset($_POST['submit-contact'])) {
			$data = array();
			$func = $this->data['func'];

			if (isset($_FILES["file"])) {
				$file_name = $func->uploadName($_FILES["file"]["name"]);
				if ($photo = $func->uploadImage("file", 'jpg|png|gif|JPG|PNG|GIF|WEBP|webp', UPLOAD_PRODUCT_L, $file_name)) {
					$data['photo'] = $photo;
				}
			}
			$data['link_video'] = (isset($_POST['link_video']) && $_POST['link_video'] != '') ? htmlspecialchars($_POST['link_video']) : 0;
			$data['tenvi'] = (isset($_POST['tenvi']) && $_POST['tenvi'] != '') ? htmlspecialchars($_POST['tenvi']) : '';
			$data['motavi'] = (isset($_POST['motavi']) && $_POST['motavi'] != '') ? htmlspecialchars($_POST['motavi']) : '';
			$data['ngaytao'] = time();
			$data['stt'] = 1;
			$data['hienthi'] = 1;
			$data['kind'] = 'man';
			$data['com'] = 'product';
			$data['type'] = $this->data['type'];
			$data['val'] = 'video';
			$data['id_photo'] = $this->data['id'];
			$data['id_member'] = $_SESSION[$this->data['login_member']]['id'];

			if ($this->data['d']->insert('gallery', $data)) {
				transfer("Gửi đánh giá thành công. Xin cảm ơn.", getCurrentPageURL());
			} else {
				transfer("Gửi đánh giá thất bại. Vui lòng thử lại sau.", getCurrentPageURL(), false);
			}

		}
	}
}
