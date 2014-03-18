<?php

class UnreadableFileException extends Exception { }

// Parse a CSV file and return each row in turn.
// Return false when there are no more rows.
class CSV {

	private $handle;

	public function __construct($filename) {
		$handle = @fopen($filename, "r");
		if(!$handle) {
			throw new UnreadableFileException();
		}
	}
	
	public function __destruct() {
		fclose($handle);
	}
	
	public function getNextRow() {
		$values = fgetcsv($handle);
		
		return $values;
	}

}

?>
