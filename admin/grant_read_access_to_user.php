<?php
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$site_name   = "formats";
$folder_path = "xslt/building-library/java-extension";
$applied_to_children = true;

$start_time = time();

try
{
    u\DebugUtility::setTimeSpaceLimits();
    
    $admin->grantFolderReadAccessToUserGroup(
    	$site_name, $folder_path, $applied_to_children,
    	$cascade->getAsset( a\User::TYPE, "tuw" ) );

    u\DebugUtility::outputDuration( $start_time );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
catch( \Error $er )
{
    echo S_PRE . $er . E_PRE; 
}
?>