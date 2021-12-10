<?php
    require 'conect.php';
    //  Preiau codul secret
    $mesaj = "";
    $codsecret = $_POST['codsecret'];
    //  Preiau noua parola
    $parola = $_POST['parola'];
    $parola = trim($parola);
    if(!isset($parola)) {
        $mesaj = "Lipsește noua parolă!"; 
    }

    $sir = [];  //  Un sir asociativ prin care voi transmite rezultatul rularii
    
    if($mesaj == "") {
        $interogare = "UPDATE utilizatori SET parola = '" . md5($parola) . "' WHERE cod_secret = '$codsecret'";
        if(mysqli_query($cnx,$interogare)) {
            $sir["modificat"] = "OK";
        } else {
            $sir["modificat"] = "Nu";
            $sir["mesaj"] = "Eroare la UPDATE: " . mysqli_error($cnx);
        }
    } else {
        $sir["mesaj"] = $mesaj;
    }

    echo json_encode($sir);
    header('Location: https://tribliodoc.000webhostapp.com/index.html');
?>
