<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'models');
        notLogin();
    }

    /* INDEX ADMIN
	* ----------------------------------------
	* View: master_data/admin/data
	*
	*/
    public function index()
    {
        $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
        $data['Pengguna'] = $id_admin;
        // $data['Notif'] = $this->models->listnotif();
        // $data['notifikasi'] = $this->models->notifikasi();

        $this->load->view('master_data/admin/data', $data);
    }

    /* FUNCTION GET ALL DATA ADMIN
	* ----------------------------------------
	*
	*/
    public function getAllData()
    {
        $data = $this->db->query("SELECT a.id_admin, a.email, a.id_opd, a.is_active, o.id_opd, o.nama_opd FROM admin a, opd o WHERE a.id_opd = o.id_opd ORDER BY a.created_at DESC")->result_array();
        echo json_encode($data);
    }

    /* INDEX TAMBAH ADMIN
	* ----------------------------------------
	* View: master_data/admin/tambah
	*
	*/
    public function tambah()
    {
        $this->form_validation->set_rules('email', 'email', 'required|trim|is_unique[admin.email]', [
            'required' => 'Email kosong, mohon isi terlebih dahulu',
            'is_unique' => 'Email telah terdaftar'
        ]);
        $this->form_validation->set_rules('opd', 'opd', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]|matches[konfirmasiPassword]', [
            'required' => 'Password kosong, mohon isi terlebih dahulu',
            'matches' => 'Password tidak sama',
            'min_length' => 'Minimal password 8 karakter'
        ]);
        $this->form_validation->set_rules('konfirmasiPassword', 'Password', 'required|trim|matches[password]', [
            'required' => 'Konfirmasi password kosong, mohon isi terlebih dahulu',
            'matches' => 'Password tidak sama',
            'min_length' => 'Minimal password 8 karakter'
        ]);

        if ($this->form_validation->run() == false) {
            $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
            $data['Pengguna'] = $id_admin;
            $data['OPD'] = $this->db->query("SELECT id_opd, nama_opd FROM opd")->result_array();

            // $data['Notif'] = $this->models->listnotif();
            // $data['notifikasi'] = $this->models->notifikasi();
            $this->load->view('master_data/admin/tambah', $data);
        } else {
            $arr_data_admin = [
                'id_admin' => $this->models->randomkode(10),
                'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password')),
                'id_opd' => $this->input->post('opd'),
                'status' => 2,
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'edited_at' => date('Y-m-d H:i:s')
            ];

            if ($this->models->insert('admin', $arr_data_admin)) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success mb-3" role="alert">Berhasil menambahkan data admin
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>'
                );
                redirect('master_data/Admin');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger mb-3" role="alert">Gagal menambahkan data admin
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>'
                );
                redirect('master_data/Admin');
            }
        }
    }

    /* INDEX EDIT ADMIN
	* ----------------------------------------
	* View: master_data/admin/edit
	*
	*/
    public function edit($id)
    {
        $this->form_validation->set_rules('opd', 'opd', 'required|trim');
        $this->form_validation->set_rules('new_password', 'new_password', 'trim|min_length[8]|matches[confirm_password]', [
            'matches' => 'Password tidak sama',
            'min_length' => 'Password terlalu pendek, minimal 8 karakter'
        ]);
        $this->form_validation->set_rules('confirm_password', 'confirm_password', 'trim|matches[new_password]', [
            'matches' => 'Password tidak sama',
            'min_length' => 'Password terlalu pendek, minimal 8 karakter'
        ]);

        if ($this->form_validation->run() == false) {
            $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
            $data['Pengguna'] = $id_admin;
            $data['OPD'] = $this->db->query("SELECT id_opd, nama_opd FROM opd")->result_array();
            $data['Admin'] = $this->db->query("SELECT * FROM admin WHERE id_admin = '$id'")->row();
            // $data['Notif'] = $this->models->listnotif();
            // $data['notifikasi'] = $this->models->notifikasi();
            $this->load->view('master_data/admin/edit', $data);
        } else {
            $update_data_admin = $this->models->update(array(
                'password' => md5($this->input->post('new_password')),
                'is_active' => $this->input->post('is_active'),
                'id_opd' => $this->input->post('opd'),
                'edited_at' => date('Y-m-d H:i:s'),
            ), $id, "id_admin", "admin");

            if ($update_data_admin) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success mb-3" role="alert">Berhasil mengubah data admin
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>'
                );
                redirect('master_data/Admin');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger mb-3" role="alert">Gagal mengubah data admin
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>'
                );
                redirect('master_data/Admin');
            }
        }
    }

    /* FUNCTION HAPUS ADMIN
	* ----------------------------------------
	*
	*/
    public function delete()
    {
        $id = $_POST['id'];
        $this->db->where('id_admin', $id);
        $this->db->delete('admin');
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil menghapus data admin
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		</div>'
        );
        redirect('master_data/Admin');
    }
}
