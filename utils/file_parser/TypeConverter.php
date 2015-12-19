<?php namespace utils\file_parser;
require('AbstractParser.php');
require('CSVParser.php');
require('JSONParser.php');
require('XMLParser.php');
/**
 * TypeConverter.php
 *
 * Parses files/input from one format to another
 *
 * @author Jack Monk
 * @package utils
 */
class TypeConverter {

    public function convert($mix_data, $int_file_type_from, $int_file_type_to = 0) {

        $obj_reader = $this->get_parser($int_file_type_from);
        $mix_converted_data = $obj_reader->read($mix_data);

        //  Optionally convert to another type, otherwise return the normalised data array
        if ($int_file_type_to !== 0) {
            $obj_writer = $this->get_parser($int_file_type_to);
            $mix_converted_data = $obj_writer->write($mix_converted_data);
        }
        return $mix_converted_data;
    }

    /**
     * Constant Enumerations
     * Types cannot be zero value
     */
    const TYPE_JSON = 1;
    const TYPE_CSV  = 2;
    const TYPE_XML  = 3;

    private function get_parser($int_file_type){
        switch($int_file_type){
            case self::TYPE_JSON:
                return new JSONParser();
                break;
            case self::TYPE_CSV:
                return new CSVParser();
                break;
            case self::TYPE_XML:
                return new XMLParser();
                break;
            default:
                return null;
                break;
        }
    }
}