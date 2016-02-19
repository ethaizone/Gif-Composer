<?php namespace Gif\Block\Image;

use Gif\Block\Foundation;
use Gif\Block\BlockInterface;

/**
 * Image Descriptor block
 * This will tell image position, size and another info.
 */

class Descriptor extends Foundation implements BlockInterface
{

    public function build() {
        $canvasWidth  = str_split($this->dechex($this->composer->getAttribute('canvasWidth'),  4), 2);
        $canvasHeight = str_split($this->dechex($this->composer->getAttribute('canvasHeight'), 4), 2);
        $pixelAspectRatio = 0;

        return [
            '2C', // Image seperator
            '00', // Image left part 2
            '00', // Image left part 1
            '00', // Image top part 2
            '00', // Image top part 1
            $canvasWidth[1],
            $canvasWidth[0],
            $canvasHeight[1],
            $canvasHeight[0],
            '00' // packed field but I'm lazy so fill 0
            ];
    }
}