<?php
	session_start();

	if(empty($_SESSION['username'])){
		header('location:login.php');
	}elseif($_SESSION['level']!=1){
		header('location:index-p.php');
	}
?>

<?php
	include('connect.php');
	function tambah($connect){
		if (isset($_POST['tmbh'])){
			$id = $_GET['id'];
			$no = $_POST['no'];
			$jumlah = $_POST['jumlah'];
			$harga = $_POST['harga'];
			if($_POST['barang']=='bahan'){
				mysqli_query($connect,"INSERT INTO `orderbahan_detail`(`no_order`, `no_bahan`, `harga`, `jumlah`) VALUES ('$id','$no','$harga','$jumlah')");
			}elseif($_POST['barang']=='obat'){
				mysqli_query($connect,"INSERT INTO `orderobat_detail`(`no_order`, `no_obat`, `harga`, `jumlah`) VALUES ('$id','$no','$harga','$jumlah')");
				}
		}
	}
	function deleteo($connect){
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$no = $_GET['no'];
			mysqli_query($connect,"DELETE FROM orderobat_detail WHERE `no_obat`='$id'");
			header('location:data_order-a.php');
		}
	}
	function deleteb($connect){
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$no = $_GET['no'];
			mysqli_query($connect,"DELETE FROM orderbahan_detail WHERE `no_bahan`='$id'");
			header('location:data_order-a.php');
		}
	}

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/data-ad_style.css">
    <title>SMKlinik | Administrasi</title>
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
          <h2>Order Detail</h2>
        </div>
        <div class="button">

				 <?php
					 include('connect.php');
					 if(isset($_GET['aksi'])){
						 if($_GET['aksi'] == 'deleteb'){
							 		deleteb($connect);
						 }elseif($_GET['aksi'] == 'deleteo'){
							 		deleteo($connect);
						 }
					 }else{
						 ?>
						 <form class="add" action="" method="post">
							 <select class="jk" name="barang">
							 	<option value="bahan">Bahan</option>
								<option value="obat">Obat</option>
							 </select>
	           	<input type="text" name="no" placeholder="&nbsp;Nomor Barang">
	 						<input style="width:90px;" type="text" name="jumlah" placeholder="&nbsp;Jumlah">
	 						<input style="width:90px;" type="text" name="harga" placeholder="&nbsp;Harga">
	 						<input class="submit" style="width:40px;" type="submit" name="tmbh" value="+">
	           </form>
						 <?php
						 tambah($connect);
					 }
				 ?>

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
              <th>No. Barang</th>
              <th>Nama</th>
              <th>Jumlah</th>
							<th>Harga</th>
              <th>Opsi</th>
            </tr>
            <?php
              include('connect.php');
							$cari = empty($_POST['cariB']) ? '' : $_POST['cariB'];
							$inputan = empty($_POST['cari']) ? '' : $_POST['cari'];
							if (isset($cari)) {
								if ($inputan != "") {
									$sql = mysqli_query($connect,"SELECT * FROM orderobat_detail AS od INNER JOIN tb_obat USING(no_obat)  WHERE nama like '%$inputan%'");
								}else{
									$sql = mysqli_query($connect,"SELECT * FROM orderobat_detail AS od INNER JOIN tb_obat USING(no_obat)");
								}
							}else{
									$sql = mysqli_query($connect,"SELECT * FROM orderobat_detail AS od INNER JOIN tb_obat USING(no_obat)");
							}

              $no = 1;
              while ($data = mysqli_fetch_array($sql)) {
              ?>
              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['no_obat']; ?></td>
                <td><?php echo $data['nama']; ?></td>
                <td><?php echo $data['jumlah']; ?></td>
								<td><?php echo $data['harga']; ?></td>
                <td>
                  <a class="hapus" href="detail_order.php?aksi=deleteo&id=<?php echo $data['no_obat']; ?>&no=<?php echo $data['no_order']; ?>">Hapus</a>
                </td>
              </tr>
							<?php  }
							 ?>
							<?php
	              include('connect.php');
								$cari = empty($_POST['cariB']) ? '' : $_POST['cariB'];
								$inputan = empty($_POST['cari']) ? '' : $_POST['cari'];
								if (isset($cari)) {
									if ($inputan != "") {
										$sql = mysqli_query($connect,"SELECT * FROM orderbahan_detail AS od INNER JOIN tb_bahan USING(no_bahan)  WHERE nama like '%$inputan%'");
									}else{
										$sql = mysqli_query($connect,"SELECT * FROM orderbahan_detail AS od INNER JOIN tb_bahan USING(no_bahan)");
									}
								}else{
										$sql = mysqli_query($connect,"SELECT * FROM orderbahan_detail AS od INNER JOIN tb_bahan USING(no_bahan)");
								}

	              $no = 1;
	              while ($data = mysqli_fetch_array($sql)) {
	              ?>
								<tr>
	                <td><?php echo $no++; ?></td>
	                <td><?php echo $data['no_bahan']; ?></td>
	                <td><?php echo $data['nama']; ?></td>
	                <td><?php echo $data['jumlah']; ?></td>
									<td><?php echo $data['harga']; ?></td>
	                <td>
	                  <a class="hapus" href="detail_order.php?aksi=deleteb&id=<?php echo $data['no_bahan']; ?>&no=<?php echo $data['no_order']; ?>">Hapus</a>
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
