<?php
// Parse the given csv file and insert the data in the database

require_once 'inc/CSV.php';
require_once 'inc/DataSource.php';

try {
	if(isset($_FILES['csv'])) {
		$filename = $_FILES['csv']['tmp_name'];
	
		$csv = new CSV($filename);
		
		// The first row should be a header row
		$row = $csv->getNextRow();
		$mapping = array();
		foreach($row as $i => $item) {
			$mapping[trim($item)] = $i;
		}
		
		$datasource = new DataSource("traindata");
		
		// Followed by data rows
		while(($row = $csv->getNextRow()) !== false) {
			$datasource->addData(
				trim($row[$mapping['TRAIN_LINE']]),
				trim($row[$mapping['ROUTE_NAME']]),
				trim($row[$mapping['RUN_NUMBER']]),
				trim($row[$mapping['OPERATOR_ID']])
			);
		}
	}
} catch(Exception $e) {
	/* ignore errors */
}

// Redirect the user back to the main interface.
header('Location: index.php');

?>
