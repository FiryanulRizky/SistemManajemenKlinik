<?php
	session_start();

	if (!empty($_SESSION['username'])) {
    if($_SESSION['level'] == 1){
      header('location:index-a.php');
    }else{
      header('location:index-p.php');
    }
	}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/login_style.css">
    <title>SMKlinik | Login</title>
  </head>
  <body>
    <header>
      <div class="container">
        <img src="./img/ini_logo.png" alt="Logo">
        <h1><span class="hightlight">KLINIK</span> Cahaya</h1>
      </div>
    </header>

    <section id="loginbox">
      <div class="container">
        <form class="logbox" action="login-action.php" method="post">
          <p>Username</p>
          <input type="text" name="username" placeholder="&nbsp;Masukkan Username">
          <p>Password</p>
          <input type="text" name="password" placeholder="&nbsp;Masukkan Password">
          <br>
          <div class="button">
            <input type="submit" name="login" value="Login">
          </div>
        </form>
      </div>
    </section>

    <footer>
      <div class="container">
        <p>Klinik Cahaya || Copyright &copy; 2019</p>
      </div>
    </footer>
  </body>
</html>
