<?php
require '../../includes/header.php';
get_post_head('https://www.grafikart.fr/tutoriels/file-get-contents-1125');

// START EDITING

title('Result & instructions');

    resultin();
        exo_gallery_link(100,[1],'menu.php');
    resultout();

    instruction('Instructions');
        
        p('
            <b>Video</b> - Go to the exercise time: <a href="https://youtu.be/wif5ZmUzbH8?t=1209" target=_blank">20:10</a>'
        , 0, 1); ?>
        
        <ul>
            <li>We have a <b>plain text file</b>, both in <a href="http://grafikart.local:8888/lessons/files/php_files%20reading%20(exercise)_20201108/data/menu.csv">.CSV format</a> (separated with commas)
             and <a href="http://grafikart.local:8888/lessons/files/php_files%20reading%20(exercise)_20201108/data/menu.tsv">.TSV format</a> (separated with tab space)</li>
            <li>We want to create a nice / easier to read layout for the restaurant's menu</li>
            <li>So, we'll need to <b>use "file reading" functions to seperate each line of the file and then reformat them</b>:
                <ul>
                    <li>Dishes categories will be in &lt;h3></li>
                    <li>The dish name will be in bold character, so will be the price</li>
                    <li>The price will be displayed inside a right colum to the right, as a 2 digits after comma float number</li>
                    <li>Ingredients will be displayed as standard paragraph</li>

                </ul>
        </ul><?php

title('Code <span style="text-transform:none">(menu.php)</span>');

    instruction('To read a .TSV file');

        codein(null); ?>
<l>&lt;?php 
$title = 'Menu';
require 'includes/header.php';
require_once 'data/config.php';
?>

&lt;p class="lead mb-5">
    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Adipisci cupiditate in iusto vel asperiores impedit non. Provident hic illum adipisci optio laboriosam consequuntur voluptatem, temporibus asperiores doloremque ratione atque facere!
&lt;/p>

&lt;div class="row">
    &lt;div class="col-md-8 mb-5"></l>
        &lt;h2 class="pb-3">What will you eat today?&lt;/h2>
        &lt;?php
        <b>(array)$lines = file(__DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'menu.tsv');
        foreach ($lines as $line) {
            $line = explode("\t", trim($line));</b> <l>// "\t" is for the tabulation sign in PHP</l>
            if(count($line) === 1) { ?> <l>// Check if the line is a title (only 1 argument in the array)</l>
                &lt;hr>&lt;h3>&lt;?= $line[0] ?>&lt;/h3>&lt;?php
            } else { ?>
                &lt;div class="row">
                    &lt;div class="col-md-10">
                    &lt;p>
                        &lt;b>&lt;?= $line[0] ?>&lt;/b>&lt;br>
                        &lt;?= $line[1] ?>
                    &lt;/p>
                    &lt;/div>
                    &lt;div class="col-md-2">
                    &lt;b>$&lt;?php echo number_format( end($line), 2, ".", "," ); ?>&lt;/b>
                    &lt;/div>
                &lt;/div>&lt;?php
            }
        <b>}</b> 
        ?><l>
    &lt;/div>
    &lt;div class="col-md-4">
        &lt;h2 class="pb-3">Made with love&lt;/h2>
        &lt;p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aliquid pariatur saepe minima eaque in enim. Temporibus sed libero perspiciatis culpa fugit, voluptates ut, explicabo quos rem veritatis aliquam iure vel.&lt;/p>
    &lt;/div>
&lt;/div>

&lt;?php require 'includes/footer.php'; ?></l><?php codeout();

    instruction('To read a .CSV file');

        codein(null); ?>
<l>&lt;?php 
$title = 'Menu';
require 'includes/header.php';
require_once 'data/config.php';
?>

&lt;p class="lead mb-5">
    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Adipisci cupiditate in iusto vel asperiores impedit non. Provident hic illum adipisci optio laboriosam consequuntur voluptatem, temporibus asperiores doloremque ratione atque facere!
&lt;/p>

&lt;div class="row">
    &lt;div class="col-md-8 mb-5"></l>
        &lt;h2 class="pb-3">What will you eat today?&lt;/h2>
        &lt;?php
        (array)$lines = file(__DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'menu.csv');
        foreach ($lines as $line) {
            <b>$line = str_getcsv(trim($line, " \t\n\r\0\x0B,"));</b> <l>
                // The str_getcsv() function is made especially to parse CSV files
                //  \t\n\r\0\x0B," are the delimiters</l>
            if(count($line) === 1) { ?> <l>// Check if the line is a title (only 1 argument in the array)</l>
                &lt;hr>&lt;h3>&lt;?= $line[0] ?>&lt;/h3>&lt;?php
            } else { ?>
                &lt;div class="row">
                    &lt;div class="col-md-10">
                    &lt;p>
                        &lt;b>&lt;?= $line[0] ?>&lt;/b>&lt;br>
                        &lt;?= $line[1] ?>
                    &lt;/p>
                    &lt;/div>
                    &lt;div class="col-md-2">
                    &lt;b>$&lt;?php echo number_format( end($line), 2, ".", "," ); ?>&lt;/b>
                    &lt;/div>
                &lt;/div>&lt;?php
            }
        }
        ?><l>
    &lt;/div>
    &lt;div class="col-md-4">
        &lt;h2 class="pb-3">Made with love&lt;/h2>
        &lt;p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aliquid pariatur saepe minima eaque in enim. Temporibus sed libero perspiciatis culpa fugit, voluptates ut, explicabo quos rem veritatis aliquam iure vel.&lt;/p>
    &lt;/div>
&lt;/div>

&lt;?php require 'includes/footer.php'; ?></l><?php codeout();

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