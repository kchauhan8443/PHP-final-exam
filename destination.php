<?php
include("header.php");

$id=$_GET['id'];
?>

<?php
$statement = $conn->prepare("SELECT * FROM regions WHERE regionId=:id");
	$statement->bindParam(":id",$id);
	$statement->execute();

?>


<table>
<th>Name</th>
<th>Location</th>
<th>Photo</th>
<th>Edit</th>
<tr>

<?php


$statementt = $conn->prepare("SELECT * FROM destinations WHERE regionId=:id");
	$statementt->bindParam(":id",$id);
	$statementt->execute();
	while($row = $statementt->fetch(PDO::FETCH_BOTH)){
?>

<td><?=$row['name']?></td>
<td><?=$row['location']?></td>
<td><img src="image/<?=$row['photo']?>" width="100px" height="100px"></td>
<td><a href="edit.php?id=<?=$row['destinationId']?>">Edit</a></td>
<tr>

<?php }?>
</table>


