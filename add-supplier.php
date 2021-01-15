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
    <title>SMKlinik | Tambah Supplier</title>
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
                <td>ID Supplier</td>
                <td><input type="text" name="id" placeholder="&nbsp;Masukkan ID"></td>
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
                <td>No. Telepon</td>
                <td><input type="text" name="telp" placeholder="&nbsp;Masukkan No Telp"></td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td><input type="text" style="height:40px" name="alamat" placeholder="&nbsp;Masukkan Alamat"></td>
              </tr>
							<tr>
                <td>Kota</td>
                <td><input type="text" name="kota" placeholder="&nbsp;Masukkan Kota"></td>
              </tr>
            </table>
            <div class="button">
              <input type="submit" name="addbutton" value="Tambah">
              <a href="data_supplier-a.php"><button type="button" name="back">Kembali</button></a>
            </div>
          </form>

					<?php
					  include('connect.php');

					  if(isset($_POST['addbutton'])){
					    $id = $_POST['id'];
					    $nama = $_POST['nama'];
					    $kota = $_POST['kota'];
					    $telp = $_POST['telp'];
					    $alamat = $_POST['alamat'];
					    $des = $_POST['desc'];

					    mysqli_query($connect,"INSERT INTO `tb_supplier`(`id_supplier`, `nama`, `deskripsi`, `telp`, `alamat`, `kota`) VALUES ('$id','$nama','$des','$telp','$alamat','$kota')");

					    header('location:data_supplier-a.php');
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
