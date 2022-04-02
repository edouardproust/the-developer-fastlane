<?php
require '../../includes/header.php';
get_post_head('https://www.grafikart.fr/tutoriels/session-php-1128');

// START EDITING

title('Lesson'); // '1' or '2' for preset titles

    instruction('Instructions & result');

        resultin();
            exo_gallery_link(100, [1], '', true, 0, 0);
        resultout();

        p('Aa');

            codein(); ?><?php codeout();

// STOP EDITING
        
require '../../includes/footer.php'; 

/**
 *  code for "<": &lt;
 */

?>