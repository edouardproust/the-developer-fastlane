<?php

require '../../includes/header.php';
get_post_head('https://www.grafikart.fr/tutoriels/tp-login-vues-1131');

// START EDITING


title('Instructions & result'); // '1' or '2' for preset titles

    p('<b>Goal:</b> Prevent anyone who is not an admin to access the dashboard (created in the previous exercise). This exercise will take part of <a href="/lessons/20201111_php_sessions">sessions</a>.'
    ,0,1);
    p('
    <ul>
        <li>If the user arrives on the dashboard.php page without being logged in, he is redirected to a login form.</li>
        <li>On the login page, he must enter a login and a password.</li>
        <li>If these two values match what is expected, he will be redirected to dashboard.php.</li>
        <li>If they don\'t match: error message and no redirection.</li>
    </ul>'
    ,0,0);

    resultin();
        exo_gallery_link(100,[1,2],'login.php',false,0);
        exo_gallery_link(50,[3,4],'login.php',true,0,0);
    resultout();

title('Code'); // '1' or '2' for preset titles

    instruction ('Steps'); ?>
        <ol>
            <li>Create a system to block the user (<b>check if user is an admin</b> or not: session_start() + $_SESSION)
                <ul>
                    <li>How to check url ONLY the first time the user access the page ?</li>
                </ul>
            </li>
            <li><b>Redirect the user</b>: header() function
                <ul>
                    <li>If is admin (isset $_SESSION): redirect to dashboard.php</li>
                    <li>If is not admin: redirect to login.php</li>
                </ul>
            </li>
            <li><b>Create login form</b> (login.php + "POST" method)</li>
            <li><b>Define an id and a password</b>, then hash it.</b></li>
            <li><b>Check if infos match</b>: reuse the step 2 function for checking</li>
        </ol><?php
    
    instruction ('header.php');
            
        codein(); ?>
&lt;?php

<b>require_once 'functions_login.php';</b>
require_once 'functions.php';

?>

&lt;!doctype html>
&lt;html lang="en">
  &lt;head>
    &lt;meta charset="utf-8">
    &lt;meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    &lt;meta name="description" content="">
    &lt;meta name="author" content="Edouard Proust">
    &lt;meta name="generator" content="The Developer Fastlane">
    &lt;title>&lt;?php title_dyn($title) ?>&lt;/title>

    &lt;link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/starter-template/">
    &lt;link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    &lt;link rel="stylesheet" href="assets/style.css">
    
&lt;!-- Favicons -->
&lt;link rel="apple-touch-icon" href="/docs/4.5/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
&lt;link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
&lt;link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
&lt;link rel="manifest" href="/docs/4.5/assets/img/favicons/manifest.json">
&lt;link rel="mask-icon" href="/docs/4.5/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
&lt;link rel="icon" href="/docs/4.5/assets/img/favicons/favicon.ico">
&lt;meta name="msapplication-config" content="/docs/4.5/assets/img/favicons/browserconfig.xml">
&lt;meta name="theme-color" content="#563d7c">


    &lt;style>
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
    &lt;/style>

  &lt;/head>
  &lt;body>
    &lt;nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
  &lt;div class="navbar-brand" href="&lt;?= dirbase() ?>">PHP Project&lt;/div>
  &lt;button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    &lt;span class="navbar-toggler-icon">&lt;/span>
  &lt;/button>

  &lt;div class="collapse navbar-collapse" id="navbarsExampleDefault">
    &lt;ul class="navbar-nav mr-auto">
      &lt;?= nav_menu('nav-link') ?>
    &lt;/ul>
      <b>&lt;?php if (is_connected()): ?>
        &lt;button onclick="location.href='logout.php'" type="button" class="btn btn-danger mr-2">Log out&lt;/button>
      &lt;?php endif; ?> </b>
      &lt;button onclick="location.href='/'" type="button" class="btn btn-secondary my-2 my-sm-0">Back to lessons list&lt;/button>
  &lt;/div>
&lt;/nav>

&lt;main role="main" class="container">
  &lt;div class="starter-template">
    &lt;h1>&lt;?= $title ?>&lt;/h1>
<?php codeout();

    instruction ('dashboard.php');

        codein(); ?>
&lt;?php

<b>require_once "includes/functions_login.php";
if (!is_connected()) {
  header('Location: login.php');
}</b>
  
$title = "Dashboard";
require_once 'includes/header.php'; 
require_once 'includes/functions_analytics.php'; 
require_once 'includes/functions_counters.php'; // We need to reinclude it (in the footer is too late)
?>
&lt;p class="lead mb-5">This dashboard lists all the statistics on the website since it was created. Click on years and months listed on the left to access the detailed data.&lt;/p>

&lt;div class="row">

  &lt;!-- MENU (left) -->

  &lt;div class="col-md-4">
    &lt;div class="list-group mb-4">
      &lt;?php  
        for ($year = (int)date('Y'); $year > (int)date('Y') - 5; $year--): ?>
          &lt;a href="?year=&lt;?= $year ?>" class="list-group-item &lt;?= li_active('year', $year) ?>">
            &lt;b>&lt;?= $year ?>&lt;/b>
          &lt;/a>&lt;?php 
          if ( (int)$_GET['year'] === $year ): // List months
            if ($_GET['year'] !== date("Y")): $m = 12; else: $m = date('m'); endif; 
              // If clicked is the current year, then display ONLY past months
            for($i=$m;$i>0;$i--): ?>
              &lt;a href="?year=&lt;?= $year ?>&month=&lt;?= $i ?>" class="list-group-item &lt;?= li_active('month', $i) ?>">
                &nbsp;&nbsp;&lt;?= $breadcrumb[$year][] = date('F',strtotime('01.'.$i.'.2000')); // To list months in letters ?>
              &lt;/a>&lt;?php 
            endfor;
          endif;
        endfor; ?>
    &lt;/div>
  &lt;/div>

  &lt;!-- DATA (right) -->

  &lt;div class="col-md-8">
    &lt;div class="card mb-3">

      &lt;!-- Breadcrumb --> 

      &lt;nav aria-label="breadcrumb">
        &lt;ol class="breadcrumb">
          &lt;?php $breadcrumb = breadcrumb_dash(); ?>
            &lt;li class="breadcrumb-item active">&lt;?= $breadcrumb['total'] ?>&lt;/li>
            &lt;?php if (isset($_GET['year'])): ?>
              &lt;li class="breadcrumb-item active">&lt;?= $breadcrumb['year'] ?>&lt;/li>
            &lt;?php endif; ?>
            &lt;?php if (isset($_GET['month'])): ?>
              &lt;li class="breadcrumb-item active">&lt;?= $breadcrumb['month'] ?>&lt;/li>
            &lt;?php endif; ?>
        &lt;/ol>
      &lt;/nav>

      &lt;!-- Card (year & month)--> 

      &lt;div class="card-body">
        &lt;?php if (!isset($_GET['year'])): ?>
          &lt;div class="row">
            &lt;div class="col-sm mb-3">
              &lt;h3>&lt;?= counter_sum('total'); ?>&lt;/h3>Visited pages
            &lt;/div>
            &lt;div class="col-sm">
              &lt;h3>&lt;?= counter_sum(date("Y-m-d")); ?>&lt;/h3>Today
            &lt;/div>
          &lt;/div>
        &lt;?php elseif (!isset($_GET['month'])) : ?>
          &lt;h3>&lt;?= counter_sum('year', $_GET['year']) ?>&lt;/h3>Visited pages
        &lt;?php endif; ?>
        &lt;?php if (isset($_GET['month'])): ?>
          &lt;h3>&lt;?= counter_sum('month', $_GET['year'], $_GET['month']) ?>&lt;/h3>Visited pages
      &lt;/div>

    &lt;/div>

    &lt;!-- Table (days) -->

    &lt;div class="card">
      &lt;table class="table">
        &lt;thead class="thead-light">
            &lt;tr>
              &lt;th>Day&lt;/th>
              &lt;th>Page views&lt;/th>
            &lt;/tr>
        &lt;/thead>
        &lt;tbody>
          &lt;?php if (counter_sum('month', $_GET['year'], $_GET['month']) > 0 ):
            for ($i=31; $i>0; $i--):
                $day_file = $_GET['year'] . '-' . str_pad($_GET['month'], 2, '0', STR_PAD_LEFT) . '-' . str_pad($i, 2, '0', STR_PAD_LEFT); 
                if (file_exists(counter_page_views_db($day_file))): ?>
                  &lt;tr>
                    &lt;td>&lt;?= $i ?>&lt;/td>
                    &lt;td>&lt;?= counter_page_views_int($day_file); ?>&lt;/td>
                  &lt;/tr>
                &lt;?php endif; ?>
            &lt;?php endfor; ?>
          &lt;?php else: ?>
            &lt;tbody>
              &lt;tr>
                &lt;td colspan="2">No data&lt;/td>
              &lt;/tr>
            &lt;/tbody>
          &lt;?php endif; ?>
        &lt;/tbody>
      &lt;/table>
    &lt;/div>

    &lt;?php endif; ?>

  &lt;/div>
&lt;/div>

&lt;?php require 'includes/footer.php'; ?><? codeout();
    
    instruction ('login.php');
            
        codein(); ?>&lt;?php<b>

require_once 'includes/functions_login.php';
$alert_message = $alert_color = '';
if ($_GET['action'] === 'logout') { </b>
  <l>// This condition must be before the credentials check (for the case the user logged out, then try to connect again and made a mistake in credentials)</l><b>
  $alert_message = 'You have been successfully logged out';
  $alert_color = 'success';
}
if (!empty($_POST)) {
  if ($_POST['username'] === 'admin' && password_verify($_POST['password'], '$2y$13$ew/.dV4.LdNxbCBkdxaELe4ozhg395dZ5jZCM/1sEuXUFUkrIlubi') === true ) {
    session_start();
    $_SESSION['connected'] = 1;
    header('Location: dashboard.php');
  } else {
    $alert_message = 'Incorrect username and/or password';
    $alert_color = 'danger';
  }
}</b>

$title = "Sign in";
require_once 'includes/header.php';
?>

  &lt;p class="lead">You must be connected to access this page.&lt;/p>

  &lt;div class="row">
    &lt;div class="col-md-4">
      <b>&lt;?php if($error): ?>
        &lt;div class="alert alert-danger">&lt;?= $error ?>&lt;/div>
      &lt;?php endif; ?></b>
      &lt;p class="small">Use these credentials to access:&lt;br>
      - Username: &lt;b>admin&lt;/b>&lt;br>
      - Password: &lt;b>php&lt;/b>&lt;/p>
      <b>&lt;form action="" method="POST"></b>
        &lt;div class="form-group">
          &lt;label>Username&lt;/label>
          &lt;input type="text" <b>name="username"</b> class="form-control">
        &lt;/div>
        &lt;div class="form-group">
          &lt;label>Password&lt;/label>
          &lt;input <b>type="password" name="password"</b> class="form-control">
        &lt;/div>
        &lt;button type="submit" class="btn btn-primary">Sign in&lt;/button>
      &lt;/form>
    &lt;/div>
  &lt;/div>
&lt;?php require 'includes/footer.php'; ?>
<?php codeout();

    instruction('logout.php');

        codein(); ?>
&lt;?php

<b>session_start();
unset($_SESSION['connected']);
header('Location: login.php?action=logout');</b><? codeout();

    instruction ('functions_login.php');
    
        codein(); ?>
&lt;?php

<b>function is_connected(): bool </b>
{
    if( <b>session_status() === PHP_SESSION_NONE</b> ) {
        session_start();
    }
    return !empty($_SESSION['connected']);<l> // Returns TRUE if $_SESSION['connected'] is not empty</l>
}
<?php codeout();


// STOP EDITING
        
require '../../includes/footer.php'; 

/**
 *  code for "<": &lt;
 */

?>