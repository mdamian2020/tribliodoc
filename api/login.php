<?php
    session_start();
    require 'conect.php';
    //  Preiau numele si parola
    $mesaj = "";
    $numelogin = $_POST['numelogin'];
    $numelogin = htmlspecialchars($numelogin);
    if(!isset($numelogin)) {
        $mesaj = "Lipsa numele de utilizator!"; 
    }
    
    $parola = $_POST['parola'];
    if(isset($parola)) {
        $parola = md5($parola);
    } else {
        $mesaj .= "Lipsa parola!"; 
    }

    $sir = [];  //  Un sir asociativ prin care voi transmite rezultatul rularii
    
    if($mesaj == "") {
        $interogare = "SELECT nume, prenume, numelogin, parola FROM utilizatori WHERE numelogin = '".$numelogin."' AND  parola = '".$parola."' AND confirmat=1";
        $rez = mysqli_query($cnx,$interogare);
        
        if(mysqli_num_rows($rez) > 0) 
        { 
            $articol = mysqli_fetch_assoc($rez);
            $sir['logat'] = "OK";
            $sir['nume'] = $articol['nume'];
            $sir['prenume'] = $articol['prenume'];
            $_SESSION["logged_in"] = true; 
            $_SESSION["numelogin"] = $numelogin; 
        }
        else {
            $sir['logat'] = "NU";
            $sir['mesaj'] = 'Informatii de conectare incorecte!';
        }
    } else {
        $sir['logat'] = "NU";
        $sir['mesaj'] = $mesaj;
    }

    echo json_encode($sir);
?>