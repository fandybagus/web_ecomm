<?php
    echo "<b>Latihan<b><br>";

    // $nilai_1= 20;
    // $nilai_2= 5;
    // //operator peerhitungan php// 
    // echo "Nilai = ".$nilai_1, "<br> Nilai = ".$nilai_2;
    // echo "<br>penjumlahan =".$nilai_1+$nilai_2;
    // echo "<br>pengurangan =".$nilai_1-$nilai_2;
    // echo "<br>perkalian = ".$nilai_1*$nilai_2;
    // echo "<br>pembagian = ".$nilai_1/$nilai_2;
    // echo "<br>berpangkat = ".$nilai_2**$nilai_1;
    // //cara yg lain
    // echo "<br>berpangkat = " .pow($nilai_1,$nilai_2);
    // echo "<br>modulus(sisa hasil bagi) = ".$nilai_1%$nilai_2;
    // echo "<br>persen 2,5% dari 100000 = ".(25*100000/100);
    // echo "<br>cara yg lain persen 2,5% dari 100000 = ".(0.25*100000/100);

    // $gaji= 5300000;
    // $zakat= 25*$gaji/100;

    // echo "<br>anda dengan gaji ".$gaji.", wajib berzakat = ".$zakat;
    
    // $sisa_gaji = $gaji - $zakat;
    // echo "<br>sisa gaji saya = ".$sisa_gaji;
    
    
    $formatif_1 = 90;
    $formatif_2 = 80;
    $formatif_3 = 80;
    $formatif_4 = 90;
    $rata_rata_formatif = ($formatif_1+$formatif_2+$formatif_3+$formatif_4)/4;

    echo "<br>nilai rata-rata formatif = ".$rata_rata_formatif;

    echo "<br>nilai akhir formatif = ".(10*$rata_rata_formatif/100);

    $tugas_1 = 90;
    $tugas_2 = 90;
    $tugas_3 = 80;
    $tugas_4 = 100;
    $rata_rata_tugas = ($tugas_1+$tugas_2+$tugas_3+$tugas_4)/4;
    echo "<br>nilai rata-rata tugas = ".$rata_rata_tugas;

    echo "<br>nilai akhir tugas = ".(10*$rata_rata_tugas/100);

   

    $perilaku_1 = 90;
    $perilaku_2 = 90;
    $perilaku_3 = 90;
    $perilaku_4 = 90;
    $rata_rata_perilaku = ($perilaku_1+$perilaku_2+$perilaku_3+$perilaku_4)/4;

    echo "<br>nilai rata-rata perilaku = ".$rata_rata_perilaku;

    echo "<br>nilai akhir perilaku = ".(10*$rata_rata_perilaku/100);

    $n_uts = 92;
    echo "<br>Nilai UTS = ".(25*$n_uts/100);

    $n_uas = 93;
    echo "<br>Nilai UAS = ".(30*$n_uas/100);

    $na_keseluruhan=$rata_rata_formatif * 10 / 100 + 
                    $rata_rata_tugas * 10 / 100 + 
                    $rata_rata_perilaku * 10 / 100 +
                    $n_uts * 25 / 100 +
                    $n_uas * 30 / 100;
    echo "<br>Nilai Akhir Keseluruhan = " . $na_keseluruhan;

    echo "<br><br>NOTE : cari perbedaan antara include dan include once!!!";
    echo "<br>include once memasukkan dan mengeksekusi kode dari file yang ditentukan setiap kali perintah tersebut dieksekusi.
    Jika file yang dimasukkan tidak ditemukan atau mengalami masalah lainnya, PHP akan menampilkan pesan kesalahan tetapi akan melanjutkan eksekusi skrip.
    <br> >sedangkan include juga memasukkan dan mengeksekusi kode dari file yang ditentukan, tetapi hanya jika file tersebut belum dimasukkan sebelumnya pada saat yang sama.
    Jika file sudah dimasukkan sebelumnya, include akan mengabaikan dan tidak memasukkan file tersebut lagi."
?>