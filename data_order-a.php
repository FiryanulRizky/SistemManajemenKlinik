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
    <link rel="stylesheet" href="./css/data-c_style.css">
    <title>SMKlinik | Order Detail</title>
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
          <h2>Order List</h2>
        </div>
        <div class="button">
          <a href="add-order.php"><button type="button" name="tambah">Tambah</button></a>
					<form class="search" action="" method="post">
						<input class="submit" type="submit" name="cariB" value="Cari">
	          <input class="text" type="text" name="cari" placeholder="&nbsp;Masukkan Supplier">
					</form>
        </div>
        <br>
        <div class="table">
          <table border=1px>
            <tr>
              <th>No.</th>
              <th>No. Order</th>
              <th>Tanggal Order</th>
              <th>Supplier</th>
              <th>Opsi</th>
            </tr>
            <?php
              include('connect.php');
							$cari = empty($_POST['cariB']) ? '' : $_POST['cariB'];
							$inputan = empty($_POST['cari']) ? '' : $_POST['cari'];
							if (isset($cari)) {
								if ($inputan != "") {
									$sql = mysqli_query($connect,"SELECT o.`no_order`,o.`tgl_order`,s.nama  FROM tb_supplier AS s  INNER JOIN `tb_order`AS o USING(id_supplier) WHERE s.nama like '%$inputan%'");
								}else{
									$sql = mysqli_query($connect,"SELECT o.`no_order`,o.`tgl_order`,s.nama  FROM tb_supplier AS s  INNER JOIN `tb_order`AS o USING(id_supplier)");
								}
							}else{
									$sql = mysqli_query($connect,"SELECT o.`no_order`,o.`tgl_order`,s.nama  FROM tb_supplier AS s  INNER JOIN `tb_order`AS o USING(id_supplier)");
							}

              $no = 1;
              while ($data = mysqli_fetch_array($sql)) {
              ?>
              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['no_order']; ?></td>
                <td><?php echo $data['tgl_order']; ?></td>
                <td><?php echo $data['nama']; ?></td>
                <td>
                  <a class="edit" href="detail_order.php?id=<?php echo $data['no_order'] ?>">Details</a>
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
