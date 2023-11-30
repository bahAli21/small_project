<?php

class AllServices
{
    private $conn;
    public function __construct() {
        $this->conn = (new Database)->getConnexion();
    }

    

}
