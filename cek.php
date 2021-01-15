<?php
  include('connect.php');
  $max = mysqli_query($connect,"SELECT MAX(no_order) AS max FROM tb_order");
  $data = mysqli_fetch_array($max);
  $kode = $data['max'];

  $no = (int) substr($kode,7,7);
  $no++;
  $char = "ORD";
  $kode = $char.sprintf("%07s",$no);
  echo $kode;
 ?>
