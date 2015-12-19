<?php namespace utils\file_parser;

abstract class AbstractParser{
    abstract function read($str_input_data);
    abstract function write($arr_normalised_data);
}