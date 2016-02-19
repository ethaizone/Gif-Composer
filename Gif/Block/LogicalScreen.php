<?php namespace Gif\Block;

/**
 * Create logical screen
 */
class LogicalScreen extends Foundation implements BlockInterface
{

    /**
     * Create packed byte
     * @return string Hex number
     */
    protected function _createPackedBytes() {

        $globalColorTableFlag = '0';
        if ($this->composer->getAttribute('backgroundColorIndex')) {
            $globalColorTableFlag = '1';
        }
        $colorResolution = '000';
        $sortFlag = '0';
        $sizeOfGlobalColorTable = $this->_createSizeOfGlobalColorTable();
        $packedByte = $globalColorTableFlag
            .$colorResolution
            .$sortFlag
            .$sizeOfGlobalColorTable;
        return base_convert($packedByte, 2, 16);
    }

    protected function _createSizeOfGlobalColorTable() {
        $colorTable = $this->composer->getAttribute('globalColorTable');
        $totalColor = count($colorTable);
        $sizeOfGlobalColorTable = 0;
        for ($i=0; $i <= 7; $i++) { 
            $maximumColor = pow(2, $i+1);
            if ($totalColor < $maximumColor) {
                break;
            }
            $sizeOfGlobalColorTable = $i;
        }

        return str_pad(decbin($sizeOfGlobalColorTable), 3, '0', STR_PAD_LEFT);
    }

    public function build() {
        $canvasWidth  = str_split($this->dechex($this->composer->getAttribute('canvasWidth'),  4), 2);
        $canvasHeight = str_split($this->dechex($this->composer->getAttribute('canvasHeight'), 4), 2);
        $pixelAspectRatio = 0;

        return [
            $canvasWidth[1],
            $canvasWidth[0],
            $canvasHeight[1],
            $canvasHeight[0],
            sprintf('%02d', $this->_createPackedBytes()),
            $this->dechex($this->composer->getAttribute('backgroundColorIndex'), 2),
            $this->dechex($pixelAspectRatio, 2)
            ];

    }
}