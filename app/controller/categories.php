<?php
include_once 'C:\xampp\htdocs\CultureDev\app\model\model.class.php';

if(isset($_POST['addCat'])){
    
    $dbMatch = new Database();
    $sql="INSERT INTO categories(nom_cat) VALUES (?)";
    $nomCat = $_POST['nom_cat'];
    $dbMatch->insertData($sql , [$nomCat]);
}

if(isset($_GET['suppCat'])){
    $dbMatch = new Database();
    $sql="DELETE from categories where id_cat= ?";
    $dbMatch->deleteData($sql, [$_GET['suppCat']]);
}