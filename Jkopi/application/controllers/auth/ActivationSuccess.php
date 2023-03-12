<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ActivationSuccess extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    /* INDEX ACCOUNT ACTIVATION SUCCESS
	* ----------------------------------------
	* View: auth/activation_success
	*
	*/
    public function index()
    {
        $email = $_GET['email'];
        $this->db->set('is_active', 'aktif');
        $this->db->where('email', $email);
        $this->db->update('pengguna');
        $this->load->view('auth/activation_success');
    }
}
