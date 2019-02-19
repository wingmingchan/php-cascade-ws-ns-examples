<?php
// server
$wsdl = "http://mydomain.edu:1234/ws/services/AssetOperationService?wsdl";

// authentication information
$auth           = new \stdClass();
$auth->username = "admin";
$auth->password = "admin";

// SOAP client
$client = new SoapClient( 
    $wsdl, array( 'trace' => 1, 'location' => $wsdl ) );

// identifier of the asset
$identifier       = array(
    'path'        => array( 
        'path'    => 'index',
        'siteName'=> 'formats' ),
    'type'        => 'page' );

// parameters to be sent to Cascade
$readParams = array (
    'authentication' => $auth, 'identifier' => $identifier );

// send the read request
$reply       = $client->read( $readParams );
// display xml
$requestXml  = $client->__getLastRequest();
$responseXml = $client->__getLastResponse();

echo $requestXml, "<br /><br />", $responseXml;
?>