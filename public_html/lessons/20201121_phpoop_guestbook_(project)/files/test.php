<?php
require_once dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . 'projects' . DIRECTORY_SEPARATOR . 'php-playground' . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Message.php';
$folder = dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . 'projects' . DIRECTORY_SEPARATOR . 'php-playground' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'guestbook';
$num = (int)count(array_slice(scandir($folder), 2)) + 1;
$file = $folder . DIRECTORY_SEPARATOR . 'message-' . $num;

$array = [
    "username" => "fghj",
    "message" => "Hello i'm Joe",
    "date" => new DateTime()
];
$line = json_encode($array);
file_put_contents($file, $line);
$array = json_decode(file_get_contents($file), true);
$message1 = new Message($array['username'], $array['message'], DateTime::__set_state($array['date']));
var_dump($message1);