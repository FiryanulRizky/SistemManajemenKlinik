<?php
  include('connect.php');
  $id = $_GET['id'];
  mysqli_query($connect,"DELETE FROM tb_pegawai WHERE id_pegawai='$id'");
  header("location:data_pegawai-a.php");
?>
