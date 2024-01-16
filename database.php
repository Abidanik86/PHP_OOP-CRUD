<?php 
//create a database in your MySQL by the name you want,Here is the default name oop_mysqli.
//create a table, name the table student and give id,name,email and phone number as rows. 

class database{
	private $host = "localhost";
	private $username = "root";
	private $password = "";
	private $dbname = "oop_mysqli";

	private $result = array();
	private $mysqli = null;
	private $conn = false;

	//Function for connect the database.
	public function __construct(){

		if (!$this->conn) {
				$this->mysqli = new mysqli($this->host,$this->username,$this->password,$this->dbname);

				$this->conn = true;

				if ($this->mysqli->connect_error) {
					array_push($this->result,$this->mysqli->connect_error);
				}
			}else{
				return true;
			}			
	}

	//Private function for check if the table exist.
	private function tableexist($table){

		$sql = "SHOW TABLES FROM $this->dbname LIKE '$table'";
		$tableindb = $this->mysqli->query($sql);

		if ($tableindb) {
			if ($tableindb->num_rows == 1) {
				return true; // The table exist.
			}else{
			array_push($this->result,$table . "Database not exist");
			return false; // The table does not exist.
		   }
		}
	}
		
	// Function for insert data to database.
	public function insert($table,$params = array()){
	// Check to if table exist.
		if ($this->tableexist($table)) {
		// Seperate $param's array key and value's and vonvert the to string
			$table_column = implode(',', array_keys($params));
			$table_value = implode("','" , $params);

			$sql = "INSERT INTO $table ($table_column) VALUES ('$table_value')";
			//Make the Query to insert to the database
			if ($this->mysqli->query($sql)) {
				array_push($this->result,$this->mysqli->insert_id);
				return true; // The data has been inserted.
			}else{
				array_push($this->result,$this->mysqli->error);
				return false; // The data has not been inserted. 
			}
		}
	}
	
	//Function for update the data.
	public function update($table,$params = array(),$where = null){
			// Check to if table exist.
			if ($this->tableexist($table)) {
				// Create array to hold the columns to update.
				$args = array();
				foreach ($params as $key => $value) {
					$args[] = "$key = '$value'"; //Seperate each column out with it's correspond
				}

				$sql = "UPDATE $table SET  " . implode(', ', $args);
				if ($where != null) {
					$sql .= " WHERE $where";				
				}
				// Make query to database
				if ($this->mysqli->query($sql)) {
					array_push($this->result, $this->mysqli->affected_rows);
				return true; //Update has been succesfully
				}else{
						array_push($this->result,$this->mysqli->error);
						return false; //Update has not been succesfully
				}
			}else{
				return false; //The table does not exist
			}
	}

//Function For delete the data
	public function delete($table,$where = null){
		// Check to if table exist.
		if ($this->tableexist($table)) {

			$sql = "DELETE FROM $table "; //Create query to delete rows
			if ($where != null) {
				$sql .= " WHERE $where";
			}
			//Make query to database
			if ($this->mysqli->query($sql)) {
				array_push($this->result,$this->mysqli->affected_rows);
				return true; // Delete has been succesfully
			}else{
				array_push($this->result,$this->mysqli->error);
				return false; // Delete has been succesfully
			}

		}else{
			return false;	//The table does not exist
		}
	}

	//Function To select from the databse
	public function select($table, $rows = "*", $join = null , $where = null, $orderby = null , $limit = null){
		// Check to if table exist.
			if ($this->tableexist($table)) {
				// Select command
				$sql = "SELECT $rows FROM $table ";
				// If condition to check join is null or not
				if ($join != null) {
					$sql .= " JOIN $join";
				}
				// If condition to check where is null or not
				if ($where != null) {
					$sql .= " WHERE $where";
				}
				// If condition to check orderby is null or not
				if ($orderby != null) {
					$sql .= " ORDER BY $orderby";
				}
				// If condition to check limit is null or not
				if ($limit != null) {
					$sql .= " LIMIT 0,$limit";
				}
				//Make query to database
				$query = $this->mysqli->query($sql);

				if ($query) {
					$this->result = $query->fetch_all(MYSQLI_ASSOC); // Fetch the data
					return true;  
				}else{
					array_push($this->result, $this->mysqli->error); //Show Error
					return false;
				}

			}else{
				return false; //The table does not exist
			}
	}


	//Function to fetch all data from databse by raw sql command
	public function sql($sql){

			$query = $this->mysqli->query($sql);
			if ($query) {
				$this->result = $query->fetch_all(MYSQLI_ASSOC);
				return true;
			}else{
				array_push($this->result, $this->mysqli->error);
				return false;
			}
	}

	//Function to get the result
  public function getresult(){
    $val = $this->result;
    $this->result = array();
    return $val;
  }

//Function for close the connection.
	public function __destruct(){
		//Check if the connection on	
		if ($this->conn) {
			$this->mysqli->close(); //Close The connection
			$this->conn = false;	//Make conn value false
			return true;	
		}else{
			return false;
		}
	}
}

?>