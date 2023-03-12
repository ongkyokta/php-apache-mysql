<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JEvent extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'models');
        notLogin();
    }

    /* INDEX JEVENT
	* ----------------------------------------
	* View: master_data/j_event/data
	*
	*/
    public function index()
    {
        $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
        $data['Pengguna'] = $id_admin;

        $this->load->view('master_data/j_event/data', $data);
    }

    /* FUNCTION GET ALL DATA JEVENT
	* ----------------------------------------
	*
	*/
    public function getAllData()
    {
        $data = $this->db->order_by('created_at', 'DESC')->get_where('berita', ['tipe' => 'acara'])->result_array();
        echo json_encode($data);
    }

    /* INDEX TAMBAH JEVENT
	* ----------------------------------------
	* View: master_data/j_event/tambah
	*
	*/
    public function tambah()
    {
        $this->form_validation->set_rules('judul', 'Judul', 'required|trim', [
            'required' => 'Judul event kosong, mohon isi terlebih dahulu',
        ]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim', [
            'required' => 'Deskripsi event kosong, mohon isi terlebih dahulu',
        ]);

        if ($this->form_validation->run() == false) {
            $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
            $data['Pengguna'] = $id_admin;

            $this->load->view('master_data/j_event/tambah', $data);
        } else {
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = '1024';
            $config['upload_path'] = './uploads/berita';
            $config['encrypt_name'] = TRUE;
            $gambar = "";
            $this->load->library('upload', $config);
            if (!empty($_FILES['gambar']['name'])) {
                if ($this->upload->do_upload('gambar')) {
                    $gambar = $this->upload->data();
                    $gambar = "uploads/berita/" . $gambar['file_name'];
                } else {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-danger mb-3" role="alert">' . $this->upload->display_errors() .
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>'
                    );
                    redirect('master_data/JEvent');
                }
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger mb-3" role="alert">Gambar Belum Dipilih<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>'
                );
                redirect('master_data/JEvent');
            }
            $arr = [
                'id_berita' => $this->models->randomkode(10),
                'judul_berita' => $this->input->post('judul'),
                'deskripsi' => $this->input->post('deskripsi'),
                'gambar' => $gambar,
                'tipe' => 'acara',
                'aktif' => 'aktif',
                'created_at' => date('Y-m-d H:i:s'),
                'edited_at' => date('Y-m-d H:i:s'),
            ];
            if ($this->models->insert('berita', $arr)) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil menambahkan data event
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>'
                );
                redirect('master_data/JEvent');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger mb-3" role="alert">Gagal menambahkan data event
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>'
                );
                redirect('master_data/JEvent');
            }
        }
    }

    /* INDEX EDIT JEVENT
	* ----------------------------------------
	* View: master_data/j_event/edit
	*
	*/
    public function edit($id)
    {
        $this->form_validation->set_rules('judul', 'Judul Event', 'required|trim', [
            'required' => 'Judul event kosong, mohon isi terlebih dahulu',
        ]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Event', 'required|trim', [
            'required' => 'Deskripsi event kosong, mohon isi terlebih dahulu',
        ]);

        if ($this->form_validation->run() == false) {
            $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
            $data['Pengguna'] = $id_admin;
            $data['JEvent'] = $this->db->get_where('berita', ['id_berita' => $id])->row();
            $this->load->view('master_data/j_event/edit', $data);
        } else {
            $berita = $this->db->get_where('berita', ['id_berita' => $id])->row();
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = '1024';
            $config['upload_path'] = './uploads/berita';
            $config['encrypt_name'] = TRUE;
            $gambar = $berita->gambar;
            $this->load->library('upload', $config);
            if (!empty($_FILES['gambar']['name'])) {
                if ($this->upload->do_upload('gambar')) {
                    $gambar = $this->upload->data();
                    $gambar = "uploads/berita/" . $gambar['file_name'];
                }
            }
            $arr = [
                'judul_berita' => $this->input->post('judul'),
                'deskripsi' => $this->input->post('deskripsi'),
                'gambar' => $gambar,
                'aktif' => $this->input->post('status'),
                'edited_at' => date('Y-m-d H:i:s'),
            ];
            if ($this->models->update($arr, $id, 'id_berita', 'berita')) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil mengubah data event
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>'
                );
                redirect('master_data/JEvent');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger mb-3" role="alert">Gagal mengubah data event
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>'
                );
                redirect('master_data/JEvent');
            }
        }
    }

    /* FUNCTION HAPUS JEVENT
	* ----------------------------------------
	*
	*/
    public function delete()
    {
        $id = $_POST['id'];
        $this->db->where('id_berita', $id);
        $this->db->delete('berita');
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil menghapus data event
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		</div>'
        );
        redirect('master_data/JEvent');
    }
}
