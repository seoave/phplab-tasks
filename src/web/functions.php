<?php
/**
 * The $airports variable contains array of arrays of airports (see airports.php)
 * What can be put instead of placeholder so that function returns the unique first letter of each airport name
 * in alphabetical order
 *
 * Create a PhpUnit test (GetUniqueFirstLettersTest) which will check this behavior
 *
 * @param array $airports
 * @return string[]
 */
function getUniqueFirstLetters(array $airports): array
{
    // get new first letters array
    foreach ($airports as $port) {
        $letters[] = $port['name'][0];
    }

    // unique and sort array
    $result = array_unique($letters);
    sort($result);

    return $result;
}

function lookingFirstLetter($letter, $airports): array
{
    $filteredArr = [];
    foreach ($airports as $airport) {
        $firstLetter = $airport['name'][0];
        if ($firstLetter === $letter) {
            $filteredArr[] = $airport;
        }
    }

    return $filteredArr;
}

function lookingState($newState, $airports): array
{
    $filteredArr = [];
    foreach ($airports as $airport) {
        $state = $airport['state'];
        if ($state === $newState) {
            $filteredArr[] = $airport;
        }
    }

    return $filteredArr;
}
