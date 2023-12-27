<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Account extends MY_Controller
{
	public $isLogin;
	private $d;
	private $login_member;
	private $login_ctv;


	function __construct()
	{
		parent::__construct();


		$this->login_ctv = 'CTVMember';
		$this->login_member = 'LoginMember';

		$this->voucher = new EGiftVoucherSystem();

		//$this->login_member = $this->data['login_member'];
		$this->d = $this->data['d'];
		$this->isLogin = $this->session->userdata('isLogin');
		//$this->info = $this->session->userdata($this->login_member);


		//	qq($this->info['id'] );die;


		$this->data['isLogin'] = $this->isLogin;

//		$this->session->set_userdata('isLogin', $this->isLogin);
	}

	function index()
	{
		//	qq($this->data['isLogin']);die;
//		$per = 10; //10 phan tram
//		$voucher1 = $this->voucher->generateVoucher("register", $per);
//		$new_voucher = $voucher1->getVoucherId();
//
//		qq($new_voucher);
//die;
		//	echo '1';
		$action = $this->uri->segment(2);
		// var_dump($action);die;

		if (!empty($action)) {
			switch ($action) {
				case 'cong-tac-vien':
					$title_crumb = getLang('dangky');
					$template = "affiliate/welcome";

					break;
				case 'thong-bao-cong-tac-vien':
					$title_crumb = getLang('thongbao');
					$template = "affiliate/thongbao";
					if (!$this->isLogin) transfer("Trang không tồn tại", MYSITE_AFFILIATE, false);
					break;
				case 'thong-tin-cong-tac-vien':
					if (!$this->isLogin) transfer("Trang không tồn tại", MYSITE_AFFILIATE, false);
					$template = "affiliate/thongtin";
					$this->get_info_ref();
					$title_crumb = getLang('ctv_chitiet');
					break;
				case 'cong-tac-vien-chuyen-doi':
					if (!$this->isLogin) transfer("Trang không tồn tại", MYSITE_AFFILIATE, false);
					$template = "affiliate/chuyendoi";
					$title_crumb = getLang('ctv_chuyendoi');
					break;
				case 'thong-tin-thu-nhap':
					if (!$this->isLogin) transfer("Trang không tồn tại", MYSITE_AFFILIATE, false);
					$template = "affiliate/thunhap";
					$title_crumb = getLang('ctv_thunhap');
					break;
				case 'thong-tin-chuyen-khoan':
					if (!$this->isLogin) transfer("Trang không tồn tại", MYSITE_AFFILIATE, false);
					$template = "affiliate/ruttien";
					$title_crumb = getLang('ctv_ruttien');
					break;
				case 'xac-nhan-chuyen-khoan':
					if (!$this->isLogin) transfer("Trang không tồn tại", MYSITE_AFFILIATE, false);
					$template = "affiliate/thanhtoan";
					$title_crumb = getLang('ctv_ruttien');
					break;
				case 'them-tai-khoan-ngan-hang':
					if (!$this->isLogin) transfer("Trang không tồn tại", MYSITE_AFFILIATE, false);
					$template = "affiliate/nganhang";
					$title_crumb = getLang('thongtintaikhoan');
					$this->get_item_bank();
					break;
				/*	case 'cong-tac-vien':
						$title_crumb = getLang('dangky');
						$template = "affiliate/welcome";
						if ($this->_Affiliate->getRefActive()) transfer("Bạn đã trở thành cộng tác viên, đang chuyển hướng trang quản lý", $this->config_base . 'account/thong-bao-cong-tac-vien', false);
						break;*/
				case 'dang-nhap':
					$title_crumb = getLang('dangnhap');
					$template = "page/account/dangnhap";
					if ($this->isLogin) transfer("Trang không tồn tại", MYSITE_AFFILIATE, false);
					if (isset($_POST['dangnhap'])) $this->login();
					break;

				case 'dang-ky':

					$title_crumb = getLang('dangky');
					$template = "page/account/dangky";
					#if ($this->isLogin) transfer("Trang không tồn tại", '', false);
					if (isset($_POST['dangky'])) $this->signup();
					break;

				case 'quen-mat-khau':
					$title_crumb = getLang('quenmatkhau');
					$template = "page/account/quenmatkhau";
					if ($this->isLogin) transfer("Trang không tồn tại", MYSITE_AFFILIATE, false);
					if (isset($_POST['quenmatkhau'])) $this->doimatkhau_user();
					break;

				case 'kich-hoat':
					$title_crumb = getLang('kichhoat');
					$template = "page/account/kichhoat";
					if ($this->isLogin) transfer("Trang không tồn tại", MYSITE_AFFILIATE, false);
					if (isset($_POST['kichhoat'])) $this->active_user();
					break;

				case 'thong-tin':
					if (!$this->isLogin) transfer("Trang không tồn tại", MYSITE_AFFILIATE, false);
					$template = "page/account/thongtin";
					$title_crumb = getLang('capnhatthongtin');
					$this->info_user();
					break;

				case 'dang-xuat':
					if (!$this->isLogin) transfer("Trang không tồn tại", MYSITE_AFFILIATE, false);
					$this->dangxuat();


				default:
					$this->load->view('404');
					exit();
			}
		}


		$this->data['title_crumb'] = $title_crumb;
		$this->data['template'] = $template;
		//qq($this->data);
		$this->load->view('template', $this->data);
	}

	function dangky()
	{
		$title_crumb = getLang('dangky');
		$template = "page/account/dangky";
		if (isset($_POST['dangky'])) $this->signup();

		$this->data['title_crumb'] = $title_crumb;
		$this->data['template'] = $template;
		//qq($this->data);
		$this->load->view('template', $this->data);

	}


	function dangnhap()
	{
		if (isset($_POST['dangnhap'])) $this->login();

		$this->data['template'] = 'page/account/dangnhap';
		$this->load->view('template', $this->data);
	}

	function dangxuat()
	{
		$this->isLogin = false;
		set_cookie('login_member_id', "", -1, '/');
		set_cookie('login_member_session', "", -1, '/');
		$this->session->unset_userdata('isLogin');
		$this->session->unset_userdata($this->login_member);

		redirect(MYSITE_AFFILIATE, 'refresh');
	}


	function thongtin()
	{
		$this->data['template'] = 'page/account/dangnhap';
		$this->load->view('template', $this->data);

	}

	function signup()
	{

		$this->config_base = $this->data['config_base'];

		$affiliate = (!empty($_POST['affiliate'])) ? $_POST['affiliate'] : '';


		$username = (!empty($_POST['username'])) ? $_POST['username'] : '';
		$password = (!empty($_POST['password'])) ? $_POST['password'] : '';
		$passwordMD5 = md5($password);
		$repassword = (!empty($_POST['repassword'])) ? $_POST['repassword'] : '';
		$email = (isset($_POST['email'])) ? htmlspecialchars($_POST['email']) : '';
		$maxacnhan = digitalRandom(0, 3, 6);

		if ($password != $repassword) transfer("Xác nhận mật khẩu không trùng khớp", $this->config_base . "account/dang-ky", false);

		/* Kiểm tra tên đăng ký */
		$row = $this->d->rawQueryOne("select id from #_member where username = ? limit 0,1", array($username));
		if (isset($row['id']) && $row['id'] > 0) {
			//transfer("Tên đăng nhập đã tồn tại", $this->config_base . "account/dang-ky", false);
			if ($affiliate) {
				transfer("Tên đăng nhập đã tồn tại", $this->config_base . "account/dang-ky", false);
			}
		}

		/* Kiểm tra email đăng ký */
		$row = $this->d->rawQueryOne("select id from #_member where email = ? limit 0,1", array($email));
		if (isset($row['id']) && $row['id'] > 0) {
			//transfer("Tên đăng nhập đã tồn tại", $this->config_base . "account/dang-ky", false);
			if ($affiliate) {
				transfer("Tên đăng nhập đã tồn tại", $this->config_base . "account/dang-ky", false);
			}
		}

		$data['ten'] = (isset($_POST['ten'])) ? htmlspecialchars($_POST['ten']) : '';
		$data['username'] = trim($username);
		$data['password'] = md5($password);
		$data['email'] = trim($email);
		$data['dienthoai'] = (isset($_POST['dienthoai'])) ? htmlspecialchars($_POST['dienthoai']) : 0;
		$data['diachi'] = (isset($_POST['diachi'])) ? htmlspecialchars($_POST['diachi']) : '';
		$data['gioitinh'] = (isset($_POST['gioitinh'])) ? htmlspecialchars($_POST['gioitinh']) : 0;
		$data['ngaysinh'] = (isset($_POST['ngaysinh'])) ? strtotime(str_replace("/", "-", $_POST['ngaysinh'])) : 0;
		$data['maxacnhan'] = $maxacnhan;

		$data['hienthi'] = 1;

		if ($affiliate) $data['ref_nick'] = 1;


		if ($uid = $this->d->insert('member', $data)) {
			//TODO SEND EMAIL
			//$this->send_active_user($username);
			$this->setVoucher($uid);

			if ($affiliate) {
				$data_ref = array(
					'user_id' => $uid,
					'code' => random_string('alpha', 10),
					'url' => $this->config_base . 'san-pham',
					'visits' => 0,
					'ip' => 0,
					'date_create' => date("Y-m-d H:i:s"),
				);

				if ($this->d->insert('ref', $data_ref)) {

					$this->_Affiliate->setRegister($data_ref['code']);

					redirect('account/dangnhap');
					//transfer("Đăng ký thành viên thành công. Vui lòng kiểm tra email: " . $data['email'] . " để kích hoạt tài khoản", $this->config_base . "account/dang-nhap");
				}
			}


			//transfer("Đăng ký thành viên thành công. Vui lòng kiểm tra email: " . $data['email'] . " để kích hoạt tài khoản", $this->config_base . "account/dang-nhap");
		} else {
			transfer("Đăng ký thành viên thất bại. Vui lòng thử lại sau.", $this->config_base, false);
		}
	}

	function login()
	{

		$this->config_base = MYSITE_AFFILIATE;
		$username = (isset($_POST['username'])) ? htmlspecialchars($_POST['username']) : '';
		$password = (isset($_POST['password'])) ? htmlspecialchars($_POST['password']) : '';
		$passwordMD5 = md5($password);
		$remember = (isset($_POST['remember-user'])) ? htmlspecialchars($_POST['remember-user']) : false;


		//if (!$username) transfer("Chưa nhập tên tài khoản", 'account/dang-nhap', false);
		//if (!$password) transfer("Chưa nhập mật khẩu", 'account/dang-nhap', false);

		$row = $this->d->rawQueryOne("select ref_nick, id, password, username, dienthoai, diachi, email, ten from #_member where username = ? and hienthi > 0 and ref_nick = 1 limit 0,1", array($username));

		if (isset($row['id']) && $row['id'] > 0) {
			if ($row['password'] == $passwordMD5) {
				/* Tạo login session */
				$id_user = $row['id'];
				$lastlogin = time();
				$login_session = md5($row['password'] . $lastlogin);
				$this->d->rawQuery("update #_member set login_session = ?, lastlogin = ? where id = ?", array($login_session, $lastlogin, $id_user));

				/* Lưu session login */
				$_sess_login['active'] = true;
				$_sess_login['id'] = $row['id'];
				$_sess_login['username'] = $row['username'];
				$_sess_login['dienthoai'] = $row['dienthoai'];
				$_sess_login['diachi'] = $row['diachi'];
				$_sess_login['email'] = $row['email'];
				$_sess_login['ten'] = $row['ten'];
				$_sess_login['login_session'] = $login_session;
				$_sess_login['ref_nick'] = $row['ref_nick'] > 0;

				$this->isLogin = $id_user;
				$this->session->set_userdata($this->login_member, $_sess_login);
				$this->session->set_userdata('isLogin', $id_user);

				/* Nhớ mật khẩu */
				set_cookie('login_member_id', "", -1, '/');
				set_cookie('login_member_session', "", -1, '/');
				if ($remember) {
					$time_expiry = time() + 3600 * 24;
					set_cookie('login_member_id', $row['id'], $time_expiry, '/');
					set_cookie('login_member_session', $login_session, $time_expiry, '/');
				}

				transfer("Đăng nhập thành công", MYSITE_AFFILIATE, false);
			} else {
				transfer("Tên đăng nhập hoặc mật khẩu không chính xác. Hoặc tài khoản của bạn chưa được xác nhận từ Quản trị website", $this->config_base . "account/dangnhap", false);
			}
		} else {
			transfer("Tên đăng nhập hoặc mật khẩu không chính xác. Hoặc tài khoản của bạn chưa được xác nhận từ Quản trị website", $this->config_base . "account/dangnhap", false);
		}
	}

	function info_user()
	{
		$this->config_base = MYSITE_AFFILIATE;
		$iduser = $_SESSION[$this->login_member]['id'];

		if (empty($iduser)) redirect(MYSITE_AFFILIATE);

		//todo show setVoucher($uid);
		if ($iduser) {

			$uid_Voucher = new EGiftVoucherUser($this->d, $iduser);

			$my_Voucher = $uid_Voucher->getVoucher();

			if (is_array($my_Voucher) && count($my_Voucher)) {
				//  $this->data['row_detail'] = $my_Voucher;
				/* foreach ($my_Voucher as $voucher){
 
				 }*/
			}


			$row_detail = $this->d->rawQueryOne("select ten, username, gioitinh, ngaysinh, email, dienthoai, diachi from #_member where id = ? limit 0,1", array($iduser));

			$this->data['row_detail'] = $row_detail;
			$this->data['voucher'] = $my_Voucher;
			$user_dc = $this->d->rawQuery("select tenvi from #_news where id_user='" . $iduser . "' and type = ? and hienthi > 0", array('user'));
			$this->data['user_dc'] = $user_dc;

			if (isset($_POST['capnhatthongtin'])) {
				$password = (isset($_POST['password'])) ? htmlspecialchars($_POST['password']) : '';
				$passwordMD5 = md5($password);
				$new_password = (isset($_POST['new-password'])) ? htmlspecialchars($_POST['new-password']) : '';
				$new_passwordMD5 = md5($new_password);
				$new_password_confirm = (isset($_POST['new-password-confirm'])) ? htmlspecialchars($_POST['new-password-confirm']) : '';

				if ($password) {
					$row = $this->d->rawQueryOne("select id from #_member where id = ? and password = ? limit 0,1", array($iduser, $passwordMD5));

					if (!isset($row['id'])) transfer("Mật khẩu cũ không chính xác", MYSITE_AFFILIATE, false);
					if (!$new_password || ($new_password != $new_password_confirm)) transfer("Thông tin mật khẩu mới không chính xác", "", false);

					$data['password'] = $new_passwordMD5;
				}

				$data['ten'] = (isset($_POST['ten'])) ? htmlspecialchars($_POST['ten']) : '';
				$data['diachi'] = (isset($_POST['diachi'])) ? htmlspecialchars($_POST['diachi']) : '';
				$data['dienthoai'] = (isset($_POST['dienthoai'])) ? htmlspecialchars($_POST['dienthoai']) : 0;
				$data['email'] = (isset($_POST['email'])) ? htmlspecialchars($_POST['email']) : '';
				$data['ngaysinh'] = (isset($_POST['ngaysinh'])) ? strtotime(str_replace("/", "-", htmlspecialchars($_POST['ngaysinh']))) : 0;
				$data['gioitinh'] = (isset($_POST['gioitinh'])) ? htmlspecialchars($_POST['gioitinh']) : 0;

				$this->d->where('id', $iduser);

				if ($this->d->update('member', $data)) {
					$this->d->rawQuery("delete from #_news where id_user = ? and type = ?", array($iduser, 'user'));

					foreach ($_POST['diachi2'] as $k => $v) {
						if ($_POST['diachi2'][$k] != '') {
							$data2 = null;
							$data2['id_user'] = $iduser;
							$data2['tenvi'] = $_POST['diachi2'][$k];
							$data2['type'] = 'user';
							$data2['hienthi'] = 1;
							$this->d->insert('news', $data2);
						}
					}

					if ($password) {
						unset($_SESSION[$this->login_member]);
						set_cookie('login_member_id', "", -1, '/');
						set_cookie('login_member_session', "", -1, '/');
						transfer("Cập nhật thông tin thành công", $this->config_base . "account/dang-nhap");
					}

					transfer("Cập nhật thông tin thành công", $this->config_base . "account/thong-tin");
				}
			}
		} else {
			transfer("Trang không tồn tại", $this->config_base, false);
		}
	}

	function lichsu_user()
	{

		$this->config_base = MYSITE_AFFILIATE;
		$iduser = $_SESSION[$this->login_member]['id'];

		if ($iduser) {
			$order = $this->d->rawQuery("select * from #_order where id_user='" . $iduser . "' order by id desc");
			//$func->dump($donhang);
			$this->data['order'] = $order;
		} else {
			transfer("Trang không tồn tại", $this->config_base, false);
		}
	}

	function send_active_user($username)
	{
		$setting = $this->data['setting'];
		$this->config_base = MYSITE_AFFILIATE;
		$emailer = new Email($this->d);
		$lang = $this->current_lang;

		/* Lấy thông tin người dùng */
		$row = $this->d->rawQueryOne("select id, maxacnhan, username, password, ten, email, dienthoai, diachi from #_member where username = ? limit 0,1", array($username));

		/* Gán giá trị gửi email */
		$iduser = $row['id'];
		$maxacnhan = $row['maxacnhan'];
		$tendangnhap = $row['username'];
		$matkhau = $row['password'];
		$tennguoidung = $row['ten'];
		$emailnguoidung = $row['email'];
		$dienthoainguoidung = $row['dienthoai'];
		$diachinguoidung = $row['diachi'];
		$linkkichhoat = $this->config_base . "account/kich-hoat?id=" . $iduser;

		/* Thông tin đăng ký */
		$thongtindangky = '<td style="padding:3px 9px 9px 0px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top"><span >Username: ' . $tendangnhap . '</span><br>Mật khẩu: *******' . substr($matkhau, -3) . '<br>Mã kích hoạt: ' . $maxacnhan . '</td><td style="padding:3px 0px 9px 9px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">';
		if ($tennguoidung) {
			$thongtindangky .= '<span style="text-transform:capitalize">' . $tennguoidung . '</span><br>';
		}
		if ($emailnguoidung) {
			$thongtindangky .= '<a href="mailto:' . $emailnguoidung . '" target="_blank">' . $emailnguoidung . '</a><br>';
		}
		if ($diachinguoidung) {
			$thongtindangky .= $diachinguoidung . '<br>';
		}
		if ($dienthoainguoidung) {
			$thongtindangky .= 'Tel: ' . $dienthoainguoidung . '</td>';
		}

		$contentMember = '
		<table align="center" bgcolor="#dcf0f8" border="0" cellpadding="0" cellspacing="0" style="margin:0;padding:0;background-color:#f2f2f2;width:100%!important;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px" width="100%">
			<tbody>
				<tr>
					<td align="center" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">
						<table border="0" cellpadding="0" cellspacing="0" style="margin-top:15px" width="600">
							<tbody>
								<tr>
									<td align="center" id="m_-6357629121201466163headerImage" valign="bottom">
										<table cellpadding="0" cellspacing="0" style="border-bottom:3px solid ' . $emailer->getEmail('color') . ';padding-bottom:10px;background-color:#fff" width="100%">
											<tbody>
												<tr>
													<td bgcolor="#FFFFFF" style="padding:0" valign="top" width="100%">
														<div style="color:#fff;background-color:f2f2f2;font-size:11px">&nbsp;</div>
														<div style="display:flex;justify-content:space-between;align-items:center;">
															<table style="width:100%;">
																<tbody>
																	<tr>
																		<td>
																			<a href="' . $emailer->getEmail('home') . '" style="border:medium none;text-decoration:none;color:#007ed3;margin:0px 0px 0px 20px" target="_blank">' . $emailer->getEmail('logo') . '</a>
																		</td>
																		<td style="padding:15px 20px 0 0;text-align:right">' . $emailer->getEmail('social') . '</td>
																	</tr>
																</tbody>
															</table>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr style="background:#fff">
									<td align="left" height="auto" style="padding:15px" width="600">
										<table>
											<tbody>
												<tr>
													<td>
														<h1 style="font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0">Cảm ơn quý khách đã đăng ký tại ' . $emailer->getEmail('company:website') . '</h1>
														<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">Thông tin tài khoản của quý khách đã được ' . $emailer->getEmail('company:website') . ' cập nhật. Quý khách vui lòng kích hoạt tài khoản bằng cách truy cập vào đường link phía dưới.</p>
														<h3 style="font-size:13px;font-weight:bold;color:' . $emailer->getEmail('color') . ';text-transform:uppercase;margin:20px 0 0 0;padding: 0 0 5px;border-bottom:1px solid #ddd">Thông tin tài khoản <span style="font-size:12px;color:#777;text-transform:none;font-weight:normal">(Ngày ' . date('d', $emailer->getEmail('datesend')) . ' tháng ' . date('m', $emailer->getEmail('datesend')) . ' năm ' . date('Y H:i:s', $emailer->getEmail('datesend')) . ')</span></h3>
													</td>
												</tr>
											<tr>
											<td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
											<table border="0" cellpadding="0" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th align="left" style="padding:6px 9px 0px 0px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">Thông tin tài khoản</th>
														<th align="left" style="padding:6px 0px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">Thông tin người dùng</th>
													</tr>
												</thead>
												<tbody>
													<tr>' . $thongtindangky . '</tr>
												</tbody>
											</table>
											</td>
										</tr>
										<tr>
											<td>
											<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><i>Lưu ý: Quý khách vui lòng truy cập vào đường link phía dưới để hoàn tất quá trình đăng ký tài khoản.</i>
											<div style="margin:auto"><a href="' . $linkkichhoat . '" style="display:inline-block;text-decoration:none;background-color:' . $emailer->getEmail('color') . '!important;margin-right:30px;text-align:center;border-radius:3px;color:#fff;padding:5px 10px;font-size:12px;font-weight:bold;margin-left:38%;margin-top:5px" target="_blank">Kích hoạt tài khoản</a></div>
											</p>
											</td>
										</tr>
										<tr>
											<td>&nbsp;
												<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;border:1px ' . $emailer->getEmail('color') . ' dashed;padding:10px;list-style-type:none">Bạn cần được hỗ trợ ngay? Chỉ cần gửi mail về <a href="mailto:' . $emailer->getEmail('company:email') . '" style="color:' . $emailer->getEmail('color') . ';text-decoration:none" target="_blank"> <strong>' . $emailer->getEmail('company:email') . '</strong> </a>, hoặc gọi về hotline <strong style="color:' . $emailer->getEmail('color') . '">' . $emailer->getEmail('company:hotline') . '</strong> ' . $emailer->getEmail('company:worktime') . '. ' . $emailer->getEmail('company:website') . ' luôn sẵn sàng hỗ trợ bạn bất kì lúc nào.</p>
											</td>
										</tr>
										<tr>
											<td>&nbsp;
											<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;margin:0;padding:0;line-height:18px;color:#444;font-weight:bold">Một lần nữa ' . $emailer->getEmail('company:website') . ' cảm ơn quý khách.</p>
											<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;text-align:right"><strong><a href="' . $emailer->getEmail('home') . '" style="color:' . $emailer->getEmail('color') . ';text-decoration:none;font-size:14px" target="_blank">' . $emailer->getEmail('company') . '</a> </strong></p>
											</td>
										</tr>
									</tbody>
								</table>
								</td>
							</tr>
						</tbody>
					</table>
					</td>
				</tr>
				<tr>
					<td align="center">
					<table width="600">
						<tbody>
							<tr>
								<td>
								<p align="left" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;line-height:18px;color:#4b8da5;padding:10px 0;margin:0px;font-weight:normal">Quý khách nhận được email này vì đã đăng ký tại ' . $emailer->getEmail('company:website') . '.<br>
								Để chắc chắn luôn nhận được email thông báo, phản hồi từ ' . $emailer->getEmail('company:website') . ', quý khách vui lòng thêm địa chỉ <strong><a href="mailto:' . $emailer->getEmail('email') . '" target="_blank">' . $emailer->getEmail('email') . '</a></strong> vào số địa chỉ (Address Book, Contacts) của hộp email.<br>
								<b>Địa chỉ:</b> ' . $emailer->getEmail('company:address') . '</p>
								</td>
							</tr>
						</tbody>
					</table>
					</td>
				</tr>
			</tbody>
		</table>';

		/* Send email admin */
		$arrayEmail = array(
			"dataEmail" => array(
				"name" => $row['username'],
				"email" => $row['email']
			)
		);
		$subject = "Thư kích hoạt tài khoản thành viên từ " . $setting['ten' . $lang];
		$message = $contentMember;
		$file = '';

		if (!$emailer->sendEmail("customer", $arrayEmail, $subject, $message, $file)) transfer("Có lỗi xảy ra trong quá trình kích hoạt tài khoản. Vui lòng liên hệ với chúng tôi.", $this->config_base . "lien-he", false);
	}

	function active_user()
	{
		$this->config_base = MYSITE_AFFILIATE;
		$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;
		$maxacnhan = (isset($_POST['maxacnhan'])) ? htmlspecialchars($_POST['maxacnhan']) : '';

		/* Kiểm tra thông tin */
		$row_detail = $this->d->rawQueryOne("select hienthi, maxacnhan, id from #_member where id = ? limit 0,1", array($id));

		if (!$row_detail['id']) transfer("Tài khoản của bạn chưa được kích hoạt", $this->config_base, false);
		else if ($row_detail['hienthi']) transfer("Tài khoản của bạn đã được kích hoạt", $this->config_base);
		else {
			if ($row_detail['maxacnhan'] == $maxacnhan) {
				$data['hienthi'] = 1;
				$data['maxacnhan'] = '';
				$this->d->where('id', $id);
				if ($this->d->update('member', $data)) transfer("Kích hoạt tài khoản thành công.", $this->config_base . "account/dang-nhap");
			} else {
				transfer("Mã xác nhận không đúng. Vui lòng nhập lại mã xác nhận.", $this->config_base . "account/kich-hoat?id=" . $id, false);
			}
		}
	}


	function doimatkhau_user()
	{

		$setting = $this->data['setting'];
		$this->config_base = MYSITE_AFFILIATE;
		$emailer = new Email($this->d);
		$lang = $this->current_lang;


		$username = (isset($_POST['username'])) ? htmlspecialchars($_POST['username']) : '';
		$email = (isset($_POST['email'])) ? htmlspecialchars($_POST['email']) : '';
		$newpass = substr(md5(rand(0, 999) * time()), 15, 6);
		$newpassMD5 = md5($newpass);

		if (!$username) transfer("Chưa nhập tên tài khoản", $this->config_base . "account/quen-mat-khau", false);
		if (!$email) transfer("Chưa nhập email đăng ký tài khoản", $this->config_base . "account/quen-mat-khau", false);

		/* Kiểm tra username và email */
		$row = $this->d->rawQueryOne("select id from #_member where username = ? and email = ? limit 0,1", array($username, $email));
		if (!isset($row['id'])) transfer("Tên đăng nhập và email không tồn tại", $this->config_base . "account/quen-mat-khau", false);

		/* Cập nhật mật khẩu mới */
		$data['password'] = $newpassMD5;
		$this->d->where('username', $username);
		$this->d->where('email', $email);
		$this->d->update('member', $data);

		/* Lấy thông tin người dùng */
		$row = $this->d->rawQueryOne("select id, username, password, ten, email, dienthoai, diachi from #_member where username = ? limit 0,1", array($username));

		/* Gán giá trị gửi email */
		$iduser = $row['id'];
		$tendangnhap = $row['username'];
		$matkhau = $row['password'];
		$tennguoidung = $row['ten'];
		$emailnguoidung = $row['email'];
		$dienthoainguoidung = $row['dienthoai'];
		$diachinguoidung = $row['diachi'];

		/* Thông tin đăng ký */
		$thongtindangky = '<td style="padding:3px 9px 9px 0px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top"><span >Username: ' . $tendangnhap . '</span><br>Mật khẩu: *******' . substr($matkhau, -3) . '</td><td style="padding:3px 0px 9px 9px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">';
		if ($tennguoidung) {
			$thongtindangky .= '<span style="text-transform:capitalize">' . $tennguoidung . '</span><br>';
		}

		if ($emailnguoidung) {
			$thongtindangky .= '<a href="mailto:' . $emailnguoidung . '" target="_blank">' . $emailnguoidung . '</a><br>';
		}

		if ($diachinguoidung) {
			$thongtindangky .= $diachinguoidung . '<br>';
		}

		if ($dienthoainguoidung) {
			$thongtindangky .= 'Tel: ' . $dienthoainguoidung . '</td>';
		}

		$contentMember = '
		<table align="center" bgcolor="#dcf0f8" border="0" cellpadding="0" cellspacing="0" style="margin:0;padding:0;background-color:#f2f2f2;width:100%!important;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px" width="100%">
			<tbody>
				<tr>
					<td align="center" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">
						<table border="0" cellpadding="0" cellspacing="0" style="margin-top:15px" width="600">
							<tbody>
								<tr>
									<td align="center" id="m_-6357629121201466163headerImage" valign="bottom">
										<table cellpadding="0" cellspacing="0" style="border-bottom:3px solid ' . $emailer->getEmail('color') . ';padding-bottom:10px;background-color:#fff" width="100%">
											<tbody>
												<tr>
													<td bgcolor="#FFFFFF" style="padding:0" valign="top" width="100%">
														<div style="color:#fff;background-color:f2f2f2;font-size:11px">&nbsp;</div>
														<table style="width:100%;">
															<tbody>
																<tr>
																	<td>
																		<a href="' . $emailer->getEmail('home') . '" style="border:medium none;text-decoration:none;color:#007ed3;margin:0px 0px 0px 20px" target="_blank">' . $emailer->getEmail('logo') . '</a>
																	</td>
																	<td style="padding:15px 20px 0 0;text-align:right">' . $emailer->getEmail('social') . '</td>
																</tr>
															</tbody>
														</table>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr style="background:#fff">
									<td align="left" height="auto" style="padding:15px" width="600">
										<table>
											<tbody>
												<tr>
													<td>
														<h1 style="font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0">Kính chào Quý khách</h1>
														<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">Yêu cầu cung cấp lại mật khẩu của quý khách đã được tiếp nhận và đang trong quá trình xử lý. Quý khách vui lòng xác nhận vào đường dẫn phía dưới để được cấp mấtu khẩu mới.</p>
														<h3 style="font-size:13px;font-weight:bold;color:' . $emailer->getEmail('color') . ';text-transform:uppercase;margin:20px 0 0 0;padding: 0 0 5px;border-bottom:1px solid #ddd">Thông tin tài khoản <span style="font-size:12px;color:#777;text-transform:none;font-weight:normal">(Ngày ' . date('d', $emailer->getEmail('datesend')) . ' tháng ' . date('m', $emailer->getEmail('datesend')) . ' năm ' . date('Y H:i:s', $emailer->getEmail('datesend')) . ')</span></h3>
													</td>
												</tr>
											<tr>
											<td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
											<table border="0" cellpadding="0" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th align="left" style="padding:6px 9px 0px 0px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">Thông tin tài khoản</th>
														<th align="left" style="padding:6px 0px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">Thông tin người dùng</th>
													</tr>
												</thead>
												<tbody>
													<tr>' . $thongtindangky . '</tr>
												</tbody>
											</table>
											</td>
										</tr>
										<tr>
											<td>
											<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><i>Lưu ý: Quý khách vui lòng thay đổi mật khẩu ngay khi đăng nhập bằng mật khẩu mới bên dưới.</i>
											<div style="margin:auto"><p style="display:inline-block;text-decoration:none;background-color:' . $emailer->getEmail('color') . '!important;margin-right:30px;text-align:center;border-radius:3px;color:#fff;padding:5px 10px;font-size:12px;font-weight:bold;margin-left:33%;margin-top:5px" target="_blank">Mật khẩu mới: ' . $newpass . '</p></div>
											</p>
											</td>
										</tr>
										<tr>
											<td>&nbsp;
												<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;border:1px ' . $emailer->getEmail('color') . ' dashed;padding:10px;list-style-type:none">Bạn cần được hỗ trợ ngay? Chỉ cần gửi mail về <a href="mailto:' . $emailer->getEmail('company:email') . '" style="color:' . $emailer->getEmail('color') . ';text-decoration:none" target="_blank"> <strong>' . $emailer->getEmail('company:email') . '</strong> </a>, hoặc gọi về hotline <strong style="color:' . $emailer->getEmail('color') . '">' . $emailer->getEmail('company:hotline') . '</strong> ' . $emailer->getEmail('company:worktime') . '. ' . $emailer->getEmail('company:website') . ' luôn sẵn sàng hỗ trợ bạn bất kì lúc nào.</p>
											</td>
										</tr>
										<tr>
											<td>&nbsp;
											<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;margin:0;padding:0;line-height:18px;color:#444;font-weight:bold">Một lần nữa ' . $emailer->getEmail('company:website') . ' cảm ơn quý khách.</p>
											<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;text-align:right"><strong><a href="' . $emailer->getEmail('home') . '" style="color:' . $emailer->getEmail('color') . ';text-decoration:none;font-size:14px" target="_blank">' . $emailer->getEmail('company') . '</a> </strong></p>
											</td>
										</tr>
									</tbody>
								</table>
								</td>
							</tr>
						</tbody>
					</table>
					</td>
				</tr>
				<tr>
					<td align="center">
					<table width="600">
						<tbody>
							<tr>
								<td>
								<p align="left" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;line-height:18px;color:#4b8da5;padding:10px 0;margin:0px;font-weight:normal">Quý khách nhận được email này vì đã liên hệ tại ' . $emailer->getEmail('company:website') . '.<br>
								Để chắc chắn luôn nhận được email thông báo, phản hồi từ ' . $emailer->getEmail('company:website') . ', quý khách vui lòng thêm địa chỉ <strong><a href="mailto:' . $emailer->getEmail('email') . '" target="_blank">' . $emailer->getEmail('email') . '</a></strong> vào số địa chỉ (Address Book, Contacts) của hộp email.<br>
								<b>Địa chỉ:</b> ' . $emailer->getEmail('company:address') . '</p>
								</td>
							</tr>
						</tbody>
					</table>
					</td>
				</tr>
			</tbody>
		</table>';

		/* Send email admin */
		$arrayEmail = array(
			"dataEmail" => array(
				"name" => $tennguoidung,
				"email" => $email
			)
		);
		$subject = "Thư cấp lại mật khẩu từ " . $setting['ten' . $lang];
		$message = $contentMember;
		$file = '';

		if ($emailer->sendEmail("customer", $arrayEmail, $subject, $message, $file)) {
			unset($_SESSION[$this->login_member]);
			set_cookie('login_member_id', "", -1, '/');
			set_cookie('login_member_session', "", -1, '/');
			transfer("Cấp lại mật khẩu thành công. Vui lòng kiểm tra email: " . $email, $this->config_base);
		} else {
			transfer("Có lỗi xảy ra trong quá trình cấp lại mật khẩu. Vui lòng liện hệ với chúng tôi.", $this->config_base . "account/quen-mat-khau", false);
		}
	}

	private function setVoucher($uid)
	{

		$per = 10; //10 phan tram
		$voucher1 = $this->voucher->generateVoucher("register", $per);
		$new_voucher = $voucher1->getVoucherId();

		$data = array(
			'code' => $new_voucher,
			'description' => 'register',
			'start_date' => time(),
			'end_date' => time(),
			'discount_amount' => 0,
			'discount_percentage' => $per,
			'is_one_time_use' => 0,
			'is_combinable' => 0,
			'deleted' => 0,
			'uid' => $uid,
		);
		$this->d->insert('coupons', $data);

		return true;

		//todo new insert

	}

	function get_info_ref()
	{

		$lang = 'vi';

		$this->data['product'] = $this->_Affiliate->product_generators($lang);
		$this->data['data'] = $this->_Affiliate->product_details();

	}

	function get_item_bank()
	{
		$d = $this->d;
		$this->data['item'] = $d->rawQueryOne("select * from #_bank where uid = ? limit 0,1", array($this->data['uid']));
	}

	function updateToCTV($uid)
	{
		$d = $this->d;
		$d->where('id', $uid);
		$d->update('member', array(
			'ref_nick' => 1
		));

		$data_ref = array(
			'user_id' => $uid,
			'code' => random_strings(10),
			//'url' => $this->config_base . 'san-pham',
			'visits' => 0,
			'ip' => getRealIPAddress(),
			'date_create' => date("Y-m-d H:i:s"),
		);

		if ($d->insert('ref', $data_ref)) {
			$this->_Affiliate->setRegister($data_ref['code']);

			$_SESSION[$this->login_member]['ref_nick'] = true;

			if ($_SESSION[$this->login_member]['ref_nick']) {
				transfer("Bạn đã trở thành cộng tác viên, đang chuyển hướng trang quản lý", $this->config_base . 'account/thong-bao-cong-tac-vien');
			}
		}
	}

}
