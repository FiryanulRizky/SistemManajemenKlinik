<?php
  include('connect.php');
  $no = $_GET['id'];
  mysqli_query($connect,"DELETE FROM tb_rm WHERE no_rm='$no'");
  header("location:data_rm-a.php");
?>
