<?php
include_once 'C:\xampp\htdocs\CultureDev\app\model\model.class.php';



if(isset($_POST['savePost'])){
    
    $db          = new Database();
    $sql         = "INSERT INTO posts(id_post, title, description, id_cat, id_user, image) VALUES (?,?,?,?,?,?)";
    $id_post     = $_POST["post-id"];
    $title       = $_POST["post-title"];
    $description = $_POST["post-description"];
    $id_cat      = $_POST["post-categorie"];
    $id_user     = 1;

    $filename    = $_FILES['image']['name'];

    if(!empty($filename)){
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $new_filename = time().'.'.$ext;
        move_uploaded_file($_FILES['image']['tmp_name'], '../assets/images/uploads/'.$new_filename);
    }
    else{
        $new_filename = $filename;
    }
    
    $db->insertData($sql , [$id_post, $title, $description, $id_cat, $id_user, $new_filename]);
}


if(isset($_POST['updatePost'])){

    $db          = new Database();
    $id_post     = $_POST["post-id"];
    $title       = $_POST["post-title"];
    $description = $_POST["post-description"];
    $id_cat      = $_POST["post-categorie"];

    $filename    = $_FILES['image']['name'];
    try {
        if(!empty($filename)){
            $ext          = pathinfo($filename, PATHINFO_EXTENSION);
            $new_filename = time().'.'.$ext;
            move_uploaded_file($_FILES['image']['tmp_name'], '../assets/images/uploads/'.$new_filename);
            $sql = 'UPDATE posts set title= ?, description= ?, id_cat= ?, image = ? WHERE id_post= ?';
            $db->updateData($sql , [$title, $description, $id_cat, $new_filename, $id_post]);
        }else{
            $sql = 'UPDATE posts set title= ?, description= ?, id_cat= ? WHERE id_post= ?';
            $db->updateData($sql , [$title, $description, $id_cat, $id_post]);
        }
    }catch(Exception $e) {
        echo 'error: ' .$e->errorMessage();
    }
    
}


if(isset($_GET['suppPost'])){
    $db  = new Database();
    $sql = "DELETE from posts where id_post = ?";
    $db->deleteData($sql, [$_GET['suppPost']]);
}