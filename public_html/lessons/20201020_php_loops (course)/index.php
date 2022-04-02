<?php
require '../../includes/header.php';
get_post_head('https://www.grafikart.fr/tutoriels/conditions-php-1117');

// START EDITING

title('"While" loop');

    instruction( 'Ask the user to type a number until it equals 10' );
    
        codein(); ?>
while ($number !== 10) {
    $number = (int)readline('Please enter a number from 0 to 20: ');
}
echo 'Hurray! You won!';<?php codeout();

        resultin();
            while ($number !== 10) {
                $number = 10;
            }
            echo 'Hurray! You won!';
        resultout();

title('"For" loop');

    instruction( 'Create a basic number incrementation and display it as a list' );
    
        codein(); ?>
echo '&lt;ul&gt;';
for ($i=0; $i<=4; $i++) {
    echo '&lt;li>Lesson ' . $i . '&lt;/li>';
}
echo '&lt;/ul>';<?php codeout();

        resultin();
            echo '<ul>';
            for ($i=0; $i<=4; $i++) {
                    echo '<li>Lesson ' . $i . '</li>';
            }
            echo '</ul>';
        resultout();

    instruction( 'Extract data from an array' );

        codein(); ?>
$names = [ 'Eve', 'John', 'Helen', 'Josh', 'Steve' ]; <l>// array</l>

echo 'Students list:&lt;ul>'; <l>// open list</l>
<b>for ($i=0; $i < count($names); $i++)</b> {
    $index = $i+1; <l>// digit before each name</l>
    echo '&lt;li>' . $index . '. ' . $names[$i] . '&lt;/li>';
}
echo '&lt;/ul>'; <l>// close list</l><?php codeout();

        resultin();
            $names = [ 'Eve', 'John', 'Helen', 'Josh', 'Steve' ];
            echo 'Students list:<ul>';
            for ($i=0; $i < count($names); $i++) {
                $index = $i+1;
                echo '<li>' . $index . '. ' . $names[$i] .'</li>';
            }
            echo '</ul>';
        resultout();

        p('The "foreach" loop allows to do the same thing in a most simple way.');

title('"Foreach" loop');

    instruction( 'Extract data from an array (same as we just did with "for" loop' );

        codein(); ?>
$names = [ 'Eve', 'John', 'Helen', 'Josh', 'Steve' ];

$index=0; <l>// index init. is moved outside the loop</l>
echo 'Students list:&lt;ul>';
<b>foreach ($names as $name)</b> {
    echo '&lt;li>' . $index . '. ' . $name .'&lt;/li>';
    $index++; <l>// index increment is inside the loop</l>
}
echo '&lt;/ul>';<?php codeout();


        resultin();
            $index=0;
            echo 'Students list:<ul>';
            foreach ($names as $name) {
                echo '<li>' . $index . '. ' . $name .'</li>';
                $index++;
            }
            echo '</ul>';
        resultout();

        p('The result is the same, but the code is easier to read, and a bit shorter');

title('A loop inside a loop: "Loops inception" for multidimentional array');

    instruction( 'To do such a thing we use a "foreach" loop inside another' );

codein(); ?>
$classes = [ <l>// multidimentional array</l>
    'class #1' => [ 'Eve', 'John', 'Helen', 'Josh', 'Steve' ],
    'class #2' => [ 'Xavier', 'Mickael', 'Saroise', 'Emily', 'Ruth' ]
];

foreach ($classes as $class => $students) { <l>// 1st level "foreach"</l>
    echo '&lt;b>Students in ' . $class . ': &lt;/b>&lt;ul>';
    <b>foreach ($students as $student)</b> { <l>// 2nd level</l>
        echo '&lt;li>' . $student . '&lt;/li>';
    }
    echo '&lt;/ul>';
}<?php codeout();

        resultin();
            $classes = [ 
                'class #1' => [ 'Eve', 'John', 'Helen', 'Josh', 'Steve' ],
                'class #2' => [ 'Xavier', 'Mickael', 'Saroise', 'Emily', 'Ruth' ]
            ];
            foreach ($classes as $class => $students) {
                echo '<b>Students in ' . $class . ': </b><ul>';
                foreach ($students as $student) {
                    echo '<li>' . $student . '</li>';
                }
                echo '</ul>';
            }
        resultout();

        p('To display a multidimentional array with "foreach" loop, we need to use and creates variables in the following order: 
            <ul>
                <li><b>1. Use the main array variable</b> ("$classes" in the above example)</li>
                <li><b>2. Creates 1 or 2 variables to define the array\'s content</b> ("$class" is the key, and "$students" is the value and the sub-array). The key is optional.</li>
                <li><b>3. Reuse the variable we just used as the sub-array value ($students).</b> ("$classes")</li>
                <li><b>4. Create 1 or 2 variables as in step 1</b> but to define the sub-array\'s content this time ("$student" is the value. No key is used here).</li>
            </ul>
        ');
        p('The key is optional as a variable. <br>
        If the sub-array has no key before him, then only the value matters.<br> 
        <b>Exemple:</b> instead of having "<code>foreach ($classes as $class => $students)</code>" we\'ll have "<code>foreach ($classes as $students)</code>.');

title('Application exercise n.1');

    p('
        <b>1.</b> We ask the user to type a grade or type "end".<br>
        <b>2.</b> Each grade is saved in an array $notes.<br>
        <b>3.</b> The array containing all the grades is displayed as a bullet list.' 
    );

        codein(); ?>
$grades = []; <l>// optional but better fo readability</l>
$grade = null; <l>// same, but may also avoid some bugs if variable has been called previously</l>

while ( $grade !== 'end' ) {
    $grade = readline( 'Please enter a grade (number between 0 and 20) or tap "end" to finish.' ); <l>// ask for input</l>
    if ( $grade !== 'end' )  { <l>// if user entered a grade</l>
        $grades[] = (int)$grade; <l>// Fill the array with new input</l>
    }
}

echo 'Here is the list of your grades: &lt;br>'; // Display inputs
foreach ($grades as $grade) {
    echo '&lt;b>' . $grade . '&lt;/b>&lt;br>';
}<?php codeout();

        resultin();
        $grades = [9, 12, 5, 15, 16, 12];
        echo 'Here is the list of your grades: <br>';
        foreach ($grades as $grade) {
            echo '<b>' . $grade . '</b><br>';
        }
        resultout();
        
    instruction('Alternative syntax using "while(true)" + "break;"');
        p('Here <b>the loop is always true</b>, so we need to use <b>"break;"</b> inside a "if" statement to exit the loop');

        codein(); ?>
$grades = []; <l>// optional but better fo readability</l>
<l>// $grade = null; -> We no more need this line</l>
<b>while (true)</b> {
    $grade = readline( 'Please enter a grade (number between 0 and 20) or tap "end" to finish.' ); <l>// ask for input</l>
    if ( $grade <b>===</b> 'end' )  { 
        <b>break;</b>
    } <b>else</b> { <l>// Wee need to add an "else" statement</l>
        $grades[] = (int)$grade; <l>// Fill the array with new input</l>
    }
}

echo 'Here is the list of your grades: &lt;br>'; // Display inputs
foreach ($grades as $grade) {
    echo '&lt;b>' . $grade . '&lt;/b>&lt;br>';
}<?php codeout();

        p('The output is exactly the same:');
            resultin();
            $grades = [9, 12, 5, 15, 16, 12];        
            echo 'Here is the list of your grades: <br>'; // Display inputs
            foreach ($grades as $grade) {
                echo '<b>' . $grade . '</b><br>';
            }
            resultout();

// STOP EDITING
        
require '../../includes/footer.php'; 


?>