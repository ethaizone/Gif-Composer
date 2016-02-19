<?php

require 'vendor/autoload.php';

$imageData = [
    'canvasWidth' => 5,
    'canvasHeight' => 1,
    'globalColorTable' => [
        'FFFFFF', // white
        '000000'  // black
    ],
    'backgroundColorIndex' => 1
];

$composer = new Gif\Composer($imageData);
$d = $composer->create();

if ( ! function_exists('array_flatten'))
{
    /**
     * Flatten a multi-dimensional array into a single level.
     *
     * @param  array  $array
     * @return array
     */
    function array_flatten($array)
    {
        $return = array();

        array_walk_recursive($array, function($x) use (&$return) { $return[] = $x; });

        return $return;
    }
}
// var_dump($d);
$d = array_flatten($d);
$tmp = "";
foreach ($d as $key => $hex) {
    $tmp .= chr(hexdec($hex));
}

$fp = fopen("my.gif","wb+");
fwrite($fp,$tmp);
fclose($fp);