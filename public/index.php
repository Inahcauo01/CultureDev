<?php
    // include_once 'C:\xampp\htdocs\CultureDev\app\model\model.class.php';
    include_once 'C:\xampp\htdocs\CultureDev\app\controller\users.php';

    $db = new Database();
    $data = $db->getAllrows("SELECT * FROM users");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/style/style.css">
    <title>CultureDev</title>
</head>
<body>
    <div class="container d-flex">
        <div class="image-form col-5 d-flex align-items-center">
            <img src="assets/images/Typing-bro.svg" class="image-login img">
            <img src="assets/images/Get in.png" class="image-signup img hide">
        </div>
        <div class="form-container col-7 p-5">
                <!-- signup -->
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="sign-up w-100" autocomplete="off">
                    <h2>Sign up</h2>
                    <div class="mt-3 mb-2">
                        <input type="text" class="form-control" id="input-fname" name="signup-fname" required>
                        <label class="form-label">First name</label>
                        <div id="fname-error" class="form-text hide" >first name invalide</div>
                    </div>
                    <div class="mt-5 mb-3 mt-2">
                        <input type="text" class="form-control" id="input-lname" name="signup-lname" required>
                        <label class="form-label">Last name</label>
                        <div id="lname-error" class="form-text hide">last name invalide</div>
                    </div>
                    <div class="mt-5 mb-3">
                        <input type="text" class="form-control" id="input-email" name="signup-email" required>
                        <label class="form-label">Email address</label>
                        <div id="email-error" class="form-text hide">Email invalide</div>
                    </div>
                    <div class="mt-5 mb-3 position-relative">
                        <i class="fa-solid fa-eye eye eye-on"></i>
                        <i class="fa-solid fa-eye-slash eye eye-off hide"></i>
                        
                        <input type="password" class="form-control" id="input-pwd" name="signup-pwd" required>
                        <label class="form-label">Password</label>
                        <div id="pwd-error" class="form-text hide">Password invalide</div>
                    </div>
                    <button type="submit" name="signupBtn" id="sinscrire" class="btn btn-primary mt-4 mb-3">S'inscrire</button>
                    <div class="mt-2">
                        <p><small>Avez vous déja un compte ? <span class="click-ici btn-signup">cliquer ici</span></small></p>
                    </div>
                </form>
                <!-- login -->
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="sign-in w-100 hide">
                    <h2>Login</h2>
                    <div class="mt-5 mb-3">
                        <input type="text" class="form-control" id="input-email1" name="login-email" required>
                        <label class="form-label">Email address</label>
                        <div id="email1-error" class="form-text hide">Email invalide</div>
                    </div>
                    <div class="mt-5 mb-4 position-relative">
                        <i class="fa-solid fa-eye eye eye-on"></i>
                        <i class="fa-solid fa-eye-slash eye eye-off hide"></i>
                        
                        <input type="password" class="form-control" id="input-pwd1"  name="login-pwd" required="required">
                        <label class="form-label">Password</label>
                        <div id="pwd1-error" class="form-text hide">Password invalide</div>
                    </div>
                    <button type="submit" name="loginBtn" id="connecter" class="btn btn-primary mt-5">Se connecter</button>
                    <div class="mt-5">
                        <p><small>Creer un nouveau compte ? <span class="click-ici btn-signin">cliquer ici</span></small></p>
                    </div>
                </form> 
        </div>
        

    </div>



<!-- scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/script.js"></script>
</body>
</html>