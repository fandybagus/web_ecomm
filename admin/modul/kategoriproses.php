<?php 
require_once("../../config/koneksidb.php");
require_once("../../config/general.php");
if (isset($_POST['proses']) && $_POST['proses']== "add") {
    //echo "proses tambah data";
    $namax = $_POST['namakategori']; 
    $createdby = $_POST['createdby'];
    $statment_sql = $cn_mysql->prepare("insert into product_category(category_name,isactive,createdby) values(?,1,?)");
    //fungsi untuk memberikan parameter yang dibutuhkan query sl yang digantikan dengan simbol tanda tanya
    $statment_sql->bind_param("ss", $namax, $createdby); 
    //untuk check apakah eksekusi berhasil
    if ($statment_sql->execute()) {
        back("../home.php?modul=Kategori");
        notif("data berhasil tersimpan");
    }

    else {
        back("../home.php?modul=Kategori&action=add");
        notif("data gagal tersimpan ");
    }
    $statment_sql->close();
}
if (isset($_POST['proses']) && $_POST['proses']== "edit") {
    //echo "proses ubah data";
    $namax = $_POST['namakategori']; 
    $id = $_POST['keyid'];
    $statment_sql = $cn_mysql->prepare("UPDATE product_category SET category_name=? WHERE categoryid=".$id = $_POST['keyid']."");
    //fungsi untuk memberikan parameter yang dibutuhkan query sl yang digantikan dengan simbol tanda tanya
    $statment_sql->bind_param("s", $namax); 
    //untuk check apakah eksekusi berhasil
    if ($statment_sql->execute()) {
        back("../home.php?modul=Kategori");
        notif("data berhasil diubah");
    }
    else {
        back("../home.php?modul=Kategori");
        notif("ubah data gagal");
    }
    $statment_sql->close();
}
if (isset($_GET['proses']) && $_GET['proses']== "delete") {
    echo "proses hapus data";
    // $statment_sql = $cn_mysql->prepare("UPDATE product_category SET isactive=0 WHERE categoryid=".$_GET['id']."");
    //fungsi untuk memberikan parameter yang dibutuhkan query sl yang digantikan dengan simbol tanda tanya 
    //versi delee
    $statment_sql = $cn_mysql->prepare("DELETE from product_category WHERE categoryid=".$_GET['id']."");
    //untuk check apakah eksekusi berhasil
    if ($statment_sql->execute()) {
        back("../home.php?modul=Kategori");
        notif("data berhasil di hapus");
    }
    else {
        back("../home.php?modul=Kategori");
        notif("data gagal terhapus");
    }
    $statment_sql->close();
}

?>