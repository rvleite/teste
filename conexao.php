<?php 

$conn = new PDO('mysql:host=localhost;port=3306;dbname=academia', 'root', '');
	
try {

    $conn = new PDO('mysql:host=localhost;dbname=academia', 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
    
}





 ?>