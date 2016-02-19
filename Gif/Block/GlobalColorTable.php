<?php namespace Gif\Block;

/**
 * Global Color Table Block
 */
class GlobalColorTable extends Foundation implements BlockInterface
{

    public function build() {
        $colorTable = $this->composer->getAttribute('globalColorTable');
        $colorBlock = [];
        foreach ($colorTable as $color) {
            if (strlen($color) != 6) {
                throw new Exception("Color $color is not valid. Color must have 6 characters.");
            }
            $colorBlock = array_merge($colorBlock, str_split($color, 2));
        }

        return $colorBlock;
    }
}