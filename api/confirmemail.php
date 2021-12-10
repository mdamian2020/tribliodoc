<?php
    require 'conect.php';
    //  Preiau codul secret
    $mesaj = "";
    $codsecret = $_GET['codsecret'];
    
    $sir = [];  //  Un sir asociativ prin care voi transmite rezultatul rularii
    $interogare = "UPDATE utilizatori SET confirmat = 1 WHERE cod_secret = '$codsecret'";
    if(mysqli_query($cnx,$interogare)) {
        $sir["modificat"] = "OK";
    } else {
        $sir["modificat"] = "Nu";
        $sir["mesaj"] = "Eroare la UPDATE: " . mysqli_error($cnx);
    }
    header('Location: https://tribliodoc.000webhostapp.com/index.html');
?>
