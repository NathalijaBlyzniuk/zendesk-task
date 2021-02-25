<?php
use GuzzleHttp\Client;

class RequestHandler
{
public function getFromZendesk ($pages, $batchNumber, $requestsAmount, $data) {  
   $batch = array();
   $startPoint = $batchNumber*$requestsAmount;  
   $endPoint = $startPoint + $requestsAmount;
   if ($endPoint > $pages) {
	$endPoint = $pages;   
   }
  for ($i = $startPoint; $i < $endPoint; $i++) {
   $file = file_get_contents('files/'.$data.'/'.$i.'.txt', true);
   $fileArray = json_decode($file, true);
  foreach ($fileArray as $value) {           
  $batch[$value['id']] = $value;
  }
  }
  return $batch;
}	
	
public function getFromZendesk2 ($data, $pagesAmount) {    // 'tickets'
  $client = new Client([
    'base_uri' => 'https://relokia140.zendesk.com/',       
    'verify'  => false,                        
    'allow_redirects' => false, 
    'cookies' => true,	
	'auth' => ['nathaliewords@gmail.com', 'hPhsdxrCN9SADSw']
  ]);
	//$response = $client->request('GET', $path,[  // '/api/v2/tickets.json', https://relokia140.zendesk.com/api/v2/tickets.json?page=2
  $requests = function ($total) {
    $uri = 'http://127.0.0.1:8126/guzzle-server/perf';
    for ($i = 0; $i < $total; $i++) {
        yield new Request('GET', $uri);
    }
};
$promise = $pool->promise();
$poolArray = $promise->wait();
return $this->poolToArray($poolArray); // повертається масив відповідей з тікетами, користувачами або чимось іще. Один з масивів.
// Размер массива ограничен только объемом памяти вашего сервера. Если Ваш массив становится слишком большим, вы получите ошибку "out of memory".
}	

public function poolToArray ($poolArray) {
  $array = array();	
  foreach ($poolArray as $response) {
  $responseArray = json_decode($response->getBody(), true);
  array_push ($array, $responseArray);
  }  
  return $array;
}
		
}   
  
  