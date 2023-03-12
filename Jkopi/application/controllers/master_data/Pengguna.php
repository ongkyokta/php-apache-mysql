<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'models');
        notLogin();
    }

    /* INDEX PENGGUNA
	* ----------------------------------------
	* View: master_data/pengguna/data
	*
	*/
    public function index()
    {
        $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
        $data['Pengguna'] = $id_admin;
        $this->load->view('master_data/pengguna/data', $data);
    }

    /* FUNCTION GET ALL DATA PENGGUNA
	* ----------------------------------------
	*
	*/
    public function getAllData()
    {
        $data = $this->db->order_by('created_at', 'DESC')->get('pengguna')->result_array();
        echo json_encode($data);
    }

    /* DETAIL PENGGUNA
	* ----------------------------------------
	* View: master_data/pengguna/detail
	*
	*/
    public function detail($id)
    {
        $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
        $data['Pengguna'] = $id_admin;

        $data['User'] = $this->db->get_where('pengguna', ['id_pengguna' => $id])->row();
        $this->load->view('master_data/pengguna/detail', $data);
    }

    /* FUNCTION AKTIFKAN PENGGUNA
	* ----------------------------------------
	*
	*/
    public function aktifkan($id)
    {
        $this->db->set('is_active', 1);
        $this->db->where('id_pengguna', $id);
        $this->db->update('pengguna');
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil mengaktifkan akun</div>'
        );

        $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
        $data['Pengguna'] = $id_admin;
        $data['User'] = $this->db->get_where('pengguna', ['id_pengguna' => $id])->row();
        $this->load->view('master_data/pengguna/detail', $data);
    }

    /* FUNCTION NONAKTIFKAN PENGGUNA
	* ----------------------------------------
	*
	*/
    public function nonaktif($id)
    {
        $this->db->set('is_active', 2);
        $this->db->where('id_pengguna', $id);
        $this->db->update('pengguna');
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil menonaktifkan akun</div>'
        );

        $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
        $data['Pengguna'] = $id_admin;
        $data['User'] = $this->db->get_where('pengguna', ['id_pengguna' => $id])->row();
        $this->load->view('master_data/pengguna/detail', $data);
    }
}
