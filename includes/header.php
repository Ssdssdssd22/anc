<?php

session_start();
$config = require __DIR__ . '/../constant.php';

define('ROOT', 'site/');
define('APPURL', $config['app']['base_url'] . '/');
define('ADMINURL', $config['app']['admin_url']);

?>
<?php include "connection.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <title><?php echo htmlspecialchars($config['app']['name']); ?></title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo htmlspecialchars($config['branding']['logo_mark']); ?>" type="image/png" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
        media="screen">

    <style>
        .event-carousel {
            width: 100%;
            position: relative;
            margin-bottom: 20px;
        }

        .event-carousel .carousel-inner {
            width: 100%;
            height: 500px;
            /* Fixed height for main carousel */
        }

        .event-carousel .carousel-item {
            width: 100%;
            height: 100%;
        }

        .event-carousel .carousel-item img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            /* Changed to contain to show full image without cropping */
            background-color: #f8f9fa;
            /* Light background for images */
        }

        .event-thumbnail {
            width: 100%;
            height: 200px;
            /* Fixed height for thumbnails */
            position: relative;
            overflow: hidden;
            margin-bottom: 15px;
        }

        .event-thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            background-color: #f8f9fa;
        }

        .main-layout {
            font-family: 'Varela Round', sans-serif;
            font-weight: 600;
            font-style: normal;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .event-carousel .carousel-inner {
                height: 400px;
                /* Smaller height for tablets */
            }

            .event-thumbnail {
                height: 150px;
            }
        }

        @media (max-width: 576px) {
            .event-carousel .carousel-inner {
                height: 300px;
                /* Even smaller height for phones */
            }

            .event-thumbnail {
                height: 120px;
            }
        }

        /* CSS for the Admission Sub-Menu */
        .menu-area-main li.admission-menu {
            position: relative;
        }

        .admission-submenu {
            display: none;
            position: absolute;
            top: 100%;
            /* Position below the "Admission" link */
            left: 0;
            /* Adjust to 'right: 0;' for right-side menu */
            background-color: #200769;
            /* Same as the "School" dropdown */
            padding: 0;
            list-style: none;
            z-index: 1000;
            /* Ensure it's above other elements */
            border: 1px solid #333;
            /* Optional border */
        }

        .admission-submenu li {
            padding: 10px 20px;
            white-space: nowrap;
            /* Prevent text wrapping */
        }

        .admission-submenu li a {
            color: #fff;
            text-decoration: none;
            display: block;
            /* Make the whole list item clickable */
        }

        .menu-area-main li.admission-menu:hover .admission-submenu {
            display: block;
        }

        /* Adjustments for right-side sub-menu */
        .menu-area-main li.admission-menu.submenu-right .admission-submenu {
            left: auto;
            right: 0;
        }
    </style>
</head>

<body class="main-layout">
    <div class="loader_bg">
        <div class="loader"><img src="images/loading.gif" alt="#" /></div>
    </div>
    <header>
        <div class="header-top">
            <div class="header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-3 col logo_section">
                            <div class="full">
                                <div class="center-desk">
                                    <div class="logo">
                                        <a href="<?php echo APPURL ?>"><img src="<?php echo htmlspecialchars($config['branding']['logo_primary']); ?>"
                                                alt="#" /></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="loader_bg">
                            <div class="loader"><img src="images/cv.gif" alt="#" /></div>
                        </div>
                        <div class="col-xl-10 col-lg-8 col-md-8 col-sm-9">
                            <div class="header_information">
                                <div class="menu-area">
                                    <div class="limit-box">
                                        <nav class="main-menu ">
                                            <ul class="menu-area-main">
                                                <li class="active"> <a href="<?php echo APPURL ?>">Home</a> </li>
                                                <li> <a href="<?php echo APPURL ?>#courses">Societies </a> </li>
                                                <li> <a href="<?php echo APPURL ?>#about">About</a> </li>
                                                <li class="admission-menu">
                                                    <a href="#">Clubs</a>
                                                    <ul class="admission-submenu" style="background-color: #200769; border-radius: 15px;">
                                                        <?php
                                                        $clubs = Database::search("SELECT * FROM clubs");
                                                        while ($club = $clubs->fetch_assoc()) {
                                                            echo '<li><a href="club-detail.php?id=' . $club['club_id'] . '">' . htmlspecialchars($club['name']) . '</a></li>';
                                                        }
                                                        ?>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <div class="dropdown">
                                                        <button class="btn dropdown-toggle" type="button"
                                                            id="dropdownMenu2" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            School
                                                        </button>
                                                        <div class="dropdown-menu" style="background-color: #200769;"
                                                            aria-labelledby="dropdownMenu2">
                                                            <a class="dropdown-item" type="button"><a
                                                                    href="staff.php">School
                                                                    Staff</a></a>
                                                            <a class="dropdown-item" type="button"><a
                                                                    href="admission.php">Admissions</a></a>
                                                            <button class="dropdown-item" type="button"><a
                                                                    href="events.php">Events</a></button><button class="dropdown-item" type="button"><a
                                                                    href="news.php">News</a></button>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li> <a href="<?php echo APPURL ?>#important">Fact</a> </li>
                                                <li> <a href="contact.php">Contact</a> </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                                <div class="mean-last">
                                    <a href="#">
                                        <img src="https://i.ibb.co/6HyLYjy/search-icon.png" alt="#" />
                                    </a>
                                    <?php
                                    // Retrieve the encrypted data and IV from cookies
                                    if (isset($_SESSION["u"])) {

                                    ?><a href='<?php echo ADMINURL; ?>'>Hello Admin!</a><?php
                                                                                                            } else {
                                                                                                                ?> <a href='<?php echo ROOT ?>/admin/pages/sign-in.php'>login/sing up</a><?php
                                                                                                                }
                                                                                                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>