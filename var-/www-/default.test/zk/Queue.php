<?php
require 'vendor/autoload.php';

class Queue
{
  public $batches;	
  public $requestHandler;
  public $queueRepository;
	
  public function __construct() {
	$this->requestHandler = new RequestHandler();
    $this->queueRepository = new QueueRepository();	
  }	
  
  public static function create() {
    return new Queue();	  
  }
	
    public static function runWritingToCsv($params, $schema, $data) {
	$dataAmount = $params['data_quantity'][$data];      
	$onPage = 100;
	$requestsAmount = 100;
	if (empty($dataAmount) || empty($onPage) || empty($requestsAmount)) {
    return;
	} else {	
      $pages = ceil($dataAmount/$onPage);
      $batches = ceil($pages/$requestsAmount);  
	  if ($batches > 1) {
        $queue = self::create();
	    $queue->setBatchesToRepository ($pages, $batches, $requestsAmount, $data);  
		return $queue;
	  }
	  else {                                          
	  	$requestHandler = new RequestHandler();
        $array = $requestHandler->getFromZendesk ($pages, 0, $requestsAmount, $data);	  	
        return $array;		
	  }
	}
  }	
  
  public function setBatchesToRepository ($pages, $batches, $requestsAmount, $data) {
      for ($i = 0; $i < $batches; $i++) {
	    $batch = $this->requestHandler->getFromZendesk ($pages, $i, $requestsAmount, $data); 
        $this->queueRepository->setBatch($batch);	  
	  }		   	  
  } 
  
  public function runQueue ($object, $function, $variables) {
	$result_array = [];
	$is_last = false;
	$i = 0;
    foreach ($this->queueRepository->batches as $batch) {
	  $i++;	
      $variables['data_array'] = $batch;	
      $variables['iterator'] = $i;	  
      $result = $object->$function($variables);
	  if ($i == count($this->queueRepository->batches)) {
		$is_last = true;  
	  } 
	  if ($function == 'runCycle') {
        $result_arr = $this->handleResult ($result_array, $result, $is_last);
        if ($is_last === true) {	
          return $result_arr;			
		}		
	  }		    
	}	  
  }
  
  public function handleResult (&$result_array, $result, $is_last) { 
    if (empty($result_array['arrays'])) {
      $result_array['arrays'] = $result;  		
	}
  if ((count($result_array['arrays']) >= 10000 )&&(empty($result_array['queue']))) {
	$result_array['queue'] = new Queue();
    $result_array['queue']->queueRepository->batches[0] = $result_array['arrays'];
    unset($result_array['arrays']);	
  }
  else if ((count($result_array['arrays']) >= 10000 )&&(!empty($result_array['queue']))) {
	$result_array['queue']->queueRepository->batches[count($result_array['queue']->queueRepository->batches)] = $result_array['arrays']; 
    unset($result_array['arrays']);		
  }
  else if ((count($result_array['arrays']) < 10000)&&($is_last === true)) {
    if (!empty($result_array['queue'])) {	  
	$result_array['queue']->queueRepository->batches[count($result_array['queue']->queueRepository->batches)] = $result_array['arrays']; 
    unset($result_array['arrays']);      
    }	
  }  
  return $result_array;
  }
  
}   
  
  