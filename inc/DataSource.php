<?php

class DBConnectionException extends Exception { }

// A MySQL data source for storing and retreiving train data.
class DataSource {
	private $conn;
	
	
	public function __construct($dbname, $host = 'localhost', $user = 'root', $pass = 'password') {
		$this->conn = @new mysqli($host, $user, $pass, $dbname);
		
		if($this->conn->connect_error) {
			throw new DBConnectionException($this->conn->connect_error);
		}
	}
	
	
	public function __destruct() {
		$this->conn->close();
	}
	
	
	// Retrieve all train data
	public function getData() {
		$result = $this->conn->query("SELECT id, line, route, run, operatorid FROM traindata");
		
		if(!$result)
			throw new DBConnectionException("Failure running query");
		
		$data = array();
			
		while(($row = $result->fetch_object()) !== null) {
			$data[] = (array)$row;
		}
		
		$result->close();
		
		return $data;
	}
	
	
	// Add additional train data
	public function addData($line, $route, $run, $operatorid) {
		$eline = $this->conn->escape_string($line);
		$eroute = $this->conn->escape_string($route);
		$erun = $this->conn->escape_string($run);
		$eoperatorid = $this->conn->escape_string($operatorid);
		
		// First check to make sure the row doesn't already exist
		$query = <<<END
SELECT * FROM traindata 
WHERE line = '$eline'
AND route = '$eroute'
AND run = '$erun'
AND operatorid = '$eoperatorid' 	
END;

		$result = $this->conn->query($query);
		if(!$result)
			throw new DBConnectionException("Failure inserting data");
			
		if($result->fetch_object() !== null)
			return;	
		
		// Then insert it into the database
		$query = <<<END
INSERT INTO traindata (line, route, run, operatorid) 
VALUES ('$eline', '$eroute', '$erun', '$eoperatorid')
END;
		
		$result = $this->conn->query($query);
		if($result !== true)
			throw new DBConnectionException("Failure inserting data");
	}
	
	
	// Remove a row of data given an id
	public function remove($id) {
		if(!is_int($id))
			throw new InvalidArgumentException("id must be an integer");
	
		$result = $this->conn->query("DELETE FROM traindata WHERE id = $id");
		if($result !== true)
			throw new DBConnectionException("Failure deleting row");
	}
}

?>
