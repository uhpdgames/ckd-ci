<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Seo extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	function sitemap()
	{
		$config = $this->config->item('main_config');
		$info_db = $config['database'];
		$file = SHAREDLIBRARIES."class/class.".str_replace("\\","/",trim('PDODb','\\')).'.php';
		if(file_exists($file)) require_once $file;

		$requick = array(
			/* Sản phẩm */
			array("tbl" => "product_list", "field" => "idl", "source" => "product", "com" => "san-pham", "type" => "san-pham"),
			array("tbl" => "product", "field" => "id", "source" => "product", "com" => "san-pham", "type" => "san-pham", 'menu' => true),

			array("tbl" => "news", "field" => "id_thuonghieu", "source" => "news", "com" => "thuong-hieu", "type" => "thuong-hieu", 'menu' => true),
			array("tbl" => "news", "field" => "id_dong", "source" => "news", "com" => "dong", "type" => "dong", 'menu' => true),

			array("tbl" => "news_list", "field" => "idl", "source" => "news", "com" => "tin-tuc", "type" => "tin-tuc"),
			array("tbl" => "news", "field" => "id", "source" => "news", "com" => "tin-tuc", "type" => "tin-tuc", 'menu' => true),
			array("tbl" => "news", "field" => "id", "source" => "news", "com" => "su-kien", "type" => "su-kien", 'menu' => true),
			array("tbl" => "news", "field" => "id", "source" => "news", "com" => "thong-bao", "type" => "thong-bao", 'menu' => false),
			array("tbl" => "news", "field" => "id", "source" => "news", "com" => "chinh-sach", "type" => "chinh-sach", 'menu' => false),
			array("tbl" => "news", "field" => "id", "source" => "news", "com" => "bai-viet-thuong-hieu", "type" => "bai-viet-thuong-hieu", 'menu' => false),
			array("tbl" => "news", "field" => "id", "source" => "news", "com" => "ho-tro", "type" => "ho-tro", 'menu' => false),
			array("tbl" => "static", "field" => "id", "source" => "static", "com" => "gioi-thieu", "type" => "gioi-thieu", 'menu' => true),
			array("tbl" => "static", "field" => "id", "source" => "contact", "com" => "lien-he", "type" => "lien-he", 'menu' => true),
		);
		header("Content-Type: text/xml;charset=iso-8859-1");
	 header('Content-type: text/xml');
		$d = new PDODb($info_db);






		$data = array(
			'data' => array(),
			'requick' => $requick,
			'd' => new PDODb($info_db),
		);

		$this->load->view("sitemap", $data);
	}
}
