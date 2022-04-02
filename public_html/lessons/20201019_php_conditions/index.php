<?php
require '../../includes/header.php';
get_post_head('https://www.grafikart.fr/tutoriels/conditions-php-1117');

// START EDITING

title('"Else", "elseif" and "else" statements');

    instruction( 'Check if a student was graded over 10 or not (1 is the french average grade: 20 is the maximum grade)' );

        codein(); ?>
$grade = 9;
if ($grade >= 10) {
    echo 'You got the average grade or more.';
} else {
    echo 'You were graded below the average.';
}<?php codeout();

        resultin();
            $grade = 9;
            if ($grade >= 10) {
                echo 'You got the average grade or more.';
            } else {
                echo 'You were graded below the average.';
            }
        resultout();

        p('Now let\'s update the grade');

        codein(); ?>
$grade = 13;<?php codeout();

        resultin();
            $grade = 13;
            if ($grade >= 10) {
                echo 'You got the average grade or more.';
            } else {
                echo 'You were graded below the average.';
            }
        resultout();

    instruction( 'Create "sub-conditions":' );

        p('For example, let\'s add a sub-condition wether the student got 10 exactly.');

        codein(); ?>
$grade = 10;
if ($grade >= 10) { // condition 1
    <b>if ($grade == 10) { // sub-condition 1
        echo 'You are just on the average.';
    } else { // sub-condition 2
        echo 'You got the average grade or more.';
    }</b>
} else { // condition 2
    echo 'You were graded below the average.';
}<?php codeout();

        resultin();
            $grade = 10;
            if ($grade >= 10) { // condition 1
                if ($grade == 10) { // sub-condition 1
                    echo 'You are just on the average.';
                } else { // sub-condition 2
                    echo 'You got the average grade or more.';
                }
            } else { // condition 2
                echo 'You were graded below the average.';
            }
        resultout();

    instruction( 'Let\'s simplify this syntax using "elseif":' );

        codein(); ?>
$grade = 10;
if ($grade <b>></b> 10) { // condition 1
    echo 'You got more than the average.';
} <b>elseif ($grade == 10) { // condition 2
    echo 'You are just on the average.';</b>
} else { // condition 3
    echo 'You were graded below the average.';
}<?php codeout();

        resultin();
            $grade = 10;
            if ($grade > 10) { // condition 1
                echo 'You got more than the average.';
            } elseif ($grade == 10) { // condition 2
                echo 'You are just on the average.';
            } else { // condition 3
                echo 'You were graded below the average.';
            }
        resultout();

title('The "==" and "===" operators: which difference ?');

    p('
        <ul>
            <li>"==" doesn\'t verify if the variable\'s type is identical to user\'s input: if they\'re not, the server makes a automatic conversion to make both variables type match.</li>
            <li>"===" verify if both types are identical (ie. interger, float, string...) </li>
        </ul>
        As a consequence, if we used "===" in the previous code, then the condition 2 ("You are just on the average.") wouldn\'t have been fired even if it was true. 
        <br><b>In general it\'s better to use "===" and to precise each time the type of integer we expect.</b>
        This way, we often avoid some unpredictable outputs of the code.
        <br> To convert manually an user input to the variable type we want while using "===" (in this case, in integer), we have to use this syntax below:
    ');

    codein(); ?>
$grade = <b>(int)</b>readline('Enter your grade: ');
if ($grade >= 10) { // condition 1
    echo 'You got more than the average.';
} elseif ($grade == 10) { // condition 2
    echo 'You are just on the average.';
} else { // condition 3
    echo 'You were graded below the average.';
}<?php codeout();

    p('
    <ul>
        <li>using <b>(int)</b> for "integer" we tell the server to convert the input into an integer.</li>
        <li><b>readline()</b> function is a quick way to get user\'s input in the terminal (this won\'t work online. 
        Later, we\'ll learn how to create fields to get users\' inputs while being live.)</li>
    </ul>
    ');

title('The "Switch" statement');

    instruction(' Ask the player to performe an action, entering a digit (from 1 to 5)' );

        codein(); ?>
$action = (int)readline('Entrez votre action: (1: attack, 2: magic, 3: defense, 4: pass, 5: run away)');
<b>switch ($action)</b> {
    <b>case 1:</b>
        echo 'You shout while you attack the enemy! The enemy loses 20 HP.';
    <b>break;</b>
    <b>case 2:</b>
        echo 'You focus to gather your magic power. A big flash pierces the enemy. He loses 30HP.';
    <b>break;</b>
    <b>case 3:</b>
        echo 'You prefer to prepare for the next attack from the enemy. Your defense increases by 20.';
    <b>break;</b>
    <b>case 4:</b>
        echo 'You wait until the next turn.';
    <b>break;</b>
    <b>case 5:</b>
        echo 'You try to run away from the battle but you failed!';
    <b>break;</b>
}<?php codeout();

        p('In the previous code, <b>break;</b> is optional but recommended as it allows the server to stop reading the other cases, which makes your code quicker.');
        p('As <b>readline()</b> function is not working online, for now we use a static value for the $action variable to test the code.');
        
        p('<br><b>Here is the result for 1 as an input value:</b>');
        
function conditions_action($action) {
    switch ($action) {
        case 1:
            echo 'You shout while you attack the enemy! The enemy loses 20 HP.';
        break;
        case 2:
            echo 'You focus to gather your magic power. A big flash pierces the enemy. He loses 30HP.';
        break;
        case 3:
            echo 'You prefer to prepare for the next attack from the enemy. Your defense increases by 20.';
        break;
        case 4:
            echo 'You wait until the next turn.';
        break;
        case 5:
            echo 'You try to run away from the battle but you failed!';
        break;
    }
}
        resultin();
            conditions_action(1);
        resultout();
        
        p('<b>And here is the result for 3 as an input:</b>');
        resultin();
           conditions_action(3);
        resultout();

title('The logical operators: "and", "or", "xor" and "not"');
    
    ?><ul>
            <li><b>The "AND" operator is written "&&"</b>: ture if both conditions are true.</li>
            <li><b>"OR" is written "||"</b>: true if only one of the conditions is true.</li>
            <li><b>"XOR", written "xor"</b>: true if one or several of the conditions is/are true, but NOT ALL.</li>
            <li><b>"NOT" written "!"</b>: true is the condition is false.</li>
    </ul><?php

    instruction('As an example, let\'s precise the different senarios with "and" and "or" operators:');
        
        p('With <b>"and"</b>:');
            ?><ul>
                <li>true && true = true</li>
                <li>true && false = <b>false</b></li>
                <li>false && false = false</li>
            </ul><?php
        p('With <b>"or"</b>:');
            ?><ul>
                <li>true || true = true</li>
                <li>true || false = <b>true</b></li>
                <li>false || false == false</li>
            </ul><?php

title('Logical operators: application exercise');

    instruction('Ask the client for the time he plans to come to the shop. Tell him in return wether the shop will be open or close at this time.');

        codein(); ?>
$hour = (int)readline( 'Please enter the hour you plan to visit us: (enter a number between 0 and 23, 0 being midnight and 23 being 11pm)');
if ( $hour >= 0 && $hour <= 24 ) {
    if ( ( $hour >= 8 && $hour <= 12 ) || ( $hour >= 14 && $hour <= 18 ) ) {
        echo 'The shop will be open !';
    } else {
        echo 'Sorry, the shop will be closed. it is open from 8 to 12 and from 14 to 18.';
    }
} else {
    echo 'You entered a wrong number. Please reload the page and try again.';
}<?php codeout();
    
        p( 'If the user typed "13":');
            resultin();
                function conditions_hours($hour) {
                    if ( $hour >= 0 && $hour <= 24 ) {
                        if ( ( $hour >= 8 && $hour <= 12 ) || ( $hour >= 14 && $hour <= 18 ) ) {
                            echo 'The shop will be open !';
                        } else {
                            echo 'Sorry, the shop will be closed. it is open from 8 to 12 and from 14 to 18.';
                        }
                    } else {
                        echo 'You entered a wrong number. Please reload the page and try again.';
                    }
                }
                conditions_hours(13);
            resultout();

        p( 'If the user typed "9":');
        resultin();
            conditions_hours(9);
        resultout();

// STOP EDITING
        
require '../../includes/footer.php'; 

?>