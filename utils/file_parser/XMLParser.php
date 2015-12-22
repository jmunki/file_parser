<?php namespace utils\file_parser;

class XMLParser extends AbstractParser {
    const XML_VERSION = "1.0";
    const ELEMENT_NAME_PREFIX = "el_";

    public function read($str_input_xml){
        $obj_simple_xml = simplexml_load_string($str_input_xml);
        $str_json = json_encode($obj_simple_xml);
        $arr_normalised_data = json_decode($str_json, TRUE);
        return $arr_normalised_data;
    }

    public function write($arr_normalised_data){
        $str_initial_xml_node = new \SimpleXMLElement('<?xml version="'.self::XML_VERSION.'" encoding="UTF-8"?><data></data>');
        $this->array_to_xml($arr_normalised_data, $str_initial_xml_node);
        return $str_initial_xml_node->asXML();
    }

    private function array_to_xml($arr_data, &$str_node){
        foreach($arr_data as $str_key => $mix_value) {
            if (is_array($mix_value)) {
                if (is_numeric($str_key)) {
                    //  Append prefix to numeric values
                    $str_child = $str_node->addChild(self::ELEMENT_NAME_PREFIX."$str_key");
                    $this->array_to_xml($mix_value, $str_child);
                } else {
                    $str_child = $str_node->addChild("$str_key");
                    $this->array_to_xml($mix_value, $str_child);
                }
            } else {//  Leaf
                if (is_numeric($str_key)) {
                    //  Append prefix to numeric values
                    $str_node->addChild(self::ELEMENT_NAME_PREFIX."$str_key", htmlspecialchars("$mix_value"));
                } else {
                    $str_node->addChild("$str_key", htmlspecialchars("$mix_value"));
                }
            }
        }
    }
}