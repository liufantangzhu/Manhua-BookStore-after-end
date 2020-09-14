<?php  
class mysqli_connect{							
	public $con;								
	public $host="localhost";						
	public $username="root";						
	public $password="2431299liang";							
	public $database_name="vue-db";				
	public function connection(){
		$this->con=mysqli_connect($this->host,$this->username,$this->password);
	}
	public function disconnect(){
		mysqli_close($this->con);
	}
	public function set_laugue(){
		if($this->con){
			mysqli_query($this->con, "set names utf8");
		}
	}
	public function choice(){
		if($this->con){
			mysqli_select_db($this->con, $this->database_name);
		}
	}
}
?>