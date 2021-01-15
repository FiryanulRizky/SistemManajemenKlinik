<?php
  include('connect.php');
  $id = $_GET['id'];
  mysqli_query($connect,"DELETE FROM tb_supplier WHERE id_supplier='$id'");
  header("location:data_supplier-a.php");
?>
