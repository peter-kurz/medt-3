<?php
	require "api/db.php";
?>
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
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script>
			var id;
			var editrow;
			$(document).ready(function() {
				$("#msgbox").hide(); // msgbox verstecken
				$('.editicon').click(editConfirm);
				$('.deleteicon').click(deleteConfirm);
				
				$("#editModalConfirm").click(function() {
					$("#editModal").modal('hide');
					var ajaxConfigObj = {
						url: "http://localhost/medt/ue10/api/trackstar.php", //Default: Aktuelle Seite
						dataType: "json",
						type: "post", // type KLEIN SCHREIBEN!!!!!
						data: {'editParam' : id,'name' : $("#name").val(),'desc' : $("#desc").val(),'createDate' : $("#date").val()},
						// data:{data1:xyz,data2:xyz,...}
						success: function(dataFromServer, textStatus, jqXHR){
							console.log("Server response: "+dataFromServer.edit);
							if (dataFromServer.edit) {
								editrow.children('.tdname').html($("#name").val());
								editrow.children('.tddesc').html($("#desc").val());
								editrow.children('.tddate').html($("#date").val());
								$("#msgbox").text("Projekt bearbeitet").removeClass("alert-danger").addClass("alert-success").show(500).delay(2500).hide(500);
							}
							else {
								$("#msgbox").text("Projekt konnte nicht bearbeitet.").removeClass("alert-success").addClass("alert-danger").show(500).delay(2500).hide(500);
							}
						},
						error: function(jqXHR,msg) { //Ziel wenn die HTTP Response nicht vom Status Code 200 ist
							console.log("Error: Server response was "+msg);
							$("#msgbox").text("Kommunikation mit dem Server nicht möglich.").removeClass("alert-success").addClass("alert-danger").show(500).delay(2500).hide(500);
						},
					};
					$.ajax(ajaxConfigObj);
					$('#deleteModal').modal('hide');
				});
				
				$("#deleteModalAccept").click(function() {
				var ajaxConfigObj = {
						url: "http://localhost/medt/ue10/api/trackstar.php", //Default: Aktuelle Seite
						dataType: "json",
						type: "post", // type KLEIN SCHREIBEN!!!!!
						data: {'deleteParam' : id},
						// data:{data1:xyz,data2:xyz,...}
						success: function(dataFromServer, textStatus, jqXHR){
							console.log("Server response: "+dataFromServer.delete);
							if (dataFromServer.delete) {
								//$($(this).closest("tr")).remove;
								//$('p[data-id='+id+']').remove();
								//$(this).parents('tr').remove();
								
								$("#"+id).hide(500);
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
					$('#deleteModal').modal('hide');
			});
			});
			
			function editConfirm() {
				editrow = $(this).parent().parent();
				id = editrow.attr('id');
				$("#name").attr('value',editrow.children('.tdname').html());
				$("#desc").val(editrow.children('.tddesc').html());
				$("#date").attr('value',editrow.children('.tddate').html());
				$("#editModal").modal('show');
			}
			
			function deleteConfirm() {
				id = $(this).parent().parent().attr('id');
				$('#deleteModal').modal('show');
				//if (confirm("Möchten sie das Projekt mit der ID "+id+" wirklich löschen? Diese Aktion kann nicht rückgängig gemacht werden.")){
					
				//}
			}
		</script>
	</head>
	<body>
		<div class="container">
				<h2><span class="glyphicon glyphicon-home"></span>Projektübersicht</h2>
				<!--<p id="msgbox" class="box"></p>-->
				<div id="msgbox" class="alert" role="alert"></div>
				<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Projekt löschen</h4>
					  </div>
					  <div class="modal-body">
						<p>Möchten sie das Projekt entfernen?</p>
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Nein, abbrechen.</button>
						<button type="button" class="btn btn-primary" id="deleteModalAccept">Ja, entfernen.</button>
					  </div>
					</div><!-- /.modal-content -->
				  </div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
				
				<div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="exampleModalLabel">Projekt bearbeiten</h4>
					  </div>
					  <div class="modal-body">
						<form id="projectEditForm">
						  <div class="form-group">
							<label for="name" class="control-label">Projekt Name:</label>
							<input type="text" class="form-control" id="name">
						  </div>
						  <div class="form-group">
							<label for="desc" class="control-label">Beschreibung:</label>
							<textarea class="form-control" id="desc"></textarea>
						  </div>
						  <div class="form-group">
							<label for="date" class="control-label">CreateDate:</label>
							<input type="date" class="form-control" id="date"></textarea>
						  </div>
						</form>
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" id="editModalConfirm">Send message</button>
					  </div>
					</div>
				  </div>
				</div>
				
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
						echo "<tr id=\"$item->id\">";
							echo "<td class=\"tdname\">$item->name</td>";
							echo "<td class=\"tddesc\">$item->description</td>";
							echo "<td class=\"tddate\">$item->createdate</td>";
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