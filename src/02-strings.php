<?php
/**
 * The $input variable contains text in snake case (i.e. hello_world or this_is_home_task)
 * Transform it into a camel-cased string and return (i.e. helloWorld or thisIsHomeTask)
 * @see http://xahlee.info/comp/camelCase_vs_snake_case.html
 *
 * @param  string  $input
 * @return string
 */
function snakeCaseToCamelCase(string $input)
{
    $words = explode('_',$input);

    foreach($words as $key => $word) {
        if($key !=0) {
            $word = ucfirst($word);
        }
        $camels[] = $word;
    }

    $camels = implode($camels);

    return $camels;
}

/**
 * The $input variable contains multibyte text like 'ФЫВА олдж'
 * Mirror each word individually and return transformed text (i.e. 'АВЫФ ждло')
 * !!! do not change words order
 *
 * @param  string  $input
 * @return string
 */
function mirrorMultibyteString(string $input)
{
    $words = explode(' ',$input);

    foreach($words as $word) {
        $word = mb_str_split($word);
        $word = array_reverse($word);
        $word = implode($word);
        $reversed[] = $word;
    }

    $reversed = implode(" ",$reversed);

    return $reversed;
}

/**
 * My friend wants a new band name for her band.
 * She likes bands that use the formula: 'The' + a noun with the first letter capitalized.
 * However, when a noun STARTS and ENDS with the same letter,
 * she likes to repeat the noun twice and connect them together with the first and last letter,
 * combined into one word like so (WITHOUT a 'The' in front):
 * dolphin -> The Dolphin
 * alaska -> Alaskalaska
 * europe -> Europeurope
 * Implement this logic.
 *
 * @param  string  $noun
 * @return string
 */
function getBrandName(string $noun)
{
    $letters = str_split($noun);

    $first_letter = $letters[0];
    $last_letter = $letters[array_key_last($letters)];

    if($first_letter != $last_letter) {
        $brand = 'The ' . ucfirst($noun);
    } else {
        array_shift($letters);
        $twice = implode($letters);
        $brand = ucfirst($noun) . $twice;
    }
    return $brand;
}