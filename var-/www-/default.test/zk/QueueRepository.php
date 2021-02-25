<?php
require 'vendor/autoload.php';

class QueueRepository   // подумати над магічним методом _get()
{
  public $batches;	
  
  public function __construct() {
	$this->batches = [];
  }	
	
  public function getFromBatchesOnId ($batches, $id) { 
	foreach ($batches as $batch) {            
	$data = $this->getDataFromArray($batch);
	array_push ($data_batch, $data);           
  }  
 }
	  
  public function setBatch ($batch) {
	$this->batches[] = $batch;    
  } 
  
  public function getBatch () {     
  //return $this->batches[1][1]['url'];
  return $this->batches;
  }
  	
}   
  
  