<?php namespace Gif\Block;

use Gif\Composer;

abstract class Foundation
{
    protected $composer;

    public function __construct(Composer $composer) {
        $this->composer = $composer;
    }

    // protected function array_flatten($array)
    // {
    //     $return = array();

    //     array_walk_recursive($array, function($x) use (&$return) { $return[] = $x; });

    //     return $return;
    // }

    // protected function hexchr($hex) {
    //     return chr(hexdec($hex));
    // }

    /**
     * Dec to Hex with Zero padding
     * @param  mixed   $dec         Int or String in base10
     * @param  integer $zeroPadding Number length of padding
     * @return string               Number in base16
     */
    protected function dechex($dec, $zeroPadding = 0) {
        if ($zeroPadding) {
            $zeroPadding = '0'.$zeroPadding;
        }
        return sprintf('%'.$zeroPadding.'s', dechex($dec));
    }

    protected function binhex($bin, $zeroPadding = 0) {
        return str_pad(base_convert($bin, 2, 16), $zeroPadding, '0', STR_PAD_LEFT);
    }

    protected function decbin($dec, $zeroPadding = 0) {
        return str_pad(base_convert($dec, 10, 2), $zeroPadding, '0', STR_PAD_LEFT);
    }
}