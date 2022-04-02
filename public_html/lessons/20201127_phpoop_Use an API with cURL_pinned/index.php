<?php
require '../../includes/header.php';
get_post_head('https://www.grafikart.fr/tutoriels/curl-php-1138');

// START EDITING

anchor('exercise');
title('Exercise (object oriented)');

    instruction('Instructions & result');

        p('<b>Goal:</b> Rewrite the <a href="#lesson-code">lesson\'s code</a> in an object-oriented manner and go further.<br>
        Time to exercise: <a href="https://youtu.be/vq7yJDuf42E?t=1500" target="_blank">25:00</a>');

        accordionin();
        accordionli(
            'Instructions',<<<HTML
            
                <div class="paragraph">
                    <b>List of classes and methods:</b>
                    <ul>
                        <li><code>\$meteo = new OpenWeater('b6907d289e10d714a6e88b30761fae22');</code></li>
                        <li><code>\$meteo->getforecast('Montpellier,fr');</code></li>
                    </ul>
                </div>
                <div class="paragraph">
                    <b>Will return an array as follows:</b>
                    <pre>
[
    [
        'temp' => 5.03,
        'description' => '...',
        'date' => DateTime()
    ]
]</pre>
                </div>
                <div class="paragraph">
                    <b>We want to display a line in footer like this</b> (between &lt;li> tags):
                    <ul><li>Jan 3, 2020: Cloudy (13°C)</li></ul>
                </div>
HTML);
        accordionout();

        resultin();
            exo_gallery_link(100, [1], 'weather.php', true, 0, 0);
        resultout();
        
    instruction('Code');
        
        p('<b>OpenWeather.php</b> (class file)');
        
        codein(); ?>
&lt;?php

class OpenWeather {

    const ICON_SIZE = '@2x'; // '', '@2x' or '@4x'
    const UNITS = 'metric';

    private $api_key;

    public function __construct(string $var)
    {
        $this->api_key = $var;
    }
    public function getToday(array $coordinates): array
    {
        $array = [];
        $data = $this->callAPI($coordinates);
        if ($data !== null) {
            $array = [
                'temp'  => $data["current"]["temp"] . '°C',
                'description'  => $data["current"]["weather"][0]["description"],
                'icon'  => 'http://openweathermap.org/img/wn/' . $data["current"]["weather"][0]["icon"] . self::ICON_SIZE . '.png',
                'time'  => $this->getTimeFormated($data["current"]["dt"], $data['timezone']),
            ];
        }
        return $array;
    }
    public function getLastHours(array $coordinates): array
    {
        $array = [];
        $data = $this->callAPI($coordinates);
        if ($data !== null) {
            foreach ($data['hourly'] as $hour) {
                $array[] = [
                    'temp' => $hour["temp"] . '°C',
                    'description' => ucfirst($hour["weather"][0]["description"]),
                    'icon' => 'http://openweathermap.org/img/wn/' . $hour["weather"][0]["icon"] . self::ICON_SIZE . '.png',
                    'time' => $this->getTimeFormated($hour["dt"], $data['timezone']),
                ];
            }
        }
        return $array;
    }
    public function getTimeFormated($timestamp, $timezone): array
    {
        $date = new DateTime("@" . $timestamp);
        $date->setTimeZone(new DateTimeZone($timezone));
        return  [
            'all' => $date->format('M d H:i'),
            'date' => $date->format('M d'),
            'hour' => $date->format('H:i'),
        ];
    }
    private function callAPI(array $coordinates): ?array
    {
        $time = time();
        $latitude = $coordinates[0];
        $longitude = $coordinates[1];
        $unit = self::UNITS;
        $curl = curl_init("https://api.openweathermap.org/data/2.5/onecall/timemachine?lat={$latitude}&lon={$longitude}&dt=$time&units={$unit}&appid={$this->api_key}");
        curl_setopt_array($curl, [
            CURLOPT_CAINFO          => dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'certificates' . DIRECTORY_SEPARATOR . 'openweather.cer',
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_TIMEOUT_MS      => 1000
        ]);
        $data = curl_exec($curl);
        if ($data === false || curl_getinfo($curl, CURLINFO_HTTP_CODE) !== 200) {
            return null;
        }
        curl_close($curl);
        return json_decode($data, true);
    } 

}<?php codeout();
        
        p('<b>weather.php</b> (display weather)');

        codein(); ?>
&lt;?php 

$cities = [
    'paris'         => [48.85, 2.35],
    'kerikeri'      => [-35.22, 173.94],
    'new-york'      => [40.71, -74.00],
    'hong-kong'     => [22.39, 114.10],
];

$title = 'Weather forecast';
require_once 'includes/header.php';
require_once 'class/OpenWeather.php';
$weather = new OpenWeather('4f34eb4cec4aa5200aa8b415963e297c');
?>

&lt;p class="lead mb-5">The list below has been made through the OpenWeather API. I links the API to this website thanks to the curl extension for PHP and following &lt;a href="/lessons/20201127_php_Use%20an%20API%20with%20cURL/">this lesson&lt;/a>.&lt;/p>
        
&lt;div class="row">
    &lt;?php 
    foreach ($cities as $name => $coordinates):
        $current = $weather->getToday($coordinates); 
        if (!empty($current)): ?>
            &lt;div class="col-md-3 mb-5">
                &lt;div class="card">
                    &lt;div class="card-body text-center">
                        &lt;h4>&lt;?= implode('-', array_map('ucfirst', explode('-', $name))) ?>&lt;/h4>
                        &lt;div class="small text-muted">&lt;?= $current['time']['all'] ?>&lt;/div>
                        &lt;img src="&lt;?= $current['icon']; ?>"/>
                        &lt;div>&lt;?= $current['description'] ?>&lt;/div>
                        &lt;div>&lt;b>&lt;?= $current['temp'] ?>&lt;/b>&lt;/div>
                    &lt;/div>
                &lt;/div>
                &lt;div class="mt-3">
                    &lt;ul class="list-unstyled">
                        &lt;?php $lastHours = $weather->getLastHours($coordinates); 
                        for ($i = count($lastHours) - 1; $i >= count($lastHours) - 10; $i--): ?>
                            &lt;?php if (!empty($lastHours[$i])): ?>
                                &lt;li class="small text-muted">&lt;?= $lastHours[$i]['time']['hour'] . ' - &lt;b>' . $lastHours[$i]['temp'] . '&lt;/b>  - ' . $lastHours[$i]['description'] ?>&lt;/li>
                            &lt;?php endif; ?>
                            &lt;?php
                        endfor; ?>
                    &lt;/ul>
                &lt;/div>
            &lt;/div>
        &lt;?php endif; ?>
    &lt;?php endforeach; ?> 
&lt;/div>

&lt;?php require 'includes/footer.php'; ?><?php codeout();


anchor('lesson');
title('Lesson (procedural)');

    p('<a href="#exercise">Go to exercise</a>'
    ,0,1);

    anchor('lesson-code');
    p('Here is the final code to call an API (after completing all steps listed below, from 1 to 5):');

        codein(null); ?>
<l>&lt;?php</l>
$curl = <b>curl_init</b>('https://samples.openweathermap.org/data/2.5/weather<b>?q=Paris,fr&units=metric&APPID=</b>b6907d289e10d714a6e88b30761fae22');
<b>curl_setopt_array</b>($curl, [
    <b>CURLOPT_CAINFO</b>          => __DIR__ . DIRECTORY_SEPARATOR . 'cert.cer',
    <b>CURLOPT_RETURNTRANSFER</b>  => true,
    <b>CURLOPT_TIMEOUT_MS</b>      => 1000
]);
$data = <b>curl_exec</b>($curl);
if ($data === false) {
    var_dump(<b>curl_error</b>($curl));
} else {
    if(<b>curl_getinfo</b>($curl, CURLINFO_HTTP_CODE) === 200) {
        $data = json_decode($data, true);
        echo 'Temperature: ' . <b>$data['main']['temp']</b> . ' °C';
    }
}
<b>curl_close</b>($curl);<?php codeout();

    instruction('1. Activation of the curl extension on the local server');

    
    ?>Here is a <a href="<?= str_replace('index.php', '', $_SERVER["SCRIPT_NAME"]) . 'files/php.ini' ?>">ready-to-go php.ini file</a> to download (right click + "Save link as")<?php

    p('<b>Steps:</b>
    <ul>
    <li>Run a <code>phpinfo();</code> command to get the info about your system. Look for a whole section called curl. If no section exists, then you have to install the extension via the php.ini file
    <li>Rename the php.ini-development (or ) file in the PHP installation folder (usually the folder named "PHP" located at the root of the C: hard drive on Windows).
    <li>Unmute the following ligns (just remove the semicolon at the begenning of each line):
        <ul>
            <li><code>extension_dir = "ext"</code></li>
            <li><code>extension=curl</code></li>
        </ul>
        <li>Stop and run again the PHP server</li>
    </ul>
    ',2,0);

    exo_gallery(50, [6, 7]);

    instruction('2. Execute the curl request with PHP');

        p('There are <b>4 essential functions</b> (look at code on top of the page for details / application example)
        <ul>
            <li><b>curl_init()</b>: Initialize a cURL session (<a href="https://www.php.net/manual/en/function.curl-init.php">PHP Doc</a>)</li>
            <li><b>curl_exec()</b>: Perform a cURL session (<a href="https://www.php.net/manual/en/function.curl-exec">PHP Doc</a>)</li>
            <li><b>curl_error()</b>: Return a string containing the last error for the current session (<a href="https://www.php.net/manual/en/function.curl-error.php">PHP Doc</a>)</li>
            <li><b>curl_close()</b>: Close a cURL session (<a href="https://www.php.net/manual/en/function.curl-close.php">PHP Doc</a>)</li>
        </ul>
        ');

    instruction('3. Manage SSL errors');

        p('<b>2 solutions</b>, both using <b>curl_setopt()</b> function (or more usually <b>curl_setopt_array()</b> one if passing several parameters):

        <ul>
            <li>For testing/development purpose only (poses security concerns): <code>curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);</code></li>
            <li><b>Recommanded one (Download an SSL certificate)</b> - Steps in <b>Chrome browser</b>:
                <ul>
                    <li>Click on the "padlock" icon to the left of the address bar.</li>
                    <li>Click on "Certificate (valid)".</li>
                    <li>Go to the tab "Certification path".</li>
                    <li>Click on the root certificate (1st line of the tree) then click on the "View Certificate" button.</li>
                    <li>In the new window, click on "Details" and then click on the "Copy to file..." button.</li>
                    <li>In the Certificate Export Wizard, select the option "X.509 encoded in base 64 (*.cer)" (do not take the option "DER encoded" because it will not be understood by PHP)</li>
                    <li>Choose the path to save the file (example: create a folder "certificates" in the "config" folder). Name the file "cert.cer".</li>
                    <li>then order: <code>curl_setopt($curl, CURLOPT_CAINFO, __DIR__ . DIRECTORY_SEPARATOR . \'cert.cer\');</code></li>
                </ul>
            </li>
        </ul><br>
        ');

        exo_gallery(50, [2, 3]);

    instruction('4. Decoding the content of the cURL request');

        p('<b>Steps:</b>
        <ul>
            <li>Store the content of the query in a <code>$data</code> variable with: <code>curl_setopt_array( CURLOPT_RETURNTRANSFER => true);</code>
            <li>decode the JSON content with: <code>json_decode($data, true);</code>
            <li>Retrieve the useful key with: <code>var_dump($data[\'key\']);</code> for example or any other PHP display function.
            <li>Tip: to more easily find the keys in the JSON file, <b>use Firefox to open the JSON file or use an extension in Chrome</b> (will display a more readable hierarchical list of JSON content, with colors, etc.).</li>
            <li>Finally, define a timeout with: <code>curl_setopt_array( CURLOPT_TIMEOUT_MS => 1000);</code></li>
        </ul>
        ');

    instruction('5. Get API key and do some customizations to API data');

        p('<b>Example with the OpenWeather API:</b>
        <ul>
            <li>Go to "How to start". Signup. Get API Key for the service needed.</li>
            <li>Put the API key in the url with: <code>&APPID=paste_api_key_here</code></li>
            <li>Add to URL the needed parameters, based on the documentation</li>
        </ul><br>
        ');

        exo_gallery(50, [4, 5]);

// STOP EDITING
        
require '../../includes/footer.php'; 

/**
 *  code for "<": &lt;
 */

?>