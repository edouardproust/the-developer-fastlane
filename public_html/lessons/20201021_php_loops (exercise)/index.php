<?php
require '../../includes/header.php';
get_post_head('https://www.grafikart.fr/tutoriels/conditions-php-1117');

// START EDITING

    p('Jump directly to the exercise in the video: <a href="https://youtu.be/4C4lwPM1ESk?t=1023" target="_blank">17:03</a>'
    ,0,0); 

    accordionin();
        accordionli('Instructions','
        <b><ol>
            <li>We ask the user to enter opening hours of a shop.</li>
            <li>Then we ask him to type an hour</li>
            <li>We answer him if the store is open at this time.</li>
        </ol></b>
        <div class="paragraph">
        First thing, we can divide the 1st part of the problem this way to make it clearer:
            <ol>
                <li>Ask for the start hour</li>
                <li>Ask for the end hour</li>
                <li>Verify that start hours < end hour</li>
                <li>Ask him if he wants to add another time slot (y/n)</li>
            </ol>
        </div>');
        accordionout();

//------------------------------------------

title('My solution');

    codein(); ?>
    start: 
    echo PHP_EOL . '1. Please enter the store\'s opening hours.' . PHP_EOL;
    
    $slots = [];
    $continue = 'y';
    $i=0;
    
    while( $continue === 'y' ) {
    
        echo PHP_EOL;
        $input_start = (int)readline('Please enter the starting hour for the slot: ');
        $input_end = (int)readline('Please enter the ending hour for the slot: ');
        
        if ($input_start < $input_end) {
            $slots[$i]['start'] = $input_start;
            $slots[$i]['end'] = $input_end;
            $i++;
            $continue = readline('Do you want to enter another time slot? (y/n) ');
        } else {
            echo 'Oops you\'ve made a mistake, please try again.' . PHP_EOL;
        }
    }
    
    echo PHP_EOL;
    $input_visit = (int)readline('2. At which hour do you plan to visit the store? ');
    
    for ($i=0; $i&lt;count($slots); $i++) {
        if ( $input_visit > $slots[$i]['start'] && $input_visit < $slots[$i]['end'] ) {
            echo PHP_EOL . 'Great, the store will be open at this time!' . PHP_EOL . 
            'You\'ll be able to come from ' . $slots[$i]['start'] . ' to ' . $slots[$i]['end'] . "." . PHP_EOL;
            goto start;
        } 
    }
    echo PHP_EOL . 'Unfortunatly, the store will be closed at this time...' . PHP_EOL;
    echo 'Here are the opening hours:' . PHP_EOL;
    foreach ($slots as $slot) {
        echo '• ' . $slot['start'] . ' to ' . $slot['end'] . PHP_EOL;
    }
    goto start;
    <?php codeout();

    instruction('Here is the result in the terminal:');

        resultin();
            exo_gallery(50, [1,2,3,4]);
        resultout();

//------------------------------------------

title('Solution in the video');

echo 'Result time: <a href="https://youtu.be/4C4lwPM1ESk?t=1187" target="_blank">19:47</a>'; 

    codein(null); ?>

start:

$slots = [];

<b>while(true)</b> {
    $start = (int)readline('Please enter the opening hour: ');
    $end = (int)readline('Please enter the closing hour: ');
    if ($start >= $end) {
        echo "The slot can't be saved as the opening time ($start) is later than the closing time ($end)." . PHP_EOL;
    } else {
        $slots[] = [$start, $end];
        $action = readline('Do you want to type a new timeslot ("y" = yes / "n" = no)? ');
        if ($action === 'n') {
            break;
        }
    }
}
echo PHP_EOL;

$time = readline("At which hour do you plan to visit the store? ");
$condition = false;
foreach ($slots as $slot) {
    if ($time >= $slot[0] && $time <= $slot[1]) {
        $condition = true;
    }
}
if ($condition) {
    echo 'The store will be open at this time.';
} else {
    echo 'Sorry, the store will be closed.';
}

<l>// Extra: display opening hours at the end of the process.</l>

echo PHP_EOL . 'The store will be open from ';
foreach ($slots as <b>$k</b> => $slot) { <l>// Tip: We use the key as an incremental index</l>
    <b>if ($k > 0) {
        echo ' and from ';
    }</b>
    if ($slot[0] <= 12) { $t1 = 'am'; } else { $t1 = 'pm'; }
    if ($slot[1] <= 12) { $t2 = 'am'; } else { $t2 = 'pm'; }
    echo $slot[0] . $t1 . ' to ' . $slot[1] . $t2 . PHP_EOL;
}
echo PHP_EOL;

goto start;

        <?php codeout();

// STOP EDITING
        
require '../../includes/footer.php'; 

?>