<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SyaratKetentuan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('Tracking', 'tracking');
	}

	/* FUNCTION WEBVIEW SYARAT DAN KETENTUAN
	* ----------------------------------------
	* View: master_data/syarat_ketentuan/webview
	*
	*/
	public function webview()
	{
		$data['SyaratKetentuan'] = $this->db->query("SELECT * FROM term WHERE status = 'snk'")->row();
		// TODO: LOG Record
		$this->load->view('master_data/syarat_ketentuan/webview', $data);
	}
}
