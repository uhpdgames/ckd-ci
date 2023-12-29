<?php
defined('BASEPATH') or exit('No direct script access allowed');


class MY_Controller extends CI_Controller
{

	public $gg_client;
	public $gg_token;
	
	public $data;
	public $current_lang;
	public $sluglang = 'tenkhongdau';
	public $session_member = 'LoginMember';
	public $isLogin;

	public function __construct()
	{
		parent::__construct();

		$this->isLogin = $this->session->userdata('isLogin');
		$this->current_lang = $this->session->userdata('lang');
		$this->userInfo = $this->session->userdata($this->session_member);


		if (!$this->userInfo) $this->session->set_userdata($this->session_member, array());

		if (!$this->current_lang) {
			$this->session->set_userdata('lang', 'vi');
			$this->current_lang = 'vi';
		}

		if ($this->current_lang == 'vi') $this->session->set_userdata('site_lang', 'vietnamese');

		$this->sluglang .= $this->current_lang;

		$config = $this->config->item('main_config');
		$info_db = $config['database'];

		require_once SHAREDLIBRARIES . 'autoload.php';
		new AutoLoad();

		$d = new PDODb($info_db);
		$cache = new FileCache($d);
		$statistic = new Statistic($d, $cache);

		$statistic->getCounter();
		$statistic->getOnline();

		$seo = new Seo($d);

		$seoInfo = $seo->getSeoDB('0', 'setting', 'capnhat', 'setting');

		if (is_array($seoInfo) && count($seoInfo)) {
			$seo->setSeo('title', $seoInfo['title' . $this->current_lang]);
			$seo->setSeo('description', $seoInfo['description' . $this->current_lang]);
		}

		//$_Affiliate = new Affiliate($d);

		//$router = new AltoRouter();
		$func = new Functions($d);
		//$api = new API();
		//$breadcr = new BreadCrumbs($d);
		//$cart = new Cart($d);
		$detect = new MobileDetect();
		//$addons = new AddonsOnline();

		//$css = new CssMinify(true, $func);
		//$js = new JsMinify(true, $func);


		$sqlCache = "select * from #_setting";
		$setting = $cache->getCache($sqlCache, 'fetch', 7200);


		$optsetting = (isset($setting['options']) && $setting['options'] != '') ? json_decode($setting['options'], true) : null;
		$deviceType = ($detect->isMobile()) ? 'mobile' : 'computer';

		$m = 'm';
		if (!$this->agent->is_mobile()) $m = '';
		// if ($deviceType == 'mobile') $m = '';

		$lang = $this->current_lang;
		$slogan = $d->rawQuery("select ten$lang as ten, mota$lang as mota from #_news where type = ? and hienthi > 0 order by stt,id desc", array('slogan'));


		$this->data = array(
			'slogan' => $slogan,
			'config' => $config,
			'sluglang' => $this->sluglang,
			'd' => $d,
			'setting' => $setting,
			'optsetting' => $optsetting,
			'seo' => $seo,
			'cache' => $cache,

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
			'lang' => $this->current_lang,
			//'css' => $css,
			//'js' => $js,
			'm' => $m,
			'deviceType' => $deviceType,
			'isMobile' => $this->agent->is_mobile(),
			// 'isMobile' => $detect->isMobile(),

			'config_base' => MYSITE,
			'login_admin' => 'LoginAdmin',
			'login_member' => $this->session_member,
			'login_ctv' => 'CTVMember',
			'config_url' => $info_db['server-name'] . $info_db['url'],
			'seolang' => $this->current_lang,
			'title_crumb' => '',
			'com' => '',
			'isLogin' => $this->isLogin,
			'info' => array(),

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


	public function infoEmail(){
		$data = array();

		$socialString = '';
		$options = $this->data['d']->rawQueryOne("select options, tenvi from #_setting limit 0,1");

		$logo = $this->data['d']->rawQueryOne("select photo from #_photo where type = ? and act = ? limit 0,1", array('logo', 'photo_static'));
		$social = $this->data['d']->rawQuery("select photo, link from #_photo where type = ? and hienthi > 0 order by stt,id desc", array('mangxahoi'));

		if ($social && count($social) > 0) {
			foreach ($social as $value) {
				$socialString .= '<a href="' . $value['link'] . '" target="_blank"><img src="' . MYSITE . UPLOAD_PHOTO_L . $value['photo'] . '" style="max-height:30px;margin:0 0 0 5px" /></a>';
			}
		}


		$data['color'] = '#3d5b2d';
		$data['home'] = MYSITE;
		$data['logo'] = '<img src="' . MYSITE . UPLOAD_PHOTO_L . $logo['photo'] . '" style="max-height:70px;" >';
		$data['social'] = $socialString;
		$data['datesend'] = time();
		$data['company'] = $options['tenvi'] ?? '';
		$data['company:address'] = $this->optcompany['diachi'] ?? '';
		$data['company:email'] = $this->optcompany['email'] ?? '';
		$data['email'] = $this->optcompany['email'] ?? '';
		$data['company:hotline'] = $this->optcompany['hotline'] ?? '';
		$data['company:website'] = $this->optcompany['website'] ?? '';
		$data['company:worktime'] = '(8-21h cả T7,CN)';

		return $data;

	}
	public function sendEmail($to, $subject, $message)
	{
		#$setting = $this->data['setting'];
		$optsetting = $this->data['optsetting'];

		/*
		$config_host = $optsetting['ip_host'];
		$config_port = $optsetting['port_host'];
		# $config_secure = $optsetting['secure_host'];
		$config_email = $optsetting['email_host'];
		$config_password = $optsetting['password_host'];
		*/

		$config = array();
		if ($optsetting['mailertype'] == 2) {
			$config['protocol'] = 'smtp';
			#$config['smtp_host'] = 'ssl://smtp.googlemail.com';
			$config['smtp_host'] = 'ssl://smtp.googlemail.com';
			$config['smtp_user'] = trim($optsetting['email_gmail']);
			$config['smtp_pass'] = trim($optsetting['password_gmail']);
			$config['smtp_port'] = 465;
			$config['smtp_timeout'] = "";
			/*$config['charset']   = 'utf-8';*/


			$config['_smtp_auth'] = TRUE;
			$config['smtp_crypto'] = 'tls';
		} else {
			$config['protocol'] = 'smtp';
			$config['smtp_host'] = $optsetting['ip_host'];
			$config['smtp_port'] =  $optsetting['port_host'];
			$config['smtp_user'] = $optsetting['email_host'];
			$config['smtp_pass'] = $optsetting['password_host'];
		}

		$config['send_multipart'] = FALSE;
		$config['mailtype'] = "html";
		$config['charset'] = "utf-8";
		$config['newline'] = "\r\n";
		$config['validate'] = FALSE;
		$config['wordwrap'] = TRUE;

		$this->load->library('email', $config);

		$this->email->set_newline("\r\n");


		$this->email->from($optsetting['email_host'], 'CKD VIỆT NAM');
		$this->email->to($to);
		#$this->email->cc('another@another-example.com');
		#$this->email->bcc('them@their-example.com');

		$this->email->subject($subject);
		$this->email->message($message);

		$this->email->send(FALSE);

		echo  1;
		//echo $this->email->print_debugger(array('headers'));


	}

	public function testEmail()
	{



		$this->sendEmail(
			'kenji.vn14@gmail.com',
			'test email',
			'đây là test email'
		);
	}





	public function auth(){
		require_once APPPATH . 'libraries/google_api/vendor/autoload.php';
		$key = SHAREDPATH . 'json/google_key.json';
		$this->gg_client = new Google\Client();

		$this->gg_client->setAuthConfig($key);
		$this->gg_client->addScope('https://www.googleapis.com/auth/indexing');

		return $this->gg_client->authorize();

		//return $httpClient;

		#$endpoint = 'https://indexing.googleapis.com/v3/urlNotifications:publish';
		#$redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
		#$this->gg_client->setRedirectUri($redirect_uri);
		#$response = $httpClient->post($endpoint, [ 'body' => $content ]);
		//$status_code = $response->getStatusCode();
	}

	function token()
	{
		require_once APPPATH . 'libraries/google_api/vendor/autoload.php';
		if (isset($_GET['code'])) {
			$this->gg_token = $this->gg_client->fetchAccessTokenWithAuthCode($_GET['code']);
		}

	}

	/**
	 * @param $url
	 * @param $type : URL_UPDATED , URL_DELETED
	 *
	 */
	function update_google($url, $type)
	{
		$auth = $this->auth();

		$endpoint = 'https://indexing.googleapis.com/v3/urlNotifications:publish';

		// Define contents here. The structure of the content is described in the next step.

		$content = '{
		  "url": '.$url.',
		  "type": '.$type.'
		}';

		$response = $auth->post($endpoint, [ 'body' => $content ]);
		$status_code = $response->getStatusCode();


		return $status_code;
	}
}

