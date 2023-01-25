<?php
include_once 'C:\xampp\htdocs\CultureDev\app\controller\users.php';
include_once 'C:\xampp\htdocs\CultureDev\app\controller\posts.php';
if(!isset($_SESSION['id_user']))    header("Location: ../index.php");

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
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="text-side-title">Dashborad</h2>
                <div>
                    <i class="fa-solid fa-bars fa-2x humberger text-white"></i>
                    <i class="fa-solid fa-x hide-bar text-white me-2"></i>
                </div>
            </div>
            <a href="dashboard.php" class="links"><i class="fa-solid fa-house"></i><span class="text-side"> Accuil</span></a>
            <a href="posts.php" class="links"><i class="fa-solid fa-newspaper"></i><span class="text-side"> Postes</span></a>
            <a href="categories.php" class="links"><i class="fa-solid fa-layer-group"></i><span class="text-side"> Categories</span></a>
            <a href="utilisateurs.php" class="links"><i class="fa-solid fa-users"></i><span class="text-side"> Users</span></a>
            <a href="allposts.php" class="active links"><i class="fa-solid fa-users"></i><span class="text-side"> All posts</span></a>
            <form action="posts.php" method="post">
                <button name="logout" class="deconnecter links bg-transparent text-white border-0"><i class="fa-solid fa-right-from-bracket"></i><span class="text-side"> Deconnecter</span></button>
            </form>
        </div>

        <div class="container p-4 main ">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="text-dark">Liste de tous les postes</h3>
                </button>
            </div>
            <div class="table-responsive">
            <table class="table mt-5" id="myTable">
                <thead class="table-dark">
                    <th scope="col">ID</th>
                    <th scope="col">Image</th>
                    <th scope="col">Titre</th>
                    <th scope="col">Description</th>
                    <th scope="col">Categories</th>
                    <th scope="col">Date</th>
                    <th scope="col">Admin Name</th>
                </thead>
                <tbody>
            <?php
                $db = new Database();
                $sql   = "SELECT * from posts p, categories c, users u where p.id_cat = c.id_cat and p.id_user=u.id_user";
                $posts = $db->getAllrows($sql);

                foreach($posts as $post){	
                    
                $image = (!empty($post['image'])) ? '../assets/images/uploads/'.$post["image"] : '../assets/images/uploads/aucune.webp';							
            ?>
                    <tr>
                        <td>
                            <?php echo $post["id_post"] ?>
                        </td>
                        <td>
                            <?php echo "<img src='".$image."' class=\"img-table\">" ?>
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
                            <?php echo $post["date_post"] ?>
                        </td>
                        <td>
                            <?php echo $post["fname"] ?>
                        </td>
                    </tr>  
                    <?php
                        }
                    ?> 
                </tbody>
            </table>
            </div>
        </div>
    </div>


<!-- scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
        
    // confirmer la suppression
    function confirmSupp($id){
        if(confirm("voulez vous vraiment supprimer ce post?"))
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


	// vider les champs lorsqu'on click sur ajouter jeu
	document.getElementById('add-post').addEventListener('click', ()=>{
			document.getElementById('form-post').reset();
		    document.getElementById("modalTitle").innerHTML    = "Add post";
			document.getElementById('btnSave').style.display   = 'block';
			document.getElementById('btnUpdate').style.display = 'none';
			document.getElementById('add-del-form').classList.remove("hiden");
	});

	function updateButton(id, title, description, id_cat){
		document.getElementById("modalTitle").innerHTML     = "Edit post";
		document.getElementById('btnSave').style.display    = 'none';
		document.getElementById('btnUpdate').style.display  = 'block';
			document.getElementById('add-del-form').classList.add("hiden");


		document.getElementById("post-id").value    = id;
		document.getElementById("post-title").value = title;
		document.getElementById("editor").value     = description;
    
		document.getElementById(id_cat).selected    = true;
	}

    // adding multiple form
document.getElementById("add-form-btn").addEventListener("click", ()=>{
    var formContainer = document.querySelector(".modal-body");
    var newForm       = document.querySelector("#input-container").cloneNode(true);
    // newForm.reset();
    formContainer.appendChild(newForm);
    if(formContainer.childNodes.length >3){
        document.querySelector("#remove-form-btn").classList.remove("hide")
    }
});
    // removing form
document.getElementById("remove-form-btn").addEventListener("click", ()=>{
    var formContainer = document.querySelector(".modal-body");
    var newForm       = document.querySelector("#input-container");
    if(formContainer.childNodes.length > 3){
        formContainer.removeChild(formContainer.lastChild);
    }
    if(formContainer.childNodes.length < 4){
        document.querySelector("#remove-form-btn").classList.add("hide")
    }
});

// shownig bar humberger button
document.querySelector(".humberger").addEventListener("click", ()=>{
    document.querySelector(".hide-bar").style.display = "block";
    document.querySelector(".humberger").style.display = "none";
    document.querySelectorAll(".links").forEach(link => {
        link.style.display="block";
    });
})
// hiding bar X button
document.querySelector(".hide-bar").addEventListener("click", ()=>{
    document.querySelector(".humberger").style.display = "block";
    document.querySelector(".hide-bar").style.display = "none";
    document.querySelectorAll(".links").forEach(link => {
        link.style.display="none";
    });
})
// width responsive
window.addEventListener('resize',()=>{
    if(window.innerWidth > 700) {
        document.querySelector(".hide-bar").style.display = "none";
        document.querySelector(".humberger").style.display = "none";
        document.querySelectorAll(".links").forEach(link => {
            link.style.display="block";
        });
    }else{
        document.querySelector(".humberger").style.display = "block";
        document.querySelectorAll(".links").forEach(link => {
            link.style.display="none";
        });
    }
})

</script>
</body>
</html>