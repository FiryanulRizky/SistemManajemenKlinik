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
    <title>SMKlinik | Ordering</title>
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
                <td>No. Order</td>
								<?php
									  include('connect.php');
									  $max = mysqli_query($connect,"SELECT MAX(no_order) AS max FROM tb_order");
									  $data = mysqli_fetch_array($max);
									  $kode = $data['max'];

									  $no = (int) substr($kode,7,7);
									  $no++;
									  $char = "ORD";
									  $kode = $char.sprintf("%07s",$no);
								 ?>
                <td><input type="text" name="no" value="<?php echo $kode ?>"></td>
              </tr>
              <tr>
								<td>Tanggal Order [yyyy-mm-dd]</td>
								<?php $tgl = date('Y-m-d') ?>
                <td><input type="text" name="tgl" value="<?php echo $tgl?>"></td>
              </tr>
              <tr>
                <td>Supplier</td>
                <td>
                  <select class="jk" name="supplier">
                    <?php
											include('connect.php');
											$sql = mysqli_query($connect,"SELECT * FROM `tb_supplier`");
											while ($data = mysqli_fetch_array($sql)){
												?>
												<option value="<?php echo $data['id_supplier']; ?>"> <?php echo $data['nama']; ?> </option>
											<?php
											}
										 ?>
                  </select>
                </td>
              </tr>
            </table>
            <div class="button">
              <input type="submit" name="addbutton" value="Tambah">
              <a href="data_order-a.php"><button type="button" name="back">Kembali</button></a>
            </div>
          </form>

					<?php
					  include('connect.php');

					  if(isset($_POST['addbutton'])){
					    $no = $_POST['no'];
					    $tgl = $_POST['tgl'];
					    $sup = $_POST['supplier'];

					    mysqli_query($connect,"INSERT INTO `tb_order`(`no_order`, `tgl_order`, `id_supplier`) VALUES ('$no','$tgl','$sup')");

					    header('location:data_order-a.php');
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
