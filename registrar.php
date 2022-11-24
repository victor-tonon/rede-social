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
      echo "<script>alert('Este email já está registrado. Faça o login')</script>";
    }elseif ($nome == '' OR strlen($nome)<3){
      echo "<script>alert('Escreva seu nome corretamente!')</script>";
    }elseif ($email == '' OR strlen($email)<10){
      echo "<script>alert('Escreva seu e-mail corretamente!')</script>";
    }elseif ($pass == '' OR strlen($pass)<6){
      echo "<script>alert('Senha inválida. A senha deve conter o minímo de 6 caracteres!')</script>";
    }else {
      $query = "INSERT INTO users (`nome`,`sobrenome`,`email`,`password`,`data`) VALUES ('$nome','$sobrenome','$email','$pass','$data')";
      $data = mysqli_query($link,$query) or die(mysql_error());
      if ($data){
        setcookie("login",$email);
        header("location: ./");
      }else{
        echo "<script>alert('Ops, houve um erro ao realizar o cadastro...')</script>";
      }
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
      img{display: block; margin: auto; margin-top: 20px; width: 200px;}
      form{text-align: center; margin-top: 20px;}
      input[type="text"]{border: 1px solid #ccc; width: 250px; height: 25px; padding-left: 10px; border-radius: 3px; margin-top: 10px}
      input[type="email"]{border: 1px solid #ccc; width: 250px; height: 25px; padding-left: 10px; border-radius: 3px; margin-top: 10px}
      input[type="password"]{border: 1px solid #ccc; width: 250px; height: 25px; padding-left: 10px; margin-top: 10px; border-radius: 3px;}
      input[type="submit"]{border: none; width: 100px; height: 25px; margin-top: 20px; border-radius: 3px;}     
      input[type="submit"]:hover{background-color: #470F2A; color: #fff; cursor: pointer;}   
      h2{text-align: center; margin-top: 20px;}
      h3{text-align: center; color: #470F2A; margin-top: 15px;}
      h1{text-align: center; color: #5e5e5e; margin-top: 5px;}
	    h4{text-align: center; color: #5e5e5e; margin-top: 5px;}
      a{text-decoration: none; color: #333}
      img{border-radius: 25px;}
    </style>
  </head>
  <body>
    <div class="screen-1">
  	  <Center><img src="img/logo.png" width="120" name="logo"></Center>
	    <h1> Facebook 2 </h1>
	    <h3>- Crie sua conta -</h3>
      <form method="POST">
        <div class="email">
		      <label for="email">Nome</label>
		      <div class="sec-2">
            <input type="text" placeholder="Primeiro nome" name="nome"><br/>
          </div>
		      <label for="email">Sobrenome</label>
		      <div class="sec-2">
            <input type="text" placeholder="Sobrenome" name="sobrenome"><br/>
          </div>
		      <label for="email">Email</label>
		      <div class="sec-2">
            <input type="email" placeholder="Endereço e-mail" name="email"><br/>
          </div>
		      <label for="password">Senha</label>
		      <div class="sec-2">
            <input type="password" placeholder="Senha" name="pass"><br/>
          </div>
	      </div>
        <button class="login" type="submit" value="Cadastre-se" name="criar">Cadastre-se </button>
      </form>
      <h4>Já possui uma conta? <a href="login.php">Faça o login</a></h4>
    </div>
  </body>
</html>