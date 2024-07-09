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
                <th>Tanggal</th>
                <th>No.Invoice</th>
                <th>Pelanggan</th>
                <th>Total</th>
                <th>Pembayaran</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
             //untuk mendapatkan sql query 
             $statment_sql = $cn_mysql->prepare("SELECT * FROM penjualan_head");
             //untuk mengeksekusi kode sql 
             $statment_sql->execute();
             $result = $statment_sql->get_result();
             while ($data = $result->fetch_assoc()) {
            ?>
            <tr>
                <td class="col-md-1"><?php echo $no;?></td>
                <td class="col-md-2"><?php echo $data['date_trans'];?></td>
                <td class="col-md-2"><?php echo $data['no_invoice'];?></td>
                <td class="col-md-2"><?php echo $data['memberid_fk'];?></td>
                <td class="col-md-1"><?php echo $data['total_trans'];?></td>
                <td class="col-md-2"><?php echo $data['payment_nominal'];?></td>
                <td>
                    <a href="?modul=<?php echo $_GET['modul'];?>&action=edit&id=<?php echo $data['no_invoice'];?>" class="btn btn-primary" title="ubah data"><i class="bi bi-pencil-fill mx-2"></i><a>
                    <a href="?modul=<?php echo $_GET['modul'];?>&action=delete&id=<?php echo $data['no_invoice'];?>" class="btn btn-danger" title="hapus data"><i class="bi bi-trash-fill "></i></a></td>
            </tr>
            <?php 
            $no++; 
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
        $n_telp ="";
        $harga = "";
        $stok = "";
        $created_date = date("Y-m-d h:i:s"); //untuk mengisi tanggal hari ini
        $created_by =  $_SESSION['loginname']; //untuk menampilkan user yg login
        $keyid = 0;
    
    }
    else if($_GET['action']=="edit"){
        //variabel untuk ubah data
        $process = "edit"; //variabel ini digunakan untuk membedakan ketika memproses data baik ubah data
        //proses mengambil data
        $keyid = $_GET['id']; //menampung variabel id yg di URL
        //untuk mendapatkan sql query 
        $statment_sql = $cn_mysql->prepare("SELECT * FROM product_category WHERE categoryid=".$_GET['id']."");
        //untuk mengeksekusi kode sql 
        $statment_sql->execute();
        $result = $statment_sql->get_result(); 
        $data = $result->fetch_assoc();
        $nama = $data['category_name'];
        $date_today = date("d-m-Y");
    }
    else if($_GET['action']=="delete"){
        header("location: modul/kategoriproses.php?proses=delete&id=".$_GET['id']."");
    }
?>
<!-- tampil form input/edit -->
<form action="modul/penjualanproses.php" method="post">
    <input type="hidden" name="proses" value="<?php echo $process; ?>">
    <input type="hidden" name="keyid" value="<?php echo $keyid; ?>">
    <input type="hidden" name="createdby" value="<?php echo $_SESSION['loginname']; ?>">
    <div class="row">
        <label class="col-md-2">No.Invoice : </label>
        <div class="col-md-3">
            <input class="form-control" id="n_invoice" name="n_invoice" value="<?php echo generate_no_inv() ?>" readonly>
        </div>
        <label class="col-md-1">Tanggal :</label>
        <div class="col-md-3">
            <input type="datetime-local" class="form-control" id="tanggal" name="tanggal" value="<?php echo date("Y-m-d h:i:s") ?>">
        </div>
    </div>
    <div class="row my-2">
        <label class="col-md-2 ">Nama Pelanggan :</label>
        <div class="col-md-7">
        <select class="form-select" id="nama_pelanggan" name="nama_pelanggan">
            <option>Pilih Nama Pelanggan</option>
            <?php
                //untuk mendapatkan sql query 
                $statment_sql = $cn_mysql->prepare("SELECT * FROM mst_member WHERE isactive=1");
                //untuk mengeksekusi kode sql 
                $statment_sql->execute();
                //untuk menampung hasil eksekusi query
                $result = $statment_sql->get_result();
                while ($data = $result->fetch_assoc()) {
                    echo '<option value="'.$data['memberid'].'" data-tel="'.$data['telp_mb'].'">'.$data['name_mb'].'</option>';
                }
            ?>            
        </select>
        </div>
    </div>
    <div class="row my-2">
        <label class="col-md-2 ">No.Telepon:</label>
        <div class="col-md-7">
            <input type="text" id="n_tlpn" name="notlpn" class="form-control input-sm" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9">
            <table class="table table-dark table-striped my-2">
                <tr>
                    <!-- colspan fungsinya untuk merge coloumn dalam tabel -->
                    <th colspan="5">Data Barang</th>
                </tr>
                <tr>
                    <th width="5%">No</th>
                    <th>Nama Barang</th>
                    <th width="20%">Harga</th>
                    <th width="10%">Jumlah</th>
                    <th width="5%">Subtotal</th>
                </tr>
                <tr>
                    <td width="5%">#</td>
                    <td>
                        <select class="form-select" id="nm_barang" name="nm_barang" onchange="pilih_produk()">
                            <option>Pilih Nama Barang</option>
                            <?php
                            //untuk mendapatkan sql query 
                            $statment_sql = $cn_mysql->prepare("SELECT * FROM product WHERE is_active=1");
                            //untuk mengeksekusi kode sql 
                            $statment_sql->execute();
                            //untuk menampung hasil eksekusi query
                            $result = $statment_sql->get_result();
                            while ($data = $result->fetch_assoc()) {
                                echo '<option value="'.$data['idproduct'].'" data-harga="'.$data['price'].'" data-stok="'.$data['stok'].'">'.$data['name_product'].'</option>';
                            }
                            ?>                    
                        </select>
                    </td>
                    <td width="20%">
                        <input type="number" id="txharga" name="harga" class="form-control" readonly>
                        <input type="hidden" id="txstok" name="stok" class="form-control" readonly>
                    </td>
                    <td width="10%">
                        <input type="number" id="jumlah" name="jumlah" class="form-control">
                    </td>
                    <td width="15%">
                        <input type="number" id="total" name="total" class="form-control" readonly>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row my-2">
        <label class="col-md-2 ">Bukti Pembayaran :</label>
        <div class="col-md-7">
            <input type="file" name="buktipembayaran" class="form-control input-sm">
        </div>
    </div>
    <div class="row my-2">
        <label class="col-md-2">Status Pembayaran</label>
        <div class="col-md-3">
            <select class="form-select" id="Statuspembayaran" name="statuspembayaran">
                <option value="">-- Pilih Status --</option>
                <option value="Belum Lunas">Belum Lunas</option>
                <option value="Lunas">Lunas</option>
            </select>
        </div>
        <label class="col-md-1">Nominal </label>
        <div class="col-md-3">
            <input type="text" name="nominal" class="form-control input-sm">
        </div>
    </div>
    <div class="row">
        <label class="col-md-2">Status Pengiriman :</label>
        <div class="col-md-7">
            <select class="form-select" id="s_pengiriman" name="s_pengiriman">
                <option value="">-- pilih status Pengiriman --</option>
                <option value="Diambil Kurir">Diambil Kurir</option>
                <option value="Proses Pengiriman">Proses Pengiriman</option>
                <option value="Diterima Pembeli">Diterima Pembeli</option>
            </select>
        </div>
    </div>
    <div class="row my-2">
        <input type="hidden" name="created_date" value="<?php echo $created_date; ?>">
        <input type="hidden" name="created_by" value="<?php echo $created_by; ?>">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-5">
            <hr>
            <button type="reset" class="btn btn-sm btn-secondary" onclick="history.back()"><i class="bi bi-x-circle-fill"></i> Batal</button>
            <button type="submit" class="btn btn-sm btn-primary"><i class="bi bi-save-fill"></i> Simpan Data</button>
        </div>
    </div>
</form>
<?php
} 
?>
