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
				<form method="POST" action="uploadcsv.php">
					<label>Upload data: <input type="file" name="csv"></label>
				</form>
			</div>
		</div>
	</body>

</html>
