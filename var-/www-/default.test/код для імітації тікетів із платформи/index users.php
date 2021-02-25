<?php
/*тепер треба так зробити, щоб масивів було 100 (як на сторінку) + щоб були різні дані для кожного користувача
*/ 	
for ($a = 1; $a <= 100; $a++) {	
  $id = 377890949999;  
  if ($new_id !==null) {
    $id = $new_id;	  
  }
  $k = $a + 108;
  $new_id = makePage($id, $k);	
}

function makePage($this_id, $a) { 
for ($i = 1; $i <= 100; $i++) {
  $id = $this_id;	
  $id = $id+$i;
  $url = 'https://relokia140.zendesk.com/api/v2/users/'.$id.'.json';
  $role = 'end-user'; 
if (is_int($i/15)==true) {
  $role = 'admin';   
}

$array =  
  (object) array(
   'id' => $id,
   'url' => $url,
   'name' => 'Наталия Близнюк'.$i,
   'email' => 'nathaliewords@gmail.com',
   'created_at' => '2021-01-12T16:57:01Z',
   'updated_at' => '2021-01-26T17:11:27Z',
   'time_zone' => 'Europe/Kiev',
   'iana_time_zone' => 'Europe/Kiev',
   'phone' => NULL,
   'shared_phone_number' => NULL,
   'photo' => NULL,
   'locale_id' => 27,
   'locale' => 'ru',
   'organization_id' => 381024975202,
   'role' => $role,
   'verified' => true,
   'external_id' => NULL,
   'tags' => 
  array (
  ),
   'alias' => NULL,
   'active' => true,
   'shared' => false,
   'shared_agent' => false,
   'last_login_at' => '2021-01-26T17:11:27Z',
   'two_factor_auth_enabled' => NULL,
   'signature' => NULL,
   'details' => NULL,
   'notes' => NULL,
   'role_type' => NULL,
   'custom_role_id' => NULL,
   'moderator' => true,
   'ticket_restriction' => NULL,
   'only_private_comments' => false,
   'restricted_agent' => false,
   'suspended' => false,
   'chat_only' => false,
   'default_group_id' => 360006242680,
   'report_csv' => true,
   'user_fields' => 
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




  
  