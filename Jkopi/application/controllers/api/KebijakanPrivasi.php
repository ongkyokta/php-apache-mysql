<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KebijakanPrivasi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('Tracking', 'tracking');
    }

    /* FUNCTION WEBVIEW KEBIJAKAN DAN PRIVASI
	* ----------------------------------------
	* View: master_data/kebijakan_privasi/webview
	*
	*/
    public function webview()
    {
        // TODO: LOG Record
        $data['KebijakanPrivasi'] = $this->db->query("SELECT * FROM term WHERE status = 'kebijakan'")->row();
        $this->load->view('master_data/kebijakan_privasi/webview', $data);
    }
}
