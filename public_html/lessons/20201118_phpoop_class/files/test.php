<?php
require 'class' . DIRECTORY_SEPARATOR . 'Timeslot.php'; 

$timeslot1 = new Timeslot(8, 12); 
$timeslot2 = new Timeslot(14, 18);
echo 
    '<ul>' . 
        $timeslot1->html() .
        $timeslot1->html() . 
    '</ul>'
;