<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JDer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'models');
        notLogin();
    }

    /* INDEX JDER
	* ----------------------------------------
	* View: master_data/j_der/data
	*
	*/
    public function index()
    {
        $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
        $data['Pengguna'] = $id_admin;

        $this->load->view('master_data/j_der/data', $data);
    }

    /* FUNCTION GET ALL DATA JDER
	* ----------------------------------------
	*
	*/
    public function getAllData()
    {
        $data = $this->db->order_by('created_at', 'DESC')->get_where('aplikasi', ['kategori' => 'jder'])->result_array();
        echo json_encode($data);
    }

    /* INDEX TAMBAH JDER
	* ----------------------------------------
	* View: master_data/j_der/tambah
	*
	*/
    public function tambah()
    {
        $this->form_validation->set_rules('nama_aplikasi', 'Nama Aplikasi', 'required|trim', [
            'required' => 'Nama aplikasi kosong, mohon isi terlebih dahulu',
        ]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim', [
            'required' => 'Deskripsi aplikasi kosong, mohon isi terlebih dahulu',
        ]);

        if ($this->form_validation->run() == false) {
            $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
            $data['Pengguna'] = $id_admin;

            $this->load->view('master_data/j_der/tambah', $data);
        } else {
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = '1024';
            $config['upload_path'] = './uploads/aplikasi';
            $config['encrypt_name'] = TRUE;
            $gambar = "";
            $this->load->library('upload', $config);
            if (!empty($_FILES['gambar']['name'])) {
                if ($this->upload->do_upload('gambar')) {
                    $gambar = $this->upload->data();
                    $gambar = "uploads/aplikasi/" . $gambar['file_name'];
                } else {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-danger mb-3" role="alert">' . $this->upload->display_errors() .
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>'
                    );
                    redirect('master_data/JDer');
                }
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger mb-3" role="alert">Gambar Belum Dipilih<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>'
                );
                redirect('master_data/JDer');
            }
            $arr = [
                'id_aplikasi' => $this->models->randomkode(10),
                'nama_aplikasi' => $this->input->post('nama_aplikasi'),
                'url' => $this->input->post('url'),
                'deskripsi' => $this->input->post('deskripsi'),
                'gambar' => $gambar,
                'kategori' => 'jder',
                'tipe' => $this->input->post('tipe'),
                'status' => 'aktif',
                'created_at' => date('Y-m-d H:i:s'),
                'edited_at' => date('Y-m-d H:i:s'),
            ];
            if ($this->models->insert('aplikasi', $arr)) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil menambahkan data Aplikasi Jember Digital Entrepreneur
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>'
                );
                redirect('master_data/JDer');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger mb-3" role="alert">Gagal menambahkan data Aplikasi Jember Digital Entrepreneur
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>'
                );
                redirect('master_data/JDer');
            }
        }
    }

    /* INDEX EDIT JDER
	* ----------------------------------------
	* View: master_data/j_der/edit
	*
	*/
    public function edit($id)
    {
        $this->form_validation->set_rules('nama_aplikasi', 'Nama Aplikasi', 'required|trim', [
            'required' => 'Nama aplikasi kosong, mohon isi terlebih dahulu',
        ]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim', [
            'required' => 'Deskripsi aplikasi kosong, mohon isi terlebih dahulu',
        ]);

        if ($this->form_validation->run() == false) {
            $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
            $data['Pengguna'] = $id_admin;
            $data['JDer'] = $this->db->get_where('aplikasi', ['id_aplikasi' => $id])->row();
            $this->load->view('master_data/j_der/edit', $data);
        } else {
            $aplikasi = $this->db->get_where('aplikasi', ['id_aplikasi' => $id])->row();
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = '1024';
            $config['upload_path'] = './uploads/aplikasi';
            $config['encrypt_name'] = TRUE;
            $gambar = $aplikasi->gambar;
            $this->load->library('upload', $config);
            if (!empty($_FILES['gambar']['name'])) {
                if ($this->upload->do_upload('gambar')) {
                    $gambar = $this->upload->data();
                    $gambar = "uploads/aplikasi/" . $gambar['file_name'];
                }
            }
            $arr = [
                'nama_aplikasi' => $this->input->post('nama_aplikasi'),
                'url' => $this->input->post('url'),
                'deskripsi' => $this->input->post('deskripsi'),
                'gambar' =>    $gambar,
                'tipe' => $this->input->post('tipe'),
                'status' =>    $this->input->post('status'),
                'edited_at' => date('Y-m-d H:i:s'),
            ];
            if ($this->models->update($arr, $id, 'id_aplikasi', 'aplikasi')) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil mengubah data Aplikasi Jember Digital Entrepreneur
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>'
                );
                redirect('master_data/JDer');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger mb-3" role="alert">Gagal mengubah data Aplikasi Jember Digital Entrepreneur
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>'
                );
                redirect('master_data/JDer');
            }
        }
    }

    /* FUNCTION HAPUS JDER
	* ----------------------------------------
	*
	*/
    public function delete()
    {
        $id = $_POST['id'];
        $this->db->where('id_aplikasi', $id);
        $this->db->delete('aplikasi');
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil menghapus data Aplikasi Jember Digital Entrepreneur
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		</div>'
        );
        redirect('master_data/JDer');
    }
}
