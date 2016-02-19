<?php namespace Gif\Block;

/**
 * Trailer block
 * This is end of file block.
 */

class Trailer extends Foundation implements BlockInterface
{

    public function build() {
        return ['3B'];
    }
}