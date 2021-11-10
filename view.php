<?php
require'database.php';
if (!empty($_GET['id'])) {
	
	$id = checkInput($_GET['id']);

}
$db = Database::connect();
$statement = $db->prepare('SELECT items.id,items.name,items.description,items.price,items.image,categories.name As   category FROM items LEFT JOIN categories ON items.category = categories.id WHERE items.id = ?');

$statement->execute(array($id)); 
$item = $statement->fetch();
Database::disconnect();


function checkInput($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;


}



  ?>



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
			
				<h1><strong>liste des items  </strong></h1>
				<br>

				<div class="col-sm-6">
					  	<form>
					<div class="form-group">
						<label>Nom:</label><?php  echo ' ' . $item['name']; ?>
						
					</div>
					<div class="form-group">
						<label>Description:</label><?php  echo ' ' . $item['description']; ?>
						
					</div>
					<div class="form-group">
						<label>Prix:</label><?php  echo '' .number_format((float)$item['price'],2,'.','') .'fcfa';?>
						
					</div>
					<div class="form-group">
						<label>Categorie:</label><?php  echo '' . $item['category']; ?>
						
					</div>
					<div class="form-group">
						<label>Image:</label><?php  echo '' . $item['image']; ?>
						
					</div>
				</form>
				<div class="form-actions">
					<a href="index.php" class="btn btn-primary" ><span class="glyphicon glyphicon-arrow-left"></span>Retour</a>
				</div>
				</div>
				<div class="col-sm-6">

					<h1>SALUT</h1>
					
				</div>

			
			
		</div>
		
	</div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</html>