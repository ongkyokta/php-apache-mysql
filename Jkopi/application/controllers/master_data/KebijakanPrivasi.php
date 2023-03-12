<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KebijakanPrivasi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Models', 'models');
		notLogin();
	}


	/* FUNCTION INDEX KEBIJAKAN DAN PRIVASI
	* ----------------------------------------
	* View: master_data/kebijakan_privasi/data
	*
	*/
	public function index()
	{
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim', [
			'required' => 'Deskripsi kosong, mohon isi terlebih dahulu',
		]);
		if ($this->form_validation->run() == false) {
			$id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
			$data['Pengguna'] = $id_admin;
			$data['ketentuan'] = $this->db->get_where('term', ['status' => 'kebijakan'])->row();
			$this->load->view('master_data/kebijakan_privasi/data', $data);
		} else {
			$arr = [
				'deskripsi' => $this->input->post('deskripsi'),
			];
			if ($this->models->update($arr, 1, 'id', 'term')) {
				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil mengubah data 
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>'
				);
				redirect('master_data/KebijakanPrivasi');
			} else {
				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-danger mb-3" role="alert">Gagal mengubah data
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>'
				);
				redirect('master_data/KebijakanPrivasi');
			}
		}
	}
}
