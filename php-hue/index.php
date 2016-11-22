<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>HÜ - 5.1 & 5.2</title>
	</head>
	<body>
		<h1>HÜ - 5.1 & 5.2</h1>
		<h2>$_SERVER im Überblick</h2>
		<h3>Peter Kurz | 3CHIT</h3>
		<table border="1">
		<tr>
			<th>Variable</th>
			<th>Wert</th>
		</tr>
		<tr>
			<td>Skript-Pfad</td>
			<td><?php echo $_SERVER['PHP_SELF'];?></td>
		</tr>
		<tr>
			<td>Server-Name/IP</td>
			<td><?php echo $_SERVER['SERVER_ADDR'];?></td>
		</tr>
		<tr>
			<td>Protokoll</td>
			<td><?php echo $_SERVER['SERVER_PROTOCOL'];?></td>
		</tr>
		<tr>
			<td>Client-IP</td>
			<td><?php echo $_SERVER['REMOTE_ADDR'];?></td>
		</tr>
		<tr>
			<td>URI</td>
			<td><?php echo $_SERVER['REQUEST_URI'];?></td>
		</tr>
		<tr>
			<td>Server-Info</td>
			<td><?php echo $_SERVER['SERVER_SIGNATURE'];?></td>
		</tr>
		</table>
		<br><br>
		<h2>SimpleForm</h2>
		<?php
			if(isset($_GET['submitBtn'])){?>
				<ul>
					<li>Vorname: <?php echo $_GET['vn'];?></li>
					<li>Nachname: <?php echo $_GET['nn'];?></li>
					<li>Tag und Ort der Geburt: <?php echo $_GET['geb'];?></li>
				</ul>
		<?php } ?>
		<form action="//localhost/medt/php-hue/">
			Vorname:<br>
			<input type="text" name="vn"><br>
			Nachname:<br>
			<input type="text" name="nn"><br>
			Tag u. Ort der Geburt:<br>
			<input type="text" name="geb"><br>
			<input type="submit" name="submitBtn" value="Abschicken">
		</form>
	</body>
</html>