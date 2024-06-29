<?php 
if(!isset($_GET['action'])){

?>
<div class="row">
    <div class="col-md-12">
        <table class="table table-dark table-striped my-2">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Member</th>
                    <th>Nama Member</th>
                    <th>Email</th>
                    <th>No.Telepon</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $no = 1;
             //untuk mendapatkan sql query 
             $statment_sql = $cn_mysql->prepare("SELECT * FROM mst_member where isactive=1");
             //untuk mengeksekusi kode sql 
             $statment_sql->execute();
             $result = $statment_sql->get_result();
             while ($data = $result ->fetch_assoc()) {
            ?>
            <tr>
                <td class="col-md-1"><?php echo $no;?></td>
                <td class="col-md-3"><?php echo $data['membercode']; ?></td>
                <td class="col-md-2"><?php echo $data['name_mb']; ?></td>
                <td class="col-md-2"><?php echo $data['email_mb']; ?></td>
                <td class="col-md-2"><?php echo $data['telp_mb'];?></td>
                <td>
                    <a href="?modul=<?php echo $_GET['modul'];?>&action=edit&id=<?php echo $data['membercode'];?>" class="btn btn-primary" title="detail data"><i class="bi bi-file-text"></i><a>
                    <a href="?modul=<?php echo $_GET['modul'];?>&action=delete&id=<?php echo $data['membercode'];?>" class="btn btn-danger" title="hapus data"><i class="bi bi-trash-fill "></i></a>
                </td>
            </tr>
            
            <?php $no++; 
             }
            ?>
            </tbody>
        </table>
<?php
}
else {
    if($_GET['action']=="edit"){
        //variabel untuk ubah data
        $process ="edit"; //variabel ini digunakan untuk membedakan ketika memprocess data baik ubah data
        //proses mengambil data
        $keyid= $_GET['id']; //menampung variabel id yg di URL
        //untuk mendapatkan sql query 
        $statment_sql = $cn_mysql->prepare("select*from mst_member where membercode='$keyid'");
        //untuk mengeksekusi kode sql 
        $statment_sql->execute();
        $result = $statment_sql->get_result(); 
        $data = $result ->fetch_assoc();
        $membercode = $data['membercode'];
        $nama = $data['name_mb'];
        $email = $data['email_mb'];
        $tgl_lahir = $data['datebirth_mb'];
        $no_telpon = $data['telp_mb'];
        $alamat =  $data['address_mb']; //untuk menampilkan user yg login
        $tgl_daftar = date("Y-m-d h:i:s"); //untuk mengisi tanggal hari ini
    }
    else if($_GET['action']=="delete"){
        header("location: modul/prosesreg.php?proses=delete&id=".$_GET['id']."");
    }
?>
<form action="admin/modul/prosesreg.php" method="post">
<div class="row">
    <label class="col-md-2"><b>Kode Member </b></label>
    <div class="col-md-2">
        <p class="form-control-static">: <?php echo $membercode ?></p>
    </div>
</div>
<div class="row">
    <label class="col-md-2"><b>Nama Member </b></label>
    <div class="col-md-2">
        <p class="form-control-static">: <?php echo $nama?></p>
    </div>
</div>
<div class="row">
    <label class="col-md-2"><b>Email(Username) </b></label>
    <div class="col-md-2">
        <p class="form-control-static">: <?php echo $email ?></p>
    </div>
</div>
<div class="row">
    <label class="col-md-2"><b>Tanggal Lahir </b></label>
    <div class="col-md-2">
        <p class="form-control-static">: <?php echo $tgl_lahir ?></p>
    </div>
</div>
<div class="row">
    <label class="col-md-2"><b>No.Telepon</b></label>
    <div class="col-md-2">
        <p class="form-control-static">: <?php echo $no_telpon ?></p>
    </div>
</div>
<div class="row">
    <label class="col-md-2"><b>Alamat </b></label>
    <div class="col-md-6">
        <p class="form-control-static">: <?php echo $alamat ?></p>
    </div>
</div>
<div class="row">
    <label class="col-md-2"><b>Tanggal daftar </b></label>
    <div class="col-md-2">
        <p class="form-control-static">: <?php echo $tgl_daftar ?></p>
    </div>
</div>
<div class="my-4">
    <button type="reset" class="btn btn-sm btn-secondary" onclick="history.back()"><i class="bi bi-x-circle-fill"></i> Kembali</button>
</div>
</form>
<?php
} 
?>