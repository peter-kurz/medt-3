<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<title>index</title>
		<style>
		h3 {color:red;}
		</style>
	</head>
	<body>
		<?php 
			$actionwhitelist = array("main","contact","info");
			$action = str_replace("/medt/UE_SEO/","",$_SERVER['REQUEST_URI']);
			
			require "res/header.inc.php";
			
			if (in_array($action,$actionwhitelist))
			{
				switch ($action) {
					case "main":
						include "res/main.inc.php";
					break;

					case "contact":
						include "res/contact.inc.php";
					break;
					
					case "info":
						include "res/seo_info.inc.php";
					break;
				}
			}
			else
			{
				include "res/main.inc.php";
			}
			
			include "res/footer.inc.php";
			?>
	</body>
</html>