<?php
defined('BASEPATH') or exit('No direct script access allowed');

class VersiAplikasi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'models');
        notLogin();
    }


    /* FUNCTION INDEX VERSI APLIKASI
	* ----------------------------------------
	* View: menu_informasi/versi_aplikasi/data
	*
	*/
    public function index()
    {
        $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
        $data['Pengguna'] = $id_admin;

        $this->load->view('menu_informasi/versi_aplikasi/data', $data);
    }

    /* FUNCTION GET ALL DATA VERSI APLIKASI
	* ----------------------------------------
	*
	*/
    public function getAllData()
    {
        $data = $this->db->query("SELECT * FROM versi_aplikasi")->result_array();
        echo json_encode($data);
    }

    /* INDEX TAMBAH VERSI APLIKASI
	* ----------------------------------------
	* View: menu_informasi/versi_aplikasi/tambah
	*
	*/
    public function tambah()
    {
        $this->form_validation->set_rules('versi_aplikasi', 'Versi Aplikasi', 'required|trim', [
            'required' => 'Versi aplikasi kosong, mohon isi terlebih dahulu',
        ]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim', [
            'required' => 'Deskripsi kosong, mohon isi terlebih dahulu',
        ]);

        if ($this->form_validation->run() == false) {
            $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
            $data['Pengguna'] = $id_admin;

            $this->load->view('menu_informasi/versi_aplikasi/tambah', $data);
        } else {
            $arr = [
                'id_versi' => $this->models->randomkode(8),
                'versi_aplikasi' => $this->input->post('versi_aplikasi'),
                'deskripsi' => $this->input->post('deskripsi'),
                'created_at' => date('Y-m-d H:i:s'),
                'edited_at' => date('Y-m-d H:i:s'),
            ];
            if ($this->models->insert('versi_aplikasi', $arr)) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil menambahkan data versi aplikasi</div>'
                );
                redirect('menu_informasi/VersiAplikasi');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger mb-3 mt-3" role="alert">Gagal menambahkan data versi aplikasi</div>'
                );
                redirect('menu_informasi/VersiAplikasi');
            }
        }
    }

    /* INDEX EDIT VERSI APLIKASI
	* ----------------------------------------
	* View: menu_informasi/versi_aplikasi/edit
	*
	*/
    public function edit($id)
    {
        $this->form_validation->set_rules('versi_aplikasi', 'Versi Aplikasi', 'required|trim', [
            'required' => 'Versi aplikasi kosong, mohon isi terlebih dahulu',
        ]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim', [
            'required' => 'Deskripsi kosong, mohon isi terlebih dahulu',
        ]);

        if ($this->form_validation->run() == false) {
            $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
            $data['Pengguna'] = $id_admin;
            $data['Versi'] = $this->db->get_where('versi_aplikasi', ['id_versi' => $id])->row();
            $this->load->view('menu_informasi/versi_aplikasi/edit', $data);
        } else {
            $arr = [
                'versi_aplikasi' => $this->input->post('versi_aplikasi'),
                'deskripsi' => $this->input->post('deskripsi'),
                'edited_at' => date('Y-m-d H:i:s'),
            ];
            if ($this->models->update($arr, $id, 'id_versi', 'versi_aplikasi')) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil mengubah data versi aplikasi</div>'
                );
                redirect('menu_informasi/VersiAplikasi');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger mb-3 mt-3" role="alert">Gagal mengubah data versi aplikasi</div>'
                );
                redirect('menu_informasi/VersiAplikasi');
            }
        }
    }

    /* FUNCTION HAPUS VERSI APLIKASI
        * ----------------------------------------
        *
        */
    public function delete()
    {
        $id = $_POST['id'];
        $this->db->where('id_versi', $id);
        $this->db->delete('versi_aplikasi');
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil menghapus data versi aplikasi
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>'
        );
        redirect('menu_informasi/VersiAplikasi');
    }
}
