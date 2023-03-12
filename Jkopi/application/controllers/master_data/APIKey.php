<?php
defined('BASEPATH') or exit('No direct script access allowed');

class APIKey extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'models');
        notLogin();
    }


    /* FUNCTION INDEX API KEY
	* ----------------------------------------
	* View: master_data/api_key/data
	*
	*/
    public function index()
    {
        $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
        $data['Pengguna'] = $id_admin;

        $this->load->view('master_data/api_key/data', $data);
    }

    /* FUNCTION GET ALL DATA API KEY
	* ----------------------------------------
	*
	*/
    public function getAllData()
    {
        $data = $this->db->query("SELECT * FROM api_key")->result_array();
        echo json_encode($data);
    }

    /* INDEX TAMBAH API Key
	* ----------------------------------------
	* View: master_data/api_key/tambah
	*
	*/
    public function tambah()
    {
        $this->form_validation->set_rules('nama_api', 'Nama API', 'required|trim', [
            'required' => 'Nama API kosong, mohon isi terlebih dahulu',
        ]);
        $this->form_validation->set_rules('url', 'URL', 'required|trim', [
            'required' => 'URL kosong, mohon isi terlebih dahulu',
        ]);
        $this->form_validation->set_rules('token', 'Token', 'required|trim', [
            'required' => 'Token kosong, mohon isi terlebih dahulu',
        ]);

        if ($this->form_validation->run() == false) {
            $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
            $data['Pengguna'] = $id_admin;

            $this->load->view('master_data/api_key/tambah', $data);
        } else {
            $arr = [
                'id_api' => $this->models->randomkode(8),
                'nama_api' => $this->input->post('nama_api'),
                'url' => $this->input->post('url'),
                'token' => $this->input->post('token'),
                'created_at' => date('Y-m-d H:i:s'),
                'edited_at' => date('Y-m-d H:i:s'),
            ];
            if ($this->models->insert('api_key', $arr)) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil menambahkan data API dinamis</div>'
                );
                redirect('master_data/APIKey');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger mb-3 mt-3" role="alert">Gagal menambahkan data API dinamis</div>'
                );
                redirect('master_data/APIKey');
            }
        }
    }

    /* INDEX EDIT API KEY
	* ----------------------------------------
	* View: master_data/api_key/edit
	*
	*/
    public function edit($id)
    {
        $this->form_validation->set_rules('nama_api', 'Nama API', 'required|trim', [
            'required' => 'Nama API kosong, mohon isi terlebih dahulu',
        ]);
        $this->form_validation->set_rules('url', 'URL', 'required|trim', [
            'required' => 'URL kosong, mohon isi terlebih dahulu',
        ]);
        $this->form_validation->set_rules('token', 'Token', 'required|trim', [
            'required' => 'Token kosong, mohon isi terlebih dahulu',
        ]);

        if ($this->form_validation->run() == false) {
            $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
            $data['Pengguna'] = $id_admin;
            $data['API'] = $this->db->get_where('api_key', ['id_api' => $id])->row();
            $this->load->view('master_data/api_key/edit', $data);
        } else {
            $arr = [
                'nama_api' => $this->input->post('nama_api'),
                'url' => $this->input->post('url'),
                'token' => $this->input->post('token'),
                'edited_at' => date('Y-m-d H:i:s'),
            ];
            if ($this->models->update($arr, $id, 'id_api', 'api_key')) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil mengubah data API dinamis</div>'
                );
                redirect('master_data/APIKey');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger mb-3 mt-3" role="alert">Gagal mengubah data API dinamis</div>'
                );
                redirect('master_data/APIKey');
            }
        }
    }

    /* FUNCTION HAPUS API KEY
    * ----------------------------------------
    *
    */
    public function delete()
    {
        $id = $_POST['id'];
        $this->db->where('id_api', $id);
        $this->db->delete('api_key');
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil menghapus data API dinamis
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>'
        );
        redirect('master_data/APIKeyAPIKey');
    }
}
