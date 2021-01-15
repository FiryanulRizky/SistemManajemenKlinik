<?php
  include('connect.php');
  $id = $_GET['id'];
  mysqli_query($connect,"DELETE FROM tb_apoteker WHERE id_apoteker='$id'");
  header("location:data_apoteker-a.php");
?>
