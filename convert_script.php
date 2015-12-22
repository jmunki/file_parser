#!/usr/bin/php
<?php
/**
 * CLI script for converting from one file type to another
 * Takes optional filenames for reading/writing files
 */
require('utils/file_parser/TypeConverter.php');
use utils\file_parser\TypeConverter as Converter;

/**
 * Valid input/output types
 */
$arr_valid_input_types = [
    "XML" => Converter::TYPE_XML,
    "JSON" => Converter::TYPE_JSON,
    "CSV" => Converter::TYPE_CSV
];
$arr_valid_output_types = [
    "XML" => Converter::TYPE_XML,
    "JSON" => Converter::TYPE_JSON
];

$str_input_type = "";
$str_output_type = "";
$str_example_usage = "Example script usage:\n$[script_name] [input_type] [output_type] [input_file_name] [output_file_name]";
$str_input_file = "php://stdin";
$str_output_file = "php://stdout";

// Check input/output types are valid
if (! isset($argv[1]) || ! array_key_exists($argv[1], $arr_valid_input_types)) {
    echo "Please specify a valid input type: " . implode(", ", array_keys($arr_valid_input_types)) . "\n";
    echo "$str_example_usage\n\n";
    exit;
}
$str_input_type = $arr_valid_input_types[$argv[1]];

if (! isset($argv[2]) || ! array_key_exists($argv[2], $arr_valid_output_types)) {
    echo "Please specify a valid output type: " . implode(", ", array_keys($arr_valid_output_types)) . "\n";
    echo "$str_example_usage\n\n";
    exit;
}
$str_output_type = $arr_valid_output_types[$argv[2]];

//  Check input/output file names
if (! isset($argv[3]) || empty($argv[3])) {
    echo "Please specify a filename as input. Use a dash (-) for STDIN\n";
    echo "$str_example_usage\n\n";
    exit;
}
if($argv[3] !== "-"){
    $str_input_file = $argv[3];
}

if (! isset($argv[4]) || empty($argv[4])) {
    echo "Please specify a filename to output to. Use a dash (-) for STDOUT\n";
    echo "$str_example_usage\n\n";
    exit;
}
if($argv[4] !== "-"){
    $str_output_file = $argv[4];
}

/**
 *  Input
 */
$str_input_content = file_get_contents($str_input_file);
/**
 *  Convert
 */
$obj_parser = new Converter();
$mix_output = $obj_parser->convert($str_input_content, $str_input_type, $str_output_type);
/**
 *  Output
 */
file_put_contents($str_output_file, $mix_output);

