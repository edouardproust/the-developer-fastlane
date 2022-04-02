<?php 
include('includes/header.php');

$files_list = get_files_array_from_dir('lessons');
$day=1;
foreach ($files_list as $file) {
    $lessons_list[] = lessonname_from_filename($file);
    $day++;
}
$columns = array_column($lessons_list, 'date');
array_multisort($columns, SORT_DESC, $lessons_list);

/* Start to edit from here */ ?>

        <h1>Lessons list</h1>

    <h2>All trainings by date</h2>

    <?php
        echo '<ul>';
        $day = count($lessons_list);
        foreach ($lessons_list as $lesson) {
            echo '<li>Day ' . $day . ': <a href="' . $lesson['url'] . '">' . $lesson['title'] . '</a> <span class="index-lesson-date">(';
            $lessonType = $lesson['type'];
            if ($lessonType !== '') {
                echo ucfirst($lessonType . ' | ');
            }
            echo $lesson['language'] . ' | ' . date_formating($lesson) . ')</span></li>';
            $day--;
        }
        echo '</ul>';
    ?>

    <h2>All trainings by language</h2>

    <?php
    foreach (['PHP OOP', 'PHP', 'Javascript'] as $language) {
        echo "<h3>" . str_replace('PHP OOP', 'Object oriented PHP', $language) . "</h3>";
        echo '<ul>';
        $day = count($lessons_list);
        $lessonsCount = 0;
        foreach ($lessons_list as $lesson) {
            if ($lesson['language'] == $language) {
                echo '<li><a href="' . $lesson['url'] . '">' . $lesson['title'] . '</a> <span class="index-lesson-date">(Day ' . $day . ': ' . date_formating($lesson) . ')</span></li>';
                $lessonsCount++;
                echo ${$language . '_count'};
            }
            $day--;
        }
        echo '</ul>';
        if (!$lessonsCount) {
        echo 'No lesson for this language yet.';
        }
    }

/* Stop editing */

include('includes/footer.php');