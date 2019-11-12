<?php 
require_once('initialization.php');

class Users {
    private $conn;
    private $table_name = 'users';

    // Users properties 
    public $id;
    public $fullnames;
    public $phone;
    public $email;
    public $username;
    public $password;
    public $customer_id;
    public $profile;

    //db connect
    public function __construct(){
        global $database;
        $this->conn = $database->connect();
    }

    //get user by email 
    public function find_user_by_id($id=0)
    {
        $query = 'SELECT * FROM ' . $this->table_name . ' WHERE id = :id LIMIT 1';
        
        //Prepare statement 
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute(array('id'=>$id));

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        return $user;
    }  

    public function authenticate_user($email = '', $password = '')
    {
        $query = "SELECT * FROM ".$this->table_name." WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(
            array('email'=>$email)
        );
        $count = $stmt->rowCount();
        if($count > 0){
            while($user = $stmt->fetch(PDO::FETCH_ASSOC)){
                if(password_verify($password, $user['password'])){
                    return $user;
                }
            }
        }
    }  

    //find user by email 
    public function find_user_by_email($email="")
    {
        $query = "SELECT * FROM ".$this->table_name." WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(array('email'=>$email));

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user;
    }

    public function create(){
        $query = "INSERT INTO ".$this->table_name."(fullnames, phone, email, username, password, customer_id, profile)VALUES(:fullnames, :phone, :email, :username, :password, :customer_id, :profile)";

        //propare statement 
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->fullnames = htmlentities($this->fullnames);
        $this->phone = htmlentities($this->phone);
        $this->email = htmlentities($this->email);
        $this->username = htmlentities($this->username);
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        $this->customer_id = htmlentities($this->customer_id);
        $this->profile = htmlentities($this->profile);
        

        //Bind Data
        $stmt->bindParam(':fullnames', $this->fullnames);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':customer_id', $this->customer_id);
        $stmt->bindParam(':profile', $this->profile);

        //Execute Query 
        if($stmt->execute()){
            return true;
        } 
    }

    // update user info
    public function update()
    {
        $query = "UPDATE ".$this->table_name." SET fullnames = :fullnames, phone = :phone, email = :email, username = :username, customer_id = :customer_id, profile = :profile WHERE id = :id";

        //propare statement 
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->id = htmlentities($this->id);
        $this->fullnames = htmlentities($this->fullnames);
        $this->phone = htmlentities($this->phone);
        $this->email = htmlentities($this->email);
        $this->username = htmlentities($this->username);
        $this->customer_id = htmlentities($this->customer_id);
        $this->profile = htmlentities($this->profile);

        //Bind Data
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':fullnames', $this->fullnames);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':customer_id', $this->customer_id);
        $stmt->bindParam(':profile', $this->profile);

        //Execute Query 
        if($stmt->execute()){
            return true;
        } 
    }

    // update user password
    public function update_password($id=0, $password = ""){
        //clean data
        $id = htmlentities($id);
        // hash password
        // $password = password_hash($password, PASSWORD_DEFAULT);
        // use user id to get the user password and compare with the password
        $user = $this->find_user_by_id($id);
        // verify password
        // return $user['password'];
        if(password_verify($password, $user['password'])){
            // return $user;
            // change and update password
            $query = "UPDATE ".$this->table_name." SET password = :password WHERE id = :id";
            //propare statement 
            $stmt = $this->conn->prepare($query);
            //Bind Data
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':password', $password);
            //Execute Query 
            if($stmt->execute()){
                return true;
            } 
        }else{
            return false;
        }
        
    }
}