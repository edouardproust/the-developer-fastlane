<?php

/*

class Test {
        
    public function getToday(array $coordinates)
    {
        $array = [
            'temp'  => $data["current"]["temp"] . '°C',
            'description'  => $data["current"]["weather"][0]["description"],
            'icon'  => 'http://openweathermap.org/img/wn/' . $data["current"]["weather"][0]["icon"] . self::ICON_SIZE . '.png',
            'time'  => $this->getTimeFormated($data["current"]["dt"], $data['timezone']),
        ];
        return $array;
    }
    public function getLastHours(array $coordinates)
    {
        
        foreach ($data['hourly'] as $hour) {
            $array[] = [
                'temp' => $hour["temp"] . '°C',
                'description' => ucfirst($hour["weather"][0]["description"]),
                'icon' => 'http://openweathermap.org/img/wn/' . $hour["weather"][0]["icon"] . self::ICON_SIZE . '.png',
                'time' => $this->getTimeFormated($hour["dt"], $data['timezone']),
            ];
        }
        return $array;
    }

}

*/


//--------------------------------------------------------------------


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
                $result[] = $this->getResult($data["hourly"], $data["timezone"]);
            }
        }
        return $result;
    }
    public static function getName(string $location): array
    {
        $array1 = explode('_', $location);
        $array2['city'] = implode('-', array_map('ucfirst', explode('-', $array1[0])));
        $array2['country'] = strtoupper($array1[1]);
        return $array2;
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
        $data = curl_exec($curl);
        if ($data === false) {
            $error = curl_error($curl);
            curl_close($curl);
            throw new Exception($error);
        }
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($code !== 200) {
            curl_close($curl);
            throw new Exception($data);
        }
        curl_close($curl);
        return json_decode($data, true);
    }
    private function getResult($data_when, $timezone): array
    {
        return [
            'temp'  => $data_when["temp"] . '°C',
            'description'  => $data_when["weather"][0]["description"],
            'icon'  => 'http://openweathermap.org/img/wn/' . $data_when["weather"][0]["icon"] . self::ICON_SIZE . '.png',
            'time'  => $this->getTimeFormated($data_when["dt"], $timezone),
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

}