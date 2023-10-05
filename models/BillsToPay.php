<?php

    require_once "./config/connect.php";
    class BillsToPayModel extends Connect{
        
        private $table;

        function __construct(){
            parent::__construct();
            $this->table = "bills_to_pay";
        }

        public function getAllBillsToPay(){
            $sqlSelect = $this->connection->query("SELECT * FROM $this->table");
            $resultQuery = $sqlSelect->fetchAll();
            return $resultQuery;
        }

        public function getAll(){
            $sqlSelect = $this->connection->query("SELECT $this->table.*, companies.name as nameEmpresa FROM $this->table inner join companies on $this->table.id_empresa = companies.id");
            $resultQuery = $sqlSelect->fetchAll();
            return $resultQuery;
        }

        public function search($data,$view=null){
            if($view == 'index')
            {
                $sqlSelect = $this->connection->query("SELECT $this->table.*, companies.name as nameEmpresa 
                                                        FROM $this->table 
                                                            inner join companies on $this->table.id_empresa = companies.id 
                                                            WHERE companies.name LIKE '%$data%' 
                                                               or valor LIKE '%$data%' 
                                                               or data_pagar LIKE '%$data%'");
            }
            else
            {
                $sqlSelect = $this->connection->query("SELECT * FROM $this->table WHERE id = '$data'");
            }
            // die($sqlSelect);
            $resultQuery = $sqlSelect->fetchAll();
            return $resultQuery;
        }

        public function new($data){
            $sqlUpdate = "INSERT INTO $this->table (valor,data_pagar,id_empresa) VALUES (:valor,:data_pagar,:id_empresa)";
            $resultQuery = $this->connection->prepare($sqlUpdate)->execute(['valor'=>$data['valor'],'data_pagar'=>$data['data_pagar'],'id_empresa'=>$data['id_empresa']]);
            return $this->verifyReturn($resultQuery);
        }

        public function edit($data){
            if(!empty([$data['id']]))
            {
                $sqlUpdate = "UPDATE $this->table SET valor = :valor, data_pagar = :data_pagar, pago = :pago WHERE id = :id";
                $resultQuery = $this->connection->prepare($sqlUpdate)->execute(['id'=>$data['id'],'valor'=>$data['valor'],'data_pagar'=>$data['data_pagar'],'pago'=>$data['pago']]);
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
