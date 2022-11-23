<?php
  include("header.php");

  $saberr = mysqli_query($link, "SELECT * FROM users WHERE email='$login_cookie'");
  $saber = mysqli_fetch_assoc($saberr);
  $email = $saber["email"];

  $pubs = mysqli_query($link, "SELECT * FROM pubs WHERE user='$email' ORDER BY id desc");

  if (isset($_POST['settings'])){
    header("location: settings.php");
  }

?>
<html>
  <header>
    <style type="text/css">
      h2{text-align: center; padding-top: 30px; color: #FFF;}
      img#profile{width: 100px; height: 100px; display: block; margin: auto; margin-top: 30px; border: 5px solid #825A6D; background-color: #825A6D; border-radius: 10px; margin-bottom: -30px;}
      div#menu{width: 300px; height: 120px; display: block; margin: auto; border: none; border-radius: 5px; background-color: #825A6D; text-align: center;}
      div#menu input{height: 25px; border: none; border-radius: 3px; background-color: #FFF; cursor: pointer;}
      div#menu input[name="settings"]{margin-right: 40px;}
      div#menu input:hover{height: 25px; border: none; border-radius: 3px; background-color: transparent; cursor: pointer; color: #FFF;}
      div.pub{width: 400px; min-height: 70px; max-height: 1000px; display: block; margin: auto; border: none; border-radius: 5px; background-color: #FFF; box-shadow: 0 0 6px #A1A1A1; margin-top: 30px;}
      div.pub a{color: #666; text-decoration: none;}
      div.pub a:hover{color: #111; text-decoration: none;}
      div.pub p{margin-left: 10px; content: #666; padding-top: 10px;}
      div.pub span{display: block; margin: auto; width: 380px; margin-top: 10px;}
      div.pub img{display: block; margin: auto; width: 100%; margin-top: 10px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;}
    </style>
  </header>
  <body>
    <?php
      if ($saber["img"]=="") {
        echo '<a href="#" style="width: 400px; display: block; margin: auto;"><img src="img/user.png" id="profile"></a>';
      }else{
        echo '<a href="#" style="width: 400px; display: block; margin: auto;"><img src="upload/'.$saber["img"].'" id="profile"></a>';
      }
    ?>
    <div id="menu">
    <form method="POST">
      <h2><?php echo $saber['nome']." ".$saber['sobrenome']; ?></h2><br/>
      <input type="submit" value="Alterar info" name="settings"><input type="submit" name="amigos" value="Ver amigos">
      </form>
    </div>
    <?php
        while ($pub=mysqli_fetch_assoc($pubs)) {
          $email = $pub['user'];
          $saberr = mysqli_query($link, "SELECT * FROM users WHERE email='$email'");
          $saber = mysqli_fetch_assoc($saberr);
          $nome = $saber['nome']." ".$saber['sobrenome'];
          $id = $pub['id'];

          if ($pub['imagem']=="") {
            echo '<div class="pub" id="'.$id.'">
                <p><a href="profile.php?id='.$saber['id'].'">'.$nome.'</a> - '.$pub["data"].'</p>
                <span>'.$pub['texto'].'</span><br/> 
            </div>';
          }else{
            echo '<div class="pub" id="'.$id.'">
                <p><a href="profile.php?id='.$saber['id'].'">'.$nome.'</a> - '.$pub["data"].'</p>
                <span>'.$pub['texto'].'</span> 
                <img src="upload/'.$pub['imagem'].'" />
            </div>';
          }
        }
    ?>
    <br/> 
    <div id="footer"><p>&copy; Facebook2, 2022 - Todos os direitos reservados</p></div>
    <br/>
  </body>
</html>