<?php
  include('connect.php');
  $no = $_GET['id'];
  mysqli_query($connect,"DELETE FROM tb_obat WHERE no_obat='$no'");
  header("location:data_obat-a.php");
?>
