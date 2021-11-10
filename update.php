
<?php 
require'database.php';
if (!empty($_GET['id'])) {
	$id = $_GET['id'];
}


$nameError =$descriptionError  = $priceError = $categoryError  = $imageError = $name = $description =$price  = $category  = $image =  "";


 if(!empty($_POST)){

 	$name = $_POST['name'];
 	$description = $_POST['description'];
 	$price = $_POST['price'];
 	$category = $_POST['category'];

 	$image = $_FILES['image']['name'];
 	$imagePath = '../images/' . basename($image);
 	$imageExtension = pathinfo($imagePath,PATHINFO_EXTENSION);
 	$isSuccess = true;
 	$isUploadSuccess = false;

 	if (empty($name)) {
 		$nameError = "ce champ ne peut pas etre vide";
 		$isSuccess = false;
 		
 	}
 	if (empty($description)) {
 		$descriptionError = "ce champ ne peut pas etre vide";
 		$isSuccess = false;
 		
 	}
 	if (empty($price)) {
 		$priceError = "ce champ ne peut pas etre vide";
 		$isSuccess = false;
 		
 	}
 	if (empty($category)) {
 		$categoryError = "ce champ ne peut pas etre vide";
 		$isSuccess = false;
 		
 	}
 	if (empty($image)) {
 		$isImageUpdated = false;
 		
 	}else
 	   {
 	   	$isImageUpdated = true;
 	   	$isUploadSuccess = true;
 	   	if ($imageExtension != "jpg" && $imageExtension!="png" && $imageExtension !="jpeg" && $imageExtension != "gif") {
 	   		$imageError = " seul les fichiers d'extention jpg,png,jpeg,gif sont acceptes";
 	   		$isUploadSuccess = false; 	   	}
 	   		if (file_exists($imagePath)) {
 	   			$imageError = "le fichier";
 	   		    $isUploadSuccess = false; 
 	   		}
 	   		if ($_FILES['image']['size']>500000) {
 	   			$imageError = "le fichier doit etre 500ko";
 	   		    $isUploadSuccess = false; 
 	   		}
 	   		if ($isUploadSuccess) {
 	   			if (!move_uploaded_file($_FILES['image']['tmp_name'] ,$imagePath)) {
 	   				$imageError = "le fichier";
 	   		        $isUploadSuccess = false;
 	   			}
 	   		}


 	  }

 	   if (($isSuccess && $isImageUpdated && $isUploadSuccess) || ($isSuccess && !$isImageUpdated)) {
 	  	$db=Database::connect();

 	  	if ($isImageUpdated) {
 	  		$statement = $db->prepare('UPDATE INTO items set name = ? , description = ? , price = ?, category = ?, image = ? WHERE id=?');
 	  	$statement->execute(array($name,$description,$price,$category,$image,$id));
 	  	}else{
 	  		$statement = $db->prepare('UPDATE INTO items set name = ? , description = ? , price = ?, category = ?, WHERE id=?');
 	  	$statement->execute(array($name,$description,$price,$category,$id));

 	  	}

 	  	
 	  	Database::disconnect();
 	  	header("location: index.php");

 	  }else if ($isImageUpdated && !$isUploadSuccess) {
 	  	Database::connect();
 	  	$name           = $item['name'];
 	  	$description    = $item['description'];
 	  	$price          = $price['price'];
 	  	$category       = $item['category'];
 	  	$image          = $item['image'];
 	  	Database::disconnect();
 	  }
 }else{

 	$db = Database::connect();

 	  	$statement = $db->prepare('SELECT image FROM items WHERE id=?');
 	  	$statement->execute(array($id));
 	  	$item = $statement->fetch();

 	  	$name            = $item['name'];
 	  	$description     = $item['description'];
 	  	$price           = $item['price'];
 	  	$category        = $item['category'];
 	  	$image           = $item['image'];

 	  	
 	  	Database::disconnect();
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

			<div class="col-sm-6">

					<h1><strong>Ajouter des items  </strong></h1>
				<br>

				<form method="POST" action="<?php echo 'update.php?id=' . $id ; ?>" enctype="multipart/form-data">
					<div class="form-group">
						<label for="name">Nom:</label>
						<input type="text" name="name" id="name" class="form-control" placeholder="Nom" value="<?php echo $name; ?>">
						<span class="help-inline"><?php echo $nameError; ?></span>
					</div>

					<div class="form-group">
						<label for="description">Description:</label>
						<input type="text" name="description" id="description" class="form-control" placeholder="Description" value="<?php echo $description; ?>">
						<span class="help-inline"><?php echo $descriptionError; ?></span>
					</div>

					<div class="form-group">
						<label for="name">prix:</label>
						<input type="text" name="price" id="price" class="form-control" placeholder="Prix" value="<?php echo $price; ?>">
						<span class="help-inline"><?php echo $priceError; ?></span>
					</div>

					<div class="form-group">
						<label for="category">categorie:</label>
						<select class="form-control" name="category" id="category">
							<?php
							
								$db = Database::connect();
								foreach ($db->query('SELECT * FROM categories') as $row) {
									if ($row['id'] == $category) 
									echo '<option value = selected = "selected" "' . $row['id'] .'">' . $row['name'] .'</option>';
								     else
								    echo '<option value = "' . $row['id'] .'">' . $row['name'] .'</option>';

								}
								Database::disconnect();

                            ?>
						</select>
						<span class="help-inline"><?php echo $categoryError ;?></span>
					</div>

					<div class="form-group">
						<label></label>
						<p><?php echo $image; ?></p>
						<label for="image">selectionner une image:</label>
						<input type="file" name="image" id="image" >
						<span class="help-inline"><?php echo $imageError; ?></span>
					</div>

					<div class="form-actions">

					 <button type="submit" name="" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span>Ajouter</button>

				  <a href="index.php" class="btn btn-primary" ><span class="glyphicon glyphicon-arrow-left"></span>Retour</a>
					
				</div>

				 
		
				
				</form>
				<br>
				
				
			</div>
			
			<div class="col-ms-6 col-md-4">
						<div class="thumbnail">
							<img src="<?php echo '../images/' .$image;?>" alt="">
							<div class="price"><?php echo number_format((float)$price,2,'.','') . 'FCFA'; ?></div>
							<div class="caption">
								<h4><?php  echo $name; ?></h4>
								<p><?php echo $description; ?></p>
								<a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"></span>Comander</a>
								
							</div>
						</div>	
					</div>
				
				
			
		</div>
		
	</div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</html>