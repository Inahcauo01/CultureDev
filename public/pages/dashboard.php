<?php
include_once 'C:\xampp\htdocs\CultureDev\app\controller\users.php';
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
            <a href="posts.php" class="active links"><i class="fa-solid fa-newspaper"></i><span class="text-side"> Postes</span></a>
            <a href="categories.php" class="links"><i class="fa-solid fa-layer-group"></i><span class="text-side"> Categories</span></a>
            <a href="utilisateurs.php" class="links"><i class="fa-solid fa-users"></i><span class="text-side"> Users</span></a>
            <a href="allposts.php" class="links"><i class="fa-solid fa-users"></i><span class="text-side"> All posts</span></a>
            <form action="posts.php" method="post">
                <button name="logout" class="deconnecter links bg-transparent text-white border-0"><i class="fa-solid fa-right-from-bracket"></i><span class="text-side"> Deconnecter</span></button>
            </form>
        </div>

    <div class="container p-4 main">
        <div class="d-flex justify-content-between flex-wrap">   

            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Moyenne de post/user</h5>
                    <div class=""><?php echo $db->totalRow("
                        SELECT round(avg(nbr),2) FROM (select id_user, count(id_post) as nbr from posts GROUP BY id_user) as tab;
                        "); 
                    ?>
                    </div>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Nombre de Posts</h5>
                    <div class=""><?php echo $db->totalRow("SELECT * FROM posts"); ?></div>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Nombre de Categories</h5>
                    <div class=""><?php echo $db->totalRow("SELECT * FROM categories"); ?></div>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Nombre des Utilisateurs</h5>
                    <div class=""><?php echo $db->totalRow("SELECT * FROM users"); ?></div>
                </div>
            </div>

        </div>    
    </div>


</div>



<!-- scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <!-- <script src="assets/js/script.js"></script> -->
    <script>
    // confirmer la suppression
    function confirmSupp($id){
        console.log(id)
        if(confirm("voulez vous vraiment supprimer ?")){
            console.log("hi delete")
            document.getElementById("deleteclick"+$id).click();
            console.log("hi delete")
        }
    };

    // Datatable
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );

    
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