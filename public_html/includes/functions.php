<?php 

// readline() simulation on Windows
// From: https://stackoverflow.com/questions/49349634/php-echo-dont-work-in-infinity-loop-after-readline

    /* function readline($line) {
        echo $line;
        $input = stream_get_line(STDIN, 1024, PHP_EOL);
        return $input;
    } */

/* Links */

    // Grafikart TD 
        function grafikart_td(): string
        {
            $folder = $_SERVER['HTTP_HOST'] . '/projects/php-playground/';
            return $folder;
        }
    // Others 
        function show_more(): string
        {
            return <<<HTML
                <div class='show-more-link'>
                    <a href='/lessons-list.php'>Show all</a>
                </div>
HTML;
        }
    // Anchor 
        function anchor(string $id): void
        {
            echo "<span id='$id'><span>";
        }

/* LAYOUT ELEMENTS */

    function get_post_head($video_url = 'https://www.grafikart.fr/formations/php') {
        if ($video_url === 'Change this URL') {
            $video_url = 'https://www.grafikart.fr/formations/php';
        } else {
            $lesson['video'] = $video_url;
        }
        $filename = get_last_part_of_url();
        $lesson = lessonname_from_filename( $filename );
        ?>
            <div class='page-content-header'>
            <div class='page-content-header-col1'>
                <h1><?= $lesson['language'] . ': ' . $lesson['title'] ?></h1>
                <div class='page-content-header-date'>
                    <?= date_formating($lesson); ?>
                </div>
            </div>
            <div class='page-content-header-col2'>
                <?php btn( 'Watch the video', $video_url, 'Go to the video of this class', '_blank', 'secondary'); ?>
            </div>
            </div><?php 
    }

// Text layouts

    function dump($content) {
        echo '<pre>';
        var_dump($content);
        echo '</pre>';
    }
    function instruction($content) {
        echo '<h3>' . $content . '</h3>';
    }
    function p($content, $line_breaks_before = 0, $line_breaks_after = null) {
        $before = str_repeat('<br>', $line_breaks_before);
        $after = str_repeat('<br>', $line_breaks_after);
        $echo =  $before . $content . $after;
        if (isset($line_breaks_after)) { $echo .= '<br>'; } // To avoid title like <h4> to add a line break (-> keep the var blank if the p is a title)
        echo $echo;
    }
    function a(string $link, string $title, bool $external = false): string 
    {
        $target = '';
        if ($external) {
            $target .= '_blank';
        }
        $line = "<a href='$link' target='$target'>$title</a>";
        return $line;
    }
    function codein($scroll = 'scroll') {
        echo "<div class='code-container'><div class='code-label'>Code</div><div class='code-content $scroll'><code><pre>";
    }
    function codeout() {
        echo '</pre></code></div></div>';
    }
    function resultin($scroll = null) {
        echo "<div class='result-container'><div class='result-label'>Result</div><div class='result-content $scroll'>";
    }
    function resultout() {
        echo '</div></div>';
    }
    function title($exo_title) {
        if ($exo_title == 1) { echo "<h2>Course (learn the basics)</h2>"; }
        elseif ($exo_title == 2) { echo "<h2>Exercise</h2>"; }
        else {  echo '<h2>' . $exo_title . '</h2>'; }
    }

    // Accordion
    // https://codepen.io/abergin/pen/ihlDf

        function accordionin() {
            echo "
                <div class='accordion'>
                    <ol>"; }
        function accordionli($title, $content = 'No content here yet.') { echo "
                        <li>
                            <input type='checkbox' checked>
                            <i></i>
                            <h4>$title</h4>
                            <div>$content</div>
                        </li>"; }
        function accordionout() { echo "
                    </ol>
                </div>";
        }

// Other visual elements

    function btn($text, $url, $title = null, $target = '_self', $additionalClass = null) {
        echo "
        <div class='btn-container'>
            <a href='$url' target='$target' title='$title'>
                <div class='btn $additionalClass'>$text</div>
            </a>
        </div>";
    }

    // Misc. small functions

    function github($link_txt) {
        echo '<a href="https://github.com/edouardproust" target="_blank" title="Meet me on GitHub!">' . $link_txt . '</a>';
    }
    function return_to_top($r2top_txt) { 
        echo '<a href="#top" title="Return to top">' . $r2top_txt . '</a>';
    }

// Get lesson name from file inside folder 
// + display it on post pages / index 
// + date formating

    // URLs & Paths

    function get_last_part_of_url(): string
    {
        $url = str_replace('/index.php', '', $_SERVER['PHP_SELF']);
        $url_array = explode("/", $url);
        $slug = end( $url_array );
        return $slug;
    }
    function get_files_array_from_dir($dir): array 
    {
        $dir_array = scandir( $dir );
        // Remove directory & files to hide
            $clean_array = array_diff( $dir_array, 
                [
                    '..', '.', '.DS_Store', 
                    'unlisted', 'img', 
                    'assets', 'lessons', 'files', 'folders', 'includes'                ] 
            );
        return $clean_array;
    }

// "From files names to lessons names" translator

    function lessonname_from_filename($file) {

        // Check if pinned
            $lesson['pinned'] = false;
            if (strpos ($file, 'pinned') !== false) {
                $lesson['pinned'] = true;
            }
        // Split filename in parts
            $toRemove = [
                '_pinned',
                '_(course)', '_(exercise)', '_(project)', ' (course)', ' (exercise)', ' (project)', '_course', '_exercise', 'project', 
                ' - Copie', ' - copie', ' - copy', ' - Copy',
            ];
            $CleanedString = str_replace($toRemove, '', $file);
            $pieces = explode('_', $CleanedString );
        
        // Fill the array

            $lesson['title'] = ucfirst($pieces[2]);
            $lesson['date']['string'] = $pieces[0];
            $lesson['date']['object'] = date_create($lesson['date']['string']);
            $lesson['url'] = 'http://' . $_SERVER['HTTP_HOST'] . DIRECTORY_SEPARATOR . 'lessons' . DIRECTORY_SEPARATOR . $file;
            // Language
                if ($pieces[1] =='js') {
                    $lesson['language'] = 'Javascript';
                } elseif ($pieces[1] =='phpoop') {
                    $lesson['language'] = 'PHP OOP';
                } else {
                    $lesson['language'] = strtoupper( $pieces[1] );
                }
            // Exercise or course (or both)
                if (strpos($file, 'exercise')) {
                    $lesson['type'] = 'exercise';
                } elseif (strpos($file, 'course')) {
                    $lesson['type'] = 'course';
                } elseif (strpos($file, 'project')) {
                    $lesson['type'] = 'project';
                } else {
                    $lesson['type'] = '';
                }
                
        return $lesson;
    }

function date_formating($array): string
{
    $formated = $array['date']['object'];
    /* Add the "th", "rd" or "st" at the end of day number:
        $string = $array['date']['string'];
        $day = (int)substr($string, 7, 1);
        switch ($day) {
            case 1: $a='s'; $b='t'; break; 
            case 2: $a='n'; $b='d'; break;
            case 3: $a='r'; $b='d'; break;
            default: $a='t'; $b='h'; break;
        }
    */
    if (strpos($_SERVER["SCRIPT_NAME"], "/lessons/") !== false) {
        $formated = date_format($formated, "F j, Y"); 
        /*  j = days without leading zero
            d = with leading zeros 
            F = A full textual representation of a month, such as January or March */
    } else {
        $formated = date_format($formated, "M j, Y"); 
        /*  M = A short textual representation of a month, three letters */
    }
    return $formated;
}

function pinned_count($array) {
    $pinnedCount = 0;
    foreach ($array as $item) {
        if ($item['pinned']) {
            $pinnedCount += 1; 
        }
    }
    return $pinnedCount;
}

// Galleries & Images

    function exo_gallery(int $col = 100, array $array = [0] ): int 
    {    
        $folder_name = '../' . get_last_part_of_url() . '/img'; // CHANGE FOLDER PATH HERE ONLY
        (int)$images_count = count( get_files_array_from_dir($folder_name) );
        $condition = false;
        $alt_array = lessonname_from_filename( get_last_part_of_url() );
        
        echo "
            <div class='gallery'>
                <div class='gallery-sub col$col'>
        ";
        for ($i=1; $i<=$images_count; $i++) {
            if (in_array($i, $array)) {
                $image_url = $folder_name . DIRECTORY_SEPARATOR . $i . '.jpg'; // DON'T change folder path here
                $alt = $alt_array['language'] . ' ' . $alt_array['type'] .': image ' . $i . ' for lesson "' . $alt_array['title'] . '"';
                echo "<div class='gallery-img col$col'>
                    <img src='$image_url' alt='$alt' title='$alt' />
                </div>";
                $condition = true;
            }
        }
        if (!$condition) {
            echo 'This gallery is empty.';
        }
        echo "
                </div>
            </div>
        ";
        return $images_count;
    }
    function asset(string $fileName, string $folder = ''): string
    {
        $link_before_trim = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'lessons' . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . get_last_part_of_url() . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $fileName;
        $replace = ['.php', '_pinned'];
        $link = str_replace($replace, '', $link_before_trim);
        return $link;
    }
    function exo_gallery_link(int $col, array $gallery, string$pageUrl = '', bool $display_text_y_n = true, $linebreaks_top = 1, $linebreaks_bottom = 0)
    {
        // Galery 
            echo "<a href='/projects/php-playground/pages/$pageUrl' target='_blank'>";
            $images_count = exo_gallery($col, $gallery);
            echo "</a>";
        // Text 
            if ($display_text_y_n === true) {
                if($images_count === 1) {
                    $line = 'Click on the image above to access the exercise\'s website';
                } else {
                    $line = 'Click on one of the images above to access the exercise\'s website';
                }
                p("<div style='text-align: center'>$line</div>"
                , $linebreaks_top, $linebreaks_bottom
                );
            }
    }

// Under construction page

    function under_construction($link = '/', $link_text = 'Return to index') {
        echo "
            Nothing here!<br>
            This content will be available soon.<br>
            Please come back later.<br>
            <a href='$link'>$link_text</a>
        ";
    }