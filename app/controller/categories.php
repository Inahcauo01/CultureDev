<?php
include_once 'C:\xampp\htdocs\CultureDev\app\model\model.class.php';

$db = new Database();

if(isset($_POST['addCat'])){
    $sql="INSERT INTO categories(nom_cat) VALUES (?)";
    $nomCat = $_POST['nom_cat'];
    $db->insertData($sql , [$nomCat]);
}

if(isset($_GET['suppCat'])){
    $sql="DELETE from categories where id_cat= ?";
    $db->deleteData($sql, [$_GET['suppCat']]);
}

if(isset($_POST["idCat"])){
    $sql="UPDATE categories SET nom_cat = ? where id_cat= ?";
    $db->deleteData($sql, [$_POST['nomCat'], $_POST["idCat"]]);
}