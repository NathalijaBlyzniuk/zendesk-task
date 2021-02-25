<?php
require 'vendor/autoload.php';
//echo $_SERVER['DOCUMENT_ROOT'];//D:/OpenServer/domains/nguzzle6
class AbstractHandler
{
	
  public function getFunctionFor ($function, $variables) { 
    if (is_object($variables['data_array'])) {
      return $variables['data_array']->runQueue ($this, $function, $variables); 	  
	} 
    else {
      return $this->$function ($variables);  		
	}	
  }  

}  
  
  