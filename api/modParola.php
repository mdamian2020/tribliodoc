<?php
    require 'conect.php';
    //  Preiau adresa de e-mail
    $mesaj = "";
    $email = $_POST['email'];
    $email = htmlspecialchars($email);
    if(!isset($email)) {
        $mesaj = "Lipsa adresă de e-mail!"; 
    }

    $sir = [];  //  Un sir asociativ prin care voi transmite rezultatul rularii
    
    if($mesaj == "") {
        $interogare = "SELECT cod_secret FROM utilizatori WHERE email = '$email'";
        $rez = mysqli_query($cnx,$interogare);
        
        if(mysqli_num_rows($rez) > 0) 
        { 
            $sir['transmis'] = 'OK';
            $articol = mysqli_fetch_assoc($rez);
            $codsecret = $articol['cod_secret'];
            
            $valori = array(
                'email' => $email,
                'codsecret' => $codsecret
            );

            $curlcnx = curl_init('https://aplimob.net/api/trimitemail.php');
            curl_setopt($curlcnx, CURLOPT_POSTFIELDS, $valori);
            curl_setopt($curlcnx, CURLOPT_RETURNTRANSFER, true);
            $raspuns = curl_exec($curlcnx);
            curl_close($curlcnx);
        }
        else {
            $sir['gasit'] = 'NU';
            $sir['mesaj'] = 'Adresă de e-mail incorectă!';
        }
    } else {
        $sir['gasit'] = "NU";
        $sir['mesaj'] = $mesaj;
    }

    echo json_encode($sir);
?>