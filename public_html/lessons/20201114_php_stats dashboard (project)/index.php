<?php

require '../../includes/header.php';
get_post_head('https://www.grafikart.fr/tutoriels/tp-dashboard-vues-1130');

// START EDITING


title('Instructions & result'); // '1' or '2' for preset titles

    p('<b>We want to create a dashboard that allow the user to check his/her website statistics.</b>
    <ul>
        <li>We create the page dashboard.php</li>
        <li>On the left of the page we have a sidebar that lists last 5 years</li>
        <li>When we click on a year, a months sublist is displayed.</li>
        <li>When we click on a month, the cumulated stats of this months is displayed on the right hand side of the dashboard. 
        To do such a thing, we use the function <a href="https://www.php.net/manual/en/function.glob.php" target="_blank">glob()</a></li>
    </ul>
    ');

    resultin();
        exo_gallery_link(100,[1],'admin/analytics.php',false);
        exo_gallery_link(66,[2],'admin/analytics.php',true,0,0);
    resultout();

title('Code'); // '1' or '2' for preset titles

    instruction ('Steps'); ?>
        <ol>
            <li>Create the dashboard.php <b>page structure using Boostrap</b></li>
            <li>Create the <b>list of years and month</b> (in the left menu of the page)</li>
            <li>Code the function to <b>merge counters data</b> (we reuse the files generated in the previous lesson)
                <ul>
                    <li>hange the previous function to divide the count by day</li>
                    <li>Make a pattern using <b>glob()</b> function. For <b>years</b>, and for <b>months</b>.</li>
                    <li><b>Extract content</b> from files of the list generated and <b>make a sum</b> of them</li>
                    <li>Display the result</li>
                </ul>
            </li>
            <li>Optional: create a <b>table</b> for each month, listing the data <b>per day</b>.</li>
        </ol><?php

        
    instruction ('dashboard.php');

        p('The page where the dashboard is displayed');
            
            codein(); ?>&lt;?php

$title = "Dashboard";
require 'includes/header.php'; 
require 'includes/functions_analytics.php'; 
require_once 'includes/functions_counters.php'; // We need to reinclude it (in the footer is too late)
?>
&lt;p class="lead mb-5">This dashboard lists all the statistics on the website since it was created. Click on years and months listed on the left to access the detailed data.&lt;/p>

&lt;div class="row">

  <b>&lt;!-- MENU (left) --></b>

  &lt;div class="col-md-4">
    &lt;div class="list-group mb-4">
      &lt;?php  
        for ($year = (int)date('Y'); $year >= (int)date('Y') - 5; $year--): ?>
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

  <b>&lt;!-- DATA (right) --></b>

  &lt;div class="col-md-8">
    &lt;div class="card mb-3">

      <b>&lt;!-- Breadcrumb --> </b>

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

      <b>&lt;!-- Card (year & month)--> </b>

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

    <b>&lt;!-- Table (days) --></b>

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

&lt;?php require 'includes/footer.php'; ?>
<?php codeout();

    instruction ('footer.php');

            codein(); ?>            &lt;/div>
        &lt;/main>&lt;!-- /.container -->

        &lt;!-- Footer -->
        &lt;footer class="page-footer font-small mt-5">

            &lt;!-- Footer Text -->
            &lt;div class="container text-center text-md-left py-5">
                &lt;div class="row">
                    &lt;div class="col-md-4">
                    &lt;h5>Pages list&lt;/h5>
                        &lt;ul class="list-unstyled">
                            &lt;?= nav_menu(); ?>
                        &lt;/ul>
                    &lt;/div>
                    &lt;div class="col-md-4">
                        &lt;h5>Stats&lt;/h5>
                        &lt;ul class="list-unstyled">
                            &lt;li><b>
                                &lt;?php 
                                require_once (dirname(__DIR__) . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'functions_counters.php'); 
                                counter_page_views_increment('total');
                                counter_page_views_increment(date("Y-m-d"));
                                ?></b>
                                &lt;!-- // Display counter snipet -->
        &lt;b>&lt;?= counter_page_views_int('total') ?>&lt;/b> page view&lt;?php if (counter_page_views_int('total') > 1): ?>s&lt;?php endif; ?> 
                            &lt;/li>
                        &lt;/ul>
                    &lt;/div>
                    &lt;div class="col-md-4">
                        &lt;h5>Admin&lt;/h5>
                        &lt;ul class="list-unstyled">
                            &lt;li>
                                &lt;a href="dashboard.php">Statistics&lt;/a>
                            &lt;/li>
                        &lt;/ul>
                    &lt;/div>
                &lt;/div>
            &lt;/div>
        &lt;/div>
    &lt;script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">&lt;/script>
    &lt;script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">&lt;/script>
    &lt;script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous">&lt;/script>
&lt;/html><?php codeout();    

    instruction ('functions_analytics.php');

        p('News functions created for the dashboard page.');

            codein(); ?>&lt;?php 

<b>function li_active(string $period, int $number): string</b>
{
    $active = '';
    if ((int)$_GET[$period] === $number) {
        $active = "active";
    }
    return $active;
}
<b>function counter_sum(string $period, int $year=2000, int $month=1): int</b>
{
    $views = [];
    $month = str_pad($month, 2, '0', STR_PAD_LEFT); // To be sure the month are 2 digits in the filename
    if($period ==='year') {
        $search = "$year-*";
    } elseif($period ==='month') {
        $search = "$year-$month-*";
    } elseif($period === 'total') {
        $search = "*-*-*";
    } else {
        return null;
    }
    foreach (glob("data/counter_page-views/$search") as $file ) {
        $views[] = (int)file_get_contents($file);
    }
    return (int)array_sum($views);
}
<b>function breadcrumb_dash(): array</b>
{
    $breadcrumb['total'] = '5 last years';
    $breadcrumb['year'] = $_GET['year'];
    $breadcrumb['month'] = date('F',strtotime('01.'.$_GET['month'].'.2000'));
    if(isset($_GET['year'])) { 
        $breadcrumb['total'] = '&lt;a href="dashboard.php">' . $breadcrumb['total'] . '&lt;/a>';
    }
    if(isset($_GET['month'])) { 
        $breadcrumb['year'] = '&lt;a href="dashboard.php?year=' . $breadcrumb['year'] . '">' . $breadcrumb['year'] . '&lt;/a>';
    }
    return $breadcrumb;
}<?php codeout();


    instruction ('functions_counter.php');

        p('Updated file created previously for counters in general');

        codein(); ?>&lt;?php

// page views

<b>function counter_page_views_db($file): string </b>
{
    $db = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'php-playground' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'counter_page-views' . DIRECTORY_SEPARATOR . $file;
    return $db;
}
<b>function counter_page_views_increment($file): void</b>
{
    if (strpos($_SERVER["SCRIPT_NAME"], 'dashboard.php') === false) { // Exclude admin pages
        $db = counter_page_views_db($file);
        if (file_exists($db)) {
            $views = (int)file_get_contents($db);
            $views++;
        } else {
            $views = 1;
        }
        file_put_contents($db, $views);
    }
} 
<b>function counter_page_views_int($file): int</b>
{
    $db = counter_page_views_db($file);
    return (int)file_get_contents($db);
}<?php codeout();

    instruction ('style.css');

        p('Updated file created previously for counters in general');

        codein(); ?>
.page-footer {
    background-color: #f3f3f3;
}
a:hover {
  text-decoration: none !important;
}
.breadcrumb {
  border-radius: .25rem .25rem 0 0;
}
.table thead th {
  border: none;
}
tbody > tr:first-child > * {
  border-top: none;
}
th {
  color: #6c757d !important;
  font-weight: 400;
}
@media (min-width: 576px) {
  .col-sm:nth-child(2) {
    border-left: solid 1px #dddddd !important;
  }
}<?php codeout();


// STOP EDITING
        
require '../../includes/footer.php'; 

/**
 *  code for "<": &lt;
 */

?>