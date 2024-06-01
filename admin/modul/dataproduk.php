<?php 
if(!isset($_GET['action'])){

?>
<div class="row">
    <div class="col-md-12">
        <a href="?modul=<?php echo $_GET['modul'];?>&action=add" class="btn btn-primary"> tambah data </a>
        <table class="table table-dark table-striped my-2">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama produk</th>
                <th>harga</th>
                <th>stok</th>
                <th>kategori</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
             //untuk mendapatkan sql query 
             //"p" untuk menggantikannya, sehingga query menjadi lebih ringkas."p" digunakan untuk merujuk ke tabel "product". 
             //Setiap kali Anda melihat "p.idproduct", itu berarti kolom "idproduct" dari tabel "product". 
             $statment_sql = $cn_mysql->prepare(
            "SELECT p.idproduct, p.name_product, p.price, p.stok, c.category_name 
             FROM product p
             INNER JOIN product_category c ON p.idcategory_fk = c.categoryid
             WHERE p.is_active = '1'");
             //untuk mengeksekusi kode sql 
             $statment_sql->execute();
             $result = $statment_sql->get_result();
             while ($data = $result ->fetch_assoc()) {
            ?>
            <tr>
                <td class="col-md-1"><?php echo $no;?></td>
                <td class="col-md-3"><?php echo $data['name_product']; ?></td>
                <td class="col-md-2"><?php echo $data['price']; ?></td>
                <td class="col-md-2"><?php echo $data['stok']; ?></td>
                <td class="col-md-2"><?php echo $data['category_name'];?></td>
                <td>
                    <a href="?modul=<?php echo $_GET['modul'];?>&action=edit&id=<?php echo $data['idproduct'];?>" class="btn btn-primary" title="ubah data"><i class="bi bi-pencil-fill mx-2"></i><a>
                    <a href="?modul=<?php echo $_GET['modul'];?>&action=delete&id=<?php echo $data['idproduct'];?>" class="btn btn-danger" title="hapus data"><i class="bi bi-trash-fill "></i></a>
                </td>
            </tr>
            
            <?php $no++; 
             }
            ?>
        </tbody>
        </table>
    </div>
</div>
<?php
}
else {
    if($_GET['action']=="add"){
        //variabel untuk tambah data
        $process ="add"; //variabel ini digunakan untuk membedakan ketika memprocess data baik simpan data 
        $nama = "";
        $harga = "";
        $stok = "";
        $deskripsi = "";
        $created_date = date("Y-m-d h:i:s"); //untuk mengisi tanggal hari ini
        $created_by =  $_SESSION['loginname']; //untuk menampilkan user yg login
        $update_by ="";
        $update_date = date("Y-m-d h:i:s"); //untuk mengisi tanggal hari ini
        $keyid = 0;
    }
    else if($_GET['action']=="edit"){
        //variabel untuk ubah data
        $process ="edit"; //variabel ini digunakan untuk membedakan ketika memprocess data baik ubah data
        //proses mengambil data
        $keyid= $_GET['id']; //menampung variabel id yg di URL
        //untuk mendapatkan sql query 
        $statment_sql = $cn_mysql->prepare("select*from product_category  where categoryid=".$_GET['id']."");
        //untuk mengeksekusi kode sql 
        $statment_sql->execute();
        $result = $statment_sql->get_result(); 
        $data = $result ->fetch_assoc();
        $nama = $data['category_name'];
        
    }
    else if($_GET['action']=="delete"){
        header("location: modul/dataprodukproses.php?proses=delete&id=".$_GET['id']."");
    }
?>
 <!-- encytype pada tag form berfungsi untuk upload file -->
 <form enctype="multipart/form-data" action="modul/dataprodukproses.php" method="post">
    <input type="hidden" name="proses" value="<?php echo $process; ?>">
    <input type="hidden" name="keyid" value="<?php echo $keyid; ?>">
    <div class="row">
        <label class="col-md-2">Kategori produk :</label>
        <div class="col-md-5">
            <select class="form-select" id="k_produk" name="k_produk">
                <option value="">pilih kategori</option> 
                <?php
                //untuk mendapatkan sql query 
                $statment_sql = $cn_mysql->prepare("select*from product_category where isactive=1");
                //untuk mengeksekusi kode sql 
                $statment_sql->execute();
                //untuk menampung hasil eksekusi query
                $result = $statment_sql->get_result();
                while ($data = $result ->fetch_assoc()) {
                    echo '<option value="'.$data['categoryid'].'">'.$data['category_name'].'</option>';
                }
                ?>            
        </select>
        </div>
    </div>
    <div class="row my-3">
        <label class="col-md-2">nama produk :</label>
        <div class="col-md-5">
            <input type="text" name="namaproduk" class="form-control input-sm" required>
        </div>
    </div>
    <div class="row my-3">
        <label class="col-md-2">harga :</label>
        <div class="col-md-2">
            <input type="number" name="harga" class="form-control input-sm" <?php echo $harga;?> required>
        </div>
        <label class="col-md-1">stok :</label>
        <div class="col-md-2">
            <input type="text" name="stok" class="form-control input-sm" <?php echo $stok; ?> required>
        </div>
    </div>
    <div class="row">
        <label class="col-md-2">deskripsi :</label>
        <div class="col-md-5">
        <textarea class="form-control" name="keterangan" id="keterangan" <?php echo $deskripsi; ?> required></textarea>
        </div>
    </div>
    <div class="row">
        <label class="col-md-2 my-3">upload gambar produk :</label>
        <div class="col-md-5 my-3">
        <input type="file" name="gm_produk" class="form-control input-sm">
        </div>
    </div>
        <input type="hidden" name="created_date" value="<?php echo $created_date; ?>">
        <input type="hidden" name="created_by" value="<?php echo $created_by; ?>">
        <input type="hidden" name="update_by" value="<?php echo $update_by; ?>">
        <input type="hidden" name="update_date" value="<?php echo $update_date; ?>">
    <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-5">
            <hr>
            <button type="reset" class="btn btn-sm btn-secondary"><i class=”bi bi-x-circle-fill”></i>Batal</button>
            <button type="submit" class="btn btn-sm btn-primary"><i class=”bi bi-save-fill”></i>Simpan Data</button>
        </div>
    </div>
</form>
<?php
} 
?>