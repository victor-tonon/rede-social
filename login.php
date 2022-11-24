<?php
  include("db.php");
  
  if (isset($_POST['entrar'])){
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $verifica = mysqli_query($link, "SELECT * FROM users WHERE email = '$email' AND password = '$pass' ");
    if (mysqli_num_rows($verifica)<=0) {
      echo "<script>alert('E-mail ou Senha incorreto!')</script>";
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
    <link rel="stylesheet" type="text/css" href="style.css" />
    <style type="text/css">
      *{font-family: 'Montserrat', cursive;}
      img{display: block; margin: auto; margin-top: 20px; width: 200px; border-radius: 25px;}
      form{text-align: center; margin-top: 20px;}
      input[type="email"]{border: 1px solid #ccc; width: 250px; height: 25px; padding-left: 10px; border-radius: 3px;}
      input[type="password"]{border: 1px solid #ccc; width: 250px; height: 25px; padding-left: 10px; margin-top: 10px; border-radius: 3px;}
      input[type="submit"]{border: none; width: 80px; height: 25px; margin-top: 20px; border-radius: 3px;}     
      input[type="submit"]:hover{background-color: #470F2A; color: #fff; cursor: pointer;}   
      h2{text-align: center; margin-top: 20px;}
      h3{text-align: center; color: #470F2A; margin-top: 15px;}
      h1{text-align: center; color: #5e5e5e; margin-top: 15px;}
	    h4{text-align: center; color: #5e5e5e; margin-top: 15px;}
      a{text-decoration: none; color: #333}
    </style>
  </head>
  <body>
    <div class="screen-1">
      <Center><img src="img/logo.png" width="120" name="logo"></Center>
      <h1>Facebook 2 </h1>
      <form method="POST">
        <div class="email">
          <label for="email">Email</label>
          <div class="sec-2">
            <input type="email" placeholder="Endereço e-mail" name="email"><br/>
          </div>
        </div>
        <div class="password">
          <label for="password">Senha</label>
            <div class="sec-2">
              <input type="password" placeholder="Senha" name="pass"><br/>
            </div>
        </div>
        <button class="login" type="submit" value="Entrar" name="entrar">Entrar</button>
        <!--<input type="submit" value="Entrar" name="entrar">-->
      </form>
      <h4>Ainda não possui conta? <a href="registrar.php">Cadastre-se</a></h4>
    </div>
  </body>
</html>