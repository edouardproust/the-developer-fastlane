<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Counter.php'; 
                                    
class CounterDouble extends Counter {

    public function get_views(): int
    {
        return 2 * parent::get_views();
    }

}