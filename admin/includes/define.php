<?php
include("connection.php");
session_start();
define("ROOT", "localhost/mind");
define("DASH", "localhost/mind/admin/pages/");
define("APPURL", "localhost/mind/index.php");
define("THUMBNAILMURL", "http://localhost/homeland/admin-panel/properties-admins/thumbnails");
define("GALLERYURL", "http://localhost/homeland/admin-panel/properties-admins/images");

if (!isset($_SESSION["u"])) {
    header("Location: ../pages/sign-in.php");
    exit();
}
