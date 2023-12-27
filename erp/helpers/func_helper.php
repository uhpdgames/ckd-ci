<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * fnCMS Global Functions Helpers
 *
 * @package     fnCMS Project
 * @since       Wednesday, May 20, 2015, 8:00 AM
 * @final
 * @category    Helpers
 * @author      10ngon - fnDev Team
 * @copyright   Copyright (c) 2015, fnDev
 */

$GLOBALS['loai_nhanvien'] = array(
    0 => array('name_vn' => 'Chính thức'),
    1 => array('name_vn' => 'Thử việc'),
    2 => array('name_vn' => 'Parttime')
);
$GLOBALS['loai_phieuchamcong'] = array('Làm việc giờ hành chính', 'Tăng ca ngày thường', 'Tăng ca ngày nghỉ', 'Tăng ca ngày lễ');
$GLOBALS['tinhtrang_honnhan'] = array('Độc thân', 'Đã kết hôn');
$GLOBALS['loai_hopdong'] = array('Không ký', 'Dưới 3 tháng', '6 tháng', '1 năm', '2 năm', '3 năm', 'Không thời hạn');
$GLOBALS['trinhdo'] = array('Tốt nghiệp THPT', 'Trung cấp nghề', 'Trung cấp chính quy', 'Cao đẳng nghề', 'Cao đẳng chính quy', 'Cử nhân', 'Cao học');

$GLOBALS['cot_bangluong'] = array(
    array('name_vn' => 'Phòng ban', 'id' => 'col_phongban'), //0
    array('name_vn' => 'Doanh số', 'id' => 'col_doanhso'), //1
    array('name_vn' => 'Xác định lương', 'id' => 'col_luong'), //2
    array('name_vn' => 'Lương cơ bản', 'id' => 'col_luong_cb'), //3
    array('name_vn' => 'Lương công việc', 'id' => 'col_luong_cv'), //4
    array('name_vn' => 'PC thâm niên', 'id' => 'col_phucap_thamnien'), //5
    array('name_vn' => 'PC xăng xe', 'id' => 'col_phucap_xang'), //6
    array('name_vn' => 'PC gửi xe', 'id' => 'col_phucap_guixe'), //7
    array('name_vn' => 'PC điện thoại', 'id' => 'col_phucap_dienthoai'),
    array('name_vn' => 'PC trách nhiệm', 'id' => 'col_phucap_trachnhiem'),
    array('name_vn' => 'PC chuyên cần', 'id' => 'col_phucap_chuyencan'),
    array('name_vn' => 'PC công tác', 'id' => 'col_phucap_congtac'),
    array('name_vn' => 'Tổng lương', 'id' => 'col_luong_tong'),
    array('name_vn' => 'Lương TV', 'id' => 'col_luong_thuviec'),
    array('name_vn' => 'Lương theo giờ', 'id' => 'col_luong_theogio'),
    array('name_vn' => 'Ngày công CT', 'id' => 'col_ngaycong'),
    array('name_vn' => 'Ngày công TV', 'id' => 'col_ngaycong_thuviec'),
    array('name_vn' => 'Giờ công', 'id' => 'col_giocong'),
    array('name_vn' => 'Phép lễ CT', 'id' => 'col_pheple'),
    array('name_vn' => 'Phép lễ TV', 'id' => 'col_pheple_thuviec'),
    array('name_vn' => 'OT ngày thường CT', 'id' => 'col_tangca_ngaythuong'),
    array('name_vn' => 'OT ngày thường TV', 'id' => 'col_tangca_ngaythuong_thuviec'),
    array('name_vn' => 'OT ngày nghỉ CT', 'id' => 'col_tangca_ngaynghi'),
    array('name_vn' => 'OT ngày nghỉ TV', 'id' => 'col_tangca_ngaynghi_thuviec'),
    array('name_vn' => 'OT ngày lễ CT', 'id' => 'col_tangca_ngayle'),
    array('name_vn' => 'OT ngày lễ TV', 'id' => 'col_tangca_ngayle_thuviec'),
    array('name_vn' => 'Lương thực tế CT', 'id' => 'col_luong_thucte'),
    array('name_vn' => 'Lương thực tế TV', 'id' => 'col_luong_thucte_thuviec'),
    array('name_vn' => 'Lương tăng ca CT', 'id' => 'col_luong_tangca'),
    array('name_vn' => 'Lương tăng ca TV', 'id' => 'col_luong_tangca_thuviec'),
    array('name_vn' => 'Lương truy lĩnh', 'id' => 'col_luong_truylinh'),
    array('name_vn' => 'Lương hiệu quả', 'id' => 'col_luong_hieuqua'),
    array('name_vn' => 'Hoa hồng (thù lao)', 'id' => 'col_hoahong'),
    array('name_vn' => 'Tổng thu nhập', 'id' => 'col_tong_thunhap'),
    array('name_vn' => 'Tạm ứng', 'id' => 'col_tamung'),
    array('name_vn' => 'Trừ trễ sớm CT', 'id' => 'col_tru_tresom'),
    array('name_vn' => 'Trừ trễ sớm TV', 'id' => 'col_tru_tresom_thuviec'),
    array('name_vn' => 'BHXH', 'id' => 'col_tien_bhxh'),
    array('name_vn' => 'BHYT', 'id' => 'col_tien_bhyt'),
    array('name_vn' => 'BHTN', 'id' => 'col_tien_bhtn'),
    array('name_vn' => 'Chiết giảm phụ thuộc', 'id' => 'col_chietgiam_phuthuoc'),
    array('name_vn' => 'Chiết giảm bản thân', 'id' => 'col_chietgiam_banthan'),
    array('name_vn' => 'Thu nhập không thuế', 'id' => 'col_thunhap_khongthue'),
    array('name_vn' => 'Thu nhập chịu Thuế', 'id' => 'col_thunhap_chiuthue'),
    array('name_vn' => 'Thuế TNCN', 'id' => 'col_thue_tncn'),
    array('name_vn' => 'Truy thu BS Thuế TNCN', 'id' => 'col_truythu_thuetncn'),
    array('name_vn' => 'Tổng giảm trừ', 'id' => 'col_tong_giamtru')
);
$GLOBALS['interfaces_groups'] = array(
    array('Logo', 1, 0, 0), //0
    array('Slider', 1, 0, 0), //1
    array('Box 1', 1, 4, 1), //2
    array('Box 2', 1, 4, 1), //3
    array('Box 3', 1, 4, 2), //4
    array('Box 4', 1, 4, 2), //5
    array('Box 5', 1, 6, 2), //6
    array('Box 6', 1, 6, 2), //7
    array('R&D box', 1, 6, 1), //8
    array('Hot prod.', 1, 0, 0), //9
    array('Applications', 1, 6, 2), //10
    array('Manuf. banner', 1, 0, 0), //11
    array('Box 3 banner', 1, 0, 0), //12
    array('Box 4 banner', 1, 0, 0), //13
    array('Box 5 banner', 1, 0, 0), //14
    array('Full banner', 1, 0, 0), //15
    array('New prod.', 1, 0, 0), //16
    array('Slider banner', 1, 0, 0) //17
);
$GLOBALS['viewall'] = array(
    '0' => 'Chi nhánh',
    '1' => 'Toàn bộ'
);
$GLOBALS['limit_perpage'] = array(
    10 => 10,
    25 => 25,
    50 => 50,
    100 => 100,
    200 => 200,
    300 => 300,
    400 => 400,
    500 => 500,
);
$GLOBALS['articles_options'] = array(
    'news' => array(
        'has_category' => 1,
        'hot' => 0
    ),
    'pages' => array(
        'has_category' => 0,
        'hot' => 0
    ),
    'services' => array(
        'has_category' => 1,
        'hot' => 0
    ),
    'videos' => array(
        'has_category' => 1,
        'hot' => 0
    ),
    'faqs' => array(
        'has_category' => 1,
        'hot' => 0
    )
);
// ------------------------------------------------------------------------

/**
 * Hàm consolePhp
 *
 * Dùng để debug
 *
 * @param   value array||object||string||function
 * @access  public
 * @return  html
 */
if (!function_exists('consolePhp')) {
    function consolePhp($value)
    {
        echo("<pre>");
        var_dump($value);
        echo("</pre>");
        exit;
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm token_validation
 *
 * Kiểm tra giá trị biến post token và session token
 *
 * @access  public
 * @return  true/false
 */
if (!function_exists('token_validation')) {
    function token_validation()
    {
        $ci = &get_instance();
        return ($ci->input->post('token', true) == $ci->session->userdata('token'));
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm write_log
 *
 * Ghi log thao tác một user trong admin cp
 *
 * @access  public
 * @param   log keyword
 * @param   log value
 * @return  null
 */
if (!function_exists('write_log')) {
    function write_log($log, $log_val = '')
    {
        $ci = &get_instance();
        $ci->db->query("SET NAMES 'LATIN1'");
        $info_log = explode('_', $log);
        if (count($info_log) == 3) {
            $info_log[0] = $log;
            $info_log[1] = '';
        }
        $do = array(
            'add' => 'Update',
            'update' => 'Update',
            'del' => 'Delete',
            'remove' => 'Permanently deleted',
            'restore' => 'Restore',
            'report' => 'Send port',
            'login' => 'Signin the system',
            'logout' => 'Logout the system',
            'permiss' => 'Access permissions',
            'move' => 'Move'
        );
        if (!empty($do[$info_log[0]])) {
            $log = $do[$info_log[0]] . ' ' . (isset($info_log[1]) ? get_data('modules', "file = '{$info_log[1]}'", 'name_en') : '');
        }
        $data = array(
            'user' => $ci->session->userdata('user_id'),
            'log' => $log,
            'log_val' => $log_val,
            'date_added' => date(TIME_SQL),
            'ip' => $ci->input->ip_address()
        );
        $ci->db->insert('userlogs', $data);
    }
}

if (!function_exists('write_log_active')) {
    function write_log_active($id, $table = '', $log_val = '', $date_login = '')
    {

    }
}

// ------------------------------------------------------------------------

/**
 * Hàm get_data
 *
 * Lấy giá trị của một field hoặc tất cả field từ bảng dữ liệu
 *
 * @access  public
 * @param   table name
 * @param   [, where condition = '']
 * @param   [, field = *]
 * @param   [, start = '']
 * @param   [, limit = '']
 * @param   [, order = '']
 * @return  field value if (field='field name')
 * @return  data array if (field='*')
 */
if (!function_exists('get_data')) {
    function get_data($table, $where = '', $field = '*', $start = '', $limit = '', $order = '')
    {
        $ci = &get_instance();
        if ($ci->db->table_exists($table)) {
            $ci->db->query('SET NAMES "LATIN1"');
            if (substr($field, 0, 1) != '*') $ci->db->select($field);
            if ($where != "") $ci->db->where($where);
            if ($order != "") $ci->db->order_by($order);
            if (is_numeric($start) && is_numeric($start)) $ci->db->limit($limit, $start);
            $q = $ci->db->get($table);
            if ($q->num_rows() > 0) {
                if ($field == '**') {
                    return $q->result_array();
                } else {
                    $data = $q->row_array();
                    if ($field != '*') return $data[$field];
                    else return $data;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm check_rights
 *
 * Kiểm tra quyền truy cập module quản lý
 *
 * @access  public
 * @param   module file (don't included .php)
 * @return  true/false
 */
if (!function_exists('check_rights')) {
    function check_rights($act = '', $do = 'view')
    {
        return true;

        if ($GLOBALS['var']['logged_in'] && $GLOBALS['var']['user_id'] > 0) {
            if (!$act) {
                $act = $GLOBALS['var']['act'] == 'sale' ? 'sales' : $GLOBALS['var']['act'];
            }

            return true;

            $user_rights = json_decode($GLOBALS['var']['user_rights']);
           // print_r( $user_rights);
            //die();
            if (@array_key_exists($act, $user_rights)) {
                if (@array_key_exists($do, $user_rights->$act) && $user_rights->$act->$do) {
                    return true;
                }
            }
        }
        return false;
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm strip_input
 *
 * Chuyển các ký tự đặc biệt (", ', \, <, >) sang mã tương ứng
 *
 * @access  public
 * @param   string
 * @return  string
 */
if (!function_exists('strip_input')) {
    function strip_input($text)
    {
        if (QUOTES_GPC) $text = stripslashes($text);
        $search = array('"', '\'', '\\', '<', '>');
        $replace = array('&quot;', '&#39;', '&#92;', '&lt;', '&gt;');
        $text = str_replace($search, $replace, $text);
        unset($search, $replace);
        return $text;
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm destrip_input
 *
 * Chuyển các mã ('&quot;', '&#39;', '&#92;', '&lt;', '&gt;') sang ký tự tương ứng
 *
 * @access  public
 * @param   string
 * @return  string
 */
if (!function_exists('destrip_input')) {
    function destrip_input($text)
    {
        if (QUOTES_GPC) $text = stripslashes($text);
        $search = array('&quot;', '&#39;', '&#92;', '&lt;', '&gt;');
        $replace = array('"', '\'', '\\', '<', '>');
        $text = str_replace($search, $replace, $text);
        unset($search, $replace);
        return $text;
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm viet_decode
 *
 * Chuyển văn bản có dấu sang không dấu
 *
 * @access  public
 * @param   string
 * @return  string in lowercase
 */
if (!function_exists('viet_decode')) {
    function viet_decode($str)
    {
        $chars = array(
            'a' => array('ấ', 'ầ', 'ẩ', 'ẫ', 'ậ', 'Ấ', 'Ầ', 'Ẩ', 'Ẫ', 'Ậ', 'ắ', 'ằ', 'ẳ', 'ẵ', 'ặ', 'Ắ', 'Ằ', 'Ẳ', 'Ẵ', 'Ặ', 'á', 'à', 'ả', 'ã', 'ạ', 'â', 'ă', 'Á', 'À', 'Ả', 'Ã', 'Ạ', 'Â', 'Ă'),
            'e' => array('ế', 'ề', 'ể', 'ễ', 'ệ', 'Ế', 'Ề', 'Ể', 'Ễ', 'Ệ', 'é', 'è', 'ẻ', 'ẽ', 'ẹ', 'ê', 'É', 'È', 'Ẻ', 'Ẽ', 'Ẹ', 'Ê'),
            'i' => array('í', 'ì', 'ỉ', 'ĩ', 'ị', 'Í', 'Ì', 'Ỉ', 'Ĩ', 'Ị'),
            'o' => array('ố', 'ồ', 'ổ', 'ỗ', 'ộ', 'Ố', 'Ồ', 'Ổ', 'Ỗ', 'Ô', 'Ộ', 'ớ', 'ờ', 'ở', 'ỡ', 'ợ', 'Ớ', 'Ờ', 'Ở', 'Ỡ', 'Ợ', 'ó', 'ò', 'ỏ', 'õ', 'ọ', 'ô', 'ơ', 'Ó', 'Ò', 'Ỏ', 'Õ', 'Ọ', 'Ô', 'Ơ'),
            'u' => array('ứ', 'ừ', 'ử', 'ữ', 'ự', 'Ứ', 'Ừ', 'Ử', 'Ữ', 'Ự', 'ú', 'ù', 'ủ', 'ũ', 'ụ', 'ư', 'Ú', 'Ù', 'Ủ', 'Ũ', 'Ụ', 'Ư'),
            'y' => array('ý', 'ỳ', 'ỷ', 'ỹ', 'ỵ', 'Ý', 'Ỳ', 'Ỷ', 'Ỹ', 'Ỵ'),
            'd' => array('đ', 'Đ'),
            '' => array('–', '?', '"', ':', '<', '>', '/', '\\', '{', '}', '{', '[', ']', '$', '%', '^', '&', '*', '(', ')', '!')
        );
        foreach ($chars as $key => $arr) {
            foreach ($arr as $val) {
                $str = str_replace($val, $key, $str);
            }
            unset($arr);
        }
        unset($chars);
        return trim($str);
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm format_size
 *
 * Định dạng kiểu hiển thị dung lượng lưu trữ (B, KB, MB, GB, TB, PB)
 *
 * @access  public
 * @param   int byte size
 * @return  string size
 */
if (!function_exists('format_size')) {
    function format_size($size)
    {
        $mod = 1024;
        $units = explode(' ', 'B KB MB GB TB PB');
        for ($i = 0; $size > $mod; $i++) {
            $size /= $mod;
        }
        unset($mod);
        return round($size, 2) . ' ' . $units[$i];
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm goodfile
 *
 * Kiểm tra sự tồn tại một tệp tin
 *
 * @access  public
 * @param   string file path
 * @return  true/false
 */
if (!function_exists('goodfile')) {
    function goodfile($file)
    {
        $invalidChars = array('\'', '"', ';', '>', '<', '.php');
        $file = str_replace($invalidChars, '', $file);
        unset($invalidChars);
        if (file_exists($file) && is_file($file)) return true;
        return false;
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm file_extension
 *
 * Lấy phần mở rộng một tệp tin
 *
 * @access  public
 * @param   string file name
 * @return  string
 */
if (!function_exists('file_extension')) {
    function file_extension($file)
    {
        return @end(explode('.', strtolower($file)));
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm upload
 *
 * Upload một tệp tin
 *
 * @access  public
 * @param   string file name
 * @param   string upload path
 * @param   string allowed types
 * @param   int max size
 * @param   int max width
 * @param   int max height
 * @return  array upload data : Mảng thông tin dữ liệu upload
 */
if (!function_exists('upload')) {
    function upload($field = '', $file_name='', $upload_path='', $allowed_types = 'gif|jpg|png|swf', $max_size = '2000', $max_width = '2400', $max_height = '2400')
    {
        $ci = &get_instance();
        $file_name = $file_name . ($field ? '-' . $field : '') . '-' . time();
        if ($field == '') $field = 'userfile';
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = $allowed_types;
        $config['max_size'] = $max_size;
        $config['max_width'] = $max_width;
        $config['max_height'] = $max_height;
        $config['file_name'] = $file_name;
        $config['overwrite'] = TRUE;
        $ci->upload->initialize($config);
        if ($ci->upload->do_upload($field)) {
            return $ci->upload->data();
        } else {
            return false;
        }
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm make_thumb
 *
 * Tạo ảnh thumb từ ảnh gốc
 *
 * @access  public
 * @param   string origin image path
 * @param   string new image thumb path
 * @param   int new width
 * @param   int new height
 * @return  null
 */
if (!function_exists('make_thumb')) {
    function make_thumb($img_name, $filename, $new_w, $new_h)
    {
        $ext = file_extension($img_name);
        list($old_x, $old_y) = getimagesize($img_name);
        $ratio1 = $old_x / $new_w;
        $ratio2 = $old_y / $new_h;
        if ($ratio1 > $ratio2) {
            $thumb_w = $new_w;
            $thumb_h = $old_y / $ratio1;
        } else {
            $thumb_h = $new_h;
            $thumb_w = $old_x / $ratio2;
        }
        $dst_img = imagecreatetruecolor($thumb_w, $thumb_h);
        if ($ext == 'jpg' || $ext == 'jpeg') {
            $src_img = imagecreatefromjpeg($img_name);
        } else if ($ext == 'gif') {
            imagecolortransparent($dst_img, imagecolorallocate($dst_img, 0, 0, 0));
            $src_img = imagecreatefromgif($img_name);
        } else if ($ext == 'png') {
            imagecolortransparent($dst_img, imagecolorallocate($dst_img, 0, 0, 0));
            imagealphablending($dst_img, false);
            imagesavealpha($dst_img, true);
            $src_img = @imagecreatefrompng($img_name);
            if (!$src_img) {
                $src_img = @imagecreatefromjpeg($img_name);
            }
        }
        if ($src_img) {
            imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y);
            if ($ext == 'png') imagepng($dst_img, $filename);
            else imagejpeg($dst_img, $filename, 100);
            imagedestroy($dst_img);
            imagedestroy($src_img);
        }
        unset($ext, $old_x, $old_y, $ratio1, $ratio2, $thumb_h, $thumb_w, $dst_img, $src_img);
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm sig_logo
 *
 * Đính logo vào ảnh
 *
 * @access  public
 * @param   string origin image path
 * @param   string new image path
 * @param   [, int type logo] (1 = color logo/2 = gray logo)
 * @param   [, int position]
 * @return  null
 */
if (!function_exists('sig_logo')) {
    function sig_logo($input, $output, $type_logo = 1, $pos_logo = 1, $logo = '')
    {
        $type = file_extension($input);
        if ($type == 'jpg') {
            $src_img = @imagecreatefromjpeg($input);
        } else if ($type == 'png') {
            $src_img = @imagecreatefrompng($input);
        }
        if ($src_img) {
            if ($logo && file_extension($logo) == 'png') {
                $pow_img = @imagecreatefrompng($logo);
            } else {
                if ($type_logo == 1) {
                    $pow_img = @imagecreatefrompng(LOGO_COLOR);
                }
                if ($type_logo == 2) {
                    $pow_img = @imagecreatefrompng(LOGO_GRAY);
                }
            }
            if ($pow_img) {
                $src_w = @imagesx($src_img);
                $src_h = @imagesy($src_img);
                $pow_w = @imagesx($pow_img);
                $pow_h = @imagesy($pow_img);
                $dst_img = @imagecreatetruecolor($src_w, $src_h);
                @imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $src_w, $src_h, $src_w, $src_h);
                if ($pos_logo == 1) {
                    @imagecopyresampled($dst_img, $pow_img, $src_w - 5 - $pow_w, $src_h - 5 - $pow_h, 0, 0, $pow_w, $pow_h, $pow_w, $pow_h);
                }
                if ($pos_logo == 2) {
                    @imagecopyresampled($dst_img, $pow_img, 5, $src_h - 5 - $pow_h, 0, 0, $pow_w, $pow_h, $pow_w, $pow_h);
                }
                if ($pos_logo == 3) {
                    @imagecopyresampled($dst_img, $pow_img, $src_w - 5 - $pow_w, 5, 0, 0, $pow_w, $pow_h, $pow_w, $pow_h);
                }
                if ($pos_logo == 4) {
                    @imagecopyresampled($dst_img, $pow_img, 5, 5, 0, 0, $pow_w, $pow_h, $pow_w, $pow_h);
                }
                if ($pos_logo == 5) {
                    @imagecopyresampled($dst_img, $pow_img, $src_w / 2 - $pow_w / 2, $src_h / 2 - $pow_h / 2, 0, 0, $pow_w, $pow_h, $pow_w, $pow_h);
                }
                if ($type == 'png') {
                    @imagepng($dst_img, $output, 100);
                } else @imagejpeg($dst_img, $output, 100);
                @imagedestroy($dst_img);
            }
        }
        unset($type, $src_img, $pow_img, $src_h, $src_w, $pow_h, $pow_w, $dst_img);
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm create_grayscale
 *
 * Tạo ảnh gray mode từ ảnh gốc
 *
 * @access  public
 * @param   string origin image path
 * @param   string new images gray path
 * @return  null
 */
if (!function_exists('create_grayscale')) {
    function create_grayscale($img_file, $new_img_file)
    {
        $type = file_extension($img_file);
        if ($type == 'jpg' || $type == 'jpeg') {
            $im = imagecreatefromjpeg($img_file);
        }
        if ($type == 'png') {
            $im = imagecreatefrompng($img_file);
        }
        if ($type == 'gif') {
            $im = imagecreatefromgif($img_file);
        }
        if ($im && imagefilter($im, IMG_FILTER_COLORIZE, 128, 128, 128)) {
            if ($type == 'png') {
                imagepng($im, $new_img_file, 100);
            } else {
                imagejpeg($im, $new_img_file, 100);
            }
            imagedestroy($im);
        }
        unset($type, $im);
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm url_uri
 *
 * Khởi tạo request uri bổ sung cho url từ mảng tham chiếu
 *
 * @access  public
 * @param   array : ('uri key' => 'uri value', ...)
 * @param   [, array] : array key to remove
 * @return  string request uri
 */
if (!function_exists('url_uri')) {
    function url_uri($uri, $remove = array())
    {
        $string = '';
        if (is_array($uri)) {
            foreach ($uri as $key => $value) {
                if ($value != '') {
                    if ((is_array($remove) && !in_array($key, $remove)) || (!is_array($remove) && $key != $remove)) $string .= ($string == '' ? '?' : '&') . $key . '=' . $value;
                }
            }
        } else if ($uri) {
            $string .= '?' . $uri;
        }
        return $string;
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm folder_size
 *
 * Tính toán dung lượng một thư mục
 *
 * @access  public
 * @param   string folder path
 * @return  int size
 */
if (!function_exists('folder_size')) {
    function folder_size($path)
    {
        $total_size = 0;
        $files = @scandir($path);
        if (!is_array($files)) {
            return 0;
        }
        foreach ($files as $t) {
            if (is_dir(rtrim($path, '/') . '/' . $t)) {
                if ($t <> '.' && $t <> '..') {
                    $size = @folder_size(rtrim($path, '/') . '/' . $t);
                    $total_size += $size;
                    unset($size);
                }
            } else {
                $size = @filesize(rtrim($path, '/') . '/' . $t);
                $total_size += $size;
                unset($size);
            }
            unset($t);
        }
        unset($files);
        return $total_size;
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm doiso
 *
 * Đọc số bằng chữ
 *
 * @access  public
 * @param   int number
 * @return  string text of num
 */
if (!function_exists('doiso')) {
    function doiso($amount)
    {
        if ($amount <= 0) {
            return $textnumber = "Tiền phải là số nguyên dương lớn hơn số 0";
        }
        $Text = array("không", "một", "hai", "ba", "bốn", "năm", "sáu", "bảy", "tám", "chín");
        $TextLuythua = array("", "nghìn", "triệu", "tỷ", "ngàn tỷ", "triệu tỷ", "tỷ tỷ");
        $textnumber = "";
        $length = strlen($amount);

        for ($i = 0; $i < $length; $i++)
            $unread[$i] = 0;

        for ($i = 0; $i < $length; $i++) {
            $so = substr($amount, $length - $i - 1, 1);

            if (($so == 0) && ($i % 3 == 0) && ($unread[$i] == 0)) {
                for ($j = $i + 1; $j < $length; $j++) {
                    $so1 = substr($amount, $length - $j - 1, 1);
                    if ($so1 != 0)
                        break;
                }

                if (intval(($j - $i) / 3) > 0) {
                    for ($k = $i; $k < intval(($j - $i) / 3) * 3 + $i; $k++)
                        $unread[$k] = 1;
                }
            }
        }

        for ($i = 0; $i < $length; $i++) {
            $so = substr($amount, $length - $i - 1, 1);
            if ($unread[$i] == 1)
                continue;

            if (($i % 3 == 0) && ($i > 0))
                $textnumber = $TextLuythua[$i / 3] . " " . $textnumber;

            if ($i % 3 == 2)
                $textnumber = 'trăm ' . $textnumber;

            if ($i % 3 == 1)
                $textnumber = 'mươi ' . $textnumber;


            $textnumber = $Text[$so] . " " . $textnumber;
        }

        //Phai de cac ham replace theo dung thu tu nhu the nay
        $textnumber = str_replace("không mươi", "lẻ", $textnumber);
        $textnumber = str_replace("lẻ không", "", $textnumber);
        $textnumber = str_replace("mươi không", "mươi", $textnumber);
        $textnumber = str_replace("một mươi", "mười", $textnumber);
        $textnumber = str_replace("mươi năm", "mươi lăm", $textnumber);
        $textnumber = str_replace("mươi một", "mươi mốt", $textnumber);
        $textnumber = str_replace("mười năm", "mười lăm", $textnumber);
        return ucfirst($textnumber . " đồng chẵn");
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm strtitle
 *
 * Định dạng chuỗi utf-8 in hoa ký tự đầu
 *
 * @access  public
 * @param   string text utf-8
 * @return  String Text Utf-8
 */
if (!function_exists('strtitle')) {
    function strtitle($str)
    {
        return mb_convert_case(trim($str), MB_CASE_TITLE, "UTF-8");
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm strupper
 *
 * Định dạng chuỗi utf-8 in hoa
 *
 * @access  public
 * @param   string text utf-8
 * @return  STRING TEXT UTF-8
 */
if (!function_exists('strupper')) {
    function strupper($str)
    {
        return mb_convert_case(trim($str), MB_CASE_UPPER, "UTF-8");
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm strlower
 *
 * Định dạng chuỗi utf-8 in thường
 *
 * @access  public
 * @param   String Text utf-8
 * @return  string text utf-8
 */
if (!function_exists('strlower')) {
    function strlower($str)
    {
        return mb_convert_case(trim($str), MB_CASE_LOWER, "UTF-8");
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm randomkeys
 *
 * Tạo chuỗi ký tự ngẫu nhiên gồm chữ in hoa và số
 *
 * @access  assets
 * @param   int len
 * @return  string random
 */


// ------------------------------------------------------------------------

/**
 * Hàm randomkeys_number
 *
 * Tạo chuỗi ký tự ngẫu nhiên chỉ gồm số
 *
 * @access  public
 * @param   int len
 * @return  string random number
 */


// ------------------------------------------------------------------------

/**
 * Hàm trimlink
 *
 * Cắt chuỗi với độ dài nhập vào
 *
 * @access  public
 * @param   string text : Chuỗi cần cát
 * @param   int lenght : Độ dài giới hạn
 * @param   [, boolean html = false] : Thay thế các mã html
 * @return  html text
 */
if (!function_exists('trimlink')) {
    function trimlink($text, $length, $html = true)
    {
        $dec = array("&", "\"", "'", "\\", '\"', "\'", "<", ">");
        $enc = array("&amp;", "&quot;", "&#39;", "&#92;", "&quot;", "&#39;", "&lt;", "&gt;");
        if ($html) $text = str_replace($enc, $dec, $text);
        if (strlen($text) > $length) {
            $len = 0;
            $arr = explode(' ', $text);
            $newtext = '';
            if (sizeof($arr) > 1) {
                for ($i = 0; $i < sizeof($arr); $i++) {
                    if ($len < $length - 3) {
                        $newtext .= $arr[$i] . " ";
                        $len += strlen($arr[$i]) + 1;
                    }
                }
            } else {
                $newtext = substr($arr[0], 0, $length);
            }
            unset($i, $len, $arr, $dec, $enc);
            return $newtext . "...";
        } else {
            unset($dec, $enc);
            return $text;
        }
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm week_of_month
 *
 * Tính tuần thứ mấy trong tháng từ chuỗi ngày tháng tương ứng
 *
 * @access  assets
 * @param   datetime date
 * @return  int index of week in month
 */
if (!function_exists('week_of_month')) {
    function week_of_month($date)
    {
        $date_parts = explode('-', $date);
        $date_parts[2] = '01';
        $first_of_month = implode('-', $date_parts);
        $day_of_first = date('N', strtotime($first_of_month));
        $day_of_month = date('j', strtotime($date));
        return floor(($day_of_first + $day_of_month - 1) / 7) + 1;
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm th_of_day
 *
 * Lấy thứ tương ứng của ngày nhập vào
 *
 * @access  assets
 * @param   string ngay
 * @param   string thang
 * @param   string name
 * @return  int chỉ số thứ
 */
if (!function_exists('th_of_day')) {
    function th_of_day($ngay, $thang, $nam)
    {
        $jd = cal_to_jd(CAL_GREGORIAN, $thang, $ngay, $nam);
        return jddayofweek($jd, 0);
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm format_time
 *
 * Định dạng thời gian với số phút nhập vào
 *
 * @access  public
 * @param   int time : Số phút
 * @return  string định dạng 0:00
 */
if (!function_exists('format_time')) {
    function format_time($time)
    {
        return floor($time / 60) . ':' . str_pad(floor($time % 60), 2, '0', STR_PAD_LEFT);
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm check_module_do
 *
 * Kiểm tra các hành động moddule được phép
 *
 * @access  assets
 * @param   module file (don't included .php)
 * @param   do : Hành động (add, edit, del, remove)
 * @return  true/false
 */
if (!function_exists('check_module_do')) {
    function check_module_do($act = '', $do = '')
    {
        if (!$act) {
            $act = $GLOBALS['var']['act'];
        }
        $rights = get_data('modules', 'file = "' . $act . '"', 'rights');
        $dos = json_decode($rights);
        if (@array_key_exists($do, $dos) && $dos->$do) {
            return true;
        }
        return false;
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm strip_mstags
 *
 * Thay thế các tags xấu khi copy text từ tệp ms word
 *
 * @access  public
 * @param   string text : Chuỗi cần thay thế
 * @return  html text
 */
if (!function_exists('strip_mstags')) {
    function strip_mstags($html)
    {
        $html = preg_replace('/<p style="(.+?)">(.+?)<\/p>/i', "<p>$2</p>", $html);
        $html = preg_replace('/<p class="(.+?)">(.+?)<\/p>/i', "<p>$2</p>", $html);
        $html = preg_replace('/<!--(.|\s)*?-->/', "", $html);
        $html = str_replace('<p>&nbsp;</p>', '', $html);
        $html = str_replace('<p class="MsoNormal"></p>', '', $html);
        $html = str_replace('<span></span>', '', $html);
        $html = trim(str_replace('<p></p>', '', $html));
        return $html;
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm saveimg
 *
 * Lưu ảnh từ web về hosting
 *
 * @access  public
 * @param   string imglink : Liên kết tới ảnh
 * @param   string dir : Thư mục lưu
 * @param   [, boolean made_thumb = false] : Tạo ảnh nhỏ
 * @param   [, boolean thumb_w = 240] : Chiều rộng ảnh nhỏ
 * @param   [, boolean thumb_h = 240] : Chiều cao ảnh nhỏ
 * @param   [, boolean gallery_w = 90] : Chiều rộng ảnh thư viện
 * @param   [, boolean gallery_h = 90] : Chiều cao ảnh thư viện
 * @return  string image file
 */
if (!function_exists('saveimg')) {
    function saveimg($imglink, $dir, $made_thumb = false, $thumb_w = 240, $thumb_h = 240, $gallery_w = 90, $gallery_h = 90)
    {
        $img = @file_get_contents($imglink);
        $img_name = str_replace('%20', '-', end(explode('/', $imglink)));
        $file = $dir . $img_name;
        if (@file_put_contents($file, $img)) {
            if ($made_thumb) {
                $thumb = $dir . 'thumbs/' . $img_name;
                $gallery = $dir . 'gallery/' . $img_name;
                @make_thumb($file, $thumb, $thumb_w, $thumb_h);
                @make_thumb($file, $gallery, $gallery_w, $gallery_h);
            }
            return $img_name;
        } else {
            return $imglink;
        }
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm getnews_content
 *
 * Lấy nội dung một tin tức
 *
 * @access  public
 * @param   string news_url : Liên kết tới tin
 * @param   string prefix : Chuỗi phân tách đầu
 * @param   string suffix : Chuỗi phân tách cuối
 * @return  html content
 */
if (!function_exists('getnews_content')) {
    function getnews_content($news_url, $prefix, $suffix)
    {
        $html = @file_get_contents($news_url);
        if (!$html) {
            return false;
        }
        $content = @end(@explode($prefix, $html));
        $content = @explode($suffix, $content);
        return $content[0];
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm getnews_images
 *
 * Lưu ảnh về host từ nội dung một tin tức
 *
 * @access  public
 * @param   string content : Nội dung tin
 * @param   string dir : Thư mục lưu ảnh
 * @return  html content
 */
if (!function_exists('getnews_images')) {
    function getnews_images($content, $dir)
    {
        preg_match_all('/<img[^>]+>/i', $content, $aMatches);
        if (is_array($aMatches) && count($aMatches)) {
            $imgs = array();
            foreach ($aMatches[0] as $img_tag) {
                preg_match_all('/src=("[^"]*")/i', $img_tag, $imgs[]);
            }
            foreach ($imgs as $img) {
                $imglink = str_replace(array('"', "'"), '', $img[1][0]);
                $img_name = saveimg($imglink, $dir);
                $content = str_replace($imglink, '../../' . $dir . $img_name, $content);
            }
        }
        return $content;
    }
}


// ------------------------------------------------------------------------

/**
 * Hàm get_price
 *
 * Lấy giá theo số lượng từ list giá
 *
 * @access  assets
 * @param   int giá sản phẩm
 * @param   int số lượng mua
 * @param   string pricelist danh sách giá theo số lượng
 * @return  int giá
 */
if (!function_exists('get_price')) {
    function get_price($price, $qty, $pricelist = '')
    {
   /*     $pricelists = explode("\n", trim($pricelist));
        if ($pricelist && count($pricelists) > 1) {
            $price = 0;
            for ($n = 0; $n < count($pricelists); $n++) {
                $pricelist = explode(':', $pricelists[$n]);
                $ranges = explode('-', $pricelist[0]);
                if ($qty >= trim($ranges[0]) && (!empty($ranges[1]) && $qty <= trim($ranges[1]))) $price = $pricelist[1];
            }
            if ($price == 0) {
                $n = count($pricelists) - 1;
                $pricelist = explode(':', $pricelists[$n]);
                $price = $pricelist[1];
            }
        }
        return $price;*/
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm phpexcel_align
 *
 * Đặt thuộc tính canh lề trái phải cho cell trong xuất excel
 *
 * @access  assets
 * @param   object obj excel
 * @param   string / array ele tên cell
 * @param   string align lề
 * @return  null
 */
if (!function_exists('phpexcel_align')) {
    function phpexcel_align($obj, $ele, $align = 'center')
    {
        if (is_object($obj)) {
            if ($align == 'left') {
                $align = PHPExcel_Style_Alignment::HORIZONTAL_LEFT;
            } else if ($align == 'right') {
                $align = PHPExcel_Style_Alignment::HORIZONTAL_RIGHT;
            } else if ($align == 'center') {
                $align = PHPExcel_Style_Alignment::HORIZONTAL_CENTER;
            }
            if (is_array($ele)) {
                foreach ($ele as $e) {
                    if ($align == 'wrap') {
                        $obj->getStyle($e)->getAlignment()->setWrapText(true);
                    } else {
                        $obj->getStyle($e)->getAlignment()->setHorizontal($align);
                    }
                }
            } else {
                if ($align == 'wrap') {
                    $obj->getStyle($ele)->getAlignment()->setWrapText(true);
                } else {
                    $obj->getStyle($ele)->getAlignment()->setHorizontal($align);
                }
            }
        }
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm phpexcel_valign
 *
 * Đặt thuộc tính canh lề trên dưới cho cell trong xuất excel
 *
 * @access  public
 * @param   object obj excel
 * @param   string / array ele tên cell
 * @param   string valign lề
 * @return  null
 */
if (!function_exists('phpexcel_valign')) {
    function phpexcel_valign($obj, $ele, $valign = 'center')
    {
        if (class_exists('php_excel') && is_object($obj)) {
            if ($valign == 'top') {
                $valign = PHPExcel_Style_Alignment::VERTICAL_TOP;
            } else if ($valign == 'bottom') {
                $valign = PHPExcel_Style_Alignment::VERTICAL_BOTTOM;
            } else {
                $valign = PHPExcel_Style_Alignment::VERTICAL_CENTER;
            }
            if (is_array($ele)) {
                foreach ($ele as $e) {
                    $obj->getStyle($e)->getAlignment()->setVertical($valign);
                }
            } else {
                $obj->getStyle($ele)->getAlignment()->setVertical($valign);
            }
        }
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm phpexcel_merge
 *
 * Dồn các cell trong xuất excel
 *
 * @access  public
 * @param   object obj excel
 * @param   string / array ele tên cell
 * @return  null
 */
if (!function_exists('phpexcel_merge')) {
    function phpexcel_merge($obj, $ele)
    {
        if (class_exists('php_excel') && is_object($obj)) {
            if (is_array($ele)) {
                foreach ($ele as $e) {
                    $obj->mergeCells($e);
                }
            } else {
                $obj->mergeCells($ele);
            }
        }
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm phpexcel_height
 *
 * Đặt độ cao cell trong xuất excel
 *
 * @access  public
 * @param   object obj excel
 * @param   string / array ele tên cell
 * @param   int h chiều cao cell
 * @return  null
 */
if (!function_exists('phpexcel_height')) {
    function phpexcel_height($obj, $ele, $h)
    {
        if (class_exists('php_excel') && is_object($obj)) {
            if (is_array($ele)) {
                foreach ($ele as $e) {
                    $obj->getRowDimension($e)->setRowHeight($h);
                }
            } else {
                $obj->getRowDimension($ele)->setRowHeight($h);
            }
        }
    }
}

/**
 * Hàm phpexcel_width
 *
 * Đặt độ rộng cell trong xuất excel
 *
 * @access  assets
 * @param   object obj excel
 * @param   string / array ele tên cell
 * @param   int h chiều cao cell
 * @return  null
 */
if (!function_exists('phpexcel_width')) {
    function phpexcel_width($obj, $ele)
    {
        if (class_exists('php_excel') && is_object($obj)) {
            if (is_array($ele)) {
                foreach ($ele as $e) {
                    $e = explode(',', $e);
                    $c = explode(':', $e[0]);
                    if (count($c) > 1) {
                        foreach ($c as $i) {
                            $obj->getColumnDimension($i[0])->setWidth($e[1]);
                        }
                    } else {
                        $obj->getColumnDimension($e[0])->setWidth($e[1]);
                    }
                }
            } else {
                $ele = explode(',', $ele);
                $c = explode(':', $ele[0]);
                if (count($c) > 1) {
                    foreach ($c as $i) {
                        $obj->getColumnDimension($i[0])->setWidth($ele[1]);
                    }
                } else {
                    $obj->getColumnDimension($ele[0])->setWidth($ele[1]);
                }
            }
        }
    }
}

/**
 * Hàm phpexcel_img
 *
 * Chèn ảnh trong xuất excel
 *
 * @access  public
 * @param   object obj excel
 * @param   string ele tên cell
 * @param   string img nguồn ảnh
 * @param   int w chiều rộng ảnh
 * @param   int h chiều cao ảnh
 * @param   int x vị trí canh lề trái
 * @param   int y vị trí canh lề trên
 * @return  null
 */
if (!function_exists('phpexcel_img')) {
    function phpexcel_img($obj, $ele, $img, $w, $h, $x, $y)
    {
        if (class_exists('php_excel') && is_object($obj)) {
            $objDrawing = new PHPExcel_Worksheet_Drawing();
            $objDrawing->setWorksheet($obj);
            $objDrawing->setPath($img);
            $objDrawing->setHeight($h);
            $objDrawing->setWidth($w);
            $objDrawing->setCoordinates($ele);
            $objDrawing->setOffsetX($x)->setOffsetY($y);
        }
    }
}

/**
 * Hàm phpexcel_format
 *
 * Định dạng cell trong xuất excel
 *
 * @access  public
 * @param   object obj excel
 * @param   string ele tên cell
 * @param   array format mảng định dạng
 * @return  null
 */
if (!function_exists('phpexcel_format')) {
    function phpexcel_format($obj, $ele, $format)
    {
        if (class_exists('php_excel') && is_object($obj)) {
            $fontArr = array();
            if (!empty($format['font'])) {
                $font = explode(',', $format['font']);
                foreach ($font as $value) {
                    $f = explode(':', $value);
                    if ($f[0] == 'color') {
                        $fontArr[$f[0]] = array('rgb' => str_replace('#', '', $f[1]));
                    } else {
                        $fontArr[$f[0]] = $f[1];
                    }
                }
            }
            $fillArr = array();
            if (!empty($format['fill'])) {
                $fill = explode(',', $format['fill']);
                foreach ($fill as $value) {
                    $f = explode(':', $value);
                    if ($f[0] == 'color') {
                        $fillArr[$f[0]] = array('rgb' => str_replace('#', '', $f[1]));
                    } else if ($f[0] == 'type') {
                        if ($f[1] == 'solid') {
                            $fillArr[$f[0]] = PHPExcel_Style_Fill::FILL_SOLID;
                        }
                    }
                }
            }
            $borderArr = array();
            if (!empty($format['border'])) {
                $border = explode(',', $format['border']);
                foreach ($border as $value) {
                    $f = explode(':', $value);
                    if ($f[1] == 'solid') {
                        $borderArr[$f[0]] = array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array('rgb' => str_replace('#', '', $f[2]))
                        );
                    }
                    if (!empty($f[2])) {
                        $borderArr[$f[0]]['color'] = array('rgb' => str_replace('#', '', $f[2]));
                    }
                }
            }
            $style = array(
                'font' => $fontArr,
                'fill' => $fillArr,
                'borders' => $borderArr
            );
            if (is_array($ele)) {
                foreach ($ele as $e) {
                    $obj->getStyle($e)->applyFromArray($style);
                }
            } else {
                $obj->getStyle($ele)->applyFromArray($style);
            }
        }
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm module_title
 *
 * Khổi tạo tiêu đề cho mô đun quản lý
 *
 * @access  assets
 * @param   act modunle
 * @return  string
 */
if (!function_exists('module_title')) {
    function module_title($act = '')
    {
        if ($act == '') {
            $act = $GLOBALS['var']['act'];
        }
        $title = get_data('modules', 'file = "' . $act . '"', 'name_vn');
        if ($GLOBALS['var']['do']) {
            $title = ($GLOBALS['var']['do'] == 'view' ? 'View detail' : ($GLOBALS['var']['id'] ? 'Update' : 'Add new')) . ' ' . str_replace(array('Danh sách', 'Quản lý'), '', $title);
        }
        return $title;
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm redirect_to
 *
 * Chuyển trang sau khi lưu dữ liệu
 *
 * @access  public
 * @param   uri array
 * @param   id update
 * @return  null
 */
if (!function_exists('redirect_to')) {
    function redirect_to($uri, $id = '')
    {
        if ($id > 0) {
            my_redirect($GLOBALS['var']['act'] . '/update/' . $id . url_uri($uri));
        } else {
            my_redirect($GLOBALS['var']['act'] . url_uri($uri));
        }
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm recurse_copy
 *
 * Copy thư mục
 *
 * @access  public
 * @param   src thư mục nguồn
 * @param   dst thư mục đích
 * @return  null
 */
if (!function_exists('recurse_copy')) {
    function recurse_copy($src, $dst)
    {
        $dir = opendir($src);
        @mkdir($dst);
        while (false !== ($file = readdir($dir))) {
            if ($file != '.' && $file != '..' && $file != '.idea' && $file != 'websites' && $file != 'websites_model') {
                if (is_dir($src . '/' . $file)) {
                    recurse_copy($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm recurse_del
 *
 * Xóa thư mục
 *
 * @access  public
 * @param   src thư mục nguồn
 * @return  null
 */
if (!function_exists('recurse_del')) {
    function recurse_del($src)
    {
        if (is_dir($src)) {
            $dir = opendir($src);
            while (false !== ($file = readdir($dir))) {
                if ($file != '.' && $file != '..') {
                    if (is_dir($src . '/' . $file)) {
                        recurse_del($src . '/' . $file);
                    } else {
                        unlink($src . '/' . $file);
                    }
                }
            }
            closedir($dir);
            @rmdir($dir);
        } else {
            @unlink($src . '.php');
        }
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm check_module
 *
 * Kiểm tra tình trạng mô đun quản lý
 *
 * @access  public
 * @param   module quản lý
 * @return  bool
 */
if (!function_exists('check_module')) {
    function check_module($table)
    {
        return get_data('modules', 'file = "' . $table . '" AND deleted = 0 AND active = 1', 'id');
    }
}

// ------------------------------------------------------------------------

/**
 * Header Redirect
 *
 * Header redirect in two flavors
 * For very fine grained control over headers, you could use the Output
 * Library's set_header() function.
 *
 * @access	assets
 * @param	string	the URL
 * @param	string	the method: location or redirect
 * @return	string
 */
if (!function_exists('my_redirect')) {
    function my_redirect($uri = '', $method = 'location', $http_response_code = 302)
    {
        if (!preg_match('#^https?://#i', $uri)) {
            $uri = site_url($uri);
        }
        $ci = &get_instance();
        if ($ci->input->is_ajax_request()) {
            if ($GLOBALS['var']['logged_in'] && $GLOBALS['var']['user_id'] > 0) {
                echo urlencode($uri);
            } else {
                echo 'window';
            }
            exit;
        } else {
            switch ($method) {
                case 'refresh':
                    header("Refresh:0;url=" . $uri);
                    break;
                default:
                    header("Location: " . $uri, TRUE, $http_response_code);
                    break;
            }
            exit;
        }
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm get_code
 *
 * Lấy mã tiếp theo của một bảng
 *
 * @access  public
 * @param   string table
 * @param   string where
 * @param   string prefix
 * @param   int string pad length
 * @return  int next index
 */
if (!function_exists('get_code')) {
    function get_code($prefix = '', $where = '', $table = '', $pad_length = 6)
    {
        $ci = &get_instance();
        if ($table == '') {
            $table = $GLOBALS['var']['act'];
        }
        if ($where) {
            $ci->db->where($where);
        }
        $ci->db->order_by('code desc');
        $ci->db->select('code');
        $ci->db->limit(1);
        $query = $ci->db->get($table);
        $code = @str_replace($prefix, '', $query->row()->code);
        $newcode = intval($code) + 1;
        return $prefix . str_pad($newcode, $pad_length, 0, STR_PAD_LEFT);
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm update_instock
 *
 * Cập nhật số lượng tồn kho mỗi kho hàng
 *
 * @access  public
 * @param   int parent
 * @param   int khohang
 * @return  null
 */
if (!function_exists('update_instock')) {
    function update_instock($parent, $khohang)
    {
        $ci = &get_instance();
        if ($ci->db->field_exists('tonkho' . $khohang, 'products')) {
            $ci->db->query('UPDATE products p SET tonkho' . $khohang . ' = (SELECT (IFNULL(SUM(soluong), 0)) FROM warehouse_inout_details WHERE product = CONCAT("", p.id, "") AND khohang = "' . $khohang . '" AND deleted = 0 AND tinhtrang = 1) WHERE id IN(SELECT product FROM warehouse_inout_details WHERE parent = "' . $parent . '")', false);
        }
        if ($GLOBALS['var']['act'] == 'warehouse_import') {
            $ci->db->query('UPDATE products p SET gia_nhap = (SELECT gia FROM warehouse_inout_details WHERE product = CONCAT("", p.id, "") AND khohang = "' . $khohang . '" AND deleted = 0 AND tinhtrang = 1) WHERE id IN(SELECT product FROM warehouse_inout_details WHERE parent = "' . $parent . '")', false);
        }
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm update_nocuoi
 *
 * Cập nhật số nợ cuối của khách hàng, nhà cung cấp
 *
 * @access  public
 * @param   int ncc
 * @param   int khachhang
 * @return  null
 */
if (!function_exists('update_nocuoi')) {
    function update_nocuoi($ncc = 0, $khachhang = 0)
    {
        $ci = &get_instance();
        $table = $ncc ? 'providers' : 'customers';
        $id = $ncc ? $ncc : $khachhang;
        $ci->db->query('UPDATE ' . $table . ' SET nocuoi = (SELECT (IFNULL(SUM(sotien), 0)) FROM debits WHERE ncc = "' . $ncc . '" AND khachhang = "' . $khachhang . '" AND deleted = 0) WHERE id = " ' . $id . '"', false);
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm update_doanhso
 *
 * Cập nhật doanh số của khách hàng, nhà cung cấp
 *
 * @access  assets
 * @param   int ncc
 * @param   int khachhang
 * @return  null
 */
if (!function_exists('update_doanhso')) {
    function update_doanhso($ncc = 0, $khachhang = 0)
    {
        $ci = &get_instance();
        $table = $ncc ? 'providers' : 'customers';
        $id = $ncc ? $ncc : $khachhang;
        $type = $ncc ? 0 : 3;
        $ci->db->query('UPDATE ' . $table . ' SET doanhso = (SELECT (IFNULL(SUM(IF(type = ' . $type . ', thanhtien, 0)), 0)) FROM warehouse_inout WHERE ncc = "' . $ncc . '" AND khachhang = "' . $khachhang . '" AND deleted = 0) WHERE id = " ' . $id . '"', false);
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm getMinInOut
 *
 * Tính số phút đi trễ sớm
 *
 * @access  public
 * @param   string mode
 * @param   string mCheck
 * @param   string mLikit
 * @return  int minutes
 */
if (!function_exists('getMinInOut')) {
    function getMinInOut($mode, $mCheck, $mLimit)
    {
        $min = 0;
        if ($mode == 'inam' || $mode == 'inpm' || $mode == 'ot') {
            $min = $mCheck - $mLimit;
        }
        if ($mode == 'outam' || $mode == 'outpm') {
            $min = $mLimit - $mCheck;
        }
        if ($min < 0) {
            $min = 0;
        }
        return $min;
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm str2min
 *
 * Chuyển chuỗi giờ phút thành số phút
 *
 * @access  public
 * @param   string H:i
 * @return  int minutes
 */
if (!function_exists('str2min')) {
    function str2min($str)
    {
        $min = 0;
        if ($str != "") {
            $time = explode(':', $str);
            if (count($time) > 1) {
                $min = $time[0] * 60 + $time[1];
            }
        }
        return $min;
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm calc_works
 *
 * Tính ngày công, giờ công làm việc
 *
 * @access  public
 * @param   array $dataatt : Thông tin chấm công
 * @return  array[ngay, gio]
 */
if (!function_exists('calc_works')) {
    function calc_works($dataatt)
    {
        $ngaycong = 0;
        $ngaycong_thuviec = 0;
        $giocong = 0;
        if ($dataatt['cach_tinhcong']) {
            $cong = 0;
            $inam = intval(str_replace(':', '', $dataatt['inam']));
            $outam = intval(str_replace(':', '', $dataatt['outam']));
            $inpm = intval(str_replace(':', '', $dataatt['inpm']));
            $outpm = intval(str_replace(':', '', $dataatt['outpm']));
            $gio_inam = intval(str_replace(':', '', $dataatt['gio_inam']));
            $gio_outam = intval(str_replace(':', '', $dataatt['gio_outam']));
            $gio_inpm = intval(str_replace(':', '', $dataatt['gio_inpm']));
            $gio_outpm = intval(str_replace(':', '', $dataatt['gio_outpm']));
            if ($inam && $inam < $gio_inam) {
                $dataatt['inam'] = $dataatt['gio_inam'];
            }
            if ($outam && $outam > $gio_outam) {
                $dataatt['outam'] = $dataatt['gio_outam'];
            }
            if ($inpm && $inpm < $gio_inpm) {
                $dataatt['inpm'] = $dataatt['gio_inpm'];
            }
            if ($outpm && $outpm > $gio_outpm) {
                $dataatt['outpm'] = $dataatt['gio_outpm'];
            }
            if ($inam && $outam) {
                $cong = str2min($dataatt['outam']) - str2min($dataatt['inam']);
            }
            if ($outpm && $inpm) {
                $cong = str2min($dataatt['outpm']) - str2min($dataatt['inpm']);
            }
            if ($inam && $outpm && !$outam && !$inpm) {
                $cong = str2min($dataatt['gio_outam']) - str2min($dataatt['inam']) + str2min($dataatt['outpm']) - str2min($dataatt['gio_inpm']);
            }
            if ($inam && $outpm && $outam && $inpm) {
                $cong = str2min($dataatt['outam']) - str2min($dataatt['inam']) + str2min($dataatt['outpm']) - str2min($dataatt['inpm']);
            }
            $giocong += $cong;
        } else {
            $hanthuviec = strtotime((isset($dataatt['hanthuviec']) ? $dataatt['hanthuviec'] : '0000-00-00') . ' 00:00:00');
            $date = strtotime($dataatt['date_add'] . ' 23:59:59');
            if ($dataatt['inam'] && ($dataatt['outpm'] || $dataatt['outam'])) {
                $thu7 = $GLOBALS['cfg']['ngaycongthu7'] && th_of_day($dataatt['ngay'], $dataatt['thang'], $dataatt['nam']) == 6;
                if ($date < $hanthuviec || $hanthuviec < 0) {
                    $ngaycong_thuviec += 0.5;
                    if ($thu7) {
                        $ngaycong_thuviec += 0.5;
                    }
                } else {
                    $ngaycong += 0.5;
                    if ($thu7) {
                        $ngaycong += 0.5;
                    }
                }
            }
            if ($dataatt['outpm'] && ($dataatt['inam'] || $dataatt['outam'] || $dataatt['inpm'])) {
                if ($date < $hanthuviec || $hanthuviec < 0) {
                    $ngaycong_thuviec += 0.5;
                } else {
                    $ngaycong += 0.5;
                }
            }
        }
        return array(
            'ngay' => $ngaycong,
            'ngay_thuviec' => $ngaycong_thuviec,
            'gio' => $giocong
        );
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm work_days
 *
 * Tính số ngày làm việc quy định trong tháng
 *
 * @access  public
 * @param   int $month : tháng
 * @param   int $year : năm
 * @return  float
 */
if (!function_exists('work_days')) {
    function work_days($month, $year, $congthu7)
    {
        $count = 0;
        $counter = mktime(0, 0, 0, $month, 1, $year);
        while (date('n', $counter) == $month) {
            $thu = date('w', $counter);
            if ($thu < 6 && $thu > 0) {
                $count++;
            }
            if ($thu == 6) {
                $count = $count + ($congthu7 ? 0.5 : 1);
            }
            $counter = strtotime('+1 day', $counter);
        }
        return $count;
    }
}

if (!function_exists('getTimeDiff')) {
    function betweentime($date_star, $date_cur = '', $valuereturn = 'auto')
    {
        if ($date_cur == '') {
            $date_cur = time();
        }
        $time = $date_cur - strtotime($date_star);
        $subfix = $time > 0 ? ' trước' : ' tới';
        $diff = abs($time);
        $years = floor($diff / (365 * 60 * 60 * 24));
        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
        $hour = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
        $minutes = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hour * 60 * 60) / (60));
        $secon = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hour * 60 * 60 - $minutes * 60));

        if ($valuereturn == 'y') {
            return $years;
        } else if ($valuereturn == 'm') {
            return $months;
        } else if ($valuereturn == 'd') {
            return $days;
        } else if ($valuereturn == 'h') {
            return $hour;
        } else if ($valuereturn == 'm') {
            return $minutes;
        } else if ($valuereturn == 's') {
            return $secon;
        } else if ($valuereturn == 'auto') {
            if ($years != 0) {
                return $years . ($months != 0 ? ' năm ' . $months . ' tháng' : ' năm') . $subfix;
            } else if ($months != 0) {
                return $months . ($days != 0 ? ' tháng ' . $days . ' ngày' : ' tháng') . $subfix;
            } else if ($days != 0) {
                return $days . ($hour != 0 ? ' ngày ' . $hour . ' giờ' : ' ngày') . $subfix;
            } else if ($hour != 0) {
                return $hour . ($minutes != 0 ? 'h' . $minutes . '\'' : ' giờ') . $subfix;
            } else if ($minutes != 0) {
                return $minutes . ' phút' . $subfix;
            } else {
                return $secon . ' giây' . $subfix;
            }
        }
        return $date_star;
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm sendmail
 *
 * Gửi email
 *
 * @access  assets
 * @param   cfg mảng chứa cấu hình SMTP
 * @param   email địa chỉ email nhận thư
 * @param   subject tiêu đề thư
 * @param   content nội dung thư
 * @param   type loại thư [letter: email bản tin, contact: email trả lời liên hệ]
 * @return  bool
 */
function sendmail($email, $subject = '', $content = '', $reply = '', $reply_name = '', $fCMS = false)
{
    require_once APPPATH . 'third_party/PHPMailer/class.phpmailer.php';
    require_once APPPATH . 'third_party/PHPMailer/class.smtp.php';
    $content = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>' . $subject . '</title></head>
        <body>' . $content . '</body>
        </html>';
    $mail = new PHPMailer();
    $mail->IsSMTP();
    if ($fCMS) {
        $mail->Host = 'pro55.emailserver.vn';
        $mail->Port = $GLOBALS['cfg']['smtp_port_cms'];
        $mail->SMTPSecure = $GLOBALS['cfg']['smtp_ssl_cms'];
        $mail->Username = $GLOBALS['cfg']['smtp_user_cms'];
        $mail->Password = $GLOBALS['cfg']['smtp_pass_cms'];
        $mail->SetFrom($GLOBALS['cfg']['smtp_email_cms'], $GLOBALS['cfg']['smtp_mailer_cms']);
        $mail->AddReplyTo($GLOBALS['cfg']['smtp_email_cms'], $GLOBALS['cfg']['smtp_mailer_cms']);
    } else {
        $mail->Host = $GLOBALS['cfg']['smtp_host'];
        $mail->Port = $GLOBALS['cfg']['smtp_port'];
        $mail->SMTPSecure = $GLOBALS['cfg']['smtp_ssl'];
        $mail->Username = $GLOBALS['cfg']['smtp_user'];
        $mail->Password = $GLOBALS['cfg']['smtp_pass'];
        $mail->SetFrom($GLOBALS['cfg']['smtp_email'], $GLOBALS['cfg']['smtp_mailer']);
        $mail->AddReplyTo($reply ? $reply : $GLOBALS['cfg']['contact_email'], $reply_name ? $reply_name : $GLOBALS['cfg']['smtp_mailer']);
    }
    $mail->SMTPAuth = true;
    $mail->AddAddress($email);
    $mail->WordWrap = 50;
    $mail->IsHTML(true);
    $mail->SMTPDebug = false;
    $mail->Subject = $subject;
    $mail->CharSet = 'utf-8';
    $mail->Body = $content;
    return $mail->Send();
}

// ------------------------------------------------------------------------

/**
 * Hàm write_activities
 *
 * Ghi activities liên quan tới customer account
 *
 * @access  public
 */
if (!function_exists('write_activities')) {
    function write_activities($data)
    {
        $ci = &get_instance();
        $ci->db->query("SET NAMES 'LATIN1'");
        if (is_array($data)) {
            $ci->db->where('code', $data['code']);
            $ci->db->where('ActionID', $data['ActionID']);
            $ci->db->where('Module', $data['Module']);
            $query = $ci->db->get('customer_activities');
            if (!$query->num_rows()) {
                $ci->db->insert('customer_activities', $data);
            } else {
                if ($query->row_array()['CreateDate'] != $data['CreateDate']) {
                    $ci->db->insert('customer_activities', $data);
                } else {
                    $ci->db->where('id', $query->row_array()['id']);
                    $ci->db->update('customer_activities', $data);
                }
            }
            write_last_activities($data['CustomerID'], $data['CreateDate'], 'customers');
        }
        return false;
    }
}
// ------------------------------------------------------------------------

/**
 * Hàm write_last_activities
 *
 * Ghi last activities của customer account
 *
 * @access  public
 */
if (!function_exists('write_last_activities')) {
    function write_last_activities($ID, $Date, $Table)
    {
        $ci = &get_instance();
        $ci->db->query("SET NAMES 'LATIN1'");
        if (!$ID && !$Table) {
            return false;
        }
        if (!isset($Date)) {
            $Date = NULL;
        }
        $ci->db->where('id', $ID);
        $query = $ci->db->get($Table);
        if ($query->num_rows()) {
            $arr = $query->row_array();
            $ci->db->flush_cache();
            if ($arr['LastActivities'] == NULL || $Date > $arr['LastActivities']) {
                $data = array('LastActivities' => $Date);
                $ci->db->where('id', $ID);
                $ci->db->update($Table, $data);
            }
        }
        return false;
    }
}
// ------------------------------------------------------------------------

/**
 * Hàm check_activities
 *
 * So sánh ngày hiện tại và biến limited_activities để check_activities của customer account
 *
 * @access  public
 */
if (!function_exists('check_activities')) {
    function check_activities($Table)
    {
		return false;

        $ci = &get_instance();
        if (!$Table) {
            return false;
        }
        $ci->db->query("SET NAMES 'LATIN1'");
        $ci->db->where('active', 1);
        $ci->db->where('deleted', 0);
        $query = $ci->db->get($Table);
        $now = time();
        $realtime = 0;
        if ($query->num_rows()) {
            $arr = $query->result_array();
            foreach ($arr as $key => $value) {
                if ($value['LastActivities'] != NULL) {
                    $your_date = strtotime($value['LastActivities']);
                    $datediff = ($now - $your_date);
                    $realtime = floor($datediff / (60 * 60 * 24));
                }
                if ($value['CheckActivities'] == 1 && $realtime >= $value['LimitedActivities']) {
                    $data = array('CheckActivities' => 0);
                    $ci->db->where('id', $value['id']);
                    $ci->db->update($Table, $data);
                }
                if ($value['CheckActivities'] == 0 && $realtime < $value['LimitedActivities']) {
                    $data = array('CheckActivities' => 1);
                    $ci->db->where('id', $value['id']);
                    $ci->db->update($Table, $data);
                }
            }
        }
        return false;
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm random color
 *
 *
 * @access  public
 */
if (!function_exists('random_color_part')) {
    function random_color_part()
    {
        return str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
    }
}
if (!function_exists('random_color')) {
    function random_color()
    {
        return random_color_part() . random_color_part() . random_color_part();
    }
}


// ------------------------------------------------------------------------

/**
 * Hàm write_project_activities
 *
 * Ghi activities liên quan tới customer account
 *
 * @access  public
 */
if (!function_exists('write_project_activities')) {
    function write_project_activities($data, $flag_update = false)
    {
        $ci = &get_instance();
        $ci->db->query("SET NAMES 'LATIN1'");
        if (is_array($data)) {
            $ci->db->where('code', $data['code']);
            $ci->db->where('ActionID', $data['ActionID']);
            $ci->db->where('Module', $data['Module']);
            $query = $ci->db->get('customer_project_activities');
            if ($flag_update) {
                $data['Description'] = 'Update Stage of Project: ' . $data['Description'];
                $ci->db->insert('customer_project_activities', $data);
            } else {
                if (!$query->num_rows()) {
                    $ci->db->insert('customer_project_activities', $data);
                } else {
                    if ($query->row_array()['CreateDate'] != $data['CreateDate']) {
                        $ci->db->insert('customer_project_activities', $data);
                    } else {
                        $ci->db->where('id', $query->row_array()['id']);
                        $ci->db->update('customer_project_activities', $data);
                    }
                }
            }
            $ci->db->flush_cache();
            $ci->db->where('id', $query->row_array()['id']);
            $ci->db->update('projects_customer', array('LastActivities' => $data['CreateDate']));
            write_last_activities($data['ProjectID'], $data['CreateDate'], 'customers');
        }
        return false;
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm supplier_activities
 *
 * Ghi activities liên quan tới customer account
 *
 * @access  public
 */
if (!function_exists('supplier_activities')) {
    function supplier_activities($data)
    {
        $ci = &get_instance();
        $ci->db->query("SET NAMES 'LATIN1'");
        if (is_array($data)) {
            $ci->db->where('code', $data['code']);
            $ci->db->where('action_id', $data['action_id']);
            $ci->db->where('supplier_id', $data['supplier_id']);
            $ci->db->where('module', $data['module']);
            $query = $ci->db->get('supplier_activities');
            if (!$query->num_rows()) {
                $ci->db->insert('supplier_activities', $data);
            } else {
                if (date('Y-m-d', strtotime($query->row_array()['date_added'])) != date('Y-m-d', strtotime(TIME_SQL)) && $query->row_array()['user_added'] != $data['user_added']) {
                    $ci->db->insert('supplier_activities', $data);
                } else {
                    $ci->db->where('id', $query->row_array()['id']);
                    $ci->db->update('supplier_activities', $data);
                }
            }
        }
        return false;
    }
}

if (!function_exists('dayLeft')) {
    function dayLeft($day1 = '')
    {
        if($day1 == '') return '';
        $sign = '-';
        $curDate = date('Y-m-d');
        if($curDate < $day1) $sign = '';
        $daysLeft = abs(strtotime($curDate) - strtotime($day1));
        $rs = ((int) date('d', $daysLeft) - 1);
        return ($rs == 0 ? '' : $sign . $rs);
    }
}

if (!function_exists('get_name_customer')) {
    function get_name_customer($id = '')
    {
        $ci = &get_instance();
        $ci->db->where('id', $id);
        $ci->db->where('deleted', 0);
        $ci->db->select('CompanyNameLo');
        $query = $ci->db->get('customers');
        if ($query->num_rows > 0) {
            return $query->row()->CompanyNameLo;
        } else {
            return '';
        }
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm chuyển đổi chuổi thành utf 8
 *
 * Ghi activities liên quan tới customer account
 *
 * @access  public
 */
if (!function_exists('transutf8')) {
    function transutf8($d)
    {
        if (is_array($d)) {
            foreach ($d as $k => $v) {
                $d[$k] = transutf8($v);
            }
        } else if (is_string($d)) {
            return utf8_encode($d);
        }
        return $d;
    }
}

// ----------------------------------------------------------------------
/**
 * @param  $str     text
 * [highlight keyword on the text]
 * @param  $keyword letters are highlighted
 * @return html code
 */
if (!function_exists('highlight')) {
    function highlight($str, $keyword)
    {
        return str_replace($keyword, "<span style='color: darkred; background: yellow'><i><b>$keyword</b></i></span>", $str);
    }
}

// ----------------------------------------------------------------------
/**
 * [get_ext     get the extention of a file link in string type ]
 * @var [$str]  file link
 * @return string
 */
if (!function_exists('get_ext')) {
    function get_ext($str = '')
    {
        if ($str == '') return '';
        $ext = explode('.', $str);
        if (count($ext) > 0) {
            return end($ext);
        } else {
            return '';
        }
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm chuyển đổi chuổi thành Code thành ID
 *
 *
 *
 * @access  public
 */
if (!function_exists('trans_code2id')) {
    function trans_field2id($id = '', $field = '', $field_join = '', $table = '', $table_join = '')
    {
        $ci = &get_instance();
        $ci->db->from($table . ' AS tbl1');
        $ci->db->select('tbl1.' . $id . ' AS newid, tbl1.' . $field . ' AS newfield');
        $ci->db->last_query();
        $query = $ci->db->get();
        if ($query->num_rows()) {
            foreach ($query->result_array() as $data) {
                $id_join = get_data($table_join, $field_join . ' = "' . $data['newfield'] . '"', 'id');
                if ($id_join > 0) {
                    $ci->db->query('UPDATE ' . $table . ' SET ' . $field . ' = ' . $id_join . ' WHERE ' . $id . ' = ' . $data['newid']);
                }
            }
        }
        return false;
    }
}

if (!function_exists('record_del')) {
    function record_del($table = '', $where = '')
    {
        if ($table != '' && $where != '') {
            $ci = &get_instance();
            if ($ci->db->table_exists($table)) {
                $ci->db->where($where);
                $ci->db->delete($table);
                echo $ci->db->last_query();
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

// ------------------------------------------------------------------------

/**
 * Dành cho các phiên bản PHP không hỗ trợ
 *
 *
 *
 * @access  public
 */
if (!function_exists('array_column')) {
    function array_column(array $input, $columnKey, $indexKey = null)
    {
        $array = array();
        foreach ($input as $value) {
            if (!array_key_exists($columnKey, $value)) {
                trigger_error("Key \"$columnKey\" does not exist in array");
                return false;
            }
            if (is_null($indexKey)) {
                $array[] = $value[$columnKey];
            } else {
                if (!array_key_exists($indexKey, $value)) {
                    trigger_error("Key \"$indexKey\" does not exist in array");
                    return false;
                }
                if (!is_scalar($value[$indexKey])) {
                    trigger_error("Key \"$indexKey\" does not contain scalar value");
                    return false;
                }
                $array[$value[$indexKey]] = $value[$columnKey];
            }
        }
        return $array;
    }
}

// ------------------------------------------------------------------------

/**
 * array key id
 *
 *
 *
 * @access  public
 */
if (!function_exists('array_with_id')) {
    function array_with_id($field = '', $table = '')
    {
        if ($table == '') {
            $table = $GLOBALS['var']['act'];
        }
        if ($field != '') {
            $ci = &get_instance();
            if ($ci->db->table_exists($table)) {
                $ci->db->select('id, ' . $field);
                $query = $ci->db->get($table);
                if ($query->num_rows()) {
                    $arr = array();
                    foreach ($query->result_array() as $row) {
                        $arr[$row['id']] = $row[$field];
                    }
                    return $arr;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}


/*Hàm push set_notification*/
if (!function_exists('set_notification')) {
    function set_notification($title, $content, $uid, $updated_id = '', $module = false)
    {
        $link = NULL;
        if (!$module) $module = $GLOBALS['var']['act'];
        if ($updated_id != '') $link = site_url($module . '/update/' . $updated_id);
        $ci = &get_instance();
        $ci->load->library('push_notifi');
        $push = new Push_notifi();
        $push->link = $link;
        $push->module = $module;
        $push->set_uid($uid);
        $push->set_title($title);
        $push->set_content($content);
        $push->push();
    }
}
/*Hàm push get_notification*/
if (!function_exists('get_notification')) {
    function get_notification()
    {
        $uid = $GLOBALS['var']['user_id'];
        $ci = &get_instance();
        $date = new DateTime("now");
        $curr_date = $date->format('Y-m-d'); //sent ="0"
        $info = get_data('notification', 'sent ="0" and active ="1" and deleted ="0" and DATE(date_added) ="' . $curr_date . '"', '**');
        if (is_array($info) && count($info)) {
            foreach ($info as $item) {
                if ($uid == $item['uid']) {
                    setcookie('push_notify', "true", time() + 3600, '/');
                    setcookie('notify_title', $item['title'], time() + 3600, '/');
                    setcookie('notify_content', $item['content'], time() + 3600, '/');
                    $ci->fn->process(array('sent' => 1), $item['id'], 'notification');
                }
            }
        }
    }
}
/*Hàm đếm notifi*/
if (!function_exists('count_notifi')) {
    function count_notifi()
    {
        $d = get_data('notification', 'read ="0" and uid = "' . $GLOBALS['var']['user_id'] . '"', '**');
        return !empty($d) ? count($d) : 0;
    }
}
/*Hàm info notifi*/
if (!function_exists('info_notifi')) {
    function info_notifi()
    {
        $date = new DateTime("now");
        $today = $date->format('Y-m-d');
        $notifi = array();
        $notifi['new'] = get_data('notification', 'DATE(date_added) ="' . $today . '" and deleted ="0" and active ="1" and uid = "' . $GLOBALS['var']['user_id'] . '"', '**', '', '', 'date_added DESC');
        $notifi['old'] = get_data('notification', 'date_added < " ' . $today . '" and deleted ="0" and active ="1" and uid = "' . $GLOBALS['var']['user_id'] . '"', '**', '', 100, 'date_added DESC');
        format_real_time($notifi['new'], 'date_added');
        format_real_time($notifi['old'], 'date_added');
        return $notifi;
    }
}
