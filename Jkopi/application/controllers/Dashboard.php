<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'models');
        notLogin();
    }

    /* INDEX DASHBOARD
	* ----------------------------------------
	* View: dashboard
	*
	*/
    public function index()
    {
        $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
        $data['Pengguna'] = $id_admin;
        $data['notif'] = $this->db->get("notif_web")->result_array();

        $this->load->view('dashboard/dashboard', $data);
    }

    /* INDEX DASHBOARD SI-JELAS
	* ----------------------------------------
	* View: dashboard
	*
	*/
    public function sijelas()
    {
        $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
        $data['Pengguna'] = $id_admin;
        $data['notif'] = $this->db->get("notif_web")->result_array();

        $this->load->view('dashboard/sijelas', $data);
    }

    /* INDEX DASHBOARD UMKM
	* ----------------------------------------
	* View: dashboard
	*
	*/
    public function umkm()
    {
        $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
        $data['Pengguna'] = $id_admin;
        $data['notif'] = $this->db->get("notif_web")->result_array();

        $this->load->view('dashboard/umkm', $data);
    }

    /* INDEX DASHBOARD J-KOPI
	* ----------------------------------------
	* View: dashboard/jkopi
	*
	*/
    public function jkopi()
    {
        $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
        $data['Pengguna'] = $id_admin;
        $data['notif'] = $this->db->get("notif_web")->result_array();

        $this->load->view('dashboard/jkopi', $data);
    }
}
