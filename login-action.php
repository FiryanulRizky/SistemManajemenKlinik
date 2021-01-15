<?php
include('connect.php');
if (isset($_POST['login'])) {

	session_start();
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $query = mysqli_query($connect,"SELECT * FROM  tb_pegawai WHERE user_pegawai='$user' AND pass_pegawai='$pass'");
    $cek = mysqli_num_rows($query);
    if ($cek > 0) {
    	$data = mysqli_fetch_array($query);
        $_SESSION['username'] = $data['user_pegawai'];
				$_SESSION['level'] = $data['level_pegawai'];

				if($data['level_pegawai'] == 1){
					header('location:index-a.php');
				}else{
					header('location:index-p.php');
				}
    }else{
        header('location:login.php');
    }

}

?>
