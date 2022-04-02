<?php
require '../../includes/header.php';
get_post_head('https://www.grafikart.fr/tutoriels/file-put-contents-1126');

// START EDITING

title('Exercise: result & instructions');
p('The exercise consists in <b>storing the data from the newsletter form into a text file</b> on the server, automatically.');

$slug = '/projects/php-playground';

    resultin();
        p("<b>Here are the steps to try the script:</b>
        <ol>
            <li>Click on the image below to access the newsletter registration page (or click <a href='$slug/newsletter.php'>here</a>)</li>
            <li>Fill in the form</li>
            <li>Click on 'Today' in <a href='/projects/php-playground/data/newsletter/list.php' target='_blank'>this list</a>.</li>
            <li>And verify that the info you typed in was succesfully added to the end of file.</li>
        </ol>"
    ,1,0);
        exo_gallery_link(100,[1],'newsletter.php', false);
    resultout();

    instruction('Instructions'); ?>
        
    <ol>
        <li>We create a new page called <b>newsletter.php</b>, in which we <b>create a form</b> to get users' email adresses</li>
        <li>New contacts (firstname + email) are <b>automatically added to a file</b> on the FTP server</li>
        <li>Each day a new file is created inside the <b>/newsletter</b> folder. Files' name will be the actual date: <b>yyyy-mm-dd.txt</b> in which "yyyy" is the year, "mm" month's number and "dd" the current day's number.</li>
        <li><b>Check if the user already subscribed today</b>: If the user submit the form several times the same day, the file is not modified and an alert is displayed (red color). If the user is not already registered, a success alert is shown (green). (This verification works only for the current day: we don't check for now if the user is part of files created on previous days.)</li>
    </ol><?php

title('Code');

    instruction('newsletter.php');

        codein(null); ?><l>
&lt;?php
$title = "Newsletter";
require 'includes/header.php';</l>

<b>// LOGICAL PART </b>

function <b>newsletter_submit() </b>
{
  if ( !empty($_POST) ) {
    $today = date("Y-m-d");
    $file = __DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'newsletter' . DIRECTORY_SEPARATOR . $today . '.txt';
    $data = $_POST['firstname'] . ' - ' . $_POST['email'] . PHP_EOL;
    if ( in_array($data, file($file)) ) { <l>// Check if the person is already registered inside this file</l>
      return "
        &lt;div class='alert alert-danger'>
          You are already registered to this list.
        &lt;/div>";
      echo '';
    } else {
      file_put_contents($file, $data, FILE_APPEND);
      return "
        &lt;div class='alert alert-success'>
          Thank you {$_POST['firstname']}, you're now on our list!
        &lt;/div>";
    }
  }
}
?>

<b>// VISUAL PART (FORM)</b>

  &lt;p class="lead">Please fill in the form below to register to our newsletter and be updated about our new crazy offers and promotions.&lt;/p>
  &lt;div class="row mt-5">
    &lt;div class="col-md-6  mb-5">
      <b>&lt;?php echo newsletter_submit(); ?></b>
      &lt;form action="newsletter.php" method="POST">
        &lt;div class="form-group">
          &lt;label for="firstname">&lt;b>Firstname&lt;/b>&lt;/label>
          &lt;input type="text" class="form-control" name="firstname" placeholder="John">
        &lt;/div>
        &lt;div class="form-group">
          &lt;label for="email">&lt;b>Email address&lt;/b>&lt;/label>
          &lt;input type="email" class="form-control" name="email" placeholder="johndoe@gmail.com">
          &lt;small id="emailInfo" class="form-text text-muted">We'll never share your email with anyone else.&lt;/small>
        &lt;/div>
        &lt;button type="submit" class="btn btn-primary">Subscribe&lt;/button>
      &lt;/form>
    &lt;/div><l>
    &lt;div class="col-md-6">
      &lt;p>&lt;b>Instructions:&lt;/b>&lt;/p>
      &lt;ol>
        &lt;li>We created this form to get users' email adresses&lt;/li>
        &lt;li>New contacts (firstname + email) are automatically added to a file on the FTP server&lt;/li>
        &lt;li>Each day a new file is created inside the "newsletter" forlder. Files' name will be the actual dat: "yyyy-mm-dd.txt" where "yyyy" is the year, "mm" month's number and "dd" the current day's number.&lt;/li>
        &lt;li>For now, we don't check if the user is already registered. So, if a user registers twice, then he/she will be added twice to the list.&lt;/li>
      &lt;/ol>
    &lt;/div>
  &lt;/div>

&lt;?php require 'includes/footer.php'; ?></l><?php codeout();

title ('Teacher\'s solution');

    p('<b>Here are some improvements from the teacher\'s solution compare to mine:</b>
    <ul>
        <li>The teacher adds <b>"required"</b> at the the form input tags: this way the user is forced to fill both fields (firstname and email)</li>
        <li>He uses the <a href="https://www.php.net/manual/en/function.filter-var.php" target="_blank"><b>filter_var()</b></a> function to check if the email format the user typed is correct.</li>
    </ul>    
    ');

// STOP EDITING
        
require '../../includes/footer.php'; 

/*  

code for "<": &lt;
accordionin();
    accordionli('
    Title','
        Content<br>
        <br><b>List</b>
        <ul>
            <li>li element</li>
        </ul>
    ');
accordionout();
 */

?>