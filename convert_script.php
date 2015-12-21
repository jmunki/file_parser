#!/usr/bin/php
<?php
require('utils/file_parser/TypeConverter.php');
use utils\file_parser\TypeConverter as Converter;

/**
 * TODO Deal with CLI arguments and get input data
 */


$mix_input_test = 'Name,Address_1,Address_2,Address_3,Address_4,Address_Postcode,Contact_Home,Contact_Work
Jack Monk,1503 City Heights,Victoria Bridge Street,Salford, Greater Manchester,M35AS, , 0161 234234,
Another Person, 608 Marsden House, Marsden Road, Bolton, Greater Manchester,BL12JT, 01618343844,';
$obj_parser = new Converter();
$mix_output = $obj_parser->convert($mix_input_test, Converter::TYPE_CSV, Converter::TYPE_XML);
//$mix_output = $obj_parser->convert($mix_output, Converter::TYPE_JSON);


/**
 * TODO Deal with output based on CLI arguments
 */
echo print_r($mix_output, true);




