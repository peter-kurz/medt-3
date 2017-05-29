<?php
				require "db.php";
				if (isset($_POST['editParam']) || isset($_POST['deleteParam']))
				{
					if (isset($_POST['editParam']))
					{
							$query = $db->prepare("UPDATE project SET name=:name,description=:desc,createDate=:date WHERE id= :id");
							$query->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
							$query->bindParam(':desc', $_POST['desc'], PDO::PARAM_STR);
							$query->bindParam(':date', $_POST['createDate']);
							$query->bindParam(':id', $_POST['editParam'], PDO::PARAM_INT);
							$query->execute();
							if ($query != false && $query->rowCount() == 1)
							{
								echo json_encode(array("edit"=>1));
								exit();
							}
							else
							{
								echo json_encode(array("edit"=>0));
								exit();
							}
					}
					else {
						$query = $db->prepare('DELETE FROM project WHERE id= :id');
						$query->bindParam(':id', $_POST['deleteParam'], PDO::PARAM_INT);
						$query->execute();
						if ($query != false && $query->rowCount() == 1)
						{
							echo json_encode(array("delete"=>1));
							exit();
						}
						else
						{
							echo json_encode(array("delete"=>0));
							exit();
						}
					}
				}
					if (isset($_POST['createProject'])) 
					{
						$query = $db->prepare("INSERT into project (name,description,createDate) VALUES (:name,:description,:createDate)");
						$query->bindParam(':name',$_POST['name'],PDO::PARAM_STR);
						$query->bindParam(':description',$_POST['desc'],PDO::PARAM_STR);
						$query->bindParam(':createDate',$_POST['createDate']);
						$query->execute();
						echo "1";
						exit();
						if ($query != false)
							$rowCount = $query->rowCount();
					}
?>