<?php
require_once("database.php");
class Company{
   
    public $company_name;  
	public $company_phone;
	public $company_manager;
	public $company_location;
	public $company_email;
	
    
    function __construct(){
     
      
    }

//function fetch bus details
  public function company($companyid){
        global $database;
        			
		$sql = "SELECT * FROM company WHERE companyid='$companyid'";
		$result=$database->query($sql);
		  foreach($result as $row)
		 {
			  $this->company_name = $row['Name'];
			  $this->company_manager=$row['Manager'];
			  $this->company_location=$row['Location'];
		 }	
		 
		 $sql = "SELECT * FROM companylogin WHERE id='$companyid'";
		$result=$database->query($sql);
		  foreach($result as $row)
		 {
			  
			$this->company_phone=$row['phone'];
			$this->company_email=$row['email'];
			  
		 }	
		
  }
}

	$company=new Company();

	 require_once("session.php");
     $sql = "SELECT id FROM companylogin WHERE username = '$login_session'";
     $result = mysqli_query($db,$sql);
     $row = mysqli_fetch_array($result,MYSQLI_ASSOC);	
	 $companyid=$row['id'];
	 
	 $company->company($companyid);


?>    