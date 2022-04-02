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

    <div class="lottie right">
        <lottie-player src="https://assets6.lottiefiles.com/private_files/lf30_WdTEui.json"  background="transparent"  speed="1" style="width: 250px; height: 250px;" loop autoplay></lottie-player>
    </div>
    <div class="index-intro">
        <h3 style='margin-bottom:0'>Hi, I'm Edouard Proust,</h3>
        a <b>pro web developer</b> and an <b>ecommerce expert</b>.<br><br>
        This lightweight website shares my journey from zero to pro developer in less than a year, learning how to code online and all by myself.<br>
        TDF is handcoded in vanilla PHP, HTML, CSS and JS.<br>
        Follow me on <?php github('GitHub') ?>.
    </div>
    <div class="hr index"></div>
    <?php if (pinned_count($lessons_list)>0) { echo '<div class="hotBadge-container">'; } ?>
    <h2>Pinned trainings</h2><span class="hotBadge"><?= pinned_count($lessons_list); ?></span>
    <?php if (pinned_count($lessons_list)>0) { echo '</div>'; } ?>

    <?php
        echo '<ul>';
        $day = count($lessons_list);
        $pinnedCount = 0;
        foreach ($lessons_list as $lesson) {
            if ($lesson['pinned']) {
                echo '<li><a href="' . $lesson['url'] . '">' . $lesson['language'] . ': ' . $lesson['title'] . '</a> <span class="index-lesson-date">(Day ' . $day . ': ' . date_formating($lesson) . ')</span></li>';
                $pinnedCount += 1; 
            }
            $day--;
        }
        echo '</ul>';
    ?>

    <h2>Last trainings</h2>

    <ul><?php
        $day = count($lessons_list);
        foreach ($lessons_list as $k => $lesson) {
            echo '<li>Day ' . $day . ': <a href="' . $lesson['url'] . '">' . $lesson['title'] . '</a> <span class="index-lesson-date">(';
            $lessonType = $lesson['type'];
            if ($lessonType !== '') {
                echo ucfirst($lessonType . ' | ');
            }
            echo $lesson['language'] . ' | ' . date_formating($lesson) . ')</span></li>';
            $day--;
            if ($day === count($lessons_list) - 10) {
                break;
            }
        } 
    ?></ul>
    <?= show_more() ?>

    <h2>Last trainings by language</h2>

    <?php
    foreach (['PHP', 'PHP OOP', 'SQL', 'Javascript', 'WP'] as $language) {
        $replace = ['PHP OOP', 'SQL', 'WP'];
        $replaceBy = ['PHP (Object oriented)', 'SQL (MySQL & phpMyAdmin)', 'PHP (Wordpress)'];
        echo "<h3>" . str_replace($replace, $replaceBy, $language) . "</h3>";
        echo '<ul>';
        $day = count($lessons_list);
        $lessonsCount = 0;
        foreach ($lessons_list as $lesson) {
            if ($lesson['language'] == $language) {
                echo '<li><a href="' . $lesson['url'] . '">' . $lesson['title'] . '</a> <span class="index-lesson-date">(Day ' . $day . ': ' . date_formating($lesson) . ')</span></li>';
                $lessonsCount++;
            } 
            if ($lessonsCount === 5) {
                break;
            }
            $day--;
        }
        echo '</ul>';
        if (!$lessonsCount) {
            echo 'No lesson for this language yet.';
        } elseif ($lessonsCount === 5) {
            echo show_more();
        }
    }

/* Stop editing */

include('includes/footer.php');