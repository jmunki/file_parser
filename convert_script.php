#!/usr/bin/php
<?php
require('utils/file_parser/TypeConverter.php');
use utils\file_parser\TypeConverter as Converter;

/**
 * TODO
 * Check for input filename flag, read file into variable
 * Check for input from STDIN
 * Check for input type format
 *
 * Check for output type format
 * Check for output filename flag, save results to file
 */


$mix_input_test = 'Name,Address_1,Address_2,Address_3,Address_4,Address_Postcode,Contact_Home,Contact_Work
David Corbyn,1203 City Heights,Victoria Bridge Street,Salford, Greater Manchester,M35AS, , 0161 234234,
Jeremy Cameron, 408 Marsden House, Marsden Road, Bolton, Greater Manchester,BL12JT, 01613343844,';
$obj_parser = new Converter();
$mix_output = $obj_parser->convert($mix_input_test, Converter::TYPE_CSV);

echo print_r($mix_output, true);




