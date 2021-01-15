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
    <title>SMKlinik | Tambah Dokter</title>
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
                <td>ID Dokter</td>
                <td><input type="text" name="id" placeholder="&nbsp;Masukkan ID"></td>
              </tr>
              <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" placeholder="&nbsp;Masukkan Nama"></td>
              </tr>
              <tr>
                <td>Jenis Kelamin</td>
                <td>
                  <select class="jk" name="jenisk">
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>No. Telepon</td>
                <td><input type="text" name="telp" placeholder="&nbsp;Masukkan No Telp"></td>
              </tr>
							<tr>
                <td>Email</td>
                <td><input type="text" name="email" placeholder="&nbsp;Masukkan Email"></td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td><input type="text" style="height:40px" name="alamat" placeholder="&nbsp;Masukkan Alamat"></td>
              </tr>
							<tr>
                <td>Spesialis</td>
                <td>
                  <select class="jk" name="spesial">
                    <?php
											include('connect.php');
											$sql = mysqli_query($connect,"SELECT * FROM `tb_spesialis`");
											while ($data = mysqli_fetch_array($sql)){
												?>
												<option value="<?php echo $data['id_spesialis']; ?>"> <?php echo $data['nama_spesial']; ?> </option>
											<?php
											}
										 ?>
                  </select>
                </td>
              </tr>
							<tr>
                <td>Praktek</td>
                <td>
                  <select class="jk" name="praktek">
                    <?php
											include('connect.php');
											$sql = mysqli_query($connect,"SELECT * FROM `tb_praktek`");
											while ($data = mysqli_fetch_array($sql)){
												?>
												<option value="<?php echo $data['no_praktek']; ?>"> <?php echo $data['hari']; ?> | <?php echo $data['jam']; ?> </option>
											<?php
											}
										 ?>
                  </select>
                </td>
              </tr>
            </table>
            <div class="button">
              <input type="submit" name="addbutton" value="Tambah">
              <a href="data_dokter-a.php"><button type="button" name="back">Kembali</button></a>
            </div>
          </form>

					<?php
					  include('connect.php');

					  if(isset($_POST['addbutton'])){
					    $id = $_POST['id'];
					    $nama = $_POST['nama'];
					    $jk = $_POST['jenisk'];
					    $telp = $_POST['telp'];
					    $email = $_POST['email'];
					    $alamat = $_POST['alamat'];
					    $id_sp = $_POST['spesial'];
							$id_pr = $_POST['praktek'];


					    mysqli_query($connect,"INSERT INTO `tb_dokter`(`id_dokter`, `nama`, `jenis_kelamin`, `telp`, `email`, `alamat`, `id_spesialis`, `no_praktek`) VALUES ('$id','$nama','$jk','$telp','$email','$alamat','$id_sp','$id_pr');");

					    header('location:data_dokter-a.php');
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
