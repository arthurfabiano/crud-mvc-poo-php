<?php
    define('HOST', '127.0.0.1');
    define('DBNAME', 'titan');
    define('USER', 'root');
    define('PASSWORD', 'password');

    class Connect{
        protected $connection;

        function __construct(){
            $this->connectDatabase();
        }

        private function connectDatabase(){
            try 
            {
                $this->connection = new PDO('mysql:host='.HOST.';dbname='.DBNAME, USER, PASSWORD);
            } 
            catch (PDOException $e) 
            {
                echo "Error to connect with Database! ".$e->getMessage();
                die();
            }
        } 

    }
?>
