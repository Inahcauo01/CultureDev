<?php
include_once 'C:\xampp\htdocs\CultureDev\app\model\model.class.php';

$db         = new Database();
$sql        = "SELECT * from categories";
$categories = $db->getAllrows($sql);

    $output = '<table class="table mt-3" id="myTable">
    <thead class="table-dark">
    <th scope="col">ID categories</th>
    <th scope="col">Nom categories</th>
    <th scope="col">Opertaion</th>
    </thead>
    <tbody>';

    foreach($categories as $categorie){
    $output .='
    <tr>
    <td>
    '.$categorie["id_cat"].'
    </td>
    <td>
    <input type="text" class="nci nom_cat_input'.$categorie["id_cat"].' hide" name="nom_cat" id="'.$categorie["id_cat"].'" value="'.$categorie["nom_cat"].'">
    <span  class="nom_cat_text'.$categorie["id_cat"].'">'.$categorie["nom_cat"].'</span>
    </td>
    <td>
    <div class="d-flex action-button">
    <a class="btn btn-xs light px-2" onclick="updateButtonPost('.$categorie["id_cat"].')"><i class="fa-regular fa-pen-to-square text-dark"></i>
    </a>
    <a href="categories.php?suppCat='.$categorie["id_cat"].'" id="deleteclick'.$categorie["id_cat"].'" hidden></a>
    <button  onclick="confirmSupp('.$categorie["id_cat"].')" class="btn btn-sm rounded-pill"><i class="fas fa-trash-alt text-dark"></i>
    </button>
    </div>
    </td> 
    </tr>';
    }
    $output .= '</tbody></table>';
    // DataTable
    $output .= "<script>$(document).ready( function () {
        $('#myTable').DataTable();
        } )</script>
        ";
    echo $output;
    

?>