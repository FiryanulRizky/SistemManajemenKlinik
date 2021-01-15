<?php
  include('connect.php');
  $id = $_GET['id'];
  mysqli_query($connect,"DELETE FROM tb_dokter WHERE id_dokter='$id'");
  header("location:data_dokter-a.php");
?>
