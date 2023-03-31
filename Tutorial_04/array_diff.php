<?php

/**
 * function to find the difference in two arrays
 *
 * @param array $arr1
 * @param array $arr2
 */
function arrayDiff($arr1, $arr2) {
    $result = [];

    foreach ($arr1 as $item1) {
        $isFound = false;
        foreach ($arr2 as $item2) {
            if ($item1 === $item2) {
                $isFound = true;
                break;
            }
        }
        if (!$isFound) {
            array_push($result, $item1);
        }
    }

    print_r($result);
}

arrayDiff([1, 2, 3], [1, 2]);

// Result
// arrayDiff([1, 2], [1]); // output => [2]
// arrayDiff([1, 2, 2], [1]); // output => [2, 2]
// arrayDiff([1, 2, 2], [2]); // output => [1]
// arrayDiff([1, 2, 2], []); // output => [1, 2, 2]
// arrayDiff([], [1, 2]); // output => []
// arrayDiff([1, 2, 3], [1, 2]); // output => [3]