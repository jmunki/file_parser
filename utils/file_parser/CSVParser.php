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
        $arr_headers = $this->split_header_row($arr_csv_headers);

        $arr_normalised_data = [];
        foreach($arr_csv_rows as $str_csv_row){
            $arr_normalised_data[] = $this->split_data_row($arr_headers, $str_csv_row);
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
        return 'CSV STRING';
    }

    /**
     * Splits header row CSV string into an array
     * @param $str_header_row
     * @return array|string
     */
    private function split_header_row($str_header_row){
        $arr_raw_headers = explode(",", $str_header_row);

        $arr_normalised_headers = [];
        foreach($arr_raw_headers as $str_header){
            $arr_sub_headers = explode("_", $str_header);
            $str_key = array_shift($arr_sub_headers);
            $arr_normalised_headers = $this->generate_sub_arrays($str_key, $arr_sub_headers);
        }
        return $arr_normalised_headers;
    }

    /**
     * Handy util function for recursively generating arrays with a specific key
     *
     * @param $str_key
     * @param $arr_sub_headers
     * @return string
     */
    private function generate_sub_arrays($str_key, $arr_sub_headers){
        $str_this_key = array_shift($arr_sub_headers);

        $arr_return[$str_key] = [];
        if (count($arr_sub_headers) > 1){
            //  Break down array further
            $arr_return[$str_key] = $this->generate_sub_arrays($str_this_key, $arr_sub_headers);
        } else {
            //  Leaf node
            if($str_key){
                $arr_return[$str_key] = "";
            }else{
                //  we don't have a key
                $arr_return = "";
            }
        }
        return $arr_return;
    }

    private function split_data_row($arr_headers, $str_data_row){

    }
}