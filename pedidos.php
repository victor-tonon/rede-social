<?php
  include("header.php");

  $pubs = mysqli_query($link, "SELECT * FROM amizades WHERE para='$login_cookie' AND aceite='nao' ORDER BY id desc");

  if (isset($_GET['id'])){
    $id = $_GET['id'];
    $saberr = mysqli_query($link, "SELECT * FROM users WHERE id='$id'");
    $saber = mysqli_fetch_assoc($saberr);
    $email = $saber['email'];

    $ins = "UPDATE amizades SET `aceite`='sim' WHERE `de`='$email' AND `para`='$login_cookie'";
    $conf = mysqli_query($link,$ins) or die(mysqli_error());
    if ($conf) {
      header("Location: pedidos.php");
    }else{
      echo "<h3>Erro ao aceitar amizade...</h3>";
    }
  }

  if (isset($_GET['remove'])){
  $id = $_GET['remove'];
    $saberr = mysqli_query($link, "SELECT * FROM users WHERE id='$id'");
    $saber = mysqli_fetch_assoc($saberr);
    $email = $saber['email'];

    $ins = "DELETE FROM amizades WHERE `de`='$login_cookie' AND `para`='$email' OR `para`='$login_cookie' AND `de`='$email'";
    $conf = mysqli_query($link,$ins) or die(mysqli_error());
    if ($conf) {
      header("Location: pedidos.php");
    }else{
      echo "<h3>Erro ao excluir amizade...</h3>";
    }
  }

?>
<html>
  <header>
    <style type="text/css">
      h3{text-align: center; color: #825A6D;}
      div.pub{width: 400px; min-height: 70px; max-height: 1000px; display: block; margin: auto; border: none; border-radius: 5px; background-color: #FFF; box-shadow: 0 0 6px #A1A1A1; margin-top: 30px; text-align: center;}
      div.pub a{color: #666; text-decoration: none;}
      div.pub a:hover{color: #111; text-decoration: none;}
      div.pub p{content: #666; text-align: center;}
      div.pub span{display: block; margin: auto; padding-top: 20px; text-align: center;}
      div.pub input{border-radius: 3px; background-color: #825A6D; border: none; color: #FFF; height: 25px; padding-right:5px; padding-left: 5px; cursor: pointer;}
      div.pub input:hover{background-color: #FFF; color: #825A6D;}
    </style>
  </header>
  <body>
    <?php
        while ($pub=mysqli_fetch_assoc($pubs)) {
          $email = $pub['de'];
          $saberr = mysqli_query($link, "SELECT * FROM users WHERE email='$email'");
          $saber = mysqli_fetch_assoc($saberr);
          $nome = $saber['nome']." ".$saber['sobrenome'];
          $id = $pub['id'];

            echo '<div class="pub" id="'.$id.'">
                <span>'.$nome.' quer ser seu amigo(a)</span><br/>
                <p><a href="profile.php?id='.$saber['id'].'">Ver perfil de '.$nome.'</a></p><br/>
                <a href="pedidos.php?id='.$saber['id'].'"><input type="submit" value="Aceitar" name="add"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="pedidos.php?remove='.$saber['id'].'"><input type="submit" value="Recusar" name="remove"></a>
                <br/><br/>
            </div>';
        }
    ?>
    <br/>
    <h3>Não há mais solicitaçãoes de amizade...</h3>
    <br/> 
    <div id="footer"><p>&copy; Facebook2, 2022 - Todos os direitos reservados</p></div>
    <br/>
  </body>
</html>