<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Rôles non affectés</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.15/r-2.1.1/datatables.min.css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.15/r-2.1.1/datatables.min.js"></script>
	<style type="text/css">
	* {
		font-family: sans-serif;
	}
	</style>
	<script>
		$(document).ready(function(){
		    $('#roles').DataTable({
			    "pageLength": 100
		    });
		});
	</script>
</head>
<body>
	<h1><?=count($roles)?> rôles non attribués</h1>
	<table id="roles" class="display">
		<thead>
		<tr>
			<th>Cercle</th>
			<th>Rôle</th>
			<th>Raison d'être</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ( $roles as $role):?>
			<tr>
				<td><a href="https://fr.glassfrog.com/circles/<?=$role["circle_id"]?>"?><?=$role["circle"]?></a></td>
				<td><a href="https://fr.glassfrog.com/roles/<?=$role["role_id"]?>"?><?=$role["role"]?></a></td>
				<td><?=$role["purpose"]?></td>
			</tr>
		<?php endforeach?>
		</tbody>
	</table>

</body>
</html>