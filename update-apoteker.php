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
    <title>SMKlinik | Edit Apoteker</title>
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

						$id = $_GET['id'];

						$sql = mysqli_query($connect,"SELECT * FROM tb_apoteker WHERE id_apoteker = '$id' ");
						$data = mysqli_fetch_array($sql);
					 ?>
          <form class="add" action="" method="post">
            <table>
              <tr><td><input type="text" name="id" value="<?php echo $data['id_apoteker'] ?>" hidden=hidden></td></tr>
              <tr>
                <td>ID Apoteker</td>
                <td><input type="text" name="id" value="<?php echo $data['id_apoteker'] ?>" disabled=disabled></td>
              </tr>
              <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" value="<?php echo $data['nama'] ?>"></td>
              </tr>
              <tr>
                <td>Jenis Kelamin</td>
                <td>
                  <select class="jk" name="jenisk">
                    <option <?php if($data['jenis_kelamin']=="Laki-Laki") echo "selected" ?> value="Laki-Laki">Laki-Laki</option>
                    <option <?php if($data['jenis_kelamin']=="Perempuan") echo "selected" ?> value="Perempuan">Perempuan</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>No. Telepon</td>
                <td><input type="text" name="telp" value="<?php echo $data['telp'] ?>"></td>
              </tr>
              <tr>
                <td>Email</td>
                <td><input type="text" name="email" value="<?php echo $data['email'] ?>"></td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td><input type="text" style="height:40px" name="alamat" value="<?php echo $data['alamat'] ?>"></td>
              </tr>
            </table>
            <div class="button">
              <input type="submit" name="upbutton" value="Edit">
              <a href="data_apoteker-a.php"><button type="button" name="back">Kembali</button></a>
            </div>
          </form>

					<?php
						if(isset($_POST['upbutton'])){
							include('connect.php');

							$nama = $_POST['nama'];
							$email = $_POST['email'];
							$telp = $_POST['telp'];
							$alamat = $_POST['alamat'];
							$jenis_kelamin = $_POST['jenisk'];

							mysqli_query($connect,"UPDATE tb_apoteker SET nama = '$nama', jenis_kelamin='$jenis_kelamin', email='$email', telp='$telp', alamat='$alamat' WHERE id_apoteker = '$id'");

							header('location:data_apoteker-a.php');
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
