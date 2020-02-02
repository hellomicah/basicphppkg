<?php
class Config {

	protected $config = array();
	protected $environment = '';

    public function __construct($env='live')
    {
        $this->config = include_once 'config.env';
        $this->environment = $env;
    }

    public function __get($key)
    {
        return $this->search($key);
    }

    public function search($key) {

    	$configuration = $this->config[$this->environment];

    	if ( isset($key) && !empty(trim($key)) ){
    		$config_array = explode( '_', $key );
    		$config_name = $configuration;
    		foreach ( $config_array as $config_key ) {
    			$config_name = $config_name[$config_key];
    		}
    	} 
    	else {
    		$config_name = $configuration[$key];
    	}
    	return $config_name;
    	
    	throw new \Exception('Invalid configuration option: ' . $key);
    }

}