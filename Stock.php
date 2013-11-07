<?php

/**
 * Installed resoruce for stock information using Yahoo API with YQL
 */

// Make sure all installed resources use this namespace to avoid collisions
namespace tdt\installed;

class Stock{

    /**
     * The set of REST parameters that this resource requires.
     */
    public static function getParameters(){
        return array(
            'symbol' => array(
                'required' => true,
                'description' => "The official stock symbol. It's also possible to specify multiple symbols by seperating them with a plus sign.",
            )
        );
    }

    /**
     * Set parameters to be used in the read function, you can manipulate or validate your REST parameters here
     */
    public function setParameter($key, $value){
        $this->$key = $value;
    }

    /**
     * For semantic resources only (optional)
     */
    public function getNamespaces(){
        return array();
    }

    /**
     * Return an array with your data
     */
    public function getData(){

        $browser = new Buzz\Browser();
        $response = $browser->get('http://www.google.com');

        return $response;
    }

    /**
     * Return some documentation for this resource
     */
    public static function getDocumentation(){
        return "Retrieve stock information from given stock symbol(s).";
    }

}