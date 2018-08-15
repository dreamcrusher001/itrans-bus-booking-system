<?php
require_once("database.php");
require_once('Carbon-1.27.0/autoload.php');
/*
 *instantiate carbon
*/
//require_once("Carbon-1.27.0/src/Carbon/carbon.php");
use Carbon\Carbon;
$carbon=new Carbon();

class Customer{
    public $customerid;
    public $balance ;
    public $nationalid;
    public $gender; 
    public $city;
    public $first_name;
	public $second_name;
    public $date_of_birth;
	public $email;
	public $phone_number;
    public $mybooks;
    
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
        $sql="SELECT *FROM transaction WHERE customerid='$userid'";
        $result=$database->query($sql);
        
        if(mysqli_num_rows($result)>0){
            //echo json_encode($result)    
            $i=0;
            foreach($result as $row){
                //use associative array
            $record['ticketcode']=$row['ticketcode'];
            $record['allocationid']= $row['allocationid'];
            $record['amount']=$row['amount'];						
				/*
					*use carbon to convert date
				*/
				$rawdate=$row['date'];
				$arr=(explode("-",$rawdate));
				$dt=Carbon::createFromDate($arr[0],$arr[1],$arr[2]);
				$converteddate=$dt->diffForHumans();
					if($converteddate=="1 day ago")
						{$converteddate="Yesterday";}
					elseif($converteddate=="1 day from now")
						{$converteddate="Tommorow";}
				$parseddate=$dt->format('d F Y');
			$record['date']=$parseddate."(".$converteddate.")";
			$record['seats']=$row['seats'];
			$record['id']=$row['id'];
            $this->mybooks[$i]=$record;

            $i++;
            }
           
			/*foreach($this->mybooks as $item)
			{
				echo "Ticket: ";
				echo $item['code']."<br/>";
				echo $item['allocationid']."<br/>";
				echo $item['amount']."<br/>";
				
			}*/
           // echo json_encode($this->mybooks);
        }else{
           $this->mybooks[0]="h";
        }
		 return $this->mybooks;
    }

    

}//end class
require_once("session.php");
$sql= "SELECT*FROM customerlogin WHERE username='$login_session'";
$result=$database->query($sql);
	while($row=mysqli_fetch_assoc($result))
		{
			$email=$row['email'];
			$phonenumber=$row['phone'];
			$id=$row['id'];		
		}
		
$customer=new Customer();
 $customer-> user($id,$email,$phonenumber);
 $customer->mybookings($id);
?>    