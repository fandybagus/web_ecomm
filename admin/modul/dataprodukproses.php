<?php 
require_once("../../config/koneksidb.php");
require_once("../../config/general.php");
if (isset($_POST['proses']) && $_POST['proses']== "add") {
    $nm_kategori = $_POST['k_produk']; 
    $nm_produk = $_POST['namaproduk'];
    $harga = $_POST['harga'];
    $stok =  $_POST['stok'];
    $deskripsi = $_POST['keterangan'];
    $date =  $_POST['created_date'];
    $created_by =  $_POST['created_by'];
    $update_by =  $_POST['update_by'];
    $update_date =  $_POST['update_date'];
    $isactive = 1;
    
    // start proses upload file
    //$_FILES['nama dari attribut form']
    $produk_file = $_FILES['gm_produk'];
    var_dump($produk_file);
    //variabel untuk direktori penympanan file gambar
    $folder_img = "../../assets/img_produk/"; 
    echo $produk_file["name"];
    //tujuan folder penyimpanan file dan nama file di server
    $file_gambar = $folder_img.$produk_file['name'];
    echo $file_gambar;
    // validasi ukuran besar file yang diupload maksimal 5mb
    $isupload =0; //variabel untuk membantu proses validasi
    if ($produk_file['size']>5000000) {
            notif("silahkan upload ulang");
            back("../home.php?modul=dataproduk&action=add");
            $isupload = 0;
        }
    else {
            $isupload = 1;
        }
    //validasi format atau tipe file yang di upload hanya untuk pdf,doc,png,jpg
    //menggunakan fungsi pathinfo
    $typefile = pathinfo($produk_file["name"], PATHINFO_EXTENSION);
    echo $typefile;
    if ($typefile == "pdf" || $typefile == "doc" || $typefile == "png" || $typefile == "jpg") {
        $isupload = 1;
    }
    else {
        notif("silahkan upload ulang,format tipe file tidak sesuai");
        back("../home.php?modul=dataproduk&action=add");
        $isupload = 0;
        }

    //proses memindahan file
        if ($isupload==1) {
            if (move_uploaded_file($produk_file['tmp_name'],$file_gambar)) {
                $nama_file=$produk_file['name'];
                $statment_sql = $cn_mysql->prepare("INSERT INTO `product`(`idcategory_fk`, `name_product`, `price`, `stok`, `description`, `produk_file`, 
                `created_date`, `created_by`, `update_by`, `update_date`, `is_active`) 
                VALUES ($nm_kategori,'$nm_produk',$harga ,$stok ,'$deskripsi','$nama_file','$date','$created_by','$update_by','$update_date','$isactive')");

                if ($statment_sql->execute()) {
                    back("../home.php?modul=dataproduk");
                    notif("data berhasil tersimpan");
                }

                else {
                    back("../home.php?modul=dataproduk&action=add");
                    notif("data gagal tersimpan ");
                }
                $statment_sql->close();
            }
            else {
                notif("file gagal terupload ke server");
            }
    // end proses upload file
    }
}
if (isset($_GET['proses']) && $_GET['proses']== "delete") {
    echo "proses hapus data";
        $statment_sql = $cn_mysql->prepare("UPDATE product SET is_active=0 WHERE idproduct=".$_GET['id']."");

        //untuk check apakah eksekusi berhasil
    if ($statment_sql->execute()) {
        back("../home.php?modul=dataproduk");
        notif("data berhasil di hapus");
    }
    else {
        back("../home.php?modul=dataproduk");
        notif("data gagal terhapus");
    }
    $statment_sql->close();
}
if (isset($_POST['proses']) && $_POST['proses']== "edit") {
    $nm_kategori = $_POST['k_produk']; 
    $nm_produk = $_POST['namaproduk'];
    $harga = $_POST['harga'];
    $stok =  $_POST['stok'];
    $deskripsi = $_POST['keterangan'];
    $date =  $_POST['created_date'];
    $created_by =  $_POST['created_by'];
    $update_by =  $_POST['update_by'];
    $update_date =  $_POST['update_date'];
    $keyid = $_POST['key'];
// start proses upload file
    //$_FILES['nama dari attribut form']
    $produk_file = $_FILES['gm_produk'];
    //variabel untuk direktori penympanan file gambar
    $folder_img = "../../assets/img_produk/"; 
    echo $produk_file["name"];
    // empty untuk mengecek $_FILES ada isinya atau tidak 
    if (empty ($produk_file['name'])) {
        $nama_file = $_POST['filelama']; //untuk mendapatkan file lama attau ketika inputannya kosong 
    }
    else {
        //tujuan folder penyimpanan file dan nama file di server
        $file_gambar = $folder_img.$produk_file['name'];
        echo $file_gambar;
        // validasi ukuran besar file yang diupload maksimal 5mb
        $isupload =0; //variabel untuk membantu proses validasi
        if ($produk_file['size']>5000000) {
                notif("silahkan upload ulang");
                back("../home.php?modul=dataproduk&action=edit");
                $isupload = 0;
            }
        else {
                $isupload = 1;
            }
        //validasi format atau tipe file yang di upload hanya untuk pdf,doc,png,jpg
        //menggunakan fungsi pathinfo
        $typefile = pathinfo($produk_file["name"], PATHINFO_EXTENSION);
        echo $typefile;
        if ($typefile == "pdf" || $typefile == "doc" || $typefile == "png" || $typefile == "jpg") {
            $isupload = 1;
        }
        else {
            notif("silahkan upload ulang,format tipe file tidak sesuai");
            back("../home.php?modul=dataproduk&action=edit");
            $isupload = 0;
        }
        if ($isupload == 1) {
            //jika input file tidak kosong maka upload dile baru dan hapus file lama kemudian update dengan nama file yang baru
            move_uploaded_file($produk_file['tmp_name'],$file_gambar);
            //untuk hapus filelama ketika update
            unlink("".$folder_img.$_POST['filelama']."");
            $nama_file = $produk_file["name"];
        }
    } //else penutup if empty

    //kecuali createdby,createddate,date,idproduct,isactive
    $statment_sql = $cn_mysql->prepare(
        "UPDATE `product` SET `idcategory_fk` = '$nm_kategori', `name_product` = '$nm_produk', 
        `stok` = '$stok',`price` = '$harga', `description` = '$deskripsi', 
        `update_by` = '$update_by', `update_date` = '$update_date',`produk_file`= '$nama_file' WHERE `product`.`idproduct` = $keyid"
    );
    if ($statment_sql->execute()) {
        back("../home.php?modul=dataproduk");
        notif("data berhasil diupdate");
    }
    else {
        back("../home.php?modul=dataproduk");
        notif("data gagal diupdate");
    }
    $statment_sql->close();


}

?>