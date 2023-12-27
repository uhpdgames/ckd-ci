<?php





// ------------------------------------------------------------------------

$GLOBALS['pagi_entries'] = array(
    '1',
    '10',
    '25',
    '50',
    '100',
    '200',
    '300',
    '400',
    '500'
);

function dateformat($date)
{
	return $date != '' ? date('d/m/Y', @strtotime($date)) : '';
}


function select_users()
{
	$html =  '';


	$users = get_data('table_member', '','**');



	$arr = array();

	$html = '<label for="select-uid" class="col-form-label">Người dùng:</label><select required class="select2 form-control" name="uid" id="select-uid">';
	$html.= '<option value="">Tất cả</option>';
	foreach ($users as $item){
		if(empty($item['username']) || empty($item['id'])) continue;

	//	$arr[$item['id']] = $item['username'];
		$html.= '<option value="'.$item['id'].'">'.$item['username'] .' - ' . $item['ten'].'</option>';

	}

	$html .='</select>';
	//qq($users);
	return $html;

}
function label_html($typle = false)
{

	$html = '<div class="text-primary badge badge-pill badge-outline-warning text-center p-2"><i class="iconsminds-yes"></i></div>';
	if(!$typle){
		$html = '<div class="text-primary badge badge-pill badge-outline-warning text-center p-2"><i class="iconsminds-close"></i></div>';
	}

	return $html;
}

function label_function($arr_text, $arr_link, $arr_icon)
{


	$text = '';
	foreach ($arr_text as $key=>$name){
		$modal = 'data-toggle="modal" data-target="#ModalContent" data-whatever="@getbootstrap" ';
		$text .='<a type="button" '.($key=="them-moi"? $modal :'').' class="btn btn-primary btn-lg top-right-button mr-1" href="'.$arr_link[$key].'"><i class="'.$arr_icon[$key].'"></i>'.$name.'</a>';
	}

	$html = '<div class="text-zero top-right-button-container">'
.$text.'
					
						<div class="btn-group">
							<div class="btn btn-primary btn-lg pl-4 pr-0 check-button">
								<label class="custom-control custom-checkbox mb-0 d-inline-block">
									<input type="checkbox" class="custom-control-input" id="checkAll">
									<span class="custom-control-label">&nbsp;</span>
								</label>
							</div>
							<button type="button"
									class="btn btn-lg btn-primary dropdown-toggle dropdown-toggle-split"
									data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="sr-only">Toggle Dropdown</span>
							</button>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="#">Di chuyển vào thùng rác</a>
								<a class="dropdown-item" href="#">Xóa tất cả</a>

							</div>
						</div>
					</div>';




	return $html;

}

function label_action()
{
	$html = '<button style="filter: blur(2px); user-select: none;pointer-events: none;" id="btnGroupDrop1" type="button" class="display btn btn-secondary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Hành động
                                </button>
                                ';

	$html .= '<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <a class="dropdown-item" href="#">Xóa</a>
                                    <a class="dropdown-item" href="#">Sửa</a>
                                    <a class="dropdown-item" href="#">Tắt</a>
                                </div>';

	return $html;

}

/**
 * Hàm del_restore_link
 *
 * Tạo liên kết xóa / khôi phục / xóa vĩnh viễn một mục
 *
 * @access  assets
 * @param   int id : id mục cần xóa
 * @param   [, int deleted = 0] : nếu mục đang bị xóa vào thùng rác (deleted = 1) sẽ xuất hiện liên kết xóa vĩnh viễn
 * @param   [, boolean no_remove] : không ẩn mục khi xóa
 * @param   [, boolean remove_link] : cho hiển thị link xóa vĩnh viễn không phụ thuộc vào chế độ xem đã xóa
 * @param   [, table] : bảng dữ liệu cần xóa
 * @return  icon bin/refresh [remove]
 */
if ( ! function_exists('del_restore_link')) {
    function del_restore_link($id, $deleted = 0, $no_remove = false, $remove_link = false, $table = '')
    {
        $html = '<a href="javascript:;" data-placement="bottom" title="' . ($deleted ? 'Khôi phục' : 'Xóa') . '" class="delRestoreLink" data-id="' . $id . '" data-table="' . $table . '"><div class="icon glyphicons ' . ($deleted ? 'refresh' : 'bin') . ($no_remove ? ' no-remove' : '') . ' waves-effect waves-circle"></div></a>';
        if ($deleted || $remove_link == true) {
            $html .= ' ' . remove_link($id, $table);
        }
        return $html;
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm remove_link
 *
 * Tạo liên kết xóa vĩnh viễn một mục
 *
 * @access  assets
 * @param   int id : id mục cần xóa
 * @param   [, table] : bảng dữ liệu cần xóa
 * @return  icon remove
 */
if ( ! function_exists('remove_link')) {
    function remove_link($id, $table = '')
    {
        return '<a href="javascript:;" data-placement="bottom" title="Xóa vĩnh viễn" class="removeLink" data-id="' . $id . '" data-table="' . $table . '"><div class="icon glyphicons remove waves-effect waves-circle"></div></a>';
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm edit_alink
 *
 * Tạo liên kết chỉnh sửa một mục
 *
 * @access  assets
 * @param   [id = ''] : id mục chỉnh sửa
 * @param   [, string href = ''] : liên kết đến trang chỉnh sửa
 * @param   [, string class = ''] : thuộc tính class của link
 * @param   [, string style = ''] : style bổ sung của link
 * @return  icon edit
 */
if ( ! function_exists('edit_alink')) {
    function edit_alink($id = '', $href = '', $class = '', $style = '')
    {
        if ($href == '') {
            $href = 'javascript:;';
        }
        return '<a href="' . $href . '" data-placement="bottom" title="Sửa" class="' . ($class ? $class : 'ajax') . '"' . ($id ? ' data-id="' . $id . '"' : '') . '><div class="icon glyphicons edit waves-effect waves-circle"' . ($style ? ' style="' . $style . '"' : '') . '></div></a>';
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm no_data_mes
 *
 * Hiển thị thông báo không có dữ liệu khi xem danh sách dữ liệu một module
 *
 * @access  assets
 * @param   [int colspan = ''] : giá trị colspan cho tag td
 * @return  html text
 */
if ( ! function_exists('no_data_mes')) {
    function no_data_mes($colspan = '')
    {
        return '<tr class="empty-row"><td class="center"' . ($colspan ? ' colspan="' . $colspan . '"' : '') . ' style="height: 100px; font-size:16px; text-align:center;"><span class="small" style="color: red;"><strong>Không có dữ liệu!</strong></span></td></tr>';
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm change_status
 *
 * Tạo liên kết ajax đổi trạng thái một field dữ liệu
 *
 * @access  assets
 * @param   int id : id mục cần update
 * @param   int value : giá trị update (1/0)
 * @param   string field : trường cần update
 * @param   [, string name = ''] : trên trường update
 * @param   [, boolean one_sel = false] : chỉ 1 mục được chọn trong danh sách
 * @param   [, string style = ''] : style bổ sung cho icon
 * @param   [, boolean disabled = false] : them class disabled
 * @return  <div data-id={id} data-field={field} data-name={name} class="changeStatus icon-{check/unchecked} {one_select}" {style}></div>
 */
if ( ! function_exists('change_status')) {
    function change_status($id, $value, $field, $name = '', $one_sel = false, $style = '', $disabled = false, $table = '', $class = '')
    {
        return '<div data-table="' . $table . '" data-id="' . $id . '" data-field="' . $field . '" data-name="' . $name . '" class="changeStatus' . ($disabled ? ' disabled' : '') . ' icon glyphicons ' . ($value == 1 ? 'check' : 'unchecked') . ($one_sel ? ' one_select' : '') . ' waves-effect waves-circle' . ($class ? ' ' . $class : '') . '"' . ($style ? ' style="' . $style . '"' : '') . '></div>';
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm del_image
 *
 * Tạo liên kết ajax xóa ảnh
 *
 * @access  assets
 * @param   string field : field ảnh cần xóa
 * @param   [, id field] : id mục cần cóa ảnh
 * @param   [, string style = ''] : style bổ sung cho icon
 * @return  <div class="icon-bin delImageIcon" data-field={field} {style}></div>
 */
if ( ! function_exists('del_image')) {
    function del_image($field, $id = '', $style = '')
    {
        echo '<div class="icon glyphicons remove waves-effect waves-circle delImageIcon" title="Xóa ảnh" data-field="' . $field . '"' . ($id ? ' data-id="' . $id . '"' : '') . '' . ($style ? ' style="' . $style . '"' : '') . '></div>';
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm toggle_input
 *
 * Tạo liên kết ajax đảo trạng thái (1/0) một cấu hình
 *
 * @access  assets
 * @param   int id : id cấu hình
 * @param   boolean checked : giá trị 1/0 hiện tại của file cấu hình
 * @param   string field : field cấu hình
 * @param   [, boolean disabled = false] : them class disabled
 * @return  <input checkbox class=toggleInput {checked} data-id={id} data-field={field} /><label></label>
 */
if ( ! function_exists('toggle_input')) {
    function toggle_input($id, $checked, $field, $disabled = false)
    {
        return '<input type="checkbox" class="input-switch-alt' . ($disabled ? ' disabled' : '') . '"' . ($checked ? ' checked="checked"' : '') . ' id="toggleInput' . $id . '" data-toggletarget="boxed-layout" data-id="' . $id . '" data-field="' . $field . '" />';
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm stt
 *
 * Hiển thị số thứ tự một mục trong danh sách dữ liệu module
 *
 * @access  assets
 * @param   int id : id mục
 * @param   string stt : Số thứ tự
 * @return  <span class=STT_{id}>{stt}</span><input hidden value={stt} id=Old_{id} />
 */
if ( ! function_exists('stt')) {
    function stt($id, $stt)
    {
        return '<span class="stt STT_' . $id . '">' . $stt . '</span><input type="hidden" value="' . $stt . '" id="Old_' . $id . '" />';
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm sel_item
 *
 * Tạo checkbox chọn cho một mục
 *
 * @access  assets
 * @param   int id : id mục
 * @param   [, boolean disable = false] : Vô hiệu hóa
 * @return  <input checkbox class=cb-element id=sel_item{id} value={id} />
 */
if ( ! function_exists('sel_item')) {
    function sel_item($id, $disable = false, $checked = false, $name = 'element')
    {
        return '<input type="checkbox" class="cb-element custom-checkbox" name="' . $name . '[]" id="sel_item' . $id . '" value="' . $id . '"' . ($checked ? ' checked="checked"' : '') . '' . ($disable ? ' disabled="disabled"' : '') . ' />';
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm show_flash
 *
 * Hiển thị file flash
 *
 * @access  assets
 * @param   string file flash
 * @param   int width (px)
 * @param   int height (px)
 * @return  flash object
 */
if ( ! function_exists('show_flash')) {
    function show_flash($file_path, $w, $h)
    {
        return '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="' . $w . 'px" height="' . $h . 'px" align="middle">
    			<param name="movie" value="' . $file_path . '" />
    			<param name="wmode" value="transparent" />
    			<embed src="' . $file_path . '" quality="best" wmode="transparent" width="' . $w . 'px" height="' . $h . 'px" align="middle" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
    		</object>';
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm show_img
 *
 * Hiển thị file ảnh
 *
 * @access  assets
 * @param   string file image
 * @param   [, string class = '']
 * @param   [, string style = '']
 * @return  <img src={file image} {class} {style} />
 */
if ( ! function_exists('show_img')) {
    function show_img($file_path, $class = '', $style = '')
    {
        if (goodfile($file_path)) return '<img src="' . $file_path . '"' . ($class ? ' class="' . $class . '"' : '') . ($style ? ' style="' . $style . '"' : '') . ' />';
        else return 'No file!';
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm error_div
 *
 * Tạo div thông báo lỗi
 *
 * @access  assets
 * @param   string field : class div lỗi cũng là id input được kiểm tra lỗi nhập
 * @param   string message : Thông báo lỗi sẽ hiện lên
 * @param   [, string style = '']
 * @return  <div class="errordiv {field}" {style}><div class="arrow"></div>{message}</div>
 */
if ( ! function_exists('error_div')) {
    function error_div($field, $message, $style = '')
    {
        return '<div class="errordiv ' . $field . '"' . ($style ? ' style="' . $style . '"' : '') . '><div class="arrow"></div>' . $message . '</div>';
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm module_open
 *
 * Tạo các thẻ mở đầu cho một module
 *
 * @access  assets
 * @return  html text
 */
if ( ! function_exists('module_open')) {
    function module_open($class = ' table table-hover')
    {
        return '<table class="mainTable noPrint' . $class . '" id="mainTable-' . $GLOBALS['var']['act'] . '" border="0" width="100%">';
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm module_close
 *
 * Tạo thẻ đóng lại một module
 *
 * @access  assets
 * @return  </table>
 */
if ( ! function_exists('module_close')) {
    function module_close()
    {
        $table_name = $GLOBALS['var']['act'];
        $table_title = get_data('modules', "file = '$table_name'", 'name_en');
        return '</table><div id="moduleInfo" data-table="' . $table_name . '" data-type="' . $table_title . '"></div>';
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm page_list
 *
 * Tạo phân trang cho danh sách dữ liệu bảng
 *
 * @access  assets
 * @param   int start : Vị trí bắt đầu lấy dữ liệu từ bảng
 * @param   int count : Số hàng dữ liệu sẽ lấy
 * @param   int total : Tổng số hàng trong bảng
 * @param   [, int range = 0] : Giới hạn số trang trong danh sách trang
 * @param   [, string link = ''] : Liên kết chuyển trang
 * @return  html text
 */
if ( ! function_exists('page_list')) {
    function page_list($total, $uri = '', $range = 8, $ajax = false)
    {
        if ($total == 0) {
            return '';
        }
        $url = site_url($GLOBALS['var']['act'] . ($GLOBALS['var']['do'] ? '/' . $GLOBALS['var']['do'] : '') . ($GLOBALS['var']['id'] ? '/' . $GLOBALS['var']['id'] : ''));
        $start = '';
        $count = '';
        $href = 'javascript:;';
        if (is_array($uri)) {
            $start = $uri['rowstart'];
            $count = $uri['limit'];
            if ($start == '') {
                $start = 0;
            }
            unset($uri['rowstart'], $uri['limit']);
            $uri_str = url_uri($uri, array('cat'));
            $link = $url . $uri_str . ($uri_str ? '&' : '?');
        } else {
            if ($uri == '') $link = $url . '?';
            else $link = $url . $uri . '&';
        }
        unset($_GET['t'], $_GET['q'], $_GET['rowstart']);
        if (isset($_GET) && is_array($_GET) && count($_GET)) {
            $link .= http_build_query($_GET) . '&';
        }
        if ($start == '') {
            $start = 0;
        }
        if ($count == '') {
            $count = $GLOBALS['var']['limit_perpage'];
        }
        $pg_cnt = ceil($total / $count);
        if ($pg_cnt <= 1) {
            return '';
        }
        $html = '';
        $idx_back = $start - $count;
        $idx_next = $start + $count;
        $cur_page = ceil(($start + 1) / $count);
        if ($idx_back >= 0) {
            if ($cur_page > ($range + 1)) {
                if (!$ajax) $href = $link . 'rowstart=0';
                $html .= '<li><a class="loading" href="' . $href . '" data-rowstart="0"><strong>1</strong></a></li><li class="disabled"><a href="#" style="cursor: default">...</a></li>';
            }
        }
        $idx_fst = max($cur_page - $range, 1);
        $idx_lst = min($cur_page + $range, $pg_cnt);
        if ($range == 0) {
            $idx_fst = 1;
            $idx_lst = $pg_cnt;
        }
        for ($i = $idx_fst; $i <= $idx_lst; $i++) {
            $offset_page = ($i - 1) * $count;
            if (!$ajax) $href = $link . 'rowstart=' . $offset_page;
            if ($i == $cur_page) $html .= '<li class="active"><a href="#">' . $i . '</a></li>';
            else $html .= '<li><a class="loading" href="' . $href . '" data-rowstart="' . $offset_page . '"> ' . $i . '</a></li>';
        }
        if ($idx_next < $total) {
            if ($cur_page < ($pg_cnt - $range)) {
                $offset_page = (($pg_cnt - 1) * $count);
                if (!$ajax) $href = $link . 'rowstart=' . $offset_page;
                $html .= '<li class="disabled"><a href="#" style="cursor: default">...</a></li><li><a class="loading" href="' . $href . '" data-rowstart="' . $offset_page . '"> ' . $pg_cnt . '</a></li>';
            }
        }
        /*$foward = $start + $count;
        $backward = $start - $count;
        if ($cur_page > 1) {
            if (!$ajax) $href = $link . 'rowstart=' . $backward;
            $html = '<li class="previous"><a class="loading" href="' . $href . '" data-rowstart="' . $backward . '">Prev</a></li>' . $html;
        }
        if ($cur_page < $pg_cnt) {
            if (!$ajax) $href = $link . 'rowstart=' . $foward;
            $html .= '<li class="next"><a class="loading" href="' . $href . '" data-rowstart="' . $foward . '">Next</a></li>';
        }*/
        return '<div class="dataTables_paginate"><ul class="pagination"><li class="disabled"><a href="#" style="cursor: default">Trang ' . number_format($cur_page) . '/' . number_format($pg_cnt) . ' (' . $total . '):</a></li>' . $html . '</ul></div>';
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm create_sort
 *
 * Tạo liên kết sắp xếp cho một trường dữ liệu
 *
 * @access  assets
 * @param   string field : Trường cần sắp xếp
 * @return  html text
 */
if ( ! function_exists('create_sort')) {
    function create_sort($field)
    {
        $ci =& get_instance();
        $act = $ci->uri->segment(1);
        $orderby = $ci->input->get('orderby', true);
        $ordermode = $ci->input->get('ordermode', true);
        if ($ordermode == '') $ordermode = 'desc';
        if ($field == $orderby) {
            if ($ordermode == 'desc') $ordermode = 'asc';
            else $ordermode = 'desc';
        }
        $uri = array(
            'deleted' => $ci->input->get('deleted', true),
            'q' => $ci->input->get('q', true),
            'cat' => $ci->input->get('cat', true),
            'from' => $ci->input->get('from', true),
            'to' => $ci->input->get('to', true),
            'orderby' => $field,
            'ordermode' => $ordermode
        );
        return '<a class="ajax" href="' . site_url($act) . url_uri($uri) . '" title="Sắp xếp">
        <div class="icon12 glyphicons ' . ($orderby == $field ? (strtolower($ordermode) == 'desc' ? 'sort-by-attributes' : 'sort-by-attributes-alt') : 'sorting') . '" style="margin-top:3px; float:right; margin-left:3px;"></div></a>';
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm cat_tree
 *
 * Tạo cây thư mục danh mục
 *
 * @access  assets
 * @param   [array object cat] : Mảng danh mục
 * @param   [, int parent] : ID danh mục chính
 * @param   [, array selected] : Mảng chọn
 * @param   [, string type = checkbox] : Kiểu input
 * @param   [, boolean no_parent = true] : Hiển thị Radio input không thuộc nhóm
 * @return  html tree list
 */
if ( ! function_exists('cat_tree')) {
    function cat_tree($cats, $parent = 0, $checked = '', $type = 'checkbox', $no_parent = true, $field_name = 'cat', $disabled_root = false)
    {
        if (!is_array($cats)) {
            return false;
        }
        if (empty($htmlcat)) {
            if ($type == 'radio' && $no_parent) {
                $check = $checked == 0 || $checked == '';
                $no_parent = '<li>';
                $no_parent .= '<label>';
                $no_parent .= '<input type="radio" data-id="" id="' . $field_name . '" name="' . $field_name . '" class="custom-' . $type . '" value=""' . ($check ? ' checked="checked"' : '') . '>';
                $no_parent .= '<span class="file">Không chọn ...</span>';
                $no_parent .= '</label>';
                $htmlcat = $no_parent;
            } else {
                $htmlcat = '';
            }
        }
        foreach ($cats as $key => $cat) {
            if (!isset($cat['parent'])) {
                $cat['parent'] = 0;
            }
            if (!isset($cat['chirld'])) {
                $cat['chirld'] = 0;
            }
            if (!isset($cat['id'])) {
                $cat['id'] = $key;
            }
            if ($cat['parent'] == $parent) {
                $check = (is_array($checked) && in_array($cat['id'], $checked)) || $checked == $cat['id'];
                $subcat = '';
                if ($cat['chirld']) {
                    $subcat = cat_tree($cats, $cat['id'], $checked, $type, false, $field_name);
                }
                $htmlcat .= '<li' . ($subcat ? ' class="collapsable"' : '') . '>';
                if ($subcat) {
                    $htmlcat .= '<div class="hitarea collapsable-hitarea"></div>';
                }
                $htmlcat .= '<label>';
                $parent == 0 && $disabled_root ? '' : $htmlcat .= '<input type="' . $type . '" data-id="' . $cat['id'] . '" id="' . $field_name . $cat['id'] . '" name="' . $field_name . '' . ($type == 'checkbox' ? '[]' : '') . '" class="custom-' . $type . '" value="' . $cat['id'] . '"' . ($check ? ' checked="checked"' : '') . '>';
                $htmlcat .= '<span class="' . ($parent == 0 ? 'folder' : 'file') . '">' . $cat['name_vn'] . (!empty($cat['product']) ? ' (' . $cat['product'] . ')' : '') . '</span>';
                $htmlcat .= '</label>';
                if ($subcat) {
                    $htmlcat .= '<ul>';
                    $htmlcat .= $subcat;
                    $htmlcat .= '</ul>';
                }
                $htmlcat .= '</li>';
                unset($cats[$key]);
            }
        }
        return $htmlcat;
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm category_nestable
 *
 * Tạo cây thư mục danh mục có thể sắp xếp
 *
 * @access  assets
 * @param   [array object cat] : Mảng danh mục
 * @param   [, int parent] : ID danh mục chính
 * @param   [, string field] : Tên field số mục con từ lệnh query sql
 * @param   [, string type] : Tên mục con
 * @param   [, string uri_str] : Chuỗi tham số url
 * @return  html tree list
 */
if ( ! function_exists('category_nestable')) {
    function category_nestable($cats, $parent = 0)
    {
        if (!is_array($cats)) {
            return false;
        }
        $field = str_replace('_categories', '', $GLOBALS['var']['act']);
        switch ($field) {
            case 'digicats':
                $type = 'products';
                break;
            case 'news':
                $type = 'news';
                break;
            case 'products':
            case 'menucats':
                $type = 'items';
                break;
        }
        if (empty($htmlcat)) {
            $htmlcat = '';
        }
        foreach ($cats as $key => $cat) {
            if ($cat['parent'] == $parent) {
                $htmlcat .= '<li class="dd-item dd3-item" data-id="' . $cat['id'] . '">';
                $htmlcat .= '<div class="dd-handle dd3-handle icon glyphicons list"></div>';
                $htmlcat .= '<div class="dd3-content" style="line-height: 44px;"><span data-name="' . $cat['id'] . '"><b>' . $cat['id'] . '</b> - ' . $cat['name_vn'] . '</span></div>';
                $htmlcat .= '<div class="dd-status">' . change_status($cat['id'], $cat['active'], 'active', 'Kích hoạt', '', '', !$GLOBALS['per']['edit'], $GLOBALS['var']['act'] == 'products' || $GLOBALS['var']['act'] == 'news' ? $GLOBALS['var']['act'] . '_categories' : '') . '</div>';
                $htmlcat .= '<div class="dd-cmd">';
                if ($GLOBALS['per']['edit']) {
                    if ($GLOBALS['var']['act'] == 'products' || $GLOBALS['var']['act'] == 'news') {
                        $htmlcat .= edit_alink('', 'javascript:;" data-type="' . $field . '" data-id="' . $cat['id'], 'update_caterogies');
                    } else {
                        $htmlcat .= edit_alink($cat['id'], $GLOBALS['var']['act'] . '/update/' . $cat['id']);
                    }
                }
                if ($GLOBALS['per']['del']) {
                    $htmlcat .= del_restore_link($cat['id'], $cat['deleted'], true, true, $GLOBALS['var']['act'] == 'products' || $GLOBALS['var']['act'] == 'news' ? $GLOBALS['var']['act'] . '_categories' : '');
                }
                $htmlcat .= '</div>';
                if ($cat['chirld']) {
                    $htmlcat .= '<ol class="dd-list" style="display: none;">';
                    $htmlcat .= category_nestable($cats, $cat['id']);
                    $htmlcat .= '</ol>';
                }
                $htmlcat .= '</li>';
                unset($cats[$key]);
            }
        }
        return $htmlcat;
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm cat_option
 *
 * Danh sách chọn danh mục
 *
 * @access  assets
 * @param   [array object cat] : Mảng danh mục
 * @param   [, int parent] : ID danh mục chính
 * @param   [, array selected] : Mảng chọn
 * @return  html option list
 */
if ( ! function_exists('cat_option')) {
    function cat_option($cats, $parent = 0, $checked = '', $prefix = '')
    {
        if (!is_array($cats)) {
            return false;
        }
        if (empty($htmlcat)) {
            $htmlcat = '';
        }
        foreach ($cats as $key => $cat) {
            if (!isset($cat['parent'])) {
                $cat['parent'] = 0;
            }
            if (!isset($cat['chirld'])) {
                $cat['chirld'] = 0;
            }
            if (!isset($cat['id'])) {
                $cat['id'] = $key;
            }
            if ($cat['parent'] == $parent) {
                $check = (is_array($checked) && in_array($cat['id'], $checked)) || $checked == $cat['id'];
                $htmlcat .= '<option value="' . $cat['id'] . '"' . ($check ? ' selected' : '') . '>' . ($prefix ? $prefix . ' ' : '') . $cat['name_vn'] . '</option>';
                if ($cat['chirld']) {
                    $htmlcat .= cat_option($cats, $cat['id'], $checked, $prefix . '----');
                }
                unset($cats[$key]);
            }
        }
        return $htmlcat;
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm get_options
 *
 * Lấy giá trị của một field hoặc tất cả field từ bảng dữ liệu
 *
 * @access  public
 * @param   Field
 * @param   [, where condition = '']
 * @return  data array
 */
if ( ! function_exists('get_options')) {
    function get_options($Field = '', $selected = array(), $extra = '', $name = '')
    {
        if (!$name) {
            $name = $Field;
        }

        if (!is_array($selected)) {
            $selected = array($selected);
        }

        if (count($selected) === 0) {
            if (isset($_POST[$name])) {
                $selected = array($_POST[$name]);
            }
        }

        if ($extra != '') $extra = ' ' . $extra;

        $multiple = strpos($extra, 'multiple') != FALSE ? ' multiple="multiple"' : '';

        $form = '<select name="' . $name . '"' . $extra . $multiple . ">\n";

       if (($multiple && isset($key)) || !$multiple) {
            $sel = (in_array('', $selected)) ? ' selected="selected"' : '';
            $form .= '<option value=""' . $sel . '>Select ...' . "</option>\n";
        }

        $Options = get_data('option_items', 'Field = "' . $Field . '"', 'Options');
        if ($Options) {
            $options = json_decode($Options);
            foreach ($options as $key => $val) {
                $key = (string)$val;
                if (($multiple && $key) || !$multiple) {
                    $sel = (in_array($key, $selected)) ? ' selected="selected"' : '';

                    $form .= '<option value="' . $key . '"' . $sel . '>' . (string)$val . "</option>\n";
                }
            }
        }

        $form .= '</select>';

        return $form;
    }
}

if ( ! function_exists('col_name')) {
    function col_name($col, $key = '')
    {
        if (!is_object($col)) {
            return '';
        }
        $html = '';

        $show = isset($col->show) && $col->show;
        if ($GLOBALS['var']['q']) {
            $show = isset($col->search_show) && $col->search_show;
        }

        if ($show) {
            $html .= '<th' . (isset($col->nowrap) ? ' nowrap="nowrap"' : '') .  ' class="head ' . (isset($key) ? $key . ' ' : '') . (isset($col->align) ? '' . $col->align : '') . (isset($col->header_class) ? ''. $col->header_class : '') . '"' . ' style="width: ' . (isset($col->width) ? $col->width : 100 . 'px') . '; min-width: ' . (isset($col->width) ? $col->width : 100 . 'px') . '; max-width: ' . (isset($col->width) ? $col->width : 100 . 'px') . ';">' . ($key && isset($col->sort) && $GLOBALS['var']['do'] != 'prints' ? create_sort($key) : '') . (isset($col->name) ? $col->name : '') . '</th>';
        }

        return $html;
    }
}

if ( ! function_exists('col_filter')) {
    function col_filter($col, $key, $filter, $options = false)
    {
        if (!is_object($col)) {
            return '';
        }
        $html = '';

        $show = isset($col->show) && $col->show;
        if ($GLOBALS['var']['q']) {
            $show = isset($col->search_show) && $col->search_show;
        }

        if ($show) {
            $html .= '<th class="thft-' . $key . '" style="width: ' . (isset($col->width) ? $col->width : 100 . 'px') . '; min-width: ' . (isset($col->width) ? $col->width : 100 . 'px') . '; max-width: ' . (isset($col->width) ? $col->width : 100 . 'px') . ';">';
            if (isset($col->filter) && $col->filter) {
                $current_val = isset($filter[$key]) ? (is_array($filter[$key]) ? $filter[$key] : htmlspecialchars($filter[$key])) : '';
                if ($col->filter == 'text') {
                    $html .= '<input type="text" name="filter[' . $key . ']" value="' . $current_val . '" class="form-control"/>' . ($current_val ? '<i class="icon glyphicons remove"></i>' : '');
                }
                if ($col->filter == 'date') {
                    $html .= '<input type="text" name="filter[' . $key . ']" value="' . $current_val . '" class="form-control date"/>' . ($current_val ? '<i class="icon glyphicons remove"></i>' : '');
                }
                if ($col->filter == 'date_range') {
                    $html .= '<div id="datepicker"><div class="input-daterange input-group" id="datepicker"><input type="text" name="filter[' . $key . '][from]" value="' . (isset($current_val['from']) ? $current_val['from'] : '') . '" class="form-control" style="width: 50%; display: inline-block;"/><input type="text" name="filter[' . $key . '][to]" value="' . (isset($current_val['to']) ? $current_val['to'] : '') . '" class="form-control" style="width: 50%; display: inline-block;"/></div></div>' . ((isset($current_val['from']) && $current_val['from']) || (isset($current_val['to']) && $current_val['to']) ? '<i class="icon glyphicons remove"></i>' : '');
                }
                if ($col->filter == 'select') {
                    if (is_array($options) && count($options)) {
                        $html .= form_dropdown('filter[' . $key . ']', $options, $current_val, 'id="' . $key . '" class="form-control select2"');
                    } else {
                        $html .= get_options($key, $current_val, 'id="' . $key . '" class="form-control select2"', 'filter[' . $key . ']');
                    }
                }
            }
            $html .= '</th>';
        }

        return $html;
    }
}

if ( ! function_exists('col_val')) {
    function col_val($col, $key, $val, $id = 0, $edit_link = '')
    {
        if (!is_object($col)) {
            return '';
        }
        $html = '';

        $show = isset($col->show) && $col->show;
        if ($GLOBALS['var']['q']) {
            $show = isset($col->search_show) && $col->search_show;
        }

        if ($show) {
            $html .= '<td class="' . $key . '' . (isset($col->align) ? ' ' .$col->align : '') . '" style="width: ' . (isset($col->width) ? $col->width : 100 . 'px') . '; min-width: ' . (isset($col->width) ? $col->width : 100 . 'px') . '; max-width: ' . (isset($col->width) ? $col->width : 100 . 'px') . ';">' . (isset($col->link) ? '<a href="' . ($edit_link ? $edit_link : 'javascript:;" class="updateLink" data-id="' . $id) . '" target="_blank">' : '') . (isset($col->format) && $col->format != '' ? ($col->type == 'text_input' && $GLOBALS['var']['do'] != 'prints' ? '<input type="text" name="' . $key . '" class="form-control money ' . $key . '" value="' . $val . '"/>' : @number_format($val, $col->format)) : (isset($col->type) ? ($col->type == 'color' ? '<div style="background: ' . $val . '; color: #fff; padding: 3px 5px; border-radius: 3px;">' . $val . '</div>' : ($col->type == 'check' || $col->type == 'check_edit' ? change_status($id, $val, $key, '', '', '', $col->type != 'check_edit') : ($col->type == 'image' ? show_img($val, '', 'max-width:35px; max-height:35px;') : ($col->type == 'text_input' && $GLOBALS['var']['do'] != 'prints' ? '<input type="text" name="' . $key . '" class="form-control ' . $key . '" value="' . $val . '"/>' : $val)))) : $val)) . (isset($col->link) ? '</a>' : '') . '</td>';
        }

        return $html;
    }
}
if ( ! function_exists('col_val_bank')) {
    function col_val_bank($col, $key, $val, $id = 0, $edit_link = '')
    {
        if (!is_object($col)) {
            return '';
        }
        $html = '';

        $show = isset($col->show) && $col->show;
        if ($GLOBALS['var']['q']) {
            $show = isset($col->search_show) && $col->search_show;
        }

        if ($show) {
            $html .= '<td title="'.$val.'" class="' . $key . '' . (isset($col->align) ? ' ' .$col->align : '') . '" style="width: ' . (isset($col->width) ? $col->width : 100 . 'px') . '; min-width: ' . (isset($col->width) ? $col->width : 100 . 'px') . '; max-width: ' . (isset($col->width) ? $col->width : 100 . 'px') . ';">' . (isset($col->link) ? '<a href=" ' . ($edit_link ? $edit_link : 'javascript:;" class="updateLink" data-id="' . $id) . ' "target="_blank">' : ' ') . (isset($col->format) && $col->format != '' ? ($col->type == 'text_input' && $GLOBALS['var']['do'] != 'prints' ? '<input type="text" name="' . $key . '" class="form-control money ' . $key . '" value="' . $val . '"/>' : @number_format($val, $col->format)) : (isset($col->type) ? ($col->type == 'color' ? '<div style="background: ' . $val . '; color: #fff; padding: 3px 5px; border-radius: 3px;">' . $val . '</div>' : ($col->type == 'check' || $col->type == 'check_edit' ? change_status($id, $val, $key, '', '', '', $col->type != 'check_edit') : ($col->type == 'image' ? show_img($val, '', 'max-width:35px; max-height:35px;') : ($col->type == 'text_input' && $GLOBALS['var']['do'] != 'prints' ? '<input type="text" name="' . $key . '" class="form-control ' . $key . '" value="' . $val . '"/>' : $val)))) : $val)) . (isset($col->link) ? '</a>' : '') . '</td>';
        }

        return $html;
    }
}

if ( ! function_exists('col_val_not_blank')) {
    function col_val_not_blank($col, $key, $val, $id = 0, $edit_link = '')
    {
        if (!is_object($col)) {
            return '';
        }
        $html = '';

        $show = isset($col->show) && $col->show;
        if ($GLOBALS['var']['q']) {
            $show = isset($col->search_show) && $col->search_show;
        }

        if ($show) {
            $html .= '<td class="' . $key . '' . (isset($col->align) ? ' ' .$col->align : '') . '" style="width: ' . (isset($col->width) ? $col->width : 100 . 'px') . '; min-width: ' . (isset($col->width) ? $col->width : 100 . 'px') . '; max-width: ' . (isset($col->width) ? $col->width : 100 . 'px') . ';">' . (isset($col->link) ? '<a href="' . ($edit_link ? $edit_link : 'javascript:;" class="updateLink" data-id="' . $id) . '">' : '') . (isset($col->format) && $col->format != '' ? ($col->type == 'text_input' && $GLOBALS['var']['do'] != 'prints' ? '<input type="text" name="' . $key . '" class="form-control money ' . $key . '" value="' . $val . '"/>' : @number_format($val, $col->format)) : (isset($col->type) ? ($col->type == 'color' ? '<div style="background: ' . $val . '; color: #fff; padding: 3px 5px; border-radius: 3px;">' . $val . '</div>' : ($col->type == 'check' || $col->type == 'check_edit' ? change_status($id, $val, $key, '', '', '', $col->type != 'check_edit') : ($col->type == 'image' ? show_img($val, '', 'max-width:35px; max-height:35px;') : ($col->type == 'text_input' && $GLOBALS['var']['do'] != 'prints' ? '<input type="text" name="' . $key . '" class="form-control ' . $key . '" value="' . $val . '"/>' : $val)))) : $val)) . (isset($col->link) ? '</a>' : '') . '</td>';
        }

        return $html;
    }
}
// ------------------------------------------------------------------------

/**
 * Hàm family_tree
 *
 * Tạo cây thư mục danh mục
 *
 * @access  assets
 * @param   [array object cat] : Mảng danh mục
 * @param   [, int parent] : ID danh mục chính
 * @param   [, array selected] : Mảng chọn
 * @param   [, string type = checkbox] : Kiểu input
 * @param   [, boolean no_parent = true] : Hiển thị Radio input không thuộc nhóm
 * @return  html tree list
 */
if ( ! function_exists('family_tree')) {
    function family_tree($cats, $parent = 0)
    {
        if (!is_array($cats)) {
            return false;
        }
        $arrMS = explode(',', $GLOBALS['cfg']['management_documents']);
        $htmlcat = '';
        foreach ($cats as $key => $cat) {
            if (!isset($cat['parent'])) {
                $cat['parent'] = 0;
            }
            if (!isset($cat['chirld'])) {
                $cat['chirld'] = 0;
            }
            if (!isset($cat['id'])) {
                $cat['id'] = $key;
            }
            if ($cat['parent'] == $parent) {
                // $check = (is_array($checked) && in_array($cat['id'], $checked)) || $checked == $cat['id'];
                $subcat = '';
                if ($cat['chirld']) {
                    $subcat = family_tree($cats, $cat['id']);
                }
                $htmlcat .= '<li class="' . ($subcat ? ' collapsable' : '') .'">';
                if ($cat['id'] == 11) {
                   $htmlcat .= '<a href="' . site_url() . $GLOBALS['var']['act'] . '/update/' . $cat['id'] . '">' . $cat['name'] . '</a>';
                } else {
                    $htmlcat .= ($GLOBALS['user']['level'] != 1 && $GLOBALS['user']['part'] != $cat['id'] && $GLOBALS['user']['part'] != $cat['parent'] && !in_array($GLOBALS['user']['id'], $arrMS) ? '<a href="javascript:;" class="disabled">' . $cat['name'] . '</a>' : '<a href="' . site_url() . $GLOBALS['var']['act'] . '/update/' . $cat['id'] . '" >' . $cat['name'] . '</a>');
                }
                // $htmlcat .= '<a href="' . site_url() . $GLOBALS['var']['act'] . '/update/' . $cat['id'] . '" class="'. ($GLOBALS['user']['level'] != 1 && $GLOBALS['user']['part'] != $cat['id'] && $GLOBALS['user']['part'] != $cat['parent'] ? ' disabled' : '') . '">' . $cat['name'] . '</a>';
                if ($subcat) {
                    $htmlcat .= '<ul>';
                    $htmlcat .= $subcat;
                    $htmlcat .= '</ul>';
                }
                $htmlcat .= '</li>';
                unset($cats[$key]);
            }
        }
        return $htmlcat;
    }
}

/**
 * Hàm get_options_keynum
 *
 * Lấy giá trị của một field hoặc tất cả field từ bảng dữ liệu
 *
 * @access  public
 * @param   Field
 * @param   [, where condition = '']
 * @return  data array
 */
if ( ! function_exists('get_options_keynum')) {
    function get_options_keynum($Field = '', $selected = array(), $extra = '', $name = '', $empty_val = false)
    {
        if (!$name) {
            $name = $Field;
        }

        if (!is_array($selected)) {
            $selected = array($selected);
        }

        if (count($selected) === 0) {
            if (isset($_POST[$name])) {
                $selected = array($_POST[$name]);
            }
        }

        if ($extra != '') $extra = ' ' . $extra;

        $multiple = strpos($extra, 'multiple') != FALSE ? ' multiple="multiple"' : '';

        $form = '<select name="' . $name . '"' . $extra . $multiple . ">\n";

       if (($multiple && isset($key)) || !$multiple) {
            $sel = (in_array('', $selected)) ? ' selected="selected"' : '';
            if (!$empty_val) {
                $form .= '<option value=""' . $sel . '>Select ...' . "</option>\n";
            }
        }

        $Options = get_data('option_items_keynum', 'Field = "' . $Field . '" AND active = 1 AND deleted = 0', 'Options');

        if ($Options) {
            $options = json_decode($Options);
            foreach ($options as $val) {
                $key = (int)$val->key;
                if (($multiple && $key) || !$multiple) {
                    $sel = (in_array($key, $selected)) ? ' selected="selected"' : '';
                    $form .= '<option value="' . $key . '"' . $sel . '>' . (string)$val->name . "</option>\n";
                }
            }
        }

        $form .= '</select>';

        return $form;
    }
}

/**
 * Hàm get_options_extension
 *
 * Lấy định dạng file trong thử mục icon
 *
 * @access  public
 * @param   Field
 * @param   [, where condition = '']
 * @return  data array
 */
if ( ! function_exists('get_options_extension')) {
    function get_options_extension($name = '', $selected='', $extra = '', $empty_val = false)
    {
        if ($extra != '') $extra = ' ' . $extra;

        $form = '<select name="' . $name . '"' . $extra . ">\n";

        $sel = !$selected ? ' selected="selected"' : '';
        if ($empty_val) {
            $form .= '<option value=""' . $sel . '>Select ...' . "</option>\n";
        }
        
        $file_in_folder = glob(ICON_DIR . '*.*');
        if (is_array($file_in_folder) && count($file_in_folder)) {
            foreach($file_in_folder as $file) {
                $tmp = explode('/', $file);
                $file_ext = end($tmp);
                $tmp = explode('.', $file_ext);
                $file_name = reset($tmp);
                $sel = $selected == $file_name ? ' selected="selected"' : '';
                $form .= '<option value="' . (string)$file_name . '"' . $sel . ' style="background-image:url(' . ICON_DIR . (string)$file_ext . '); background-repeat: no-repeat; background-size: 20px; background-position: right center;">' . (string)$file_name . "</option>\n";
            }
        }
        $form .= '</select>';

        return $form;
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm pagi
 *
 * Tạo phân trang cho danh sách dữ liệu bảng
 *
 * @access  assets
 * @param   int start : Vị trí bắt đầu lấy dữ liệu từ bảng
 * @param   int count : Số hàng dữ liệu sẽ lấy
 * @param   int total : Tổng số hàng trong bảng
 * @param   [, int range = 0] : Giới hạn số trang trong danh sách trang
 * @param   [, string link = ''] : Liên kết chuyển trang
 * @return  html text
 */
if ( ! function_exists('pagi')) {
    function pagi($total, $uri = '', $range = 8, $ajax = false,  $bfward_show = false, $always_show = false)
    {
        if (!$total) return false;
        $url = site_url($GLOBALS['var']['act'] . ($GLOBALS['var']['do'] ? '/' . $GLOBALS['var']['do'] : '') . ($GLOBALS['var']['id'] ? '/' . $GLOBALS['var']['id'] : ''));
        
        $start = $GLOBALS['var']['page'];
        if ($start == '') $start = 1;
        $res = '';
        $href = 'javascript:;';
        if (is_array($uri)) {
            unset($uri['page'], $uri['limit']);
            $uri_str = url_uri($uri, array('cat'));
            $link = $url . $uri_str . ($uri_str ? '&' : '?');
        } else {
            if ($uri == '') $link = $url . '?';
            else $link = $url . $uri . '&';
        }
        unset($_GET['t'], $_GET['q'], $_GET['page']);
        if (isset($_GET) && is_array($_GET) && count($_GET)) {
            $link .= http_build_query($_GET) . '&';
        }
        
        $q = $uri && $uri != $_SERVER['REQUEST_URI'] ? '?' . $uri : '';
        $pg_cnt = ceil($total / $GLOBALS['var']['results_per_page']);
        if ($pg_cnt <= 1) return "";
        $cur_page = $start;
        $foward = $cur_page + 1;
        $backward = $cur_page - 1;
        $first = 1;
        $last = $pg_cnt;

        $half = floor($range / 2);
        $half = !isset($half) ? 1 : $half;

        $idx_fst = max($cur_page - $half, 1);
        $idx_lst = min($cur_page + $half, $pg_cnt);

        $count_item = $idx_lst - $idx_fst;

        if ($count_item < $half * 2) {
            if ($cur_page == $pg_cnt || $cur_page == $pg_cnt - 1) {
                $idx_fst = max($cur_page - ($count_item == $half ? $half * 2 : $count_item), 1);
            } else {
                $idx_lst = min($cur_page + ($count_item == $half ? $half * 2 : $count_item), $pg_cnt);
            }
        }

        if ($bfward_show) {
            if ($cur_page > 1 && $backward > 0 || $always_show) {
                if (!$ajax) $href = $link . 'page=' . ($backward == 0 ? 1 : $backward);
                $res .= '<li><a class="item" href="' . $href . $q . '" data-page="' . $backward . '"><i class="fa fa-step-backward" aria-hidden="true"></i></a></li>';
            }
        }
        
        for ($i = $idx_fst; $i <= $idx_lst; $i++) {
            if (!$ajax) $href = $link . 'page=' . $i;
            if ($i == $cur_page) $res .= '<li class="item active"><a href="javascript:;" data-page="' . $i . '">' . $i . '</a></li>';
            else $res .= '<li><a class="item" href="' . $href . $q . '" data-page="' . $i . '">' . $i . '</a></li>';
        }

        if ($bfward_show) {
            if ($pg_cnt - $cur_page > 0 && $foward < $pg_cnt || $always_show) {
                if (!$ajax) $href = $link . 'page=' . ($foward == $pg_cnt + 1 ? $pg_cnt : $foward);
                $res .= '<li><a class="item" href="' . $href . $q . '" data-page="' . $foward . '"><i class="fa fa-step-forward" aria-hidden="true"></i></a></li>';
            }

            if ($cur_page > 2 || $always_show) {
                if (!$ajax) $href = $link . 'page=' . $first;
                $res = '<li><a href="' . $href . $q . '" data-page="' . $first . '" class="item"><i class="fa fa-fast-backward"></i></a></li>' . $res;
            }
            if ($pg_cnt - $cur_page > 1 || $always_show) {
                if (!$ajax) $href = $link . 'page=' . $last;
                $res .= '<li><a href="' . $href . $q . '" data-page="' . $last . '" class="item"><i class="fa fa-fast-forward"></i></a></li>';
            }
        }
        return '<div class="' . ($ajax ? 'pagi-ajax' : '') . '" data-total="' . $total . '"><ul class="pagination"><li class="item hidden-xs disabled"><a href="javascript:;">Page ' . number_format($cur_page) . '/' . number_format($pg_cnt) . ' (' . $total . ')</a></li>' . $res . '</ul></div>';
    }
}

/**
 * Hàm count
 *
 * count array
 *
 * @access  public
 * @param   arr array||object
 * @return  number int
 */
if (!function_exists('load_view')) {
    function load_view($path,$data=[],$isTwig=true)
    {
        if(!is_string($path))
            return false;
        
        $ci = &get_instance();
        
        if($isTwig)
        return $ci->twig->render($path,$data);

        return $ci->load->view($path,$data);

    }
}

// ------------------------------------------------------------------------

/**
 * Hàm display_usd
 *
 * count array
 *
 * @access  public
 * @param   value text||number
 * @return  result text
 */
if (!function_exists('display_usd')) {
    function display_usd($value)
    {
        $tmp = empty($value)||$value==0 ? 0 :  $value;

        $result = round($tmp) == $tmp ? (($tmp == 0)  ? '' : '$'.$tmp) : '$'.number_format($tmp,2);

        return $result;
    }
}

// ------------------------------------------------------------------------
