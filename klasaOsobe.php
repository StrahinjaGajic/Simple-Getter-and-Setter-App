<?php
class Osoba {
    private $_podaci = []; 
    public function __construct($ime, $prezime, $pol) {
        $this->_podaci["ime"] = $ime;
        $this->_podaci["prezime"] = $prezime;
        $this->_podaci["pol"] = $pol;
        $this->_podaci["visina"] = "";
        $this->_podaci["tezina"] = "";
    }
    public function __set($promenljiva, $vrednost){
        $_vrednost = "";
        switch($promenljiva) {
            case "visina":
                $_vrednost = (substr($vrednost, -1) == "m") ? $vrednost : $vrednost."m";
                break;
            case "tezina":
                $_vrednost = (substr($vrednost, -2) == "kg") ? $vrednost : $vrednost."kg";
                break;
            default:
                $_vrednost = $vrednost;
                break;
        }
        $this->_podaci[$promenljiva] = $_vrednost;
    }
    public function __get($promenljiva){
        if (array_key_exists($promenljiva, $this->_podaci)) {
            return $this->_podaci[$promenljiva];
        } else {
            return "Podatak '$promenljiva' nije poznat.";
        }
    }
    public function PrikaziPodatke() {
        echo "<table border=\"1\" width=\"300\">";
        foreach ($this->_podaci as $promenljiva => $vrednost) {
            echo "<tr>";
            echo "<td>".ucfirst($promenljiva)."</td>";
            echo "<td>".ucfirst($vrednost)."</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
}
class Muskarac extends Osoba {
    function __construct($ime, $prezime) {
        parent::__construct($ime, $prezime, "Muski");
    }
}
class Zena extends Osoba {
    function __construct($ime, $prezime) {
        parent::__construct($ime, $prezime, "Zenski");
    }
}
$john = new Muskarac("John", "Doe");
$john->visina = "1.83";
$john->tezina = "72kg";
$john->PrikaziPodatke();