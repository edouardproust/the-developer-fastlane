<?php 
require_once 'functions/login.php';
require_once 'functions.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Edouard Proust">
    <meta name="generator" content="The Developer Fastlane">
    <title><?php title_dyn($title) ?></title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/starter-template/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="/projects/php-playground/assets/style.css">
    
<!-- Favicons -->
<link rel="apple-touch-icon" href="/docs/4.5/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="/docs/4.5/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="/docs/4.5/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
<link rel="icon" href="/docs/4.5/assets/img/favicons/favicon.ico">
<meta name="msapplication-config" content="/docs/4.5/assets/img/favicons/browserconfig.xml">
<meta name="theme-color" content="#563d7c">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-5">
  <div class="navbar-brand">
    <a href="<?= home() ?>" class ="text-light">PHP Playground</a>
  </div>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <?= nav_menu('nav-link') ?>
    </ul>
      <?php if (is_connected()): ?>
        <button onclick="location.href='/projects/php-playground/pages/logout.php'" type="button" class="btn btn-danger mr-2">Log out</button>
      <?php endif; ?> 
      <button onclick="location.href='/'" type="button" class="btn btn-secondary my-2 my-sm-0">Back to lessons website</button>
  </div>
</nav>

<main role="main" class="container">
  <div class="starter-template">
    <?php if(strpos($_SERVER["SCRIPT_NAME"], 'blog/post.php') === false): ?> <!-- Don't show title if is a blog post -->
      <h1><?= $title ?></h1>
    <?php endif; ?>
