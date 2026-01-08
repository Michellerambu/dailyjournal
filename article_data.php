<?php
session_start();
include "koneksi.php";

$hlm = (isset($_POST['hlm'])) ? $_POST['hlm'] : 1;
$limit = 3;
$limit_start = ($hlm - 1) * $limit;
$no = $limit_start + 1;

$sql = "SELECT * FROM article ORDER BY tanggal DESC LIMIT $limit_start, $limit";
$hasil = $conn->query($sql);
?>

<table class="table table-hover">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th class="w-25">Judul</th>
            <th class="w-75">Isi</th>
            <th class="w-25">Gambar</th>
            <th class="w-25">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $hasil->fetch_assoc()) { ?>
        <tr>
            <td><?= $no++ ?></td>
            <td>
                <strong><?= $row["judul"] ?></strong><br>
                pada : <?= $row["tanggal"] ?><br>
                oleh : <?= $row["username"] ?>
            </td>
            <td><?= $row["isi"] ?></td>

            <td>
                <?php
                if ($row["gambar"] != '') {
                    $gambar = str_replace('images/', '', $row["gambar"]);

                    if (file_exists('images/' . $gambar)) {
                ?>
                        <img src="images/<?= $gambar ?>" width="100" class="img-thumbnail">
                <?php
                    } else {
                        echo "<span class='text-danger'>File tidak ada</span>";
                    }
                } else {
                    echo "<span class='text-muted'>Tidak ada gambar</span>";
                }
                ?>
            </td>

            <td>
                <a href="#" class="badge rounded-pill text-bg-success">
                    <i class="bi bi-pencil"></i>
                </a>
                <a href="#" class="badge rounded-pill text-bg-danger">
                    <i class="bi bi-x-circle"></i>
                </a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<?php
$sql1 = "SELECT * FROM article";
$hasil1 = $conn->query($sql1);
$total_records = $hasil1->num_rows;
?>

<p>Total article : <?= $total_records ?></p>

<nav class="mb-2">
<ul class="pagination justify-content-end">
<?php
$jumlah_page = ceil($total_records / $limit);
$jumlah_number = 1;
$start_number = ($hlm > $jumlah_number) ? $hlm - $jumlah_number : 1;
$end_number = ($hlm < ($jumlah_page - $jumlah_number)) ? $hlm + $jumlah_number : $jumlah_page;

if ($hlm == 1) {
    echo '<li class="page-item disabled"><a class="page-link">First</a></li>';
    echo '<li class="page-item disabled"><a class="page-link">&laquo;</a></li>';
} else {
    echo '<li class="page-item halaman" id="1"><a class="page-link">First</a></li>';
    echo '<li class="page-item halaman" id="'.($hlm-1).'"><a class="page-link">&laquo;</a></li>';
}

for ($i = $start_number; $i <= $end_number; $i++) {
    $active = ($hlm == $i) ? ' active' : '';
    echo '<li class="page-item halaman'.$active.'" id="'.$i.'">
            <a class="page-link">'.$i.'</a>
          </li>';
}

if ($hlm == $jumlah_page) {
    echo '<li class="page-item disabled"><a class="page-link">&raquo;</a></li>';
    echo '<li class="page-item disabled"><a class="page-link">Last</a></li>';
} else {
    echo '<li class="page-item halaman" id="'.($hlm+1).'"><a class="page-link">&raquo;</a></li>';
    echo '<li class="page-item halaman" id="'.$jumlah_page.'"><a class="page-link">Last</a></li>';
}
?>
</ul>
</nav>