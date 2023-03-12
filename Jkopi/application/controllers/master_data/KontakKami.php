<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KontakKami extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'models');
        notLogin();
    }


    /* FUNCTION INDEX KONTAK KAMI
	* ----------------------------------------
	* View: master_data/kontak_kami/data
	*
	*/
    public function index()
    {
        $this->form_validation->set_rules('alamat', 'Alamat', 'required', [
            'required' => 'Alamat kosong, mohon isi terlebih dahulu',
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required', [
            'required' => 'Email kosong, mohon isi terlebih dahulu',
        ]);
        $this->form_validation->set_rules('telepon', 'Telepon', 'required', [
            'required' => 'Nomor telepon kosong, mohon isi terlebih dahulu',
        ]);
        if ($this->form_validation->run() == false) {
            $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
            $data['Pengguna'] = $id_admin;
            $data['kontak'] = $this->db->get_where('kontak_kami', ['id_kontak' => 1])->row();

            $this->load->view('master_data/kontak_kami/data', $data);
        } else {
            $arr = [
                'alamat' => $this->input->post('alamat'),
                'email' => $this->input->post('email'),
                'id_kecamatan' => $this->input->post('kecamatan'),
                'id_kelurahan' => $this->input->post('kelurahan'),
                'no_telp' => $this->input->post('telepon'),
                'edited_at' => date('Y-m-d H:i:s'),
            ];
            if ($this->models->update($arr, 1, 'id_kontak', 'kontak_kami')) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil mengubah data kontak kami
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>'
                );
                redirect('master_data/KontakKami');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger mb-3" role="alert">Gagal mengubah data kontak kami
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>'
                );
                redirect('master_data/KontakKami');
            }
        }
    }

    /* FUNCTION GET ALL DATA OPD
	* ----------------------------------------
	*
	*/
    public function getAllData()
    {
        $data = $this->db->query(" SELECT * FROM kontak_kami kk
        INNER JOIN kecamatan kc ON kk.id_kecamatan = kc.id_kecamatan
        INNER JOIN kelurahan kl ON kk.id_kelurahan = kl.id_kelurahan
        WHERE kk.id_kontak = 1")->result();
        echo json_encode($data);
    }
}
