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
    <title>SMKlinik | Tambah RM</title>
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
                <td>No RM</td>
                <td><input type="text" name="no" placeholder="&nbsp;Masukkan No RM"></td>
              </tr>
              <tr>
                <td>Nama Pasien</td>
								<td>
                  <select class="jk" name="pasien">
                    <?php
											include('connect.php');
											$sql = mysqli_query($connect,"SELECT * FROM `tb_pasien`");
											while ($data = mysqli_fetch_array($sql)){
												?>
												<option value="<?php echo $data['nik']; ?>"> <?php echo $data['nama']; ?> </option>
											<?php
											}
										 ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td>Keluhan</td>
                <td><input type="text" name="keluh" placeholder="&nbsp;Masukkan Keluhan"></td>
              </tr>
							<tr>
                <td>Diagnosa</td>
                <td><input type="text" name="diag" placeholder="&nbsp;Masukkan Diagnosa"></td>
              </tr>
							<tr>
                <td>Alergi</td>
                <td><input type="text" name="alergi" placeholder="&nbsp;Masukkan Alergi"></td>
              </tr>
            </table>
            <div class="button">
              <input type="submit" name="addbutton" value="Tambah">
              <a href="data_rm-a.php"><button type="button" name="back">Kembali</button></a>
            </div>
          </form>

					<?php
					  include('connect.php');

					  if(isset($_POST['addbutton'])){
					    $no = $_POST['no'];
							$nik = $_POST['nik'];
							$keluh = $_POST['keluh'];
							$diax = $_POST['diag'];
							$aler = $_POST['alergi'];


					    mysqli_query($connect,"INSERT INTO `tb_rm`(`no_rm`, `nik`, `keluhan`, `diagnosa`, `alergi`) VALUES ('$no','$nik','$keluh','$diax','$aler');");

					    header('location:data_rm-a.php');
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
