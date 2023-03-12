<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akun extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'models');
        notLogin();
    }

    /* INDEX AKUN
	* ----------------------------------------
	* View: akun/data
	*
	*/
    public function index()
    {
        $this->form_validation->set_rules('passwordlama', 'Password Lama', 'required', [
            'required' => 'Password lama kosong, mohon isi terlebih dahulu',
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|matches[konfirmasiPassword]', [
            'required' => 'Password baru kosong, mohon isi terlebih dahulu',
            'matches' => 'Password Tidak Sama!',
            'min_length' => 'Password Terlalu Pendek'
        ]);
        $this->form_validation->set_rules('konfirmasiPassword', 'Password', 'required|trim|matches[password]', [
            'required' => 'Konfirmasi password kosong, mohon isi terlebih dahulu',
            'matches' => 'Password Tidak Sama!',
            'min_length' => 'Password Terlalu Pendek'
        ]);
        if ($this->form_validation->run() == false) {
            $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
            $data['Pengguna'] = $id_admin;

            $this->load->view('akun/data', $data);
        } else {
            $id_admin = $this->db->get_where('admin', ['id_admin' =>
            $this->session->userdata('id_admin')])->row_array();
            $id = $id_admin['id_admin'];
            $query = $this->db->query("SELECT * FROM admin WHERE id_admin = '$id'")->row();

            $passwordlama = md5($this->input->post('passwordlama'));
            if ($query) {
                if ($passwordlama == $query->password) {
                    $this->models->update([
                        'password' => md5($this->input->post('password')),
                    ], $id, 'id_admin', 'admin');
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success mb-3" role="alert">Berhasil mengubah data akun
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>'
                    );
                    redirect('Akun');
                } else {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-danger mb-3" role="alert">Password lama salah
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>'
                    );
                    redirect('Akun');
                }
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger mb-3" role="alert">Data tidak ditemukan
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>'
                );
                redirect('Akun');
            }
        }
    }
}
