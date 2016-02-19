<?php namespace Gif;

use Exception;
use Gif\Block;

class Composer
{
    protected $attributes = array();
    public function __construct(Array $attributes) {
        $this->attributes = $attributes;
    }

    protected function createBlock($blockName) {
        $blockClass = __NAMESPACE__.'\\Block\\'.$blockName;
        $block = new $blockClass($this);
        $blockInterface = __NAMESPACE__.'\\Block\\BlockInterface';
        if (! $block instanceof $blockInterface) {
            throw new Exception("This ".get_class($block)." block don't implement interface from $blockInterface.");
        }

        return $block->build();
    }

    public function getAttribute($name) {
        if (! isset($this->attributes[$name])) {
            throw new Exception("Require $name attribute is not exists in composer.");
        }

        return $this->attributes[$name];
    }

    public function create() {

        $blockOrder = [
            'Header',
            'LogicalScreen',
            'GlobalColorTable',
            'Image\\Descriptor',
            'Image\\Data',
            'Trailer'
        ];

        $streamData = [];
        foreach ($blockOrder as $blockName) {
            $streamData[$blockName] = $this->createBlock($blockName);
        }

        return $streamData;
    }
}