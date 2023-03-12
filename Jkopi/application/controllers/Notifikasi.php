<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notifikasi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		notLogin();
	}

	/* INDEX NOTIFIKASI
	* ----------------------------------------
	* View: notifikasi/data
	*
	*/
	public function index()
	{
		$id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
		$data['Pengguna'] = $id_admin;
		$data['notif'] = $this->db->get("notif_web")->result_array();

		$this->load->view('notifikasi/data', $data);
	}
}
