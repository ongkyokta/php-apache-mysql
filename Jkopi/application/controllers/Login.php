<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	/* INDEX LOGIN
	* ----------------------------------------
	* View: auth/login
	*
	*/
	public function index()
	{
		$akun_status = $this->session->userdata('status');
		if ($akun_status == 1) {
			redirect('master_data/Verifikasi_KTP');
		}

		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('auth/login');
		} else {
			$email = $this->input->post('email');
			$password = md5($this->input->post('password'));

			$user = $this->db->get_where('admin', ['email' => $email])->row_array();
			if ($user) {
				if ($user['is_active'] == 1) {
					if ($password === $user['password']) {
						$data = [
							'email' => $user['email'],
							'id_admin' => $user['id_admin'],
							'status' => $user['status'],
						];
						$this->session->set_userdata($data);
						redirect('master_data/Verifikasi_KTP');
					} else {
						$this->session->set_flashdata(
							'message',
							'<div class="alert alert-danger mb-3" role="alert">Password salah
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							</div>'
						);
						redirect('Login');
					}
				} else {
					$this->session->set_flashdata(
						'message',
						'<div class="alert alert-danger mb-3" role="alert">Akun Anda tidak aktif
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>'
					);
					redirect('Login');
				}
			} else {
				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-danger mb-3" role="alert">Email belum terdaftar
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>'
				);
				redirect('Login');
			}
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('id_admin');
		$this->session->unset_userdata('status');
		redirect('Login');
	}
}
