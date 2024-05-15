<?php 
if(!isset($_GET['action'])){

?>
tampil data
<?php
}
else {
    if($_GET['action']=="add"){
        $process ="add"; //variabel ini digunakan untuk membedakan ketika memprocess data baik simpan data 

    }
    else{
        $process ="edit"; //variabel ini digunakan untuk membedakan ketika memprocess data baik simpan data 

    }
?>
tampil form input/edit
<?php
} 
?>