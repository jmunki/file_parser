<?php namespace utils\file_parser;

class JSONParser extends AbstractParser {
    /**
     * Convert a JSON string into a PHP array
     * @param $str_input_data
     * @return mixed
     */
    public function read($str_input_data){
        return json_decode($str_input_data, true);
    }

    /**
     * Convert a PHP array into a JSON string
     * @param $arr_normalised_data
     * @return string
     */
    public function write($arr_normalised_data){
        return json_encode($arr_normalised_data);
    }
}