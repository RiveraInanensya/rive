<?php

class mahasiswa extends CI_Controller {
    public function __construct()
{
      parent:: __construct();
      $this->load->model('Mahasiswa_model');
      $this->load->library('form_validation');

     }
    public function index()
     
{
$data['judul'] = 'daftar mahasiswa';
$data['mahasiswa'] = $this->Mahasiswa_model->getAllMahasiswa();
if( $this->input->post('keyword')){
  $data['mahasiswa'] = $this->Mahasiswa_model->cariDataMahasiswa();
}
$this->load->view('templates/header', $data);
$this->load->view('mahasiswa/index', $data);
$this->load->view('templates/footer');
}
public function tambah()
{

  $data['judul'] = 'form tambah data mahasiswa';

  $this->form_validation->set_rules('nama', 'Nama', 'required');
  $this->form_validation->set_rules('nrp', 'NRP', 'required|numeric');
  $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

  if( $this->form_validation->run()== FALSE ) {
  $this->load->view('templates/header', $data);
  $this->load->view('mahasiswa/tambah');
  $this->load->view('templates/footer');
  } else {
    $this->Mahasiswa_model->TambahDataMahasiswa();
    $this->session->set_flashdata('flash','Ditambahkan');
    redirect('mahasiswa');
  }
}

public function hapus($id)
{
  $this->Mahasiswa_model->hapusDataMahasiswa($id);
  $this->session->set_flashdata('flash', 'Dihapus');
  redirect('mahasiswa');
}

public function detail($id)
{
  $data['judul'] = 'Detail Data Mahasiswa';
  $data['mahasiswa'] = $this->Mahasiswa_model->getMahasiswaById($id);
  $this->load->view('templates/header', $data);
  $this->load->view('mahasiswa/detail', $data);
  $this->load->view('templates/footer', $data);
}
 
public function ubah($id)
{
  $data['judul'] = 'form Ubah data mahasiswa';
  $data['mahasiswa'] = $this->Mahasiswa_model->getMahasiswaById($id);
  $data['jurusan'] = ['Rekayasa Perangkat Lunak', 'Teknik Komputer Jaringan', 'Desain Komunikasi Visual'];
  $this->form_validation->set_rules('nama', 'Nama', 'required');
  $this->form_validation->set_rules('nrp', 'NRP', 'required|numeric');
  $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

  if ($this->form_validation->run() == false ) {
  $this->load->view('templates/header', $data);
  $this->load->view('mahasiswa/ubah', $data);
  $this->load->view('templates/footer');
  } else {
    $this->Mahasiswa_model->ubahDataMahasiswa();
    $this->session->set_flashdata('flash','Diubah');
    redirect('mahasiswa');
  }
}



}