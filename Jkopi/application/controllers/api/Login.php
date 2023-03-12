<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('Response');
		$this->load->model('Models', 'models');
		$this->load->helper('Tracking', 'tracking');
	}

	/* AUTH LOGIN
	* ----------------------------------------
	*/
	public function authlogin()
	{
		$nik = $this->input->post('nik', TRUE);
		$password = $this->input->post('password', TRUE);
		$token = $this->input->post('token', TRUE);
		$findUser = $this->db->query("SELECT * FROM pengguna WHERE nik = '$nik'")->row();

		if ($findUser) {
			if ($findUser->password == md5($password)) {
				if ($findUser->is_active == 'aktif') {
					$this->db->set('token', $token);
					$this->db->where('id_pengguna', $findUser->id_pengguna);
					$this->db->update('pengguna');
					$pengguna = $this->db->query("SELECT * FROM pengguna WHERE nik = '$nik'")->row();
					$data['meta'] = custom_response(200, "Authenticated");
					// TODO: LOG Record
					$hostValueInHeader = $this->input->request_headers();
					$authorization = explode(',', $hostValueInHeader['authorization']);
					$this->models->insertlog($authorization[0], '', 'Login Akun', getOS(), $authorization[1], getBrowser(), getUserIP(), getUrl());
					$data['response'] = [
						'message' =>  'Berhasil Login',
						'data' => $pengguna
					];
				} else {

					$data['meta'] = custom_response(500, "Authentication Failed");
					$data['response'] = [
						'message' =>  'Akun Anda belum aktif',
					];
				}
			} else {
				$data['meta'] = custom_response(500, "Authentication Failed");
				$data['response'] = [
					'message' =>  'Password Anda salah',
				];
			}
		} else {
			$data['meta'] = custom_response(500, "Authentication Failed");
			$data['response'] = [
				'message' =>  'Akun tidak ditemukan',
			];
		}
		echo json_encode($data);
	}

	/* AUTH REGISTER
	* ----------------------------------------
	*/
	public function register()
	{

		$nama_lengkap = $this->input->post('nama_lengkap', TRUE);
		$email = $this->input->post('email', TRUE);
		$nomor_telepon = $this->input->post('nomor_telepon', TRUE);
		$nik = $this->input->post('nik', TRUE);
		$alamat = $this->input->post('alamat', TRUE);
		$password = md5($this->input->post('password', TRUE));

		$arr = [
			'nama_lengkap' => $nama_lengkap,
			'nik' => $nik,
			'alamat' => $alamat,
			'email' => $email,
			'nomor_telepon' => $nomor_telepon,
			'password' => $password,
			'token' => '',
			'verif_ktp' => 0,
			'is_active' => 'aktif',
			'created_at' => date('Y-m-d H:i:s'),
			'edited_at' => ''
		];

		$cekNik = $this->db->query("SELECT * FROM pengguna WHERE nik = '$nik'")->row();
		$cekEmail = $this->db->query("SELECT * FROM pengguna WHERE email = '$email'")->row();

		if ($cekNik) {
			$data['meta'] = custom_response(500, "Failed");
			$data['response'] = [
				'message' =>  'NIK telah terdaftar',
			];
			echo json_encode($data);
			return;
		}
		if ($cekEmail) {
			$data['meta'] = custom_response(500, "Failed");
			$data['response'] = [
				'message' =>  'Email telah terdaftar',
			];
			echo json_encode($data);
			return;
		}

		$insert = $this->db->insert('pengguna', $arr);
		//send email
		// $this->_sendEmailRegister($email);
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
		$config['max_size'] = '2048';
		$config['upload_path'] = './uploads/user';
		$config['encrypt_name'] = TRUE;
		$gambar = "";
		$this->load->library('upload', $config);
		if ($insert) {
			$users = $this->db->query("SELECT * FROM pengguna WHERE nik = '$nik'")->row();

			if (!empty($_FILES['foto']['name'])) {
				if ($this->upload->do_upload('foto')) {
					$gambar = $this->upload->data();
					$gambar = "uploads/user/" . $gambar['file_name'];
					$arr = [
						'id_pengguna' => $users->id_pengguna,
						'foto_ktp' => $gambar,
						'created_at' => date('Y-m-d H:i:s')
					];

					// TODO: LOG Record
					$this->models->insert('detail_pengguna', $arr);
					// $this->models->insertlog($users->id_pengguna, '', 'Proses Verifikasi Akun', getOS(), $headers[1], getBrowser(), getUserIP(), getUrl());
					$arr2 = [
						'verif_ktp' => 1,
					];
					// TODO : Notif Web
					$arr4 = [
						'konten' => $users->id_pengguna,
						'title' => 'Pengajuan Verifikasi KTP',
						'deskripsi' => 'Pengajuan Verifikasi KTP Oleh Pengguna',
						'status' => 'Verifikasi KTP',
						'terbaca' => 0,
						'created_at' => date('Y-m-d H:i:s')
					];
					$this->models->insert('notif_web', $arr4);
					$hostValueInHeader = $this->input->request_headers();
					$headers = explode(',', $hostValueInHeader['authorization']);
					$this->models->update($arr2, $users->id_pengguna, 'id_pengguna', 'pengguna');
					$this->models->insertlog($users->id_pengguna, '', 'Register Akun', getOS(),	$headers[1], getBrowser(), getUserIP(), getUrl());

					$data['meta'] = custom_response(200, "Success");
					$data['response'] = [
						'message' =>  'Berhasil registrasi akun',
						'data' => $arr
					];
					echo json_encode($data);
					return;
				} else {
					$data['meta'] = custom_response(500, "Failed");
					$data['response'] = [
						'message' =>  'Terjadi Kesalahan',
					];
					echo json_encode($data);
					return;
				}
			} else {
				$data['meta'] = custom_response(500, "Failed");
				$data['response'] = [
					'message' =>  'Gambar Kosong',
				];
				echo json_encode($data);
				return;
			}
		} else {
			$data['meta'] = custom_response(500, "Failed");
			$data['response'] = [
				'message' =>  'Gagal registrasi akun',
			];
			echo json_encode($data);
			return;
		}
	}

	/* AUTH KIRIM ULANG EMAIL AKTIVASI
	* ----------------------------------------
	*/
	public function kirimulang()
	{
		$email = $this->input->post('email', TRUE);
		$emailresponse = $this->_sendEmailRegister($email);

		$data['meta'] = custom_response(200, "Success");
		// TODO: LOG Record
		$hostValueInHeader = $this->input->request_headers();
		$arr = explode(',', $hostValueInHeader['authorization']);
		$users = $this->db->query("SELECT * FROM pengguna WHERE email = '$email'")->row();
		$this->models->insertlog($users->id_pengguna, '', 'Melakukan Kirim Ulang Email', getOS(), $arr[1], getBrowser(), getUserIP(), getUrl());
		$data['response'] = [
			'message' =>  'Sedang mengirim ulang email aktivasi',
		];
		echo json_encode($data);
	}

	/* AUTH LUPA PASSWORD
	* ----------------------------------------
	*/
	public function lupapass()
	{
		$email = $this->input->post('email', TRUE);
		$find = $this->db->query("SELECT * FROM pengguna WHERE email = '$email'")->row();

		if ($find) {
			// TODO: LOG Record
			$this->_sendEmail($email);
			$data['meta'] = custom_response(200, "Success");
			//send email
			$users = $this->db->query("SELECT * FROM pengguna WHERE email = '$email'")->row();
			$hostValueInHeader = $this->input->request_headers();
			$arr = explode(',', $hostValueInHeader['authorization']);
			$this->models->insertlog($users->id_pengguna, '', 'Proses Lupa Password', getOS(), $arr[1], getBrowser(), getUserIP(), getUrl());
			$data['response'] = [
				'message' =>  'Akun ditemukan, silahkan periksa email Anda',
			];
		} else {
			$data['meta'] = custom_response(500, "Failed");
			$data['response'] = [
				'message' =>  'User tidak ditemukan',
			];
		}
		echo json_encode($data);
	}

	/* AUTH KIRIM EMAIL
	* ----------------------------------------
	*/
	public function _sendEmail($email)
	{
		$this->load->library('email');
		$config = [
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'jkopi@jemberkab.go.id',
			'smtp_pass' => 'superapps@2022',
			'smtp_port' => 465,
			'mailtype'  => 'html',
			'charset'   => 'utf-8',
			'newline'   => "\r\n"
		];
		$this->email->initialize($config);

		$this->email->from('jkopi@jemberkab.go.id', 'Admin J-KOPI');
		$pengguna = $this->db->query("SELECT * FROM pengguna WHERE email = '$email'")->row();

		$data = array(
			'userName' => $pengguna->nama_lengkap,
			'email' => $email
		);

		$this->email->to($email);
		$this->email->subject('J-KOPI');
		$this->email->message('J-KOPI');
		$body = $this->load->view('auth/temp_pass.php', $data, TRUE);

		$this->email->message($body);
		if ($this->email->send()) {
			// echo 'Sukses';
		} else {
			echo $this->email->print_debugger();
			die;
		}
	}

	/* AUTH KIRIM EMAIL REGISTRASI
	* ----------------------------------------
	*/
	public function _sendEmailRegister($email)
	{
		$this->load->library('email');
		$config = [
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'jkopi@jemberkab.go.id',
			'smtp_pass' => 'superapps@2022',
			'smtp_port' => 465,
			'mailtype'  => 'html',
			'charset'   => 'utf-8',
			'newline'   => "\r\n"
		];
		$this->email->initialize($config);

		$this->email->from('jkopi@jemberkab.go.id', 'Admin J-KOPI');
		$pengguna = $this->db->query("SELECT * FROM pengguna WHERE email = '$email'")->row();

		$data = array(
			'userName' => $pengguna->nama_lengkap,
			'email' => $email
		);

		$this->email->to($email);
		$this->email->subject('Aktivasi Akun');
		$this->email->message('J-KOPI');
		$body = $this->load->view('auth/temp_register.php', $data, TRUE);

		$this->email->message($body);
		if ($this->email->send()) {
			// echo 'Sukses';
		} else {
			echo $this->email->print_debugger();
			die;
		}
	}

	/* AUTH EDIT AKUN
	* ----------------------------------------
	*/
	public function editakun()
	{
		$nik = $this->input->post('nik', TRUE);
		$email = $this->input->post('email', TRUE);
		$nama_lengkap = $this->input->post('nama_lengkap', TRUE);
		$nomor_telepon = $this->input->post('nomor_telepon', TRUE);
		$alamat = $this->input->post('alamat', TRUE);
		$finduser = $this->db->get_where('pengguna', ['nik' => $nik])->row();

		if ($finduser) {
			$id_pengguna = $finduser->id_pengguna;
			$arr = [
				'email' => $email,
				'nama_lengkap' => $nama_lengkap,
				'nomor_telepon' => $nomor_telepon,
				'alamat' => $alamat,
			];
			// echo json_encode($arr);
			$query = $this->models->update($arr, $id_pengguna, 'id_pengguna', 'pengguna');
			if ($query) {
				// TODO: LOG Record
				$hostValueInHeader = $this->input->request_headers();
				$authorization = explode(',', $hostValueInHeader['authorization']);
				$this->models->insertlog($id_pengguna, '', 'Proses Edit Akun', getOS(), $authorization[1], getBrowser(), getUserIP(), getUrl());
				$data['meta'] = custom_response(200, "Success");
				$data['response'] = [
					'message' =>  'Berhasil edit akun',
				];
			} else {
				$data['meta'] = custom_response(500, "Failed");
				$data['response'] = [
					'message' =>  'Gagal edit akun',
				];
			}
		} else {
			$data['meta'] = custom_response(500, "Failed");
			$data['response'] = [
				'message' =>  'User tidak ditemukan',
			];
		}
		echo json_encode($data);
	}

	/* AUTH LOGOUT
	* ----------------------------------------
	*/
	public function logout()
	{
		$id_pengguna = $this->input->post('id_pengguna', TRUE);
		$finduser = $this->db->get_where('pengguna', ['id_pengguna' => $id_pengguna])->row();

		if ($finduser) {
			$arr = [
				'token' => '',
			];
			if ($this->models->update($arr, $id_pengguna, 'id_pengguna', 'pengguna')) {
				// TODO: LOG Record
				$hostValueInHeader = $this->input->request_headers();
				$authorization = explode(',', $hostValueInHeader['authorization']);
				$this->models->insertlog($id_pengguna, '', 'Logout Akun', getOS(), $authorization[1], getBrowser(), getUserIP(), getUrl());
				$data['meta'] = custom_response(200, "Success");
				$data['response'] = [
					'message' =>  'Berhasil logout akun',
				];
			} else {
				$data['meta'] = custom_response(500, "Failed");
				$data['response'] = [
					'message' =>  'Gagal logout akun',
				];
			}
		} else {
			$data['meta'] = custom_response(500, "Failed");
			$data['response'] = [
				'message' =>  'User tidak ditemukan',
			];
		}
		echo json_encode($data);
	}

	/* GET USER
	* ----------------------------------------
	*/
	public function getUser()
	{
		$id_pengguna = $this->input->post('id_pengguna', TRUE);
		$finduser = $this->db->get_where('pengguna', ['id_pengguna' => $id_pengguna])->row();

		if ($finduser) {
			$data['meta'] = custom_response(200, "Success");
			$data['response'] = [
				'message' =>  'User ditemukan',
				'data' => $finduser
			];
		} else {
			$data['meta'] = custom_response(500, "Failed");
			$data['response'] = [
				'message' =>  'User tidak ditemukan',
			];
		}
		echo json_encode($data);
	}
	public function updateImage()
	{
		$id = $this->input->post('id_pengguna', TRUE);
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
		$config['max_size'] = '2048';
		$config['upload_path'] = './uploads/user';
		$config['encrypt_name'] = TRUE;
		$gambar = "";
		$this->load->library('upload', $config);
		if (!empty($_FILES['foto']['name'])) {
			if ($this->upload->do_upload('foto')) {
				$gambar = $this->upload->data();
				$gambar = "uploads/user/" . $gambar['file_name'];
			} else {
				$data['meta'] = custom_response(500, "Failed");
				$data['response'] = [
					'message' =>  'Terjadi Kesalahan',
				];
				echo json_encode($data);
				return;
			}
		} else {
			$data['meta'] = custom_response(500, "Failed");
			$data['response'] = [
				'message' =>  'Gambar Kosong',
			];
			echo json_encode($data);
			return;
		}
		$arr = [
			'foto' => $gambar,
			'edited_at' => date('Y-m-d H:i:s')
		];
		// TODO: LOG Record
		$this->models->update($arr, $id, 'id_pengguna', 'pengguna');
		$hostValueInHeader = $this->input->request_headers();
		$authorization = explode(',', $hostValueInHeader['authorization']);
		$this->models->insertlog($id, '', 'Proses Ubah Foto Profile', getOS(), $authorization[1], getBrowser(), getUserIP(), getUrl());
		$data['meta'] = custom_response(200, "Success Created");
		$data['response'] = [
			'message' =>  'Berhasil Melakukan Edit Foto',
		];
		echo json_encode($data);
		return;
	}
	public function uploadKTP()
	{
		$id_pengguna = $this->input->post('id_pengguna', TRUE);
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
		$config['max_size'] = '2048';
		$config['upload_path'] = './uploads/user';
		$config['encrypt_name'] = TRUE;
		$gambar = "";
		$this->load->library('upload', $config);
		if (!empty($_FILES['foto']['name'])) {
			if ($this->upload->do_upload('foto')) {
				$gambar = $this->upload->data();
				$gambar = "uploads/user/" . $gambar['file_name'];
			} else {
				$data['meta'] = custom_response(500, "Failed");
				$data['response'] = [
					'message' =>  'Terjadi Kesalahan',
				];
				echo json_encode($data);
				return;
			}
		} else {
			$data['meta'] = custom_response(500, "Failed");
			$data['response'] = [
				'message' =>  'Gambar Kosong',
			];
			echo json_encode($data);
			return;
		}
		$arr = [
			'id_pengguna' => $id_pengguna,
			'foto_ktp' => $gambar,
			'created_at' => date('Y-m-d H:i:s')
		];
		$hostValueInHeader = $this->input->request_headers();
		// var_dump($hostValueInHeader['authorization']);
		// die;
		$headers = explode(',', $hostValueInHeader['authorization']);
		// TODO: LOG Record
		$this->models->insert('detail_pengguna', $arr);
		$this->models->insertlog($id_pengguna, '', 'Proses Verifikasi Akun', getOS(), $headers[1], getBrowser(), getUserIP(), getUrl());
		$arr2 = [
			'verif_ktp' => 1,
		];
		// TODO : Notif Web
		$arr4 = [
			'konten' => $id_pengguna,
			'title' => 'Pengajuan Verifikasi KTP',
			'deskripsi' => 'Pengajuan Verifikasi KTP Oleh Pengguna',
			'status' => 'Verifikasi KTP',
			'terbaca' => 0,
			'created_at' => date('Y-m-d H:i:s')
		];
		$this->models->insert('notif_web', $arr4);

		$this->models->update($arr2, $id_pengguna, 'id_pengguna', 'pengguna');
		$data['meta'] = custom_response(200, "Success Created");
		$data['response'] = [
			'message' =>  'Berhasil Melakukan Permintaan Verifikasi',
		];
		echo json_encode($data);
		return;
	}
	public function getNotifUser()
	{
		$id = $this->input->post('id_pengguna', TRUE);
		$findNotif = $this->db->get_where('notif_user', ['id_user' => $id])->result_array();

		if ($findNotif) {
			// TODO: LOG Record
			$hostValueInHeader = $this->input->request_headers();
			$arr = explode(',', $hostValueInHeader['authorization']);
			$this->models->insertlog($id, '', 'Proses Pengambilan Notifikasi Pengguna', getOS(), $arr[1], getBrowser(), getUserIP(), getUrl());
			$data['meta'] = custom_response(200, "Success");
			$data['response'] = [
				'message' =>  'Notif ditemukan',
				'data' => $findNotif
			];
		} else {
			$data['meta'] = custom_response(500, "Failed");
			$data['response'] = [
				'message' =>  'Notif tidak ditemukan',
			];
		}
		echo json_encode($data);
	}
}
