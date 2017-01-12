<?php
require_once('vendor/autoload.php');

// Set your secret key: remember to change this to your live secret key in production
// See your keys here https://dashboard.stripe.com/account/apikeys
// test - sk_test_asZPNrPXjLEFHO3nKcsggiZ4
// live - sk_live_9e4p3uisSN8NjJ35I1CupDIR
\Stripe\Stripe::setApiKey("sk_live_9e4p3uisSN8NjJ35I1CupDIR");

// Get the credit card details submitted by the form
$token =  $_POST['stripeToken'];
$amount = $_POST['amount'];
$email = $_POST['email'];
$trainerStripeID = $_POST['trainerStripeID'];
$description = $_POST['description'];
$hasDiscount = $_POST['hasDiscount'];
$applicationFee = 0

// Create the charge on Stripe's servers - this will charge the user's card
try {
	
	if ($hasDiscount == true) {
		$applicationFee = 0
	} else {
		$applicationFee = $amount*100*.15,
	}
	
	$charge = \Stripe\Charge::create(array(
  	"amount" => $amount*100, // Convert amount in cents to dollar
  	"currency" => 'usd',
  	"source" => $token,
	"destination" => $trainerStripeID,
	"application_fee" => $applicationFee,
  	"description" => $description)
	);

	// Check that it was paid:
	if ($charge->paid == true) {
		$response = array( 'status'=> 'Success', 'message'=>'Payment has been charged!!' );
	} else { // Charge was not paid!
		$response = array( 'status'=> 'Failure', 'message'=>'Your payment could NOT be processed because the payment system rejected the transaction. You can try again or use another card.' );
	}
	header('Content-Type: application/json');
	echo json_encode($response);

} catch(\Stripe\Error\Card $e) {
  // The card has been declined
}

?>