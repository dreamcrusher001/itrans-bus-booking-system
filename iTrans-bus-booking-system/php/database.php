<?php
require_once("config.php");
$db=mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
Class Database{
    private $connection;
    function __construct(){
        $this->open_connection();
    }
    function open_connection(){
        //open connection and select the database
     $this->connection=new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
     if(!$this->connection){
         die("Database connection failed: ". mysqli_stmt_error_list());
     }
	 else{
         //echo "successfully connection";
     }
       
    }
    function close_connection(){
        if(isset($this->connection)){
            mysql_close($this->connection);
            unset($this->connection);
        }
            }
    

//mysql preparation
    public function mysql_prep($value){
        $magic_quotes_active=get_magic_quotes_gpc();
        //finish this later.
    }

//queries

    public function query($sql){
      
        $result=mysqli_query($this->connection,$sql);
        $this->confirm_query($result);
        return $result;
    }
    private function confirm_query($result){
        if(!$result){
            die("Database query failed: ".mysqli_error($this->connection));
        }   
    }
}
$database=new Database();

?>