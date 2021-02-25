<?php

class Application
{
  public $csvWriter;	
  public $dataHandler;
  public $data_array;
	
  public function __construct() {
    $this->csvWriter = new CsvWriter();	
	$this->dataHandler = new DataHandler();	     // new DataHandler($this);   - мені цікаво, чи в даному випадку так можна
	$this->data_array = [];
  }	
  
  public function getDataFromZendesk($params, $schema) {           // тут можна через foreach
    $this->data_array['tickets'] = Queue::runWritingToCsv($params, $schema, 'tickets');
	$this->data_array['groups'] = Queue::runWritingToCsv($params, $schema, 'groups');
	$this->data_array['organizations'] = Queue::runWritingToCsv($params, $schema, 'organizations');
	$this->data_array['users'] = Queue::runWritingToCsv($params, $schema, 'users');                // повертає 4 підмасиви у вигляді або масивів, або репозиторіїв
  }                 

  public function getDataAccordingToSchema ($schema) {
    $dataArray = $this->dataHandler->getDataFromArray ($this->data_array, $schema);	  
	return $dataArray;
  }  
  
  public function writeToCsvFile($array) {
    $this->csvWriter->writeToCsv($array);	  
  }
	  
}   
  
  