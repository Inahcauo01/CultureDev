<?php
include_once 'C:\xampp\htdocs\CultureDev\app\model\model.class.php';



if(isset($_POST['savePost'])){
    
    $dbMatch      = new Database();
    $sql          ="INSERT INTO posts(id_post, title, description, id_cat, id_user, image) VALUES (?,?,?,?,?,?)";
    $id_post      = $_POST["post-id"];
    $title        = $_POST["post-title"];
    $description  = $_POST["post-description"];
    $id_cat       = $_POST["post-categorie"];
    $id_user      = 1;

    $filename = $_FILES['image']['name'];

    if(!empty($filename)){
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $new_filename = time().'.'.$ext;
        move_uploaded_file($_FILES['image']['tmp_name'], '../assets/images/uploads/'.$new_filename);
    }
    else{
        $new_filename = $filename;
    }
    
    $dbMatch->insertData($sql , [$id_post, $title, $description, $id_cat, $id_user, $new_filename]);
}


if(isset($_POST['updatePost'])){
    
    $dbMatch      = new Database();
    $id_match     = $_POST["match-id"];
    $id_equipe1   = $_POST["match-equipe1"];
    $id_equipe2   = $_POST["match-equipe2"];
    $date_match   = $_POST["match-date"];
    $stade_id     = $_POST["match-stade"];
    $prix_match   = $_POST["match-prix"];
    $result_match = $_POST["resultat"];


    $filename = $_FILES['image']['name'];
    
    if(!empty($filename)){
        $ext          = pathinfo($filename, PATHINFO_EXTENSION);
        $new_filename = time().'.'.$ext;
        move_uploaded_file($_FILES['image']['tmp_name'], '../assets/images/uploads/'.$new_filename);
        $sql='UPDATE matchs set id_equipe1 = ? ,id_equipe2= ? ,date_match= ? ,stade_id= ? ,result_match= ? , prix_match = ? ,image_match = ? WHERE id_match= ?';
        $dbMatch->updateData($sql , [$id_equipe1, $id_equipe2, $date_match, $stade_id, $result_match,$prix_match, $new_filename, $id_match]);
        }
    else{
        $sql='UPDATE matchs set id_equipe1 = ? ,id_equipe2= ? ,date_match= ? ,stade_id= ? ,result_match= ? ,prix_match = ? WHERE id_match= ?';
        $dbMatch->updateData($sql , [$id_equipe1, $id_equipe2, $date_match, $stade_id, $result_match,$prix_match, $id_match]);
    }

}



// if(isset($_POST['savePost'])){
//     $dbMatch = new Database();
//     $sql="INSERT INTO categories(nom_cat) VALUES (?)";
//     $nomCat = $_POST['nom_cat'];
//     $dbMatch->insertData($sql , [$nomCat]);
// }

if(isset($_GET['suppPost'])){
    $dbMatch = new Database();
    $sql="DELETE from posts where id_post = ?";
    $dbMatch->deleteData($sql, [$_GET['suppPost']]);
}