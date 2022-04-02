<?php
require '../../includes/header.php';
get_post_head('https://www.grafikart.fr/tutoriels/fonctions-php-1119');

// START EDITING

    
    title('Lesson');

        instruction( 'How to read the php documentation' );
            p('Go to: <a href="https://www.php.net/docs.php" target="_blank">PHP Doc</a> > <a href="https://www.php.net/manual/en/funcref.php" target="_blank"> Function Reference</a><br>');
            p('Below is a example of the PHP doc syntax to explain a function (the <a href="https://www.php.net/manual/en/function.print-r.php" target="_blank">print_r</a> function):');

            codein(); ?>
print_r ( mixed $expression [, bool $return = FALSE ] ) : mixed<?php codeout();

            p('
            <b>Explanation:</b>
            <ul>
                <li>After $ are the <b>variables</b> example (these are explained further inside the doc page).</li>
                <ul>
                    <li><b>Mutable functions</b>: Sometimes a <b>"&"</b> appears before the variable (eg, "&$var"): it means that <b>the variable will be modified by the function</b>. 
                    Example: <a href="https://www.php.net/manual/en/function.sort.php" target="_blank">sort()</a></li>
                </ul>
                <li>Before $ is the <b>type of value</b> for the variable:</li>
                <ul>
                    <li><b>int</b>: is an integer ("0", "1", "2",...)</li>
                    <li><b>float</b>: is a decimal number ("1.54", "2.12",...)</li>
                    <li><b>bool</b>: is a boolean value ("true" or "flase")</li>
                    <li><b>mixed</b>: is any of the previous tyopes (wether an int, float or bool).</li>
                </ul>
                <li>Between [ ] are the <b>optional variables</b> listed</li>
                <ul>
                    <li>If <b>"..."</b> (3 dots) is displayed before the closing "]", it means that we can enter <b>an infinity of parameters</b>. 
                    Example: <a href="https://www.php.net/manual/en/function.array-push.php" target="_blank">array_push()</a></li>
                </ul>
                <li>At the end of the line, after the ":", is the <b>"return" type</b>:</li>
                <ul>
                    <li><b>Regular</b>: int, float, bool or mixed</li>
                    <li><b>"void"</b> when the function can\'t return anything. 
                    Example: <a href="https://www.php.net/manual/en/function.var-dump.php" target="_blank">var_dump()</a></li>
                </ul>
            </ul>
            ');

    title('Exercise: String functions');  
        
        p('Go to: <a href="https://www.php.net/docs.php" target="_blank">PHP Doc</a>  > <a href="https://www.php.net/manual/en/funcref.php" target="_blank"> Function Reference</a> > <a href="https://www.php.net/manual/en/ref.strings.php" target="_blank"> String Functions</a>');
         
        instruction( 'Check wether a sentence is a palindrom' );

            resultin();
                $sentence = strtolower($_GET['sentence']);
                $reversed = strrev($sentence);
                if (isset($_GET['sentence'])) {
                    if ($sentence === $reversed) {
                        echo '<div style="color:green"><b>This is a palindrom :)</b></div>';
                    } else {
                        echo '<div style="color:red"><b>This is NOT a palindrom :(</b></div>';
                    }
                }
                ?>
                    <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="GET">
                        <label>
                            <p>Please enter a sentence or a work to check wether it is a palindrom or not:</p>
                            <input type="text" name="sentence" value="<?= $_GET["string"] ?>" placeholder='example: "Kayak"' >
                        </label>
                        <button type="submit">Validate</button>
                    </form>
                <?php
            resultout();

            codein(); 
                ?>
$sentence = <b>strtolower</b>($_GET['sentence']); <l>// Turn inputs into a lowercase version</l>
$reversed = <b>strrev</b>($sentence) ); { <l>// Create a reversed version of the previous lowercased input</l>
    if (isset($_GET['sentence'])) {
        if ($sentence === $reversed) {
            echo '&ltdiv style="color:green">&ltb>This is a palindrom :)&lt/b>&lt/div>';
        } else {
        echo '&ltdiv style="color:red">&ltb>This is NOT a palindrom :(&lt/b>&lt/div>';
        }
    }
}

?>
    &ltform action="&lt?= $_SERVER["REQUEST_URI"] ?>" method="GET">
        &ltlabel>
            &ltp>Please enter a sentence or a work to check wether it is a palindrom or not:&lt/p>
            &ltinput type="text" name="sentence" value="&lt?= $_GET["string"] ?>" placeholder='example: "kayak"' >
        &lt/label>
        &ltbutton type="submit">Validate&lt/button>
    &lt/form>
&lt?php<?php codeout();

    title('Exercise: "Arrays" functions');
        p('Go to: <a href="https://www.php.net/docs.php" target="_blank">PHP Doc</a> > <a href="https://www.php.net/manual/en/funcref.php" target="_blank"> Function Reference</a> > <a href="https://www.php.net/manual/en/ref.array.php" target="_blank"> Arrays Functions</a>');
            
            instruction( 'Calculate the average grade of a student' );

                resultin();
                    $grade = $_GET["grade"];
                    $grades = [];

                    $grades[] = $grade;
                    if (isset($_GET["grade"])) {
                        $input = $_GET["grade"];
                        $grades = (array)explode(",", $input);
                        $average = round( (int)array_sum($grades) / (int)count($grades), 2);
                        echo "Your average grade is: <b>$average</b>";
                    }
                    ?>
                        <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="GET">
                            <label>
                                <p>Please enter your grades, separated with commas:</p>
                                <input type="text" name="grade" placeholder="From 0 to 20">
                            </label>
                            <button type="submit">Calculate my average grade</button>
                        </form>
                    <?php 
                resultout();

            codein(); 
                ?>
$grade = $_GET["grade"];
$grades = [];

if (isset($_GET["grade"])) {
    $input = $_GET["grade"];
    $grades = <b>(array)explode(",", $input)</b>;  <l>
        // - <b>explode()</b> function splits a string by string
        // - Then we fill an array with the split parts
    </l>
    $average = <b>round( (int)array_sum($grades) / (int)count($grades), 2)</b>; <l> 
        // We use 3 functions here: 
            - <b>count()</b> to count all elements in a array
            - <b>array_sum()</b> to calculate the sum of values in the array
            - <b>count()</b> to return the rounded value twith a precision of 2 digits after comma
    </l>
    echo "Your average grade is: &ltb>$average&lt/b>";
}
?>
    &ltform action="&lt?= $_SERVER["REQUEST_URI"] ?>" method="GET">
        &ltlabel>
            &ltp>Please enter your grades, separated with commas:&lt/p>
            &ltinput type="text" name="grade" placehoder="From 0 to 20">
        &lt/label>
        &ltbutton type="submit">Calculate my average grade&lt/button>
    &lt/form>
&lt?php<?php codeout();

    title('Training exercises');
        
        instruction( 'Anti-insults filter' );
            
        p('After a text is typed by the user, we want to keep only the first letter of the hidden word and replace other letters by * symbols.');
            
            resultin();
                if (isset($_GET["insults"]) && isset($_GET["comment"])) {
                    $insults = (array)explode(',', str_replace(" ","", strtolower( $_GET["insults"]) ) ); 
                        // Transform the words list by an array containing each word seperatly (lowercased and whitespaces free)
                    $comment = (string)strtolower($_GET["comment"]);
                        // Lowercase the comment to be able to compare it to insults list
                    foreach ($insults as $insult) {
                        $first_letter = substr($insult, 0, 1); // Extract first letter
                        $stars = str_repeat('*', strlen($insult) - 1); // Create line of * corresponding to the numbers of letters in the word (-1)
                        $hidden_insult = $first_letter . $stars; // Join both parts
                        $comment = ucfirst(str_replace($insult, $hidden_insult, $comment)); // Display the filtered comment
                    }
                    echo "<h4>Filtered comment:</h4>
                    <p class='success' style='color:green'>$comment</p>";
                }
                ?>
                    <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="GET">
                        <div>
                            <h4>Admin side</h4>
                            <label>
                                <p>Enter the words you want to hide (seperated with commas):</p>
                                <input type="text" name="insults" value="<?= $_GET['insults'] ?>" placeholder="fuck, bad, shit">
                            </label>
                        </div>
                        <div>
                            <h4>Frontend (user side)</h4>
                            <label>
                                <p>Enter a comment:</p>
                                <textarea name="comment" rows="4" cols="50" placeholder="shit, this article is fucking bad"><?php 
                                    if (isset($_GET['comment'])) { 
                                        echo htmlentities ($_GET['comment']); 
                                    } 
                                ?></textarea>
                            </label>
                        </div>
                        <button type="submit" style="margin-top: 20px; font-size: 18px; font-weight: 700">
                            Process filter!
                        </button>
                    </form>
                <?php 
            resultout();

            codein(null);?>
if (isset($_GET["insults"]) && isset($_GET["comment"])) {
    $insults = (array)<b>explode</b>(',', <b>str_replace</b>(" ","", <b>strtolower</b>($_GET["insults"])))</b>; <l>
        // Transform the words list by an array containing each word seperatly 
        (lowercased and whitespaces free) </l>
    $comment = (string)<b>strtolower</b>($_GET["comment"])</b>; <l>
        // Lowercase the comment to be able to compare it to insults list </l>
    foreach ($insults as $insult) {
        $first_letter = <b>substr</b>($insult, 0, 1); <l>// Extract first letter</l>
        $stars = <b>str_repeat</b>('*', <b>strlen</b>($insult) - 1); <l>
            // Create line of * corresponding to the numbers of letters in the word (-1)</l>
        $hidden_insult = $first_letter . $stars; <l>// Join both parts</l>
        $comment = <b>ucfirst</b>(<b>str_replace</b>($insult, $hidden_insult, $comment)); <l>
            // Display the filtered comment</l>
    }
    echo "&lth4>Filtered comment:&lt/h4>
    &ltp class='success' style='color:green'>$comment&lt/p>";
}
?>
    &ltform action="&lt?= $_SERVER["REQUEST_URI"] ?>" method="GET">
        &ltdiv>
            &lth4>Admin side&lt/h4>
            &ltlabel>
                &ltp>Enter the words you want to hide (seperated with commas):&lt/p>
                &ltinput type="text" name="insults"  value="&lt?= $_GET['insults'] ?>" placeholder="fuck, bad, shit">
            &lt/label>
        &lt/div>
        &ltdiv>
            &lth4>Frontend (user side)&lt/h4>
            &ltlabel>
                &ltp>Enter a comment:&lt/p>
                &lttextarea name="comment" rows="4" cols="50" placeholder="shit, this article is fucking bad">&lt?php 
                    if (isset($_GET['comment'])) { 
                        echo htmlentities ($_GET['comment']); 
                    } ?>
                &lt/textarea>
            &lt/label>
        &lt/div>
        &ltbutton type="submit" style="margin-top: 20px; font-size: 18px; font-weight: 700">
            Process the filter!
        &lt/button>
    &lt/form>
&lt?php <?php codeout();

    title('Other usefull functions list');
        p('
        Here are some other functions that it is usefull to be aware of:
        <ul>
        <li><b>exit()</b>: "Output a message and terminate the current script"</li>
        <li><b>die()</b>: "Equivalent to exit"</li>
        <li>To be continued...</li>
        </ul>
        ');


            /*
            code for "<" : &lt;

            accordionin();
                accordionli('
                Title','
                    Content<br>
                    <br><b>List</b>
                    <ul>
                        <li>li element</li>
                    </ul>');
            accordionout();
    */

// STOP EDITING
        
require '../../includes/footer.php'; 

?>