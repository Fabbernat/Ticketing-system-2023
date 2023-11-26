<?php
function adatbazis_csatlakozas() {

    $conn = mysqli_connect("localhost", "root", "", "adatb") or die("Csatlakozási hiba");
    if ( false == mysqli_select_db($conn, "KONYVTAR" )  ) {

        return null;
    }
$anwp = new mysqli();
    // a karakterek helyes megjelenítése miatt be kell állítani a karakterkódolást!
    mysqli_query($conn, 'SET NAMES UTF-8');
    mysqli_query($conn, 'SET character_set_results=utf8');
    mysqli_set_charset($conn, 'utf8');

    return $conn;

}
class connectToDatabase
{
    private $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect("localhost", "root", "") or die("Csatlakozási hiba");
        if ( false === mysqli_select_db($this->conn, "adatb_helyfoglalas" )  ) {

            return null;
        }
        mysqli_query($this->conn, 'SET NAMES UTF-8');
        mysqli_query($this->conn, 'SET character_set_results=utf8');
        mysqli_set_charset($this->conn, 'utf8');
    }

    // Destructor to close the database connection when the object is destroyed
    /*public function __destruct()
    {
        $this->conn->close();
    }*/

    /**
     * @return mysqli
     */
    public function getConn() : false|mysqli
    {
        return $this->conn;
    }


}

