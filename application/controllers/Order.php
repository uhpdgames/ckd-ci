<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends MY_Controller
{

    function __construct()
    {
        parent::__construct();

		$this->d = $this->data['d'];
		$this->voucher = new EGiftVoucherSystem();
		$this->checkVoucher();
		$this->uid =  (isset($_SESSION[$this->data['login_member']]['id'])) ? $_SESSION[$this->data['login_member']]['id'] : 0;

		$this->myVoucher = new EGiftVoucherUser($this->d, $this->uid);
    }

	private function checkVoucher(){
		$rsVoucher = $this->d->rawQuery('select code from #_user_coupons');
		if (is_array($rsVoucher) && count($rsVoucher)) {
			$allVoucher = $rsVoucher['code'];
			$this->voucher->setAllVouchers($allVoucher);
		}
	}

    public function index()
    {

        $d = $this->data['d'];
        $cart = new Cart($d);

        $lang = $this->current_lang;

		$tui_giay = $this->session->userdata('has_tuigiay');

        /* Tỉnh thành */
        $city = $d->rawQuery("select ten, id from #_city order by id asc");

        /* Hình thức thanh toán */
        $httt = $d->rawQuery("select ten$lang, mota$lang, id, photo from #_news where type = ? order by stt,id desc", array('hinh-thuc-thanh-toan'));

		$voucher = $d->rawQueryOne("select id as id_voucher,code as magiamgia,start_date,end_date,discount_amount,discount_percentage,is_one_time_use,is_combinable,used_date from #_coupons where type = ? and uid = ? and deleted = 0 limit 0,1", array('register', @$this->userInfo['id']));


		$config = $this->config->item('main_config');

		$this->data['tui_giay'] = $tui_giay;
        $this->data['cart'] = $cart;
        $this->data['config'] = $config;
        $this->data['city'] = $city;
        $this->data['httt'] = $httt;

		$this->data['voucher'] = $voucher ?? array();//@$this->userInfo['voucher'];

		$this->data['template'] = 'page/order/index';
        $this->load->view('template', $this->data);
    }

    public function process()
    {

        $func = $this->data['func'];
        $d = $this->data['d'];
        $cart = new Cart($d);

        $lang = $this->current_lang;
       // $emailer = new Email($d);
        $login_member = $this->data['login_member'];
        $setting = $this->data['setting'];

        if (isset($_POST['thanhtoan'])) {

			$chitietdonhang = '';
			$infoEmail = $this->infoEmail();


			/* Gán giá trị gửi email */
			$madonhang = strtoupper(stringRandom(6));
			$magioithieu = getRequest('magioithieu');
            $hoten = getRequest('ten');
            $email = getRequest('email');
            $dienthoai = getRequest('dienthoai');
            $city = getRequest('city');
            $district = getRequest('district');
            $wards = getRequest('wards');
            $diachi = htmlspecialchars($_POST['diachi']);
            $httt = getRequest('payments');

 			
            $htttText = ($httt) ? $func->get_payments($httt) : '';
            $yeucaukhac = getRequest('yeucaukhac');
            $tamtinh = getRequest('price-temp');
            $ship = getRequest('price-ship');
            $ship_code = getRequest('ship_code');
            $total = getRequest('price-total');
            $tui_giay = getRequest('tui_giay');
            $coupon_id = getRequest('coupon_id');
			$giadagiam = getRequest('giadagiam');

			$ngaydangky = time();

            if ($httt == '1') {
                $_SESSION['momo']['httt'] = $httt;
                $_SESSION['momo']['thanhpho'] = $city;
                $_SESSION['momo']['quan'] = $district;
                $_SESSION['momo']['phuong'] = $wards;
                $_SESSION['momo']['hoten'] = $hoten;
                $_SESSION['momo']['dienthoai'] = $dienthoai;
                $_SESSION['momo']['diachi'] = $diachi;
                $_SESSION['momo']['email'] = $email;
                $_SESSION['momo']['noidung'] = $yeucaukhac;
                $_SESSION['momo']['tamtinh'] = $tamtinh;
                $_SESSION['momo']['ship'] = $ship;
                $_SESSION['momo']['ship_code'] = $ship_code;
                $_SESSION['momo']['khoiluong'] = $cart->get_order_weight();
                $_SESSION['momo']['tonggia'] = $total;
               // $_SESSION['momo']['tonggia'] = 1000;
                $_SESSION['momo']['ngaydangky'] = $ngaydangky;
                $_SESSION['momo']['ngaycapnhat'] = $ngaydangky;
                $_SESSION['momo']['madonhang'] = $madonhang;

                require_once SHAREDLIBRARIES . "MoMoPayment.class.php";

                $momo = new MoMoPayment($d);
                //Thông tin đơn hàng cần chuyển qua MoMo
                $orderId = $_SESSION['momo']['madonhang'];
                $amount = $_SESSION['momo']['tonggia']; //tổng giá trị đơn hàng
                $orderInfo = 'Thanh toan cho don hang ' . $orderId;
                $requestId = $orderId;
                $extraData = ''; //exp: email=abc@gmail.com; <key>=<value>;<key>=<value>

                // Lưu ý: Nhớ Lưu thông tin đơn hàng với trạng thái là 0 trước khi chuyển link qua MoMo thanh toán
                // đơn hàng thanh toán momo có 3 trạng thái:
                // 0: chưa xử lý 1: đã xử lý và giao dịch thành công  2: đã xử lý và giao dịch thất bại

                // tạo url thanh toán qua MoMo
                $arr_res = $momo->create_url_payment($orderId, $amount, $orderInfo, $requestId, $extraData);
                // dump($arr_res);
                if ($arr_res['errCode'] == 0) {
                    //nếu không có lỗi,chuyển trang qua MoMo thực hiện việc thanh toán
                    $func->redirect($arr_res['mess']);
                } else {
                    // hiển thị thông báo lỗi
                    echo 'Error: ' . $arr_res['mess'];
                    exit();
                }
            } elseif ($httt == '2')
            {
                $config = [
                    "app_id" => 3057,
                    "key1" => "T7GPrP9XTH6e9Ls993U2sGbHSHYw6Vqi",
                    "key2" => "30y698aCwcM5jYpFYC0X4PFOol4IYojh",
                    //"endpoint" => "https://sb-openapi.zalopay.vn/v2/create", //Sanbox
                    "endpoint" => "https://openapi.zalopay.vn/v2/create", //Real
                ];
                $_SESSION['zalo']['httt'] = $httt;
                $_SESSION['zalo']['thanhpho'] = $city;
                $_SESSION['zalo']['quan'] = $district;
                $_SESSION['zalo']['phuong'] = $wards;
                $_SESSION['zalo']['hoten'] = $hoten;
                $_SESSION['zalo']['dienthoai'] = $dienthoai;
                $_SESSION['zalo']['diachi'] = $diachi;
                $_SESSION['zalo']['email'] = $email;
                $_SESSION['zalo']['noidung'] = $yeucaukhac;
                $_SESSION['zalo']['tamtinh'] = $tamtinh;
                $_SESSION['zalo']['ship'] = $ship;
                $_SESSION['zalo']['ship_code'] = $ship_code;
                $_SESSION['zalo']['khoiluong'] = $cart->get_order_weight();
                $_SESSION['zalo']['tonggia'] = $total;
                //$_SESSION['zalo']['tonggia'] = 1000;
                $_SESSION['zalo']['ngaydangky'] = $ngaydangky;
                $_SESSION['zalo']['ngaycapnhat'] = $ngaydangky;
                $_SESSION['zalo']['madonhang'] = $madonhang;

                $embeddata = '{"redirecturl":"https://ckdvietnam.com/zalo_return"}';//Merchant's data '{}';
                $items = '[]'; //Merchant's data
                $transID = $_SESSION['zalo']['madonhang']; //rand(0,1000000); //Random trans id
                $order = [
                    "app_id" => $config["app_id"],
                    "app_time" => round(microtime(true) * 1000), //miliseconds
                    "app_trans_id" => date("ymd") . "_" . $transID, //translation missing: vi.docs.shared.sample_code.comments.app_trans_id
                    "app_user" => "CKD",
                    "item" => $items,
                    "embed_data" => $embeddata,
                    "amount" => $_SESSION['zalo']['tonggia'],
                    //"callback_url" => "https://uta.ckdvietnam.com/",
                    "description" => 'CKD - Thanh toan don hang #' . $_SESSION['zalo']['madonhang'] . ' vao luc ' . date("d/m/Y H:i:s"),
                    "bank_code" => "",//CC, ATM, zalopayapp
                    "phone" => $_SESSION['zalo']['dienthoai'],
                    "email" => $_SESSION['zalo']['email'],
                    "address" => $_SESSION['zalo']['diachi'],
                ];
                //appid|app_trans_id|appuser|amount|apptime|embeddata|item
                $data = $order["app_id"] . "|" . $order["app_trans_id"] . "|" . $order["app_user"] . "|" . $order["amount"]
                    . "|" . $order["app_time"] . "|" . $order["embed_data"] . "|" . $order["item"];
                $order["mac"] = hash_hmac("sha256", $data, $config["key1"]);
                $context = stream_context_create([
                    "http" => [
                        "header" => "Content-type: application/x-www-form-urlencoded\r\n",
                        "method" => "POST",
                        "content" => http_build_query($order)
                    ]
                ]);
                $resp = file_get_contents($config["endpoint"], false, $context);
                $result = json_decode($resp, true);


                if (!empty($result) and $result['return_code'] == 1 and $result['return_message'] == 'Giao dịch thành công') {
                    redirect($result['order_url']);
                } else {
                    transfer("Thanh toán thất bại. Vui lòng thử lại", '', false);
                }
            }else{

				//Thanh toàn bình thường
			
				$max = (isset($_SESSION['cart'])) ? count($_SESSION['cart']) : 0;
				$stt = 0;
				for ($i = 0; $i < $max; $i++) {
					$stt = $i + 1;
					$pid = $_SESSION['cart'][$i]['productid'];
					$q = $_SESSION['cart'][$i]['qty'];
					$color = $_SESSION['cart'][$i]['mau'];
					$size = $_SESSION['cart'][$i]['size'];
					$code = $_SESSION['cart'][$i]['code'];
					$proinfo = $cart->get_product_info($pid);
					$pmau = $cart->get_product_mau($color);
					$psize = $cart->get_product_size($size);
					$textsm = '';
					if ($pmau != '' && $psize != '') $textsm = $pmau . " - " . $psize;
					else if ($pmau != '') $textsm = $pmau;
					else if ($psize != '') $textsm = $psize;

					if ($q == 0) continue;
					$chitietdonhang .= '<tbody bgcolor="#e6e6e6"';

					$chitietdonhang .= ' style="font-family:Roboto,sans-serif;font-size:12px;color:#444;line-height:18px" ><tr>';
					$chitietdonhang .= '<td align="left" style="padding: 15px 20px; ' . ($stt == $max ? "border-top-left-radius:0;border-bottom-left-radius:15px;" : "") . '" valign="top">';
					$chitietdonhang .= '<span style="display:block;font-weight:bold">' . $proinfo['ten' . $lang] . '</span>';
					if ($textsm != '') $chitietdonhang .= '<span style="display:block;font-size:12px">' . $textsm . '</span>';
					$chitietdonhang .= '</td>';
					if ($proinfo['giamoi']) {
						$chitietdonhang .= '<td align="left" style="padding:15px 20px;" valign="top">';
						$chitietdonhang .= '<span style="display:block;color:#000;font-weight: bolder;">' . format_money($proinfo['giamoi']) . '</span>';
						$chitietdonhang .= '<span style="display:block;color:#999;text-decoration:line-through;font-size:11px;">' . format_money($proinfo['gia']) . '</span>';
						$chitietdonhang .= '</td>';
					} else {
						$chitietdonhang .= '<td align="left" style="padding:15px 20px;" valign="top"><span style="color:#000;">' . format_money($proinfo['gia']) . '</span></td>';
					}
					$chitietdonhang .= '<td align="center" style="padding:15px 20px;" valign="top">' . $q . '</td>';

					if ($proinfo['giamoi']) {
						$chitietdonhang .= '<td align="right" style="padding: 15px 20px; ' . ($stt == $max ? "border-bottom-right-radius:15px;" : "") . '" valign="top">';
						$chitietdonhang .= '<span style="display:block;color:#000;font-weight: bolder;">' . format_money($proinfo['giamoi'] * $q) . '</span>';
						$chitietdonhang .= '<span style="display:block;color:#999;text-decoration:line-through;font-size:11px;">' . format_money($proinfo['gia'] * $q) . '</span>';
						$chitietdonhang .= '</td>';
					} else {
						$chitietdonhang .= '<td align="right" style="padding: 15px 20px; ' . ($stt == $max ? "border-bottom-right-radius:15px;" : "") . '" valign="top"><span style="color:#000;">' . format_money($proinfo['gia'] * $q) . '</span></td>';
					}

					$chitietdonhang .= '</tr></tbody>';
				}

			}


            $chitietdonhang .= '
		<tfoot style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
			<tr>
				<td align="right" colspan="3" style="padding:5px 9px">Tạm tính</td>
				<td align="right" style="padding:5px 9px"><span>' . format_money($tamtinh) . '</span></td>
			</tr>';
            if ($ship) {
                $chitietdonhang .=
                    '<tr>
					<td align="right" colspan="3" style="padding:5px 9px">Phí vận chuyển</td>
					<td align="right" style="padding:5px 9px"><span>' . format_money($ship) . '</span></td>
				</tr>';
            }
            $chitietdonhang .= '
			<tr>
				<td align="right" colspan="3" style="padding:7px 9px"><strong><big>Tổng giá trị đơn hàng</big> </strong></td>
				<td align="right" style="padding:7px 9px"><strong><big><span>' . format_money($total) . '</span> </big> </strong></td>
			</tr>
		</tfoot>';

            /* Nội dung gửi email cho admin */
            $contentAdmin = '';

            /* Nội dung gửi email cho khách hàng */
            $contentCustomer = '<table align="center" bgcolor="#3d5b2d" border="0" cellpadding="0" cellspacing="0" style="margin:0;padding:0;background-color:#f2f2f2;width:100%!important;font-family:Roboto,sans-serif;font-size:12px;color:#444;line-height:18px" width="100%">
    <tbody>
    <tr >
        <td align="center" style="font-family:Roboto,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">
            <table border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #3d5b2d;  padding: 25px; border-radius: 25px;background:#fff; margin-top: 50px;margin-bottom: 15px;" width="900" >
                <tbody style="background:#fff;">
                <tr style="background:#fff;">
                    <td align="center" id="m_-6357629121201466163headerImage" valign="bottom">
                        <table cellpadding="0" cellspacing="0" style="border-bottom:2px solid ' . $infoEmail['color'] . ';padding-bottom:10px;background-color:#fff" width="100%">
                            <tbody>
                            <tr>
                                <td bgcolor="#FFFFFF" style="padding:0" valign="top" width="100%">
                                    <div style="display:flex;justify-content:space-between;align-items:center;">
                                        <table style="width:100%;">
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <a href="' . $infoEmail['home'] . '" style="border:medium none;text-decoration:none;color:#007ed3;margin:0px 0px 0px 20px" target="_blank">' . $infoEmail['logo'] . '</a>
                                                </td>
                                                <td style="padding:15px 20px 0 0;text-align:right">' . $infoEmail['social'] . '</td>
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
                    <td align="left" height="auto" style="padding:15px" width="900">
                        <table style="width:100%;">
                            <tbody>
                            <tr>
                                <td>
                                    <p style="margin:4px 0;font-family:Roboto,sans-serif;font-size:14px;color:#444;line-height:18px;font-weight:bold">
                                        Xin chào: ' . $hoten . '</p>
                                    <p style="margin:4px 0;font-family:Roboto,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">
                                        Đơn hàng #' . $madonhang . ' của bạn đã đặt hàng thành công<br/>
                                        <span style="font-size:12px;color:#777;text-transform:none;font-weight:normal">(Ngày ' . date('d', $infoEmail['datesend']) . ' tháng ' . date('m', $infoEmail['datesend']) . ' năm ' . date('Y H:i:s', $infoEmail['datesend']) . ')</span>
                                        </p>
                                    <h3 style="font-size:16px;font-weight:bold;color:' . $infoEmail['color'] . ';text-transform:uppercase;margin:20px 0 0 0;padding: 0 0 5px;border-bottom:1px solid #3d5b2d">Thông tin đơn hàng</h3>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-family:Roboto,sans-serif;font-size:12px;color:#444;line-height:18px">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th align="left" style="padding:6px 9px 0px 0px;font-family:Roboto,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td style="margin: 0;padding: 0;border-top:0;font-family:Roboto,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">

                                                <ul style="margin: 0;padding: 0; list-style-type: none;">
                                                    <li><span style="text-transform:capitalize">' . $hoten . '</span></li>
                                                    <li><a href="mailto:' . $email . '" target="_blank">' . $email . '</a></li>
                                                    <li><span style="text-transform:capitalize">' . $dienthoai . '</span></li>
                                                    <li><span style="text-transform:capitalize">' . $diachi . '</span></li>
                                                </ul>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td colspan="2" style="padding:0;border-top:0;font-family:Roboto,sans-serif;font-size:12px;color:#444" valign="top">
                                                <p style="font-family:Roboto,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><strong>Hình thức thanh toán: </strong> ' . $htttText . '';
            if ($ship) {
                $contentCustomer .= '<br><strong>Phí vận chuyển: </strong> ' . format_money($ship);
            }
            $contentCustomer .= '</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h2 style="text-align:left;margin:10px 0;border-bottom:1px solid #3d5b2d;padding-bottom:5px;font-size:16px;color:' . $infoEmail['color'] . '">CHI TIẾT ĐƠN HÀNG</h2>

                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                        <thead>
                                        <tr style="background-color: #3d5b2d">
                                            <th align="left" dddbgcolor="' . $infoEmail['color'] . '" style="padding: 15px 20px;color:#fff;font-family:Roboto,sans-serif;font-size:15px;line-height:14px;border-radius: 15px 0 0 0;">Sản phẩm</th>
                                            <th align="left" dddbgcolor="' . $infoEmail['color'] . '" style="padding: 15px 20px;color:#fff;font-family:Roboto,sans-serif;font-size:15px;line-height:14px">Đơn giá</th>
                                            <th align="center" dddbgcolor="' . $infoEmail['color'] . '" style="padding: 15px 20px;color:#fff;font-family:Roboto,sans-serif;font-size:15px;line-height:14px;min-width:55px;">Số lượng</th>
                                            <th align="right" dddbgcolor="' . $infoEmail['color'] . '" style="padding: 15px 20px;color:#fff;font-family:Roboto,sans-serif;font-size:15px;line-height:14px;border-radius: 0 15px 0 0;">Tổng tạm</th>
                                        </tr>
                                        </thead>
                                        ' . $chitietdonhang . '
                                    </table>
                                    <div style="margin:auto;text-align:center"><a href="' . $infoEmail['home'] . '" style="display:inline-block;text-decoration:none;background-color:' . $infoEmail['color'] . '!important;text-align:center;border-radius:25px;color:#fff;padding:5px 25px;font-size:12px;font-weight:bold;margin-top:5px" target="_blank">Chi tiết đơn hàng tại ' . $infoEmail['company:website'] . '</a></div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;
                                    <p style="font-style:italic;font-family: Roboto,sans-serif; font-size: 12px; color: #808080;  font-weight: lighter;  padding: 0;list-style-type: none; text-align: center;width: 800px;margin: auto; ">
                                         Cảm ơn bạn tin  chọn sản phẩm <br/> 
                                         Chúc bạn có những trải nghiệm tuyệt vời khi mua sắm tại ' . $infoEmail['company:website'] . '
                                    </p>
                                       <p style="font-style:italic;font-family: Roboto,sans-serif; font-size: 12px; color: #808080;  font-weight: lighter;  padding: 0;list-style-type: none; text-align: center;width: 800px;margin: auto; ">Trân trọng,</p>
                                         <p style="font-style:italic;font-family: Roboto,sans-serif; font-size: 14px; color: #808080;  font-weight: bold;  padding: 0; list-style-type: none; text-align: center; width: 800px;margin: auto; ">Đội ngũ Cty TNHH Bluepink</p> 
                                         <p style="font-style:italic;font-family: Roboto,sans-serif; font-size: 12px; color: #808080;  font-weight: lighter;  padding: 0;list-style-type: none; text-align: center;width: auto;margin: auto; ">
                                         Bạn có thắc mắc? Liên hệ chúng tôi qua <a href="mailto:' . $infoEmail['company:email'] . '" style="color:' . $infoEmail['color'] . ';text-decoration:none" target="_blank"> <strong>' . $infoEmail['company:email'] . '</strong> </a>, hoặc gọi về hotline <strong style="color:' . $infoEmail['color'] . '">' . $infoEmail['company:hotline'] . '</strong>
                                         </p>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;
                                     
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
            <table width="900">
                <tbody>
                <tr>
                    <td>
                        <p align="left" style="font-family: Roboto,sans-serif; font-size: 10px; line-height: 15px; color: #787675; padding: 10px 0; margin: 0px; font-weight: normal;">Quý khách nhận được email này vì đã mua hàng tại ' . $infoEmail['company:website'] . '.<br>
                            Để chắc chắn luôn nhận được email thông báo, xác nhận mua hàng từ ' . $infoEmail['company:website'] . ', quý khách vui lòng thêm địa chỉ <strong><a href="mailto:' . $infoEmail['email'] . '" target="_blank">' . $infoEmail['email'] . '</a></strong> vào số địa chỉ (Address Book, Contacts) của hộp email.<br>
                        </p>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>';
            /* lưu đơn hàng */
            $data_donhang = array();
            $data_donhang['id_user'] = @$this->userInfo['id']??0;
            $data_donhang['madonhang'] = $madonhang;
            $data_donhang['hoten'] = $hoten;
            $data_donhang['dienthoai'] = $dienthoai;
            $data_donhang['diachi'] = $diachi;
            $data_donhang['email'] = $email;
            $data_donhang['httt'] = $httt;
            $data_donhang['phiship'] = $ship;
            $data_donhang['ship_code'] = $ship_code;
            $data_donhang['tamtinh'] = $tamtinh;
            $data_donhang['tonggia'] = $total;
            $data_donhang['khoiluong'] = $cart->get_order_weight();
            $data_donhang['yeucaukhac'] = $yeucaukhac;
            $data_donhang['ngaytao'] = $ngaydangky;
            $data_donhang['tinhtrang'] = 1;
            $data_donhang['city'] = $city;
            $data_donhang['district'] = $district;
            $data_donhang['wards'] = $wards;
            $data_donhang['stt'] = 1;
            $data_donhang['thongbao'] = 1;
            $data_donhang['tui_giay'] = $tui_giay;
            $data_donhang['coupon_id'] = $coupon_id;
            $data_donhang['giadagiam'] = $giadagiam;

            //$_Affiliate->setRegister($magioithieu);
            // $info = $_Affiliate->_getRef();
            /*$data_donhang['ref_id'] = $info['id'];
            $data_donhang['ref_uid'] = $info['user_id'];
            $data_donhang['ref_code'] = $info['code'];*/

            $id_insert = $d->insert('order', $data_donhang);

            /* lưu đơn hàng chi tiết */
            if ($id_insert) {
                if($coupon_id){

					$d->where('id', $coupon_id);
					$d->update('coupons',
					array('used_date'=>time()));


					/* $this->where('id',$coupon_id);
					 $this->update('coupons',array(
						 'used_date'=>time(),
					 ));*/
                }
                $product_list = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
                for ($i = 0; $i < $max; $i++) {
                    $pid = $_SESSION['cart'][$i]['productid'];
                    $q = $_SESSION['cart'][$i]['qty'];
                    $proinfo = $cart->get_product_info($pid);
                    $gia = $proinfo['gia'];
                    $giamoi = $proinfo['giamoi'];
                    $color = $cart->get_product_mau($_SESSION['cart'][$i]['mau']);
                    $size = $cart->get_product_size($_SESSION['cart'][$i]['size']);
                    $code = $_SESSION['cart'][$i]['code'];

                    if ($q == 0) continue;

                    $product_list[$i]['photo'] = $proinfo['photo'];
                    $product_list[$i]['gia'] = $gia;
                    //$product_list[$i]['giamoi'] = $giamoi;
                    $product_list[$i]['ten'] = $proinfo['ten' . $lang];

                    $data_donhangchitiet = array();
                    $data_donhangchitiet['id_product'] = $pid;
                    $data_donhangchitiet['id_order'] = $id_insert;
                    $data_donhangchitiet['photo'] = $proinfo['photo'];
                    $data_donhangchitiet['ten'] = $proinfo['ten' . $lang];
                    $data_donhangchitiet['code'] = $code;
                    $data_donhangchitiet['mau'] = $color;
                    $data_donhangchitiet['size'] = $size;
                    $data_donhangchitiet['gia'] = $gia;
                    $data_donhangchitiet['khoiluong'] = $proinfo['khoiluong'];
                    $data_donhangchitiet['giamoi'] = $giamoi;
                    $data_donhangchitiet['soluong'] = $q;

                    if ($d->insert('order_detail', $data_donhangchitiet)) {
                        $d->rawQuery("Update #_product SET soluong=soluong-" . $q . ",daban=daban+" . $q . " WHERE id ='" . $pid . "'");
                    }

                }

                //todo Update:affilite
                if ($magioithieu) {

                    //unset($product_list['code']);
                    //unset($product_list['size']);
                    //unset($product_list['mau']);

                    //$magioithieu $_SESSION[$login_ctv]['code']

                    //$commissions = $_Affiliate->getRate();
                    //$revenue = ($commissions * $tamtinh) / 100;

                    /*$_Affiliate->insertRefOrder(
                        array(
                            'buyer_uid' => $data_donhang['id_user'],
                            'order_id' => $id_insert,
                            'code' => $magioithieu,
                            'product_list' => $product_list,
                            'revenue' => $revenue
                        )
                    );*/
                }
            }

            /* Send email admin */

            /* Send email customer */
            $subject = "Xác nhận đặt hàng thành công " . $setting['ten' . $lang] ?? " từ CKD VIỆT NAM";


			try{
				$this->sendEmail(
					$email,
					$subject,
					$contentCustomer
				);
			}catch (Exception $e){

			}

            /* Xóa giỏ hàng */
            unset($_SESSION['cart']);
            transfer("Thông tin đơn hàng đã được gửi thành công.");
        }
    }

    public function email_client($emailer)
    {

    }

    public function email_admin($emailer)
    {

    }
}
