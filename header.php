<?php
  include("db.php");
  $login_cookie = $_COOKIE['login'];
  if (!isset($login_cookie)) {
    header("Location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <style type="text/css">
      *{font-family: 'Montserrat', cursive; margin: 0;}
      body{background:#F6F6F6;}
      div#topo{width: 100%; top: 0; background: #fff; box-shadow: 0 0 10px #000; height: 100px;}
      div#topo img[name="logo"]{float: left; margin-left: 20px; margin-top: 5px;}
      div#topo img[name="menu"]{float: right; margin-right: 25px; margin-top: -22px;}
      div#topo input[type="text"]{display: block; margin: auto; width: 300px; border: none; border-radius: 3px; background: #F6F6F6; height: 25px; padding-left: 10px; box-shadow: 0 0 6px #666;}
      div#topo form{width: 300px; display: block; margin: auto; padding-top: 22px;}
      div#footer{bottom: 0; text-align: center; color: #666;}
    </style>
</head>
<body>
  <div id="topo">
    <a href="#"><img src="img/logo.svg" width="90" name="logo"></a>
    <form method="GET">
      <input type="text" placeholder="Pesquisar" name="query" autocomplete="off">
      <input type="submit" hidden>
    </form>
    <a href="#"><img src="img/chat.png" width="30" name="menu"></a>
    <a href="#"><img src="img/perfil.png" width="30" name="menu"></a>
  </div>  
</body>
</html>