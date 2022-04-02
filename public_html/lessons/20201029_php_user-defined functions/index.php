<?php
require '../../includes/header.php';
get_post_head('https://www.grafikart.fr/tutoriels/fonctions-utilisateurs-php-1120');

// START EDITING

    
    title(1);

        instruction( 'Basics' );

            p('
            <ul>
            <li>When we store the result of a function inside a variable, we need to use <b>"return"</b>. Return break the function, so that anything written after it will be muted.</li>
            <li>If we simply want to display a reulst, we use <b>"echo"</b></li>
            </ul>
            ');

            function b($title) {
                echo '<b style="text-transform:uppercase">' . $title . '</b><br>';
            }

            codein(null); ?>

<?= b('// 1. Call variables') ?>

function hello (<b>$name</b>) { <l>// Define the function</l>
    echo 'Hello' . $name . '&ltbr>'; <l>// What the function does</l>
}
hello(<b>'Jane'</b>); <l>// Display the function. Result: "Hello Jane"
// In the caller, 'Jane' replace $name in the function</l>


<?= b('// 2. Store function result inside a variable (out of the function)') ?>

function hello ($name) {
    <b>return</b> 'Hello' . $name . '&ltbr>'; <l>// This time we use "return" instead of "echo"</l>
}
<b>$hello</b> = hello('Jane'); <l>// Display the function. Result: "Hello Jane"</l>
<b>echo $hello</b>; <l>// Display the variable's content we stored.</l>


<?= b('// 3. Define a default variable\'s value') ?>

function hello ($name <b>= 'Jane'</b>) { <l>// The default value for $name is set to Jane</l>
    return 'Hello' . $name . '&ltbr>'; 
}
$hello = <b>hello()</b>; <l>// This way, if no variable is set inside the caller, then "Jane" will display.
// In this case, if no default value is set, then the function will return an error as it misses a value to operate.</l>
echo $hello;

<?= b('// 4. Define a default null value') ?>

function hello ($name <b>= null</b>) { <l>// The default value for $name is set to null, allowing us to leave the caller blank</l>
    if ($name === null) {
        return 
    }
        echo 'Hello' . $name . '&ltbr>'; 
}
<b>hello()</b>; <l>// This way, if no variable is set inside the caller, then "Jane" will display.
// In this case, if no default value is set, then the function will return an error as it misses a value to operate.</l>
<?php codeout();


title(2);

    p('We create a small program to be used inside the terminal. It\'s made of 3 functions:
    <ol>
        <li>Ask the user if he wants to continue or not</li>
        <li>Ask the user to enter a new timeslot</li>
        <li>Display the timeslots list</li>
        <li>Put all 3 previous functions together</li>
    </ol>');

    resultin();
        exo_gallery(50, [1,2,3,4]);
    resultout();

    codein(null);?>
<?= b('// FUNCTION Nr.1: Ask the user if he wants to continue or not') ?>

function answer_yes_no(string $line = 'Do you want to continue?'): bool <l>
    // We precise variables and return types for each function to make it easier to work with later...</l>
{
    while(true) {
        $continue = readline($line . ' ("n" = no / "y" = yes) ');
        if($continue === 'y' || $continue === 'yes') {
            return true;
        } elseif ($continue === 'n' || $continue === 'no') {
            return false;
        }
    }
}

<?= b('// FUNCTION Nr.2: Ask the user to enter a new timeslot') ?>

function ask_for_timeslot(string $line = 'Please enter a timeslot.'): array <l>
    // ...Here again...</l>
{
    $error = 'Oops you made a mistake.';
    echo PHP_EOL . $line . PHP_EOL;
    while(true) {
        $start = (int)readline('What is the opening hour? ');
        if ($start >= 0 && $start < 24 ) {
            break;
        } else {
            echo $error . ' You must type an integer between 0 and 23.' . PHP_EOL;
        }
    }
    while(true) {
        $end = (int)readline('What is the closing hour? ');
        if ($end > 0 && $end <= 24 && $start < $end) {
            break;
        } else {
            echo $error . ' You must type an integer between 1 and 24 and bigger than the opening hour.' . PHP_EOL;
        }
    }
    return [$start, $end];
}

<?= b('// FUNCTION Nr.3: Display the timeslots list') ?>

function timeslots_display(array $array, string $line = "Here are the shop opening hours:"): string <l>
    // ...and again... </l>
{
    echo PHP_EOL . $line . PHP_EOL; 
    $display = null;
    foreach ($array as $slot) {
        if ($slot[0] < 12) {$t1 = 'am';} else  {$t1 = 'pm';}
        if ($slot[1] < 12) {$t2 = 'am';} else  {$t2 = 'pm';}
        $display .= '• ' . $slot[0] . $t1 . ' - ' . $slot[1] . $t2 . PHP_EOL;
    }
    return $display;
}

<?= b('// FUNCTION Nr.4: Put all 3 previous functions together') ?>

function ask_for_timeslots(string $line = 'OPENING HOURS'): string<l>
    // ...This must become a habit!</l>
{
    $timeslots = [];
    $continue = true;
    echo PHP_EOL . $line . PHP_EOL;
    while($continue) {
        $timeslots[] = ask_for_timeslot();
        $continue = answer_yes_no();
    }
    return timeslots_display($timeslots);
}

<?= b('// FIRE THE PROGRAM!') ?>

echo ask_for_timeslots();<?php codeout();

/*


            code for "<" : &lt;

    */

// STOP EDITING
        
require '../../includes/footer.php'; 

?>