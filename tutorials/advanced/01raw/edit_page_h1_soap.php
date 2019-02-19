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
$identifier        = array(
    'path'         => array( 
        'path'     => 'index',
        'siteName' => 'formats' ),
    'type'         => 'page' );

// parameters to be sent to Cascade
$readParams = array (
    'authentication' => $auth, 'identifier' => $identifier );

// send the read request
$reply = $client->read( $readParams );

echo "<pre>";
//var_dump( $reply );
echo "</pre>";

if( $reply->readReturn->success == 'true' )
{
    echo "Successfully reading the page.<br />";
    $page  = $reply->readReturn->asset->page;
    $page->structuredData->
        structuredDataNodes->structuredDataNode[ 1 ]->
        structuredDataNodes->structuredDataNode[ 2 ]->text =
        "New H1";
    $editParams = array(
        'authentication' => $auth,
        'asset' => array( 'page' => $page ) );
    $reply = $client->edit( $editParams );
    
    if( $reply->editReturn->success == 'true' )
    {
        echo "Successfully edited the page.";
    }
    else
    {
        echo "Failed to edit the page.";
    }
}
else
{
    echo "Failed to read the page.";
}
?>