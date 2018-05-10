<?php

include_once 'regioni.php';

/**
 * Primer koda...kopirajte u HTML i proverite path kako bi funkcionisalo  :)
 * 
 *          include_once 'citajJMBG_php/cls.citajJMBG.php';
 *               
 *          $cit=new citajJMBG(1,6,0,4,9,7,6,8,3,0,0,2,0);//primer sa mojim JMBG-om
 *           
 *          echo "<h1>Trazeni JMBG: </h1>" . $cit->DD.$cit->MM.$cit->GGG.$cit->MM.$cit->BBB.$cit->K . "</h3><br><hr>";
 *          echo "<b>Pol za trazeni JMBG: <b><h3>" .$cit->koji_je_pol . "</h3><br>"; 
 *          echo "Region za trazeni JMBG: <b><h3>" . $cit->iz_kog_je_regiona  . "</h3><br>";         
 *          echo "Republika za trazeni JMBG: <b><h3>" . $cit->iz_koje_je_republike . "</h3><br>";    
 * 
 */
//-----------------------------------------------------------
/* * primer ix .txt fajla
  //Testiranje fajla regiona-kopirajte ovaj kod ukoliko zelite korisiti podatke iz fajla regioni.txt

  $fajl= file("region.txt",1);

  foreach ($fajl as $value) {

  list($regbro,$regija,$repu)= explode("|", $value);
  echo "{$regbro} = {$regija} => {$repu} <br>";

  }
 */
//-----------------------------------------------------------

/**
 * Description of citajJMBG
 *  
 * Objekat (klasa) citajJMBG je napravjena u toku ucenja OOP u php-u. Kod nije savrsen ali odradjuje posao.
 * Postavio sam ga kako bih i ja doprineo necemu ili nekome (pomogao) ali pre svega je rezultat mog ucenja PHP-a.
 * Nista vise od toga!!! Imate mogucnost da menjate kod za vase potrebe, SLOBODNO...
 * Ukoliko preuzmete ovaj moj mali i skroman kod, voleo bih cuti vase misljenje (dobro, lose ili bilo kakve sugestije 
 * vezano za moje kodiranje) **SVE PRIHVATAMA***  <borisbokan@gmai.com>
 * 
 * Koriscenje je jednostavno. Pocinje Instanciranjem novog objekta. Postoji konstruktor tako da u samom
 * instaciranju mozete staviti u argument tj konstruktor niz od 13 brojeva koji cine JMBG. Po unosu JMBG u 
 * argumentu pozivate samo metode.
 * Napomena: U construktoru mora, ali mora biti unesena vrednost za argument. Ako ne za 13 polja uneti (null,null,null....do 13)
 * ako unosite numericke vrednosti moraju biti uneti u String type data (u navodnike!!!) npr. ('1','0','1','0'.....itd do 13).
 * @author borcha <borisbokan@gmail.com>
 */
class citajJMBG {

    /**
     * Broj je napravljen od 13 cifara u formi „DD MM GGG RR BBB K“ (bez razmaka), gde su:
     *  DD – dan rođenja
     *  MM – mesec rođenja
     *  GGG – poslednje tri cifre godine rođenja
     *  RR – politički regija rođenja (za građane rođene pre 1976. godine politički regija gde su trenutno živeli)
     *
     */
    public static $JMBG = array();
    public $DD; //dan rodjenja
    public $MM; //mesec
    public $GGG; //godina rodjenja
    public $RR; //politicka regija
    public $BBB; //jedinstveni broj
    public $K; //Kontrolni broj
    public $iz_koje_je_republike;
    public $iz_kog_je_regiona;
    public $koji_je_pol;

    /**
     * Makina koja pokrece sve :) _construkt
     * 
     */
    function __construct($_1, $_2, $_3, $_4, $_5, $_6, $_7, $_8, $_9, $_10, $_11, $_12, $_13) {

        $this->citaj($_1, $_2, $_3, $_4, $_5, $_6, $_7, $_8, $_9, $_10, $_11, $_12, $_13);

        $this->izvuciDan(); //2 cif
        $this->izvuciMesec(); //2 cif
        $this->izvuciGodinu(); //3 cif
        $this->izvuciRegion(); //2 cif
        $this->izvuciJedBroj(); //3 cif
        $this->izvucikontrolniBroj(); //1 cifra       
        //setovanje pola.
        $this->dajPol($this->BBB);
        //setovanje regiona
        $this->dajRegion($this->RR);
    }

    /**
     * 
     * @param type $_1 - prva cifra u JMBG.
     * @param type $_2 - druga cifra u JMBG itd dole i dalje ........ :)
     * @param type $_3
     * @param type $_4
     * @param type $_5
     * @param type $_6
     * @param type $_7
     * @param type $_8
     * @param type $_9
     * @param type $_10
     * @param type $_11
     * @param type $_12
     * @param type $_13
     */
    function citaj($_1 = null, $_2 = null, $_3 = null, $_4 = null, $_5 = null, $_6 = null, $_7 = null, $_8 = null, $_9 = null, $_10 = null, $_11 = null, $_12 = null, $_13 = 0) {

        if (self::ima13cifara()) {
            if ($_1 == "") {
                exit("Niste uneli 1. JMBG broj!");
            } else {
                self::$JMBG[0] = $_1;
                ;
            }
            if ($_2 == "") {
                exit("Niste uneli 2. JMBG broj!");
            } else {
                self::$JMBG[1] = $_2;
            }
            if ($_3 == "") {
                exit("Niste uneli 3. JMBG broj!");
            } else {
                self::$JMBG[2] = $_3;
            }
            if ($_4 == "") {
                exit("Niste uneli 4. JMBG broj!");
            } else {
                self::$JMBG[3] = $_4;
            }
            if ($_5 == "") {
                exit("Niste uneli 5. JMBG broj!");
            } else {
                self::$JMBG[4] = $_5;
            }
            if ($_6 == "") {
                exit("Niste uneli 6. JMBG broj!");
            } else {
                self::$JMBG[5] = $_6;
            }
            if ($_7 == "") {
                exit("Niste uneli 7. JMBG broj!");
            } else {
                self::$JMBG[6] = $_7;
            }
            if ($_8 == "") {
                exit("Niste uneli 8. JMBG broj!");
            } else {
                self::$JMBG[7] = $_8;
            }
            if ($_9 == "") {
                exit("Niste uneli 9. JMBG broj!");
            } else {
                self::$JMBG[8] = $_9;
            }
            if ($_10 == "") {
                exit("Niste uneli 10. JMBG broj!");
            } else {
                self::$JMBG[9] = $_10;
            }
            if ($_11 == "") {
                exit("Niste uneli 11. JMBG broj!");
            } else {
                self::$JMBG[10] = $_11;
            }
            if ($_12 == "") {
                exit("Niste uneli 12. JMBG broj!");
            } else {
                self::$JMBG[11] = $_12;
            }
            if ($_13 == "") {
                exit("Niste uneli 13. JMBG broj!");
            } else {
                self::$JMBG[12] = $_13;
            }
        } else {

            echo "Proverite uneseni JMBG broj!Nesto nije u redu!";
        }
    }

    //izvlacenje dela broja iz JMBG
    private function izvuciDan() {
        $this->DD = self::$JMBG[0] . self::$JMBG[1];
    }

    //izvlacenje dela broja iz JMBG
    private function izvuciMesec() {
        $this->MM = self::$JMBG[2] . self::$JMBG[3];
    }

    //izvlacenje dela broja iz JMBG
    private function izvuciGodinu() {
        $this->GGG = self::$JMBG[4] . self::$JMBG[5] . self::$JMBG[6];
    }

    //izvlacenje dela broja iz JMBG
    private function izvuciRegion() {
        $this->RR = self::$JMBG[7] . self::$JMBG[8];
    }

    //izvlacenje dela broja iz JMBG
    private function izvuciJedBroj() {
        $this->BBB = self::$JMBG[9] . self::$JMBG[10] . self::$JMBG[11];
    }

    //izvlacenje dela broja iz JMBG
    private function izvucikontrolniBroj() {

        $this->K = self::$JMBG[12];
    }

    /**
     * Vracanje podatka za pol(rod) na osnovu brojeva 000-499(m)/500-999(z).
     * @param type $vrednost
     * @return string
     */
    private function dajPol($vrednost) {

        $sre = (int) $vrednost;

        switch ($sre) {
            case $sre >= 000 && $sre <= 499:
                $this->koji_je_pol = "Muski";
                break;

            case $sre >= 500 && $sre <= 999:
                $this->koji_je_pol = "Zenski";
                break;
        }
    }

    /**
     * Uzimanje regiona iz broja koji je izvodjen iz JMBG-a
     * 
     */
    public function dajRegion($vrednost) {
        //$svereg=array(regioni::$jmbg[0]);

        $poz = array_search($vrednost, regioni::$jmbg[0]);
        $proreg = regioni::$jmbg[1][$poz];
        $prorep = regioni::$jmbg[2][$poz];
        $this->iz_kog_je_regiona = $proreg; //set region
        $this->iz_koje_je_republike = $prorep;

//      
    }

    /**
     * Vraca TRUE or FALSE kod provere da li JMBG ima tacno 13 cifara.
     * @param type $JMBG
     * @return boolean
     */
    private static function ima13cifara() {
        $br = (int) count(self::$JMBG);
        if ($br < 1 && $br > 13) {
            return false;
        } else {
            return true;
        }
    }

}
