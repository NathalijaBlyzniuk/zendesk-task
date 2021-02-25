<?php
/*тепер треба так зробити, щоб масивів було 100 (як на сторінку) + щоб були різні дані для кожного користувача
*/ 	
for ($a = 1; $a <= 100; $a++) {	
  $id = 51001;
  if ($new_id !==null) {
    $id = $new_id;	  
  }
  $k = $a+509;
  $new_id = makePage($id, $k);	
}

function makePage($this_id, $a) { 
$file = $a.'.txt';
$curr = file_get_contents($file);
$curr .= '[';
file_put_contents($file, $curr); 
for ($i = 1; $i <= 100; $i++) {
$id = $this_id;	
$id = $id+$i;
$url = 'https://relokia140.zendesk.com/api/v2/tickets/'.$id.'.json';
//$role = 'end-user'; 
//if (is_int($i/15)==true) {
//$role = 'admin';   
//}

$array =  
(object) array(
   'url' => $url,
   'id' => $id,
   'external_id' => NULL,
   'via' => 
  (object) array(
     'channel' => 'api',
     'source' => 
    (object) array(
    ),
  ),
   'created_at' => '2021-01-22T17:58:34Z',
   'updated_at' => '2021-01-22T17:58:34Z',
   'type' => NULL,
   'subject' => 'The quick brown fox jumps over the lazy dog.',
   'raw_subject' => 'The quick brown fox jumps over the lazy dog.',
   'description' => 'Lorem ipsum dolor sit amet dolore magna alliqua.',
   'priority' => 'normal',
   'status' => 'open',
   'recipient' => NULL,
   'requester_id' => 377890939414,
   'submitter_id' => $id,
   'assignee_id' => $id,
   'organization_id' => 381024975200,
   'group_id' => 360006242680,
   'collaborator_ids' => 
  array (
  ),
   'follower_ids' => 
  array (
  ),
   'email_cc_ids' => 
  array (
  ),
   'forum_topic_id' => NULL,
   'problem_id' => NULL,
   'has_incidents' => false,
   'is_public' => true,
   'due_at' => NULL,
   'tags' => 
  array (
  ),
   'custom_fields' => 
  array (
  ),
   'satisfaction_rating' => NULL,
   'sharing_agreement_ids' => 
  array (
  ),
   'fields' => 
  array (
  ),
   'followup_ids' => 
  array (
  ),
   'brand_id' => 360006242680,
   'allow_channelback' => false,
   'allow_attachments' => true,
);
$array = json_encode($array); 
$current = file_get_contents($file);
$current .= $array.',';
file_put_contents($file, $current);  
if ($i===100) {
  $curr2 = file_get_contents($file);
  $curr2 = substr_replace($curr2, ']', -1);
  file_put_contents($file, $curr2); 	
  return $id;	
}
} 
}




  
  