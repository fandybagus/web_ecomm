<?php
// $uang = 15000000;
// if($uang >=15000000){
//     echo "HP";
// }
// else if ($uang >=10000000){
//     echo "ASUS";
// }
// else{
//     echo "tidak bisa beli laptop";
// }

// //contoh jika dirubah menjadi switch case
// $uang_2 = 13000000;
// switch($uang_2){
//     case $uang_2 >=15000000 :
//         echo "<br>HP";
//         break;
//     case $uang_2 >=10000000 :
//         echo "<br>ASUS";
//         break;
//     default :
//         echo "tidak bisa beli laptop";
//         break;
// }

//tugas 2
$kode_barang = "B01";
$jumlah_beli = 3;
$nm_barang = "buku";

if($kode_barang=="B01"){
    $nm_barang = "buku";
    $harga_barang = 50000;
}
else if($kode_barang=="B02"){
        $nm_barang = "pulpen";
        $harga_barang = 10000;
}
else if($kode_barang=="B03"){
        $nm_barang = "penghapus";
        $harga_barang = 5000;
}
else {
    echo "kode tidak sesuai";
}

$total_harga = $harga_barang * $jumlah_beli;

if ($jumlah_beli >= 3 && $kode_barang == "B01") {
    $diskon_per_item = 3000;
    $diskon_total = $diskon_per_item * $jumlah_beli;
    $total = $total_harga-$diskon_total;
}
echo "kode barang : ".$kode_barang, " nama barang : ".$nm_barang, " beli sebanyak : ".$jumlah_beli;
echo "<br>Total harga pembelian: Rp " . number_format($total, 0, ",", ".");

//tugas 3
$nilai = 9;
$absen = 3;

if ($nilai > 8 && $absen <= 1) {
    echo "<br>ANDA LULUS DENGAN NILAI A";
}
elseif ($nilai > 8 && $absen < 2) {
    echo "<br>ANDA LULUS DENGAN NILAI B";
}
elseif ($nilai >= 7 && $absen > 3) {
    echo "<br>ANDA LULUS DENGAN NILAI C";
}
else {
    echo "<br>anda sebaiknya remidi";
}

echo "<br><b>NOTED :";
echo "<b>foreign key adalah sebuah atribut atau gabungan atribut yang terdapat dalam suatu tabel yang 
        digunakan untuk menciptakan hubungan atau relasi antara dua tabel.
        <br>Primary key adalah sebuah nilai dalam bentuk basis data yang bisa digunakan untuk identifikasi suatu baris dalam tabel.
        <br>Dalam SQL, index adalah sebuah query dari database yang dapat membuat hasil query lebih cepat atau membantu meningkatkan performa pengambilan data dari sebuah tabel.
        <br>Fungsi unique pada dasarnya sama seperti primary key, yaitu untuk memastikan bahwa setiap baris data yang terdapat dalam suatu tabel bersifat unik (tidak sama). 
        Perbedaanya, pada unique key Anda diizinkan untuk memasukkan nilai NULL(nilai yg tidak diketahui) ."

?>