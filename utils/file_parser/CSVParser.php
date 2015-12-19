<?php namespace utils\file_parser;

class CSVParser extends AbstractParser {
    public function read($str_input_data){
        $arr_data = str_getcsv($str_input_data, "\n"); //parse the headers

        $arr_headers = explode(",", $arr_data[0]);

        $arr_normalised_data = [];
        foreach($arr_headers as $str_header){
            $arr_split = explode("_", trim($str_header));
            $arr_normalised_data[$arr_split[0]][$arr_split[1]] = "";
        }
        return $arr_normalised_data;
    }

    public function write($arr_normalised_data){
        return 'CSV STRING';
    }
}