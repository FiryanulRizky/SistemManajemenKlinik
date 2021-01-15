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
    <title>SMKlinik | Edit Bahan</title>
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
          <h2>Edit Data</h2>
        </div>
        <div class="report">
					<?php
						include 'connect.php';

						$no = $_GET['id'];

						$sql = mysqli_query($connect,"SELECT * FROM tb_bahan WHERE no_bahan = '$no' ");
						$data = mysqli_fetch_array($sql);
					 ?>
          <form class="add" action="" method="post">
            <table>
              <tr><td><input type="text" name="no" value="<?php echo $data['no_bahan'] ?>" hidden=hidden></td></tr>
              <tr>
                <td>No. Bahan</td>
                <td><input type="text" name="no" value="<?php echo $data['no_bahan'] ?>" disabled=disabled></td>
              </tr>
              <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" value="<?php echo $data['nama'] ?>"></td>
              </tr>
              <tr>
                <td>Deskripsi</td>
                <td><input type="text" style="height:30px" name="desc" value="<?php echo $data['deskripsi'] ?>"></td>
              </tr>
              <tr>
                <td>Stok</td>
                <td><input type="text" name="stok" value="<?php echo $data['stok'] ?>"></td>
              </tr>
              <tr>
                <td>Harga</td>
                <td><input type="text" name="harga" value="<?php echo $data['harga'] ?>"></td>
              </tr>
            </table>
            <div class="button">
              <input type="submit" name="upbutton" value="Edit">
              <a href="data_bahan-a.php"><button type="button" name="back">Kembali</button></a>
            </div>
          </form>

					<?php
						if(isset($_POST['upbutton'])){
							include('connect.php');

							$nama = $_POST['nama'];
							$stok = $_POST['stok'];
							$harga = $_POST['harga'];
							$des = $_POST['desc'];

							mysqli_query($connect,"UPDATE tb_bahan SET nama = '$nama', deskripsi='$des', stok='$stok', harga='$harga' WHERE no_bahan = '$no'");

							header('location:data_bahan-a.php');
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
