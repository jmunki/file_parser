<?php namespace utils\file_parser;

class XMLParser extends AbstractParser {
    const XML_VERSION = "1.0";

    public function read($str_input_data){
        return array('normalised_array');
    }

    public function write($arr_normalised_data){
        $str_initial_xml_node = new \SimpleXMLElement('<?xml version="'.self::XML_VERSION.'" encoding="UTF-8"?><data></data>');
        $this->array_to_xml($arr_normalised_data, $str_initial_xml_node);
        return $str_initial_xml_node;
    }

    private function array_to_xml($arr_data, &$arr_data){
        foreach($arr_data as $str_key => $mix_value) {
            if (is_array($mix_value)) {
                if (! is_numeric($str_key)) {
                    $str_child = $arr_data->addChild("$str_key");
                    $this->array_to_xml($mix_value, $str_child);
                } else {
                    $str_child = $arr_data->addChild("item$str_key");
                    $this->array_to_xml($mix_value, $str_child);
                }
            } else {
                $arr_data->addChild("$str_key",htmlspecialchars("$mix_value"));
            }
        }
    }
}