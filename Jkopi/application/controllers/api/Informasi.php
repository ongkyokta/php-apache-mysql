<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Informasi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('Response');
		$this->load->helper('Tracking', 'tracking');
		$this->load->model('Models', 'models');
	}

	/* GET BERITA
	* ----------------------------------------
	*/
	public function berita()
	{
		$berita = $this->db->get_where('berita', ['tipe' => 'berita'])->result_array();
		$data['meta'] = custom_response(200, "Success Created");
		$data['response'] = [
			'message' =>  'Berhasil mengambil data berita',
			'data' => $berita,
		];
		echo json_encode($data);
	}
	public function event()
	{
		$event = $this->db->get_where('berita', ['tipe' => 'acara'])->result_array();
		$data['meta'] = custom_response(200, "Success Created");
		$data['response'] = [
			'message' =>  'Berhasil mengambil data berita',
			'data' => $event,
		];
		echo json_encode($data);
	}
	/* GET DETAIL BERITA
	* ----------------------------------------
	*/
	public function detailberita()
	{
		$id = $this->input->post('id_berita');
		$berita = $this->db->get_where('berita', ['id_berita' => $id])->row();
		// TODO: LOG Record
		$hostValueInHeader = $this->input->request_headers();
		$arr = explode(',', $hostValueInHeader['authorization']);
		$this->models->insertlog($arr[0], $id, 'Berita', getOS(), $arr[1], getBrowser(), getUserIP(), getUrl());
		$data['meta'] = custom_response(200, "Success Created");
		$data['response'] = [
			'message' =>  'Berhasil mengambil data detail berita',
			'data' => $berita,
		];
		echo json_encode($data);
	}
	/* GET KATEGORI FASILITAS UMUM
	* ----------------------------------------
	*/
	public function kategori_fasilitas()
	{
		$fasilitas = $this->db->get('kategori_fasilitas')->result_array();
		$data['meta'] = custom_response(200, "Success Created");
		$data['response'] = [
			'message' =>  'Berhasil mengambil data kategori fasilitas umum',
			'data' => $fasilitas,
		];
		// TODO: LOG Record
		$hostValueInHeader = $this->input->request_headers();
		$arr = explode(',', $hostValueInHeader['authorization']);
		$this->models->insertlog($arr[0], '', 'Kategori Fasilitas', getOS(), $arr[1], getBrowser(), getUserIP(), getUrl());
		echo json_encode($data);
	}

	/* GET FASILITAS UMUM
	* ----------------------------------------
	*/
	public function fasilitas_umum()
	{
		$id = $this->input->post('id_kategori');
		$fasilitas = $this->db->get_where('fasilitas_umum', ['id_kategori' => $id])->result_array();
		$data['meta'] = custom_response(200, "Success Created");
		$data['response'] = [
			'message' =>  'Berhasil mengambil data fasilitas umum',
			'data' => $fasilitas,
		];
		// TODO: LOG Record
		$hostValueInHeader = $this->input->request_headers();
		$arr = explode(',', $hostValueInHeader['authorization']);
		$this->models->insertlog($arr[0], '', 'Fasilitas Umum', getOS(), $arr[1], getBrowser(), getUserIP(), getUrl());
		echo json_encode($data);
	}

	/* GET DETAIL FASILITAS UMUM
	* ----------------------------------------
	*/
	public function detail_fasilitas_umum()
	{
		$id = $this->input->post('id_fasilitas');
		$fasilitas_umum = $this->db->get_where('fasilitas_umum', ['id_fasilitas' => $id])->row();
		$data['meta'] = custom_response(200, "Success Created");
		$data['response'] = [
			'message' =>  'Berhasil mengambil data detail fasilitas umum',
			'data' => $fasilitas_umum,
		];
		// TODO: LOG Record
		$hostValueInHeader = $this->input->request_headers();
		$arr = explode(',', $hostValueInHeader['authorization']);
		$this->models->insertlog($arr[0], $id, 'Detail Fasilitas Umum', getOS(), $arr[1], getBrowser(), getUserIP(), getUrl());
		echo json_encode($data);
	}

	/* GET KONTAK KAMI
	* ----------------------------------------
	*/
	public function kontakkami()
	{
		$kontak_kami = $this->db->get('kontak_kami')->result_array();
		$data['meta'] = custom_response(200, "Success Created");
		$data['response'] = [
			'message' =>  'Berhasil mengambil data kontak kami',
			'data' => $kontak_kami,
		];
		// TODO: LOG Record
		$hostValueInHeader = $this->input->request_headers();
		$arr = explode(',', $hostValueInHeader['authorization']);
		$this->models->insertlog($arr[0], '', 'Kontak Kami', getOS(), $arr[1], getBrowser(), getUserIP(), getUrl());
		echo json_encode($data);
	}

	/* GET APLIKASI JYANMAS
	* ----------------------------------------
	*/
	public function aplikasi_jyanmas()
	{
		$app_jyanmas = $this->db->get_where('aplikasi', ['kategori' => 'jyanmas'])->result_array();
		$data['meta'] = custom_response(200, "Success Created");
		$data['response'] = [
			'message' =>  'Berhasil mengambil data aplikasi JYanmas',
			'data' => $app_jyanmas,
		];
		echo json_encode($data);
	}
	public function aplikasi_jemberkeren()
	{
		$app_jyanmas = $this->db->get_where('aplikasi', ['kategori' => 'jember keren'])->result_array();
		$data['meta'] = custom_response(200, "Success Created");
		$data['response'] = [
			'message' =>  'Berhasil mengambil data aplikasi JYanmas',
			'data' => $app_jyanmas,
		];
		echo json_encode($data);
	}
	public function detailapp()
	{
		$id = $this->input->post('id_aplikasi');
		$app_jyanmas = $this->db->get_where('aplikasi', ['id_aplikasi' => $id])->row();
		$data['meta'] = custom_response(200, "Success Created");
		$data['response'] = [
			'message' =>  'Berhasil mengambil data aplikasi JYanmas',
			'data' => $app_jyanmas,
		];
		// TODO: LOG Record
		$hostValueInHeader = $this->input->request_headers();
		$arr = explode(',', $hostValueInHeader['authorization']);
		$this->models->insertlog($arr[0], $id, 'Detail Aplikasi', getOS(), $arr[1], getBrowser(), getUserIP(), getUrl());
		echo json_encode($data);
	}

	/* GET APLIKASI JDER
	* ----------------------------------------
	*/
	public function aplikasi_jder()
	{
		$app_jder = $this->db->get_where('aplikasi', ['kategori' => 'jder'])->result_array();
		$data['meta'] = custom_response(200, "Success Created");
		$data['response'] = [
			'message' =>  'Berhasil mengambil data aplikasi JDer',
			'data' => $app_jder,
		];
		echo json_encode($data);
	}

	/* GET KEDARURATAN
	* ----------------------------------------
	*/
	public function kedaruratan()
	{
		$kedaruratan = $this->db->get('kedaruratan')->result_array();
		$data['meta'] = custom_response(200, "Success Created");
		$data['response'] = [
			'message' =>  'Berhasil mengambil data kedaruratan',
			'data' => $kedaruratan,
		];
		echo json_encode($data);
	}

	/* GET HOTLINE
	* ----------------------------------------
	*/
	public function hotline()
	{
		$hotline = $this->db->query('SELECT id_opd, nama_opd, no_telp FROM opd WHERE status = "aktif"')->result_array();
		$data['meta'] = custom_response(200, "Success");
		$data['response'] = [
			'message' =>  'Berhasil mengambil data hotline',
			'data' => $hotline
		];
		// TODO: LOG Record
		$hostValueInHeader = $this->input->request_headers();
		$arr = explode(',', $hostValueInHeader['authorization']);
		$this->models->insertlog($arr[0], '', 'HotLine', getOS(), $arr[1], getBrowser(), getUserIP(), getUrl());
		echo json_encode($data);
	}

	/* GET SLIDER
	* ----------------------------------------
	*/
	public function slider()
	{
		$slider = $this->db->get('slider')->result_array();
		$data['meta'] = custom_response(200, "Success Created");
		$data['response'] = [
			'message' =>  'Berhasil mengambil data slider',
			'data' => $slider,
		];
		echo json_encode($data);
	}

	/* GET KEBIJAKAN PRIVASI
	* ----------------------------------------
	*/
	public function kebijakan()
	{
		$kebijakan = $this->db->get_where('term', ['status' => 'kebijakan'])->row();
		$data['meta'] = custom_response(200, "Success Created");
		$data['response'] = [
			'message' =>  'Berhasil mengambil data kebijakan privasi',
			'data' => $kebijakan,
		];
		// // DONE: LOG Record
		// $hostValueInHeader = $this->input->request_headers();
		// $arr = explode(',', $hostValueInHeader['authorization']);
		// $this->models->insertlog($arr[0], '', 'Kebijakan Privasi', getOS(), $arr[1], getBrowser(), getUserIP(), getUrl());
		echo json_encode($data);
	}

	/* GET SYARAT DAN KETENTUAN
	* ----------------------------------------
	*/
	public function snk()
	{
		$snk = $this->db->get_where('term', ['status' => 'snk'])->row();
		$data['meta'] = custom_response(200, "Success Created");
		$data['response'] = [
			'message' =>  'Berhasil mengambil data syarat dan ketentuan',
			'data' => $snk,
		];
		// // DONE: LOG Record
		// $hostValueInHeader = $this->input->request_headers();
		// $arr = explode(',', $hostValueInHeader['authorization']);
		// $this->models->insertlog($arr[0], '', 'Syarat dan Ketentuan', getOS(), $arr[1], getBrowser(), getUserIP(), getUrl());
		echo json_encode($data);
	}
	public function notif()
	{
		$id = $this->input->post('id_pengguna', TRUE);
		$notif = $this->db->get_where('notif_user', ['type' => 	$id])->result_array();
		$data['meta'] = custom_response(200, "Success Created");
		$data['response'] = [
			'message' =>  'Berhasil mengambil data syarat dan ketentuan',
			'data' => $notif,
		];
		// DONE: LOG Record
		$hostValueInHeader = $this->input->request_headers();
		$arr = explode(',', $hostValueInHeader['authorization']);
		$this->models->insertlog($arr[0], '', 'Notifikasi Pengguna', getOS(), $arr[1], getBrowser(), getUserIP(), getUrl());
		echo json_encode($data);
	}
	public function getKategoriEcommerce()
	{
		$kategori = $this->db->get('kategori_ecommerce')->result_array();
		$data['meta'] = custom_response(200, "Success Created");
		$data['response'] = [
			'message' =>  'Berhasil mengambil data Kategori',
			'data' => $kategori,
		];
		echo json_encode($data);
	}
	public function getProduk()
	{
		$kategori = $this->db->query("SELECT kategori_ecommerce.* , ecommerce.* , kelurahan.nama_kelurahan , kecamatan.nama_kecamatan FROM kategori_ecommerce , ecommerce, kecamatan, kelurahan WHERE ecommerce.id_kecamatan = kecamatan.id_kecamatan AND  ecommerce.id_kelurahan = kelurahan.id_kelurahan AND kategori_ecommerce.id_kategori = ecommerce.id_kategori")->result_array();
		$data['meta'] = custom_response(200, "Success Created");
		$data['response'] = [
			'message' =>  'Berhasil mengambil data Kategori',
			'data' => $kategori,
		];
		echo json_encode($data);
	}
	public function getProdukByKategori()
	{
		$id_kategori = $this->input->post('id_kategori', TRUE);
		$kategori = $this->db->query("SELECT kategori_ecommerce.* , ecommerce.* , kelurahan.nama_kelurahan , kecamatan.nama_kecamatan FROM kategori_ecommerce , ecommerce, kecamatan, kelurahan WHERE ecommerce.id_kecamatan = kecamatan.id_kecamatan AND  ecommerce.id_kelurahan = kelurahan.id_kelurahan AND kategori_ecommerce.id_kategori = ecommerce.id_kategori AND ecommerce.id_kategori = '$id_kategori'")->result_array();
		$data['meta'] = custom_response(200, "Success Created");
		$data['response'] = [
			'message' =>  'Berhasil mengambil data Kategori',
			'data' => $kategori,
		];
		// $hostValueInHeader = $this->input->request_headers();
		// $arr = explode(',', $hostValueInHeader['authorization']);
		// $this->models->insertlog($arr[0], $id_kategori, 'Produk Berdasarkan Kategori', getOS(), 	$arr[1], getBrowser(), getUserIP(), getUrl());
		echo json_encode($data);
	}
	// DONE: LOG Record
	public function createLog()
	{
		$id_pengguna = $this->input->post('id_pengguna', TRUE);
		$id_content = $this->input->post('id_content', TRUE);
		$content = $this->input->post('content', TRUE);
		$model = $this->input->post('model', TRUE);

		$this->models->insertlog($id_pengguna, $id_content, $content, getOS(), $model, getBrowser(), getUserIP(), getUrl());
		$data['response'] = [
			'message' =>  'Berhasil Membuat Log',
		];
		echo json_encode($data);
	}
	public function keyurl()
	{
		$api = $this->db->get('api_key')->result_array();
		$data['meta'] = custom_response(200, "Success Created");
		$data['response'] = [
			'message' =>  'Berhasil mengambil data api',
			'data' => $api,
		];
		echo json_encode($data);
	}
}
