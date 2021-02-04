<?php
/**
 * The $input variable contains an array of digits
 * Return an array which will contain the same digits but repetitive by its value
 * without changing the order.
 * Example: [1,3,2] => [1,3,3,3,2,2]
 *
 * @param  array  $input
 * @return array
 */
function repeatArrayValues(array $input)
{

    $digitArr = [];

    if($input) {
        foreach($input as $digit) {
            for ($i=0; $i < $digit; $i++) {
                $digitArr[] = $digit;
            }
        }
    }

    return $digitArr;
}

/**
 * The $input variable contains an array of digits
 * Return the lowest unique value or 0 if there is no unique values or array is empty.
 * Example: [1, 2, 3, 2, 1, 5, 6] => 3
 *
 * @param  array  $input
 * @return int
 */
function getUniqueValue(array $input)
{
    $uniques = [];

    foreach ($input as $digit) {

        $tmpArr = [];
        foreach ($input as $key => $value) {
            if($value == $digit) {
                $tmpArr[] = $key;
            }
        }
        if(count($tmpArr) == 1) {
            $uniques[] = $digit;
        }
    }

    if($uniques) {
        sort($uniques);
        $lowest = array_shift($uniques);
        return $lowest;
    } else {
        return 0;
    }

}

/**
 * The $input variable contains an array of arrays
 * Each sub array has keys: name (contains strings), tags (contains array of strings)
 * Return the list of names grouped by tags
 * !!! The 'names' in returned array must be sorted ascending.
 *
 * Example:
 * [
 *  ['name' => 'potato', 'tags' => ['vegetable', 'yellow']],
 *  ['name' => 'apple', 'tags' => ['fruit', 'green']],
 *  ['name' => 'orange', 'tags' => ['fruit', 'yellow']],
 * ]
 *
 * Should be transformed into:
 * [
 *  'fruit' => ['apple', 'orange'],
 *  'green' => ['apple'],
 *  'vegetable' => ['potato'],
 *  'yellow' => ['orange', 'potato'],
 * ]
 *
 * @param  array  $input
 * @return array
 */
function groupByTag(array $input)
{
    // create tags arrays
    $tagsArr = [];
    foreach ($input as $row) {
        $tags = $row['tags'];
        foreach ($tags as $tag) {
            $tagsArr[] = $tag;
        }
    }

    sort($tagsArr);
    $tagsArr = array_unique($tagsArr);

// new array, where key = tag and value = names;
    foreach ($tagsArr as $tag) {

        foreach ($input as $row) {
            foreach($row as $key => $value) {
                if($key == "tags") {
                    if(in_array($tag,$value)) {
                        $names[$tag][] = $row['name'];
                        sort($names[$tag]);
                    }
                }
            }
        }
    }

    return $names;
}