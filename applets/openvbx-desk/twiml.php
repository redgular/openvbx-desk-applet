<?php
 
// The response object constructs the TwiML for our applet
$response = new TwimlResponse;
 
//make an API call to the URL specified

$url = AppletInstance::getValue('promp-text');

if(!$url){
  $url = 'sailthru';
};
$call = normalize_phone_to_E164($_REQUEST['From']);

$return = null;

$return = `twurl '/api/v1/customers.json?phone={$call}' --host {$url}.desk.com`;
$json = $return[0];
$get = null;
$get = json_decode($json);

if($get->total == 0){
  $return = null;
  $json = null;
  exec("twurl '/api/v1/customers.json' --host {$url}.desk.com -X POST -d 'phone={$call}'", $return);
  $json = $return[0];
  $json = json_decode($json);
  $results = $json->results;
  $customer = $results->customer;
  $id = $customer->id;
  if($json->success == 1){
    $submitted = null;
    exec("twurl '/api/v1/interactions.json' --host {$url}.desk.com -X POST -d 'interaction_subject=Phone Call' -d 'customer_id={$id}' -d 'interaction_channel=phone'", $submitted);
};
};
if($get->total == 1){
  $results = $get->results;
  $firstcust = $results[0];
  $customer = $firstcust->customer;
  $id = $customer->id;
  $submitted = null;
  exec("twurl '/api/v1/interactions.json' --host {$url}.desk.com -X POST -d 'interaction_subject=Phone Call' -d 'customer_id={$id}' -d 'interaction_channel=phone'", $submitted);
};

// $primary is getting the url created by what ever applet was put 
// into the primary dropzone
$primary = AppletInstance::getDropZoneUrl('primary');
 
// As long as the primary dropzone is not empty add the redirect 
// twiml to $response
if(!empty($primary)) {
    $response->redirect($primary);
};
 
// This will create the twiml for hellomonkey
$response->respond();
