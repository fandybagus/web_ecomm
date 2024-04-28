<?php 
if(!isset($_GET['action'])){

?>
tampil data
<?php
}
else {
    if($_GET['action']=="add"){
        echo "tambah data";
    }
    else{
        echo "ubah data";
    }
?>
tampil form input/edit
<?php
} 
?>