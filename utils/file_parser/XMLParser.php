<?php namespace utils\file_parser;

class XMLParser extends AbstractParser {
    public function read($str_input_data){
        return array('normalised_array');
    }

    public function write($arr_normalised_data){
        return 'XML STRING';
    }
}