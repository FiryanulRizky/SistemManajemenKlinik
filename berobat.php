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
			$no = $_POST['no'];
			$jumlah = $_POST['jumlah'];
			if($_POST['barang']=='bahan'){
				mysqli_query($connect,"INSERT INTO `bahan_detail`(`no_bahan`, `jumlah`) VALUES ('$no','$jumlah')");
			}elseif($_POST['barang']=='obat'){
				mysqli_query($connect,"INSERT INTO `obat_detail`(`no_obat`, `jumlah`) VALUES ('$no','$jumlah')");
			}elseif($_POST['barang']=='adminis'){
				mysqli_query($connect,"INSERT INTO `adminis_detail`(`no_administrasi`, `jumlah`) VALUES ('$no','$jumlah')");
			}
		}
	}
	function deleteo($connect){
		if(isset($_GET['id'])){
			$no = $_GET['id'];
			mysqli_query($connect,"DELETE FROM obat_detail WHERE `no_obat`='$no'");
			header('location:berobat.php');
		}
	}
	function deleteb($connect){
		if(isset($_GET['id'])){
			$no = $_GET['id'];
			mysqli_query($connect,"DELETE FROM bahan_detail WHERE `no_bahan`='$no'");
			header('location:berobat.php');
		}
	}
	function deletea($connect){
		if(isset($_GET['id'])){
			$no = $_GET['id'];
			mysqli_query($connect,"DELETE FROM adminis_detail WHERE `no_administrasi`='$no'");
			header('location:berobat.php');
		}
	}

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/data-ad2_style.css">
    <title>SMKlinik | Berobat</title>
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
          <h2>Berobat</h2>
        </div>
        <div class="button">

				 <?php
					 include('connect.php');
					 if(isset($_GET['aksi'])){
						 if($_GET['aksi'] == 'deleteb'){
							 		deleteb($connect);
						 }elseif($_GET['aksi'] == 'deleteo'){
							 		deleteo($connect);
						 }elseif($_GET['aksi'] == 'deletea'){
							 		deletea($connect);
						 }
					 }else{
						 ?>
						 <form class="add" action="" method="post">
							 <select class="jk" name="barang">
								<option value="adminis">Administrasi</option>
							 	<option value="bahan">Bahan</option>
								<option value="obat">Obat</option>
							 </select>
	           	<input type="text" name="no" placeholder="&nbsp;Nomor ID">
	 						<input style="width:90px;" type="text" name="jumlah" placeholder="&nbsp;Jumlah">
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
              <th>ID</th>
              <th>Nama</th>
              <th>Jumlah</th>
							<th>Harga</th>
              <th>Opsi</th>
            </tr>
						<?php
							$total = 0;
						 ?>
            <?php
              include('connect.php');
							$cari = empty($_POST['cariB']) ? '' : $_POST['cariB'];
							$inputan = empty($_POST['cari']) ? '' : $_POST['cari'];
							if (isset($cari)) {
								if ($inputan != "") {
									$sql = mysqli_query($connect,"SELECT * FROM obat_detail AS od INNER JOIN tb_obat USING(no_obat)  WHERE nama like '%$inputan%'");
								}else{
									$sql = mysqli_query($connect,"SELECT * FROM obat_detail AS od INNER JOIN tb_obat USING(no_obat)");
								}
							}else{
									$sql = mysqli_query($connect,"SELECT * FROM obat_detail AS od INNER JOIN tb_obat USING(no_obat)");
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
									<?php $total+=($data['jumlah']*$data['harga']) ?>
                  <a class="hapus" href="berobat.php?aksi=deleteo&id=<?php echo $data['no_obat']; ?>">Hapus</a>
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
										$sql = mysqli_query($connect,"SELECT * FROM bahan_detail AS od INNER JOIN tb_bahan USING(no_bahan)  WHERE nama like '%$inputan%'");
									}else{
										$sql = mysqli_query($connect,"SELECT * FROM bahan_detail AS od INNER JOIN tb_bahan USING(no_bahan)");
									}
								}else{
										$sql = mysqli_query($connect,"SELECT * FROM bahan_detail AS od INNER JOIN tb_bahan USING(no_bahan)");
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
										<?php $total+=($data['jumlah']*$data['harga']) ?>
	                  <a class="hapus" href="berobat.php?aksi=deleteb&id=<?php echo $data['no_bahan']; ?>">Hapus</a>
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
									 $sql = mysqli_query($connect,"SELECT * FROM adminis_detail AS od INNER JOIN tb_administrasi USING(no_administrasi)  WHERE nama like '%$inputan%'");
								 }else{
									 $sql = mysqli_query($connect,"SELECT * FROM adminis_detail AS od INNER JOIN tb_administrasi USING(no_administrasi)");
								 }
							 }else{
									 $sql = mysqli_query($connect,"SELECT * FROM adminis_detail AS od INNER JOIN tb_administrasi USING(no_administrasi)");
							 }

							 $no = 1;
							 while ($data = mysqli_fetch_array($sql)) {
							 ?>
							 <tr>
								 <td><?php echo $no++; ?></td>
								 <td><?php echo $data['no_administrasi']; ?></td>
								 <td><?php echo $data['nama']; ?></td>
								 <td><?php echo $data['jumlah']; ?></td>
								 <td><?php echo $data['biaya']; ?></td>
								 <td>
									 <?php $total+=($data['jumlah']*$data['biaya']) ?>
									 <a class="hapus" href="berobat.php?aksi=deletea&id=<?php echo $data['no_administrasi']; ?>">Hapus</a>
								 </td>
							 </tr>
					 <?php  }
						?>
          </table>
        </div>
				<div class="search" action="" method="post">
					<input class="submit" type="submit" name="ttl" value="Total">
					<input class="text" type="text" name="cari" value="<?php echo $total ?>">
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
