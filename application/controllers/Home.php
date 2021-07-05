<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function index()
	{
		$data['title'] = "Beranda | Catalog App";
		$data['content'] = "main/home";
		$data['logo'] = $this->db->query("select * from custom where type = 'logo'")->result()[0]->nama_foto;
		$data['banner'] = $this->db->query("select * from custom where type = 'banner'")->result()[0]->nama_foto;
		$data['socmeds'] = $this->db->query("select * from socmed where tampilkan = 1")->result();

		$this->load->view('main/template', $data);
	}

	function getCategories()
	{
		$res = $this->db->get("kategori")->result();
		echo json_encode($res);
	}

	function getProducts($limit = "")
	{
		$category = $this->input->get('category');
		$limit = ($limit != "") ? $limit : 10;

		$query = "select * from produk order by tgl_upload limit $limit";
		if (strlen($category)) {
			$query = "select * from produk where kategori = '$category' order by tgl_upload limit $limit";
		}

		$products = $this->db->query($query)->result();
		$photos = $this->db->get('foto_produk')->result();

		foreach ($products as $product) {
			$product->foto_produk = [];
		}

		foreach ($photos as $photo) {
			foreach ($products as $idx => $product) {
				if (($photo->id_produk == $product->id_produk)) {
					if (!count($product->foto_produk)) {
						$products[$idx]->foto_produk[0] = $photo;
					}
				}
			}
		}
		echo json_encode($products);
	}
}
