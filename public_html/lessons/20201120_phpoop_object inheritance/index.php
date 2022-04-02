<?php
require '../../includes/header.php';
get_post_head('https://www.grafikart.fr/tutoriels/extends-php-1136');

// START EDITING

title('Lesson'); // '1' or '2' for preset titles

    resultin(); ?>
    <a href="files/index.php" target="_blank">Link to exercise website</a>
    <?php resultout();

    instruction('1. Parent & child classes');

        p('<h4>extends</h4>');

            p('The <code>extend</code> keyword allows a child class to inherit from another class\' methods and properties (the parent class).<br>
            Here is the syntax to use it:');

            codein(); ?>
        class ChildClass <b>extends</b> PerentClass {<l>
            // Do some stuff in here...
            // We can use the <b>parent::abc();</b> attribute to get the result of the parent abc() method and change it.</l>
        }<?php codeout();

            p('This technique <b>saves a lot of code</b>: no need to copy-paste or repeat it in the child class.<br>
            Below is the detaile code for:
                <ul>
                    <li><b>Parent class:</b> gathers a couple of methods that track page views on a website (increments a counter in a external text file each time a page is visited and then display the counter inside the footer.</li>
                    <li><b>Child class:</b> a broken counter that display the double numbers of visites (this is a dumb example just to make easier to understand the parent/child logic).</li>
                </ul>'
            );
        
        p('<b>DoubleCounter.php</b> (child)');

            codein(); ?>&lt;?php
<b>require_once</b> __DIR__ . DIRECTORY_SEPARATOR . <b>'Counter.php'</b>; <l>// 1. Call the parent class file</l>

class CounterDouble <b>extends Counter</b> { <l>// 2. tell this is an extension of the parent class</l>

    public function get_views(): int
    {
        return <b>2 * parent::get_views()</b>; <l>// 3. Just change the output as needed</l>
    }

}<?php codeout();

        p('<b>Counter.php</b> (parent)');

            codein(); ?>&lt;?php

class <b>Counter</b> {

    public $file;

    public function __construct(string $var1)
    {
        $this->file = $var1;
    }
    public function increment(): void
    {
        if (file_exists($this->file)) {
            $views = (int)file_get_contents($this->file);
            $views++;
        } else {
            $views = 1;
        }
        file_put_contents($this->file, $views);
    }
    public function <b>get_views()</b>: int
    {
        if (!file_exists($this->file)) {
            return 0;
        }
        return (int)file_get_contents($this->file);
    }

}<?php codeout();

        p('<b>footer.php</b>');

            codein(); ?>
<l>&lt;div class="col-md-4">
    &lt;h5>Counter Double&lt;/h5>
    &lt;ul class="list-unstyled">
        &lt;li></l>
            &lt;?php 
                require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . '<b>CounterDouble.php</b>'; 
                $counter = new <b>CounterDouble</b>(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'page-views');
                $counter->increment();
                $pageViews = $counter->get_views();
                echo "&lt;b>$pageViews&lt;/b> page view";
                if ($pageViews > 1) { echo "s"; }
            ?><l>
        &lt;/li>
    &lt;/ul>
&lt;/div></l><?php codeout();

        p('... Instead of doing this (reapeating the code and just change the class name and file):');

            codein(); ?>

<b>// CounterDouble.php</b>

    &lt;?php

    class <b>CounterDouble</b> {

        public $file;

        public function __construct(string $var1)
        {
            $this->file = $var1;
        }
        public function increment(): void
        {
            if (file_exists($this->file)) {
                $views = (int)file_get_contents($this->file);
                $views++;
            } else {
                $views = 1;
            }
            file_put_contents($this->file, $views);
        }
        public function get_views(): int
        {
            if (!file_exists($this->file)) {
                return 0;
            }
            return <b>2 *</b> (int)file_get_contents($this->file); <l>
                // This is the only modification of the code...</l>
        }

    }<?php codeout();

    instruction('2. Methods / variables visibility');

        p('
        The are 3 types of visibility parameters we can apply to both methods and properties in a class:
            <ul>
                <li><b>public</b>: It can be accessed from the inside as well as from the outside.</li>
                <li><b>private</b>: It can only be accessed from the inside in the same class.</li>
                <li><b>protected</b>: It can only be accessed from the inside in the same class or in the children\'s classes.</li>
            </ul>'
        );

        p('<h4>Why don\'t we always use "public"?</h4>
        <ul>
            <li>This is primarily for a question of code organization: using the "private" or "protected" parameters allows us <b>to know where the property or method can be used or not</b>.</li>
            <li>As an example, working with a class built by someone else (in a wordpress plugin or in a framework like Symfony for example), if we see a "protected" property inside a class, then we know directly that we won\'t need to use this property while working with this class.</li>
            <li>Only the <b>__construct</b> method is <b>alway public</b>.</li>
        </ul>');

        p('<h4>Final remarks</h4>
        <ul>
            <li>These rules will work as well for <b>instance methods</b> as for <b>static methods</b>. We can write as well:
                <ul>
                    <li><code><b>private static</b> function abc()</code></li>
                    <li><code><b>protected static</b> function abc()</code></li>
                </ul>
            </li>
        </ul>');
        
instruction('3. Constants');

    p('<ul>
        <li>Constants are like properties, to the difference that <b>they never change</b>.</li>
        <li>They are written in <b>full uppercase letters</b> as for functions\' constants. Example: <code><b>CONSTANT</b></code>.</li>
        <li>It\'s considered <b>as a static property</b>, so we need to use <code>self::</code> to use it inside a class method. example: <code><b>self::CONSTANT</b></code></li> 
        <li>We use the <code><b>static::</b></code> attribute in the parent class to allow the constant to be shared in childrens ones (have a look to the code below!)
        </ul>'
    ,0,0);

    p('<b>Counter10x.php</b> (parent)');

    codein(); ?>&lt;?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Counter.php';

class Counter10x extends Counter {

    <b>const INCREMENT = 10;</b>

}<?php codeout();

    p('<b>Counter.php</b> (child)');

    codein(); ?>&lt;?php

class Counter {

    <b>const INCREMENT = 1;</b>
    public $file;

    public function __construct(string $var1)
    {
        $this->file = $var1;
    }
    public function increment(): void
    {
        if (file_exists($this->file)) {
            $views = (int)file_get_contents($this->file);
            <b>$views += static::INCREMENT;</b> <l>
                // Note: we use the static:: attribute here instead of self:: as for regular properties
                // (using self:: the property would refer to the parent and not child constante)!</l>
        } else {
            $views = 1;
        }
        file_put_contents($this->file, $views);
    }
    public function get_views(): int
    {
        if (!file_exists($this->file)) {
            return 0;
        }
        return (int)file_get_contents($this->file);
    }

}<?php codeout();

// STOP EDITING
        
require '../../includes/footer.php'; 

/**
 *  code for "<": &lt;
 */

?>