<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<title>Project DB</title>
		<style>.glyphicon {margin-right:20px;}
				.box {font-size:110%;}</style>
		<script
			src="https://code.jquery.com/jquery-3.2.1.min.js"
			integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
			crossorigin="anonymous"></script>
		<script>
			$(document).ready(function() {
				$("#msgbox").hide(); // msgbox verstecken
				$('.editicon').click(editConfirm);
				$('.deleteicon').click(deleteConfirm);
			});
			
			function editConfirm() {
				alert("Projekt "+$(this).parent().parent().attr('data-id')+" wird bearbetiet.");
			}
			
			function deleteConfirm() {
				var id = $(this).parent().parent().attr('data-id');
				if (confirm("Möchten sie das Projekt mit der ID "+id+" wirklich löschen? Diese Aktion kann nicht rückgängig gemacht werden.")){
					var ajaxConfigObj = {
						url: "http://localhost/medt/ue10", //Default: Aktuelle Seite
						type: "get", // type KLEIN SCHREIBEN!!!!!
						data: "deleteParam=" + id,
						// data:{data1:xyz,data2:xyz,...}
						success: function(dataFromServer, textStatus, jqXHR){
							console.log("Server response: "+dataFromServer);
							if (dataFromServer) {
								//$($(this).closest("tr")).hide(500);
								//$('p[data-id='+id+']').remove();
								$(this).parents('tr').remove();
								$("#msgbox").text("Projekt gelöscht").removeClass("alert-danger").addClass("alert-success").show(500).delay(2500).hide(500);
								//Löschen erfolgreich: Zeile aus der Tabelle entfernen (remove oder hide) und Meldung anzeigen (msgbox, css nicht vergessen)
							}
							else {
								$("#msgbox").text("Projekt konnte nicht entfernt werden.").removeClass("alert-success").addClass("alert-danger").show(500).delay(2500).hide(500);
								//Löschen nicht erfolgreich: Meldung mit Fehler anzeigen (msgbox, css nicht vergessen)
							}
						},
						error: function(jqXHR,msg) { //Ziel wenn die HTTP Response nicht vom Status Code 200 ist
							console.log("Error: Server response was "+msg);
							$("#msgbox").text("Kommunikation mit dem Server nicht möglich.").removeClass("alert-success").addClass("alert-danger").show(500).delay(2500).hide(500);
						},
					};
					$.ajax(ajaxConfigObj);
				}
			}
		</script>
	</head>
	<body>
		<div class="container">
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
				if (isset($_GET['editParam']) || isset($_POST['editParam']) || isset($_GET['deleteParam']))
				{
					if (isset($_GET['editParam']) || isset($_POST['editParam']))
					{
						if (isset($_POST['submitBtn'])) 
						{
							$query = $db->prepare("UPDATE project SET name=:name,description=:desc,createDate=:date WHERE id= :id");
							$query->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
							$query->bindParam(':desc', $_POST['desc'], PDO::PARAM_STR);
							$query->bindParam(':date', $_POST['createDate']);
							$query->bindParam(':id', $_POST['editParam'], PDO::PARAM_INT);
							$query->execute();
							if ($query != false)
								$rowCount = $query->rowCount();
						}
						else {
							$query = $db -> prepare("SELECT name, description, id, createDate FROM project WHERE id=:id");
							$query -> bindParam(':id',$_GET['editParam'],PDO::PARAM_INT);
							$query->execute();
							$data = $query->fetch(PDO::FETCH_OBJ);
							echo '<h4><span class="glyphicon glyphicon-edit"></span>';
							echo "Sie bearbeiten das Projekt \"$data->name\".</h4>";
							echo "<p>Projekt-ID: $data->id</p>";
							echo "<form action=\"index.php\" method=\"POST\">";
								echo '<div class="form-group">';
								echo "<input name=\"editParam\" value=\"".$_GET['editParam']."\" hidden>";
								echo "<label>Name <input class=\"form-control\" type=\"text\" name=\"name\" value=\"".$data->name."\" required></label><br>";
								echo "<label>Description <input class=\"form-control\" type=\"text\" name=\"desc\" value=\"".$data->description."\"></label><br>";
								echo "<label>Create Date <input class=\"form-control\" type=\"date\" name=\"createDate\" value=\"".$data->createDate."\"></label><br>";
								echo '<br><input style="margin-right:20px;" type="submit" name="submitBtn">';
								echo '<a href="index.php"><span style="margin-right:5px;" class="glyphicon glyphicon-remove"></span>Abbrechen</a>';
								echo '</div>';
							echo "</form><br>";
						}
					}
					else {
						$query = $db->prepare('DELETE FROM project WHERE id= :id');
						$query->bindParam(':id', $_GET['deleteParam'], PDO::PARAM_INT);
						$query->execute();
						if ($query != false)
							$rowCount = $query->rowCount();
					}
				}
					
				if (isset($_GET['createProject']) || isset($_POST['createProject']))
				{
					if (isset($_POST['createProject'])) 
					{
						$query = $db->prepare("INSERT into project (name,description,createDate) VALUES (:name,:description,:createDate)");
						$query->bindParam(':name',$_POST['name'],PDO::PARAM_STR);
						$query->bindParam(':description',$_POST['desc'],PDO::PARAM_STR);
						$query->bindParam(':createDate',$_POST['createDate']);
						$query->execute();
						if ($query != false)
							$rowCount = $query->rowCount();
					}
					else { 
						echo '<h4><span class="glyphicon glyphicon-tasks"></span>';
							echo "Sie erstellen ein neues Projekt.</h4>";
							echo "<form action=\"index.php\" method=\"POST\">";
								echo '<div class="form-group">';
								echo "<label>Name <input class=\"form-control\" type=\"text\" name=\"name\" required></label><br>";
								echo "<label>Description <input class=\"form-control\" type=\"text\" name=\"desc\"></label><br>";
								echo "<label>Create Date <input class=\"form-control\" type=\"date\" name=\"createDate\"></label><br>";
								echo '<br><input style="margin-right:20px;" type="submit" name="createProject">';
								echo "<input name=\"createProject\" value=\"".$_GET['createProject']."\" hidden>";
								echo '<a href="index.php"><span style="margin-right:5px;" class="glyphicon glyphicon-remove"></span>Abbrechen</a>';
								echo '</div>';
						echo "</form><br>";
					}
				}
				
				?>
				<h2><span class="glyphicon glyphicon-home"></span>Projektübersicht</h2>
				<!--<p id="msgbox" class="box"></p>-->
				<div id="msgbox" class="alert" role="alert"></div>
				<table class="table table-hover">
				<thead>
					<th>Name</th>
					<th>Description</th>
					<th>Create Date</th>
					<th>Aktion</th>
				</thead>
				<?php
					//$ParamCounter = 1;
					$query = $db->query("SELECT name, description, createdate, id FROM project");
					foreach ($query->fetchAll(PDO::FETCH_OBJ) as $item) { //static zugriff in PHP mit '::'!
						echo "<tr data-id=\"$item->id\">";
							echo "<td>$item->name</td>";
							echo "<td>$item->description</td>";
							echo "<td>$item->createdate</td>";
							echo "<td><span class=\"glyphicon glyphicon-pencil editicon\"></span><span class=\"glyphicon glyphicon-remove deleteicon\"></span></td>";
						echo "</tr>";
						//$ParamCounter++;
					}
				?>
				</table>
				<br><br>
		</div>
	</body>
</html>
