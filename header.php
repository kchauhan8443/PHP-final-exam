<?php

include("db.php");

?>

<div><h1>Header</h1></div>
<?php
$statement = $conn->prepare("SELECT * FROM regions");
	$statement->execute();
	while($row = $statement->fetch(PDO::FETCH_BOTH)){
?>
<a href="destination.php?id=<?=$row['regionId']?>"><?=$row['name']?></a>

<?php }?>