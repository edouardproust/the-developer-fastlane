<?php
require '../../includes/header.php';
get_post_head('https://www.grafikart.fr/tutoriels/datetime-object-php-1133');

// START EDITING

title('Lesson');

    p('Introduction to classes and object-oriented programming through 
    the object <a href="https://www.php.net/manual/en/class.datetime "target="_blank">DateTime</a>.
    ');


    instruction('Purpose');

        p('To work with the dates, we have 2 possibilities:
        <ol>
            <li>use the timestamps, strings, etc. As we have done so far. 
            <b>Problem:</b> this is limited and can become complex very quickly.</li>
            <li><b>Solution:</b> use the datetime object, which opens up new features.</li>
        </ol>
        ');
    
    instruction('Basics');
    
        p('
        <ul>
            <li>In object-oriented programming, the functions are called methods.</li>
            <li>The first method we look at is always the <b>__construct(</b> method, which allows to define its parameters.</li>
            <li>For DateTime, the constructor is prefabricated. We can therefore use the Dtetime class without touching the _construct.</li>
        </ul>
        ');

    instruction('Creating a new object');

        codein(); ?>
<b>$date = new DateTime();</b>
var_dump($date);<?php codeout();

        resultin();
            $date = new DateTime();
            dump($date);
        resultout();

    instruction('Useful methods');

        p('<h4>1. ::format</h4>
        Learn more: <a href="https://www.php.net/manual/en/datetime.format.php" target="_blank">PHP Doc</a>
        ',0,1);

            p('Comparison between object code and traditional code :
            ');

            codein(); ?>
<l>// Object code</l>.
    $date = new DateTime();
    echo <b>$date->format('d/m/Y');</b>

<l>// Traditional code</l>
    $time = time();
    echo date('d/m/Y', $time);<?php codeout();

            resultin();
                $date = new DateTime();
                echo $date->format('d/m/Y');
            resultout();

        p('<h4>2. ::modify</h4>
        Allows you to alter a date with a particular format 
        (learn more <a href="https://www.php.net/manual/en/datetime.modify.php" target="_blank">PHP Doc</a>).
        ');

            codein(); ?>
<l>// Object code</l>.
    $date = new DateTime();
    $date->modify('+1 month');</b>
    var_dump($date);

<l>// Traditional code</l>
    $time = time();
    $time = strtotime('+1 month', $time);
    echo date('d/m/Y', $time);<?php codeout();

            resultin();
                $date = new DateTime();
                $date->modify('+1 month');
                dump($date);
            resultout();
        
        p('<h4>3. ::diff</h4>
        <ul>
            <li>Returns another object called <b>DateInterval</b> (<a href="https://www.php.net/manual/en/class.dateinterval" target="_blank">PHP Doc</a>)</li>
            <li>This object has its own properties, like the <b>$days</b> property that will help use in the code below.</li>
            <li>Learn more about ::diff method: <a href="https://www.php.net/manual/en/datetime.diff.php" target="_blank">PHP Doc</a>.</li>
        </ul>
        ');

            codein(); ?>
$date = '2015-01-01';
$date2 = '2020-04-15';

<l>// Object code</l>
    $d = new DateTime($date);
    $d2 = new DateTime($date2);
    <b>$days = $d->diff($d2, true)->days;</b>
    echo "There are &lt;b>$days&lt;/b> days between.&lt;br>";

    <l>// Using the full potential of the ::diff method properties:</l>
        $diff = $d->diff($d2, true);
        echo "There are &lt;b>$diff->y&lt;/b> years, &lt;b>$diff->m&lt;/b> months and &lt;b>$diff->d&lt;/b> days between";

    <l>// We do a quick var_dump to look at the DateInterval array (containing all properties):</l>
        var_dump($diff);

<l>// Traditional code</l>
    $time = strtotime($date);
    $time2 = strtotime($date2);
    <b>$days = floor(abs(($time - $time2) / (24 * 60 * 60)));</b>
    <l>/* The 2nd part is too complicated to do with non-object oriented code! */</l>
    echo "There are $days days between.";<?php codeout();

            resultin('scroll');
                $date = '2015-01-01';
                $date2 = '2020-04-15';
                $d = new DateTime($date);
                $d2 = new DateTime($date2);
                $days = $d->diff($d2, true)->days;
                echo "There are <b>$days</b> days between.<br>";
                $diff = $d->diff($d2, true);
                echo "There are <b>$diff->y</b> years, <b>$diff->m</b> months and <b>$diff->d</b> days between.";
                dump($diff);
            resultout();

    p('With this example, we start to see that the object + methods solution 
    has a <b>more natural syntax</b> (reading from left to right) and is <b>more compact</b> and <b>modular</b>:
    ');

    p('<h4>4. ::add</h4>
    Used to add a time interval to a date or time. Check the code example in the next paragraph. 
    Learn more: <a href="https://www.php.net/manual/en/datetime.add.php" target="_blank">PHP Doc</a>
    ');

    instruction ('Add a custom interval (__construct)');

        p('We can define a <b>custom date interval</b> for the DateInterval object thanks to the <b>__construct method</b>. 
        The <a href="https://www.php.net/manual/en/dateinterval.construct.php" target="_blank">PHP Doc</a> lists the <b>Duration Period designators</b> to be used.');

            codein(); ?>
$date = new DateTime('2020-01-01');
echo 'Before: &lt;b>' . $date->format('Y/m/d') .'&lt;/b>&lt;b>';

<l>// 1. We create a custom interval</l>
    $interval = new DateInterval(<b>'P1M1DT1M'</b>);<l>
        // P = "period"; M = months; D = days; T = "time"; M = minutes</l>

<l>// 2. We add the interval to date with the ::add method</l>
    $date = <b>$date->add($interval);</b>
    echo 'After: &lt;b>' . $date->format('Y/m/d') .'&lt;/b>';

<l>// 3. Let's check the Datetime object after modification:</l>
    dump($interval);<?php codeout();
 
            resultin('scroll'); 
                $date = new DateTime('2020-01-01');
                echo 'Before: <b>' . $date->format('Y/m/d') .'</b><br>';
                $interval = new DateInterval('P1M1DT1M');
                $date = $date->add($interval);
                echo 'After: <b>' . $date->format('Y/m/d') . '</b>';
                dump($interval);
            resultout();

// STOP EDITING
        
require '../../includes/footer.php'; 

/**
 *  code for "<": &lt;
 */

?>