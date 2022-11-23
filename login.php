<?php
  include("db.php");
  
  if (isset($_POST['entrar'])){
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $verifica = mysqli_query($link, "SELECT * FROM users WHERE email = '$email' AND password = '$pass' ");
    if (mysqli_num_rows($verifica)<=0) {
      echo "<h3> E-mail ou Senha incorreto!</h3>";
    } else{
      setcookie("login", $email);
      header("location: ./");
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <style type="text/css">
      *{font-family: 'Montserrat', cursive;}
      img{display: block; margin: auto; margin-top: 20px; width: 200px;}
      form{text-align: center; margin-top: 20px;}
      input[type="email"]{border: 1px solid #ccc; width: 250px; height: 25px; padding-left: 10px; border-radius: 3px;}
      input[type="password"]{border: 1px solid #ccc; width: 250px; height: 25px; padding-left: 10px; margin-top: 10px; border-radius: 3px;}
      input[type="submit"]{border: none; width: 80px; height: 25px; margin-top: 20px; border-radius: 3px;}     
      input[type="submit"]:hover{background-color: #470F2A; color: #fff; cursor: pointer;}   
      h2{text-align: center; margin-top: 20px;}
      h3{text-align: center; color: #470F2A; margin-top: 15px;}
      a{text-decoration: none; color: #333}
    </style>
  </head>
  <body>
    <img src="img/logo.svg" alt="logo">
    <h2>Acesse sua conta</h2>
    <form method="POST">
      <input type="email" placeholder="Endereço e-mail" name="email"><br/>
      <input type="password" placeholder="Senha" name="pass"><br/>
      <input type="submit" value="Entrar" name="entrar">
    </form>
    <h3>Ainda não possui conta? <a href="registrar.php">Cadastre-se</a></h3>
  </body>
</html>