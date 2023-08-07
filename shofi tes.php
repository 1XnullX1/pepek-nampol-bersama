<?php
function calculateDistance($arr) {
    $distances = array();
    $length = count($arr);
    
    for ($i = 0; $i < $length - 1; $i++) {
        $distance = abs($arr[$i] - $arr[$i + 1]);
        $distances[] = $distance;
    }
    
    return $distances;
}

// Input array
$inputArray = array(4, 12, 3, 1, 15, 6, 2, 4, 3, 17);

// Calculate distances
$distances = calculateDistance($inputArray);

// Output the result
print_r($distances);
?>