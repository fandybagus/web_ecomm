<?php
require_once("../../config/koneksidb.php");
require_once("../../config/general.php");

if (isset($_POST['proses']) && $_POST['proses'] == "add") {
    // Ambil data dari form
    $n_invoice = $_POST['n_invoice'];
    $tanggal = $_POST['tanggal'];
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $notlpn = $_POST['notlpn'];
    $status_pembayaran = $_POST['statuspembayaran'];
    $nominal = $_POST['nominal'];
    $total = $_POST['total'];
    $s_pengiriman = $_POST['s_pengiriman'];
    $createdby = $_POST['createdby'];


    // // start proses upload file
    // //$_FILES['nama dari attribut form']
    // $produk_file = $_FILES['gm_produk'];
    // var_dump($produk_file);
    // //variabel untuk direktori penympanan file gambar
    // $folder_img = "../../assets/img_produk/"; 
    // echo $produk_file["name"];
    // //tujuan folder penyimpanan file dan nama file di server
    // $file_gambar = $folder_img.$produk_file['name'];
    // echo $file_gambar;
    // // validasi ukuran besar file yang diupload maksimal 5mb
    // $isupload =0; //variabel untuk membantu proses validasi
    // if ($produk_file['size']>5000000) {
    //         notif("silahkan upload ulang");
    //         back("../home.php?modul=penjualan&action=add");
    //         $isupload = 0;
    //     }
    // else {
    //         $isupload = 1;
    //     }
    // //validasi format atau tipe file yang di upload hanya untuk pdf,doc,png,jpg
    // //menggunakan fungsi pathinfo
    // $typefile = pathinfo($produk_file["name"], PATHINFO_EXTENSION);
    // echo $typefile;
    // if ($typefile == "pdf" || $typefile == "doc" || $typefile == "png" || $typefile == "jpg") {
    //     $isupload = 1;
    // }
    // else {
    //     notif("silahkan upload ulang,format tipe file tidak sesuai");
    //     back("../home.php?modul=penjualan&action=add");
    //     $isupload = 0;
    //     }

    // Lakukan koneksi ke database sesuai dengan cara Anda
    // Misalnya, jika $cn_mysql adalah objek koneksi mysqli, Anda bisa melanjutkan seperti ini:
    // Asumsikan $cn_mysql adalah objek koneksi MySQLi yang sudah terhubung ke database
    $statement_sql = $cn_mysql->prepare("INSERT INTO penjualan_head(no_invoice, date_trans, memberid_fk, cust_telp, total_trans, payment_status, payment_nominal, created_by, created_date, tracking) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)");
    
    // Bind parameters
    $statement_sql->bind_param("sssssssss", $n_invoice, $tanggal, $nama_pelanggan, $notlpn,  $total, $status_pembayaran, $nominal, $createdby, $s_pengiriman);

    // Untuk check apakah eksekusi berhasil
    if ($statement_sql->execute()) {
        // Jika berhasil, redirect ke halaman home.php dengan modul penjualan
        back("../home.php?modul=penjualan");
        notif("data berhasil tersimpan");
    } else {
        // Jika gagal, redirect kembali ke halaman penjualan dengan aksi tambah
        back("../home.php?modul=penjualan&action=add");
        notif("data gagal tersimpan ");
    }
    
    // Tutup statement
    $statement_sql->close();
}

?>

