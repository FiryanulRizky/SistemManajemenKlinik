<?php
  include('connect.php');
  $no = $_GET['id'];
  mysqli_query($connect,"DELETE FROM tb_bahan WHERE no_bahan='$no'");
  header("location:data_bahan-a.php");
?>
