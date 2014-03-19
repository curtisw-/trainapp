<?php
// Test the CSV class

require_once 'inc/CSV.php';

class CSVTest extends PHPUnit_Framework_TestCase {

	/**
	 * @expectedException UnreadableFileException
	 */
	public function testFailureOnNonexistantFile() {
		// Make sure it throws an exception when given a nonexistant file
		$file = tempnam("/tmp", "csv");
		unlink($file);
		$csv = new CSV($file);
	}
	
	public function testSuccessOnExistingFile() {
		// Make sure no exceptions are thrown when given an existing file
		$file = tempnam("/tmp", "csv");
		file_put_contents($file, "");
		$csv = new CSV($file);
	}

	public function testFileRead() {
		// Make sure the contents of the csv file are parsed correctly, especially
		// with regards to spaces and escaped commas.
		$file = tempnam("/tmp", "csv");
		
		$contents = <<<END
first, sec ond
"third,"
fourth, fifth
END;
		$data = array(
			array("first", "sec ond"),
			array("third,"),
			array("fourth", "fifth"));
		
		file_put_contents($file, $contents);
		$csv = new CSV($file);
		$i = 0;
		while(($row = $csv->getNextRow()) !== false) {
			for($j = 0; $j < count($row); ++$j) {
				$this->assertEquals(trim($data[$i][$j]), trim($row[$j]));
			}
			$i++;
		}
		$this->assertEquals($i, count($data));
	}

}

?>
