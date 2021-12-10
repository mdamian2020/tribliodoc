<?php
   
function corectez($sir) {
  $sir = trim($sir);
  $sir = stripslashes($sir);
  $sir = htmlspecialchars($sir);
  return $sir;
}

require 'conect.php';
// Preiau valorile din campurile formularului (nume, prenume, numelog, email, parola)

$eroare = '';
$sir = [];  //  Un sir asociativ prin care voi transmite rezultatul rularii

if(empty($_POST['nume'])) {
  $eroare .= '<p>Nu ați introdus numele!</p>';
} else {
  $nume = corectez($_POST['nume']);
}

if(empty($_POST['prenume'])) {
  $eroare .= '<p>Nu ați introdus prenumele!</p>';
} else {
  $prenume = corectez($_POST['prenume']);
}

if(empty($_POST['numelog'])) {
  $eroare .= '<p>Nu ați introdus numele de logare!</p>';
} else {
  $numelog = corectez($_POST['numelog']);
}

if(empty($_POST['email'])) {
  $eroare .= '<p>Nu ați introdus adresa Dv. de e-mail!</p>';
} else {
  $email = corectez($_POST['email']);
}

if(empty($_POST['parola'])) {
  $eroare .= '<p>Nu ați introdus parola!</p>';
} else {
  $parola = md5(corectez($_POST['parola']));
}

//  Verific dacă nu există deja un cont cu aceasta parola
$interogare = "SELECT * FROM utilizatori WHERE email = '$email'";
$rez = mysqli_query($cnx, $interogare);
if(mysqli_num_rows($rez) > 0) {
    $eroare .= '<p>Un cont cu acest e-mail există deja. Reintrați în aplicație și selectați <em>Parolă pierdută!</em></p>';
}

//  Verific daca preluarea datelor s-a derulat corect
if($eroare == '') {
  //  Nu sunt mesaje de eroare
  //  Generez un cod secret
  $codsecret = md5(strval(time()));
  // formulez comanda INSERT
  $comanda = "INSERT INTO utilizatori (nume, prenume, numelogin, email, parola, tip_utilizator, confirmat, cod_secret) VALUES (?, ?, ?, ?, ?, '0', '0', '$codsecret')";
  if($stm = mysqli_prepare($cnx, $comanda)) {
    mysqli_stmt_bind_param($stm, 'sssss',$nume, $prenume, $numelog, $email, $parola);
    mysqli_stmt_execute($stm);
    $sir['creat'] = "OK";
    //  Trimit mesajul pentru confirmare la adresa $email
    $valori = array(
        'email' => $email,
        'codsecret' => $codsecret
    );

    $curlcnx = curl_init('https://aplimob.net/api/confirm.php');
    curl_setopt($curlcnx, CURLOPT_POSTFIELDS, $valori);
    curl_setopt($curlcnx, CURLOPT_RETURNTRANSFER, true);
    $raspuns = curl_exec($curlcnx);
    curl_close($curlcnx);
  } else {
      $sir['creat'] = "NU";
    $sir['mesaj'] = "Eroare la crearea variabilei de tip statement.";
  }
  mysqli_close($cnx);
} else {
    $sir['creat'] = "NU";
    $sir['mesaj'] = $eroare;
}

echo json_encode($sir);
?>
