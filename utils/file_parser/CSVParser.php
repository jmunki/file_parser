<?php namespace utils\file_parser;

class CSVParser extends AbstractParser {

    /**
     * Read a CSV file and convert into a normalised PHP array
     *
     * @param $str_input_csv
     * @return array
     */
    public function read($str_input_csv){
        ini_set('auto_detect_line_endings', TRUE);
        //ini_set('memory_limit', '1024M');
        $arr_csv_rows = str_getcsv($str_input_csv, "\n");

        $arr_csv_headers = array_shift($arr_csv_rows);
        $this->split_header_row($arr_csv_headers);

        $arr_normalised_data = [];
        foreach($arr_csv_rows as $str_csv_row){
            $arr_normalised_data[] = $this->split_data_row($str_csv_row);
        }

        return $arr_normalised_data;
    }

    /**
     * Read normalised PHP array and convert into CSV string
     *
     * @param $arr_normalised_data
     * @return string
     */
    public function write($arr_normalised_data){
        //  @TODO: combine array into custom CSV format - with underscores etc
        return $arr_normalised_data;
    }

    /**
     * Splits header row CSV string into an array
     * @param $str_header_row
     * @return array|string
     */
    private function split_header_row($str_header_row){
        $arr_raw_headers = str_getcsv($str_header_row, ",");

        foreach($arr_raw_headers as $str_header){
            $this->arr_headers_lookup_table[] = explode("_", $str_header);
        }
    }

    /**
     * Handy util function for recursively generating arrays with a specific key
     *
     * @param $str_key
     * @param $arr_sub_headers
     * @return string
     */
    private function generate_sub_arrays(&$arr_structured_data, $arr_header_key, $arr_raw_data){
        $str_this_key = array_shift($arr_header_key);

        if (count($arr_header_key)){
            //  Break down array further
            if(! isset($arr_structured_data[$str_this_key])){
                $arr_structured_data[$str_this_key] = array();
            }
            $this->generate_sub_arrays($arr_structured_data[$str_this_key], $arr_header_key, $arr_raw_data);
        } else {
            //  Leaf node
            $arr_structured_data[$str_this_key] = $arr_raw_data;
        }
    }

    private function split_data_row($str_data_row){
        $arr_raw_data = str_getcsv($str_data_row, ",");

        $arr_structured_data = array();
        foreach($this->arr_headers_lookup_table as $int_i => $arr_header) {
            $this->generate_sub_arrays($arr_structured_data, $arr_header, trim($arr_raw_data[$int_i]));
        }
        return $arr_structured_data;
    }

    private $arr_headers_lookup_table = array();
}