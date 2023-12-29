<?php
defined('BASEPATH') or exit('No direct script access allowed');

class News extends MY_Controller
{
	protected $com = '';
	protected $mydata;
	protected $id = 0;

	function __construct()
	{
		parent::__construct();

		$com = $this->uri->segment(2);
		$details = $this->uri->segment(1);

		if ($com == NULL) $com = $details;

		if ($com == 'bai-viet') {
			$com = 'brand';
		} elseif ($com == 'gioi-thieu') {
			$com = 'static';
		}else if($com=='cam-nang'){
			$com = 'tin-tuc';
		}else if($com=='tin-tuc'){
			$com = 'tin-tuc';
		}
		$this->router = $com;

		$sluglang = $this->data['sluglang'];
		//$this->mydata = $this->data;

		//$this->mydata['template'] = !empty($com) ? "page/news/news_detail" : "page/news/news";
		$requick = array(
			/* Sản phẩm */
			array("tbl" => "product_list", "field" => "idl", "source" => "product", "com" => "san-pham", "type" => "san-pham"),
			array("tbl" => "product", "field" => "id", "source" => "product", "com" => "san-pham", "type" => "san-pham", 'menu' => true),

			array("tbl" => "news", "field" => "id_thuonghieu", "source" => "news", "com" => "thuong-hieu", "type" => "thuong-hieu", 'menu' => true),
			array("tbl" => "news", "field" => "id_dong", "source" => "news", "com" => "dong", "type" => "dong", 'menu' => true),
			array("tbl" => "news", "field" => "id", "source" => "news", "com" => "tin-tuc", "type" => "tin-tuc", 'menu' => true),
			array("tbl" => "news", "field" => "id", "source" => "news", "com" => "su-kien", "type" => "su-kien", 'menu' => true),
			array("tbl" => "news", "field" => "id", "source" => "news", "com" => "thong-bao", "type" => "thong-bao", 'menu' => false),
			array("tbl" => "news", "field" => "id", "source" => "news", "com" => "chinh-sach", "type" => "chinh-sach", 'menu' => false),
			array("tbl" => "news", "field" => "id", "source" => "news", "com" => "bai-viet-thuong-hieu", "type" => "bai-viet-thuong-hieu", 'menu' => false),
			array("tbl" => "news", "field" => "id", "source" => "news", "com" => "ho-tro", "type" => "ho-tro", 'menu' => false),
			array("tbl" => "news_list", "field" => "idl", "source" => "news", "com" => "tin-tuc", "type" => "tin-tuc"),

			array("tbl" => "static", "field" => "id", "source" => "static", "com" => "gioi-thieu", "type" => "gioi-thieu", 'menu' => true),
			array("tbl" => "static", "field" => "id", "source" => "contact", "com" => "lien-he", "type" => "lien-he", 'menu' => true),
		);

		foreach ($requick as $v) {
			$url_tbl = (isset($v['tbl']) && $v['tbl'] != '') ? $v['tbl'] : '';
			//$url_tbltag = (isset($v['tbltag']) && $v['tbltag'] != '') ? $v['tbltag'] : '';
			$url_type = (isset($v['type']) && $v['type'] != '') ? @$v['type'] : '';
			$url_field = (isset($v['field']) && $v['field'] != '') ? @$v['field'] : '';
			$url_com = (isset($v['com']) && $v['com'] != '') ? @$v['com'] : '';

			if ($url_tbl != '' && $url_tbl != 'static' && $url_tbl != 'photo') {
				$row = $this->data['d']->rawQueryOne("select id from #_$url_tbl where $sluglang = ? and type = ? and hienthi > 0 limit 0,1", array($com, $url_type));

				if (isset($row['id']) && $row['id'] > 0) {
					$_GET[$url_field] = $row['id'];

					$this->id = $row['id'];

					$com = $url_com;
					$this->com = $com;

					$this->session->set_flashdata('idEntry', $this->id);

					break;
				}
			}
		}


		$this->data['template'] = !empty($this->uri->segment(2)) ? "page/news/news_detail" : "page/news/news";
	}

	public function index()
	{
		redirect(site_url());
	}

	public function review()
	{
		$d = $this->data['d'];
		$func = $this->data['func'];
		$lang = $this->current_lang;
		$optsetting = $this->data['optsetting'];

		$this->data['source'] = 'news';
		$this->data['template'] = 'page/news/review';
		$this->data['seo']->setSeo('type', isset($_GET['id']) ? "article" : "object");

		$this->data['type'] = 'review';


		$curPage = !empty($_REQUEST['p']) ? (int)$this->input->get('p', true) : 1;
		$per_page = $optsetting['soluong_tin'];

		$startpoint = ($curPage * $per_page) - $per_page;
		$params = array('review');

		$where = "type = ? and hienthi > 0";
		$limit = " limit " . $startpoint . "," . $per_page;

		$sql = "select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen, photo, ngaytao, mota$lang as mota, id_list,icon from #_news where $where order by stt,id desc $limit";
		$news = $d->rawQuery($sql, $params);
		$sqlNum = "select count(*) as 'num' from #_news where $where order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum, $params);

		$url = $func->getCurrentPageURL();
		$total = $count['num'];
		$paging = $func->pagination($total, $per_page, $curPage, $url);

		$this->data['paging'] = $paging;
		$this->data['news'] = $news;
		$this->data['noidung_cap'] = '';
		$this->data['title_crumb'] = getLang('binhluan');

		$this->load->view('template', $this->data);
	}

	public function sukien()
	{

		$this->com = $this->uri->segment(1);
		if($this->router){
		//	$this->com = $this->router;
		}

		$this->id = $this->session->flashdata('idEntry');

		if (empty($this->com)) {
			redirect(site_url(), 'refresh');
		} else {
			if ($this->com == 'bai-viet') {
				$this->com = 'brand';
			}
			if ($this->com == 'cam-nang') {
				$this->com = 'tin-tuc';
			}
		}

		$func = $this->data['func'];
		$d = $this->data['d'];
		$optsetting = $this->data['optsetting'];
		$per_page = $optsetting['soluong_tin'];

		$curPage = !empty($_REQUEST['p']) ? $_REQUEST['p'] : 1;
		$url = $func->getCurrentPageURL();
		$lang = $this->current_lang;

		$removeStr = str_replace('-', '', $this->com);
		$title_crumb = getLang($removeStr);

		$params = array($this->com);
		$where = "type = ? and hienthi > 0 ";

		if ($this->uri->segment(1) == 'cam-nang') {
			$where .= ' and id_list = 7';
		}


		$isBrand = $this->uri->segment(1) == 'brand' && $this->data['isMobile'];

		$this->data['fullpage'] = false;

		$select = '';
		if ($this->id) {
			$params = array($this->id);
			$where = "id = ? and hienthi > 0";
			$select = 'noidung' . $lang . ' as noidung,';
			$this->data['template'] = "page/news/baiviet";
			if ($this->com != 'brand') $this->data['fullpage'] = 'fullpage';

		}

		if($isBrand){
			$this->data['isBrand'] = 1;
			$this->data['image'] = MYSITE . 'assets/images/brand.png';
		}

		$startpoint = ($curPage * $per_page) - $per_page;

		$limit = " limit " . $startpoint . "," . $per_page;

		$sql = "select $select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen, photo, ngaytao, mota$lang as mota, id_list,icon from #_news where $where order by ngaytao desc $limit";
		$item = $d->rawQuery($sql, $params);
		$sqlNum = "select count(*) as 'num' from #_news where $where";

		$count = $d->rawQueryOne($sqlNum, $params);

		$per_page = @$optsetting['soluong_tin'];
		$total = @$count['num'];


		$paging = $func->pagination($total, $per_page, $curPage, $url);

		if (empty($title_crumb) && !empty($item[0]['ten'])) {
            $title_crumb = $item[0]['ten'];
        }
		$this->data['router'] = $this->com;
		$this->data['item'] = $item;
		$this->data['title_crumb'] = $title_crumb;
		$this->data['paging'] = $paging;


		$params = array($this->com);

		$where = " noibat = 1 and type = ? and hienthi > 0";

		$sql = "select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen, photo, ngaytao, mota$lang as mota, id_list,icon from #_news where $where order by ngaytao desc limit 0,10";
		$news = $d->rawQuery($sql, $params);

		$this->data['news'] = $news; //$news

		$this->data['breadcr'] = create_BreadCrumbs($this->com, $title_crumb);

		$this->load->view('template', $this->data);
	}

	public function details()
	{
		$func = $this->data['func'];
		$d = $this->data['d'];
		$optsetting = $this->data['optsetting'];

		$lang = $this->current_lang;

		$params = array($this->id, $this->com);
		$where = " id = ? and type = ? and hienthi > 0";

		$sql = "select id, ten$lang as ten, noidung$lang as noidung, ngaytao, mota$lang as mota from #_news where $where order by ngaytao desc";
		$item = $d->rawQueryOne($sql, $params);

		$title_crumb = @$item['ten'];
		$noidung = @$item['noidung'];

		$type = $this->uri->segment(1) ?? 'su-kien';
		$params = array($type);
		$where = " noibat = 1 and type = ? and hienthi > 0";

		$sql = "select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen, photo, ngaytao, mota$lang as mota, id_list,icon from #_news where $where order by ngaytao desc limit 0,10";
		$news = $d->rawQuery($sql, $params);

		$this->data['news'] = $news; //$news
		$this->data['router'] = $this->com;
		$this->data['type'] = $item;
		$this->data['row_detail'] = $item;
		$this->data['type'] = $this->com;
		$this->data['id'] = $this->id;
		$this->data['noidung'] = $noidung;
		$this->data['title_crumb'] = $title_crumb;
		$this->data['template'] = 'page/news/news_detail';

		$breadcr = $this->data['breadcr'];

		$removeStr = str_replace('-', '', $this->com);
		$title_crumb_link = getLang($removeStr);
		$breadcr->setBreadCrumbs($this->com, $title_crumb_link);
		$breadcr->setBreadCrumbs($this->com, $title_crumb);
		$this->data['breadcr'] = $breadcr->getBreadCrumbs();
		$this->load->view('template', $this->data);
	}

}
