<?php
require '../../includes/header.php';
get_post_head('https://www.grafikart.fr/tutoriels/conditions-php-1117');

// START EDITING

title(1);

    instruction( 'Fill an array with basic int content & old syntax: "array()".<br>Then display it with "print_r()"' );
        $notes = array(10, 20, 16); // ancienne notation
        codein(); echo p( print_r( $notes ) ) ; codeout();

    instruction( 'Display one cell:' );
        codein();  echo 'echo $notes[1];'; codeout();
        resultin();
            echo $notes[1];
        resultout();

    instruction( 'Add string content to existing array using new syntax: "[]".<br>Then display it with "var_dump()"' );
        $notes = [10, 20, 4, 'This is some text!']; // nouvelle notation équivalente
        codein(); echo p( var_dump( $notes ) ); codeout(); 

    instruction( "Create a new array based on the 'value' => 'key' structure & use var_dump() on it." );
        $eleve = [
            'nom' => 'Doe',
            'prenom' => 'John',
            'age' => '15',
        ];
        codein(); var_dump ($eleve); codeout(); 

    instruction( 'Single level array: Display sentence' );
        codein(); ?>
function sentence($eleve) {
    return p( $eleve['prenom'] . ' ' . $eleve['nom'] . ' a ' . $eleve['age'] . ' ans.' );
}
echo sentence($eleve);
        "; <?php codeout();

    instruction( 'Override array\'s variables: for a string & an int' );
        $eleve['prenom'] = 'Edouard';
        $eleve['age'] = '31';

        codein(); ?>
$eleve['prenom'] = 'Edouard';
$eleve['age'] = '31';
        <?php codeout();
        resultin();
            echo '<code><pre>';
            print_r($eleve);
            echo '</code></pre>';
        resultout();

    instruction( 'Add a new row to table + Display the result using "print_r()" & "var_dump()" (to check the differences between the two methods)' );
        codein(); ?>
$eleve['notes'] = [15, 16, 11]; // 1st level
$eleve['notes'][3] = '12'; // 2nd level<?php codeout();
$eleve['notes'] = [15, 16, 11]; // 1st level
$eleve['notes'][3] = '12'; // 2nd level
        p( '<b>With "print_r":</b>' );
            resultin(); 
                echo '<code><pre>';
                    print_r( $eleve['notes'] );
                echo '</code></pre>';
            resultout();
        p( '<b>With "var_dump":</b>' );
            resultin(); 
                echo '<code><pre>'; 
                    var_dump( $eleve['notes'] ); 
                echo '</code></pre>';
            resultout();

title(2);

    instruction( 'Instructions: create a table containing the lists of marks of 4 students.' );
        
        // 1. Create the array

            $eleves = [
                [
                    'firstname' => 'Edouard',
                    'surname' => 'Proust',
                    'grades' => [12, 15, 18, 11, 15, 10, 17]
                ],
                [
                    'firstname' => 'Bill',
                    'surname' => 'Clinton',
                    'grades' => [12, 16, 18, 14, 14, 12, 19]
                ],
                [
                    'firstname' => 'Sylvester',
                    'surname' => 'Stallone',
                    'grades' => [8, 16, 12, 6, 9, 14, 13]
                ],
                [
                    'firstname' => 'Uma',
                    'surname' => 'Turman',
                    'grades' => [20, 13, 17, 18, 15, 16, 12]
                ],
                [
                    'firstname' => 'The Rock',
                    'surname' => '',
                    'grades' => [11,14,16,11,10,12]
                ],
            ];
            codein();  print_r($eleves); codeout(); 

    instruction( 'Display a sentence listing these grades by pupil. Regardless of the number of grades entered in the table, the last one must be preceded by the linking word "and".<br>
    (this code aims to keep the syntax unchanged regarless to the number of grade per student)');
      
            p('Adding new grades to some students');
                codein(); ?>
$eleves[1]["grades"][] = 2; // Student 2
$eleves[1]["grades"][] = 18.5;
$eleves[1]["grades"][] = 20;
$eleves[1]["grades"][] = 13.5;
$eleves[2]["grades"][] = 14.5; // Student 3, etc.');<?php codeout(); 

                resultin();
                        $eleves[1]["grades"][] = 2; // Student 2
                        $eleves[1]["grades"][] = 18.5;
                        $eleves[1]["grades"][] = 20;
                        $eleves[1]["grades"][] = 13.5;
                        $eleves[2]["grades"][] = 14.5; // Student 3, etc.
        
                    echo '<div class="box"><div class="box-sub"><ul>';
                    foreach ($eleves as $eleve) {
                        echo "<li>" . $eleve['firstname'] . " " . $eleve['surname'] . " was graded ";
                        $grades_nb = count( $eleve['grades'] ) - 2;
                        for ($i=0; $i<$grades_nb; $i++) {
                            echo "<b>" . (int)$eleve['grades'][$i] . "</b>, ";
                        }
                        echo "<b>" . $eleve['grades'][$grades_nb] . "</b> and ";
                        echo "<b>" . $eleve['grades'][$grades_nb + 1] . "</b>.</li>";
                    }
                    echo '</ul></div></div>';
                resultout();

    instruction( 'Calculate the average grade for each student (with max 2 digits after the decimal point).<br>
    At the same time, create an array filled with a. the average score of the student and b. with her/his firstnames.');

        // Calculate the average score for each student and fill the new array
        resultin();
            echo '<div class="box"><div class="box-sub"><ul>';
            foreach ($eleves as $eleve) {
                $i2==0;
                $score = round( array_sum( $eleve['grades'] ) / count( $eleve['grades'] ), 2);
                echo "<li>" . $eleve['firstname'] . " has an average score of <b>" . $score . "</b>.</li>";
                $scores[$i2]['score'] = $score; // fill the new array
                $scores[$i2]['firstname'] = $eleve['firstname'];
                $i2++;
            }
            echo '</ul></div></div>';
        resultout();
        
    instruction( 'Here is the array created with student\'s firstname and average score');
        codein(); print_r($scores); codeout();

    instruction( 'Display the ranking of the 3 best students & greatings for the winner.');

        function compare_firstname($a, $b) {
        return $a['score'] < $b['score']?1:-1;
        }
        usort($scores, 'compare_firstname'); 

        $rank_nb = 1;
        
        resultin();
            for ($i3=0; $i3<3; $i3++) {
                
                $rank_content = "Rank $rank_nb: " . $scores[$i3]['firstname'] . " with an score of " . $scores[$i3]['score'] . "<br>";
                if ($i3==0) {
                    echo "🥇 <b>$rank_content</b>";
                } elseif ($i3==1) {
                    echo "🥈 $rank_content";
                } else {
                    echo "🥉 $rank_content";
                }
                $rank_nb++;
            }
            echo '
            <div style="color:red">
                <br><b>Well done ' . $scores[0]['firstname'] . ', You won ! 🥳' . '</b>
            </div>
            ';
        resultout();


// STOP EDITING
        
require '../../includes/footer.php'; ?>