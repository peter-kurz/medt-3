<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<title></title>
	</head>
	<body>
		<div class="container">
			<?php 
					$host = 'localhost';
					$dbname = 'classicmodels';
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
					if (isset($_GET['page']) && $_GET['page'] > 0)
						$page = $_GET['page'];
					else
						$page = 1;
					if (isset($_POST['count']) && $_POST['count'] > 0)
						$count = $_POST['count'];
					else
						$count = 20;
					$lowlimit = $count * ($page - 1);
					$query = $db->query("SELECT count(customerNumber)/20 from customers");
					$maxval = ceil($query->fetch()[0]);
					//$maxval = ceil((float)$maxval / (float)$count);
					$query = $db->query("SELECT customerNumber,customerName,contactLastName,contactFirstName FROM customers LIMIT $lowlimit,$count");
				?>
			<table class="table table-hover">
				<th>Number</th>
				<th>Name</th>
				<th>Last Name</th>
				<th>First Name</th>
				<?php
					foreach ($query->fetchAll(PDO::FETCH_OBJ) as $item) {
				?>
					<tr>
						<td><?php echo $item->customerNumber; ?></td>
						<td><?php echo $item->customerName; ?></td>
						<td><?php echo $item->contactLastName; ?></td>
						<td><?php echo $item->contactFirstName; ?></td>
					</tr>
				<?php
					}
				?>
			</table>
			<p style="text-align:center;font-size:150%"><a href="index.php?page=1"><<</a>
			<a href="index.php?page=<?php echo $page-1; ?>"><</a>
			<?php echo $page; ?>
			<a href="index.php?page=<?php echo $page+1; ?>">></a>
			<a href="index.php?page=<?php echo $maxval; ?>">>></a>
			<br><form action="index.php?page=<?php echo $page; ?>" method="post">
				<select name="count" value="<?php echo $count; ?>">
				  <option value="10">10</option>
				  <option value="15">15</option>
				  <option value="20">20</option>
				  <option value="25">25</option>
				</select>
				<input type="submit" value="Go">
			</form>
			</p>
		</div>
	</body>
</html>
