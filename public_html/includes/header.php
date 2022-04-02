<?php 
require_once('functions.php'); 

$counter = $_SERVER['HTTP_HOST'] . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'page-views' . DIRECTORY_SEPARATOR . 'counter.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" author="Edouard Proust">
    <title>The Developer Fastlance: « 365 days to become a dev » challenge</title>
    <style><?php require_once(dirname(__DIR__).'/assets/style.css'); ?></style>
</head>
<body>
    <header id="top">
        <div class="header-container">
            <div class="header-logo-container">
                <div class="header-logo-img-container">
                    <a href="/">
                        <div class="header-logo">
                            <?php echo file_get_contents( dirname(__DIR__) . '/img/logo.svg'); ?>
                        </div>
                    </a>
                </div>
                <div class="header-logo-text-container">
                    <div class="logo-text">The Developer Fastlane</div>
                    <p class="subtitle">« 365 days to become a developer » challenge</p>
                </div>
            </div>
                <?php 
                if ( $_SERVER['REQUEST_URI'] !== '/' ) { ?>
                    <div class='header-btn-container'>
                        <?php btn('Go back to index', '/', 'Return to index'); /* ← ⯇ */ ?>
                    </div>
                <?php } ?>
        </div>   
    </header>
    <main>
    <div class="m-container">
        <div class="content">