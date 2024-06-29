function cekpassword(){
    //untuk mendappatkan value dari form di jquery menggunakan 
    let pass1= $('#pw1').val(); 
    let pass2= $('#pw2').val();
    if (pass1 != pass2) {
        alert ("password tidak sama");
        $('#tsimpan').prop('disabled',true); //untuk menonaktifkan tombol
        $('#pw2').focus(); //agar kursor otomatis focus ke pw2
    }
    else{
        $('#tsimpan').prop('disabled',false);   //untuk mengaktifkan tombol
    }
}
function pilih_produk() {
    let harga = $("#nm_barang").find(':selected').data('harga');
    $("#harga").val(harga);
}