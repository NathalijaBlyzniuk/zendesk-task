<?php
require_once 'vendor/autoload.php';
require_once 'zk/AbstractHandler.php';
require_once 'zk/Application.php';
require_once 'zk/CsvWriter.php';
require_once 'zk/DataHandler.php';
require_once 'zk/Queue.php';
require_once 'zk/QueueRepository.php';
require_once 'zk/RequestHandler.php';

$csvWriter = new CsvWriter();

$schema = ['main'=>['tickets', 'all'], 'captures'=>                       // ['12', '25', '3534']
['ticket_id'=>['Ticket ID', 'tickets', 'id', ['id', '=', '$id']],   //  0=>['Ticket ID', 'tickets', 'id', "'id'=$id"],   'id'=>['Ticket ID', 'tickets', 'id', "'id'=$id"],
'description'=>['Description', 'tickets', 'description', ['id', '=', '$id']], 
'status'=>['Status', 'tickets', 'status', ['id', '=', '$id']], 
'priority'=>['Priority', 'tickets', 'priority', ['id', '=', '$id']], 
'agent_id'=>['Agent ID', 'tickets', 'requester_id', ['id', '=', '$id']],                      // 'agent_id'=>['Agent ID', 'tickets', 'requester_id', "'id'=$id"],
'agent_name'=>['Agent Name', 'users', 'name', ['id', '=', 'agent_id']], 
'agent_email'=>['Agent Email', 'users', 'email', ['id', '=', 'agent_id']],      // може писати 'all', може й масив; тут може масив повернути
'contact_id'=>['Contact ID', 'tickets', 'submitter_id', ['id', '=', '$id']],
'contact_name'=>['Contact Name', 'users', 'name', ['id', '=', 'contact_id']], 
'contact_email'=>['Contact Email', 'users', 'email', ['id', '=', 'contact_id']], 
'group_id'=>['Group ID', 'tickets', 'group_id', ['id', '=', '$id']],
'group_name'=>['Group Name', 'groups', 'name', ['id', '=', 'group_id']], 
'company_id'=>['Company ID', 'tickets', 'organization_id', ['id', '=', '$id']],
'company_name'=>['Company Name', 'organizations', 'name', ['id', '=', 'company_id']],  
'comments'=>['Comments', 'tickets', 'comments', ['id', '=', '$id']]]
];

$params = [
'base_uri' => 'https://relokia140.zendesk.com/',
'auth' => ['nathaliewords@gmail.com', 'hPhsdxrCN9SADSw'],
'paths' => ['/api/v2/tickets.json', '/api/v2/groups.json', '/api/v2/organizations.json', '/api/v2/users.json'],
'data_quantity' => ['tickets'=>61000, 'groups'=>15, 'organizations'=>700, 'users'=>3100]
//'data_quantity' => ['tickets'=>61000, 'groups'=>15, 'organizations'=>700, 'users'=>20900]
];

$application = new Application();
//$application->writeToCsvFile($application->getDataFromZendesk($params, $schema));
$application->getDataFromZendesk ($params, $schema);
$new_array = $application->getDataAccordingToSchema ($schema); 
$application->writeToCsvFile($new_array);
//var_dump ($new_array['queue']->queueRepository->batches[6]);
//var_dump($application->data_array['tickets']->queueRepository->batches);  //NULL







  
  