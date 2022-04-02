<?php
require '../../includes/header.php';
get_post_head('https://www.grafikart.fr/tutoriels/dates-php-1124');
$page_slug = get_last_part_of_url();

// START EDITING

title(2); // '1' or '2' for preset titles

    resultin();
        exo_gallery_link(100, [1], 'contact.php', false);
        exo_gallery_link(50, [2,3], 'contact.php');
    resultout();

instruction('Exercise instruction');

    p('<ul>
        <li>Show a list of opening hours slots for each day of the week.</li>
        <li>We want to <b>highlight the current day</b> in the list (with <b>date()</b> function). The line will be <b>wether red</b> (if the shop is closed at current time) <b>or green</b> (if it\'s open)</li>
        <li>An <b>alert box</b> will show up on the top of the list, displaying a <b>message saying wether the store is open right now</b> (green box) <b>or not</b> (red box).</li>
        <li>As the website is managed in France and traduced in american, the timeslots are entered in 24-hours format. That\'s why it will be necessary to create a function to <b>translate the timeslots into 12-hours format</b> (am / pm).</li> 
        </ul>'
        ,0,0);

    p('<a href="#exercise-code"><b>Go to the code</b></a>');

title(1); // '1' or '2' for preset titles

    instruction('Constants');

        p('<ul>
        <li>We use the function <b>define()</b> to set a new constant variable. Then we can give it <b>any name</b>.</li>
        <li>By convention, it will be writen in <b>capital letters</b>.</li>
        <li>Creating a <b>config.php</b> file is a good way to store constant variables.</li>
        </ul>'
        ,0,0);

        p('Inside <b>config.php</b>:'
        ,0,0);

        codein(); ?>
define('TIMESLOTS', [
    [8, 12],
    [14, 19]
]); 
<?php codeout();

    instruction('The date() function + date formating');

        p('Go to: PHP doc
         > <a href="https://www.php.net/manual/en/book.datetime.php" target="_blank">Date/Time functions</a>
         > <a href="https://www.php.net/manual/en/function.date.php" target="_blank">date()</a>'
        ,0, 1);
        p('For the sake of the exercise we need to use the date() function with some "format character" from the <a href="https://www.php.net/manual/en/datetime.format.php" target="_blank">"DateTime::format"</a> object-oriented style:
          <ul>
            <li><b>date(\'w\')</b>: The "w" character allows to check if the current day is the same as the one inside the list</li>
            <li><b>date(\'G\')</b>: The "G" character allows us to check if the current time (in 24-hour format) is contained INSIDE the timeslots we entered previously inside the contant\'s array. If this is the case, this means that the shop is opened right now.</li>
          </ul>'
        );

?><div id="exercise-code"></div><?php
title('Exercise\'s code'); // '1' or '2' for preset titles

    instruction('contact.php');

        codein(null); ?><l>
&lt;?php 
$title = 'Contact us';<b>
require 'header.php';
require_once 'config.php';</b>
?>

&lt;p class="lead mb-5">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Adipisci cupiditate in iusto vel asperiores impedit non. Provident hic illum adipisci optio laboriosam consequuntur voluptatem, temporibus asperiores doloremque ratione atque facere!&lt;/p>
&lt;div class="row">
  &lt;div class="col-md-7">
    &lt;h2 class="pb-3">Send us a message&lt;/h2>
    &lt;form>
      &lt;div class="form-group">
        &lt;label for="exampleInputEmail1">Email address&lt;/label>
        &lt;input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        &lt;small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.&lt;/small>
      &lt;/div>
      &lt;div class="form-group">
        &lt;label for="exampleInputPassword1">Message&lt;/label>
        &lt;textarea class="form-control" id="exampleInputPassword1" placeholder="Type your message">&lt;/textarea>
      &lt;/div>
      &lt;button type="submit" class="btn btn-primary">Send&lt;/button>
    &lt;/form>
  &lt;/div></l>
  &lt;div class="col-md-5">
    &lt;h2 class="pb-3">Visit the shop&lt;/h2>
     &lt;?php <b>
      $isOpen = contact_visit(TIMESLOTS);
      contact_visit_alert($isOpen);
      contact_visit_ul(TIMESLOTS, $isOpen);</b>
     ?>
  &lt;/div><l>
&lt;/div>

&lt;?php require 'footer.php'; ?></l><?php codeout();

    instruction('header.php');

        codein(); ?>
&lt;?php 
<b>require 'functions.php';</b>
?>
<l>
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
  &lt;div class="navbar-brand" href="&lt;?= dirbase() ?>">Dates in PHP&lt;/div>
  &lt;button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    &lt;span class="navbar-toggler-icon">&lt;/span>
  &lt;/button>

  &lt;div class="collapse navbar-collapse" id="navbarsExampleDefault">
    &lt;ul class="navbar-nav mr-auto">
      &lt;?= nav_menu('nav-link') ?>
    &lt;/ul>
      &lt;button onclick="location.href='/'" type="button" class="btn btn-secondary my-2 my-sm-0">⯇ Go back to index&lt;/button>
  &lt;/div>
&lt;/nav>

&lt;main role="main" class="container">
  &lt;div class="starter-template">
    &lt;h1>&lt;?= $title ?>&lt;/h1></l><?php codeout();

    instruction('config.php');

        codein(); ?>
&lt;?php <b>
define('DAYS',</b>
    [
        'Sunday',
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday'
    ]
);
<b>define('TIMESLOTS',</b>
    [
        [
            
        ],
        [
            [9, 13],[14, 20]
        ],
        [
            [8, 13],[14, 20]
        ],
        [
            [8, 12]
        ],
        [
            [8, 13],[14, 20]
        ],
        [
            [8, 13],[14, 20]
        ],
        [
            
        ],
    ]
);<?php codeout();

    instruction('functions.php');

        codein(null); ?>
&lt;?php
<b>function contact_visit($weekSlots): array</b>
{
  $open['day'] = $open['hour'] = 0;
  $today = (int)date('w');
  $now = (int)date('G');  
  if(!empty($weekSlots[$today])) {
    (int)$open['day'] = 1;
  }
  foreach ($weekSlots[$today] as $slot) {
    if ($now >= $slot[0] && $now &lt; $slot[1] ) {
      (int)$open['hour'] = 1;
    }
  }
  return $open;
}
<b>function contact_visit_ul(array $weekSlots, array $isOpen): array</b>
{
  foreach (DAYS as $d => $day) { 
    $style = '';
    if($d === (int)date('w')) {
      if($isOpen['hour'] === 1) { 
        $color = "green";
      } else {
        $color = "red";
      }
      $style = "style='color:$color'";
    }
    ?>&lt;li &lt;?= $style ?> >
      &lt;b>&lt;?= $day ?>&lt;/b>: &lt;?php
      if(empty($weekSlots[$d])) { 
        echo 'closed';
      } else {
        contact_visit_li($weekSlots[$d]);
      } ?>
    &lt;/li>&lt;?php
  }
  return $isOpen;
}
<b>function contact_visit_li(array $daySlots)</b>
{
  $line = [];
  foreach ($daySlots as $slot) {
    for ($i=0; $i&lt;count($slot); $i++) { // Formating from 24-hour format to 12-hour Am format
      if($slot[$i] > 12) {
        $slot[$i] = ($slot[$i] - 12) . ' pm';
      } else {
        $slot[$i] .= ' am';
      }
    }
    $line[] = "$slot[0] - $slot[1]";
  }
  echo implode(' / ', $line);
}
<b>function contact_visit_alert(array $isOpen) </b>
{
  if(array_sum($isOpen) === 2) {
    echo '&lt;div class="alert alert-success" role="alert">The store is open.&lt;/div>';
  } else {
    echo '&lt;div class="alert alert-danger" role="alert">The store is now closed, please come back tomorrow!&lt;/div>';
  }
}
<l>
function title_dyn(string $var = 'The Developer Fastlane'): void 
{
    if (isset($var)) {
        echo $var; 
    } else {
        echo 'The Developer Fastlane';
    }
}

function nav_item($link, $title, $aClass) 
{
  $class = 'nav-item';
  if (strpos($_SERVER["SCRIPT_NAME"], $link) !== false) {
    $class .= $class . ' active';
  }
    $html = '&lt;li class="' . $class . '">
      &lt;a class="' . $aClass . '" href="' . $link . '">' . $title . '&lt;/a>
    &lt;/li>';
  return $html;
}

function nav_menu(string $aClass=''): string
{
  return 
    nav_item('index.php', 'Home', $aClass) .
    nav_item('contact.php', 'Contact', $aClass);
}</l><?php codeout();


// STOP EDITING
        
require '../../includes/footer.php'; 

/**
 *  code for "<": &lt;
 */

?>