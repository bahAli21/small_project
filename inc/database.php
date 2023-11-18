<?php

class Database
{
    protected $config;

    public function __construct()
    {
        $this->config = require 'config.php';
    }

    public function getConnexion()
    {
        try {
            $pdo = new PDO("mysql:host={$this->config['host']};dbname={$this->config['dbname']}",
                $this->config['uid'],
                $this->config['password']);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }
}