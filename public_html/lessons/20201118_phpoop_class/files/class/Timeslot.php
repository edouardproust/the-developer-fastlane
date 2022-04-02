<?php

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
    public function intersect(Timeslot $timeslot): bool
    {
        return
            $this->includes_hour($timeslot->start) ||
            $this->includes_hour($timeslot->end) ||
            $this->start > $timeslot->start && $this->end < $timeslot->end
        ;
    }
        public function html(): string
    {
        return "<li>From {$this->start} to {$this->end}</li>";
    }
}