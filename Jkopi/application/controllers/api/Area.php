<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Area extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('Response');
        $this->load->helper('Tracking', 'tracking');
        $this->load->model('Models', 'models');
    }

    /* GET KECAMATAN
	* ----------------------------------------
	*/
    public function kecamatan()
    {
        $kecamatan = $this->db->query('SELECT id_kecamatan, nama_kecamatan FROM kecamatan')->result_array();
        $data['meta'] = custom_response(200, "Success");
        $data['response'] = [
            'message' =>  'Berhasil mengambil data kecamatan',
            'data' => $kecamatan
        ];
        echo json_encode($data);
    }

    /* GET KELURAHAN
	* ----------------------------------------
	*/
    public function kelurahan()
    {
        $id = $this->input->get('id_kecamatan');
        $kelurahan = $this->db->query("SELECT id_kelurahan, nama_kelurahan FROM kelurahan WHERE id_kecamatan = '$id'")->result_array();
        $data['meta'] = custom_response(200, "Success");
        $data['response'] = [
            'message' =>  'Berhasil mengambil data kelurahan',
            'data' => $kelurahan
        ];
        echo json_encode($data);
    }
    public function test()
    {
        $hostValueInHeader = $this->input->request_headers();
        $data['response'] = [
            'message' =>  'Berhasil mengambil data kelurahan',
            'data' => $hostValueInHeader['Authorization']
        ];
        echo json_encode($data);
    }
}
