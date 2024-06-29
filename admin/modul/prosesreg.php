<?php
require_once("../../config/koneksidb.php");
require_once("../../config/general.php");

if($_POST['action'] == "add" || $_GET['proses'] == "delete"){
    if (isset($_POST['action']) && $_POST['action'] == "add") {
        // Generate kode member
        $kode_member = generate_no_member();
        
        // Ambil data dari form
        $nama_member = $_POST['nama_mb'];
        $email_member = $_POST['email'];
        $password = $_POST['password'];
        $telepon = $_POST['no_telpon'];
        $tanggal_lahir = $_POST['tgl_lahir'];
        $alamat = $_POST['alamat'];
        $created_date = date("Y-m-d H:i:s");
    
    
        // Enkripsi password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $email_member = $_POST['email'];
        $statement_sql = $cn_mysql->prepare("SELECT email_mb FROM mst_member WHERE email_mb=?");
        $statement_sql->bind_param("s", $email_member);
        $statement_sql->execute();
        //untuk menampung hasil eksekusi query
        $result = $statement_sql->get_result();
        if ($result->num_rows>0) {
            back("../../?page=registrasi");
            notif("email sudah terdaftar");
        }
        else{
            // Query SQL untuk menyimpan data ke database
        $statement_sql = $cn_mysql->prepare("INSERT INTO mst_member (membercode, name_mb, email_mb, password, datebirth_mb, telp_mb, address_mb, date_reg,isactive) VALUES (?, ?, ?, ?, ?, ?, ?, ?,1)");
        
        // Bind parameter
        $statement_sql->bind_param("ssssssss", $kode_member, $nama_member, $email_member, $hashed_password, $tanggal_lahir, $telepon, $alamat, $created_date);
        
        // Jalankan query dan periksa apakah berhasil atau tidak
        if ($statement_sql->execute()) {
            // Redirect dengan notifikasi jika sukses
            back("../../index.php");
            notif("berhasil tersimpan ");
        } else {
            // Jika gagal, tampilkan pesan error
            back("../../?page=regi  strasi");
            notif("gagal tersimpan");
            
        }
        }
        // Tutup statement
        $statement_sql->close();        
    } 
    if (isset($_GET['proses']) && $_GET['proses'] == "delete") {
        echo "proses hapus data";
        $statement_sql = $cn_mysql->prepare("UPDATE mst_member SET isactive=0 WHERE membercode = ?");
        $statement_sql->bind_param("s", $_GET['id']);
        
        // untuk check apakah eksekusi berhasil
        if ($statement_sql->execute()) {
            back("../home.php?modul=datamember");
            notif("data berhasil dihapus");
        } else {
            back("../home.php?modul=datamember");
            notif("data gagal di hapus");
        }
        $statement_sql->close();
    }    
}
else {
    // Redirect jika aksi bukan "add" atau tidak ada aksi yang dikirimkan
    header("Location: ../../index.php");
    exit();
}


?>
