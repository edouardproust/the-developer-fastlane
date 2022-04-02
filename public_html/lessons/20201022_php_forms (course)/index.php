<?php
require '../../includes/header.php';
get_post_head('https://www.grafikart.fr/tutoriels/forms-php-1123');

// START EDITING

    title('GET and POST methods');

    instruction( 'What\'s the difference between $_GET and $_POST methods ?' );
        p('We use <b>$_GET</b> to display the result of the form inside the browser URL. This way the user is able to share the result of the form to a friend.<br>
        To the contrary, if we want to provide users to share the result of the forms, we\'d better use the <b>$_POST</b> method: this way, the inputs are not displayed inside the URL. This method is usefull when we want to hide some confidential files or when we ask the user to tap a password or any other confidential informations inside the fields.');
    
    
    instruction( '"Guess the secret number" game' );
            p('<b>Instructions:</b> The user enters numbers in a fiel and press the "Guess" button until he guesses the mystery number based on the informations provided to him in return.');

                codein(); ?>
$toGuess = 150;
$action = $_SERVER["REQUEST_URI"];

&lt;form <b>action="&lt;?= $action ?>" method="GET"</b>>
    &lt;input type="number" name="answer" placeholder="Between 0 and 1000" 
    <b>value="&lt;?php htmlentities($_GET['answer']); ?>"</b>>
    <l>// What we wrote insite the "value" property is to keep the user's input inside the field after the page refreshes. 
    // "htmlentities()" function is to avoid bug if the user tap some html code inside the field.</l>
    &lt;button type="submit">Guess&lt;/button>
&lt;/form>
&lt;?php
    if (<b>$_GET['answer']</b> < $toGuess) {
        echo "&lt;br>&lt;div class='error'>Your number is too &lt;b>small&lt;/b>.&lt;/div>";
    } elseif ($_GET['answer'] > $toGuess) {
        echo "&lt;br>&lt;div class='error'>'Your number is too &lt;b>big&lt;/b>.&lt;/div>";
    } else {
        echo "&lt;br>&lt;div class='success'>Well done! You found the number &lt;b>$toGuess&lt;/b>.&lt;/div>";
    }<?php codeout();
           
            resultin();
                $toGuess = 150;
                $action = $_SERVER["REQUEST_URI"]; ?>

                <form action="<?= $action ?>" method="GET">
                    <input type="number" name="answer" placeholder="Between 0 and 1000" value="<?= htmlentities($_GET['answer']); ?>">
                    <button type="submit">Guess</button>
                </form>
                <?php
                if ($_GET['answer'] < $toGuess) {
                    echo "<br><div class='error'>Your number is too <b>small</b>.</div>";
                } elseif ($_GET['answer'] > $toGuess) {
                    echo "<br><div class='error'>'Your number is too <b>big</b>.</div>";
                } else {
                    echo "<br><div class='success'>Well done! You found the number <b>$toGuess</b>.</div>";
                }
            resultout();

        instruction( 'How to get the $_SERVER and $_GET super variables content?' );
            p('We use "var_dup()" function on these variables.');
            p('<br><b>For $_SERVER:</b>');

                codein(); ?>
var_dump($_SERVER);<?php codeout();

                resultin('scroll');
                    ?><pre><?php var_dump($_SERVER); ?></pre><?php
                resultout();
            p('<b>For $_GET:</b><br>
            The array will be empty first, but submit the form above and check this part again after the page refreshed: it should be filled with the number you typed.');
                codein(); ?>
var_dump($_GET);<?php codeout();

                resultin();
                    ?><code><pre><?php
                        var_dump($_GET);
                    ?></code></pre><?
                resultout();
            p('<b>Important:</b> We can see that the array is always filled with a string value instead of a number. That\'s why we\'ll need to make a converstion using "(int)" before the value before using it.');

        instruction( 'How to display and prevent (all) all errors with forms' );
            p('Inside the terminal in Visual Studio Code, simply tap the following command:<br>');
            codein(null); ?>
php -S localhost:8000 -d error_reporting=E_ALL<?php codeout();

            p('
            We get errors when:
            <ol>
                <li>we tap a value en press "Guess"</li>
                <li>remove the "?answer=XXX" part of the url after the page refreshed.</li>
            </ol>
            We then get 2 errors:
            <ol>
                <li>The first is displayed on the webpage after the concerned input field.</li>
                <li>The second shows up inside the HTML source code at the location of the field too.</li>
            </ol>
            <br>
            <b>The following updated code resolves thoses errors by using if statements at the locations we pointed out:</b>
            ');
            codein(); ?>
$toGuess = 150;
$action = $_SERVER["REQUEST_URI"];

&lt;form action="&lt;?= $action ?>" method="GET">
    &lt;input type="number" name="answer" placeholder="Between 0 and 1000" 
    <b>value="&lt;?php if(isset($_GET['answer'])) { </b>htmlentities($_GET['answer']); <b>}</b> ?>" 
    <l>// Prevent errors inside HTML code at the input location.</l>
    &lt;button type="submit">Guess&lt;/button>
&lt;/form>
&lt;?php
    <b>if (isset($_GET['answer']))</b> { <l>// Prevent errors on the webpage</l>
        if ($_GET['answer'] < $toGuess) {
            echo "&lt;br>&lt;div class='error'>Your number is too &lt;b>small&lt;/b>.&lt;/div>";
        } elseif ($_GET['answer'] > $toGuess) {
            echo "&lt;br>&lt;div class='error'>'Your number is too &lt;b>big&lt;/b>.&lt;/div>";
        } else {
            echo "&lt;br>&lt;div class='success'>Well done! You found the number &lt;b>$toGuess&lt;/b>.&lt;/div>";
        }
}<?php codeout();
                       
                        resultin();
                            $toGuess = 150;
                            $action = $_SERVER["REQUEST_URI"]; ?>

                            <form action="<?= $action ?>" method="GET">
                                <input type="number" name="answer" placeholder="Between 0 and 1000" value="<?php if(isset($_GET['answer'])) { htmlentities($_GET['answer']); } ?>">
                                <button type="submit">Guess</button>
                            </form><?php
                            if (isset($_GET['answer'])) { 
                                if ($_GET['answer'] < $toGuess) {
                                    echo "<br><div class='error'>Your number is too <b>small</b>.</div>";
                                } elseif ($_GET['answer'] > $toGuess) {
                                    echo "<br><div class='error'>'Your number is too <b>big</b>.</div>";
                                } else {
                                    echo "<br><div class='success'>Well done! You found the number <b>$toGuess</b>.</div>";
                                }
                            }
                        resultout();

            instruction( 'Reoganizing the code in a more handy way' );
                p('
                It\'s better recommanded to seperate:
                <ul>
                    <li>The <b>"logical" part</b> of the code</li>
                    <li>The <b>"displaying" part</b></li>
                </ul>
                This way we are more able to read the code and to manage it later.<br>
                <b>Here is the code after aplying this recommandation, for exactly the same result as what we get before:</b><br>
                (For this example, je switch to $_POST method just to shwo it\'s exactly the same syntax as for $_GET one)
                ');

                codein(); ?>
<l>// Logical part</l>

    <l>// Variables definition</l>
    $toGuess = 150;
    $action = $_SERVER["REQUEST_URI"];
    $error = null;
    $success = null;
    $answer = null;

    <l>// Conditional statements</l>
    if (isset($_POST['answer'])) {
        $answer = (int)$_POST['answer'];
        if ($answer < $toGuess) {
            $error = "Your number is too &lt;b>small&lt;/b>.";
        } elseif ($answer > $toGuess) {
            $error = "Your number is too &lt;b>big&lt;/b>.";
        } else {
            $success = "Well done! You found the number &lt;b>$toGuess&lt;/b>.";
        }
    }

<l>// Displaying part</l>

    <l>// Form structure</l>
    ?>&lt;form action="&lt;?= $action ?>" method="POST">
        &lt;input type="number" name="answer" placeholder="Between 0 and 1000" value="&lt;?php if(isset($_POST['answer'])) { htmlentities($answer); } ?>">
        &lt;button type="submit">Guess&lt;/button>
    &lt;/form>&lt;?php

    <l>// Result layout</l>
    if ($error) {
        echo "&lt;br>&lt;div class='error'>$error&lt;/div>";
    } elseif ($success) {
        echo "&lt;br>&lt;div class='success'>$success&lt;/div>";
    }<?php codeout();

                resultin();
                // Logical part 

                    // Variables definition
                    $toGuess = 150;
                    $action = $_SERVER["REQUEST_URI"];
                    $error = null;
                    $success = null;
                    $answer = null;

                    // Conditional statements
                    if (isset($_POST['answer'])) {
                        $answer = (int)$_POST['answer'];
                        if ($answer < $toGuess) {
                            $error = "Your number is too <b>small</b>.";
                        } elseif ($answer > $toGuess) {
                            $error = "Your number is too <b>big</b>.";
                        } else {
                            $success = "Well done! You found the number <b>$toGuess</b>.";
                        }
                    }
                // Displaying part

                    // Form structure 
                    ?><form action="<?= $action ?>" method="POST">
                        <input type="number" name="answer" placeholder="Between 0 and 1000" value="<?php if(isset($_POST['answer'])) { htmlentities($answer); } ?>">
                        <button type="submit">Guess</button>
                    </form>
                    <?php

                    // Result layout
                    if ($error) {
                        echo "<br><div class='error'>$error</div>";
                    } elseif ($success) {
                        echo "<br><div class='success'>$success</div>";
                    } 
                resultout();

            
title('Using checkboxes');

    instruction('Ice cream customizer program');
        p('We ask the user to chose his favorite flavour:');

        codein(); ?>
$action = $_SERVER["REQUEST_URI"]; ?>
&lt;form action="&lt;?= $action ?>" method="GET">
    &lt;input type="<b>checkbox</b>" name="flavour" value="Strawberry"> Strawberry&lt;br>
    &lt;input type="<b>checkbox</b>" name="flavour" value="Vanilla"> Vanilla&lt;br>
    &lt;input type="<b>checkbox</b>" name="flavour" value="Chocolate"> Chocolate&lt;br>
    &lt;button type="submit">Validate my choice&lt;/button>
&lt;/form>&lt;?php<?php codeout();
        
        resultin();

            $action = $_SERVER["REQUEST_URI"];
            
            ?><form action="<?= $action ?>" method="GET">
                <input type="checkbox" name="flavour" value="Strawberry"> Strawberry<br>
                <input type="checkbox" name="flavour" value="Vanilla"> Vanilla<br>
                <input type="checkbox" name="flavour" value="Chocolate"> Chocolate<br>
                <button type="submit">Validate my choice</button>
            </form><?php

        resultout();

        p('If we check the output array, we can see that, whatever the number of checkboxes you checked, the array is always field with only one value (the lower in the list). This is due to the fact that the "name" entry is the same for all the fields (here, it\'s set to "flavour").');
        
        resultin();
            if (isset($_GET['flavour'])) {
                echo 'var_dump content:<br><b><code><pre>';
                var_dump($_GET['flavour']);
                echo '</pre></code></b>';
            } else {
                echo '<i>Please choose a flavour with the form above to show the var_dump() content here.</i>';
            }
        resultout();

        p('As a walk-around, we transform the "name" entry into an array: <b>flavour[]</b>.');

        codein(); ?>
$action = $_SERVER["REQUEST_URI"]; ?>
&lt;form action="&lt;?= $action ?>" method="GET">
    &lt;input type="checkbox" name="<b>flavour[]</b>" value="Strawberry"> Strawberry&lt;br>
    &lt;input type="checkbox" name="<b>flavour[]</b>" value="Vanilla"> Vanilla&lt;br>
    &lt;input type="checkbox" name="<b>flavour[]</b>" value="Chocolate"> Chocolate&lt;br>
    &lt;button type="submit">Validate my choice&lt;/button>
&lt;/form>&lt;?php<?php codeout();

        resultin();
        ?><form action="<?= $action ?>" method="GET">
            <input type="checkbox" name="flavour2[]" value="Strawberry"> Strawberry<br>
            <input type="checkbox" name="flavour2[]" value="Vanilla"> Vanilla<br>
            <input type="checkbox" name="flavour2[]" value="Chocolate"> Chocolate<br>
        <button type="submit">Validate my choice</button>
        </form><?php
        resultout();

        resultin();
            if (isset($_GET['flavour2'])) {
                echo 'var_dump content:<br><b><code><pre>';
                var_dump($_GET['flavour2']);
                echo '</pre></code></b>';
            } else {
                echo '<i>Please choose a flavour with the form above to show the var_dump() content here.</i>';
            }
        resultout();

        p('This technic is usefull for any type of fields group in which fields have the same "name" entry: radio, text,... you name it.');

// STOP EDITING
        
require '../../includes/footer.php'; 

?>