<?php
include_once 'C:\xampp\htdocs\CultureDev\app\controller\users.php';
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
    <title>Dashborad</title>
</head>
<body>
    <div class="dash-container">
        <div class="d-flex flex-column sidebar bg-dark text-white">
            <h2>Dashborad</h2>
            <a href="#" class="active"><i class="fa-solid fa-house"></i><span class="text-side"> Accuil</span></a>
            <a href="#"><i class="fa-solid fa-newspaper"></i><span class="text-side"> Postes</span></a>
            <a href="#"><i class="fa-solid fa-layer-group"></i><span class="text-side"> Categories</span></a>
            <a href="#"><i class="fa-solid fa-users"></i><span class="text-side"> Users</span></a>
            <a href="#" class="deconnecter"><i class="fa-solid fa-right-from-bracket"></i><span class="text-side"> Deconnecter</span></a>
        </div>

        <div class="container p-4 main">
            <div class="d-flex justify-content-between align-items-center">
                <h4>Categories</h4>
                <button class="btn btn-outline-dark btn-sm rounded-pill" >Ajouter</button>

            </div>
            <table class="table mt-3">
                <thead class="table-dark">
                    <th scope="col">ID categories</th>
                    <th scope="col">Nom categories</th>
                    <th scope="col">Opertaion</th>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>


    </div>



<!-- scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>