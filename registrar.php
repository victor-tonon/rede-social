<?php
  include("db.php");

  if (isset($_POST['criar'])){
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $data = date("Y/m/d");

    $email_check = mysqli_query($link, "SELECT email FROM users WHERE email = '$email'");
    $do_email_check = mysqli_num_rows($email_check);
    if ($do_email_check>=1){
      echo '<h3>Este email já está registrado. Faça o login <a href="login.php">aqui</a></h3>';
    }elseif ($nome == '' OR strlen($nome)<3){
      echo '<h3>Escreva seu nome corretamente!</h3>';
    }elseif ($email == '' OR strlen($email)<10){
      echo '<h3>Escreva seu e-mail corretamente!</h3>';
    }elseif ($pass == '' OR strlen($pass)<6){
      echo '<h3>Senha inválida. A senha deve conter o minímo de 6 caracteres!</h3>';
    }else {
      $query = "INSERT INTO users (`nome`,`sobrenome`,`email`,`password`,`data`) VALUES ('$nome','$sobrenome','$email','$pass','$data')";
      $data = mysqli_query($link,$query) or die(mysql_error());
      if ($data){
        setcookie("login",$email);
        header("location: ./");
      }else{
        echo "<h3>Ops, houve um erro ao realizar o cadastro...</h3>";
      }
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
      input[type="text"]{border: 1px solid #ccc; width: 250px; height: 25px; padding-left: 10px; border-radius: 3px; margin-top: 10px}
      input[type="email"]{border: 1px solid #ccc; width: 250px; height: 25px; padding-left: 10px; border-radius: 3px; margin-top: 10px}
      input[type="password"]{border: 1px solid #ccc; width: 250px; height: 25px; padding-left: 10px; margin-top: 10px; border-radius: 3px;}
      input[type="submit"]{border: none; width: 100px; height: 25px; margin-top: 20px; border-radius: 3px;}     
      input[type="submit"]:hover{background-color: #470F2A; color: #fff; cursor: pointer;}   
      h2{text-align: center; margin-top: 20px;}
      h3{text-align: center; color: #470F2A; margin-top: 15px;}
      a{text-decoration: none; color: #333}
    </style>
  </head>
  <body>
    <img src="img/logo.svg" alt="logo">
    <h2>Crie sua conta</h2>
    <form method="POST">
      <input type="text" placeholder="Primeiro nome" name="nome"><br/>
      <input type="text" placeholder="Sobrenome" name="sobrenome"><br/>
      <input type="email" placeholder="Endereço e-mail" name="email"><br/>
      <input type="password" placeholder="Senha" name="pass"><br/>
      <input type="submit" value="Cadastre-se" name="criar">
    </form>
    <h3>Já possui uma conta? <a href="login.php">Faça o login</a></h3>
  </body>
</html>