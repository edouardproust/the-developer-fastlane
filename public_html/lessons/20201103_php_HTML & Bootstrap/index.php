<?php
require '../../includes/header.php';
get_post_head('https://www.grafikart.fr/tutoriels/html-template-php-1122');

// START EDITING

title('Exercise: Enhance Bootstrap with dynamic content');

    resultin();
        exo_gallery_link(100, [1]);
    resultout();
    p('
    <ol>
        <li>We use <b>Boostrap</b> to make the CSS process easier 
        (<a href="https://getbootstrap.com/docs/4.5/examples/" target="_blank">link to Boostrap templates</a>). 
        We use the "<a href="https://getbootstrap.com/docs/4.5/examples/starter-template/" target="_blank">Starter template</a>" 
        (using Google Chrome: right clic on the page > "Inpect" > select all the source code and copy/paste it inside a new php file)</li>
        <li>We create a <b>local server</b>: through the terminal, 
        we type <b><code>php -S localhost:8000</code></b> to launch a new server. 
        Then we access the website typing <code><b>localhost:8000</b></code> inside the browser adress bar.
        <br>* Personnaly, I\'m using MAMP Pro to create as many local server as i want.</li>
        <li>Finaly, we customize the code <b>adding dynamic PHP content</b>. 
        This way, it will be easier to grow the website if it contains many pages, etc. 
        These enhancements are details below.</li>
    </ol>
    ');

    instruction('Dynamic title');
    
        p('In order to change dynamically the page title just by defining a variable at the top of each page. If left blank, a default title will display.');

        codein(); ?>
function title_dyn(string $var = 'The Developer Fastlane'): void 
{
    if (isset($var)) {
        echo $var; 
    } else {
        echo 'The Developer Fastlane'; 
    }
}<?php codeout();

        p('<h4>Alternative syntax</h4>
        It is easier to read when PHP and HTML are mixed together.');

        codein(); ?>
function title_dyn(string $var = 'The Developer Fastlane'): void  
{
    <b>if (isset($title)) :
        echo $title; 
    else : 
        echo 'The Developer Fastlane'; 
    endif</b>
}<?php codeout();

        p('<h4>"echo" short syntax</h4>
        It is supported since PHP v.7);');

        codein(); ?>
<b>&lt?= $title ?></b><l>
// Equivalent to: &lt?php echo $title; ?></l><?php codeout();

    instruction('Highlight active link in navbar');

            resultin();
                exo_gallery(50, [2, 3]);
            resultout();

            p('<h4>Solution 1 (mine): Array + Loop</h4>');

            codein(); ?>
<b>// SET VARIABLES</b>

$nav_links = [
  [ 'index.php', 'Home' ], 
  [ 'contact.php', 'Contact' ], 
];

<l>/* skipped code here */ </l>

<b>// REPLACE THE NAV SEPARETED ITEMS BY A LOOP + DYNAMIC VAR. & CONDITIONS</b>
<l>
&lt;nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
  &lt;div class="navbar-brand" href="&lt;?= dirbase() ?>">PHP & HTML&lt;/div>
  &lt;button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    &lt;span class="navbar-toggler-icon">&lt;/span>
  &lt;/button>

  &lt;div class="collapse navbar-collapse" id="navbarsExampleDefault">
    &lt;ul class="navbar-nav mr-auto"></l>

      &lt;?php foreach ($nav_links as $link) { ?>
        &lt;li class="nav-item">
          &lt;a class="nav-link &lt;?php if (strpos($_SERVER["SCRIPT_NAME"], $link[0]) !== false): ?>active&lt;?php endif ?>" href="&lt;?= dirbase($link[0]) ?>">&lt;?= $link[1] ?>&lt;/a>
        &lt;/li>
      &lt;?php } ?>
      ?><l>

    &lt;/ul>
      &lt;button onclick="location.href='/'" type="button" class="btn btn-secondary my-2 my-sm-0">⯇ Go back to index&lt;/button>
  &lt;/div>
&lt;/nav></l><?php codeout();

        p('<h4>Solution 2 (teacher / best one): Function</h4>');

            codein(); ?>
<b>// LOGICAL PART : function</b>

function nav_item($link, $title) 
    {
    $class = 'nav-item';
    if (strpos($_SERVER["SCRIPT_NAME"], $link) !== false) {
        $class .= $class . ' active';
    }
    $html = '&lt;li class="' . $class . '">
        &lt;a class="nav-link" href="' . $link . '">' . $title . '&lt;/a>
    &lt;/li>';
    return $html;
}

<b>// VISUAL PART: nav menu</b>
<l>
&lt;nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
    &lt;div class="navbar-brand" href="&lt;?= dirbase() ?>">PHP & HTML&lt;/div>
    &lt;button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        &lt;span class="navbar-toggler-icon">&lt;/span>
    &lt;/button>

    &lt;div class="collapse navbar-collapse" id="navbarsExampleDefault">
        &lt;ul class="navbar-nav mr-auto"></l>

        &lt;?php
            echo nav_item('index.php', 'Home');
            echo nav_item('contact.php', 'Contact');
        ?><l>

        &lt;/ul>
        &lt;button onclick="location.href='/'" type="button" class="btn btn-secondary my-2 my-sm-0">⯇ Go back to index&lt;/button>
    &lt;/div>
&lt;/nav></l><?php codeout();

        p('The teacher\'s solution is better because it separates better the logical and the visual parts. Moreover, it\'s reusable');

    instruction('Make the nav menu reusable in the footer');

        resultin();
            exo_gallery(100,[4]);
        resultout();

        p('Inside <b>functions.php</b>:');

            codein(); ?>
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
}<?php codeout();

        p('Inside <b>header.php</b>:');
        
            codein(); ?>
&lt;ul class="navbar-nav mr-auto">
    &lt;?= nav_menu('nav-link') ?>
&lt;/ul><?php codeout();

        p('Inside <b>footer.php</b>:');
        
            codein(); ?>
&lt;ul class="list-unstyled">
    &lt;?= nav_menu(); ?>
&lt;/ul><?php codeout();


        p('<h4>Bonus: the "function_exists()" function</h4>');

        p('This function verifies if a function <b>has already be called</b> inside the code. 
        This is usefull when the require_once() function can(t be used, ie: when a file contains at the same time items that have to be readen and a function that may be called twice. 
        For example, in our footer column, we may have nav-items to be displayed AND also a function that define the layout of the menu.');
        codein(); ?>
if (!function_exists('nav-item') {<l>
    /* Here is the function to be called inside the file */</l>
}<?php codeout();

title('"Heredoc" and "Nowdoc" syntaxes');

    p('Heredoc and Nowdoc syntaxes make the code reading and updating easier while mixing HTML and plain text on several lines with PHP.');

    instruction('Heredoc');
        p('Go to PHP doc > String functions> <a href="https://www.php.net/manual/fr/language.types.string.php#language.types.string.syntax.heredoc" target="_blank">Heredoc</a>'
        ,0,1);
        p('<b>Heredoc is usefull to display html code without being bothered by PHP opening and closing tags.</b>'
        ,0,0);
        p('Code before (in functions.php):');

            codein(); ?>
<l>// functions.php</l>
function nav_item(string $link, string $title): string
{
  $class = 'nav-item';
  if (strpos($_SERVER["SCRIPT_NAME"], $link) !== false) {
    $class .= $class . ' active';
  }
    <b>return '&lt;li class="' . $class . '">
      &lt;a class="nav-link" href="' . $link . '">' . $title . '&lt;/a></b>
    &lt;/li>';
}<?php codeout();
        p('Now we change the blue part into Heredoc code:');
        resultin('scroll'); ?><pre>
    return <b>&lt;&lt;&lt;HTML
    &lt;li class="$class">
        &lt;a class="nav-link" href="$link">$title&lt;/a>
    &lt;/li>
HTML;</b> <l>// Very important: the Heredoc final tag must NOT be indented</l></pre>
        <?php resultout();

    instruction('Nowdoc');
    
        p('Go to PHP doc > String functions> <a href="https://www.php.net/manual/fr/language.types.string.php#language.types.string.syntax.nowdoc" target="_blank">Nowdoc</a>'
        ,0,1);
        p('Nowdoc syntax is the equivalent for Heredoc syntax what the "<b>Simple quotes</b>" syntax is for the "Double quotes" syntax. 
        <b>It is usefull to display plain text on several lines:</b>');

            resultin('scroll'); ?><pre>
    return <b>&lt;&lt;&lt;'TEXT'</b><l> // The only difference with Heredoc syntax is: <b>simple quotes around the variable</b>
    
    <i>Type here any text. The $variables, functions();, the \ (anti-slash bar), etc.
    won't be interpreted by the server, to the contrary of Heredoc.</i></l>

<b>TEXT;</b> <l>// Same: the Nowdoc final tag must NOT be indented</l></pre>
            <?php resultout();


    /*

accordionin();
    accordionli('
    Title','
        Content<br>
        <br><b>List</b>
        <ul>
            <li>li element</li>
        </ul>');
accordionout();

title('Aa');

    instruction('Aa');

        p('Aa');

            resultin();
                p('Aa');
            resultout();

            codein(); ?>
Aa<?php codeout();


// code for "<" : &lt;

            
    */

// STOP EDITING
        
require '../../includes/footer.php'; 

?>