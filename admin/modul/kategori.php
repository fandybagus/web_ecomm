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
                <th>Nama Kategori</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>12</td>
                <td>12</td>
                <td><a href="?" class="btn btn-primary" title="ubah data"><i class="bi bi-pencil-fill mx-2"></i><a>
                <a href="?" class="btn btn-danger" title="hapus data"><i class="bi bi-trash-fill "></i></a></td>
            </tr>
        </tbody>
        </table>
    </div>
</div>
<?php
}
else {
    if($_GET['action']=="add"){
        echo "tambah data";
    }
    else{
        echo "ubah data";
    }
?>
<!-- tampil form input/edit -->
<form action="">
    <div class="row">
        <label class="col-md-2">Nama Kategori</label>
        <div class="col-md-5">
            <input type="text" name="namakategori" class="form-control input-sm">
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