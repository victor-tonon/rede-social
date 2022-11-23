<?php
  include("header.php");

  $infoo = mysqli_query($link, "SELECT * FROM users WHERE email='$login_cookie'");
  $info = mysqli_fetch_assoc($infoo);

  if (isset($_POST['criar'])){
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $pass = $_POST['pass'];

    if($nome==""){
      echo "<h2>Escreva seu nome</h2>";
    }elseif($sobrenome==""){
      echo "<h2>Escreva seu sobrenome</h2>";
  }elseif($pass==""){
    echo "<h2>Escreva sua senha</h2>";
  }else{
    $query = "UPDATE users SET nome='$nome', sobrenome='$sobrenome', password='$pass' WHERE email='$login_cookie'";
    $data = mysqli_query($link, $query);
    if ($data) {
      header("Location: myprofile.php");
    }else{
      echo "<h2>Algo não ocorreu como esperado...</h2>";
    }
  }
}

  if (isset($_POST['cancel'])){
    header("Location: myprofile.php");
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <style type="text/css">
      *{font-family: 'Montserrat', cursive;}
      img[name="p"]{display: block; margin: auto; margin-top: 20px; width: 200px;}
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
    <img name="p" src="img/logo.svg" alt="logo">
    <h2>Alterar suas informações</h2>
    <form method="POST">
      <input type="text" placeholder="Primeiro nome" value="<?php echo $info['nome']; ?>" name="nome"><br/>
      <input type="text" placeholder="Sobrenome" value="<?php echo $info['sobrenome']; ?>" name="sobrenome"><br/>
      <input type="password" placeholder="Senha" value="<?php echo $info['password']; ?>" name="pass"><br/>
      <input type="submit" value="Atualizar" name="criar">&nbsp;&nbsp;&nbsp;<input type="submit" value="Cancelar" name="cancel">
    </form> 
  </body>
</html>