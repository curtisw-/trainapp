<!doctype html>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<link rel="stylsheet" href="css/reset.css">
		<link rel="stylesheet" href="css/main.css">
	</head>

	<body>
		<div id="header">
			<h3>Train App v1.0</h3>
		</div>
		<div id="contents">
			<div id="traindata">
				<table border=0>
					<tr>
						<th>Train Line</th>
						<th>Route</th>
						<th>Run Number</th>
						<th>Operator ID</th>
					</tr>
					<tr>
						<td>line1</t>
						<td>apples</td>
						<td>403d</td>
						<td>Henry</td>
					</tr>
				</table>
			</div>
		
			<div id="uploadform">
				<form enctype="multipart/form-data" method="POST" action="uploadcsv.php">
					<input type="hidden" name="MAX_FILE_SIZE" value="30000">
					<input type="file" name="csv">
					<input type="submit" value="Upload">
				</form>
			</div>
		</div>
	</body>

</html>
