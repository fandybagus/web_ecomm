<?php
/*cara menampilkan code php*/
  //echo "hello word";
/*cara melihat versi php*/
  //phpinfo();
/*cara membuat varabel $nama_toko = "value dari variabel"*/
$nama_toko = "fan's distro"
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>fan's Distro</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="assets/styles.css" />
  </head>
  <body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bgnav" style="color: white !important">
      <div class="container pe-5 ps-5">
        <?php
        //contoh variabel array
        $menu_top = array("HOME", "PRODUCT");
        ?>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fontnav text-white">
          <li class="nav-item">
            <a href="?" class="nav-link"><?php echo $menu_top[0];?></a>
          </li>
          <li class="nav-item">
            <a href="?page=allproduct" class="nav-link"><?php echo $menu_top[1];?></a>
          </li>
        </ul>

        <div class="collapse navbar-collapse text-white" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fontnav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="?page=registrasi">Daftar Member</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- end navbar -->
    <!-- start header banner -->
    <?php
            //jika tidak ada pengiriman variabelpage 
            if(!isset($_GET['page'])){
            
            ?>
    <section id="header">
      <div class="container ps-0">
        <img src="assets/img/banner.jpg" class="banner" />
        <div class="judulbanner">
          <span class="subtitle1"><?php echo $nama_toko; ?></span> <br />
          <span class="subtitle2">Yuk belanjaa...!!!</span>
        </div>
      </div>
    </section>
    <?php
            }
    ?>

    <!-- end header banner -->
    <!-- konten -->
    <section id="konten">
      <div class="container pb-5">
        <div class="row">
          <!-- start left coloum -->
          <?php
            // isset untuk ngecheck apakah variabel ini ditemukan apa tidak 
            //jika ada pengiriman variabel page pada link dan variabel page tidak sama dengan allproduct  
            if(!isset($_GET['page']) || isset($_GET['page']) && ($_GET['page']!='allproduct')){
            ?> 
          <div class="col-md-3 pt-4">
            <div class="kategori-title">Kategori Produk</div>
            <div class="subkategori" id="subkategori">
              <?php 
              //contoh associate array
              $product_list = array(
                array("idkategori"=>1, "nama"=>"sweater", "link"=>"produk kategori"),
                array("idkategori"=>2, "nama"=>"shoes", "link"=>"produk kategori")
              );
              //untuk menampilkan array dengan cara di looping
               foreach($product_list as $l) {
                echo '<li><a href="?page=kategoriproduk">'.$l['nama'].'</a></li>';
               };
              //menampilkan satu blog
              //  var_dump($product_list[0]);
              ?>
            </div>
          </div>
          <?php
            }
          ?>
          <!-- end left , coloum -->
          <!-- start main content -->
          <div class="col-md-9 pt-4">
            <?php
            //jika tidak ada pengiriman variabelpage 
            if(!isset($_GET['page'])){
                //  menyisipkan file eksternal ;
              include_once("main.php");
              // // cara mendapatkan value variabel yg dikirm via link atau URL : $_GET ['namavariabel']
            }
           else{
            //jika ada pengiriman variabel page 
            $pagenya = $_GET['page'].".php";
            include_once($pagenya);
           }
            ?>
          </div>
        </div>
      </div>
    </section>
    <!-- footer -->
    <section id="footer" class="bgnav text-white">
      <div class="container pt-4">
        <div class="row">
          <div class="col-md-4">
            <address class="fw-bold mb-0">Ani's Distro :</address>
            <p class="mb-0">Jalan Merdeka No.101 , Manyar Surabaya</p>
            <p>WA : 081-3393-64971</p>
          </div>
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <address class="fw-bold">Follow us :</address>
            <p>
              <span class="pe-3">@anidistro</span>
              <span class="pe-3">@anidistro</span>
            </p>
          </div>
        </div>
      </div>
    </section>
    <!-- modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Form Login</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="member/login.php" method="post" class="bg-light p-4 m-5">
              <div class="alert alert-danger" role="alert" id="alert" style="display: none"></div>
              <div class="alert alert-success" role="alert" id="alertok" style="display: none"></div>
              <div id="judul" class="mt-3"></div>
              <div class="mb-4">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="logusername" class="form-control" id="logusername" 
                oninvalid="this.setCustomValidity('Username belum diisi')" required
                oninput="setCustomValidity('')" />
              </div>
              <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="logpassword" class="form-control" id="logpassword" 
                oninvalid="this.setCustomValidity('password belum diisi')" required
                oninput="setCustomValidity('')" />
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnbatal" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="button" id="btnkeluar" class="btn btn-primary" onclick="ceklogin()">Login</button>
          </div>
          <?php

            echo '<script>
                function ceklogin() {
                    // Kode JavaScript untuk memvalidasi input dan melakukan submit form
                    // Anda dapat menambahkan validasi tambahan di sini jika diperlukan
                    document.querySelector(\'form\').submit();
                }
            </script>';
          ?>
        </div>
      </div>
    </div>

    <!-- js -->
  </body>
</html>
