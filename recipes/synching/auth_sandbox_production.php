<?php 
require_once( 'cascade_ws_ns7/ws_lib.php' );

$source_wsdl = "http://sandbox.myorg.edu:1234/ws/services/AssetOperationService?wsdl";
$source_auth           = new stdClass();
$source_auth->username = "admin";
$source_auth->password = "admin";

$target_wsdl = "http://production.myorg.edu:2345/ws/services/AssetOperationService?wsdl";
$target_auth           = new stdClass();
$target_auth->username = "admin";
$target_auth->password = "admin";

try
{
	// set up the services
	$source_service = new AssetOperationHandlerService( $source_wsdl, $source_auth );
	$target_service = new AssetOperationHandlerService( $target_wsdl, $target_auth );
	
	$source_cascade = new Cascade( $source_service );
	$target_cascade = new Cascade( $target_service );
	
	echo "Source URL: " . $source_wsdl . BR;
	echo "Target URL: " . $target_wsdl . BR;
	
	if( $source_wsdl == $target_wsdl )
		echo "One single instance." . BR . BR;
	else
		echo "Two different instances." . BR . BR;
		
	$instances = new CascadeInstances( $source_cascade, $target_cascade );
}
catch( ServerException $e )
{
	echo S_PRE . $e . E_PRE;
	throw $e;
}
?>
