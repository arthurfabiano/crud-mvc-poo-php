<?php

    require_once "./config/connect.php";
    class CompanyModel extends Connect{
        
        private $table;

        function __construct(){
            parent::__construct();
            $this->table = "companies";
        }

        public function getAll(){
            $sqlSelect = $this->connection->query("SELECT * FROM $this->table");
            $resultQuery = $sqlSelect->fetchAll();
            return $resultQuery;
        }

        public function search($data,$view=null){
            if($view == 'index')
            {
                $sqlSelect = $this->connection->query("SELECT * FROM $this->table WHERE id = '$data' or name LIKE '%$data%'");
            }
            else
            {
                $sqlSelect = $this->connection->query("SELECT * FROM $this->table WHERE id = '$data'");
            }
            $resultQuery = $sqlSelect->fetchAll();
            return $resultQuery;
        }

        public function new($data){
            $sqlUpdate = "INSERT INTO $this->table (name) VALUES (:name)";
            $resultQuery = $this->connection->prepare($sqlUpdate)->execute(['name'=>$data['name']]);
            return $this->verifyReturn($resultQuery);
        }

        public function edit($data){
            if(strlen($data['phone']) <= 11)
            {
                $sqlUpdate = "UPDATE $this->table SET name = :name WHERE id = :id";
                $resultQuery = $this->connection->prepare($sqlUpdate)->execute(['id'=>$data['id'],'name'=>$data['name']]);
                return $this->verifyReturn($resultQuery);
            }
            return false;
        }

        public function delete($id){ 
            if(!$this->search($id))
            {
                return false;
            }
            $sqlDelete = "DELETE FROM $this->table WHERE id = :id";
            $resultQuery = $this->connection->prepare($sqlDelete)->execute(['id'=>$id]);
            return $this->verifyReturn($resultQuery);
        }

        public function verifyReturn($result){
            if($result == 1)
            {
                return true;
            }
            return false;
        }
    }

?>
