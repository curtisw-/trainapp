<?php
// Test the CSV class

require_once 'inc/CSV.php';

class CSVTest extends PHPUnit_Framework_TestCase {

	/**
	 * @expectedException NoSuchFileException
	 */
	public function testFailureOnNonexistantFile() {
		$file = tempnam("/tmp", "csv");
		
		$csv = new CSV($file);
	}

}

?>
