<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Slider extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Models', 'models');
		notLogin();
	}

	/* INDEX SLIDER
	* ----------------------------------------
	* View: master_data/slider/data
	*
	*/
	public function index()
	{
		$id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
		$data['Pengguna'] = $id_admin;

		$this->load->view('master_data/slider/data', $data);
	}

	/* FUNCTION GET ALL DATA SLIDER
	* ----------------------------------------
	*
	*/
	public function getAllData()
	{
		$data = $this->db->order_by('created_at', 'DESC')->get('slider')->result_array();
		echo json_encode($data);
	}

	/* INDEX TAMBAH SLIDER
	* ----------------------------------------
	* View: master_data/slider/tambah
	*
	*/
	public function tambah()
	{
		$this->form_validation->set_rules('gambar', 'Gambar', 'trim');

		if ($this->form_validation->run() == false) {
			$id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
			$data['Pengguna'] = $id_admin;

			$this->load->view('master_data/slider/tambah', $data);
		} else {
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
			$config['max_size'] = '1024';
			$config['upload_path'] = './uploads/slider';
			$config['encrypt_name'] = TRUE;
			$gambar = "";
			$this->load->library('upload', $config);
			if (!empty($_FILES['gambar']['name'])) {
				if ($this->upload->do_upload('gambar')) {
					$gambar = $this->upload->data();
					$gambar = "uploads/slider/" . $gambar['file_name'];
				} else {
					$this->session->set_flashdata(
						'message',
						'<div class="alert alert-danger mb-3" role="alert">' . $this->upload->display_errors() .
							'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>'
					);
					redirect('master_data/Slider');
				}
			} else {
				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-danger mb-3" role="alert">Gambar Belum Dipilih<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>'
				);
				redirect('master_data/Slider');
			}
			$arr = [
				'id_slider' => $this->models->randomkode(10),
				'gambar' => $gambar,
				'aktif' => 'aktif',
				'created_at' => date('Y-m-d H:i:s'),
				'edited_at' => date('Y-m-d H:i:s'),
			];
			if ($this->models->insert('slider', $arr)) {
				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil menambahkan data slider
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>'
				);
				redirect('master_data/Slider');
			} else {
				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-danger mb-3" role="alert">Gagal menambahkan data slider
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>'
				);
				redirect('master_data/Slider');
			}
		}
	}

	/* INDEX EDIT SLIDER
	* ----------------------------------------
	* View: master_data/slider/edit
	*
	*/
	public function edit($id)
	{
		$this->form_validation->set_rules('gambar', 'Gambar', 'trim');

		if ($this->form_validation->run() == false) {
			$id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
			$data['Pengguna'] = $id_admin;
			$data['Slider'] = $this->db->get_where('slider', ['id_slider' => $id])->row();
			$this->load->view('master_data/slider/edit', $data);
		} else {
			$slider = $this->db->get_where('slider', ['id_slider' => $id])->row();
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
			$config['max_size'] = '1024';
			$config['upload_path'] = './uploads/slider';
			$config['encrypt_name'] = TRUE;
			$gambar = $slider->gambar;
			$this->load->library('upload', $config);
			if (!empty($_FILES['gambar']['name'])) {
				if ($this->upload->do_upload('gambar')) {
					$gambar = $this->upload->data();
					$gambar = "uploads/slider/" . $gambar['file_name'];
				}
			}
			$arr = [
				'gambar' => $gambar,
				'aktif' => $this->input->post('status'),
				'edited_at' => date('Y-m-d H:i:s'),
			];
			if ($this->models->update($arr, $id, 'id_slider', 'slider')) {
				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil mengubah data slider
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>'
				);
				redirect('master_data/Slider');
			} else {
				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-danger mb-3" role="alert">Gagal mengubah data slider
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>'
				);
				redirect('master_data/Slider');
			}
		}
	}

	/* FUNCTION HAPUS SLIDER
	* ----------------------------------------
	*
	*/
	public function delete()
	{
		$id = $_POST['id'];
		$this->db->where('id_slider', $id);
		$this->db->delete('slider');
		$this->session->set_flashdata(
			'message',
			'<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil menghapus data slider
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		</div>'
		);
		redirect('master_data/Slider');
	}
}
