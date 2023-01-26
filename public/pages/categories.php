<?php
include_once 'C:\xampp\htdocs\CultureDev\app\controller\users.php';
include_once 'C:\xampp\htdocs\CultureDev\app\controller\categories.php';
if(!isset($_SESSION['id_user']))    header("Location: ../index.php");
// echo $_SESSION['id_user']." - ".$_SESSION['fname']; 
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
            <a href="categories.php" class="links active"><i class="fa-solid fa-layer-group"></i><span class="text-side"> Categories</span></a>
            <a href="utilisateurs.php" class="links"><i class="fa-solid fa-users"></i><span class="text-side"> Users</span></a>
            <a href="allposts.php" class="links"><i class="fa-solid fa-users"></i><span class="text-side"> All posts</span></a>
            <form action="posts.php" method="post">
                <button name="logout" class="deconnecter links bg-transparent text-white border-0"><i class="fa-solid fa-right-from-bracket"></i><span class="text-side"> Deconnecter</span></button>
            </form>
        </div>

        <div class="container p-4 main">
            <div class="d-flex justify-content-between align-items-center">
                <div class="">
                <h3 class="text-dark">Categories</h3>
                <!-- Insertion d'un nouvelle categorie -->
                <div class="d-flex justify-content-between align-items-center">
                    <label class="text-dark">Ajouter une nouvelle categorie</label>
                    <div class="form-group m-1">
                        <input type="text" class="form-control" name="nom_cat" id="nom_cat_input" placeholder="categorie">
                    </div>
                    <div>
                        <button name="addCat" class="btn btn-outline-dark" onclick="addCategories()">Ajouter</button>
                    </div>
                </div>
            </div>
        </div>
<?php   if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    '.$_SESSION['msg'].'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  unset($_SESSION['msg']);
} ?>
            <div id="table-container">
            <div class="table-responsive">
                <table class="table mt-3" id="myTable">
                <thead class="table-dark">
                    <th scope="col">ID categories</th>
                    <th scope="col">Nom categories</th>
                    <th scope="col">Opertaion</th>
                </thead>
                <tbody>
                    <?php
                        $sql        = "SELECT * from categories";
                        $categories = $db->getAllrows($sql);
                        foreach($categories as $categorie){								
                    ?>
                    <tr>
                        <td>
                            <?php echo $categorie["id_cat"] ?>
                        </td>
                        <td>
                            <input type="text" class="<?php echo 'nci nom_cat_input'.$categorie["id_cat"].' hide'; ?>" name="nom_cat" id="<?php echo $categorie["id_cat"]?>" value="<?php echo $categorie["nom_cat"] ?>">
                            <span  class="<?php echo 'nom_cat_text'.$categorie["id_cat"]; ?>"><?php echo $categorie["nom_cat"]?></span>
                        </td>
                        <td>
                            <div class="d-flex action-button">
                                    <?php
                                    echo "<a class=\"btn btn-xs light px-2\" onclick=\"updateButtonPost(".$categorie["id_cat"].")\"><i class=\"fa-regular fa-pen-to-square text-dark\"></i>
                                        </a>
                                    <button onclick=\"deleteCategories(".$categorie["id_cat"].")\" id=\"deleteclick".$categorie["id_cat"]."\" hidden></button>   
                                    <button onclick=\"confirmSupp(".$categorie["id_cat"].")\" class=\"btn btn-sm rounded-pill\"><i class=\"fas fa-trash-alt text-dark\"></i>
                                    </button>
                                    ";
                                    ?>
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
        
        </div>
    </div>



<!-- scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
    
    // confirmer la suppression
    function confirmSupp(id){
        if(confirm("voulez vous vraiment supprimer ?"))
            document.getElementById("deleteclick"+id).click();
    };

// Datatable
$(document).ready( function () {
    $('#myTable').DataTable();
} );

// Show/hide input in the table (Update)
function updateButtonPost(id){
    console.log(document.querySelector(".nom_cat_input"+id))
    let elm = document.getElementById(id);
    elm.classList.add("hide");
    document.querySelector(".nom_cat_text"+id).classList.add("hide");
    document.querySelector(".nom_cat_input"+id).classList.remove("hide");
    
    // Update lorsque on sortie de l'input
    document.querySelectorAll(".nci").forEach(elm=>{
        elm.addEventListener("blur",()=>{
        document.querySelector(".nom_cat_text"+elm.id).classList.remove("hide");
        document.querySelector(".nom_cat_input"+elm.id).classList.add("hide");
        updateCategories(elm.id,elm.value);
    })
})

}

// Adding data using Ajax
function addCategories(){
    let nomCat = document.querySelector("#nom_cat_input");
    
    if(nomCat.value != ""){
    $.ajax({
        url: "categories.php",
        type: "POST",
        data: { addCat : "addCat",
            nomCat: nomCat.value },
        success: function(response) {
            console.log("l'ajout a bien été effectué !");
            displayData();
        },
        error: function(xhr, status, error) {
            console.log('Error:', error);
        }
    });
    }
    nomCat.value ='';
}

// Updating data using Ajax
function updateCategories(id, nomCat){
    $.ajax({
        url: "categories.php",
        type: "POST",
        data: { idCat: id, nomCat: nomCat },
        success: function(response) {
            console.log("la modification a bien été effectuée !");
            displayData();
        },
        error: function(xhr, status, error) {
            console.log('Error:', error);
        }
    });
}

// Deleting data using Ajax
function deleteCategories(id){
    $.ajax({
        url: "categories.php",
        type: "POST",
        data: { supIdCat : id },
        success: function(response) {
            console.log("la suppression a bien été effectuée !");
            displayData();
        },
        error: function(xhr, status, error) {
            console.log('Error:', error);
        }
    });
}

function displayData(){
    $.ajax({
    url: "http://localhost/CultureDev/app/view/getDataCat.php",
    type: "POST",
    success: function(response) {
        // insert the returned HTML into the table
        $("#table-container").html(response);
   }
});
}



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