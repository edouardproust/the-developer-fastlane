<?php
require '../../includes/header.php';
get_post_head('https://www.grafikart.fr/tutoriels/cookies-php-1127');

// START EDITING

title('Exercise: Instructions & result'); // '1' or '2' for preset titles

    instruction('Instructions');
        
        p('A form that ask the user for his/her birth year. If he/she is 18 years old or more, then the user will be allowed to access the webpage. Otherwise, an error will be displayed.');
    
    Instruction ('Result');
    
        resultin();
            exo_gallery_link(100, [1,2,3], 'cookies.php', true);
        resultout();

        p('For this exercise, we use:
        <ul>
            <li><b>setcookie()</b> function (<a href="https://www.php.net/manual/en/function.setcookie.php" target=_blank">PHP Doc</a>)</li>
            <li><b>$_COOKIE</b> super variable (<a href="https://www.php.net/manual/en/reserved.variables.cookies.php" target=_blank">PHP Doc</a>)
                <ul>
                    <li><b>unset()</b> function can be used to unset the $_COOKIE super variable inside the current script</li>
                </ul>
            </li>
            <li>To <b>clear the browser from the cookie</b>, we need to use again the <b>setcookie() function but with a time in the past</b>: setcookie(\'user\', \'value\', <b>time() - 10</b>);
                <ul>
                    <li>We do this because no clearcookie() function exists unfortunatly :)</li>
                    <li>Details about the <b>time()</b> function here: <a href="https://www.php.net/manual/en/function.time.php" target=_blank">PHP Doc</a></li>
                </ul>
            </li>
        </ul>
        ');

title('Code');

    instruction('cookies.php');

            codein(null); ?>
&lt;?php 
<b>
$age = null;
if ($_GET['action'] === "exit") {
  unset($_COOKIE['birthday']); </b><l>
      // Will unset the cookie for the current script but not for the session</l><b>
  setcookie('birthday', '', time() - 10); </b><l>
      // Will unset the cookie for the session</l><b>
}
if (!empty($_POST['birthday'])) { 
  setcookie('birthday', $_POST['birthday']); </b><l>// 1. We set the cookie</l><b>
  $_COOKIE['birthday'] = $_POST['birthday']; </b><l>
      // It's needed to call manually (if not, the server will ask for anonther input to call it)</l><b>
}
if (!empty($_COOKIE['birthday'])) {
  $birthday = (int)$_COOKIE['birthday']; </b><l>// 2. Then we call it do to smth.</l><b>
  $age = (int)date('Y') - $birthday;
}</b>
<l>
$title = 'Restricted content';
require 'includes/header.php';
?>
</l>
&lt;p class="lead mb-5">This content is reserved to 18 years old and above users.&lt;/p>
&lt;/div>
&lt;div class="row">
  <b>&lt;?php if ($age >= 18): ?></b>
    &lt;div class="col-md-12">
      &lt;div class="alert alert-success">You are allowed to watch this content.&lt;/div>
    &lt;/div>
    &lt;div class="col-md-8">
      &lt;h2>Lorem ipsum, dolor sit amet consectetur adipisicing elit.&lt;/h2>
      &lt;p>Amet consectetur adipisicing elit. Eum accusantium officia esse eaque. Repellendus, vel facilis. Illum culpa perspiciatis quasi vel, voluptatem placeat earum nobis consequuntur repellat, mollitia, porro nisi.&lt;/p>
      &lt;p>Consectetur adipisicing elit. Ipsa id earum, laborum exercitationem beatae a hic tempora aspernatur voluptatibus repellendus corrupti culpa natus tempore laudantium placeat ipsum optio. Reiciendis, possimus.&lt;/p>
    &lt;/div>
    &lt;div class="col-md-4">
      &lt;a href="cookies.php?action=exit">
        &lt;div class="btn btn-danger float-right">Exit restricted area&lt;/div>
      &lt;/a>
    &lt;/div>
  <b>&lt;?php elseif ($age !== null): ?></b>
      &lt;div class="col-md-12">
        &lt;div class="alert alert-danger">You are to young to acces this content.&lt;/div>
      &lt;/div>
      &lt;div class="col-md-4">
        <b>&lt;a href="cookies.php?action=exit"></b> <l>// Setting a $_GET condition is the only way to unset a cookie completly</l>
          &lt;div class="btn btn-success">Change my age&lt;/div>
        &lt;/a>
      &lt;/div>
    &lt;/div>
  <b>&lt;?php else: ?></b>
    &lt;div class="col-md-6 mb-5">
      &lt;h2 class="pb-3">Verify your age&lt;/h2>
      &lt;form action='cookies.php' method='POST'>
        &lt;div class="form-group">
          &lt;label for="birthday">&lt;b>Select your birth year:&lt;/b>&lt;/label>
          &lt;select class="form-control" name="birthday">
            &lt;?php for ( $year = date('Y') - 8; $year > date('Y') - 120; $year-- ): ?>
              &lt;option value="&lt;?= $year ?>" &lt;?php if ($_POST['birthday'] == $year): ?>selected="true"&lt;?php endif ?>>
                  &lt;?= $year ?>
              &lt;/option>
            &lt;?php endfor; ?>
          &lt;/select>
        &lt;/div>
        &lt;button type="submit" class="btn btn-primary">Send&lt;/button>
      &lt;/form>
    &lt;/div>
    &lt;div class="col-md-6">
      &lt;p>&lt;b>Why this content is restricted?&lt;/b>&lt;/p>
      &lt;p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo cum provident at, aspernatur possimus perferendis a dignissimos mollitia repellendus dolor praesentium hic vero ab, quidem culpa sapiente voluptatum ipsam exercitationem.&lt;/p>
    &lt;/div>
  <b>&lt;?php endif; ?></b>
&lt;/div>
<l>
&lt;?php require 'includes/footer.php'; ?></l><?php codeout();


// STOP EDITING
        
require '../../includes/footer.php'; 

/**
 *  code for "<": &lt;
 */

?>