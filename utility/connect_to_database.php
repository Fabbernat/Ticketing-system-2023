<?php
include_once "return_to_index.html";
class connectToDatabase
{
// Connect to database
    private $dbHost = "localhost";
    private $dbUser = "URX5VP";
    private $dbPassword = "jelszo";
    private $dbName = "adatb_helyfoglalas";
    private $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect("localhost", "root", "") or die("Csatlakozási hiba");
        if ( false == mysqli_select_db($this->conn, "adatb_helyfoglalas" )  ) {

            return null;
        }
    }

    // Other methods can be defined here for database operations

    // Destructor to close the database connection when the object is destroyed
    public function __destruct()
    {
        $this->conn->close();
    }

    /**
     * @return mysqli
     */
    public function getConn()
    {
        return $this->conn;
    }


}

