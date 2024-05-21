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
             $statment_sql = $cn_mysql->prepare("select*from product_category where isactive=1");
             //untuk mengeksekusi kode sql 
             $statment_sql->execute();
             $result = $statment_sql->get_result();
             while ($data = $result ->fetch_assoc()) {
            ?>
            <tr>
                <td class="col-md-1"><?php echo $no;?></td>
                <td class="col-md-3"></td>
                <td class="col-md-2"></td>
                <td class="col-md-2"></td>
                <td class="col-md-2"></td>
                <td>
                    <a href="?modul=<?php echo $_GET['modul'];?>&action=edit&id=<?php echo $data['categoryid'];?>" class="btn btn-primary" title="ubah data"><i class="bi bi-pencil-fill mx-2"></i><a>
                    <a href="?modul=<?php echo $_GET['modul'];?>&action=delete&id=<?php echo $data['categoryid'];?>" class="btn btn-danger" title="hapus data"><i class="bi bi-trash-fill "></i></a></td>
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
    }
    else{
       //variabel untuk ubah data
       $process ="edit"; //variabel ini digunakan untuk membedakan ketika memprocess data baik ubah data
       //proses mengambil data
       $keyid= $_GET['id']; //menampung variabel id yg di URL
       //untuk mendapatkan sql query 
       $statment_sql = $cn_mysql->prepare("select*from product_category where categoryid=".$_GET['id']."");
       //untuk mengeksekusi kode sql 
       $statment_sql->execute();
       $result = $statment_sql->get_result(); 
       $data = $result ->fetch_assoc();
       $nama = $data['category_name'];
    }
?>
 <form action="modul/kategoriproses.php" method="post">
    <input type="hidden" name="proses" value="<?php echo $process; ?>">
    <input type="hidden" name="keyid" value="<?php echo $keyid; ?>">
    <input type="hidden" name="createdby" value="<?php echo $_SESSION['loginname']; ?>">
    <div class="row">
        <label class="col-md-2">Kategori produk :</label>
        <div class="col-md-4">
            <select class="form-select" id="k_produk" name="k_produk">pilih kategori</select>
        </div>
    </div>
    <div class="row my-3">
        <label class="col-md-2 ">nama produk :</label>
        <div class="col-md-5">
            <input type="text" name="namaproduk" class="form-control input-sm">
        </div>
    </div>
    <div class="row my-3">
        <label class="col-md-2">harga :</label>
        <div class="col-md-2">
            <input type="text" name="harga" class="form-control input-sm">
        </div>
        <label class="col-md-1">stok :</label>
        <div class="col-md-2">
            <input type="text" name="stok" class="form-control input-sm">
        </div>
    </div>
    <div class="row">
        <label class="col-md-2">deskripsi :</label>
        <div class="col-md-5">
        <textarea class="form-control" name="keterangan" id="keterangan"></textarea>
        </div>
    </div>
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