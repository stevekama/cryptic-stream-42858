<?php 
require_once('initialization.php');

class Projects{
    //Decalare table name 
    private $conn;
    private $schemma = 'usr';
    private $table_name = 'projects';
    //Declare class properties 
    public $id;
    public $project;
    public $description;
    public $url;
    
    //connect to db 
    public function __construct()
    {
        global $database;
        $this->conn = $database->connect();
    }

    public function fetch_all(){
        $query = "SELECT * FROM usr.".$this->table_name." ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function fetch_by_id($id = ""){
        $query = "SELECT * FROM ".$this->schemma.".".$this->table_name." WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(array('id'=>$id));
        $count = $stmt->rowCount();
        if($count > 0){
            $project = $stmt->fetch(PDO::FETCH_ASSOC);
            return $project;
        }else{
            return false;
        }
    }
}