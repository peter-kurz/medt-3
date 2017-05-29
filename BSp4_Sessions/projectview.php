<?php
	require "isLoggedIn.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<title>Project DB</title>
		<style>.glyphicon {margin-right:20px;}</style>
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
							echo "<form action=\"projectview.php\" method=\"POST\">";
								echo '<div class="form-group">';
								echo "<input name=\"editParam\" value=\"".$_GET['editParam']."\" hidden>";
								echo "<label>Name <input class=\"form-control\" type=\"text\" name=\"name\" value=\"".$data->name."\" required></label><br>";
								echo "<label>Description <input class=\"form-control\" type=\"text\" name=\"desc\" value=\"".$data->description."\"></label><br>";
								echo "<label>Create Date <input class=\"form-control\" type=\"date\" name=\"createDate\" value=\"".$data->createDate."\"></label><br>";
								echo '<br><input style="margin-right:20px;" type="submit" name="submitBtn">';
								echo '<a href="projectview.php"><span style="margin-right:5px;" class="glyphicon glyphicon-remove"></span>Abbrechen</a>';
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
							echo "<form action=\"projectview.php\" method=\"POST\">";
								echo '<div class="form-group">';
								echo "<label>Name <input class=\"form-control\" type=\"text\" name=\"name\" required></label><br>";
								echo "<label>Description <input class=\"form-control\" type=\"text\" name=\"desc\"></label><br>";
								echo "<label>Create Date <input class=\"form-control\" type=\"date\" name=\"createDate\"></label><br>";
								echo '<br><input style="margin-right:20px;" type="submit" name="createProject">';
								echo "<input name=\"createProject\" value=\"".$_GET['createProject']."\" hidden>";
								echo '<a href="projectview.php"><span style="margin-right:5px;" class="glyphicon glyphicon-remove"></span>Abbrechen</a>';
								echo '</div>';
						echo "</form><br>";
					}
				}
				
					echo '<h2><span class="glyphicon glyphicon-home"></span>Projektübersicht</h2>';
					echo '<a href="#" class="btn btn-info" role="button"><span class="glyphicon glyphicon-refresh"></span> Refresh</a><br><br>';
					echo "<a href=\"http://localhost/medt/BSp4_Sessions/index.php?logout=true\" class=\"btn btn-warning\" role=\"button\"><span class=\"glyphicon glyphicon-off\"></span> Logout ".$_SESSION['user']."</a><br><br>";
					echo '<a href="projectview.php?createProject" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-tasks"></span> Neues Projekt erstellen</a>';
					if (isset($rowCount))
					{
						if ($rowCount == 1)
							echo '<br><br><span class="label label-success">Die Operation wurde ausgeführt.</span><br>';
						else
							echo '<br><br><span class="label label-danger">Die Operation hat keine Zeilen betroffen.</span><br>';
					}
					
					echo '<table class="table table-hover">';
					echo "<thead>";
						echo "<th>Name</th>";
						echo "<th>Description</th>";
						echo "<th>Create Date</th>";
						echo "<th>Aktion</th>";
					echo "</thead>";
					
					//$ParamCounter = 1;
					$query = $db->query("SELECT name, description, createdate, id FROM project");
					foreach ($query->fetchAll(PDO::FETCH_OBJ) as $item) { //static zugriff in PHP mit '::'!
						$itemID = $item->id;
						echo "<tr>";
							echo "<td>$item->name</td>";
							echo "<td>$item->description</td>";
							echo "<td>$item->createdate</td>";
							echo "<td><a href=\"projectview.php?editParam=".$itemID."\"><span class=\"glyphicon glyphicon-wrench\"></span></a><a href=\"projectview.php?deleteParam=".$itemID."\"><span class=\"glyphicon glyphicon-trash\"></span></a></td>";
						echo "</tr>";
						//$ParamCounter++;
					}
					echo "</table>";
					echo "<br><br>";
			?>
		</div>
	</body>
</html>