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
    <title>SMKlinik | Edit RM</title>
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

						$sql = mysqli_query($connect,"SELECT * FROM `tb_rm` WHERE no_rm = '$no' ");
						$data = mysqli_fetch_array($sql);
					 ?>
					 <form class="add" action="" method="post">
             <table>
               <tr><td><input type="text" name="no" value="<?php echo $data['no_rm'] ?>" hidden=hidden></td></tr>
               <tr>
                 <td>No RM</td>
                 <td><input type="text" name="no" value="<?php echo $data['no_rm'] ?>" disabled=disabled></td>
               </tr>
               <tr>
                 <td>Keluhan</td>
                 <td><input type="text" name="keluh" value="<?php echo $data['keluhan'] ?>"></td>
               </tr>
 							<tr>
                 <td>Diagnosa</td>
                 <td><input type="text" name="diag" value="<?php echo $data['diagnosa'] ?>"></td>
               </tr>
 							<tr>
                 <td>Alergi</td>
                 <td><input type="text" name="alergi" value="<?php echo $data['alergi'] ?>"></td>
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
             </table>
             <div class="button">
               <input type="submit" name="upbutton" value="Edit">
               <a href="data_rm-a.php"><button type="button" name="back">Kembali</button></a>
             </div>
           </form>
					<?php
						if(isset($_POST['upbutton'])){
							include('connect.php');

							$no = $_POST['no'];
							$nik = $_POST['nik'];
							$keluh = $_POST['keluh'];
							$diax = $_POST['diag'];
							$aler = $_POST['alergi'];

							mysqli_query($connect,"UPDATE `tb_rm` SET `nik`='$nik',`keluhan`='$keluh',`diagnosa`='$diax',`alergi`='$aler' WHERE `no_rm`='$no'");

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
