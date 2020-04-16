<?php
session_start();

include("header.php");


$id= $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM destinations WHERE destinationId=:id");
	$stmt->bindParam(":id",$id);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_BOTH);
	
	if(isset($_POST['edit'])){
		$error=[];
		
		if(empty($_POST['name'])){
		$error['name'] = "Please enter Name";
		}
		if(empty($_POST['location'])){
			$error['location'] = "Please enter Location";
			}
		if(empty($_POST['description'])){
			$error['desc'] = "Please enter Description";
			}
		if(empty($_POST['regid'])){
			$error['regid'] = "Please select region";
			}
	if(empty($error)){

		
$target_dir="image/";
$target_file = $target_dir . basename($_FILES["photo"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
	$check=getimagesize($_FILES["photo"]["tmp_name"]);
	if($check !== false){
	echo "File is an image - ".$check["mime"] .".";
	$uploadOk = 1;
		}else{
		echo"File is not an image.";
		$uploadOk = 0;
		}
// Check if file already exists
	if(file_exists($target_file)){
	echo"Sorry, file already exists.";
	$uploadOk = 0;
	}
// Check file size
	if($_FILES["photo"]["size"] > 500000) {
		echo"Sorry, your file is too large.";
		$uploadOk = 0;
		}
// Allow certain file formats
	//if($imageFileType !="jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"){
//echo"Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//$uploadOk = 0; 
//}
// Check if $uploadOk is set to 0 by an error
	if($uploadOk == 0){
		echo"Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
}else{
	if(move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)){
		echo "The file".basename($_FILES["photo"]["name"])." has been uploaded.";
			}else{
			echo"Sorry, there was an error uploading your file.";
			}
		}
		
		$photo = $_FILES["photo"]["name"];
		
		
		$stmtt = $conn->prepare("UPDATE destinations SET name=:name, location=:location, description=:desc, regionId=:regid, photo=:photo WHERE destinationId=:id ");
		$stmtt->bindParam(":id",$id);
		$stmtt->bindParam(":name",$_POST['name']);
		$stmtt->bindParam(":location",$_POST['location']);
		$stmtt->bindParam(":desc",$_POST['description']);
		$stmtt->bindParam(":regid",$_POST['regid']);
		$stmtt->bindParam(":photo",$photo);
		$stmtt->execute();
		
		
	$stmt = $conn->prepare("SELECT * FROM destinations WHERE regionId=:id");
	$stmt->bindParam(":id",$id);
	$stmt->execute();
	$roww = $stmt->fetch(PDO::FETCH_BOTH);
		
		$success="You have successfully edit page address to ".$roww['email'];
		
		header("Location:index.php?id=$id");
		
		}
	}
?>


<html>
<head>
	<title></title>
</head>
	<body>
	<form method="post">
		<p>Edit</p>
		
		<p><?php if(isset($success)){
			echo $success;
			}?></p>
			
			<p>Name</p>
			<textarea name="name" ><?php if(isset($roww['name'])){echo $roww['name'];
			}else{ echo $row['name'];}
			?></textarea>
			<p>Location</p>
		<textarea name="location" ><?php if(isset($roww['location'])){echo $roww['location'];
			}else{ echo $row['location'];}
			?></textarea>
			<br>
			<select name="regid">
			<?php
					$statement = $conn->prepare("SELECT * FROM regions");
					$statement->execute();
					while($rowww = $statement->fetch(PDO::FETCH_BOTH)){
				?>
				<option value="<?=$rowww['regionId']?>"><?=$rowww['name']?></option>
				<?php }?>
			</select>
			<p>Description</p>
		<textarea name="description" ><?php if(isset($roww['description'])){echo $roww['description'];
			}else{ echo $row['description'];}
			?></textarea>
			
			 <input type='file' name='photo' multiple >
			
		<input type="submit" value="Edit" name="edit">
	</form>
	</body>
</html>