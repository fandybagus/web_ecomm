<?php 
$date_today = date("d-m-Y");
$date_day = date("D");
$company = "PT. ASE Software House";

//fungsi denga parameter yang mempunyai default/nilai awal 
function title ($tl= NULL){
    if ($tl == NULL){
        echo "tanggal hari ini : ".$GLOBALS["date_day"],",".$GLOBALS["date_today"];
    }
    else 
        echo $tl;
}
function back($url){
    echo "<meta http-equiv=\"REFRESH\" content=\"0;url=".$url."\">";
}
function notif($pesan){
    echo "<script>alert('$pesan');</script>";
}
function generate_no_member(){
    //ambil data code member yg paling terakhir
    //$GLOBALS ['namavariabel tanpa tanda $'] fungsinya agar suatu variabel dapat diakses secara global termasuk
    //dalam sebuah fungsi,tanpa harus membuat ulang variabel yang sama 
    $statment_sql = $GLOBALS['cn_mysql']->prepare("select membercode from mst_member order by membercode DESC LIMIT 1");
    $statment_sql->execute(); 
    $result = $statment_sql->get_result();
    $cekdata = $result->num_rows; /*untuk pengecekan apakah ada data atau tidak di tabel, hasilnya berupa angka*/
    if ($cekdata >0) {
        //jika sudah ada data di tabel mst_member
        $data = $result ->fetch_assoc();
        $code_lama = $data['membercode'];
        $tahun_sekarang = date('y');
        $tahun_ditabel = substr($code_lama,4,2);
        if ($tahun_ditabel == $tahun_sekarang) {
           $nourut = substr($code_lama,6,3)+1;
           if ($nourut < 10) {
            $nourut_baru = "00".$nourut;
           }
           else if ($nourut < 100) {
            $nourut_baru = "0".$nourut;
           }
           else if ($nourut < 1000) {
            $nourut_baru = "".$nourut;
           }
           //generate code dengan tahun yang sama 
           $code_member = 'MB'.date('m').$tahun_ditabel.$nourut_baru;
        }
        else {
            //jika generate code tahun berubah riset ke 001 
            $code_member = "MB". date("my")."001";
        }
        
    }
    else {
        //jika belum ada data di tabel mst_member
        $code_member = "MB". date("my")."001";
    }

    return $code_member;
}
?>
