<?php
include_once 'C:\xampp\htdocs\CultureDev\app\model\model.class.php';

session_start();

$db=new Database();
if(isset($_POST['loginBtn'])){

    $email    = $_POST["login-email"];
    $passWord = md5($_POST["login-pwd"]);
    $param    = [$email,$passWord];

    $nbRow  = $db->numberRow("SELECT * FROM users WHERE email=? AND password=?",$param);
    
    if($nbRow!=0){
        $getrow = $db->getRow("SELECT * FROM users WHERE email=? AND password=?",$param);
        
        $_SESSION["fname"]   = $getrow['fname'];
        $_SESSION["id_user"] = $getrow['id_user'];
        header("location: pages/dashboard.php");
    }else{
        $erreurSignin="Invalid email or password";
    }
}

if(isset($_POST['signupBtn'])){
    $signupFname = $_POST["signup-fname"];
    $signupLname = $_POST["signup-lname"];
    $signupEmail = $_POST["signup-email"];
    $signupPwd   = md5($_POST["signup-pwd"]);

    $nbRowEmail=$db->numberRow("SELECT * FROM users WHERE email=?", [$signupEmail]);
    if($nbRowEmail != 0){
        $erreur="Cet email est déja existé !";
    }else{
        try{
            $db->insertData("INSERT INTO users (fname,lname,email,password) VALUES(?,?,?,?)",array($signupFname, $signupLname, $signupEmail, $signupPwd));
            echo "<script>alert(\"insertion a bien ete effectuer\")</script>";
        }catch (customException $e) {
            echo "Error lors de l'insertion ! ".$e->errorMessage();
        }
    }
}