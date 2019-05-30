<?php
include_once "DbConfig.php";

class Crud extends DbConfig
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getDate($query)
    {
        $result = $this->connection->query($query);

        if($result == false){
            return false;
        }

        $row == array();

        while($row = $result->fetch_assoc()){
            $rows[] = $row;
        }
        
        return $rows;
    }

    public function execute($query)
    {
        $result $this->connection->query($query);

        if($result == false){
            echo "Error: cannot execute the command";
            return false;
        } else {
            return true;
        }
    }

    
}