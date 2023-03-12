<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FasilitasUmum extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'models');
        notLogin();
    }

    /* INDEX FASILITAS UMUM
	* ----------------------------------------
	* View: menu_informasi/fasilitas_umum/data
	*
	*/
    public function index()
    {
        $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
        $data['Pengguna'] = $id_admin;
        $this->load->view('menu_informasi/fasilitas_umum/data', $data);
    }

    /* FUNCTION GET ALL DATA FASILITAS UMUM
	* ----------------------------------------
	*
	*/
    public function getAllData()
    {
        $data = $this->db->query("SELECT * FROM fasilitas_umum f
        INNER JOIN kategori_fasilitas kf ON f.id_kategori = kf.id_kategori
        INNER JOIN kecamatan kc ON f.id_kecamatan = kc.id_kecamatan
        INNER JOIN kelurahan kl ON f.id_kelurahan = kl.id_kelurahan
        ORDER BY f.created_at DESC")->result_array();
        echo json_encode($data);
    }

    /* INDEX TAMBAH FASILITAS UMUM
	* ----------------------------------------
	* View: menu_informasi/fasilitas_umum/tambah
	*
	*/
    public function tambah()
    {
        $this->form_validation->set_rules('nama_fasilitas', 'Nama Fasilitas', 'required|trim', [
            'required' => 'Nama fasilitas umum kosong, mohon isi terlebih dahulu',
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
            'required' => 'Alamat kosong, mohon isi terlebih dahulu',
        ]);
        $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required|trim');
        $this->form_validation->set_rules('kelurahan', 'Kelurahan', 'required|trim');
        $this->form_validation->set_rules('latlong', 'LatLong', 'required|trim');

        if ($this->form_validation->run() == false) {
            $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
            $data['Pengguna'] = $id_admin;

            $this->load->view('menu_informasi/fasilitas_umum/tambah', $data);
        } else {
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = '1024';
            $config['upload_path'] = './uploads/fasilitas_umum';
            $config['encrypt_name'] = TRUE;
            $gambar = "";
            $this->load->library('upload', $config);
            if (!empty($_FILES['gambar']['name'])) {
                if ($this->upload->do_upload('gambar')) {
                    $gambar = $this->upload->data();
                    $gambar = "uploads/fasilitas_umum/" . $gambar['file_name'];
                } else {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-danger mb-3" role="alert">' . $this->upload->display_errors() .
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>'
                    );
                    redirect('menu_informasi/FasilitasUmum');
                }
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger mb-3" role="alert">Gambar belum dipilih<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>'
                );
                redirect('menu_informasi/FasilitasUmum');
            }
            $latlong = $this->input->post('latlong');
            $latlongsplit = explode(", ", $latlong);
            $arr = [
                'id_fasilitas' => $this->models->randomkode(10),
                'nama_fasilitas' => $this->input->post('nama_fasilitas'),
                'alamat' => $this->input->post('alamat'),
                'id_kecamatan' => $this->input->post('kecamatan'),
                'id_kelurahan' => $this->input->post('kelurahan'),
                'no_telp' => $this->input->post('no_telp'),
                'latitude' => $latlongsplit[0],
                'longitude' => $latlongsplit[1],
                'id_kategori' => $this->input->post('kategori'),
                'gambar' => $gambar,
                'deskripsi' => $this->input->post('deskripsi'),
                'status' => 'aktif',
                'created_at' => date('Y-m-d H:i:s'),
                'edited_at' => date('Y-m-d H:i:s'),
            ];
            if ($this->models->insert('fasilitas_umum', $arr)) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil menambahkan data fasilitas umum</div>'
                );
                redirect('menu_informasi/FasilitasUmum');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger mb-3 mt-3" role="alert">Gagal menambahkan data fasilitas umum</div>'
                );
                redirect('menu_informasi/FasilitasUmum');
            }
        }
    }

    /* INDEX EDIT FASILITAS UMUM
	* ----------------------------------------
	* View: menu_informasi/fasilitas_umum/edit
	*
	*/
    public function edit($id)
    {
        $this->form_validation->set_rules('nama_fasilitas', 'Nama Fasilitas', 'required|trim', [
            'required' => 'Nama fasilitas umum kosong, mohon isi terlebih dahulu',
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
            'required' => 'Alamat  kosong, mohon isi terlebih dahulu',
        ]);

        if ($this->form_validation->run() == false) {
            $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
            $data['Pengguna'] = $id_admin;
            $data['Fasilitas'] = $this->db->get_where('fasilitas_umum', ['id_fasilitas' => $id])->row();
            $this->load->view('menu_informasi/fasilitas_umum/edit', $data);
        } else {
            $fasilitas_umum = $this->db->get_where('fasilitas_umum', ['id_fasilitas' => $id])->row();
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = '1024';
            $config['upload_path'] = './uploads/fasilitas_umum';
            $config['encrypt_name'] = TRUE;
            $gambar = $fasilitas_umum->gambar;
            $this->load->library('upload', $config);
            if (!empty($_FILES['gambar']['name'])) {
                if ($this->upload->do_upload('gambar')) {
                    $gambar = $this->upload->data();
                    $gambar = "uploads/fasilitas_umum/" . $gambar['file_name'];
                } else {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-danger mb-3" role="alert">' . $this->upload->display_errors() .
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>'
                    );
                    redirect('menu_informasi/FasilitasUmum');
                }
            }
            $latlong = $this->input->post('latlong');
            $latlongsplit = explode(", ", $latlong);
            $arr = [
                'nama_fasilitas' => $this->input->post('nama_fasilitas'),
                'alamat' => $this->input->post('alamat'),
                'no_telp' => $this->input->post('no_telp'),
                'id_kecamatan' => $this->input->post('kecamatan'),
                'id_kelurahan' => $this->input->post('kelurahan'),
                'latitude' => $latlongsplit[0],
                'longitude' => $latlongsplit[1],
                'id_kategori' => $this->input->post('kategori'),
                'gambar' => $gambar,
                'deskripsi' => $this->input->post('deskripsi'),
                'status' => $this->input->post('status'),
                'edited_at' => date('Y-m-d H:i:s'),
            ];
            if ($this->models->update($arr, $id, 'id_fasilitas', 'fasilitas_umum')) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil mengubah data fasilitas umum</div>'
                );
                redirect('menu_informasi/FasilitasUmum');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger mb-3 mt-3" role="alert">Gagal mengubah data fasilitas umum</div>'
                );
                redirect('menu_informasi/FasilitasUmum');
            }
        }
    }

    /* FUNCTION HAPUS FASILITAS UMUM
        * ----------------------------------------
        *
        */
    public function delete()
    {
        $id = $_POST['id'];
        $this->db->where('id_fasilitas', $id);
        $this->db->delete('fasilitas_umum');
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil menghapus data fasilitas umum
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>'
        );
        redirect('menu_informasi/FasilitasUmum');
    }

    /* FUNCTION GET DATA KECAMATAN KELURAHAN
    * ----------------------------------------
    *
    */
    public function data_kecamatan_kelurahan()
    {
        $id = $this->input->post('id_fasilitas');
        $data = $this->db->query("SELECT * FROM fasilitas_umum f
            INNER JOIN kecamatan kc ON f.id_kecamatan = kc.id_kecamatan
            INNER JOIN kelurahan kl ON f.id_kelurahan = kl.id_kelurahan
            WHERE f.id_fasilitas = '$id'")->result();
        echo json_encode($data);
    }

    /* FUNCTION GET DATA KATEGORI FASILITAS UMUM
	* ----------------------------------------
	*
	*/
    public function getKategori()
    {
        $query = $this->db->query("SELECT * FROM kategori_fasilitas")->result();
        echo json_encode($query);
    }

    /* FUNCTION GET DATA KATEGORI FASILITAS UMUM
	* ----------------------------------------
	*
	*/
    public function get_kategori()
    {
        $data = $this->db->query("SELECT * FROM kategori_fasilitas")->result();
        echo json_encode($data);
    }

    /* FUNCTION GET DATA KATEGORI FASILITAS UMUM
	* ----------------------------------------
	*
	*/
    public function data_kategori()
    {
        $id = $this->input->post('id_fasilitas');
        $query = $this->db->query("SELECT * FROM fasilitas_umum f
            INNER JOIN kategori_fasilitas kf ON f.id_kategori = kf.id_kategori
            WHERE f.id_fasilitas = '$id'")->result();
        echo json_encode($query);
    }
}
