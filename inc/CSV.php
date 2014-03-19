<?php

class UnreadableFileException extends Exception { }

// Load a CSV file
class CSV {

	private $handle;

	public function __construct($filename) {
		$this->handle = @fopen($filename, "r");
		if(!$this->handle) {
			throw new UnreadableFileException();
		}
	}
	
	public function __destruct() {
		fclose($this->handle);
	}
	
	// Return the next row as an array, or false if none exists.
	// Keep in mind fgetcsv also returns false on error, but
	// that's fine for what we need it for.
	public function getNextRow() {
		return fgetcsv($this->handle);
	}

}

?>
