<form action="admin/modul/prosesreg.php" method="post">
    <h3>Form Pendaftaran</h3>
    <hr>
    <div class="row my-3">
        <label class="col-md-2">Kode Member :</label>
        <div class="col-md-3">
            <input type="text" name="kode_mb" class="form-control input-sm" value="<?php echo generate_no_member() ?>" readonly>
        </div>
    </div>
    <div class="row my-3">
        <label class="col-md-2">Nama Member :</label>
        <div class="col-md-6">
            <input type="text" name="nama_mb" class="form-control input-sm" value="" required>
        </div>
    </div>
    <div class="row my-3">
        <label class="col-md-2">Email Member :</label>
        <div class="col-md-6">
            <input type="email" name="email" class="form-control input-sm" value="" required>
        </div>
    </div>
    <div class="row my-3">
        <label class="col-md-2">Password :</label>
        <div class="col-md-2">
            <input type="password" id="pw1" name="password" class="form-control input-sm" value="" required>
        </div>
        <label class="col-md-2">Ulangi Password :</label>
        <div class="col-md-2">
            <input type="password" id="pw2" name="ulangi_pw" onchange="cekpassword()" class="form-control input-sm" value="" required>
        </div>
    </div>
    <div class="row my-3">
        <label class="col-md-2">No.Telepon:</label>
        <div class="col-md-2">
            <input type="text" name="no_telpon" class="form-control input-sm" value="" required>
        </div>
        <label class="col-md-2">Tanggal Lahir :</label>
        <div class="col-md-2">
            <input type="date" name="tgl_lahir" class="form-control input-sm" value="" required>
        </div>
    </div>
    <div class="row">
        <label class="col-md-2">Alamat :</label>
        <div class="col-md-6">
            <textarea class="form-control" name="alamat" id="keterangan" required></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-5 my-2">
            <button type="reset" class="btn btn-sm btn-danger" onclick="history.back()"><i class="bi bi-x-circle-fill"></i> Batal</button>
            <button type="submit" id="tsimpan" name="action" value="add" class="btn btn-sm btn-primary"><i class="bi bi-save-fill"></i> Simpan Data</button>
        </div>
    </div>
</form>
