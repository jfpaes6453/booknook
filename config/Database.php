<?php

class Database
{
    private $host;
    private $db;
    private $user;
    private $password;
    private $charset;
    private $pdo;

    public function __construct()
    {
        // Load .env file
        $dotenv = parse_ini_file('.env');

        // Set database configuration
        $this->host = $dotenv['DB_HOST'];
        $this->db = $dotenv['DB_NAME'];
        $this->user = $dotenv['DB_USER'];
        $this->password = $dotenv['DB_PASSWORD'];
        $this->charset = 'utf8mb4';

        // Initialize PDO
        $this->connect();
    }

    private function connect()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $this->user, $this->password, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}
