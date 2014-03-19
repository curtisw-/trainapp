<?php

require_once 'inc/DataSource.php';

class DataSourceTest extends PHPUnit_Framework_TestCase {
	private $testdb = "traintest";

	public function testConnectSuccess() {
		$datasource = new DataSource($this->testdb);
	}
	
	/**
	 * @expectedException DBConnectionException
	 */
	public function testConnectFailure() {
		$datasource = new DataSource("nonexistantdbname");
	}
	
	public function testReadWrite() {
		$datasource = new DataSource($this->testdb);
		
		$data = $datasource->getData();
		
		foreach($data as $row) {
			$datasource->remove((int)$row["id"]);
		}
		
		$this->assertEquals(0, count($datasource->getData()));
		
		$datasource->addData("cta", "red", "10A", "Dave");
		
		$data = $datasource->getData();
		
		$this->assertEquals(1, count($data));
		$row = $data[0];
		$this->assertEquals("cta", $row["line"]);
		$this->assertEquals("red", $row["route"]);
		$this->assertEquals("10A", $row["run"]);
		$this->assertEquals("Dave", $row["operatorid"]);
	}
}

?>
