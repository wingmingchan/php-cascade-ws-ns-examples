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
    'id'      => '275f515a8b7f08ee5668fbfd3fe3e766',
    /*/
    'path'        => array( 
        'path'    => 
            'index',
            'siteName' => 'formats' ),
    /*/
    'type'        => 'page' );

// parameters to be sent to Cascade
$readParams = array (
    'authentication' => $auth, 'identifier' => $identifier );

// send the read request
$reply = $client->read( $readParams );

// output the reply
echo "<pre>
Read dump:";
var_dump( $reply );

// display h1
var_dump( $reply->readReturn->asset->page->structuredData->
    structuredDataNodes->structuredDataNode[ 1 ]->
    structuredDataNodes->structuredDataNode[ 2 ]->text );

echo "</pre>";
?>