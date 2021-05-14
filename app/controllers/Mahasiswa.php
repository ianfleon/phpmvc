<?php

class Mahasiswa extends Controller{

    public function index()
    {
        $data['judul'] = 'Daftar Mahasiswa';
        // $data['mahasiswa'] = $this->model('Mahasiswa_model')->getAllMhs();

        // dafault to pagination
        $this->page();

        $this->view('templates/header', $data);
        $this->view('mahasiswa/index', $data);
        $this->view('templates/footer');
    }

    public function page($p = 1)
    {
        $data['judul'] = 'Daftar Mahasiswa';
        $data['mahasiswa'] = $this->model('Mahasiswa_model')->getDataByPage($p);
        $data['halaman'] = $p;

        $this->view('templates/header', $data);
        $this->view('mahasiswa/index', $data);
        $this->view('templates/footer');
    }

    public function detail($id)
    {
        $data['judul'] = 'Detail Mahasiswa';
        $data['mahasiswa'] = $this->model('Mahasiswa_model')->getMhsById($id);

        $this->view('templates/header', $data);
        $this->view('mahasiswa/detail', $data);
        $this->view('templates/footer');
    }

    public function tambah()
    {
        if ( $this->model('Mahasiswa_model')->tambahDataMahasiswa($_POST) > 0 ) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header("Location: ". BASE_URL ."/mahasiswa");
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambah', 'danger');
        }
    }

    public function hapus($id)
    {
        if ( $this->model('Mahasiswa_model')->hapusDataMahasiswa($id) > 0 ) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header("Location: " . BASE_URL . "/mahasiswa");
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header("Location: " . BASE_URL . "/mahasiswa");
            exit;
        }
    }

    public function getubah()
    {
        // echo "getUbah(): " . $_POST['id'];
        $id = $_POST['id'];
        
        $data_mhs = $this->model('Mahasiswa_model')->getMhsById($id);
        echo json_encode($data_mhs);

        // exit;
    }

    public function ubah()
    {
        if ( $this->model('Mahasiswa_model')->ubahDataMahasiswa($_POST) > 0 ) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header("Location: ". BASE_URL ."/mahasiswa");
            exit;
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
        }
    }

}