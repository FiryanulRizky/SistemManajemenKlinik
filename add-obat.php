<?php
	session_start();

	if(empty($_SESSION['username'])){
		header('location:login.php');
	}elseif($_SESSION['level']!=1){
		header('location:index-p.php');
	}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/data-p_add_style.css">
    <title>SMKlinik | Tambah Obat</title>
  </head>
  <body>
    <header>
      <div class="container">
        <div id="logo">
          <img src="./img/ini_logo.png" alt="Logo">
          <a href="index-a.php"><span class="hightlight">Klinik</span> Cahaya</a>
        </div>

        <div id="profil">
          <img src="./img/pp.png" alt="Profil">
          <h4>ADMIN</h4>
        </div>
      </div>
    </header>

    <section id="add-data">
      <div class="container">
        <div class="title">
          <h2>Tambah Data</h2>
        </div>
        <div class="report">
          <form class="add" action="" method="post">
            <table>
              <tr></tr>
              <tr>
                <td>No. Obat</td>
                <td><input type="text" name="no" placeholder="&nbsp;Masukkan No"></td>
              </tr>
              <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" placeholder="&nbsp;Masukkan Nama"></td>
              </tr>
              <tr>
                <td>Deskripsi</td>
                <td><input type="text" style="height:30px" name="desc" placeholder="&nbsp;Masukkan Deskripsi"></td>
              </tr>
              <tr>
                <td>Stok</td>
                <td><input type="text" name="stok" placeholder="&nbsp;Masukkan Stok"></td>
              </tr>
							<tr>
                <td>Harga</td>
                <td><input type="text" name="harga" placeholder="&nbsp;Masukkan Harga"></td>
              </tr>
            </table>
            <div class="button">
              <input type="submit" name="addbutton" value="Tambah">
              <a href="data_obat-a.php"><button type="button" name="back">Kembali</button></a>
            </div>
          </form>

					<?php
					  include('connect.php');

					  if(isset($_POST['addbutton'])){
					    $no = $_POST['no'];
					    $nama = $_POST['nama'];
					    $des = $_POST['desc'];
					    $stok = $_POST['stok'];
					    $harga = $_POST['harga'];

					    mysqli_query($connect,"INSERT INTO `tb_obat`(`no_obat`, `nama`, `stok`, `harga`, `deskripsi`) VALUES ('$no','$nama','$stok','$harga','$des')");

					    header('location:data_obat-a.php');
					  }
					 ?>

        </div>
      </div>
    </section>

    <footer>
      <div class="container">
        <p>Klinik Cahaya || Copyright &copy; 2019</p>
      </div>
    </footer>

  </body>
</html>
