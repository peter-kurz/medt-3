<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<title>Grid Generator</title>
	</head>
	<body>
		<div class="container">
			<h3>Grid Generator (TM) by Peter Kurz (TM) 3CHIT (TM)</h3><br>
			<form action="#" method="post">
			<label>Anzahl: <input type="text" name="num" required></label><br>
			<label><input type="checkbox" name="cb[]" value="Montag"> Montag</label><br>
			<label><input type="checkbox" name="cb[]" value="Dienstag"> Dienstag</label><br>
			<label><input type="checkbox" name="cb[]" value="Mittwoch"> Mittwoch</label><br>
			<label><input type="checkbox" name="cb[]" value="Donnerstag"> Donnerstag</label><br>
			<label><input type="checkbox" name="cb[]" value="Freitag"> Freitag</label><br>
			<label><input type="checkbox" name="cb[]" value="Samstag"> Samstag</label><br>
			<label><input type="checkbox" name="cb[]" value="Sonntag"> Sonntag</label><br><br>
			<input type="submit" name="submitBtn" value="Submit">
			<input type="reset" name="resetBtn" value="Reset">
			</form><br><br>
			
			<?php
				if (!isset($_POST['submitBtn']))
				{
					exit;
				}
				$cb = $_POST['cb'];
				echo "<div class=\"table-responsive\">";
					echo "<table class=\"table\">";
						echo "<thead>";
							echo "<tr>";
								echo "<th>Day</th>";
								for ($i = 1; $i <= $_POST['num'];$i++) 
								{
									echo "<th>Event {$i}</th>";
								}
							echo "</tr>";
						echo "</thead>";
						echo "<tbody>";
							for ($o = 0; $o < sizeof($cb);$o++)
							{
								echo "<tr>";
									echo "<td>";
										echo $cb[$o];
									echo "</td>";
									for ($i = 0; $i < $_POST['num'];$i++) 
									{
										echo "<td>event {$o}.{$i}</td>";
									}
								echo "</tr>";
							}
						echo "</tbody>";
					echo "</table>";
				echo "</div>";
			?>
		</div>
	</body>
</html>