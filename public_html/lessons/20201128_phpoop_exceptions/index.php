<?php
require '../../includes/header.php';
get_post_head('https://www.grafikart.fr/tutoriels/exception-php-1139');

// START EDITING

instruction('Summury');
    p('
    <ul>
        <li><b><a href="#exercise">Exercise</a></b>
            <ol>
                <li><a href="#exercise_extended">Version with extended classes</a></li>
                <li><a href="#exercise_basic">Version with basic Exception class only</a></li>
            </ol>
        </li>
        <li><b><a href="#lesson">Lesson</a></b>
            <ol>
                <li><a href="#lesson_exception"><code><em>class</em> Exception</code></a></li>
                <li><a href="#lesson_custom-exception"><code><em>class</em> CustomException <em>extends</em> Exception</code></a></li>
                <li><a href="#lesson_error"><code><em>class</em> Error</code></a></li>
            </ol>
        </li>
    </ul>
    ');


anchor('exercise');
title('Exercise');    

    p('Let\'s apply the <a href="#lesson">lesson\'s learnings</a> to the previous chapter\'s exercise code: "Use an API with cURL".');


    anchor('exercise_extended');
    instruction('1. Version with extended classes');

        resultin();
            exo_gallery_link(100, [7], 'weather.php', false);
            exo_gallery_link(50, [8,9], 'weather.php', true);
        resultout();

        p('<h4>CurlException.php</h4>
        Exception extended class #1');

            codein(); ?>&lt;?php

class CurlException extends Exception {

    public function __construct($curl) 
    {
        $error = curl_error($curl);
        curl_close($curl);
        $this->message = $error;
    }

}<?php codeout();

        p('<h4>HTTPException.php</h4>
        Exception extended class #2');

            codein(); ?>&lt;?php

class HTTPException extends Exception {

    public function __construct($data)
    {
        $data = json_decode($data, true);
        $this->message = $data['message'];
        $this->code = $data['cod'];
    }

}<?php codeout();

        p('<h4>OpenWeather.php</h4>
        Main class containing methods and properties');

        codein(); ?>
&lt;?php 

class OpenWeather {

    const ICON_SIZE = '2x'; // '1x', '2x' or '4x'
    const UNITS = 'metric';
    private $api_key;

    public function __construct(string $var)
    {
        $this->api_key = $var;
    }

    public function getCurrent(array $coordinates): array
    {
        $result = [];
        $data = $this->callAPI($coordinates);
        if ($data !== null) {
            $result = $this->getResult($data["current"], $data["timezone"]);
        }
        return $result;
    }

    public function getLastHours(array $coordinates): array
    {
        $result = [];
        $data = $this->callAPI($coordinates);
        if ($data !== null) {
            foreach ($data["hourly"] as $hour) {
                $result[] = $this->getResult($hour, $data["timezone"]);
            }
        }
        return $result;
    }

    public static function getName(string $location): array
    {
        $parts = explode('_', $location);
        $loc_array['city'] = implode( '-', array_map( 'ucfirst', explode('-', $parts[0]) ) );
        $loc_array['country'] = strtoupper($parts[1]);
        return $loc_array;
    }

    private function callAPI(array $coordinates): ?array
    {
        $time = time()-1;
        $latitude = $coordinates[0];
        $longitude = $coordinates[1];
        $unit = self::UNITS;
        $curl = curl_init("https://api.openweathermap.org/data/2.5/onecall/timemachine?lat={$latitude}&lon={$longitude}&dt=$time&units={$unit}&appid={$this->api_key}");
        curl_setopt_array($curl, [
            CURLOPT_CAINFO          => dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'certificates' . DIRECTORY_SEPARATOR . 'openweather.cer',
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_TIMEOUT_MS      => 3500
        ]);
        $data = curl_exec($curl);
        if ($data === false) {
            throw new CurlException($curl);
        }
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($code !== 200) {
            curl_close($curl);
            throw new HTTPException($data);
        }
        curl_close($curl);
        return json_decode($data, true);
    }

    private function getResult($data_when, $timezone): array
    {
        if (self::ICON_SIZE === '2x' || self::ICON_SIZE === '4x') {
            $icon_size = '@' . self::ICON_SIZE;
        } else {
            $icon_size = '';
        }
        return [
            'temp'          => $data_when["temp"] . '°C',
            'description'   => ucfirst($data_when["weather"][0]["description"]),
            'icon'          => 'http://openweathermap.org/img/wn/' . $data_when["weather"][0]["icon"] . $icon_size . '.png',
            'time'          => $this->getTimeFormated($data_when["dt"], $timezone),
        ];
    }
    
    private function getTimeFormated($timestamp, $timezone): array
    {
        $date = new DateTime("@" . $timestamp);
        $date->setTimeZone(new DateTimeZone($timezone));
        return  [
            'all' => $date->format('M d g:i a'),
            'date' => $date->format('M d'),
            'hour' => $date->format('g a'),
        ];
    }

}<?php codeout(); 

        p('<h4>weather.php</h4>
        Content display page');

        codein(); ?>&lt;?php 

$locations = [
    'paris_fr'         => [48.85, 2.35],
    'new-york_us'      => [40.71, -74.00],
    'kerikeri_nz'      => [-35.22, 173.94]
];
$title = 'Weather forecast';
require_once 'includes/header.php';
require_once 'class/OpenWeather.php';
require_once 'class/Exceptions/CurlException.php';
require_once 'class/Exceptions/HTTPException.php';

$alert_class = $error = null;
$weather = new OpenWeather('a4f34eb4cec4aa5200aa8b415963e297c');
try {
    foreach ($locations as $location => $coordinates) {
        $locations_current[$location] = $weather->getCurrent($coordinates);
        $locations_lastHours[$location] = $weather->getLastHours($coordinates); 
    }
} catch (CurlException $e) {
    $error = '&lt;b>API error info:&lt;/b> ' . $e->getMessage() . '.';
    $alert_class = 'danger';
} catch (HTTPException $e) {
    $error = '&lt;b>' . $e->getCode() . ' Error status:&lt;/b> ' . $e->getMessage();
    $alert_class = 'primary';
}
if($error) {
    $error = '&lt;b>Oops, this was not supposed to happen.&lt;/b>
    &lt;div class="small mb-2">' . $error . '&lt;/div>
    Please try again later or &lt;a href="contact.php">contact us&lt;/a>.';
    $error_sub = '&lt;a href="index.php">Go back to homepage&lt;/a>';
} ?>

&lt;p class="lead mb-5">The list below has been made through the OpenWeather API. I links the API to this website thanks to the curl extension for PHP and following &lt;a href="/lessons/20201127_php_Use%20an%20API%20with%20cURL/">this lesson&lt;/a>.&lt;/p>

&lt;?php if($error): ?>
    &lt;div class="alert &lt;?= $alert_class ? 'alert-'.$alert_class : '' ?>">&lt;?= $error ?>&lt;/div>
    &lt;div>&lt;?= $error_sub ?>&lt;/div>
&lt;?php else: ?> 
    &lt;div class="row">
        &lt;?php foreach ($locations_current as $location => $data): ?>
            &lt;?php $title = OpenWeather::getName($location) ?>
            &lt;div class="col-md-&lt;?= count($locations) === 4 ? '3' : '4' ?> mb-5">
                &lt;div class="card">
                    &lt;div class="card-body text-center">
                        &lt;h4>&lt;?= $title['city'] . ' &lt;span class="small text-muted">(' . $title['country'] . ')&lt;/span>' ?>&lt;/h4>
                        &lt;div class="small text-muted">&lt;?= $data['time']['all'] ?>&lt;/div>
                        &lt;img src="&lt;?= $data['icon']; ?>"/>
                        &lt;div>&lt;?= $data['description'] ?>&lt;/div>
                        &lt;div>&lt;b>&lt;?= $data['temp'] ?>&lt;/b>&lt;/div>
                    &lt;/div>
                &lt;/div>
                &lt;div class="mt-3">
                    &lt;ul class="list-unstyled">
                        &lt;?php 
                        $lastHours = $locations_lastHours[$location];
                        for ($i = count($lastHours) - 1; $i >= count($lastHours) - 15; $i -= 2): ?>
                            &lt;?php if (!empty($lastHours[$i])): ?>
                                &lt;li class="small text-muted">&lt;?= $lastHours[$i]['time']['hour'] . ' : &lt;b>' . $lastHours[$i]['temp'] . '&lt;/b>  - ' . $lastHours[$i]['description'] ?>&lt;/li>
                            &lt;?php endif; ?>
                            &lt;?php
                        endfor; ?>
                    &lt;/ul>
                &lt;/div>
            &lt;/div>
        &lt;?php endforeach; ?>
    &lt;/div>
&lt;?php endif; ?>

&lt;?php require 'includes/footer.php'; ?><?php codeout();

    anchor('exercise_basic');
    instruction('2. Version with basic Exception class only');

        resultin();
            exo_gallery_link(50, [4,5], 'weather.php', true);
        resultout();

        p('<h4>OpenWeather.php</h4>
        Main class containing methods and properties');

        codein(); ?>
&lt;?php 

class OpenWeather {

    const ICON_SIZE = '2x'; // '1x', '2x' or '4x'
    const UNITS = 'metric';
    private $api_key;

    public function __construct(string $var)
    {
        $this->api_key = $var;
    }

    public function getCurrent(array $coordinates): array
    {
        $result = [];
        $data = $this->callAPI($coordinates);
        if ($data !== null) {
            $result = $this->getResult($data["current"], $data["timezone"]);
        }
        return $result;
    }

    public function getLastHours(array $coordinates): array
    {
        $result = [];
        $data = $this->callAPI($coordinates);
        if ($data !== null) {
            foreach ($data["hourly"] as $hour) {
                $result[] = $this->getResult($hour, $data["timezone"]);
            }
        }
        return $result;
    }

    public static function getName(string $location): array
    {
        $parts = explode('_', $location);
        $loc_array['city'] = implode( '-', array_map( 'ucfirst', explode('-', $parts[0]) ) );
        $loc_array['country'] = strtoupper($parts[1]);
        return $loc_array;
    }

    private function callAPI(array $coordinates): ?array
    {
        $time = time()-1;
        $latitude = $coordinates[0];
        $longitude = $coordinates[1];
        $unit = self::UNITS;
        $curl = curl_init("https://api.openweathermap.org/data/2.5/onecall/timemachine?lat={$latitude}&lon={$longitude}&dt=$time&units={$unit}&appid={$this->api_key}");
        curl_setopt_array($curl, [
            CURLOPT_CAINFO          => dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'certificates' . DIRECTORY_SEPARATOR . 'openweather.cer',
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_TIMEOUT_MS      => 4000
        ]);
        <b>$data = curl_exec($curl);
        if ($data === false)</b> {
            $error = curl_error($curl);
            curl_close($curl);
            <b>throw new Exception($error);</b>
        }
        <b>$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($code !== 200)</b> {
            curl_close($curl);
            <b>throw new Exception($data);</b>
        }
        curl_close($curl);
        return json_decode($data, true);
    }

    private function getResult($data_when, $timezone): array
    {
        if (self::ICON_SIZE === '2x' || self::ICON_SIZE === '4x') {
            $icon_size = '@' . self::ICON_SIZE;
        } else {
            $icon_size = '';
        }
        return [
            'temp'          => $data_when["temp"] . '°C',
            'description'   => ucfirst($data_when["weather"][0]["description"]),
            'icon'          => 'http://openweathermap.org/img/wn/' . $data_when["weather"][0]["icon"] . $icon_size . '.png',
            'time'          => $this->getTimeFormated($data_when["dt"], $timezone),
        ];
    }
    
    private function getTimeFormated($timestamp, $timezone): array
    {
        $date = new DateTime("@" . $timestamp);
        $date->setTimeZone(new DateTimeZone($timezone));
        return  [
            'all' => $date->format('M d g:i a'),
            'date' => $date->format('M d'),
            'hour' => $date->format('g a'),
        ];
    }

}<?php codeout(); 

    p('<h4>weather.php</h4>
    Display page');

        codein(); ?>
&lt;?php 

$locations = [
    'paris_fr'         => [48.85, 2.35],
    'new-york_us'      => [40.71, -74.00],
    'kerikeri_nz'      => [-35.22, 173.94]
];

$title = 'Weather forecast';
require_once 'includes/header.php';
require_once 'class/OpenWeather.php';

<b>$error = null;</b>
$weather = new OpenWeather('4f34eb4cec4aa5200aa8b415963e297c');
<b>try {
    foreach ($locations as $location => $coordinates) {
        $locations_current[$location] = $weather->getCurrent($coordinates);
        $locations_lastHours[$location] = $weather->getLastHours($coordinates); 
    }
} catch (Exception $e) {
    $message_line = $e->getMessage();
    if (!empty($message_line)) { 
        if ((substr($message_line, 0, 1) === '{' && substr($message_line, -1, 1))) {
            $message_array = json_decode($message_line, true); 
            $message = 'Code ' . $message_array['cod'] . ': ' . $message_array['message'];
        } else {
            $message = $e->getMessage();
        }
    } else {
        $message = 'no details';
    } 
    $error = "An error occured, please try again later.
        &lt;div class='small'>$message&lt;/div>";
}</b> ?>

&lt;p class="lead mb-5">The list below has been made through the OpenWeather API. I links the API to this website thanks to the curl extension for PHP and following &lt;a href="/lessons/20201127_php_Use%20an%20API%20with%20cURL/">this lesson&lt;/a>.&lt;/p>

<b>&lt;?php if($error): ?>
    &lt;div class="alert alert-danger">&lt;?= $error ?>&lt;/div>
&lt;?php else: ?></b> 
    &lt;div class="row">
        &lt;?php foreach ($locations_current as $location => $data): ?>
            &lt;?php $title = OpenWeather::getName($location) ?>
            &lt;div class="col-md-&lt;?= count($locations) === 4 ? '3' : '4' ?> mb-5">
                &lt;div class="card">
                    &lt;div class="card-body text-center">
                        &lt;h4>&lt;?= $title['city'] . ' &lt;span class="small text-muted">(' . $title['country'] . ')&lt;/span>' ?>&lt;/h4>
                        &lt;div class="small text-muted">&lt;?= $data['time']['all'] ?>&lt;/div>
                        &lt;img src="&lt;?= $data['icon']; ?>"/>
                        &lt;div>&lt;?= $data['description'] ?>&lt;/div>
                        &lt;div>&lt;b>&lt;?= $data['temp'] ?>&lt;/b>&lt;/div>
                    &lt;/div>
                &lt;/div>
                &lt;div class="mt-3">
                    &lt;ul class="list-unstyled">
                        &lt;?php 
                        $lastHours = $locations_lastHours[$location];
                        for ($i = count($lastHours) - 1; $i >= count($lastHours) - 15; $i -= 2): ?>
                            &lt;?php if (!empty($lastHours[$i])): ?>
                                &lt;li class="small text-muted">&lt;?= $lastHours[$i]['time']['hour'] . ' : &lt;b>' . $lastHours[$i]['temp'] . '&lt;/b>  - ' . $lastHours[$i]['description'] ?>&lt;/li>
                            &lt;?php endif; ?>
                            &lt;?php
                        endfor; ?>
                    &lt;/ul>
                &lt;/div>
            &lt;/div>
        &lt;?php endforeach; ?>
    &lt;/div>
<b>&lt;?php endif; ?></b>

&lt;?php require 'includes/footer.php'; ?><?php codeout();


anchor('lesson');
title('Lesson');

    instruction('Purpose');

        p('Often in our code, there are unpredictable reactions. For example, this is the case with APIs (which sometimes do not respond or report an error). Exceptions in PHP OOP allow us to create our own types of errors and to precisely define the script\'s reaction to each of them (display a custom message, skip a part, etc.).
        ', 0,1);

    anchor('lesson_exception');
    instruction('1. <code>$class Exception</code>');

        p('<h4>Code & result</h4>');

            codein(); ?>&lt;?php
function add($a, $b)
{
    if (!is_numeric($a) | !is_numeric($b))
    {
    throw new Exception('Both parameters must be numbers'); <l>// A new exception is thrown if one of the two parameters is not a number.</l>
    }
    
    return $a + $b;
}

try // We will try to perform the instructions located in this block.
{
    echo add(12, 3), '&lt;br />';
    echo add('azerty', 54), '&lt;br />';
    echo add(4, 8);
}
catch (Exception $e) <l>// We will catch the "Exception" exceptions if one is raised</l>
{
    echo 'An exception was thrown. Error message: ', $e->getMessage();
}<?php codeout();

            resultin();
                exo_gallery(66, [1]);
            resultout();

        p('<h4>Explanation</h4>');

            p("<b>There are 3 steps to handle an exception</b>:
            <ol>
                <li><b>throw:</b> To be inserted in the condition that will trigger the error. Make a new instance of the Exception class (PHP's default class for handling exceptions). We can create others via extends: subject of the next paragraph). In brackets we will specify the error message: <code>if(error condition here) { throw new Exception('Custom error message here.'); }</code>
                <li><b>try:</b> Include the code in question (the one that could potentially cause a problem). <code>try { // paste here the code that may have unpredictable behavior, like returning an error }</code>
                <li><b>catch:</b> Hide the automatic error message generated by PHP + define an alternative action: <code>catch(Exception \$e) { // do something }</code> (By convention, the variable for the exception is \$e).<br>
                To display a personalized message, <b>2 methods</b>:
                    <ul>
                        <li><b><code>\$e->getMessage()</code></b> : displays the error message present in the instantiation of the exception (step 1 with <code>throw</code>)</li>
                        <li><b><code>\$e->getCode()</code></b> : displays PHP error code</li>
                    </ul>
                </li>
            </ol>
            ");

        p('<h4>Exceptions list</h4>');

        accordionin();
            accordionli(
                'Lists of Exception tree (*)',<<<HTML
                    <div class="paragraph">
                        <b>As of PHP 7.2.0:</b>
                        <ul>
                            <li>ClosedGeneratorException</li>
                            <li>DOMException</li>
                            <li>ErrorException</li>
                            <li>IntlException</li>
                            <li>LogicException
                                <ul>
                                    <li>BadFunctionCallException
                                        <ul>
                                            <li>BadMethodCallException</li>
                                        </ul>
                                    </li>
                                    <li>DomainException</li>
                                    <li>InvalidArgumentException</li>
                                    <li>LengthException</li>
                                    <li>OutOfRangeException</li>
                                </ul>
                            </li>
                            <li>PharException</li>
                            <li>ReflectionException</li>
                            <li>RuntimeException
                                <ul>
                                    <li>OutOfBoundsException</li>
                                    <li>OverflowException</li>
                                    <li>PDOException</li>
                                    <li>RangeException</li>
                                    <li>UnderflowException</li>
                                    <li>UnexpectedValueException</li>
                                </ul>
                            </li>
                            <li>SodiumException</li>
                        </ul>
                    </div>
HTML);
        accordionout();
        
        p('(*) Find the script and output <a href="https://gist.github.com/mlocati/249f07b074a0de339d4d1ca980848e6a">here</a> 
        or <a href="https://3v4l.org/sDMsv">there</a>
        ', 1,1);


    anchor('lesson_custom-exception');
    instruction('2. <code>class CustomException extends Exception</code>');

        p('You can create extended classes of the default PHP Exception class.
        <ul>
            <li><b>Purpose:</b> This allows you to capture different types of errors individually. And thus manage them and display different error messages/contents for each one. Creating a class for each type of error allows much more modularity.</li>
            <li><b>To create a new Exception class:</b>
                <ol>
                    <li>Create a CustomException.php file containing: <code>class CustomException extends Exception { }</code></li>
                    <li>Define a custom <code>__construct()</code>: see <a href="https://www.php.net/manual/en/language.exceptions.extending.php">PHP Doc</a> for details on parameters to insert. Always use a custom error description (\$description). Sometimes the error code will be added as a 2nd parameter.)
                    <br>There are <b>2 ways</b> to do it:</b>
                        <ul>
                            <li>Leave empty the class in the CustomException.php file + create an instance in the throw by defining parameters: <code>new CustomException($description, $code);</code>
                            <li>Create a <code>__construct()</code> method in CustomException.php, and define the parameters according to <a href="https://www.php.net/manual/en/language.exceptions.extending.php">the PHP doc</a>. In the throw, create an instance without defining parameters: <code>new CustomException;</code>
                        </ul>
                    </li>
                </ol>
            <li><b>Example:</b> Look at the code below (part 2. Version with extended classes)</li>
        </ul>
        ');

        anchor('lesson_error');
        instruction('3. <code>class Error</code>');

        p('<b>Basic PHP errors</b> can\'t be catched with Exception class, but with Error one (<a href="<a href="https://www.php.net/manual/en/class.error">PHP Doc</a>).<br>
        Go to this part of the video: <a href="https://youtu.be/210s8-uYSrg?t=1279" target="_blank">21:19</a>');

        p('<h4>Code & result</h4>');

            codein(); ?>
try {
</l>// List here actions that may lead to errors</l>
}
catch (<b>Error</b> $e) { 
    $error = $e->getMessage(); 
        // <l>Do some stuff if a basic PHP error occurs
        // (in this example, we fill the $error variable with a custom error message)</l>
}
<?php codeout();

            resultin();
                exo_gallery(66, [2]);
            resultout();
        
        p('<h4>Explanations</h4>');
        
            p('<ul>
                <li><b>Error class</b> works exactly the same as <b>Exception</b> class detailed above, exept it does not catch the same errors\' types.</li>
                <li><b>Parameters:</b> Check the "Class synopsis" section of the dedicated PHP Doc for a detailed list for the __construct method.</li>
                <li><b>declare():</b> Need to write at the very beginning of the page: <code>declare(strict_types=1);</code></li>
                <li> It is possible to <b>include both Exception and Error classes inside the same $e variable</b> with <b>|</b> sign: <code> catch (Exception | Error $e) { // do some stuff }</code>
                    
                </ul>
            ');

        p('<h4>Errors list</h4>');
        
            accordionin();
                accordionli(
                    'Lists of Throwable (Error) tree (*)',<<<HTML
                        <div class="paragraph">
                            <b>As of PHP 7.2.0:</b>
                            <ul>
                                <li>ArithmeticError
                                    <ul>
                                        <li>DivisionByZeroError</li>
                                    </ul>
                                </li>
                                <li>AssertionError</li>
                                <li>ParseError</li>
                                <li>TypeError
                                    <ul>
                                        <li>ArgumentCountError</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
    HTML
                );
            accordionout();

            p('(*) Find the script and output <a href="https://gist.github.com/mlocati/249f07b074a0de339d4d1ca980848e6a">here</a> 
            or <a href="https://3v4l.org/sDMsv">there</a>
            ', 1,1);
        

// STOP EDITING
        
require '../../includes/footer.php'; 

/**
 *  code for "<": &lt;
 */

?>