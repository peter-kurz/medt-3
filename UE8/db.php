<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<title></title>
	</head>
	<body>
		<div class="container">
			<?php
				$host = 'localhost';
				$dbname = 'medt3';
				$user = 'htluser';
				$pwd = 'htluser';
				
				$db = new PDO ( "mysql:host=$host;dbname=$dbname", $user, $pwd);
				if ($db == true)
					echo "Datenbank Zugriff erfolgreich";
				else
					echo "Datenbank Zugriff nicht erfolgreich";
			?>
		</div>
	</body>
</html>
