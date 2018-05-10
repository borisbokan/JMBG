<?php ?>
<!DOCTYPE html>
<!--
Testiranje web app(php) prikaz osnovnih podataka iz JMBG-a.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include_once 'cls.citajJMBG.php';
        //morate uneti minimum 0 ili null u kontekstu broja a ne stringa. npr. null a ne 'null' 
        $cit = new citajJMBG('1', '6', '0', '4', '9', '7', '6', '8', '3', '0', '0', '4', '9');

        echo "<h1>Trazeni JMBG: </h1>" . $cit->DD . $cit->MM . $cit->GGG . $cit->RR . $cit->BBB . $cit->K . "</h3><br><hr>";
        echo "<b>Pol za trazeni JMBG: <b><h3>" . $cit->koji_je_pol . "</h3><br>";
        echo "Region za trazeni JMBG: <b><h3>" . $cit->iz_kog_je_regiona . "</h3><br>";
        echo "Republika za trazeni JMBG: <b><h3>" . $cit->iz_koje_je_republike . "</h3><br>";
        ?>

    </body>
</html>
