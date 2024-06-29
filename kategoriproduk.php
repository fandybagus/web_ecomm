<div class="row">
    <div class="col-12 text-center">
        <?php
        // Periksa koneksi
        if ($cn_mysql->connect_error) {
            die("Koneksi gagal: " . $cn_mysql->connect_error);
        }

        // Mendapatkan id kategori dari parameter URL
        //Fungsi intval() digunakan untuk mengonversi nilai menjadi integer.
        // intval($_GET['idcategory']) akan mengonversi nilai 
        //dari $_GET['idcategory'] yang semula berupa string menjadi integer.
        $idcategory = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $category_name = '';

        // Query SQL untuk mengambil nama kategori berdasarkan idcategory
        if ($idcategory > 0) {
            $category_sql = $cn_mysql->prepare("SELECT category_name FROM product_category WHERE categoryid = ?");
            $category_sql->bind_param('i', $idcategory);
            $category_sql->execute();
            $category_result = $category_sql->get_result();

            if ($category_row = $category_result->fetch_assoc()) {
                $category_name = $category_row['category_name'];
            }
            $category_sql->close();
        }

        // Tampilkan judul kategori
        //htmlspecialchars($category_name) adalah fungsi di PHP yang digunakan untuk 
        // menghindari masalah keamanan seperti Cross-Site Scripting (XSS) dengan 
        // mengubah karakter khusus dalam string menjadi entitas HTML yang aman.
        echo '
            <h5 id="title">
            semua "' . htmlspecialchars($category_name) . '"
            <span style="float: right;"></span>
            </h5>';
        ?>
        <hr>
    </div>
    <?php
    // Query SQL untuk mengambil produk yang aktif dan sesuai kategori
    $statement_sql = $cn_mysql->prepare("
        SELECT p.* 
        FROM product p
        JOIN product_category c ON p.idcategory_fk = c.categoryid
        WHERE p.is_active = 1 AND c.categoryid = ?
        ORDER BY p.idproduct DESC
    ");
    $statement_sql->bind_param('i', $idcategory);
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
    $statement_sql->close();
    $cn_mysql->close();
    ?>
</div>
