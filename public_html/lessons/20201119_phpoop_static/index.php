<?php
require '../../includes/header.php';
get_post_head('https://www.grafikart.fr/tutoriels/method-statique-php-1135');

// START EDITING

title('Lesson'); // '1' or '2' for preset titles

    instruction('Use cases & syntax');

        p('<ul>
            <li>Static is used <b>when we don\'t need to create any instantiation for a given class</b>. So we can skip the instantiation while calling the class (no need to write "$instance = new Class" before using it).</li>
            <li>Then we simply add the word <b>static</b> between <b>public</b> and <b>function</b> (in case of a method) or the variable name (in case of a property): like the following:
                <ul>
                    <li>Method: <code>public static function checkbox() { ... }</code></li>
                    <li>Property: <code>public static $property = "value";</code></li>
                </ul>
                </li>
        </ul>');

    instruction('Static method: Class::method()');

        p('<h4>Example: Checkbox field (before)</h4>
        We create a method to include a checkbox field in different parts of the website without having to repeat the code. This field is always the same (same properties, etc.) wherever we\'ll use it on the website. That\'s why we can make it <code>static</code>.'
        ,0,1);

        p('<b>Form.php</b>');

        codein(); ?>&lt;?php

class Form {

    <b>public function checkbox (</b>string<b> $name, </b>string<b> $value = null, </b>array<b> $data = [])</b>: string
    {
        $attributes = '';
        if (isset($data[$name]) && in_array($value, $data[$name])) {
            $attributes .= 'checked';
        }
        return &lt;&lt;&lt;HTML
        &lt;input type="checkbox" name="{$name}[]" value="$value" $attributes>
HTML;
    }
    
}<?php codeout();

        p('<b>test.php</b>');

        codein(); ?>&lt;?php
require 'class' . DIRECTORY_SEPARATOR . 'Form.php';

<b>$form = new Form;</b> <l>// We don't need to do an instantiation like this</l>
echo $form->checkbox('demo', 'Demo', []);<?php codeout();

        p('<h4>Example: Checkbox field (after)</h4>');

        p('To avoid the line <code>$form = new Form;</code>, and since we don\'t need to add any properties to instances, then we better use this syntax (static):'
        ,0,1);

        p('<b>Form.php</b>');

        codein(); ?>&lt;?php

class Form {

    public <b>static</b> function checkbox (string $name, string $value = null, array $data = []): string<l>
        // We add the "static" keyword after the "public" one.</l>
    {
        $attributes = '';
        if (isset($data[$name]) && in_array($value, $data[$name])) {
            $attributes .= 'checked';
        }
        return &lt;&lt;&lt;HTML
        &lt;input type="checkbox" name="{$name}[]" value="$value" $attributes>
HTML;
    }
    
}<?php codeout();

        p('<b>test.php</b>');

        codein(); ?>&lt;?php
require 'class' . DIRECTORY_SEPARATOR . 'Form.php';

echo <b>Form::checkbox('demo', 'Demo', [])</b>;<l>
    // We skip the instantiation</l><?php codeout();

            resultin();
                require 'files' . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Form.php';
                echo Form::checkbox('demo', 'Demo', []);
            resultout();

    instruction('Static property');

        p('<h4>External use: <code>Class::$property</code></h4>');

        p('<b>Form.php</b>');

        codein(); ?>&lt;?php
class Form {

    public <b>static</b> $class = 'form-control';

    <l>public static function any_function_name() {
        // Some code here
    }</l>

}
<?php codeout();

        p('<b>test.php</b>');

        codein(); ?>&lt;?php
require 'class' . DIRECTORY_SEPARATOR . 'Form.php';

echo <b>Form::$class</b>;<?php codeout();

        p('<h4>Internal use: <code>self::$property</code></h4>');

        p('<h4>Form.php</h4>');

        codein(); ?>&lt;?php
class Form {

    public <b>static</b> $class = 'form-control';

    public static function checkbox (string $name, string $value = null, array $data = []): string
    {
        $attributes = '';
        if (isset($data[$name]) && in_array($value, $data[$name])) {
            $attributes .= 'checked';
        }
        <b>$attributes .= ' class="' . self::$class . '"';</b><l>
            // Note: we need to define a new variable inside the method to use the self:: attribute. If used directly in the string (between ""), the value won't be extrapolated by the server.</l>
        return &lt;&lt;&lt;HTML
        &lt;input type="checkbox" name="{$name}[]" value="$value" <b>$attributes</b>>
HTML;
    }

}<?php codeout();

        resultin();
            ?><pre><?php 
            echo '&lt;input type="checkbox" name="demo[]" value="Demo"  <b>class="form-control"</b>>';
            ?></pre><?php
        resultout();

// STOP EDITING
        
require '../../includes/footer.php'; 

/**
 *  code for "<": &lt;
 */

?>