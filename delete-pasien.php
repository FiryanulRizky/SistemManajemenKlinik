<?php
  include('connect.php');
  $nik = $_GET['id'];
  mysqli_query($connect,"DELETE FROM tb_pasien WHERE nik='$nik'");
  header("location:data_pasien-a.php");
?>
