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
    <link rel="stylesheet" href="./css/data-ad_style.css">
    <title>SMKlinik | Rekam Medis</title>
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

    <section id="sidemenu">
      <div class="container">
        <ul>
          <li class="main">Data
            <ul>
              <li><a href="data_pasien-a.php">Data Pasien</a></li>
              <li><a href="data_dokter-a.php">Data Dokter</a></li>
              <li><a href="data_pegawai-a.php">Data Pegawai</a></li>
              <li><a href="data_apoteker-a.php">Data Apoteker</a></li>
              <li><a href="data_bahan-a.php">Data Bahan</a></li>
              <li><a href="data_obat-a.php">Data Obat</a></li>
              <li><a href="data_supplier-a.php">Data Supplier</a></li>
            </ul>
          </li>
          <li class="main"><a href="data_rm-a.php">Rekam Medis</a></li>
					<li class="main">Biaya
            <ul>
              <li><a href="data_administrasi-a.php">Administrasi</a></li>
              <li><a href="berobat.php">Berobat</a></li>
            </ul>
          </li>
          <li class="main"><a href="data_order-a.php">Order</a></li>
          <li id="logout"><a href="logout-action.php">Logout</a></li>
        </ul>
      </div>
    </section>

    <section id="content">
      <div class="container">
        <div class="title">
          <h2>Rekam Medis</h2>
        </div>
        <div class="button">
          <a href="add-rm.php"><button type="button" name="tambah">Tambah</button></a>
					<form class="search" action="" method="post">
						<input class="submit" type="submit" name="cariB" value="Cari">
	          <input class="text" type="text" name="cari" placeholder="&nbsp;Masukkan Nama">
					</form>
        </div>
        <br>
        <div class="table">
          <table border=1px>
            <tr>
              <th>No.</th>
              <th>No RM</th>
              <th>Nama Pasien</th>
              <th>Keluhan</th>
              <th>Diagnosa</th>
							<th>Alergi</th>
              <th>Opsi</th>
            </tr>
            <?php
              include('connect.php');
							$cari = empty($_POST['cariB']) ? '' : $_POST['cariB'];
							$inputan = empty($_POST['cari']) ? '' : $_POST['cari'];
							if (isset($cari)) {
								if ($inputan != "") {
									$sql = mysqli_query($connect,"SELECT * FROM tb_rm INNER JOIN tb_pasien USING(nik) WHERE nama like '%$inputan%'");
								}else{
									$sql = mysqli_query($connect,"SELECT * FROM tb_rm INNER JOIN tb_pasien USING(nik)");
								}
							}else{
									$sql = mysqli_query($connect,"SELECT * FROM tb_rm INNER JOIN tb_pasien USING(nik)");
							}

              $no = 1;
              while ($data = mysqli_fetch_array($sql)) {
              ?>
              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['no_rm']; ?></td>
                <td><?php echo $data['nama']; ?></td>
                <td><?php echo $data['keluhan']; ?></td>
                <td><?php echo $data['diagnosa']; ?></td>
                <td><?php echo $data['alergi']; ?></td>
                <td>
                  <a class="edit" href="update-rm.php?id=<?php echo $data['no_rm'] ?>">Edit</a> |
                  <a class="hapus" href="delete-rm.php?id=<?php echo $data['no_rm'] ?>">Hapus</a>
                </td>
              </tr>
            <?php  }
             ?>
          </table>
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
