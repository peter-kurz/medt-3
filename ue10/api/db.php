<?php
				$host = 'localhost';
				$dbname = 'medt3';
				$user = 'htluser';
				$pwd = 'htluser';
				try {
				$db = new PDO ( "mysql:host=$host;dbname=$dbname", $user, $pwd);
				}
				catch (PDOException $e) {
					echo "<strong>PDO Exception aufgetreten.</strong><br>";
					echo $e->getMessage();
					echo "<br><br><strong>Datenbankzugriff nicht erfolgreich.</strong>";
					$db = false;
					exit();
				}
?>
