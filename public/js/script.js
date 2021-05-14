// Document Ready
console.log('script.js: berhasil konek');

$(function() {

    console.log('jquery.js: berhasil konek');

    $('.btnTambahData').on('click', () => {
        $('#formModalLabel').html('Tambah Data Mahasiswa');
        $('.modal-footer button[type=submit]').html('Tambah Data');
    });

    $('.btnUbahModal').on('click', async (dataku) => {
        
        $('.modal-body form').attr('action', 'http://localhost/phpmvc/public/mahasiswa/ubah');
        $('#formModalLabel').html('Ubah Data Mahasiswa');
        $('.modal-footer button[type=submit]').html('Ubah Data');

        // mengambil id dari tombol yang di-klik
        // console.log(dataku.currentTarget.dataset['id']);

        const id_mhs = dataku.currentTarget.dataset['id'];
        // console.log(id_mhs);

        $.ajax({
            url: 'http://localhost/phpmvc/public/mahasiswa/getubah',
            method: 'post',
            data: {id : id_mhs},
            dataType: 'json',
            success: (data) => {
                console.log(data);
                $('#nama').val(data.nama);
                $('#nim').val(data.nim);
                $('#jurusan').val(data.jurusan);
                $('#id').val(data.id);
            },
            error: (e) => {
                console.log(e.statusText);
            }
        });

        // $.post("http://localhost/phpmvc/public/mahasiswa/getubah", {id: id_mhs}, function(result){
        //     const data = $.parseJSON(result)
        //     console.log(data.nama)
        // })


    });

});