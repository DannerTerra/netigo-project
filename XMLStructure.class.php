<?php

class XMLStructure {
    
    private $pageXMLArray;

    public function __construct($xmlFile) {
        $this->pageXMLArray = simplexml_load_file(__DIR__ . "/files/" . $xmlFile);
    }

    public function getPageXMLArray() {
       return $this->pageXMLArray;
    }
}