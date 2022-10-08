$(function () {
    $('.tombolTambah').on('click', function () {

        $('#formLabel').html('Tambah Data');

    });

    $('.tombolUbah').on('click', function () {

        $('#formLabel').html('Ubah Data');

        const id = $(this).data('id');

        $.ajax({

        });

    });
});