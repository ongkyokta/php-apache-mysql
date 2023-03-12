<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hotline extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'models');
        notLogin();
    }

    /* INDEX HOTLINE
	* ----------------------------------------
	* View: master_data/j_yanmas/hotline/data
	*
	*/
    public function index()
    {
        $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
        $data['Pengguna'] = $id_admin;

        $this->load->view('master_data/j_yanmas/hotline/data', $data);
    }

    /* FUNCTION GET ALL DATA HOTLINE
	* ----------------------------------------
	*
	*/
    public function getAllData()
    {
        $data = $this->db->order_by('created_at', 'DESC')->get('opd')->result_array();
        echo json_encode($data);
    }

    /* INDEX EDIT HOTLINE
	* ----------------------------------------
	* View: master_data/j_yanmas/hotline/edit
	*
	*/
    public function edit($id)
    {
        $this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'required|trim', [
            'required' => 'Nomor telepon OPD kosong, mohon isi terlebih dahulu',
        ]);

        if ($this->form_validation->run() == false) {
            $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
            $data['Pengguna'] = $id_admin;
            $data['Hotline'] = $this->db->get_where('opd', ['id_opd' => $id])->row();
            $this->load->view('master_data/j_yanmas/hotline/edit', $data);
        } else {
            $arr = [
                'no_telp' => $this->input->post('no_telp'),
                'edited_at' => date('Y-m-d H:i:s'),
            ];
            if ($this->models->update($arr, $id, 'id_opd', 'opd')) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil mengubah data hotline
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>'
                );
                redirect('master_data/j_yanmas/Hotline');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger mb-3" role="alert">Gagal mengubah data hotline
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>'
                );
                redirect('master_data/j_yanmas/Hotline');
            }
        }
    }
}
