<?php
include "../includes/connection.php";

$code = $_POST["code"];
$pass = $_POST["pass"];
$remember = $_POST["remember"];

$verify = $code !== "" ? ($pass !== "" ? true : false) : false;
if ($verify === true) {

    $rs = Database::search("SELECT * FROM `admins` WHERE `code`='" . $code . "' AND `pass`='" . $pass . "'");
    $n = $rs->num_rows;

    if ($n == 1) {

        $d = $rs->fetch_assoc();
        $_SESSION["u"] = $d;

        if ($remember === "true") {

            // Encryption key and method (use a secure key and method in production)
            $encryptionKey = "ThisIsASecureEncryptionKey"; // Example: "ThisIsASecureEncryptionKey"
            $encryptionMethod = "AES-256-CBC"; // Use a strong encryption method

            // Generate a random IV (Initialization Vector)
            $ivLength = openssl_cipher_iv_length($encryptionMethod);
            $iv = openssl_random_pseudo_bytes($ivLength);

            // Encrypt the authentication code
            $encryptedAuthCode = openssl_encrypt($code, $encryptionMethod, $encryptionKey, 0, $iv);

            // Encrypt the password
            $encryptedPassword = openssl_encrypt($pass, $encryptionMethod, $encryptionKey, 0, $iv);

            // Set cookies with the encrypted data and IV
            setcookie("auth1", base64_encode($encryptedAuthCode), time() + (60 * 60 * 24 * 365), "/");
            setcookie("auth2", base64_encode($encryptedPassword), time() + (60 * 60 * 24 * 365), "/");
            setcookie("iv", base64_encode($iv), time() + (60 * 60 * 24 * 365), "/");


        } else {

            setcookie("email", "", -1);
            setcookie("password", "", -1);

        }

    } else {
        echo ("Invalid Username or Password.");
    }

    echo ("success");

} else if ($verify === false) {
    echo "ALL fieldss not Filled";
}

?>