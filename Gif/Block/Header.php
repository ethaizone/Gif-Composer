<?php namespace Gif\Block;

/**
 * Header block
 * This is default. Result is GIF89a
 */

class Header extends Foundation implements BlockInterface
{

    public function build() {
        return ['47', '49', '46', '38', '39', '61'];
    }
}