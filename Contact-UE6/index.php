<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<title>Contact</title>
		<style>
			nav ul li {list-style-type:none;
						float:left;
						margin-right:20px;}
			main h3 {color:red;}
		</style>
	</head>
	<body>
		<div class="container">
			<header>
				<h1>company name, slogan, whatevs</h1>
			</header>
			<nav>
				<ul>
					<li><a href="#">Home</a></li>
					<li><a href="#">About</a></li>
					<li><a href="#">Portfolio</a></li>
					<li><a href="#">Contact</a></li>
					<li><a href="#">Login</a></li>
				</ul>
			</nav><br>
			<main>
				<h3>Kontakt</h3>
				<?php
					if(isset($_POST['submitBtn'])) {
						echo '<p>Herzlichen Dank für ihre Anfrage! Aufgrund des derzeitigen Anfragevolumens kann die Beantwortung Ihrer Anfrage längere Zeit in Anspruch nehmen. <br>
						Wir bitten um ihr Verständnis und melden uns sobald wie möglich bei Ihnen.</p><br><br><p>Ihr blueIT-Team</p>';
					}
					else {
						echo '<p>Wir freuen uns auf ihre Anfrage.</p><br>';
						echo '<form action="#" method="post">';
						echo '<p>Der Grund für Ihre Anfrage:</p><br>';
						echo '<label><input type="radio" name="grund" value="stellen" required> Freie Stellen</label><br>';
						echo '<label><input type="radio" name="grund" value="reklamation"> Produktreklamation</label><br>';
						echo '<label><input type="radio" name="grund" value="neuheiten"> Produktneuheiten</label><br><br>';
						echo 'Anrede*  <label><input type="radio" name="anrede" value="frau" required> Frau</label>  <label><input type="radio" name="anrede" value="herr"> Herr</label><br><br>';
						echo '<label>Vorname* <input type="text" name="vn" required></label>  <label>Nachname* <input type="text" name="nn" required></label><br>';
						echo '<label>Straße <input type="text" name="straße"></label>  <label>PLZ <input type="text" name="plz"></label><br>';
						echo '<label>Ort <input type="text" name="ort"></label>  <label>Land <input type="text" name="land"></label><br>';
						echo '<label>Tel. <input type="text" name="tel"></label>  <label>E-Mail <input type="text" name="email"></label><br><br>';
						echo 'Anfrage* <textarea rows="4" cols="50" required></textarea><br>';
						echo '<br><input type="submit" name="submitBtn">';
						echo '</form>';
					}
				?>
			</main>
		</div>
	</body>
</html>