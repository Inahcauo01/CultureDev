<?php
include_once 'C:\xampp\htdocs\CultureDev\app\model\model.class.php';

$db=new Database();
if(isset($_POST['loginBtn'])){

    $email    = $_POST["login-email"];
    $passWord = md5($_POST["login-pwd"]);
    $param    = [$email,$passWord];

    $nbRow    = $db->numberRow("SELECT * FROM users WHERE email=? AND password=?",$param);
    
    if($nbRow!=0){
        $getrow = $db->getRow("SELECT * FROM users WHERE email=? AND password=?",$param);
        
        $_SESSION["fname"]   = $getrow['fname'];
        $_SESSION["id_user"] = $getrow['id_user'];
        header("location: pages/dashboard.php");
    }else{
        $_SESSION["msg"]="Invalid email or password";
    }
}

if(isset($_POST['signupBtn'])){
    $signupFname = $_POST["signup-fname"];
    $signupLname = $_POST["signup-lname"];
    $signupEmail = $_POST["signup-email"];
    $signupPwd   = md5($_POST["signup-pwd"]);

    $nbRowEmail=$db->numberRow("SELECT * FROM users WHERE email=?", [$signupEmail]);
    if($nbRowEmail != 0){
        $_SESSION["msg"]="Cet email est déja existé !";
    }else{
        try{
            $db->insertData("INSERT INTO users (fname,lname,email,password) VALUES(?,?,?,?)",array($signupFname, $signupLname, $signupEmail, $signupPwd));
            $_SESSION["msg"]="insertion a bien ete effectuer";
        }catch (customException $e) {
            $_SESSION["msg"]= "Error lors de l'insertion ! ".$e->errorMessage();
        }
    }
}

if(isset($_GET['suppUser'])){
    $dbMatch = new Database();
    $sql="DELETE from users where id_user= ?";
    $dbMatch->deleteData($sql, [$_GET['suppUser']]);
}

if(isset($_POST['logout'])){
    session_destroy();
}