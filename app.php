<?php

class Autoloader
{
    public static function register()
    {
        spl_autoload_register(function ($file) {
            if (file_exists($file)) {
                require $file;
                return true;
            }
            else {
            	$base = dirname( __FILE__ ); 
            	$directories = array(
		            'src/class/',
		            'src/library/JWT',
                    'src/library/PasswordHash',
		        );
		        foreach($directories as $directory)
		        {
		            //see if the file exsists
		            if(file_exists($directory.$file . '.php'))
		            {
		                require $directory . $file . '.php';
		                return;
		            }            
		        }
            }
            return false;
        });
    }
}
Autoloader::register();

$config = new Config();
$template_url = $config->path_template . '/';
$page = str_replace("/","",$_SERVER['REQUEST_URI']);
$_main = empty( trim($page) ) ? 'home' : $page;