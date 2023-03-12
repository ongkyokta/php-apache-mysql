<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ecommerce extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Models', 'models');
    notLogin();
  }

  public function index()
  {
    $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
    $data['Pengguna'] = $id_admin;

    $this->load->view('master_data/data_ecommerce/data', $data);
  }
  public function kategori()
  {
    $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
    $data['Pengguna'] = $id_admin;

    $this->load->view('master_data/kategori_ecommerce/data', $data);
  }
  public function getAllDataKategori()
  {
    $data = $this->db->order_by('created_at', 'DESC')->get('kategori_ecommerce')->result_array();
    echo json_encode($data);
  }
  public function tambah_kategori()
  {
    $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|trim|max_length[128]');
    if ($this->form_validation->run() == false) {
      $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
      $data['Pengguna'] = $id_admin;
      $this->load->view('master_data/kategori_ecommerce/tambah', $data);
    } else {
      $config['allowed_types'] = 'jpg|png|jpeg';
      $config['max_size'] = '1024';
      $config['upload_path'] = './uploads/ecommerce';
      $config['encrypt_name'] = TRUE;
      $gambar = "";
      $this->load->library('upload', $config);
      if (!empty($_FILES['gambar']['name'])) {
        if ($this->upload->do_upload('gambar')) {
          $gambar = $this->upload->data();
          $gambar = "uploads/ecommerce/" . $gambar['file_name'];
        } else {
          $this->session->set_flashdata(
            'message',
            '<div class="alert alert-danger mb-3" role="alert">' . $this->upload->display_errors() .
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      </div>'
          );
          redirect('master_data/Ecommerce/kategori');
        }
      } else {
        $this->session->set_flashdata(
          'message',
          '<div class="alert alert-danger mb-3" role="alert">Gambar belum dipilih<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>'
        );
        redirect('master_data/Ecommerce/kategori');
      }
      $data_array = [
        'nama_kategori' => $this->input->post('nama_kategori'),
        'gambar' => $gambar,
        'created_at' => date('Y-m-d H:i:s'),
        'edited_at' => date('Y-m-d H:i:s'),
      ];
      if ($this->models->insert('kategori_ecommerce', $data_array)) {
        $this->session->set_flashdata(
          'message',
          '<div class="alert alert-success mb-3" role="alert">Berhasil menambah kategori E-Commerce
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>'
        );
        redirect('master_data/Ecommerce/kategori');
      } else {
        $this->session->set_flashdata(
          'message',
          '<div class="alert alert-danger mb-3" role="alert">Gagal menambah kategori E-Commerce
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>'
        );
        redirect('master_data/Ecommerce/kategori');
      }
    }
  }

  public function edit_kategori($id)
  {
    $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|trim|max_length[128]');
    if ($this->form_validation->run() == false) {
      $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
      $data['Pengguna'] = $id_admin;
      $data['Kategori'] = $this->db->get_where('kategori_ecommerce', ['id_kategori' => $id])->row();
      $this->load->view('master_data/kategori_ecommerce/edit', $data);
    } else {
      $kategori = $this->db->get_where('kategori_ecommerce', ['id_kategori' => $id])->row();
      $config['allowed_types'] = 'jpg|png|jpeg';
      $config['max_size'] = '1024';
      $config['upload_path'] = './uploads/ecommerce';
      $config['encrypt_name'] = TRUE;
      $gambar = $kategori->gambar;
      $this->load->library('upload', $config);
      if (!empty($_FILES['gambar']['name'])) {
        if ($this->upload->do_upload('gambar')) {
          $gambar = $this->upload->data();
          $gambar = "uploads/ecommerce/" . $gambar['file_name'];
        } else {
          $this->session->set_flashdata(
            'message',
            '<div class="alert alert-danger mb-3" role="alert">' . $this->upload->display_errors() .
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      </div>'
          );
          redirect('master_data/Ecommerce/kategori');
        }
      }
      $arr = [
        'nama_kategori' => $this->input->post('nama_kategori'),
        'gambar' => $gambar,
        'edited_at' => date('Y-m-d H:i:s'),
      ];
      $update = $this->models->update($arr, $id, 'id_kategori', 'kategori_ecommerce');
      if ($update) {
        $this->session->set_flashdata(
          'message',
          '<div class="alert alert-success mb-3" role="alert">Berhasil mengubah data kategori E-Commerce
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>'
        );
        redirect('master_data/Ecommerce/kategori');
      } else {
        $this->session->set_flashdata(
          'message',
          '<div class="alert alert-danger mb-3" role="alert">Gagal mengubah data kategori E-Commerce
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>'
        );
        redirect('master_data/Ecommerce/kategori');
      }
    }
  }
  public function delete_kategori()
  {
    $id = $_POST['id'];
    $this->db->where('id_kategori', $id);
    $this->db->delete('kategori_ecommerce');
    $this->session->set_flashdata(
      'message',
      '<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil menghapus data kategori
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  </div>'
    );
    redirect('master_data/Ecommerce/kategori');
  }
  // * E-COMMERCE
  public function getAllData()
  {
    $data = $this->db->order_by('created_at', 'DESC')->get('ecommerce')->result_array();
    echo json_encode($data);
  }
  public function tambah()
  {
    $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required|trim|max_length[128]');
    $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
    $this->form_validation->set_rules('harga', 'Harga', 'required');
    $this->form_validation->set_rules('nama_toko', 'Nama Toko', 'required');
    $this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'required');
    $this->form_validation->set_rules('satuan', 'Satuan', 'required');
    $this->form_validation->set_rules('alamat', 'Alamat', 'required');
    if ($this->form_validation->run() == false) {
      $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
      $data['Pengguna'] = $id_admin;
      $this->load->view('master_data/data_ecommerce/tambah', $data);
    } else {
      $config['allowed_types'] = 'jpg|png|jpeg';
      $config['max_size'] = '1024';
      $config['upload_path'] = './uploads/ecommerce';
      $config['encrypt_name'] = TRUE;
      $gambar = "";
      $this->load->library('upload', $config);
      if (!empty($_FILES['gambar']['name'])) {
        if ($this->upload->do_upload('gambar')) {
          $gambar = $this->upload->data();
          $gambar = "uploads/ecommerce/" . $gambar['file_name'];
        } else {
          $this->session->set_flashdata(
            'message',
            '<div class="alert alert-danger mb-3" role="alert">' . $this->upload->display_errors() .
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      </div>'
          );
          redirect('master_data/Ecommerce');
        }
      } else {
        $this->session->set_flashdata(
          'message',
          '<div class="alert alert-danger mb-3" role="alert">Gambar belum dipilih<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>'
        );
        redirect('master_data/Ecommerce');
      }
      $data_array = [
        'id_ecommerce' => $this->models->randomkode(10),
        'nama_produk' => $this->input->post('nama_produk'),
        'deskripsi' => $this->input->post('deskripsi'),
        'harga' => $this->input->post('harga'),
        'gambar' => $gambar,
        'nama_toko' => $this->input->post('nama_toko'),
        'no_telp' => $this->input->post('no_telp'),
        'id_kategori' => $this->input->post('id_kategori'),
        'alamat' => $this->input->post('alamat'),
        'id_kecamatan' => $this->input->post('kecamatan'),
        'id_kelurahan' => $this->input->post('kelurahan'),
        'satuan' => $this->input->post('satuan'),
        'created_at' => date('Y-m-d H:i:s'),
        'edited_at' => date('Y-m-d H:i:s'),
      ];
      if ($this->models->insert('ecommerce', $data_array)) {
        $this->session->set_flashdata(
          'message',
          '<div class="alert alert-success mb-3" role="alert">Berhasil menambah produk E-Commerce
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>'
        );
        redirect('master_data/Ecommerce');
      } else {
        $this->session->set_flashdata(
          'message',
          '<div class="alert alert-danger mb-3" role="alert">Gagal menambah produk E-Commerce
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>'
        );
        redirect('master_data/Ecommerce');
      }
    }
  }
  public function delete()
  {
    $id = $_POST['id'];
    $this->db->where('id_ecommerce', $id);
    $this->db->delete('ecommerce');
    $this->session->set_flashdata(
      'message',
      '<div class="alert alert-success mb-3 mt-3" role="alert">Berhasil menghapus data
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  </div>'
    );
    redirect('master_data/Ecommerce');
  }
  public function edit($id)
  {
    $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required|trim|max_length[128]');
    $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
    $this->form_validation->set_rules('harga', 'Harga', 'required');
    $this->form_validation->set_rules('nama_toko', 'Nama Toko', 'required');
    $this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'required');
    $this->form_validation->set_rules('satuan', 'Satuan', 'required');
    $this->form_validation->set_rules('alamat', 'Alamat', 'required');
    if ($this->form_validation->run() == false) {
      $id_admin = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row_array();
      $data['Pengguna'] = $id_admin;
      $data['Kategori'] = $this->db->get('kategori_ecommerce')->result_array();
      $data['Ecommerce'] = $this->db->get_where('ecommerce', ['id_ecommerce' => $id])->row();
      $this->load->view('master_data/data_ecommerce/edit', $data);
    } else {
      $ecommerce = $this->db->get_where('ecommerce', ['id_ecommerce' => $id])->row();
      $config['allowed_types'] = 'jpg|png|jpeg';
      $config['max_size'] = '1024';
      $config['upload_path'] = './uploads/ecommerce';
      $config['encrypt_name'] = TRUE;
      $gambar = $ecommerce->gambar;
      $this->load->library('upload', $config);
      if (!empty($_FILES['gambar']['name'])) {
        if ($this->upload->do_upload('gambar')) {
          $gambar = $this->upload->data();
          $gambar = "uploads/ecommerce/" . $gambar['file_name'];
        } else {
          $this->session->set_flashdata(
            'message',
            '<div class="alert alert-danger mb-3" role="alert">' . $this->upload->display_errors() .
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      </div>'
          );
          redirect('master_data/Ecommerce');
        }
      }
      $data_array = [
        'nama_produk' => $this->input->post('nama_produk'),
        'deskripsi' => $this->input->post('deskripsi'),
        'harga' => $this->input->post('harga'),
        'gambar' => $gambar,
        'nama_toko' => $this->input->post('nama_toko'),
        'no_telp' => $this->input->post('no_telp'),
        'id_kategori' => $this->input->post('id_kategori'),
        'alamat' => $this->input->post('alamat'),
        'id_kecamatan' => $this->input->post('kecamatan'),
        'id_kelurahan' => $this->input->post('kelurahan'),
        'satuan' => $this->input->post('satuan'),
        'edited_at' => date('Y-m-d H:i:s'),
      ];
      $update = $this->models->update($data_array, $id, 'id_ecommerce', 'ecommerce');
      if ($update) {
        $this->session->set_flashdata(
          'message',
          '<div class="alert alert-success mb-3" role="alert">Berhasil mengubah data E-Commerce
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>'
        );
        redirect('master_data/Ecommerce');
      } else {
        $this->session->set_flashdata(
          'message',
          '<div class="alert alert-danger mb-3" role="alert">Gagal mengubah data E-Commerce
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>'
        );
        redirect('master_data/Ecommerce');
      }
    }
  }
  public function data_kecamatan_kelurahan()
  {
    $id = $this->input->post('id_ecommerce');
    $data = $this->db->query("SELECT * FROM ecommerce o
          INNER JOIN kecamatan kc ON o.id_kecamatan = kc.id_kecamatan
          INNER JOIN kelurahan kl ON o.id_kelurahan = kl.id_kelurahan
          WHERE o.id_ecommerce = '$id'")->result();
    echo json_encode($data);
  }
}
