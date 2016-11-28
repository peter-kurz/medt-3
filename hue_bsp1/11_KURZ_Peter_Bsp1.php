<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Kurz Peter | PHP Bsp1</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	</head>
	<body>
		<h3>MEDT PHP Bsp1</h3>
		<h4>Kurz Peter | 3CHIT</h4><br>
		<form action="#" method="post">
			<label>Eingabe:<input type="text" name="inp"></label><br><br>
			<input type="submit" name="submitB" value="Explode! :D">
			<input type="reset" name="resetB" value="Reset :/">
		</form>
		<?php 
			if(isset($_POST['submitB'])) {
				$exArray = explode(' ',$_POST['inp']);
				
				echo "<br><p>Eingabe als Liste:</p><br>";
				
				echo "<ul>";
				foreach ($exArray as $item) {
					echo "<li>$item</li>";
				}
				echo "</ul>";
			}
		?>
	</body>
</html>