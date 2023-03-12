<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JNews extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'models');
        notLogin();
    }

    /* INDEX JNEWS
	* ----------------------------------------
	* View: master_data/j_news/data
	*
	*/
    public function index()
    {
        $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
        $data['Pengguna'] = $id_admin;

        $this->load->view('master_data/j_news/data', $data);
    }

    /* FUNCTION GET ALL DATA JNEWS
	* ----------------------------------------
	*
	*/
    public function getAllData()
    {
        $data = $this->db->order_by('created_at', 'DESC')->get_where('berita', ['tipe' => 'berita'])->result_array();
        echo json_encode($data);
    }

    /* INDEX TAMBAH JNEWS
	* ----------------------------------------
	* View: master_data/j_news/tambah
	*
	*/
    public function tambah()
    {
        $this->form_validation->set_rules('judul', 'Judul', 'required|trim', [
            'required' => 'Judul berita kosong, mohon isi terlebih dahulu',
        ]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim', [
            'required' => 'Deskripsi berita kosong, mohon isi terlebih dahulu',
        ]);

        if ($this->form_validation->run() == false) {
            $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
            $data['Pengguna'] = $id_admin;

            $this->load->view('master_data/j_news/tambah', $data);
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
                    redirect('master_data/JNews');
                }
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger mb-3" role="alert">Gambar Belum Dipilih<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>'
                );
                redirect('master_data/JNews');
            }
            $arr = [
                'id_berita' => $this->models->randomkode(10),
                'judul_berita' => $this->input->post('judul'),
                'deskripsi' => $this->input->post('deskripsi'),
                'gambar' => $gambar,
                'tipe' => 'berita',
                'aktif' => 'aktif',
                'created_at' => date('Y-m-d H:i:s'),
                'edited_at' => date('Y-m-d H:i:s'),
            ];
            if ($this->models->insert('berita', $arr)) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil menambahkan data berita
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>'
                );
                redirect('master_data/JNews');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger mb-3" role="alert">Gagal menambahkan data berita
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>'
                );
                redirect('master_data/JNews');
            }
        }
    }

    /* INDEX EDIT BERITA
	* ----------------------------------------
	* View: master_data/j_news/edit
	*
	*/
    public function edit($id)
    {
        $this->form_validation->set_rules('judul', 'Judul Berita', 'required|trim', [
            'required' => 'Judul berita kosong, mohon isi terlebih dahulu',
        ]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Berita', 'required|trim', [
            'required' => 'Deskripsi berita kosong, mohon isi terlebih dahulu',
        ]);

        if ($this->form_validation->run() == false) {
            $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
            $data['Pengguna'] = $id_admin;
            $data['JNews'] = $this->db->get_where('berita', ['id_berita' => $id])->row();
            $this->load->view('master_data/j_news/edit', $data);
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
                'gambar' =>    $gambar,
                'aktif' =>    $this->input->post('status'),
                'edited_at' => date('Y-m-d H:i:s'),
            ];
            if ($this->models->update($arr, $id, 'id_berita', 'berita')) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil mengubah data berita
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>'
                );
                redirect('master_data/JNews');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger mb-3" role="alert">Gagal mengubah data berita
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>'
                );
                redirect('master_data/JNews');
            }
        }
    }

    /* FUNCTION HAPUS JNEWS
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
            '<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil menghapus data berita
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		</div>'
        );
        redirect('master_data/JNews');
    }
}
