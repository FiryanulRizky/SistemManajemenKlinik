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
    <link rel="stylesheet" href="./css/data-pw_add_style.css">
    <title>SMKlinik | Edit Pegawai</title>
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

						$sql = mysqli_query($connect,"SELECT * FROM tb_pegawai WHERE id_pegawai = '$id' ");
						$data = mysqli_fetch_array($sql);
					 ?>
          <form class="add" action="" method="post">
            <table>
              <tr><td><input type="text" name="id" value="<?php echo $data['id_pegawai'] ?>" hidden=hidden></td></tr>
              <tr>
                <td>ID Pegawai</td>
                <td><input type="text" name="id" value="<?php echo $data['id_pegawai'] ?>" disabled=disabled></td>
              </tr>
              <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" value="<?php echo $data['nama'] ?>"></td>
              </tr>
                <td>Jenis Kelamin</td>
                <td>
                  <select class="jk" name="jenisk">
										<option <?php if($data['jenis_kelamin']=="Laki-Laki") echo "selected" ?> value="Laki-Laki">Laki-Laki</option>
                    <option <?php if($data['jenis_kelamin']=="Perempuan") echo "selected" ?> value="Perempuan">Perempuan</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>Email</td>
                <td><input type="text" name="email" value="<?php echo $data['email'] ?>"></td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td><input type="text" style="height:40px" name="alamat" value="<?php echo $data['alamat'] ?>"></td>
              </tr>
							<tr>
                <td>Username</td>
                <td><input type="text" name="username" value="<?php echo $data['user_pegawai'] ?>"></td>
              </tr>
							<tr>
                <td>Password</td>
                <td><input type="text" name="password" value="<?php echo $data['pass_pegawai'] ?>"></td>
              </tr>
							<tr>
                <td>Level</td>
                <td><input type="text" name="level" value="<?php echo $data['level_pegawai'] ?>"></td>
              </tr>
            </table>
            <div class="button">
              <input type="submit" name="upbutton" value="Edit">
              <a href="data_pegawai-a.php"><button type="button" name="back">Kembali</button></a>
            </div>
          </form>

					<?php
					  include('connect.php');

					  if(isset($_POST['upbutton'])){

					    $nama = $_POST['nama'];
					    $jk = $_POST['jenisk'];
							$email = $_POST['email'];
					    $alamat = $_POST['alamat'];
							$user_p = $_POST['username'];
							$pass_p = $_POST['password'];
							$level = $_POST['level'];

					    mysqli_query($connect,"UPDATE `tb_pegawai` SET `nama`='$nama',`jenis_kelamin`='$jk',`email`='$email',`alamat`='$alamat',`user_pegawai`='$user_p',`pass_pegawai`='$pass_p',`level_pegawai`='$level' WHERE `id_pegawai`='$id'");

					    header('location:data_pegawai-a.php');
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
