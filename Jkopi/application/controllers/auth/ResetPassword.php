<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ResetPassword extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    /* INDEX RESET PASSWORD
	* ----------------------------------------
	* View: auth/reset_password
	*
	*/
    public function index()
    {
        $email = $_GET['email'];
        $pass = md5($this->input->post('password'));
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]|matches[konfirmasiPassword]', [
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
            $this->load->view('auth/reset_password');
        } else {
            $queryUsers = $this->db->get_where('pengguna', ['email' => $email])->row();
            if ($queryUsers) {
                $this->db->set('password', $pass);
                $this->db->where('email', $email);
                $this->db->update('pengguna');
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil mengubah password
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>'
                );
                redirect('auth/ResetPassword/success');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger mb-3 mt-3" role="alert">Email tidak ditemukan
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>'
                );
                redirect('auth/ResetPassword?email=' . $email);
            }
        }
    }

    /* INDEX RESET PASSWORD SUCCESS
	* ----------------------------------------
	* View: auth/reset_password_success
	*
	*/
    public function success()
    {
        $this->load->view('auth/reset_password_success');
    }
}
