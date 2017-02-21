<main>
				<h3>Kontakt</h3>
				<?php
					if(isset($_POST['submitBtn'])) {
						echo '<p>Herzlichen Dank für ihre Anfrage! Aufgrund des derzeitigen Anfragevolumens kann die Beantwortung Ihrer Anfrage längere Zeit in Anspruch nehmen. <br>
						Wir bitten um ihr Verständnis und melden uns sobald wie möglich bei Ihnen.</p><br><br><p>Ihr blueIT-Team</p>';
						echo "<br>";
						echo "In Wahrheit is mit den Infos nix passiert. Hier das POST array: <br>";
						var_dump($_POST);
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
