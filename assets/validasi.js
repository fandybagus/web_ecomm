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
    //$(harga) didapat dari combo box data-harga="'.$data['price']'"
    $("#txharga").val(harga);
    let stok = $("#nm_barang").find(':selected').data('stok');
    $("#txstok").val(stok);
}
$('#jumlah').on('change',function(){
    let jumlah = parseInt($("#jumlah").val()); // Menggunakan parseInt untuk memastikan jumlah dalam bentuk integer
    let harga = parseInt($("#txharga").val()); // Menggunakan parseInt untuk memastikan harga dalam bentuk integer
    let stok = $("#nm_barang").val();

    let total = jumlah * harga;
    
    //unntuk menghitung otomatis jumlah stok jika melebihi maka akan tampil notif 
    if (jumlah>stok) {
        alert("jumlah melebihi stok,sisa stok ="+stok);
        $("#total").val(0);
        $("#jumlah").val(stok);
    }
    else{
        $("#total").val(total);
    }
});
//$(document).ready(function(){ ... });
//Ini adalah cara untuk menetapkan fungsi yang akan dijalankan ketika dokumen HTML selesai dimuat sepenuhnya.
//$(document).ready() adalah sinonim dari $(function(){ ... }), yang artinya memastikan bahwa 
//kode di dalamnya akan dieksekusi setelah seluruh struktur HTML telah dimuat.
$(document).ready(function(){
    $('#nama_pelanggan').on('change', function(){
//let telp = $(this).find(':selected').data('tel');
//$(this) mengacu pada elemen nama_pelanggan yang memicu perubahan (event listener).
//find(':selected') digunakan untuk menemukan elemen <option> yang dipilih dalam dropdown.
//data('tel') mengambil nilai dari atribut data-tel dari elemen <option> yang dipilih.
//Jadi, telp akan berisi nilai dari atribut data-tel dari <option> yang dipilih.
    let telp = $(this).find(':selected').data('tel');
    $('#n_tlpn').val(telp);
    });
});