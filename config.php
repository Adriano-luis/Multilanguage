<?php
try {
    global $pdo;
    $pdo = new PDO('mysql:dbname=lang;host=localhost', '', '');

}catch(PDOException $e){
    echo 'Error'.$e->getMessage();
    exit;
}