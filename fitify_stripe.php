<?php

/*
  // TESTING
  define('CLIENT_ID', 'ca_8Uk5mK4vYt6ohqAyQNjAwX7E1wrxLN80');
  define('API_KEY', 'sk_test_asZPNrPXjLEFHO3nKcsggiZ4'); 
*/

  // LIVE
define('CLIENT_ID', 'ca_8Uk5G1K5tf8DSmGywAPB0lpvQzTLAx8F');
define('API_KEY', 'sk_live_9e4p3uisSN8NjJ35I1CupDIR');   


  define('TOKEN_URI', 'https://connect.stripe.com/oauth/token');
  define('AUTHORIZE_URI', 'https://connect.stripe.com/oauth/authorize');
  if (isset($_GET['code'])) { // Redirect w/ code
    $code = $_GET['code'];
    $token_request_body = array(
      'client_secret' => API_KEY,
      'grant_type' => 'authorization_code',
      'client_id' => CLIENT_ID,
      'code' => $code,
    );
    $req = curl_init(TOKEN_URI);
    curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($req, CURLOPT_POST, true );
    curl_setopt($req, CURLOPT_POSTFIELDS, http_build_query($token_request_body));
    // TODO: Additional error handling
    $respCode = curl_getinfo($req, CURLINFO_HTTP_CODE);
    $resp = json_decode(curl_exec($req), true);
    curl_close($req);
    $url1 = 'fitifystripe://?stripe_token='. $resp['access_token'] .'&stripe_userid='. $resp['stripe_user_id'];
    echo '<script>window.location = "'.$url1.'";</script>';
    die;
  } else if (isset($_GET['error'])) { // Error
    echo $_GET['error_description'];
  } else { // Show OAuth link
    $authorize_request_body = array(
      'response_type' => 'code',
      'scope' => 'read_write',
      'client_id' => CLIENT_ID
    );
    $url = AUTHORIZE_URI . '?' . http_build_query($authorize_request_body);
    //echo "<a href='$url'>Connect with Stripe</a>";
    echo '<script>window.location = "'.$url.'";</script>';
  }
?>