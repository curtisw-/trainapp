<!doctype html>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/main.css">
	</head>

	<body>
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
			<form method="POST" action="uploadcsv.php">
				<label>Upload data: <input type="file" name="csv"></label>
			</form>
		</div>
		
	</body>

</html>
