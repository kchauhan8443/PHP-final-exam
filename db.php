<?php
define("DBNAME", "Kapil200440433");
define("DBUSER", "Kapil200440433");
define("DBPASS", "gmwt8WqQxw");


try{
$conn = new PDO('mysql:host=172.31.22.43;dbname=Kapil200440433', 'Kapil200440433', 'gmwt8WqQxw');


$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e){
echo $e->getMessage();
	
}
?>