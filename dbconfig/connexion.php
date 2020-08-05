<?php
function connect(){
    $servername = 'localhost';
    $dbname='production';
    $username = 'root';
    $password = '';
    try{
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);       
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ); 
        return $pdo;
    }
    catch(PDOException $e){
        echo "Erreur : " . $e->getMessage();
    }


}   
?>
