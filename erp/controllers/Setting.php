<?php
if (!defined('BASEPATH')) exit('BẠN KHÔNG CÓ QUYỀN TRUY CẬP VÀO TRANG NÀY');

class Setting extends MY_Controller
{
	public $com;

	public function __construct()
	{
		parent::__construct();

		$this->com = 'setting';
		$this->data['com'] = $this->com;
		//qq( site_url('setting'));die;
	}

	public function index()
	{

		$this->data['template'] = 'module/setting';
		$this->data['item'] = get_data('setting');
		$this->load->view('all/template', $this->data);
	}

	public function save()
	{

		$data['error'] = "Please fill out proper data";

		$func = $this->data['func'];
		$d = $this->data['d'];

		if (empty($_POST)) transfer("Không nhận được dữ liệu", MYADMIN, false);

		$id = (isset($_POST['id'])) ? htmlspecialchars($_POST['id']) : 0;
		$row = $d->rawQueryOne("select id, options from #_setting where id = ? limit 0,1", array($id));
		$option = json_decode($row['options'], true);

		/* Post dữ liệu */
		$data = (isset($_POST['data'])) ? $_POST['data'] : null;
		if ($data) {
			foreach ($data as $column => $value) {
				if (is_array($value)) {
					foreach ($value as $k2 => $v2) $option[$k2] = $v2;
					$data[$column] = json_encode($option);
				} else {
					$data[$column] = htmlspecialchars($value);
				}
			}
		}

		/* Post Seo */
		$dataSeo = (isset($_POST['dataSeo'])) ? $_POST['dataSeo'] : null;
		if ($dataSeo) {
			foreach ($dataSeo as $column => $value) {
				$dataSeo[$column] = htmlspecialchars($value);
			}
		}

		if (isset($row['id']) && $row['id'] > 0) {
			$d->where('id', $id);
			if ($d->update('setting', $data)) {
				/* SEO */
				$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?", array(0, $this->com, 'capnhat', $this->com));
				$dataSeo['idmuc'] = 0;
				$dataSeo['com'] = $this->com;
				$dataSeo['act'] = 'capnhat';
				$dataSeo['type'] = $this->com;
				$d->insert('seo', $dataSeo);

				$this->session->set_flashdata('msg', 'Cập nhật dữ liệu thành công');
				redirect('setting');

				//transfer("Cập nhật dữ liệu thành công", site_url('setting'), false);

			} else {
				$this->session->set_flashdata('msg', 'Cập nhật dữ liệu bị lỗi!');
				redirect('setting');
				//transfer("Cập nhật dữ liệu bị lỗi", MYADMIN, TRUE);
			}
		} else {
			if ($d->insert('setting', $data)) {
				/* SEO */
				$dataSeo['idmuc'] = 0;
				$dataSeo['com'] = $this->com;
				$dataSeo['act'] = 'capnhat';
				$dataSeo['type'] = $this->com;
				$d->insert('seo', $dataSeo);

				$this->session->set_flashdata('msg', 'Cập nhật dữ liệu thành công');
				redirect('setting');
			} else {
				$this->session->set_flashdata('msg', 'Cập nhật dữ liệu thành công');
				redirect('setting');
			}
		}
	}


}
