<?php
require_once('vendor/autoload.php');

// Set your secret key: remember to change this to your live secret key in production
// See your keys here https://dashboard.stripe.com/account/apikeys
\Stripe\Stripe::setApiKey("sk_live_9e4p3uisSN8NjJ35I1CupDIR");

/* Code Section 2
/* Get the customers email from Fitify and put into $email   */
$token = $_POST['stripeToken'];
$description = $_POST['description'];
$planName = $_POST['planName'];

$customer =
\Stripe\Customer::create array(
“source”=> $token,
“plan”=> $description,
“email” = > $email)
):


//$planName = str_replace(' ', '', $planName);                 /* remove embedded spaces */

$customer = \Stripe\Customer::create(array(
  "source" => $token,
  "plan" => $planName,
  "email" => $email
);


?>