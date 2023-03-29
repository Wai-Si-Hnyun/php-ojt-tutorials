<?php

/**
 * function to create phone number from input array
 *
 * @param array $numberArray an array that contains integers
 * @return string formatted phone number string
 */
function createPhoneNumber($numberArray) {
    $tempArr = [];

    foreach ($numberArray as $item) {
        //Check to sure all integer in array
        if (!is_int($item)) {
            return "Error: Input array contains non-integer value(s)";
        }

        //Split many digits to single digit
        $digits = str_split((string) $item);
        foreach ($digits as $digit) {
            array_push($tempArr, $digit);
        }
    }

    $phoneCode = implode(array_slice($tempArr, 0, 3));
    $firstPart = implode(array_slice($tempArr, 3, 3));
    $lastPart = implode(array_slice($tempArr, 6));

    return "({$phoneCode}) {$firstPart}-{$lastPart}";
}

createPhoneNumber([1, 2, 3, 4, 5, 6, 7, 8, 9, 9]);

// Result
// createPhoneNumber([1, 2, 3, 4, 5, 6, 7, 8, 9, 0]); // output => (123) 456-7890
// createPhoneNumber([1, 1, 1, 1, 1, 1, 1, 1, 1, 1]); // output => (111) 111-1110
