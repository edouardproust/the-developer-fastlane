<?php
require '../../includes/header.php';
get_post_head('https://www.grafikart.fr/tutoriels/session-php-1128');

// START EDITING

title('Lesson');

    instruction('Purpose');

        p("PHP Doc allows to <b>comment quickly and in a standard way</b> the Structure Element of our code. This will be usefull for <b>team working</b> and to understand quickly our code if we wrote it weeks or months ago (and therefore don't remember it's structure).
        <br>It is well known and supported by the majority of services and developper");

    instruction('How to use PHP Doc ?');

    p('<ol>
        <li>We chosed the plugin called <b>PHPDoc Comment</b> by Rex Shi, available on <b>VisualStudioCode</b>.</li>
        <li>Once installed, <b>select any structural code element</b> (namespace, require/include, class, interface,function, method, property, constant, variable, trait)</li>
        <li>Right click and select "Add PHPDoc comment" or tap <b>command + shift + i</b></li>
        <li>This will generate a standard <b>auto-generated comment</b>. Modify it to fit your needs.</li>
    </ol>');

    instruction('General DockBloc syntax and parts');

codein(null); ?>
/**
 * This is the <b>summary</b> for a DocBlock.
 *
 * This is the <b>description</b> for a DocBlock. This text may contain
 * multiple lines and even some _markdown_.
 *
 * * Markdown style lists function too
 * * Just try this out once
 *
 * The section after the description contains the <b>tags</b>; which provide
 * structured meta-data concerning the given element.
 *
 * <b>@author</b>  Edouard Proust &lt;edouardproust@gmail.com>
 *
 * <b>@since</b> 1.0
 *
 * <b>@param</b> int    $example  This is an example <b>function/method parameter description</b>.
 * @param string $example2 This is a second example.
 */<?php codeout();

    instruction('Reference links');

    p('<ul>
        <li><a href="https://docs.phpdoc.org/3.0/guide/references/phpdoc/basic-syntax.html#what-is-a-docblock" target="_blank"><b>Structure of a DocBlock</b></a>: List of parts it contains and what there meant for / how to complete them properly
            <ul>
                <li><b>Summary:</b> a one-liner which globally states the function of the documented element.</li>
                <li><b>Description:</b> an extended description of the function of the documented element; may contain markup and inline tags.
                <li><b>Tags</b></li>
            </ul>
        </li>
        <li><a href="https://docs.phpdoc.org/3.0/guide/references/phpdoc/tags/index.html#tag-reference" target="_blank"><b>TAGS list</b></a>
            <ul>
                <li>@param, @return, @throws, @source, @example,...</li>
            </ul>
        <li><a href="https://docs.phpdoc.org/3.0/guide/guides/types.html" target="_blank"><b>TYPES list</b></a>
            <ul>
                <li><b>Primitives:</b> native PHP types
                    <ul>
                        <li>string, int, float, bool, array, resource, null, callable</li>
                    </ul>
                </li>
                <li><b>Keywords:</b> not native to PHP but usefull
                    <ul>
                        <li>mixed, void, object, false, true, self, static, $this</li>
                    </ul>
                </li>
                <li><b>Arrays:</b> precise the type of element inside the array
                    <ul>
                        <li>DateTime[], string[],...</li>
                    </ul>
                </li>
                <li><b>Multiple types combined:</b> using the | separator between types</li>
            </ul>
        </li>
    </ul>');

title('Exercise');

    p('Let\'s use the previous informations to add comments to a file that was created for this <a href="/projects/php-playground/weather.php">exercise</a>.'
    );

    p('<h4>OpenWeather.php</h4>');


    codein(null); ?>
&lt;?php 
<l>
<b>/**</b>
<b> * Manage the OpenWeather API</b>
<b> * </b>
<b> * @author  </b>Edouard Proust &lt;edouardproust@gmail.com>
<b> * </b>
<b> * @var string ICON_SIZE</b> (constant) Define the size of the weather icon ('1x', '2x' or '4x')
<b> * @var string UNITS</b> (constant) Define temparature unit ('default' = kelvin, 'metric' = Celsius, 'imperial' = Fahrenheit)
<b> * @var string $api_key </b>The API key provided in OpenWeather account > My API keys
<b> * @var int $timeout </b>cURL timeout delay. Value is defined in weather.php
<b> */</b></l> 
class OpenWeather {

    const ICON_SIZE = '2x';
    const UNITS = 'metric';
    private $api_key;
    private $timeout;
     <l>   
    <b>/**</b>
    <b> * Class constructor</b>
    <b> * </b>
    <b> * @param string $apiKey</b> The full API key string
    <b> * @param  mixed $timeOut</b> Timeout allowed for the API to run
    <b> * @return void</b>
    <b> */</b></l> 
    public function __construct(string $apiKey, int $timeOut)
    {
        $this->api_key = $apiKey;
        $this->timeout = $timeOut;
    }
    <l>   
    <b>/**</b>
    <b> * Get the weather data for current moment</b>
    <b> * </b>
    <b> * @param array $coordinates</b> [latitude, longitude]
    <b> * @return array</b> [(int)'temp', (string)'description' , (string)'icon', (DateTime)'time' ]
    <b> * </b> </l> 
    public function getCurrent(array $coordinates): ?array
    {
        $result = [];
        $data = $this->callAPI($coordinates);
        if ($data !== null && isset($data["current"])) {
            $result = $this->getResult($data["current"], $data["timezone"]);
        }
        return $result;
    }
    <l>   
    <b>/**</b>
    <b> * Get the weather data for the last hours</b>
    <b> * </b>
    <b> * @param array $coordinates</b> [latitude, longitude]
    <b> * @return array</b> [(int)'temp', (string)'description' , (string)'icon', (DateTime)'time' ]
    <b> * </b>
    <b> * </b>From time to time API returns data for a variable number of hours (json array's size is varying).
    <b> * </b>This issue comes from OpenWeather, not my code
    <b> */</b></l> 
    public function getLastHours(array $coordinates): array
    {
        $result = [];
        $data = $this->callAPI($coordinates);
        if ($data !== null && isset($data["hourly"])) {
            foreach ($data["hourly"] as $hour) {
                $result[] = $this->getResult($hour, $data["timezone"]);
            }
        }
        return $result;
    }
    <l>   
    <b>/**</b>
    <b> * Format the location string to get a proper City name + Country code</b>
    <b> * </b>
    <b> * @param  string $location</b> 'location-name_country-code' (example: 'paris_fr', 'new-york_us')
    <b> * @return  array</b> [(string)city name, (string)country code]
    <b> */</b></l> 
    public static function getName(string $location): array
    {
        $parts = explode('_', $location);
        $loc_array['city'] = implode( '-', array_map( 'ucfirst', explode('-', $parts[0]) ) );
        $loc_array['country'] = strtoupper($parts[1]);
        return $loc_array;
    }
    <l>    
    <b>/**</b>
    <b> * Call OpenWeather API</b>
    <b> * </b>
    <b> * @param array $coordinates</b> [latitude, longitude]
    <b> * @return null|array</b> json_decode[]
    <b> * </b> 
    <b> * @throws CurlException</b> cURL error (timeout,...)
    <b> * @throws HTTPException</b> API error returning any HTTP code (401, 404,...)
    <b> */</b></l> 
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
            CURLOPT_TIMEOUT_MS      => $this->timeout
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
    <l>    
    <b>/**</b>
    <b> * Formats weather data and returns it into an array</b> 
    <b> * </b>
    <b> * @param  mixed $data_when</b> ($data["current"], $data["hourly"],...)
    <b> * @param  mixed $timezone</b> ($data["timezone"],...)
    <b> * @return array</b> [(int)'temp', (string)'description' , (string)'icon', (DateTime)'time' ]
    <b> */</b></l> 
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
    <l>         
    <b>/**</b>
    <b> * Formats several datetime strings and store them into an array</b>
    <b> * </b>
    <b> * @param  mixed $timestamp</b> (time(),...)
    <b> * @param  mixed $timezone</b> ($data["timezone"], 'Europe/Paris',...)
    <b> * @return array</b> string[]
    <b> */</b></l> 
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


// STOP EDITING
        
require '../../includes/footer.php'; 

/**
 *  code for "<": &lt;
 */

?>