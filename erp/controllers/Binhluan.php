<?php
if (!defined('BASEPATH')) exit('BẠN KHÔNG CÓ QUYỀN TRUY CẬP VÀO TRANG NÀY');

class Binhluan extends MY_Controller
{
	public $com;

	public function __construct()
	{
		parent::__construct();


		$this->data['template'] = 'module/binhluan/index';
		$this->data['module'] = 'Binhluan';
	}

	function index()
	{
		$idc = getRequest('id');

		$sql = "select * from
             #_gallery
         where 
             id_photo = ?
           and com = 'product'
           and type = 'san-pham'
           and kind = 'man'
           and val = 'video'
         order by stt,id desc";

		$items = $this->data['d']->rawQuery($sql,array($idc));



		$this->data['items'] = $items;
		$this->load->view('all/template', $this->data);
	}

	function update()
	{
		$this->data['template'] = 'module/binhluan/add';
		$idc = getRequest('id');

		$sql = "select * from
             #_gallery
         where 
             id_photo = ?
           and com = 'product'
           and type = 'san-pham'
           and kind = 'man'
           and val = 'video'
         order by stt,id desc";

		$items = $this->data['d']->rawQuery($sql,array($idc));
		$this->data['items'] = $items;
		$this->load->view('all/template', $this->data);
	}

	function save()
	{


		$data = $this->input->post();

		if(empty($data['tenvi']) || empty($_FILES['file']))
		{
			return false;
		}


		$func = $this->data['func'];
		if(isset($_FILES['file']))
		{
			$ALLOW = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF|.WEBP|.webp';
			$file_name = $func->uploadName($_FILES["file"]["name"]);

			if($photo = $func->uploadImage("file", $ALLOW, "../upload/product/",$file_name))
			{
				$data['photo'] = $photo;

			}
		}



		//$table = $this->input->post('table', true);
		$id = $this->input->post('id', true);

		$table = 'table_gallery';

		foreach ($data as $key=> &$item){
			if(empty($item)){
				unset($data[$key]);
			}
		}

		unset($data['table']);
		unset($data['id']);
		unset($data['file']);


		$data['ngaytao'] = time();
		$data['hienthi'] = 1;
		$data['id_member'] = 1;
		$data['type'] ='san-pham';
		$data['com'] ='product';
		$data['kind'] ='man';
		$data['val'] ='video';
		$data['stt'] ='1';


		$ci = & get_instance();
		if($id){
			$ci->db->where('id', $id);
			$ci->db->update($table, $data);
		}else{
			$ci->db->insert($table, $data);
		}

		$this->session->set_flashdata('results', 'Thêm một bình luận cho khách hàng: ' . $data['tenvi'] . ' thành công!');


		redirect('binhluan/update?id_photo='.$data['id_photo']);
	}

	function dels()
	{
		$id = $this->input->post('id', true);
		$table = 'table_gallery';

		$ci = & get_instance();
		if($id){
			$ci->db->where('id', $id);
			$ci->db->delete($table);
		}

		echo 1;

	}
}
