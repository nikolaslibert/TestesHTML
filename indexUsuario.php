<?php
session_start();
$codigoSessao = md5('Tempo: ' . $_SESSION['tIni']);
if($codigoSessao !== filter_input(INPUT_GET, "esporte", FILTER_UNSAFE_RAW)){
    $_SESSION = array();
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time()-42000, '/');
    }
    session_destroy();
    
    header('Location: index.php');
    exit();
}
?>


<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        echo 'É isso aehhh...'
        ?>
    </body>
</html>
