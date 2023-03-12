<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OPD extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'models');
        notLogin();
    }

    /* INDEX OPD
	* ----------------------------------------
	* View: master_data/opd/data
	*
	*/
    public function index()
    {
        $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
        $data['Pengguna'] = $id_admin;
        $this->load->view('master_data/opd/data', $data);
    }

    /* FUNCTION GET ALL DATA OPD
	* ----------------------------------------
	*
	*/
    public function getAllData()
    {
        // $data = $this->db->order_by('created_at', 'DESC')->get('opd')->result_array();
        $data = $this->db->query("SELECT * FROM opd o
        INNER JOIN kecamatan kc ON o.id_kecamatan = kc.id_kecamatan
        INNER JOIN kelurahan kl ON o.id_kelurahan = kl.id_kelurahan
        ORDER BY o.created_at DESC")->result_array();
        echo json_encode($data);
    }

    /* INDEX TAMBAH OPD
	* ----------------------------------------
	* View: master_data/opd/tambah
	*
	*/
    public function tambah()
    {
        $this->form_validation->set_rules(
            'nama_opd',
            'Nama OPD',
            'required|trim',
            [
                'required' => 'Nama OPD kosong, mohon isi terlebih dahulu',
            ]
        );
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
            'required' => 'Alamat OPD kosong, mohon isi terlebih dahulu',
        ]);
        $this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'required|trim', [
            'required' => 'Nomor telepon OPD kosong, mohon isi terlebih dahulu',
        ]);
        $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required|trim');
        $this->form_validation->set_rules('kelurahan', 'Kelurahan', 'required|trim');
        $this->form_validation->set_rules('latlong', 'LatLong', 'required|trim');

        if ($this->form_validation->run() == false) {
            $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
            $data['Pengguna'] = $id_admin;
            // $data['Notif'] = $this->models->listnotif();
            // $data['notifikasi'] = $this->models->notifikasi();
            $this->load->view('master_data/opd/tambah', $data);
        } else {
            $latlong = $this->input->post('latlong');
            $latlongsplit = explode(", ", $latlong);
            $arr = [
                'id_opd' => $this->models->randomkode(10),
                'nama_opd' => $this->input->post('nama_opd'),
                'alamat' => $this->input->post('alamat'),
                'no_telp' => $this->input->post('no_telp'),
                'id_kecamatan' => $this->input->post('kecamatan'),
                'id_kelurahan' => $this->input->post('kelurahan'),
                'latitude' => $latlongsplit[0],
                'longitude' => $latlongsplit[1],
                'status' => 'aktif',
                'created_at' => date('Y-m-d H:i:s'),
                'edited_at' => date('Y-m-d H:i:s'),
            ];

            $insert = $this->db->insert('opd', $arr);
            if ($insert) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil menambahkan data OPD baru</div>'
                );
                redirect('master_data/OPD');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger mb-3 mt-3" role="alert">Gagal menambahkan data OPD baru</div>'
                );
                redirect('master_data/OPD');
            }
        }
    }

    /* INDEX EDIT OPD
	* ----------------------------------------
	* View: master_data/opd/edit
	*
	*/
    public function edit($id)
    {
        $this->form_validation->set_rules('nama_opd', 'Nama OPD', 'required|trim', [
            'required' => 'Nama OPD kosong, mohon isi terlebih dahulu',
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
            'required' => 'Alamat OPD kosong, mohon isi terlebih dahulu',
        ]);
        $this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'required|trim', [
            'required' => 'Nomor telepon OPD kosong, mohon isi terlebih dahulu',
        ]);
        $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required');
        $this->form_validation->set_rules('kelurahan', 'Kelurahan', 'required');
        $this->form_validation->set_rules('latlong', 'LatLong', 'required|trim');

        if ($this->form_validation->run() == false) {
            $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
            $data['Pengguna'] = $id_admin;
            $data['OPD'] = $this->db->get_where('opd', ['id_opd' => $id])->row();
            // $data['Notif'] = $this->models->listnotif();
            // $data['notifikasi'] = $this->models->notifikasi();
            $this->load->view('master_data/opd/edit', $data);
        } else {
            $latlong = $this->input->post('latlong');
            $latlongsplit = explode(", ", $latlong);
            $arr = [
                'nama_opd' => $this->input->post('nama_opd'),
                'alamat' => $this->input->post('alamat'),
                'no_telp' => $this->input->post('no_telp'),
                'id_kecamatan' => $this->input->post('kecamatan'),
                'id_kelurahan' => $this->input->post('kelurahan'),
                'latitude' => $latlongsplit[0],
                'longitude' => $latlongsplit[1],
                'status' => $this->input->post('status'),
                'edited_at' => date('Y-m-d H:i:s'),
            ];

            $insert = $this->models->update($arr, $id, 'id_opd', 'opd');
            if ($insert) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil mengubah data OPD</div>'
                );
                redirect('master_data/OPD');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger mb-3 mt-3" role="alert">Gagal mengubah data OPD</div>'
                );
                redirect('master_data/OPD');
            }
        }
    }

    /* FUNCTION HAPUS OPD
	* ----------------------------------------
	*
	*/
    public function delete()
    {
        $id = $_POST['id'];
        $this->db->where('id_opd', $id);
        $this->db->delete('opd');
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil menghapus data OPD
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		</div>'
        );
        redirect('master_data/OPD');
    }

    /* FUNCTION GET DATA KECAMATAN KELURAHAN
    * ----------------------------------------
    *
    */
    public function data_kecamatan_kelurahan()
    {
        $id = $this->input->post('id_opd');
        $data = $this->db->query("SELECT * FROM opd o
            INNER JOIN kecamatan kc ON o.id_kecamatan = kc.id_kecamatan
            INNER JOIN kelurahan kl ON o.id_kelurahan = kl.id_kelurahan
            WHERE o.id_opd = '$id'")->result();
        echo json_encode($data);
    }
}
