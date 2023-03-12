<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KategoriFasilitasUmum extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'models');
        notLogin();
    }


    /* FUNCTION INDEX KATEGORI FASILITAS UMUM
	* ----------------------------------------
	* View: menu_informasi/kategori_fasilitas_umum/data
	*
	*/
    public function index()
    {
        $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
        $data['Pengguna'] = $id_admin;

        $this->load->view('menu_informasi/kategori_fasilitas_umum/data', $data);
    }

    /* FUNCTION GET ALL DATA KATEGORI FASILITAS UMUM
	* ----------------------------------------
	*
	*/
    public function getAllData()
    {
        $data = $this->db->order_by('created_at', 'DESC')->get('kategori_fasilitas')->result_array();
        echo json_encode($data);
    }

    /* FUNCTION TAMBAH KATEGORI FASILITAS UMUM
	* ----------------------------------------
	* View: menu_informasi/kategori_fasilitas_umum/tambah
	*
	*/
    public function tambah()
    {
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|trim|max_length[128]');
        if ($this->form_validation->run() == false) {
            $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
            $data['Pengguna'] = $id_admin;

            $this->load->view('menu_informasi/kategori_fasilitas_umum/tambah', $data);
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
                    redirect('menu_informasi/KategoriFasilitasUmum');
                }
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger mb-3" role="alert">Gambar belum dipilih<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>'
                );
                redirect('menu_informasi/KategoriFasilitasUmum');
            }
            $data_array = [
                'nama_kategori' => $this->input->post('nama_kategori'),
                'gambar' => $gambar,
                'created_at' => date('Y-m-d H:i:s'),
                'edited_at' => date('Y-m-d H:i:s'),
            ];
            if ($this->models->insert('kategori_fasilitas', $data_array)) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success mb-3" role="alert">Berhasil menambah kategori fasilitas umum
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>'
                );
                redirect('menu_informasi/KategoriFasilitasUmum');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger mb-3" role="alert">Gagal menambah kategori fasilitas umum
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>'
                );
                redirect('menu_informasi/KategoriFasilitasUmum');
            }
        }
    }

    /* FUNCTION EDIT KATEGORI FASILITAS UMUM
	* ----------------------------------------
	* View: menu_informasi/kategori_fasilitas_umum/edit
	*
	*/
    public function edit($id)
    {
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|trim|max_length[128]');
        if ($this->form_validation->run() == false) {
            $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
            $data['Pengguna'] = $id_admin;
            $data['Kategori'] = $this->db->get_where('kategori_fasilitas', ['id_kategori' => $id])->row();
            $this->load->view('menu_informasi/kategori_fasilitas_umum/edit', $data);
        } else {
            $kategori = $this->db->get_where('kategori_fasilitas', ['id_kategori' => $id])->row();
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = '1024';
            $config['upload_path'] = './uploads/fasilitas_umum';
            $config['encrypt_name'] = TRUE;
            $gambar = $kategori->gambar;
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
            $arr = [
                'nama_kategori' => $this->input->post('nama_kategori'),
                'gambar' => $gambar,
                'edited_at' => date('Y-m-d H:i:s'),
            ];
            $update = $this->models->update($arr, $id, 'id_kategori', 'kategori_fasilitas');
            if ($update) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success mb-3" role="alert">Berhasil mengubah data kategori fasilitas umum
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>'
                );
                redirect('menu_informasi/KategoriFasilitasUmum');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger mb-3" role="alert">Gagal mengubah data kategori fasilitas umum
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>'
                );
                redirect('menu_informasi/KategoriFasilitasUmum');
            }
        }
    }

    /* FUNCTION HAPUS KATEGORI FASILITAS UMUM
	* ----------------------------------------
	*
	*/
    public function delete()
    {
        $id = $_POST['id'];
        // $this->db->where('id_kategori', $id);
        // $this->db->delete('kategori_fasilitas');

        $delete_data = $this->models->hapus($id, 'id_kategori', 'kategori_fasilitas');
        $alter_table = $this->db->query("ALTER TABLE kategori_fasilitas AUTO_INCREMENT = 1");

        if ($delete_data && $alter_table) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success mb-3" role="alert">Berhasil menghapus data kategori fasilitas umum
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>'
            );
            redirect('menu_informasi/KategoriFasilitasUmum');
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger mb-3" role="alert">Gagal menghapus data kategori fasilitas umum
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>'
            );
            redirect('menu_informasi/KategoriFasilitasUmum');
        }
    }
}
