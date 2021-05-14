<?php

$halaman = $data['halaman'];
$th = $data['mahasiswa']['total_halaman'];

// Handle Page
if ($halaman = $th) {
  $halaman = $th;
} else {
  $halaman += 1;
}

?>

<div class="container mt-5">

    <div class="row">
      <div class="col-lg-6">
        <?php Flasher::flash(); ?>
      </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary mb-3 btnTambahData" data-toggle="modal" data-target="#exampleModal">
            Tambah Data Mahasiswa
            </button>
            <h3>Daftar Mahasiswa</h3>
            <ul class="list-group">
            <?php foreach( $data['mahasiswa']['data'] as $mhs ) : ?>
                <li class="list-group-item">
                    <?= $mhs['nama']; ?>
                    <a href="<?= BASE_URL; ?>/mahasiswa/hapus/<?= $mhs['id']; ?>" class="badge badge-danger badge-pill float-right mr-2" onClick="return confirm('batul mau hapus data ni?')">hapus</a>
                    <a href="<?= BASE_URL; ?>/mahasiswa/ubah/<?= $mhs['id']; ?>" class="badge badge-success badge-pill float-right mr-2 btnUbahModal" data-toggle="modal" data-target="#exampleModal" data-id="<?= $mhs['id']; ?>">ubah</a>
                    <a href="<?= BASE_URL; ?>/mahasiswa/detail/<?= $mhs['id']; ?>" class="badge badge-primary badge-pill float-right mr-2">detail</a>
                </li>
            <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>

<div class="container mt-3">
  <nav aria-label="Page navigation example">
    <ul class="pagination">
      <li class="page-item ml-auto">
        <a class="page-link" href="
              <?php
                if ($data['halaman'] > 1) {
                  $data['halaman'] -= 1;
                } else {
                  $data['halaman'] = 1;
                }
                echo BASE_URL . '/mahasiswa/page/' . $data['halaman'];
              ?>
        ">Sebelumnya</a></li>
      
      <?php for( $i=1; $i<=$th; $i++ ) :?>
      <li class="page-item"><a class="page-link" href="<?= BASE_URL . '/mahasiswa/page/' . $i; ?>"><?= $i; ?></a></li>
      <?php endfor; ?>
      <li class="page-item"><a class="page-link" href="<?= BASE_URL . '/mahasiswa/page/' . $halaman; ?>">Selanjutnya</a></li>
    </ul>
  </nav>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formModalLabel">Tambah Data Mahasiswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= BASE_URL; ?>/mahasiswa/tambah" method="POST">
            <input type="hidden" id="id" name="id">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama">
            </div>
            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="nim" class="form-control" id="nim" name="nim" placeholder="Nomor Induk Mahasiswa">
            </div>
            <div class="form-group">
                <label for="jurusan">Jurusan</label>
                <select class="form-control" id="jurusan" name="jurusan">
                    <option value="Teknik Informatika">Teknik Informatika</option>
                    <option value="Sistem Informasi">Sistem Informasi</option>
                    <option value="Manajemen Informasi">Manajemen Informasi</option>
                    <option value="Komputerisasi Akuntansi">Komputerisasi Akuntansi</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>