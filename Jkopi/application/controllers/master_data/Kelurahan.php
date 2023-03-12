<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelurahan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Models', 'models');
		notLogin();
	}

	/* INDEX KELURAHAN
	* ----------------------------------------
	* View: master_data/kelurahan/data
	*
	*/
	public function index()
	{
		$id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
		$data['Pengguna'] = $id_admin;

		$this->load->view('master_data/kelurahan/data', $data);
	}

	/* INDEX TAMBAH KELURAHAN
	* ----------------------------------------
	* View: master_data/kelurahan/tambah
	*
	*/
	public function getAllData()
	{
		$this->db->select('kecamatan.nama_kecamatan, kelurahan.nama_kelurahan, kelurahan.id_kelurahan');
		$this->db->from('kelurahan');
		$this->db->join('kecamatan', 'kecamatan.id_kecamatan = kelurahan.id_kecamatan');
		$query = $this->db->get()->result_array();
		echo json_encode($query);
	}
	public function getAllKelurahan()
	{
		$id = $_POST['kecamatan'];
		$query = $this->db->query("SELECT nama_kelurahan, id_kelurahan FROM kecamatan, kelurahan WHERE kecamatan.id_kecamatan = kelurahan.id_kecamatan AND kelurahan.id_kecamatan = '$id'")->result_array();
		echo json_encode($query);
	}
	public function delete()
	{
		$id = $_POST['id'];
		$this->db->where('id_kelurahan', $id);
		$this->db->delete('kelurahan');
		$this->session->set_flashdata(
			'message',
			'<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil hapus data 
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		</div>'
		);
		redirect('master_data/Kelurahan');
	}
	public function tambah()
	{
		$this->form_validation->set_rules('nama_kelurahan', 'Nama Kelurahan', 'required', [
			'required' => 'Nama Kelurahan kosong, mohon isi terlebih dahulu',
		]);
		if ($this->form_validation->run() == false) {
			$id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
			$data['Pengguna'] = $id_admin;

			$this->load->view('master_data/kelurahan/tambah', $data);
		} else {
			$arr = [
				'id_kecamatan' => $this->input->post('id_kecamatan'),
				'nama_kelurahan' => $this->input->post('nama_kelurahan'),
				'warna' => '#ffffff',
			];
			if ($this->models->insert('kelurahan', $arr)) {
				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil tambah data 
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>'
				);
				redirect('master_data/Kelurahan');
			} else {
				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-danger mb-3" role="alert">Gagal tambah data
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>'
				);
				redirect('master_data/Kelurahan');
			}
		}
	}

	/* INDEX EDIT KELURAHAN
	* ----------------------------------------
	* View: kelurahan/edit
	*
	*/
	public function edit($id)
	{
		$this->form_validation->set_rules('nama_kelurahan', 'Nama Kelurahan', 'required', [
			'required' => 'Nama Kelurahan kosong, mohon isi terlebih dahulu',
		]);
		if ($this->form_validation->run() == false) {
			$id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
			$data['Pengguna'] = $id_admin;
			$kelurahan = $this->db->get_where('kelurahan', ['id_kelurahan' => $id])->row();
			$data['Kecamatan'] = $this->db->query("SELECT id_kecamatan, nama_kecamatan FROM kecamatan")->result_array();
			$data['Kelurahan'] = $kelurahan;
			$this->load->view('master_data/kelurahan/edit', $data);
		} else {
			$arr = [
				'id_kecamatan' => $this->input->post('id_kecamatan'),
				'nama_kelurahan' => $this->input->post('nama_kelurahan'),
				'warna' => '#ffffff',
			];
			if ($this->models->update($arr, $id, 'id_kelurahan', 'kelurahan')) {
				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil tambah data 
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>'
				);
				redirect('master_data/Kelurahan');
			} else {
				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-danger mb-3" role="alert">Gagal tambah data
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>'
				);
				redirect('master_data/Kelurahan');
			}
		}
	}

	/* FUNCTION GET DATA KELURAHAN
	* ----------------------------------------
	*
	*/
	public function get_kelurahan()
	{
		$id = $this->input->post('id_kecamatan');
		$kelurahan = $this->db->query("SELECT * FROM kelurahan WHERE id_kecamatan = '$id'")->result();
		echo json_encode($kelurahan);
	}
}
