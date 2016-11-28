<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Kurz Peter | PHP Bsp1</title>
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