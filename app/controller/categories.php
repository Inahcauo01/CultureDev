<?php
include_once 'C:\xampp\htdocs\CultureDev\app\model\model.class.php';

$db = new Database();

if(isset($_POST['addCat'])){
    $nomCat = $_POST['nomCat'];
    $query    = "SELECT * from categories where nom_cat like ?";
    $nbr    = $db->numberRow($query,[$nomCat]);
    if($nbr > 0){
        $_SESSION['msg'] = 'Cette categorie est déja existée';
    }else{
        $sql    = "INSERT INTO categories(nom_cat) VALUES (?)";
        $db->insertData($sql , [$nomCat]);
    }
}

if(isset($_POST['supIdCat'])){
    $sql="DELETE from categories where id_cat= ?";
    $db->deleteData($sql, [$_POST['supIdCat']]);
}

if(isset($_POST["idCat"])){
    $sql="UPDATE categories SET nom_cat = ? where id_cat= ?";
    $db->deleteData($sql, [$_POST['nomCat'], $_POST["idCat"]]);
}




?>