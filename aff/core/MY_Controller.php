<?php
defined('BASEPATH') or exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");


class MY_Controller extends CI_Controller
{
	public $data;
	public $current_lang;
	public $sluglang = 'tenkhongdau';
	public $isLogin;
	public $module = '';
	public $_Affiliate;
	public $config_base;
	public $empty_img;

	public function __construct()
	{
		parent::__construct();


		//testLZ();

		$this->empty_img = MYSITE . '/assets/images/empty.gif';

		$this->isLogin = $this->session->userdata('isLogin');
		$this->info = $this->session->userdata('LoginMember');


		$this->current_lang = $this->session->userdata('lang');
		if (!$this->current_lang) {
			$this->session->set_userdata('lang', 'vi');
			$this->current_lang = 'vi';
		}

		if ($this->current_lang == 'vi') $this->session->set_userdata('site_lang', 'vietnamese');

		$this->session->set_userdata('lang', $_SESSION['lang']);

		$this->sluglang .= $this->current_lang;

		$config = $this->config->item('main_config');
		$info_db = $config['database'];

		require_once SHAREDLIBRARIES . 'autoload.php';
		new AutoLoad();


		$d = new PDODb($info_db);
		$cache = new FileCache($d);
		$statistic = new Statistic($d, $cache);

		$seo = new Seo($d);

		$seoInfo = $seo->getSeoDB('0', 'setting', 'capnhat', 'setting');

		if (is_array($seoInfo) && count($seoInfo)) {
			$seo->setSeo('title', $seoInfo['title' . $this->current_lang]);
			$seo->setSeo('description', $seoInfo['description' . $this->current_lang]);
		}
		$this->load->library('congtacvien');
		$this->_Affiliate = new Congtacvien($d);
		if (!empty($this->info['id'])) {
			$this->_Affiliate->setUserUid($this->info['id']);
		}


		//$emailer = new Email($d);
		//$router = new AltoRouter();
		$func = new Functions($d);
		//$api = new API();
		//$breadcr = new BreadCrumbs($d);
		//$cart = new Cart($d);
		$detect = new MobileDetect();
		//$addons = new AddonsOnline();

		$css = new CssMinify(true, $func);
		$js = new JsMinify(true, $func);

		$sqlCache = "select * from #_setting";
		$setting = $cache->getCache($sqlCache, 'fetch', 7200);


		//$seo->setSeo('title', $setting['s']);
		//

		$optsetting = (isset($setting['options']) && $setting['options'] != '') ? json_decode($setting['options'], true) : null;
		$deviceType = ($detect->isMobile()) ? 'mobile' : 'computer';

		$m = 'm';
		if (!$this->agent->is_mobile()) $m = '';
		// if ($deviceType == 'mobile') $m = '';

		$this->config_base = MYSITE_AFFILIATE;
		$this->data = array(
			'module' => '',
			'config' => $config,
			'sluglang' => $this->sluglang,
			'd' => $d,
			'setting' => $setting,
			'optsetting' => $optsetting,
			'seo' => $seo,
			'cache' => $cache,
			//'emailer' => new Email($d),
			'func' => $func,
			//'api' => new API(),
			'breadcr' => new BreadCrumbs($d),
			//'statistic' => $statistic,
			//'cart' => new Cart($d),
			'detect' => $detect,
			'addons' => new AddonsOnline(),
			'template' => 'page/home/index',
			'breadcrumbs' => '',
			'source' => 'index',
			'lang' => $this->session->userdata('lang'),
			'css' => $css,
			'js' => $js,
			'm' => $m,
			'deviceType' => $deviceType,
			'isMobile' => $this->agent->is_mobile(),
			// 'isMobile' => $detect->isMobile(),

			'config_base' => MYSITE_AFFILIATE,
			//'config_base' => MYSITE,

			'login_admin' => 'LoginAdmin',
			'login_member' => 'LoginMember',
			'login_ctv' => 'CTVMember',
			'config_url' => $info_db['server-name'] . $info_db['url'],
			'seolang' => $this->current_lang,

			'title_crumb' => '',
			'com' => '',
			'aff' => true,
			'isLogin' => $this->isLogin,
			'_Affiliate' => $this->_Affiliate,
			'info' => $this->info,
			'uid' => !empty($this->info['id']) ? $this->info['id'] : 0,

			'template_full' => '<div class="static-background"> <div class="background-masker btn-divide-left"></div> </div>'
		);
	}

	protected function load_lang()
	{
		if ($this->uri->segment(1) == 'en'
			||
			$this->uri->segment(1) == 'vi'
		) {
			$this->session->set_userdata("language", $this->uri->segment(1));
			redirect($this->session->flashdata('redirectToCurrent'));
		}
	}
}
