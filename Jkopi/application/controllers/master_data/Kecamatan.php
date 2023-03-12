<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kecamatan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Models', 'models');
		notLogin();
	}

	/* INDEX KECAMATAN
	* ----------------------------------------
	* View: master_data/kecamatan/data
	*
	*/
	public function index()
	{
		$id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
		$data['Pengguna'] = $id_admin;

		$this->load->view('master_data/kecamatan/data', $data);
	}
	public function getAllData()
	{
		$this->db->select('id_kecamatan, nama_kecamatan');
		$query = $this->db->get('kecamatan')->result_array();
		echo json_encode($query);
	}

	/* INDEX TAMBAH KECAMATAN
	* ----------------------------------------
	* View: master_data/kecamatan/tambah
	*
	*/
	public function tambah()
	{
		$this->form_validation->set_rules('nama_kecamatan', 'Nama Kecamatan', 'required|trim', [
			'required' => 'Nama Kecamatan kosong, mohon isi terlebih dahulu',
		]);
		$this->form_validation->set_rules('geojson', 'Geojson', 'required', [
			'required' => 'Geojson kosong, mohon isi terlebih dahulu',
		]);
		$this->form_validation->set_rules('latitude', 'Latitude dan Longitude', 'required', [
			'required' => 'Latitude dan Longitude kosong, mohon isi terlebih dahulu',
		]);
		if ($this->form_validation->run() == false) {
			$id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
			$data['Pengguna'] = $id_admin;

			$this->load->view('master_data/kecamatan/tambah', $data);
		} else {
			$lat = $this->input->post('latitude');
			$latsplit = explode(", ", $lat);
			$arr = [
				'nama_kecamatan' => $this->input->post('nama_kecamatan'),
				'geojson' => $this->input->post('geojson'),
				'warna' => '#ffffff',
				'latitude' => $latsplit[0],
				'longitude' => $latsplit[1],
			];
			if ($this->models->insert('kecamatan', $arr)) {
				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil tambah data 
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>'
				);
				redirect('master_data/Kecamatan');
			} else {
				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-danger mb-3" role="alert">Gagal tambah data
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>'
				);
				redirect('master_data/Kecamatan');
			}
		}
	}

	/* INDEX EDIT KECAMATAN
	* ----------------------------------------
	* View: master_data/kecamatan/edit
	*
	*/
	public function edit($id)
	{
		$this->form_validation->set_rules('nama_kecamatan', 'Nama Kecamatan', 'required|trim', [
			'required' => 'Nama Kecamatan kosong, mohon isi terlebih dahulu',
		]);
		$this->form_validation->set_rules('geojson', 'Geojson', 'required', [
			'required' => 'Geojson kosong, mohon isi terlebih dahulu',
		]);
		$this->form_validation->set_rules('latitude', 'Latitude dan Longitude', 'required', [
			'required' => 'Latitude dan Longitude kosong, mohon isi terlebih dahulu',
		]);
		if ($this->form_validation->run() == false) {

			$id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
			$data['Pengguna'] = $id_admin;
			$data['kecamatan'] = $this->db->get_where('kecamatan', ['id_kecamatan' => $id])->row();
			$this->load->view('master_data/kecamatan/edit', $data);
		} else {
			$lat = $this->input->post('latitude');
			$latsplit = explode(", ", $lat);
			$arr = [
				'nama_kecamatan' => $this->input->post('nama_kecamatan'),
				'geojson' => $this->input->post('geojson'),
				'warna' => '#ffffff',
				'latitude' => $latsplit[0],
				'longitude' => $latsplit[1],
			];
			if ($this->models->update($arr, $id, 'id_kecamatan', 'kecamatan')) {
				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil ubah data 
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>'
				);
				redirect('master_data/Kecamatan');
			} else {
				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-danger mb-3" role="alert">Gagal ubah data
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>'
				);
				redirect('master_data/Kecamatan');
			}
		}
	}

	/* INDEX HAPUS KECAMATAN
	* ----------------------------------------
	* View: master_data/kecamatan
	*
	*/
	public function delete()
	{
		$id = $_POST['id'];
		$this->db->where('id_kecamatan', $id);
		$this->db->delete('kecamatan');
		$this->session->set_flashdata(
			'message',
			'<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil hapus data 
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		</div>'
		);
		redirect('master_data/Kecamatan');
	}

	/* FUNCTION GET DATA KECAMATAN
	* ----------------------------------------
	*
	*/
	public function get_kecamatan()
	{
		$kecamatan = $this->db->query("SELECT * FROM kecamatan")->result();
		echo json_encode($kecamatan);
	}
}
