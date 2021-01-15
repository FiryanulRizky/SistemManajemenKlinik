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
				$no = $_POST['no_adminis'];
				$nama = $_POST['nama_adminis'];
				$biaya = $_POST['biaya_adminis'];

				if(!empty($no) && !empty($nama) && !empty($biaya)){
						mysqli_query($connect,"INSERT INTO `tb_administrasi`(`no_administrasi`, `nama`, `biaya`) VALUES ('$no','$nama','$biaya')");
				}
		}
	}
	function update($connect){
		if(isset($_GET['id'])){
			?>
			<form class="add" action="" method="post">
			 <input style="width:90px;" type="text" name="no_adminis" value="<?php echo $_GET['id']; ?>">
			 <input type="text" name="nama_adminis" value="<?php echo $_GET['nama']; ?>">
			 <input style="width:90px;" type="text" name="biaya_adminis" value="<?php echo $_GET['biaya']; ?>">
			 <input class="submit" style="width:40px;" type="submit" name="tmbh" value="+">
			</form>
			<?php
			if(isset($_POST['tmbh'])){
				$no = $_POST['no_adminis'];
				$nama = $_POST['nama_adminis'];
				$biaya = $_POST['biaya_adminis'];

				mysqli_query($connect,"UPDATE tb_administrasi SET nama='$nama', biaya='$biaya' WHERE no_administrasi='$no'");
				header('location:data_administrasi-a.php');
			}
		}
	}
	function delete($connect){
		if(isset($_GET['id'])){
			$no = $_GET['id'];
			mysqli_query($connect,"DELETE FROM tb_administrasi WHERE no_administrasi='$no'");
			header('location:data_administrasi-a.php');
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
          <h2>Administrasi</h2>
        </div>
        <div class="button">

				 <?php
					 include('connect.php');
					 if(isset($_GET['aksi'])){
						 if($_GET['aksi'] == 'update'){
							 		update($connect);
						 }elseif($_GET['aksi'] == 'delete'){
							 		delete($connect);
						 }
					 }else{
						 ?>
						 <form class="add" action="" method="post">
	           	<input style="width:90px;" type="text" name="no_adminis" placeholder="&nbsp;Nomor">
	 						<input type="text" name="nama_adminis" placeholder="&nbsp;Nama">
	 						<input style="width:90px;" type="text" name="biaya_adminis" placeholder="&nbsp;Biaya">
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
              <th>No. Administrasi</th>
              <th>Nama</th>
              <th>Biaya</th>
              <th>Opsi</th>
            </tr>
            <?php
              include('connect.php');
							$cari = empty($_POST['cariB']) ? '' : $_POST['cariB'];
							$inputan = empty($_POST['cari']) ? '' : $_POST['cari'];
							if (isset($cari)) {
								if ($inputan != "") {
									$sql = mysqli_query($connect,"SELECT * FROM tb_administrasi WHERE nama like '%$inputan%'");
								}else{
									$sql = mysqli_query($connect,"SELECT * FROM tb_administrasi");
								}
							}else{
									$sql = mysqli_query($connect,"SELECT * FROM tb_administrasi");
							}

              $no = 1;
              while ($data = mysqli_fetch_array($sql)) {
              ?>
              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['no_administrasi']; ?></td>
                <td><?php echo $data['nama']; ?></td>
                <td><?php echo $data['biaya']; ?></td>
                <td>
                  <a class="edit" href="data_administrasi-a.php?aksi=update&id=<?php echo $data['no_administrasi'] ?>&nama=<?php echo $data['nama'] ?>&biaya=<?php echo $data['biaya'] ?>">Edit</a> |
                  <a class="hapus" href="data_administrasi-a.php?aksi=delete&id=<?php echo $data['no_administrasi'] ?>">Hapus</a>
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
