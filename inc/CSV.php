<?php


class UnreadableFileException extends Exception { }


class CSV {

	private $handle;

	public function __construct($filename) {
		$handle = @fopen($filename, "r");
		if(!$handle) {
			throw new UnreadableFileException();
		}
	}

}

?>
