<?php
$link = mysqli_connect("127.0.0.1", "root", "", "facebook2");
 
if (!$link) {
    echo "Error: Falha ao conectar-se com o banco de dados MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
?> 
<html>
  <header>
    <meta charset="utf-8">
    <title>Facebook2</title>
  </header>


</html>