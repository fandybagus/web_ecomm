<?php
// Koneksi ke database
if ($cn_mysql->connect_error) {
    die("Koneksi gagal: " . $cn_mysql->connect_error);
}

// Mendapatkan ID produk dari URL
$idproduct = $_GET['id'];

// Query SQL untuk mengambil detail produk berdasarkan ID
$statement_sql = $cn_mysql->prepare("SELECT * FROM product WHERE idproduct = ?");
$statement_sql->bind_param("i", $idproduct);
$statement_sql->execute();
$result = $statement_sql->get_result();

// Cek apakah produk ditemukan
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $productName = $row['name_product'];
    $productPrice = number_format($row['price'], 0, ',', '.');
    $productDescription = $row['description'];
    $productImage = $row['produk_file'];
    $waMessage = "Halo, saya tertarik untuk membeli produk $productName dengan harga Rp. $productPrice. Apakah stoknya masih ada?";
?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <img src="assets/img_produk/<?php echo $productImage; ?>" class="img-fluid" alt="..." />
            </div>
            <div class="col-md-6">
                <h1><?php echo $productName; ?></h1>
                <h2>Rp. <?php echo $productPrice; ?></h2>
                <p><?php echo $productDescription; ?></p>
                <a href="index.php" class="btn btn-primary">Kembali</a>
                <a href="https://api.whatsapp.com/send?phone=6282131930787&text=<?php echo urlencode($waMessage); ?>" class="btn btn-success">Beli via WhatsApp</a>
            </div>
        </div>
    </div>
<?php
} else {
    echo "<p>Produk tidak ditemukan.</p>";
}

// Tutup koneksi setelah selesai
$cn_mysql->close();
?>
