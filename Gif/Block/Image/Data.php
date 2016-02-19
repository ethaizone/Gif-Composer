<?php namespace Gif\Block\Image;

use Gif\Block\Foundation;
use Gif\Block\BlockInterface;

/**
 * Image Data block
 * This will tell image raster data.
 * Tell which pixel will use which color in color table.
 * This one is hardest part thta I don't know.
 * I like guess until I can create image.
 */

class Data extends Foundation implements BlockInterface
{

    protected $codeTable = [];
    protected $codeStream = [];

    protected function _createCodeTable() {
        $this->codeTable = [];

        $colorTable = $this->composer->getAttribute('globalColorTable');
        foreach ($colorTable as $index => $color) {
            $this->codeTable[] = $this->decbin($index);
        }

        // add Clear Code
        $this->codeTable[] = $this->decbin($index+1);
        // add End Of Information Code
        $this->codeTable[] = $this->decbin($index+2);
    }

    public function build() {
        //02 02 4401 00

/*
        $imagePixel = '0';
        // http://www.matthewflickinger.com/lab/whatsinagif/lzw_image_data.asp

        // must run
        $this->_createCodeTable();
        $this->codeStream[] = $this->_getClearCode();   // add clear code to code stream

#1 000 white
#2 001 black
#3 010 [none] black
#4 011 [none] black
#5 100 clear code
#6 101 EOI
#7 110 #1 #1           *2
#8 111 #1 #1 #1        *3
#9 1000 #1 #1 #1  #1   *4


000 000 000 000 000


100
000   *1
000   *2     000 000
000   *3     
0000  *4   
0000  *5
101


    00 000 100
    0000 000 0
    01010000



        // string(8) "01000100"
        // string(8) "00000001"

        #1 000 white
        #2 001 black
        #3 010 [none]
        #4 011 [none]
        #5 100 clear code
        #6 101 EOI


output 
000


     last
code code
 100      clear dictionary
 000      output [white] (1st pixel)
 101  000 new code in table:
              output 010 = [black]
              add 110 = old + 1st byte of new = [blue black] to table
 111  010 new code not in table:
              output last string followed by copy of first byte, [black black]
              add 111 = [black black] to table
              111 is largest possible 3-bit code, so switch to 4 bits
0110 0111 new code in table:
              output 0110 = [blue black]
              add 1000 = old + 1st byte of new = [black black blue] to table
0111 0110 new code in table:
              output 0111 = [black black]
              add 1001 = old + 1st byte of new = [blue black black] to table


        var_dump(str_pad(base_convert('44', 16, 2), 8, '0', STR_PAD_LEFT));
        var_dump(str_pad(base_convert('01', 16, 2), 8, '0', STR_PAD_LEFT));
    */

    //         00 000 100
    // 0000 000 0
    // 01010000

// 10000100
// 1011101

        return ['02', '02',
        '84',
'5d',
        // $this->binhex('00000100', 2),
        // $this->binhex('00000000', 2),
        // $this->binhex('00010100', 2),

        '00'];
    }
}