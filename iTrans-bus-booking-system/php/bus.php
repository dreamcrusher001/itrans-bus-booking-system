<?php
require_once("database.php");
class Bus{
    public $busid;
    public $plate_number ;
    public $company_name;
    public $seats;
    public $stationA; 
    public $stationB;
    public $startA;
	public $startB;
    public $fare;
	public $company_phone;
	public $company_email;
	public $company_manager;
	public $company_location;
	public $allocationid;
    
    function __construct(){
     
      
    }

//function fetch bus details
  public function bus($busid){
        global $database;
        $sql="SELECT *FROM bus WHERE busid='$busid'";
        $result=$database->query($sql);
        if(mysqli_num_rows($result)>0){
		   
        foreach($result as $row){
			$this->busid=$busid;
			$this->plate_number=$row['plateno'];
			$this->seats=$row['seat'];
			
			$companyid=$row['companyid'];
			$sql2 = "SELECT * FROM company WHERE companyid='$companyid'";
		$result=$database->query($sql2);
		  foreach($result as $row2)
		 {
			  $this->company_name = $row2['Name'];
			  $this->company_manager=$row2['Manager']; 
			  $this->company_location=$row2['Location'];
		 }	
		  $sql = "SELECT * FROM companylogin WHERE id='$companyid'";
		$result=$database->query($sql);
		  foreach($result as $row)
		 {
			  
			$this->company_phone=$row['phone'];
			$this->company_email=$row['email'];
			  
		 }	
		 
		$sql3 = "SELECT * FROM allocation WHERE busid='$busid'";
		$result=$database->query($sql3);
		  foreach($result as $row2)
		 {
			  $this->stationA = $row2['stationA'];
			  $this->stationB=$row2['StationB'];
			  $this->startA=$row2['startA'];
			  $this->startB=$row2['startB'];
			  $this->fare=$row2['fare'];
			  $this->allocationid=$row2['id'];
		 }	
			
			
		}
    }
  }
}
		


?>    