<?php
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $group_name = "test-ws-group";
    $role_name  = "Test WS Site Role;Default";
    $group      = $cascade->getGroup( $group_name );

    if( isset( $group ) )
    {
    	echo "Deleting group", BR;
    	$user_names = explode( ";", $group->getUsers() );
    	
    	// remove all users first
    	foreach( $user_names as $user_name )
    	{
    		if( $user_name != "" )
    			$group->removeUserName( $user_name );
    	}
    	$group->edit();
    	
        $cascade->deleteAsset( $group );
    }

    $group = $cascade->createGroup( $group_name, $role_name );
    
    // add the users back
    if( isset( $user_name ) )
    {
    	foreach( $user_names as $user_name )
    	{
    		if( $user_name != "" )
    			$group->addUserName( $user_name );
    	}
    	$group->edit();
    }
    
    // cannot deal with roles because in WS, only one role is read
    
    $group->dump();
    
    u\DebugUtility::dumpRESTCommands( $service );
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