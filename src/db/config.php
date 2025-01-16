<?php 
try {
    $conn = new PDO("mysql:host=localhost;dbname=coursenligne_youdemy",'Bouchta','0000');
    $conn->setAttribute(PDO :: ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed : '.$e->getMessage();
}
?>