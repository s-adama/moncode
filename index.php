<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initiale scale=1" >
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Holtwood+One+SC" type="text/css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" type="text/css" href="../styles.css">

	<title></title>
</head>
      
<body>
	<h1 class="text-logo"><span class="glyphicon glyphicon-cutlery "></span>Burger Code <span class="glyphicon glyphicon-cutlery "></span></h1>
	<div class="container admin">
		<div class="row">
			<h1><strong>liste des items</strong><a href="insert.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span>Ajouter </a></h1>



			


				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Nom</th>
							<th>Description</th>
							<th>Prix</th>
							<th>Categorie</th>
							<th>Action</th>
						</tr>
						
					</thead>
					<tbody>

						<?php 

						require'database.php';

						$db = Database::connect();
						$statement = $db->query('SELECT items.id,items.name,items.description,items.price,categories.name As category
							                     FROM items LEFT JOIN categories ON items.category = categories.id');
						while ($items = $statement->fetch()) {
							echo '<tr>';
							echo '<td>' . $items['name']  .'</td>';
							echo '<td>' . $items['description']  .'</td>';
							echo '<td>' . $items['price']  .'</td>';
							echo '<td>' . $items['category']  .'</td>';
							
							echo'<td width=300>';
								echo'<a href="view.php?id=' . $items['id'] .'" class="btn btn-default"><span class="glyphicon glyphicon-eye-open">Voir</a>';
								echo' ';
								echo'<a href="update.php?id=' . $items['id'] .'" class="btn btn-primary "><span class="glyphicon glyphicon-pencil">Modifier</a>';
								echo' ';
								echo'<a href="delete.php?id=' . $items['id'] . '" class="btn btn-danger "><span class="glyphicon glyphicon-remove">Suprimer</a>';
								
							echo'</td>';
						echo'</tr>';
						}
						Database::disconnect();



						 ?>



						<tr>
							<td>items1</td>
							<td>Description1</td>
							<td>Prix1</td>
							<td>Categorie1</td>
							<td width=300>
								<a href="view.php?id=1" class="btn btn-default"><span class="glyphicon glyphicon-eye-open">Voir</a>
								<a href="update.php?id=1" class="btn btn-primary "><span class="glyphicon glyphicon-pencil">Modifier</a>
								<a href="delete.php?id=1" class="btn btn-danger "><span class="glyphicon glyphicon-remove">Suprimer</a>
								
							</td>
						</tr>
						<tr>
							<td>items2</td>
							<td>Description2</td>
							<td>Prix1</td>
							<td>Categorie2</td>
							<td width=300>
								<a href="view.php?id=2" class="btn btn-default"><span class="glyphicon glyphicon-eye-open">Voir</a>
								<a href="update.php?id=2" class="btn btn-primary "><span class="glyphicon glyphicon-pencil">Modifier</a>
								<a href="delete.php?id=2" class="btn btn-danger "><span class="glyphicon glyphicon-remove">Suprimer</a>
								
							</td>
						</tr>
						
					</tbody>


					
				</table>
			
		</div>
		
	</div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</html>