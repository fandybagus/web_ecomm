<?php
echo "NOTED : MATERI FUNGSI SORTING";
echo "<br>sorting dengan sort";
echo "<br>Hasil pengurutan menggunakan sort():\n";
// Array yang akan diurutkan
$angka = array(5, 3, 8, 1, 2);

// Menggunakan fungsi sort() untuk mengurutkan array secara ascending (dari kecil ke besar)
sort($angka);

// Menampilkan hasil sorting
echo "<br>Ascending: ";
foreach ($angka as $nilai) {
    echo $nilai . " ";
}

echo "<br><br>sorting dengan rsort";
echo "<br>Hasil pengurutan menggunakan rsort():\n";
// Menggunakan fungsi rsort() untuk mengurutkan array secara descending (dari besar ke kecil)
rsort($angka);

// Menampilkan hasil sorting
echo "<br>Descending: ";
foreach ($angka as $nilai) {
    echo $nilai . " ";
}

echo "<br><br>sorting dengan asort";
echo "<br>Hasil pengurutan menggunakan asort():\n";
$fruits = array("pensil" => 3, "bolpoint" => 2, "buku" => 5);

// Mengurutkan array berdasarkan nilai, tetapi mempertahankan keterkaitan kunci-nilai
asort($fruits);

// Menampilkan hasil
foreach ($fruits as $fruit => $quantity) {
    echo "<br>$fruit = $quantity";
}

echo "<br><br>sorting dengan ksort";
echo "<br>Hasil pengurutan menggunakan krsort():\n";
$fruits = array("pensil" => 3, "bolpoint" => 2, "buku" => 5);

// Mengurutkan array berdasarkan kunci
ksort($fruits);

// Menampilkan hasil
foreach ($fruits as $fruit => $quantity) {
    echo "<br>$fruit = $quantity";
}

echo "<br><br>sorting dengan arsort";
// Array yang akan diurutkan
$nilai = array(
    "dimas" => 80,
    "amin" => 90,
    "rizal" => 75,
    "rozy" => 85
);

// Mengurutkan array asosiatif secara menurun berdasarkan nilai
arsort($nilai);
echo "<br>Hasil pengurutan menggunakan arsort():\n";
foreach ($nilai as $nama => $skor) {
    echo "<br>".$nama . " : " . $skor . "\n";
}
echo "<br><br>sorting dengan krsort";
// Mengurutkan array asosiatif secara menurun berdasarkan kunci
krsort($nilai);
echo "<br>Hasil pengurutan menggunakan krsort():\n";
foreach ($nilai as $nama => $skor) {
    echo "<br>" .$nama . " : " . $skor . "\n";
}

echo "<br><br>NOTED : MATERI FUNGSI STRING";
echo "<br>fungsi string dengan explode()";
// Contoh penggunaan explode()
$string = "ibu pergi ke toko";
$pecah = explode(" ", $string); // Memecah string berdasarkan spasi
echo "<br>";
print_r($pecah); // Output: Array ( [0] => Ini [1] => adalah [2] => contoh [3] => kalimat )

echo "<br>";

echo "<br>fungsi string dengan implode()";
// Contoh penggunaan implode()
$array = array("Ibu", "pergi", "ke", "toko");
$gabung = implode(" ", $array); // Menggabungkan array menjadi string dengan spasi sebagai pemisah
echo "<br>";
echo $gabung; // Output: Ini adalah contoh kalimat

echo "<br><br>fungsi string dengan ltrim()";
echo "<br>andi bermain bola";    
// Contoh string dengan spasi di awal dan di akhir
$string = "andi bermain bola";
echo "<br> hasil fungsi string ltrim()<br>";
// Menghapus karakter dari kiri
echo ltrim($string,"andi");

echo "<br><br>fungsi string dengan rtrim()";
echo "<br>rudy pergi ke kota";
$string = "rudy pergi ke kota";
echo "<br> hasil fungsi string rtrim()<br>";
// Menghapus karakter dari kanan 
echo rtrim($string,"kota");

echo "<br><br>fungsi string dengan strlen()";
echo "<br>islam itu indah";
$k ="islam itu indah";
echo strlen($k);
?>
