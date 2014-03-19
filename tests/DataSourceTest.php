<?php
// Test the DataSource class using the test DataBase - 'traintest'

require_once 'inc/DataSource.php';

class DataSourceTest extends PHPUnit_Framework_TestCase {
	private $testdb = "traintest";

	public function testConnectSuccess() {
		// Make sure there are no errors initializing the data source
		$datasource = new DataSource($this->testdb);
	}
	
	/**
	 * @expectedException DBConnectionException
	 */
	public function testConnectFailure() {
		// Ensure an exception is thrown given a nonexistant database name
		$datasource = new DataSource("nonexistantdbname");
	}
	
	public function testReadWrite() {
		$datasource = new DataSource($this->testdb);
		
		// Remove all the rows in the database
		$data = $datasource->getData();
		
		foreach($data as $row) {
			$datasource->remove((int)$row["id"]);
		}
		
		$this->assertEquals(0, count($datasource->getData()));
		
		// Then check to make sure we can add data
		$datasource->addData("cta", "red", "10A", "Dave");
		
		$data = $datasource->getData();
		
		$this->assertEquals(1, count($data));
		$row = $data[0];
		$this->assertEquals("cta", $row["line"]);
		$this->assertEquals("red", $row["route"]);
		$this->assertEquals("10A", $row["run"]);
		$this->assertEquals("Dave", $row["operatorid"]);
	}
	
	public function testDuplicates() {
		// Check to make sure rows cannot be duplicated
		$datasource = new DataSource($this->testdb);
		
		$datasource->addData("metra", "electric", "6C", "Steve");
		$datasource->addData("metra", "electric", "6C", "Steve");
		
		$data = $datasource->getData();
		$count = 0;
		foreach($data as $row) {
			if($row["line"] == "metra" &&
				$row["route"] == "electric" &&
				$row["run"] == "6C" &&
				$row["operatorid"] == "Steve") {
				$count++;	
			}
		}
		
		$this->assertEquals($count, 1);
	}
}

?>
