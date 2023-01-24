<?php
include_once 'C:\xampp\htdocs\CultureDev\app\controller\users.php';
include_once 'C:\xampp\htdocs\CultureDev\app\controller\categories.php';
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
            <h2>Dashborad</h2>
            <?php if(isset($_SESSION['fname']))  echo "<h4>".$_SESSION['fname']."</h4>";  ?>
            <a href="#" class="active"><i class="fa-solid fa-house"></i><span class="text-side"> Accuil</span></a>
            <a href="posts.php"><i class="fa-solid fa-newspaper"></i><span class="text-side"> Postes</span></a>
            <a href="categories.php"><i class="fa-solid fa-layer-group"></i><span class="text-side"> Categories</span></a>
            <a href="utilisateurs.php"><i class="fa-solid fa-users"></i><span class="text-side"> Users</span></a>
            <a href="#" class="deconnecter"><i class="fa-solid fa-right-from-bracket"></i><span class="text-side"> Deconnecter</span></a>
        </div>

        <div class="container p-4 main">
            
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
</script>
</body>
</html>