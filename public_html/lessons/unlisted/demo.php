<?php

function sum_intervals(array $intervals) 
{
    if (is_array($intervals[0])) {
        foreach ($intervals as $k => $interval) {
            $thisStart = $interval[0];
            $thisEnd = $interval[1]; 
            for ($i= 0; $i < count($intervals); $i++) {
                if ($i !== $k) {
                    $start = $intervals[$i][0];
                    $end = $intervals[$i][1];
                    if ($thisStart >= $start && $thisStart < $end) {
                        $thisStart = $end;
                    }
                    if ($thisEnd >= $start && $thisEnd < $end) {
                        $thisEnd = $start;
                    }
                }
            }
            $intervals[$k] = [$thisStart, $thisEnd];
            if ($thisStart < $thisEnd) {
                $lengths[] = $thisEnd - $thisStart;
            }
        } 
        $intervals[] = $length = array_sum($lengths);
        return $intervals;
        return $length;
    } else {
        return $intervals[1]-$intervals[0];
    }
}

var_dump(sum_intervals([
    
    [1,20], 
    [6,20], 
    [1,6], 
    [16,19], 
    [5,11]
     


]));
