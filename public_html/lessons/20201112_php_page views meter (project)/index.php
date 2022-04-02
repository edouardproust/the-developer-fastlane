<?php

require '../../includes/header.php';
get_post_head('https://www.grafikart.fr/tutoriels/tp-compteur-vues-1129');

// START EDITING


title('Instructions & result'); // '1' or '2' for preset titles

    p('We want to create a counter that calculates the number 
    of pages viewed on the website since its creation. <br>
    <b>Important</b>: we want to be able to display several times the counter without incrementing the visits number. <br>That\'s why i\'ll need to seperate functions so that :
    <ul>
        <li>first one is dedicated to increment the file each time a page is viewed: it is included in <b>footer.php</b></li>
        <li>second one is to display the number wherever we need as a <b>snippet of code</b>, whitout changing the count.</li>
    </ul>
    ');

    resultin();
        exo_gallery_link(100,[1],'',false,0,0);
        exo_gallery_link(50,[2],'',true,0,0);
    resultout();

title('Code'); // '1' or '2' for preset titles

    instruction ('Steps'); ?>
        <ol>
            <li>Verify that the counter.txt file exists (<b>condition</b>)</li>
            <li>If it doesn't not exist (<b>false</b>):
                <ul>
                    <li>create it (<b>file_put_contents</b>)</li>
                    <li>fill it with the value "1"</li>
                </ul>
            </li>
            <li>If it exists (<b>true</b>):
                <ul>
                    <li>read the file's content (<b>file_get_contents</b>)</li>
                    <li>convert this value into an integer and add 1 to it</li>
                    <li>write the file with this new value (<b>file_put_contents</b> with no flags to replace the content)</li>
                </ul>
            </li>
            <li>Create a snippet of code to display the counter</li>
        </ol><?php

        
    instruction ('footer.php');

        p('This code <b>increments the counter .txt file</b> each time a page is viewed. That\'s why we need to put it in footer.php, which is part of every pages of the website.');
            
            codein(); ?>
require_once (dirname(__DIR__) . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'functions_counters.php'); <l>
    // Call functions_counters.php</l>   
counter_page_views_<b>db</b>(); <l>// Define database path</l>
counter_page_views_<b>increment</b>(); <l>// Add 1 to database for every new page view</l>
counter_page_views_<b>snippet</b>(); <l>// Display counter as a string</l><?php codeout();

    instruction ('functions_counters.php');

        p('Core functions');
          
        codein(null); ?>
&lt;?php

// page views

<b>function counter_page_views_db(): string </b>
{
    $db = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'php-playground' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'counter_page-views' . DIRECTORY_SEPARATOR . 'total.txt';
    return $db;
}
<b>function counter_page_views_increment(): void</b>
{
    $db = counter_page_views_db();
    if (file_exists($db)) {
        $views = (int)file_get_contents($db);
        $views++;
    } else {
        $views = 1;
    }
    file_put_contents($db, $views);
}
<b>function counter_page_views_snippet(): void</b>
{
    $db = counter_page_views_db();
    $counter_total = file_get_contents($db);
    $line = "&lt;b>$counter_total&lt;/b> page view";
    if ($counter_total !== 1) { $line .= 's'; }; // Use plural only if several views
    echo $line;
}<?php codeout();


// STOP EDITING
        
require '../../includes/footer.php'; 

/**
 *  code for "<": &lt;
 */

?>