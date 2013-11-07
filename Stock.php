<?php

/**
 * Installed resoruce for stock information using Yahoo API with YQL
 */

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

        // Register new browser
        $browser = new Buzz\Browser();

        // Get response
        $response = $browser->get("http://finance.yahoo.com/d/quotes.csv?s=" . $this->symbol . "&f=snl1c6p2ohgpv");

        $data = explode("\n", $response->getContent());

        $stocks = array();

        // Parse CVS results
        foreach($data as $line){
            $line = trim($line);
            if(strlen($line) > 0 && substr_count($line, ',') == 9){
                $quote = array();
                list($quote['symbol'], $quote['name'], $quote['value'], $quote['change'], $quote['change_percent'], $quote['open'], $quote['high'], $quote['low'], $quote['previous_close'], $quote['volume']) = explode(",", $line);

                foreach ($quote as $key => $value) {
                    $quote[$key] = trim(preg_replace("/\"/m", "", $value));
                }

                array_push($stocks, $quote);
            }
        }

        return $stocks;
    }

    /**
     * Return some documentation for this resource
     */
    public static function getDocumentation(){
        return "Retrieve stock information from given stock symbol(s).";
    }

}