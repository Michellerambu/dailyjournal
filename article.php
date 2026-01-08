<?php
include "koneksi.php";
?>

<div class="container">

    <button class="btn btn-secondary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="bi bi-plus-circle"></i> Tambah Article
    </button>

    <div class="table-responsive" id="article_data"></div>

</div>

<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form method="post" action="article_proses.php" enctype="multipart/form-data">

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Article</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label>Judul</label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Isi</label>
                        <textarea name="isi" class="form-control" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Gambar</label>
                        <input type="file" name="gambar" class="form-control">
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-secondary" name="simpan">Simpan</button>
                </div>

            </form>

        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
$(document).ready(function(){

    load_data(1);

    function load_data(hlm){
        $.ajax({
            url: "article_data.php",
            method: "POST",
            data: { hlm: hlm },
            success: function(data){
                $('#article_data').html(data);
            }
        });
    }

    $(document).on('click', '.halaman', function(){
        load_data($(this).attr("id"));
    });

});
</script>