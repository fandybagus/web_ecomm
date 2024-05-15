<?php
session_start();
if (isset($_SESSION['userlogin'])){
require_once('../config/koneksidb.php');
require_once('../config/general.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/adminstyle.css">
    <!-- icon bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>
<body class="bg-info">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 bg-black left-menu">
                <h4 class="pb-3 text-white text-center border-bottom"><?php 
                echo $company; ?></h4>
                <!-- dari bootstrap, list group -->
                <ul class="list-group list-group-flush" id="listmenu">
                    <?php
                    //untuk mendapatkan sql query 
                    $statment_sql = $cn_mysql->prepare("select*from mst_menus where isactive=1");
                    //untuk mengeksekusi kode sql 
                    $statment_sql->execute();
                    $result = $statment_sql->get_result();
                    while ($d = $result ->fetch_assoc()) {
                        echo '<li class="list-group-item"> <a href='.$d["menu_link"].'> '.$d["menu_name"].'<a></li>';
                    }
                    ?>
                    
                    <li class="list-group-item"><a href="logout.php">LOGOUT</a></li>
                </ul>
            </div>
            <div class="col-md-10 p-4">
                <?php 
                if(!isset($_GET['modul'])){
                ?>
                <h5 id="title"><?php title(); ?>
                <span style="float: right;"> welcome : <?php echo $_SESSION['loginname']; ?></span></h5>
                <hr>
                <h6><i id="subtitle"></i></h6>
                <?php 
                    echo "
                    <ul>
                        <li>Nama Server: ".$_SERVER['SERVER_NAME']."</li>
                        <li>Nama Server: ".$_SERVER['HTTP_HOST']."</li>
                        <li>URL APK: (lengkap)".$_SERVER['REQUEST_URI']."</li>
                        <li>URL APK: (utama)".$_SERVER['PHP_SELF']."</li>
                        <li>Port dari apk web: ".$_SERVER['SERVER_PORT']."</li>
                    </ul>";
                ?>
            </div>
            <?php 
                }
                else{
                    echo'
                    <h5 id="title>"
                        modul: '.title($_GET['modul']).'
                        <span style="float: right;"> welcome : '.$_SESSION['loginname'].'</span>
                    </h5>
                    <hr>
                    ';
                    //untuk menampung  
                    $pagenya = $_GET['modul'].".php";
                    // // untuk menyisipkan 
                    include_once("modul/$pagenya");
                    
                }
            ?>
        </div>
    </div>
    <!-- file js -->
    <!-- bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

<?php 
} else {
    echo "<script>alert('memerlukan login');</script>";
    echo "<meta http-equiv=\"REFRESH\" content=\"0;url=index.php\">";
}
?>