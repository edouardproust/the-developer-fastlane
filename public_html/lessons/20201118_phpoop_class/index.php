<?php
require '../../includes/header.php';
get_post_head('https://www.grafikart.fr/tutoriels/class-php-oop-1134');

// START EDITING

title('Lesson'); // '1' or '2' for preset titles

    instruction('1. Purpose');

    p('<ul>
    <li><b>Object oriented programming</b> in PHP (short version: <b>"OOP"</b> or "PHP OOP") allows to deal with more complex entities.</li>
    <li>In a <a href="/projects/php-playground/contact.php" target="_blank">previous exercise</a> we used <b>Procedural Programming</b> ("<b>PP</b>) for defining a store opening hours. But we can do this in a more easy way using OOP.</li>
    <li>OOP allows to have a more organized code and app as we divide functions (called "methods" in OOP) in several files: one for each concept (called "class" in OOP).</li>
    </ul>');
        
    instruction('2. Defining a new class');

        p('<ul>
            <li>We create a new folder called "class"</li>
            <li>In this folder we create one file per class</li>
            <li>Each word in the class name should start with a capital letter, without underscore delimiters.</li>
        </ul>');

        p('<b>Timeslot.php</b>');

        codein(); ?>&lt;?php 
class Timeslot { <l>// Timeslot is called a <b>class</b></l>
    public $start; 
    public $end;<l>
        // Each new <b>property</b> is written as a variable (with $ sign)
        // We use the <b>public</b> keyword before it
        // To use default variables we write: public $end <b>= 12</b>; (same syntax as for regular functions)</l>
}<?php codeout();

    instruction('3. Using a class');

        p('<b>test.php</b>');

        codein(); ?>&lt;?php
require 'class' . DIRECTORY_SEPARATOR . 'Timeslot.php'; <l>// Calling the class definition file</l>

$timeslot1 = <b>new</b> Timeslot; <l>// $timeslot1 is called an <b>instantiation</b> of the class Timeslot</l>
    $timeslot1<b>->start</b> = 9; <l>// We use the properties defined inside the Class.php file, but <b>without the $ sign before</b></l>
    $timeslot1<b>->end</b> = 12;
$timeslot2 = new Timeslot; <l>// Every new instance will work independantly from the others</l>

var_dump($timeslot1, $timeslot2); <l>// Let's check that the properties applied to 1st instance is not applied to the 2nd one</l>
<?php codeout();

        resultin('scroll');
            require 'files' . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Timeslot.php'; 
            $timeslot1 = new Timeslot;
            $timeslot1->start = 9;
            $timeslot1->end = 12;
            $timeslot2 = new Timeslot;
            dump($timeslot1);
            dump($timeslot2);
        resultout();

    instruction('4. The __construct() method');

        p('<ul>
            <li><b>OOP\'s "methods" are the equivalent of PP\'s "functions"</b></li>
            <li>To be able to define properties while doing an instantiation, we use a particular method called <b>constructor</b>.</li>
            <li>The constructor is written <b>__construct()</b>
            <li>Again, we use the <b>public</b> keyword before it (we\'ll learn in a further lesson what this keyword means).</li>
        </ul>'
    ,0,0);

        p('<b>Timeslot.php</b>');

        codein(); ?>&lt;?php
class Timeslot {

    public $start; <l>// Properties list</l>
    public $end;

    <b>public function __construct(</b>int <b>$var1,</b> int <b>$var2) { <l>// Constructor method</l>
        $this->start = $var1; 
        $this->end = $var2;</b><l>
            // $this refers to the current instance: it adapts depending on which instance the method is used on</l>
    <b>}</b>
}<?php codeout();

        p('<b>test.php</b>');

        codein(); ?>&lt;?php
require 'class' . DIRECTORY_SEPARATOR . 'Timeslot.php'; 

$timeslot1 = new Timeslot<b>(8, 12)</b>;
$timeslot2 = new Timeslot<b>(14, 18)</b>; <l>
    //We are now able to define properties' values directly while creating a new instance (as if it was a regular function)

var_dump($timeslot1, $timeslot2);<?php codeout();

        resultin('scroll');$timeslot1 = new Timeslot(8, 12); 
            $timeslot2 = new Timeslot(14, 18); 
            dump($timeslot1);
            dump($timeslot2);
        resultout();

    instruction('5. Other methods');

    p('<h4><u>Example #1</u>: is an hour included in the timeslot?</h4>');

        p('<ul>
            <li>We want to <b>create a method</b> called <code>includes_hour()</code> that will check if an hour is included in the timeslots we just defined.</li>
            <li>Note: this is just an example to show how to create and use a new method in OOP with PHP.</li>
        </ul>'
        ,0,0);

        p('<b>Timeslot.php</b>');

        codein(); ?>&lt;?php
class Timeslot {

    public $start; 
    public $end;

    public function __construct($var1=null, $var2=null)
    {
        $this->start = $var1;
        $this->end = $var2;
    }
    <b>public function includes_hour(</b>int <b>$hour)</b>: bool <b>
    {
        return $hour > $this->start && $hour < $this->end;
    }</b>
}
<?php codeout();

        p('<b>test.php</b>');

        codein(); ?>&lt;?php
require 'class' . DIRECTORY_SEPARATOR . 'Timeslot.php'; 

$timeslot1 = new Timeslot(8, 12); 
$timeslot2 = new Timeslot(14, 18);

var_dump(
    <b>$timeslot1->includes_hour(10)</b>, <l>// Is 10 included in $timeslot1 ?</l>
    <b>$timeslot2->includes_hour(10)</b> <l>// Same question for $timeslot2</l>
); <?php codeout();

        resultin();
            dump($timeslot1->includes_hour(10));
            dump($timeslot2->includes_hour(10));
        resultout();

        p('<h4><u>Example #2</u>: Does a timeslot intersect with another?</h4>');

        p('<ul>
            <li>The difficulty here compared to example #1, is that the <b>variable is an object</b> (another timeslot, like $timeslot1 for example)</li>
            <li>In OOP, we can <b>precise the type of a variable to be a predefined object</b> (look at the code below for more details)</li>
        </ul>',
        0,0);

        p('<b>Timeslot.php</b>');

        codein() ?>
&lt;?php
class Timeslot {
    public $start; 
    public $end;
    public function __construct($var1=null, $var2=null)
    {
        $this->start = $var1;
        $this->end = $var2;
    }
    public function includes_hour($hour): bool 
    {
        return $hour > $this->start && $hour < $this->end;
    }
    <b>public function intersect(</b>Timeslot <b>$timeslot)</b>: bool<l>
        // In OOP we can define the variable type to be of a specific class (here: "Timeslot")</l><b>
    {
        return
            $this->includes_hour($timeslot->start) ||
            $this->includes_hour($timeslot->end) ||
            $this->start > $timeslot->start && $this->end < $timeslot->end
        ;
    }</b>
}<?php codeout();

        p('<b>test.php</b>');

        codein() ?>
&lt;?php
require 'class' . DIRECTORY_SEPARATOR . 'Timeslot.php'; 

$timeslot1 = new Timeslot(<b>8</b>, <b>12</b>); 
$timeslot2 = new Timeslot(<b>14</b>, <b>18</b>);
var_dump(<b>$timeslot1->intersect($timeslot2)</b>); <l>// Test 1</l>

$timeslot3 = new Timeslot(<b>8</b>, <b>12</b>); 
$timeslot4 = new Timeslot(<b>10</b>, <b>18</b>);
var_dump(<b>$timeslot3->intersect($timeslot4)</b>); <l>// Test 2</l>

$timeslot5 = new Timeslot(<b>10</b>, <b>12</b>); 
$timeslot6 = new Timeslot(<b>8</b>, <b>14</b>);
var_dump(<b>$timeslot5->intersect($timeslot6)</b>); <l>// Test 3</l><?php codeout();

        resultin();
            $timeslot1 = new Timeslot(8, 12); 
            $timeslot2 = new Timeslot(14, 18);
            dump($timeslot1->intersect($timeslot2));

            $timeslot3 = new Timeslot(8, 12); 
            $timeslot4 = new Timeslot(10, 18);
            dump($timeslot3->intersect($timeslot4));

            $timeslot5 = new Timeslot(10, 12); 
            $timeslot6 = new Timeslot(8, 14);
            dump($timeslot5->intersect($timeslot6));
        resultout();

        p('<h4><u>Example #3</u>: Display timeslots as sentences</h4>');

        p('<ul>
            <li>We want want to use a function to return a string like "From 8 to 12" for any timeslot.</li>
        </ul>'
        ,0,0);

        p('<b>Timeslot.php</b>');

        codein(); ?>
&lt;?php
class Timeslot {
    public $start; 
    public $end;
    public function __construct($var1=null, $var2=null)
    {
        $this->start = $var1;
        $this->end = $var2;
    }
    <b>public function html()</b>: string<b>
    {
        return "&lt;li>from {$this->start} to {$this->end}&lt;/li>";
    }</b>
}<?php codeout();

        p('<b>test.php</b>');

        codein(); ?>
&lt;?php
require 'class' . DIRECTORY_SEPARATOR . 'Timeslot.php'; 

$timeslot1 = new Timeslot(8, 12); 
$timeslot2 = new Timeslot(14, 18);
echo 
    'Opening hours:' .
    '&lt;ul>' . 
        <b>$timeslot1->html()</b> .
        <b>$timeslot2->html()</b> . 
    '&lt;/ul>'
;<?php codeout();

        resultin();
            $timeslot1 = new Timeslot(8, 12); 
            $timeslot2 = new Timeslot(14, 18);
            echo 
                'Opening hours:' .
                '<ul>' . 
                    $timeslot1->html() .
                    $timeslot2->html() . 
                '</ul>'
            ;
        resultout();

// STOP EDITING
        
require '../../includes/footer.php'; 

/**
 *  code for "<": &lt;
 */

?>