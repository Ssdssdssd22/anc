<?php

session_start();
include "../includes/connection.php";

$email = $_POST["e"];
$password = $_POST["p"];
$rememberme = $_POST["r"];

if(empty($email)){
    echo ("Please enter your Code.");
}else if(strlen($email) > 100){
    echo ("Code must contain LOWER THAN 100 characters.");
}else if(empty($password)){
    echo ("Please enter your Password.");
}else{

    $rs = Database::search("SELECT * FROM `admins` WHERE `code`='".$email."' AND `pass`='".$password."'");
    $num = $rs->num_rows;

    if($num == 1){

        $data = $rs->fetch_assoc();
        $_SESSION["u"] = $data;

        if($rememberme == "true"){

            setcookie("email",$email,time()+(60*60*24*365));
            setcookie("password",$password,time()+(60*60*24*365));

        }

        header("Location: ../pages/dashboard.php");
        exit();

    }else{
        echo ("Invalid Email Address or Password.");
    }

}

?>