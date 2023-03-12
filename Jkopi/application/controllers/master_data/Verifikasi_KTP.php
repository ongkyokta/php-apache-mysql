<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Verifikasi_KTP extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Models', 'models');
    notLogin();
  }

  /* INDEX PENGGUNA
	* ----------------------------------------
	* View: master_data/pengguna/data
	*
	*/
  public function index()
  {
    $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
    $data['Pengguna'] = $id_admin;
    $this->load->view('master_data/verifikasi_ktp/data', $data);
  }

  /* FUNCTION GET ALL DATA PENGGUNA
	* ----------------------------------------
	*
	*/
  public function getAllData()
  {
    $data = $this->db->query("SELECT p.*, dp.foto_ktp, dp.id_detail
    FROM pengguna p
    LEFT JOIN detail_pengguna dp ON p.id_pengguna = dp.id_pengguna
    ORDER BY case when p.verif_ktp = '1' AND p.is_active = 'aktif' then 1
    when p.verif_ktp = '2' AND p.is_active = 'aktif' then 2
    when p.verif_ktp = '0' AND p.is_active = 'aktif' then 3
    else 4
    end ASC, p.created_at DESC")->result_array();
    echo json_encode($data);
  }
  /* DETAIL PENGGUNA
	* ----------------------------------------
	* View: master_data/pengguna/detail
	*
	*/
  public function detail($id)
  {
    $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
    $data['Pengguna'] = $id_admin;

    $data['User'] = $this->db->query("SELECT * FROM pengguna WHERE id_pengguna = '$id'")->row();
    $this->load->view('master_data/verifikasi_ktp/detail', $data);
  }
  public function statusread($id)
  {
    $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
    $data['Pengguna'] = $id_admin;

    $this->db->set('terbaca', 1);
    $this->db->where('id_notif', $id);
    $this->db->update('notif_web');

    $find = $this->db->get_where('notif_web', ['id_notif' => $id])->row();

    $data['User'] = $this->db->query("SELECT * FROM pengguna WHERE id_pengguna = '$find->konten'")->row();
    $this->load->view('master_data/verifikasi_ktp/detail', $data);
  }

  /* FUNCTION AKTIFKAN PENGGUNA
	* ----------------------------------------
	*
	*/
  public function aktifkan($id)
  {
    // $findDetailUser = $this->db->get_where('detail_pengguna', ['id_detail' => $id])->row();
    $findUser = $this->db->get_where('pengguna', ['id_pengguna' => $id])->row();
    //update pengguna tb
    $this->db->set('verif_ktp', 2);
    $this->db->where('id_pengguna',  $findUser->id_pengguna);
    $this->db->update('pengguna');
    // //update pengguna tb
    // $this->db->set('verif_status', 1);
    // $this->db->where('id_detail',  $id);
    // $this->db->update('detail_pengguna');
    // TODO : Insert DB
    $arr3 = [
      'id_user' =>    $findUser->id_pengguna,
      'id_konten' => $id,
      'judul' =>   'Verifikasi KTP',
      'deskripsi' => 'Verifikasi KTP Anda telah diterima',
      'type' => 'Verifikasi KTP',
      'created_at' => date('Y-m-d H:i:s'),
      'edited_at' => date('Y-m-d H:i:s'),
    ];
    $this->db->insert('notif_user', $arr3);
    $this->session->set_flashdata(
      'message',
      '<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil memverifikasi KTP</div>'
    );
    //TODO : send Notifikasi
    //send Notifikasi
    $this->sendNotification($findUser->token, 'Verifikasi KTP Anda telah diterima', 'Admin J-Kopi', $id, "KTP");
    $this->session->set_flashdata(
      'message',
      '<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil Terima Verifikasi Akun</div>'
    );

    redirect('master_data/Verifikasi_KTP');
  }

  public function nonaktifkan($id)
  {
    // $findDetailUser = $this->db->get_where('detail_pengguna', ['id_detail' => $id])->row();
    $findUser = $this->db->get_where('pengguna', ['id_pengguna' => $id])->row();
    //update pengguna tb
    $this->db->set('verif_ktp', 0);
    $this->db->where('id_pengguna',  $findUser->id_pengguna);
    $this->db->update('pengguna');
    //update pengguna tb
    $this->models->hapus($id, 'id_pengguna', 'detail_pengguna');
    $arr3 = [
      'id_user' =>  $findUser->id_pengguna,
      'id_konten' => $id,
      'judul' =>   'Verifikasi KTP',
      'deskripsi' => 'Verifikasi data anda tidak sesuai',
      'type' => 'Verifikasi KTP',
      'created_at' => date('Y-m-d H:i:s'),
      'edited_at' => date('Y-m-d H:i:s'),
    ];
    $this->db->insert('notif_user', $arr3);
    $this->session->set_flashdata(
      'message',
      '<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil Menolak Verifikasi KTP</div>'
    );
    //TODO : send Notifikasi
    $this->sendNotification($findUser->token, 'Verifikasi KTP Anda Telah Ditolak', 'Admin J-Kopi', $id, "KTP");

    redirect('master_data/Verifikasi_KTP');
  }
  public function sendNotification($id, $pesan, $title, $key, $type)
  {
    $registrationIds = array($id);
    $arguments = array(
      'message'   => $pesan,
      'key'        => $key,
      'title'     => $title,
      'type'     => $type,
    );

    $fields = array(
      'registration_ids'  => $registrationIds,
      'data'          => $arguments,
      'notification' => array(
        'title' => $title,
        'body' => $pesan,
        'key'    => $key,
        'type'  => $type,

      ),
      'android' => array(
        'priority' => 'high',
      ),
    );

    $headers = array(
      'Authorization: key= AAAAb_U0UXg:APA91bFONxn6cGhPKKj6Rnc6LB2CPFCopwO1D45RfZf4Nhcd-bWYafRa1j9jPompSTIbpfpQm3cB76W2KdziNPIUVgOFOglyOMT_kVs5MkwaDQivGCLK8Xj_Fs2rMUXPCGGIygmA-pkq',
      'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    curl_close($ch);
    // echo $result;
  }
}
