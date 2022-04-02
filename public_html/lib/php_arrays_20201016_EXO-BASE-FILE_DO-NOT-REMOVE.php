<?php
require '../includes/header.php';
get_post_head('Change this URL');

// START EDITING

accordionin();
    accordionli('
    Title','
        Content<br>
        <br><b>List</b>
        <ul>
            <li>li element</li>
        </ul>');
accordionout();

title('Aa'); // '1' or '2' for preset titles

    instruction('Aa');

        p('Aa');

            resultin();
                p('Aa');
            resultout();

            codein(); ?>
Aa<?php codeout();


// STOP EDITING
        
require '../includes/footer.php'; 

/**
 *  code for "<": &lt;
 */

?>