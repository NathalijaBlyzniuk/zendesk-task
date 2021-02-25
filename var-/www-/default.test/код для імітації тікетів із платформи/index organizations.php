<?php
/*тепер треба так зробити, щоб масивів було 100 (як на сторінку) + щоб були різні дані для кожного користувача
*/ 	
for ($a = 1; $a <= 7; $a++) {	
  $id = 381024975195;  
  if ($new_id !==null) {
    $id = $new_id;	  
  }
  //$k = $a + 108;
  $new_id = makePage($id, $a);	
}

function makePage($this_id, $a) { 
for ($i = 1; $i <= 100; $i++) {
  $id = $this_id;	
  $id = $id+$i;
  $url = 'https://relokia140.zendesk.com/api/v2/organizations/'.$id.'.json';
  $role = 'end-user'; 
if (is_int($i/15)==true) {
$role = 'admin';   
}

$array =  
(object) array(
   'url' => $url, 
   'id' => $id,
   'name' => 'relokia'.$id, 
   'shared_tickets' => false,
   'shared_comments' => false,
   'external_id' => NULL,
   'created_at' => '2021-01-12T16:57:10Z',
   'updated_at' => '2021-01-12T16:57:10Z',
   'domain_names' => 
  array (
  ),
   'details' => NULL,
   'notes' => NULL,
   'group_id' => NULL,
   'tags' => 
  array (
  ),
   'organization_fields' => 
  (object) array(
  ),
);
$array = json_encode($array); 
$file = $a.'.txt';
$current = file_get_contents($file);
$current .= $array.',';
file_put_contents($file, $current);  
if ($i===100) {
  return $id;	
}
} 
}




  
  