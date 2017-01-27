<?php 
require_once( 'auth_tutorial7.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $user  = $cascade->getAsset( a\User::TYPE, "chanw-test" );
    $group = $cascade->getAsset( a\Group::TYPE, "CWT-Designers" );
    
    // join a group
    if( !$user->isInGroup( $group ) )
    {
    	$user->joinGroup( $group );
    }
    
    echo $group->getUsers(), BR;
    
    // leave a group
    $user->leaveGroup( $group );
    echo $group->getUsers(), BR;

	// disable the user
	$user->disable()->edit();
	echo u\StringUtility::boolToString( $user->getEnabled() ), BR;
	
	// enable the user
	$user->enable()->edit();
	
	// get the auth type
	echo $user->getAuthType(), BR;
	
	// set the password
	$user->setPassword( 'easy' )->edit();
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