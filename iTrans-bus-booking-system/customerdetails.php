<?php
require_once("php/database.php");
class Customer{
    public $customerid;
    public $balance ;
    public $mybooks;
    public $nationalid;
    public $gender; 
    public $city;
    public $first_name;
	public $second_name;
    public $date_of_birth;
	public $email;
	public $phone_number;
    
    function __construct(){
     
      
    }


    //function fetch user
    public function user($userid,$emails,$phoneno){
        global $database;
        $sql="SELECT *FROM customer WHERE customerid='$userid'";
        $result=$database->query($sql);
        if(mysqli_num_rows($result)>0){
            ///echo "sucess";
		   $this->customerid=$userid;
		   $this->email=$emails;
		   $this->phone_number=$phoneno;
           $this-> instantiate($result);

        }else{
            echo "User is not in database";
        }
    }
    function instantiate($result){
        foreach($result as $row){
            $bal=$row['wallet'];
            $id=$row['nationalid'];
            $gen=$row['gender'];
            $nme=$row['firstname'];
			$snme=$row['secondname'];
            $date_of_birth=$row['dob'];
            $cit=$row['city'];
            $this->nationalid=$id;
            $this->balance=$bal;
            $this->gender=$gen;
            $this->first_name=$nme;
            $this->second_name=$snme;
            $this->date_of_birth=$date_of_birth;          
            $this->city=$cit;
        }

		
		
		
    }

    //get the customers booking 
    function mybookings($userid){
        global $database;
        $sql="SELECT *FROM transaction WHERE customerid='1'";
        $result=$database->query($sql);
        
        if(mysqli_num_rows($result)>0){
            //echo json_encode($result);

           
            $i=0;
            foreach($result as $row){
                //use associative array
            $record['code']=$row['ticketcode'];
            $record['allocationid']= $row['allocationid'];
            $record['amount']=$row['amount'];
            $this->mybooks[$i]=$record;

            $i++;
            }
           // return $this->mybooks[2];
			foreach($this->mybooks as $item)
			{
				echo "Ticket: ";
				echo $item['code']."<br/>";
				echo $item['allocationid']."<br/>";
				echo $item['amount']."<br/>";
				
			}
           // echo json_encode($this->mybooks);
        }else{
           
        }
    }
    

}
/*
require_once("php/session.php");
$sql= "SELECT*FROM customerlogin WHERE username='$login_session'";
$result=$database->query($sql);
	while($row=mysqli_fetch_assoc($result))
		{
			$email=$row['email'];
			$phonenumber=$row['phone'];
			$id=$row['id'];		
		}
*/
		
$customer=new Customer();
 //$customer-> user($id,$email,$phonenumber);
 $customer->mybookings(1);
?>    