<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Twoje BMI</title>
    <link rel="stylesheet" type="text/css" href="styl3.css"/>
</head>
<body>
    <div id="logo">
     <img src="wzor.png" alt="wzór BMI"/>
    </div>
       
       <div id="baner">
        <h1>Oblicz swoje BMI</h1>
       </div>

          <div id="glowny">
          <table>
            <tr>
                <th>Interpretacja BMI</th>
                <th>Wartość minimalna</th>
                <th>Wartość maksymalna</th>
            </tr>
<?php
// utworzenie zmiennych polaczeniowych

$server = "localhost";
$user = "root";
$passwd = "";
$dbname = "egzamin7";

$conn = mysqli_connect($server,$user,$passwd,$dbname);
//sprawdzenie polaczenia 
/*
if (!$conn){
  die ("fatal error".mysqli_error($conn));
} echo "jest okej";
*/

$sql = "SELECT `wart_min`, `wart_max`, `informacja` FROM `bmi`";
$zapytanie = mysqli_query($conn,$sql);

while ($wynik = mysqli_fetch_row($zapytanie)){
  echo "<tr>";
  echo "<td>". $wynik[2] ."</td>";
  echo "<td>". $wynik[0] ."</td>";
  echo "<td>". $wynik[1] ."</td>";
  echo "</tr>";
}

?>
          </table>
          </div>
            
            <div id="lewy">
            <h2>Podaj wagę i wzrost</h2>
            <form method="post">
                <label>Waga</label>
                <input type="number" name="numer" min="1"/> <br>
                <label>Wzrost w cm:</label>
                <input type="number" name="numer1" min="1"/> <br>
                <input type="submit" value="Oblicz i zapamiętaj wynik"/>
<?php

if(!empty($_POST['numer']) && !empty($_POST['numer1'])){
  $numer = $_POST['numer'];
  $numer1 = $_POST['numer1'];
  $bmi = $numer /($numer1 * $numer1) * 10000;
  echo "Twoja waga: $numer, Twój wzrost: $numer1 <br /> BMI wynosi $bmi";


if($bmi > 0 && $bmi < 19) $przedzial = 1;
if($bmi > 19 && $bmi < 26) $przedzial = 2;
if($bmi > 26 && $bmi < 31) $przedzial = 3;
if($bmi > 31 && $bmi < 100) $przedzial = 4;

$data= DATE('Y-m-d');
$sql2 = "INSERT INTO `wynik` VALUES (NULL,$przedzial,$data,$bmi)";
mysqli_query($conn,$sql2);
}
mysqli_close($conn);
?>
            </form>
            </div>

              <div id="prawy">
              <img src="rys1.png" alt="ćwiczenia"/>
              </div>

                <div id="stopka">
                Autor: 000000000
                <a href="kwerendy.txt">Zobacz kwerendy</a>
                </div>

</body>
</html>