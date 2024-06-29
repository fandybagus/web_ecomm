<div class="row">
    <div class="col-12 text-center">
        <h5>Semua Produk</h5>
        <hr>
    </div>
<?php
    if ($cn_mysql->connect_error) {
        die("Koneksi gagal: " . $cn_mysql->connect_error);
    }
    // Query SQL untuk mengambil produk yang aktif
    $statement_sql = $cn_mysql->prepare("SELECT * FROM product WHERE is_active = 1 ORDER BY idproduct DESC ");
    $statement_sql->execute();
    $result = $statement_sql->get_result();

    // Loop untuk menampilkan setiap produk
    while ($row = $result->fetch_assoc()) {
?>
    <div class="col-md-4 mt-3">
        <div class="card">
            <img src="assets/img_produk/<?php echo $row['produk_file']; ?>" class="card-img-top" alt="..." />
            <div class="card-body text-center bgcardbody">
                <h5 class="card-title"><?php echo $row['name_product']; ?></h5>
                <h6 class="harga">Rp. <?php echo number_format($row['price'], 0, ',', '.'); ?></h6>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item btndetail">
                    <a href="?page=detailproduk&id=<?php echo $row['idproduct']; ?>" class="text-white">Detail</a>
                </li>
            </ul>
        </div>
    </div>
<?php
    }
    // Tutup koneksi setelah selesai
    $cn_mysql->close();
?>
</div>
