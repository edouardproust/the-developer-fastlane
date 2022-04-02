<?php

/* Includes */

    echo '<style>';
        include (dirname(__FILE__, 3) . '/assets/style.css');
    echo '</style>';


/* Form to play with */

    ?>
    <div style="padding:30px">
    <form action="<?php __FILE__ ?>" method="get">
        Number: <input type="number" value="42" name="name"><br><br>
        Text: <input type="text" value="hello" name="email"><br><br>
        <input type="submit">
    </form>
    <?php

/* Show the $_SERVER array result */

    echo '<pre style="font-family:inherit!important; line-height: 1.5em;">';
    var_dump($_SERVER);
    echo '/<pre>';

    ?></div><?php