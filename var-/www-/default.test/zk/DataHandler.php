<?php

class DataHandler extends AbstractHandler
{
  	 
  public function getDataFromArray ($batches, $schema) {
    if ($schema['main'][1] === 'all') {
	  $data_array = $batches[$schema['main'][0]]; 
      $variant = 'all';	 
      $another_data = $batches; 
      unset($another_data[$schema['main'][0]]); 
	}
	else if (is_array($schema['main'][1])) {
	   //$data_array = [];
	   //$variant = 'only_keys';
      //foreach ($schema['main'][1] as $key=>$value) {
       //$data_array[] = $this->findInArrayBy ('id', $value, $batches[$schema['main'][0]], 'key');	// але це можуть бути пакети, тому трохи не так		
	 // } 	                                                                                        // а чисто теоретично - може це бути пакетом?
	}
	$new_array = $this->getFunctionFor ('runCycle', ['data_array' => $data_array, 'schema' => $schema, 'variant' => $variant, 'another_data' => $another_data]);
	$new_array['captures'] = [];
	foreach ($schema['captures'] as $capture=>$body) {
	array_push ($new_array['captures'], $capture);
	}
	return $new_array;
  }
   
  public function runCycle ($variables) {
	$new_array = [];
    foreach ($variables['data_array'] as $key=>$data) {
      foreach ($variables['schema']['captures'] as $key2=>$value) {		
      $variables['this_array'] = $new_array[$key];	  
      $new_array[$key][$key2] = $this->getExpressionFor ($variables, $key, $key2);
	  }	 	  
	}
    return $new_array;
  }
  
  public function getExpressionFor($variables, $key, $key2) {
    if ($variables['schema']['main'][0] != $variables['schema']['captures'][$key2][1]) {
	  $variables['keyvalue'] = $variables['schema']['captures'][$key2][2];  // name
	  $variables['data_array'] = $variables['another_data'][$variables['schema']['captures'][$key2][1]]; //['users']
	  $variables['id'] = $variables['schema']['captures'][$key2][3][0];
	  $variables['value'] = $variables['this_array'][$variables['schema']['captures'][$key2][3][2]]; // 123567
      //return $this->getFunctionFor ('findInArrayBy', $variables); 
	  return $variables['data_array'][$variables['value']][$variables['keyvalue']];
	  
	}
	else {
      return $variables['data_array'][$key][$variables['schema']['captures'][$key2][2]];  	  
	}
  }
  
  public function findInArrayBy ($variables) { 
    if ($variables['id'] === 'id') {
              //$key = array_search($value, array_column($array, 'id'));    $variables['data_array']
	  //$result = array_search($variables['value'], array_column($variables['data_array'], 'id', $variables['keyvalue']));   
	  //return $result; 	  
	}	
    //else {
             //$keys = array_keys($array, $value);	 
	  //$keys = array_keys(array_column($array, 'id', 'url'), $value);
	  //return $keys;
	//}	
  }  
	
}   
  
  