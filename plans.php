<?php
require_once('vendor/autoload.php');

/* Code Section 1
Create a Plan in Stripe
Note that each plan must have a unique id  
This code is concatenating the trainers name with the trainers plan  
name to create the unique plan id */

// See your keys here https://dashboard.stripe.com/account/apikeys
\Stripe\Stripe::setApiKey("sk_test_asZPNrPXjLEFHO3nKcsggiZ4");


$trainerAuthID =  $_POST['trainerAuthID'];
$amount = $_POST['amount'];
$planName = $_POST['planName'];

$planName = str_replace(' ', '', $planName);                 /* remove embedded spaces */

$plan = \Stripe\Plan::create(array(
  "amount" => $amount*100,
  "interval" => "month",
  "name" => $planName,
  "currency" => "usd",
  "id" => $trainername.$planName;   
);

echo($plan)

?>