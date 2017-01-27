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
    $role = $cascade->getAsset( a\Role::TYPE, 10 );
    
    // get the Abilities object
    if( $role->getRoleType() == "global" )
    {
    	$abillities = $role->getGlobalAbilities();
    }
    else
    {
    	$abillities = $role->getSiteAbilities();
    }
    
    u\DebugUtility::dump( $abillities );
    
    // set an ability
    $abillities->setAccessContentTypes( false );
    $role->edit()->dump();
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