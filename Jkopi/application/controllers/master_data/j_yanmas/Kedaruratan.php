<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kedaruratan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'models');
        notLogin();
    }

    /* INDEX KEDARURATAN
	* ----------------------------------------
	* View: master_data/j_yanmas/kedaruratan/data
	*
	*/
    public function index()
    {
        $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
        $data['Pengguna'] = $id_admin;

        $this->load->view('master_data/j_yanmas/kedaruratan/data', $data);
    }

    /* FUNCTION GET ALL DATA KEDARURATAN
	* ----------------------------------------
	*
	*/
    public function getAllData()
    {
        $data = $this->db->order_by('created_at', 'DESC')->get('kedaruratan')->result_array();
        echo json_encode($data);
    }

    /* INDEX TAMBAH KEDARURATAN
	* ----------------------------------------
	* View: master_data/j_yanmas/kedaruratan/tambah
	*
	*/
    public function tambah()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Nama dinas kosong, mohon isi terlebih dahulu',
        ]);
        $this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'required|trim', [
            'required' => 'Nomor telepon dinas kosong, mohon isi terlebih dahulu',
        ]);

        if ($this->form_validation->run() == false) {
            $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
            $data['Pengguna'] = $id_admin;

            $this->load->view('master_data/j_yanmas/kedaruratan/tambah', $data);
        } else {
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = '1024';
            $config['upload_path'] = './uploads/kedaruratan';
            $config['encrypt_name'] = TRUE;
            $logo = "";
            $this->load->library('upload', $config);
            if (!empty($_FILES['logo']['name'])) {
                if ($this->upload->do_upload('logo')) {
                    $logo = $this->upload->data();
                    $logo = "uploads/kedaruratan/" . $logo['file_name'];
                } else {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-danger mb-3" role="alert">' . $this->upload->display_errors() .
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>'
                    );
                    redirect('master_data/j_yanmas/Kedaruratan');
                }
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger mb-3" role="alert">Gambar Belum Dipilih<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>'
                );
                redirect('master_data/j_yanmas/Kedaruratan');
            }
            $arr = [
                'id_kedaruratan' => $this->models->randomkode(10),
                'nama' => $this->input->post('nama'),
                'no_telp' => $this->input->post('no_telp'),
                'logo' => $logo,
                'status' => 'aktif',
                'created_at' => date('Y-m-d H:i:s'),
                'edited_at' => date('Y-m-d H:i:s'),
            ];
            if ($this->models->insert('kedaruratan', $arr)) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil menambahkan data kedaruratan
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>'
                );
                redirect('master_data/j_yanmas/Kedaruratan');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger mb-3" role="alert">Gagal menambahkan data kedaruratan
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>'
                );
                redirect('master_data/j_yanmas/Kedaruratan');
            }
        }
    }

    /* INDEX EDIT KEDARURATAN
	* ----------------------------------------
	* View: master_data/j_yanmas/kedaruratan/edit
	*
	*/
    public function edit($id)
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Nama dinas kosong, mohon isi terlebih dahulu',
        ]);
        $this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'required|trim', [
            'required' => 'Nomor telepon dinas kosong, mohon isi terlebih dahulu',
        ]);

        if ($this->form_validation->run() == false) {
            $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
            $data['Pengguna'] = $id_admin;
            $data['Kedaruratan'] = $this->db->get_where('kedaruratan', ['id_kedaruratan' => $id])->row();
            $this->load->view('master_data/j_yanmas/kedaruratan/edit', $data);
        } else {
            $kedaruratan = $this->db->get_where('kedaruratan', ['id_kedaruratan' => $id])->row();
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = '1024';
            $config['upload_path'] = './uploads/kedaruratan';
            $config['encrypt_name'] = TRUE;
            $logo = $kedaruratan->logo;
            $this->load->library('upload', $config);
            if (!empty($_FILES['logo']['name'])) {
                if ($this->upload->do_upload('logo')) {
                    $logo = $this->upload->data();
                    $logo = "uploads/kedaruratan/" . $logo['file_name'];
                }
            }
            $arr = [
                'nama' => $this->input->post('nama'),
                'no_telp' => $this->input->post('no_telp'),
                'logo' => $logo,
                'status' => $this->input->post('status'),
                'edited_at' => date('Y-m-d H:i:s'),
            ];
            if ($this->models->update($arr, $id, 'id_kedaruratan', 'kedaruratan')) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil mengubah data kedaruratan
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>'
                );
                redirect('master_data/j_yanmas/Kedaruratan');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger mb-3" role="alert">Gagal mengubah data kedaruratan
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>'
                );
                redirect('master_data/j_yanmas/Kedaruratan');
            }
        }
    }

    /* FUNCTION HAPUS KEDARURATAN
	* ----------------------------------------
	*
	*/
    public function delete()
    {
        $id = $_POST['id'];
        $this->db->where('id_kedaruratan', $id);
        $this->db->delete('kedaruratan');
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil menghapus data kedaruratan
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		</div>'
        );
        redirect('master_data/j_yanmas/Kedaruratan');
    }
}
