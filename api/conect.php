<?php
   // Linii necesare în etapa de testare, cand scripturile sunt apelate de serverul de dezvoltare
   header("Access-Control-Allow-Origin: *");
   header("Access-Control-Allow-Methods: GET, POST");
   header("Access-Control-Max-Age: 3600");
   header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
   $cnx = mysqli_connect("localhost","id17972915_bibliodocuser","xyxyxyxyxyxyx","id17972915_bibliodoc");
   // Se testeaza conexiunea
   if (mysqli_connect_errno()) {
      die("Conectare la MySQL nereusita: " . mysqli_connect_error());
   };  // Impun setul de caractere utf8
   mysqli_set_charset($cnx,"utf8");
   header("Content-Type: application/json; charset=UTF-8");
  // echo "Conectare reusita!";
?>
