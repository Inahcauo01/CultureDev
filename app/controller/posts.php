<?php
include_once 'C:\xampp\htdocs\CultureDev\app\model\model.class.php';



if(isset($_POST['savePost'])){
    
    $db          = new Database();
    $sql         = "INSERT INTO posts(id_post, title, description, id_cat, id_user, image) VALUES (?,?,?,?,?,?)";
    
    for($i=0; $i<count($_POST['post-title']); $i++) {
        
        $id_post     = $_POST["post-id"][$i];
        $title       = $_POST["post-title"][$i];
        $description = $_POST["post-description"][$i];
        $id_cat      = $_POST["post-categorie"][$i];
        $id_user     = 1;
        
        $filename    = $_FILES['image']['name'][$i];
        if(!empty($filename)){
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $new_filename = time().'.'.$ext;
            move_uploaded_file($_FILES['image']['tmp_name'][$i], '../assets/images/uploads/'.$new_filename);
        }
        else{
            $new_filename = $filename;
        }
        
        $db->insertData($sql , [$id_post, $title, $description, $id_cat, $id_user, $new_filename]);
    }
}


// if(isset($_POST['updatePost'])){

//     $db          = new Database();
//     $id_post     = $_POST["post-id"];
//     $title       = $_POST["post-title"];
//     $description = $_POST["post-description"];
//     $id_cat      = $_POST["post-categorie"];

//     $filename    = $_FILES['image']['name'];
//     try {
//         if(!empty($filename)){
//             $ext = pathinfo($filename, PATHINFO_EXTENSION);
//             $new_filename = time().'.'.$ext;
//             move_uploaded_file($_FILES['image']['tmp_name'], '../assets/images/uploads/'.$new_filename);
//             $sql = 'UPDATE posts set title= ?, description= ?, id_cat= ?, image = ? WHERE id_post= ?';
//             $db->updateData($sql , [$title, $description, $id_cat, $new_filename, $id_post]);
//         }else{
//             $sql = 'UPDATE posts set title= ?, description= ?, id_cat= ? WHERE id_post= ?';
//             $db->updateData($sql , [$title, $description, $id_cat, $id_post]);
//         }
//     }catch(Exception $e) {
//         echo 'error: ' .$e->errorMessage();
//     }
    
// }
if(isset($_POST['updatePost'])){
    $db          = new Database();
    $id_post     = $_POST["post-id"][0];
    $title       = $_POST["post-title"][0];
    $description = $_POST["post-description"][0];
    $id_cat      = $_POST["post-categorie"][0];

    $filename    = $_FILES['image']['name'][0];
    
    try {
        if(!empty($filename)){
            if($_FILES['image']['error'] == 0){
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $new_filename = time().'.'.$ext;
                move_uploaded_file($_FILES['image']['tmp_name'], '../assets/images/uploads/'.$new_filename);
                $sql = 'UPDATE posts set title= ?, description= ?, id_cat= ?, image = ? WHERE id_post= ?';
                $db->updateData($sql , [$title, $description, $id_cat, $new_filename, $id_post]);
            }else{
                throw new Exception('Error uploading image');
            }
        }else{
            $sql = 'UPDATE posts set title= ?, description= ?, id_cat= ? WHERE id_post= ?';
            $db->updateData($sql , [$title, $description, $id_cat, $id_post]);
        }
    }catch(Exception $e) {
        echo '<script>alert("error: ' .$e->getMessage(). '")</script>';
    }   
}

if(isset($_GET['suppPost'])){
    $db  = new Database();
    $sql = "DELETE from posts where id_post = ?";
    $db->deleteData($sql, [$_GET['suppPost']]);
}