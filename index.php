<?php
  include("header.php");

  $pubs = mysqli_query($link, "SELECT * FROM pubs ORDER BY id desc");

  if (isset($_POST['publish'])) {
    if ($_FILES["file"]["error"] > 0){
      $texto = $_POST["texto"];
      $hoje = date("Y-m-d");

      if ($texto == ""){
        echo "<h3>Escreva algo para publicar!</h3>";
      }else{
        $query = "INSERT INTO pubs (user,texto,data) VALUES ('$login_cookie','$texto','$hoje')";
        $data = mysqli_query($link, $query) or die();
        if ($data){
          header("Location: ./");
        }else{
          echo "Ops, algo deu errado. Tente novamente mais tarde!";
        }
      }
    }else{
      $n = rand(0, 1000000);
      $img = $n.$_FILES["file"]["name"];

      move_uploaded_file($_FILES["file"]["tmp_name"], "upload/".$img);

      $texto = $_POST['texto'];
      $hoje = date("Y-m-d");

      if ($texto == ""){
        echo "<h3>Escreva algo para publicar!</h3>";
      }else{
        $query = "INSERT INTO pubs (user,texto,imagem,data) VALUES ('$login_cookie','$texto','$img','$hoje')";
        $data = mysqli_query($link, $query) or die();
        if ($data){
          header("Location: ./");
        }else{
          echo "Ops, algo deu errado. Tente novamente mais tarde!";
        }
      }
    }
  }
?>
<html>
  <header>
    <style type="text/css">
      div#publish{width: 400px; height: 210px; display: block; margin: auto; border: none; border-radius: 5px; background: #fff; box-shadow: 0 0 6px #A1A1A1; margin-top: 30px;}
      div#publish textarea{width: 365px; height: 150px; display: block; margin: auto; border-radius: 5px; padding-left: 5px; padding-top: 5px; border-width: 1px; border-color: #a1a1a1;}
      div#publish img{margin-top: 0px; margin-left: 10px; width: 40px; cursor: pointer;}
      div#publish input[type="submit"]{width: 70px; height: 25px; border-radius: 3px; float: right; margin-right: 15px; border: none; margin-top: 5px; background: #825A6D; color: #FFF; cursor: pointer;}
      div#publish input[type="submit"]:hover{background: #470F2A;}

      div.pub{width: 400px; min-height: 70px; max-height: 1000px; display: block; margin: auto; border: none; border-radius: 5px; background-color: #FFF; box-shadow: 0 0 6px #A1A1A1; margin-top: 30px;}
      div.pub a{color: #666; text-decoration: none;}
      div.pub a:hover{color: #111; text-decoration: none;}
      div.pub p{margin-left: 10px; content: #666; padding-top: 10px;}
      div.pub span{display: block; margin: auto; width: 380px; margin-top: 10px;}
      div.pub img{display: block; margin: auto; width: 100%; margin-top: 10px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;}
    </style>
  </header>
  <body>
    <div id="publish">
      <form method="POST" enctype="multipart/form-data">
        <br/>
        <textarea placeholder="Escrever uma nova publicação" name="texto"></textarea>
        <label for="file-input">
          <img src="img/camera.png" title="Inserir Imagem">
        </label>
        <input type="submit" value="Publicar" name="publish"/>
        <input type="file" id="file-input" name="file" hidden />
      </form>
    </div>
    <?php
        while ($pub=mysqli_fetch_assoc($pubs)) {
          $email = $pub['user'];
          $saberr = mysqli_query($link, "SELECT * FROM users WHERE email='$email'");
          $saber = mysqli_fetch_assoc($saberr);
          $nome = $saber['nome']." ".$saber['apelido'];
          $id = $pub['id'];

          if ($pub['imagem']=="") {
            echo '<div class="pub" id="'.$id.'">
                <p><a href="#">'.$nome.'</a> - '.$pub["data"].'</p>
                <span>'.$pub['texto'].'</span><br/> 
            </div>';
          }else{
            echo '<div class="pub" id="'.$id.'">
                <p><a href="#">'.$nome.'</a> - '.$pub["data"].'</p>
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