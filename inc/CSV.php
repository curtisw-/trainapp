<?php
// Parse a CSV file and return each row in turn.

class UnreadableFileException extends Exception { }


class CSV {

	private $handle;

	public function __construct($filename) {
		$handle = @fopen($filename, "r");
		if(!$handle) {
			throw new UnreadableFileException();
		}
	}
	
	public function getNextRow() {
		return false;
	}

}

?>
