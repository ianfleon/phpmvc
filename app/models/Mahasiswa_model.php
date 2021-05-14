<?php

class Mahasiswa_model {

    private $db;
    private $table = 'mahasiswa';

    public function __construct()
    { 
        $this->db = new Database;
    }

    // Mengambil semua data mahasiswa
    public function getAllMhs()
    {
        $this->db->query("SELECT * FROM " . $this->table);
        return $this->db->resultSet();
    }

    public function getMhsById($id)
    {
        $this->db->query(
            "SELECT * FROM " . $this->table . " WHERE id=:id"
        );

        $this->db->bind('id', $id);
        return $this->db->single();

    }

    public function getDataByPage($page = 1)
    {
        $total_data = count($this->getAllMhs()); // total data ditabel
        $data_per_page = 2; // data yang tampil /halaman
        $total_page = ceil($total_data / $data_per_page); // total halaman nanti

        $index_limit1 = 0; // index_awal default
        
        // jika page lebih dari 1
        if ( $page > 1 ) {
            $index_limit1 = ($page * $data_per_page) - $data_per_page; // mengambil data dari index berapa
        }

        // LIMIT QUERY TABLE
        $this->db->query("SELECT * FROM " . $this->table . " LIMIT ${index_limit1}, ${data_per_page}");
        $hasil['data'] = $this->db->resultSet();
        $hasil['total_halaman'] = $total_page;

        return $hasil;
    }


    public function tambahDataMahasiswa($data)
    {

        $query = "INSERT INTO mahasiswa VALUES
            ('', :nama, :nim, :jurusan)
        ";

        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('nim', $data['nim']);
        $this->db->bind('jurusan', $data['jurusan']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function hapusDataMahasiswa($id)
    {
        $query = "DELETE FROM mahasiswa WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function ubahDataMahasiswa($data)
    {
        $query = "UPDATE mahasiswa SET
            nama = :nama,
            nim = :nim,
            jurusan = :jurusan
            WHERE id = :id
        ";

        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('nim', $data['nim']);
        $this->db->bind('jurusan', $data['jurusan']);
        $this->db->bind('id', $data['id']);

        $this->db->execute();

        return $this->db->rowCount();
    }

}