<?php
// Test the CSV class

require_once 'inc/CSV.php';

class CSVTest extends PHPUnit_Framework_TestCase {

	/**
	 * @expectedException UnreadableFileException
	 */
	public function testFailureOnNonexistantFile() {
		$file = tempnam("/tmp", "csv");
		unlink($file);
		$csv = new CSV($file);
	}
	
	public function testSuccessOnExtantFile() {
		$file = tempnam("/tmp", "csv");
		file_put_contents($file, "");
		$csv = new CSV($file);
	}

}

?>
