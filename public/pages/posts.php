<?php
include_once 'C:\xampp\htdocs\CultureDev\app\controller\users.php';
include_once 'C:\xampp\htdocs\CultureDev\app\controller\posts.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/style/style-dash.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Quill.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.7/quill.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.7/quill.snow.css" rel="stylesheet">
    <title>Dashborad</title>
</head>
<body>
    <div class="dash-container">
        <div class="d-flex flex-column sidebar bg-dark text-white">
            <h2>Dashborad</h2>
            <?php if(isset($_SESSION['fname']))  echo "<h4>".$_SESSION['fname']."</h4>";  ?>
            <a href="dashboard.php"><i class="fa-solid fa-house"></i><span class="text-side"> Accuil</span></a>
            <a href="posts.php" class="active"><i class="fa-solid fa-newspaper"></i><span class="text-side"> Postes</span></a>
            <a href="categories.php"><i class="fa-solid fa-layer-group"></i><span class="text-side"> Categories</span></a>
            <a href="utilisateurs.php"><i class="fa-solid fa-users"></i><span class="text-side"> Users</span></a>
            <a href="#" class="deconnecter"><i class="fa-solid fa-right-from-bracket"></i><span class="text-side"> Deconnecter</span></a>
        </div>

        <div class="container p-4 main ">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="text-dark">Liste des postes</h3>
                <button class="btn rounded-pill btn-dark btn-sm" id="add-post" data-bs-toggle="modal" data-bs-target="#modal-post">
                    <i class="fa fa-plus"></i> Ajouter un post
                </button>
            </div>
            <table class="table mt-5" id="myTable">
                <thead class="table-dark">
                    <th scope="col">ID</th>
                    <th scope="col">Image</th>
                    <th scope="col">Titre</th>
                    <th scope="col">Description</th>
                    <th scope="col">Categories</th>
                    <th scope="col">Operation</th>
                </thead>
                <tbody>
            <?php
                // $sql        = "SELECT * from posts p, caegories c where p.id_cat = c.id_cat and p.id_user = ".$_SESSION['id_user'];
                $sql   = "SELECT * from posts p, categories c where p.id_cat = c.id_cat";
                $posts = $db->getAllrows($sql);

                foreach($posts as $post){								
            ?>
                    <tr>
                        <td>
                            <?php echo $post["id_post"] ?>
                        </td>
                        <td>
                            <?php echo $post["image"] ?>
                        </td>
                        <td>
                            <?php echo $post["title"] ?>
                        </td>
                        <td>
                            <span class="text-desc"><?php echo $post["description"] ?></span>
                        </td>
                        <td>
                            <?php echo $post["nom_cat"] ?>
                        </td>
                        <td>
                            <div class="d-flex action-button">                                
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                    <?php
                                    echo "<a class=\"btn btn-xs px-2\" data-bs-toggle=\"modal\" data-bs-target=\"#modal-post\" 
                                    onclick=\"updateButton()\"><i class=\"fa-regular fa-pen-to-square\"></i>
                                    </a>
                                    <a href=\"dashboard.php?suppPost=".$post["id_post"]."\" id=\"deleteclick".$post["id_post"]."\" hidden></a>
                                    <button  onclick=\"confirmSupp(".$post["id_post"].")\" class=\"btn btn-sm rounded-pill\"><i class=\"fas fa-trash-alt text-secondary\"></i></a></td></tr>";
                                    ?>
                                </form>
                            </div>
                        </td> 
                    </tr>  
                    <?php
                        }
                    ?> 
                </tbody>
            </table>
        </div>
    </div>


<!-- MATCHE MODAL -->
<div class="modal fade" id="modal-post">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="form-post"  enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 id="modalTitle">Add post</h5>
                    <a href="#" class="btn-close" data-bs-dismiss="modal"></a>
                </div>
                <div class="modal-body">
                    <!-- This Input Allows Storing post Index  -->
                    <input type="hidden" name="post-id" id="post-id">
                    <div class="mb-3">
                        <label class="form-label">Prix</label>
                        <input type="text" class="form-control" id="post-prix" name="post-prix" required/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Categories</label>
                        <select class="form-select" id="post-stade" name="post-stade">
                            <option value="">choisir un stade</option>
                                <?php
                                    $sql        = "SELECT * FROM categories";
                                    $categories = $db->getAllrows($sql);
                                    foreach($categories as $categorie){ 
                                        echo "<option class=\"text-secondary fw-light\" value=". $categorie['id_cat'] ." id=".$categorie['id_cat'].">".$categorie['nom_cat']."</option>";
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-dark">Image</label>
                        <input type="file" class="form-control" id="image" name="image" />
                    </div>
                    <div class="mb-3">
                        <textarea id="editor" class="w-100" rows="10"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-white" data-bs-dismiss="modal">Cancel</a>
                    <button type="submit" name="updatePost" class="btn btn-warning task-action-btn" id="btnUpdate">Update</button>
                    <button type="submit" name="savePost" 	class="btn btn-primary task-action-btn" id="btnSave">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- </div> -->


<!-- scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script>
        
    // confirmer la suppression
    function confirmSupp($id){
        if(confirm("voulez vous vraiment supprimer ?"))
        document.getElementById("deleteclick"+$id).click();
    };

    // Datatable
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );

    // editeur
    var quill = new Quill('#editor', {
        theme: 'snow'
    });

</script>
</body>
</html>