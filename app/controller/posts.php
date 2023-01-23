<?php
include_once 'C:\xampp\htdocs\CultureDev\app\model\model.class.php';







if(isset($_POST['savePost'])){
    $dbMatch = new Database();
    $sql="INSERT INTO categories(nom_cat) VALUES (?)";
    $nomCat = $_POST['nom_cat'];
    $dbMatch->insertData($sql , [$nomCat]);
}

if(isset($_GET['suppPost'])){
    $dbMatch = new Database();
    $sql="DELETE from posts where id_post = ?";
    $dbMatch->deleteData($sql, [$_GET['suppPost']]);
}